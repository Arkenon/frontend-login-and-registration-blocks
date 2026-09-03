/**
 * Editor side counterpart of inc/class-flr-blocks-style.php.
 *
 * Both read the same token map from flr-style-tokens.json and must reach the
 * same verdict on every value, because the whole design rests on the editor
 * preview and the rendered page agreeing. The PHP side delegates to core's
 * safecss_filter_attr(); this file reimplements the parts of that function that
 * apply to custom properties, because JavaScript regular expressions have no
 * recursive subpatterns and core's function stripper relies on one.
 *
 * Where the two could ever disagree, this side is deliberately the stricter of
 * the pair: the editor showing slightly less than the front end is harmless,
 * while the editor promising something the front end drops is the exact bug
 * this architecture exists to prevent.
 */

import tokenMap from '../../flr-style-tokens.json';

/**
 * CSS functions core removes from the value before testing it.
 * Kept in the order and spelling of wp-includes/kses.php.
 */
const ALLOWED_FUNCTIONS = [
	// General purpose value functions.
	'var',
	'calc',
	'min',
	'max',
	'minmax',
	'clamp',
	'repeat',
	// Transform functions.
	'matrix',
	'matrix3d',
	'perspective',
	'rotate',
	'rotate3d',
	'rotateX',
	'rotateY',
	'rotateZ',
	'scale',
	'scale3d',
	'scaleX',
	'scaleY',
	'scaleZ',
	'skew',
	'skewX',
	'skewY',
	'translate',
	'translate3d',
	'translateX',
	'translateY',
	'translateZ',
	// Basic shape functions.
	'circle',
	'ellipse',
	'inset',
	'path',
	'polygon',
	'rect',
	'shape',
	'xywh',
	// Gradients, which core strips separately but treats the same way.
	'linear-gradient',
	'radial-gradient',
	'conic-gradient',
	'repeating-linear-gradient',
	'repeating-radial-gradient',
	'repeating-conic-gradient',
];

/** Anything left after stripping those makes core discard the declaration. */
const FORBIDDEN = /[\\(&=}]|\/\*/;

const LENGTH_PATTERN =
	/^[+-]?(?:\d+\.?\d*|\.\d+)(?:px|em|rem|%|vw|vh|vmin|vmax|ch|ex|pt|pc|cm|mm|in)?$/;
