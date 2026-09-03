/**
 * Wires one grouped object attribute to a ToolsPanel.
 *
 * The style settings are stored as a handful of object attributes
 * (labelStyles, inputStyles, buttonStyles, ...) rather than dozens of flat ones,
 * which keeps block.json and the design presets readable. The price of that
 * shape is that every ToolsPanelItem needs its own hasValue/onDeselect pair, so
 * this hook generates them.
 *
 * Only keys the user actually set are stored: clearing one deletes it, and
 * clearing the last one drops the whole group back to the block.json default of
 * {}. That is what makes buildStyleVars() able to emit nothing at all for an
 * untouched block, leaving the CSS defaults in charge.
 */

import { useCallback, useMemo } from '@wordpress/element';

const EMPTY = {};

/**
 * @param {string}   group               Attribute name, e.g. inputStyles.
 * @param {Object}   props               The block edit props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Block attribute setter.
 * @param {string}   props.clientId      Block client id, used as the panel id.
 * @return {Object} values, setKey, setMany, item and panel helpers.
 */
export function useStyleGroup(
	group,
	{ attributes, setAttributes, clientId }
) {
	const values = attributes[ group ] || EMPTY;

	const write = useCallback(
		( next ) => {
			setAttributes( {
				[ group ]: Object.keys( next ).length ? next : undefined,
			} );
		},
		[ group, setAttributes ]
	);

	const setKey = useCallback(
		( key, value ) => {
			const next = { ...values };

			if ( value === undefined || value === null || value === '' ) {
				delete next[ key ];
			} else {
				next[ key ] = value;
			}

			write( next );
		},
		[ values, write ]
	);

	const setMany = useCallback(
		( patch ) => {
			const next = { ...values };

			Object.entries( patch ).forEach( ( [ key, value ] ) => {
				if ( value === undefined || value === null || value === '' ) {
					delete next[ key ];
				} else {
					next[ key ] = value;
				}
			} );

			write( next );
		},
		[ values, write ]
	);

	/**
	 * Props for one ToolsPanelItem. Spread it: <ToolsPanelItem { ...item( 'radius', { label } ) }>
	 */
	const item = useCallback(
		( key, { label, isShownByDefault = false } = {} ) => ( {
			panelId: clientId,
			label,
			isShownByDefault,
			hasValue: () => values[ key ] !== undefined,
			onDeselect: () => setKey( key, undefined ),
		} ),
		[ values, setKey, clientId ]
	);

	/**
	 * Props for the ToolsPanel itself. Because resetAll clears the whole group in
	 * one write, the individual items need no resetAllFilter.
	 */
	const panel = useMemo(
		() => ( {
			panelId: clientId,
			resetAll: () => setAttributes( { [ group ]: undefined } ),
		} ),
		[ clientId, group, setAttributes ]
	);

	return { values, setKey, setMany, item, panel };
}

/**
 * The same idea for the plain option group, which holds booleans and keywords
 * rather than style tokens and so is edited with ordinary toggles.
 *
 * @param {Object}   props               The block edit props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Block attribute setter.
 * @param {string}   group               Attribute name, defaults to fieldOptions.
 * @return {Object} setOption helper.
 */
export function useOptionGroup(
	{ attributes, setAttributes },
	group = 'fieldOptions'
) {
	const values = attributes[ group ] || EMPTY;

	const setOption = useCallback(
		( key, value ) => {
			setAttributes( { [ group ]: { ...values, [ key ]: value } } );
		},
		[ values, group, setAttributes ]
	);

	return { setOption };
}
