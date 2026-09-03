/**
 * Surfaces the designs as block variations.
 *
 * Scope is inserter and transform, not block: there is no generic core
 * mechanism that renders a picker for block scoped variations, so the setup
 * screen handles that case itself. What this adds is a way to drop a
 * pre-designed form straight from the inserter, and a Transform menu entry for
 * switching design later.
 *
 * Each preset's attributes already carry templateChosen, so a block inserted
 * this way skips the setup screen with no special casing.
 */

import { registerBlockVariation } from '@wordpress/blocks';
import { PRESETS } from './index';

/**
 * @param {string}  blockName Fully qualified block name.
 * @param {Element} icon      Icon to show against each variation.
 */
export function registerPresetVariations( blockName, icon ) {
	PRESETS.forEach( ( preset ) => {
		registerBlockVariation( blockName, {
			name: preset.name,
			title: preset.title,
			description: preset.description,
			icon,
			scope: [ 'inserter', 'transform' ],
			attributes: preset.attributes,
			// Matching on the preset attribute alone is what makes the active
			// design show as selected in the inspector and the transform menu.
			isActive: [ 'preset' ],
		} );
	} );
}