const COLOR_PATTERN =
	/^(?:#(?:[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})|[a-z]+)$/i;
const BORDER_STYLES = [
	'none',
	'hidden',
	'solid',
	'dashed',
	'dotted',
	'double',
	'groove',
	'ridge',
	'inset',
	'outset',
];

const EMPTY = {};

/**
 * Remove every allowed function call, parentheses included, from a value.
 *
 * Stands in for core's recursive `\b(name)(\((?:[^()]|(?1))*\))` regex. A call
 * whose parentheses do not balance is left in place, so the forbidden character
 * test below rejects it, exactly as core does.
 *
 * @param {string} value Raw token value.
 * @return {string} The value with allowed function calls removed.
 */
function stripAllowedFunctions( value ) {
	let result = '';
	let index = 0;

	while ( index < value.length ) {
		const remainder = value.slice( index );
		const match = /^[a-zA-Z][a-zA-Z0-9-]*\(/.exec( remainder );
		const name = match ? match[ 0 ].slice( 0, -1 ) : null;

		if ( ! name || ! ALLOWED_FUNCTIONS.includes( name ) ) {
			result += value[ index ];
			index += 1;
			continue;
		}

		// Walk to the parenthesis that closes this call.
		let depth = 0;
		let cursor = index + name.length;

		for ( ; cursor < value.length; cursor += 1 ) {
			if ( value[ cursor ] === '(' ) {
				depth += 1;
			} else if ( value[ cursor ] === ')' ) {
				depth -= 1;
				if ( depth === 0 ) {
					break;
				}
			}
		}

		if ( depth !== 0 ) {
			// Unbalanced: leave it alone so it fails the forbidden test.
			result += value[ index ];
			index += 1;
			continue;
		}

		index = cursor + 1;
	}

	return result;
}

/**
 * Whether a value survives core's CSS attribute filter untouched.
 *
 * @param {string} value Token value.
 * @return {boolean} True when the front end would keep it.
 */
function survivesCssFilter( value ) {
	return ! FORBIDDEN.test( stripAllowedFunctions( value ) );
}

/**
 * Whether a value is a CSS function expression core allows.
 *
 * @param {string} value Token value.
 * @return {boolean} True for something like var(--x) or clamp(1rem, 2vw, 3rem).
 */
function isFunctionExpression( value ) {
	return value.includes( '(' ) && survivesCssFilter( value );
}

/**
 * Validate one token value against its declared type.
 *
 * @param {string} type  Token type from the map.
 * @param {*}      value Raw attribute value.
 * @param {Object} token Token definition, for its allow list.
 * @return {string|null} The value to emit, or null to drop it.
 */
export function sanitizeValue( type, value, token = EMPTY ) {
	if ( typeof value !== 'string' && typeof value !== 'number' ) {
		return null;
	}

	const candidate = String( value ).trim();

	if ( candidate === '' ) {
		return null;
	}

	// A single declaration only: a semicolon would smuggle in a second one.
	// url() is refused outright so both sides agree without having to model
	// core's protocol checks.
	if (
		candidate.includes( ';' ) ||
		candidate.toLowerCase().includes( 'url(' )
	) {
		return null;
	}

	switch ( type ) {
		case 'keyword': {
			const allow = token.allow || [];
			return allow.length === 0 || allow.includes( candidate )
				? candidate
				: null;
		}

		case 'number':
			return isFinite( Number( candidate ) ) && candidate !== ''
				? candidate
				: null;

		case 'length':
			return LENGTH_PATTERN.test( candidate ) ||
				isFunctionExpression( candidate )
				? candidate
				: null;

		case 'color':
			return COLOR_PATTERN.test( candidate ) ||
				isFunctionExpression( candidate )
				? candidate
				: null;

		case 'shadow':
			// Shadows are free form; the core filter rules are the real gate.
			return survivesCssFilter( candidate ) ? candidate : null;

		default:
			return null;
	}
}

/**
 * Expand a BorderControl value into its custom properties.
 *
 * @param {*}      border Border value from the editor.
 * @param {Object} token  Token definition holding the three var names.
 * @return {Object} Custom property map.
 */
function borderVars( border, token ) {
	if ( ! border || typeof border !== 'object' ) {
		return EMPTY;
	}

	const types = { color: 'color', width: 'length', style: 'keyword' };
	const vars = {};

	Object.entries( types ).forEach( ( [ side, type ] ) => {
		if ( border[ side ] === undefined || ! token.vars?.[ side ] ) {
			return;
		}

		const value = sanitizeValue(
			type,
			border[ side ],
			side === 'style' ? { allow: BORDER_STYLES } : EMPTY
		);

		if ( value !== null ) {
			vars[ token.vars[ side ] ] = value;
		}
	} );

	return vars;
}

/**
 * Merge the saved option overrides for a block onto the shared defaults.
 *
 * @param {Object} attributes Block attributes.
 * @param {string} group      Option group name.
 * @return {Object} Resolved options.
 */
export function resolveOptions( attributes, group = 'fieldOptions' ) {
	return {
		...( tokenMap.options?.[ group ] || EMPTY ),
		...( attributes?.[ group ] || EMPTY ),
	};
}

/**
 * Build the inline custom property map for a block wrapper.
 *
 * React writes `--flr-*` keys through verbatim, so this object can be handed
 * straight to useBlockProps as its `style`. Only values the user actually set
 * are emitted; every default lives in public/css/flr-blocks-forms.css.
 *
 * @param {Object} attributes Block attributes.
 * @return {Object} Custom property map for a style prop.
 */
export function buildStyleVars( attributes = EMPTY ) {
	const vars = {};

	Object.entries( tokenMap.groups ).forEach( ( [ group, tokens ] ) => {
		const values = attributes[ group ];

		if ( ! values || typeof values !== 'object' ) {
			return;
		}

		Object.entries( tokens ).forEach( ( [ key, token ] ) => {
			if ( ! ( key in values ) ) {
				return;
			}

			if ( token.type === 'border' ) {
				Object.assign( vars, borderVars( values[ key ], token ) );
				return;
			}

			const value = sanitizeValue( token.type, values[ key ], token );

			if ( value !== null ) {
				vars[ token.var ] = value;
			}
		} );
	} );

	// When the theme owns the button its tokens must not be emitted at all: an
	// unresolvable var() falls back to the property's initial value rather than
	// to the theme rule, so a half applied set would break the button.
	if ( resolveOptions( attributes ).useThemeButton ) {
		Object.keys( vars ).forEach( ( name ) => {
			if ( name.startsWith( '--flr-button-' ) ) {
				delete vars[ name ];
			}
		} );
	}

	return vars;
}

/**
 * Plugin owned class names for the block wrapper.
 *
 * Mirrors Flr_Blocks_Style::classes().
 *
 * @param {Object} attributes Block attributes.
 * @return {string} Space separated class list.
 */
export function buildWrapperClasses( attributes = EMPTY ) {
	const options = resolveOptions( attributes );
	const classes = [ 'flr-blocks-form-wrapper' ];

	const preset = String( attributes.preset || '' ).replace(
		/[^A-Za-z0-9_-]/g,
		''
	);

	if ( preset ) {
		classes.push( `flr-preset-${ preset }` );
	}

	if ( [ 'inline', 'hidden' ].includes( options.labelPosition ) ) {
		classes.push( `flr-labels-${ options.labelPosition }` );
	}

	if ( options.useThemeButton ) {
		classes.push( 'flr-theme-button' );
	}

	if ( options.requiredMark ) {
		classes.push( 'flr-required-marks' );
	}

	return classes.join( ' ' );
}

/**
 * Class list for a submit button, matching Flr_Blocks_Style::button_class().
 *
 * @param {Object} attributes Block attributes.
 * @param {string} variant    Button variant, e.g. login or register.
 * @return {string} Space separated class list.
 */
export function buildButtonClasses( attributes = EMPTY, variant ) {
	const classes = [ `flr-blocks-${ variant }-btn`, 'flr-blocks-btn' ];

	if ( resolveOptions( attributes ).useThemeButton ) {
		classes.push( 'wp-block-button__link', 'wp-element-button' );
	}

	return classes.join( ' ' );
}

/**
 * A user supplied text override, falling back to the translated default.
 *
 * @param {Object} attributes Block attributes.
 * @param {string} group      Attribute group, e.g. labels or placeholders.
 * @param {string} key        Key within the group.
 * @param {string} fallback   Translated default.
 * @return {string} Text to render.
 */
export function resolveText( attributes = EMPTY, group, key, fallback ) {
	const saved = attributes[ group ]?.[ key ];

	return typeof saved === 'string' && saved.trim() !== '' ? saved : fallback;
}

export { tokenMap };
