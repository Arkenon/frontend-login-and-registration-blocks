#!/usr/bin/env node
/**
 * Guards the contract between flr-style-tokens.json and the shared stylesheet.
 *
 * The token map is the single source of truth shared by the editor
 * (src/shared/style-vars.js) and the renderer (inc/class-flr-blocks-style.php),
 * but a token only does anything if the CSS both declares a default for it and
 * consumes it somewhere. This catches the "added a token, forgot the CSS" case,
 * and the reverse.
 *
 * Custom property names must also match the pattern core's safecss_filter_attr()
 * accepts, or the declaration is dropped from the rendered style attribute.
 */

const fs = require( 'fs' );
const path = require( 'path' );

const root = path.join( __dirname, '..' );
const TOKENS = path.join( root, 'flr-style-tokens.json' );
const STYLESHEET = path.join( root, 'public', 'css', 'flr-blocks-forms.css' );

// Mirrors the check in safecss_filter_attr(): /^--[a-zA-Z0-9-_]+$/
const NAME_PATTERN = /^--[a-zA-Z0-9-_]+$/;

const errors = [];

const map = JSON.parse( fs.readFileSync( TOKENS, 'utf8' ) );
const css = fs.readFileSync( STYLESHEET, 'utf8' );

// Collect every custom property the token map can emit.
const declared = [];

for ( const [ group, tokens ] of Object.entries( map.groups ) ) {
	for ( const [ key, token ] of Object.entries( tokens ) ) {
		if ( token.type === 'border' ) {
			for ( const name of Object.values( token.vars ) ) {
				declared.push( { name, where: `${ group }.${ key }` } );
			}
		} else if ( token.var ) {
			declared.push( { name: token.var, where: `${ group }.${ key }` } );
		} else {
			errors.push( `${ group }.${ key }: no "var" and not type "border"` );
		}
	}
}

const seen = new Set();

for ( const { name, where } of declared ) {
	if ( ! NAME_PATTERN.test( name ) ) {
		errors.push( `${ where }: "${ name }" would be dropped by safecss_filter_attr()` );
	}

	if ( seen.has( name ) ) {
		errors.push( `${ where }: "${ name }" is declared by more than one token` );
	}
	seen.add( name );

	// A default, i.e. `--flr-x: value;` somewhere in the stylesheet.
	if ( ! new RegExp( `^\\s*${ name }\\s*:`, 'm' ).test( css ) ) {
		errors.push( `${ where }: "${ name }" has no default in flr-blocks-forms.css` );
	}

	// A consuming rule, i.e. `var(--flr-x)`.
	if ( ! css.includes( `var(${ name })` ) ) {
		errors.push( `${ where }: "${ name }" is never consumed by a rule in flr-blocks-forms.css` );
	}
}

// The reverse: a --flr-* default in the CSS that no token can ever set is dead weight.
const inCss = new Set( ( css.match( /^\s*(--flr-[a-zA-Z0-9-_]+)\s*:/gm ) || [] ).map( ( line ) => line.trim().split( ':' )[ 0 ] ) );

for ( const name of inCss ) {
	if ( ! seen.has( name ) ) {
		errors.push( `flr-blocks-forms.css: "${ name }" has a default but no token in flr-style-tokens.json can set it` );
	}
}

if ( errors.length ) {
	console.error( `\ntoken lint failed (${ errors.length } problem${ errors.length === 1 ? '' : 's' }):\n` );
	errors.forEach( ( error ) => console.error( `  - ${ error }` ) );
	console.error( '' );
	process.exit( 1 );
}

console.log( `token lint passed: ${ declared.length } custom properties, each with a default and a consuming rule.` );
