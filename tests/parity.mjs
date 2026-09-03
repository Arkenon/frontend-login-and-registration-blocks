/**
 * Proves that the editor and the renderer agree, value for value.
 *
 * Run with: npm run test:parity
 *
 * src/shared/style-vars.js and inc/class-flr-blocks-style.php independently
 * decide what a block's wrapper ends up carrying -- the PHP side by calling
 * core's safecss_filter_attr(), the JS side by reimplementing the parts of it
 * that apply to custom properties, because JavaScript regular expressions have
 * no recursive subpatterns. Any disagreement is the bug this architecture
 * exists to prevent: a style that previews in the editor and then silently
 * disappears on the published page.
 *
 * Two sets of cases run through both: single token values chosen to probe the
 * edges of the CSS filter, and the six design presets in full, which is what
 * an author actually applies.
 *
 * Both modules import things plain node cannot resolve -- the token map as an
 * ESM JSON module, and @wordpress/i18n -- so each is loaded from a temporary
 * copy with those imports inlined. No other line is changed.
 */

import { readFileSync, writeFileSync, unlinkSync } from 'node:fs';
import { execFileSync } from 'node:child_process';
import { pathToFileURL, fileURLToPath } from 'node:url';
import path from 'node:path';

const HERE = path.dirname( fileURLToPath( import.meta.url ) );
const PLUGIN = path.join( HERE, '..' );

const temporaries = [];

/**
 * Load a source module after rewriting the imports node cannot follow.
 *
 * @param {string} relativePath Path within the plugin.
 * @param {string} suffix       Temp file suffix.
 * @return {Promise<Object>} The module's exports.
 */
async function loadModule( relativePath, suffix ) {
	const tokenMap = readFileSync( path.join( PLUGIN, 'flr-style-tokens.json' ), 'utf8' );

	const source = readFileSync( path.join( PLUGIN, relativePath ), 'utf8' )
		.replace( /^import tokenMap from '.*';$/m, `const tokenMap = ${ tokenMap };` )
		.replace( /^import \{ __ \} from '@wordpress\/i18n';$/m, 'const __ = ( text ) => text;' )
		.replace( /^import \{(.*)\} from '\.\.\/style-vars';$/m, '' );

	const shim = path.join( HERE, `.parity-${ suffix }.mjs` );
	writeFileSync( shim, source );
	temporaries.push( shim );

	return import( pathToFileURL( shim ).href );
}

let styleVars;
let presets;

try {
	styleVars = await loadModule( 'src/shared/style-vars.js', 'style-vars' );
	presets = await loadModule( 'src/shared/presets/index.js', 'presets' );
} finally {
	temporaries.forEach( ( file ) => unlinkSync( file ) );
}

const { buildStyleVars, buildWrapperClasses, buildButtonClasses } = styleVars;

// Case set one: single token values probing the edges of the CSS filter.
const tokenCases = JSON.parse(
	readFileSync( path.join( HERE, 'parity-cases.json' ), 'utf8' )
).map( ( testCase ) => ( {
	label: `${ testCase.group }.${ testCase.key } = ${ JSON.stringify( testCase.value ) }`,
	attributes: { [ testCase.group ]: { [ testCase.key ]: testCase.value } },
} ) );

// Case set two: the designs an author actually applies, in full.
const presetCases = presets.PRESETS.map( ( preset ) => ( {
	label: `preset "${ preset.name }"`,
	attributes: preset.attributes,
} ) );

// Case set three: the theme button opt-in, which suppresses a whole token family.
const optionCases = presets.PRESETS.map( ( preset ) => ( {
	label: `preset "${ preset.name }" with useThemeButton`,
	attributes: {
		...preset.attributes,
		fieldOptions: { ...( preset.attributes.fieldOptions || {} ), useThemeButton: true },
	},
} ) );

const cases = [ ...tokenCases, ...presetCases, ...optionCases ];

const casesFile = path.join( HERE, '.parity-cases.json' );
writeFileSync( casesFile, JSON.stringify( cases ) );

let phpResults;

try {
	phpResults = JSON.parse(
		execFileSync( 'php', [ path.join( HERE, 'parity-php.php' ), casesFile ], { encoding: 'utf8' } )
	);
} finally {
	unlinkSync( casesFile );
}

let mismatches = 0;

cases.forEach( ( testCase, index ) => {
	const php = phpResults[ index ];

	const js = {
		vars: Object.entries( buildStyleVars( testCase.attributes ) )
			.map( ( [ name, value ] ) => `${ name }:${ value }` )
			.join( ';' ),
		classes: buildWrapperClasses( testCase.attributes ),
		button: buildButtonClasses( testCase.attributes, 'login' ),
	};

	[ 'vars', 'classes', 'button' ].forEach( ( field ) => {
		if ( js[ field ] !== php[ field ] ) {
			mismatches += 1;
			console.error( `MISMATCH (${ field })  ${ testCase.label }` );
			console.error( `            editor:   ${ JSON.stringify( js[ field ] ) }` );
			console.error( `            renderer: ${ JSON.stringify( php[ field ] ) }` );
		}
	} );
} );

console.log(
	`\nparity: ${ cases.length } cases (${ tokenCases.length } token, ${ presetCases.length } preset, ${ optionCases.length } theme-button), ${ mismatches } mismatched.`
);

process.exit( mismatches > 0 ? 1 : 0 );
