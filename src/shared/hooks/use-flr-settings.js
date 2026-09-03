/**
 * Reads theme.json settings without tying the plugin to one WordPress version.
 *
 * useSettings (plural, variadic) landed in @wordpress/block-editor 12.14, which
 * shipped in WordPress 6.5 -- the version this plugin now requires. The single
 * path useSetting it replaced is deprecated but still exported, so falling back
 * to it costs four lines and keeps the blocks working on an older editor rather
 * than throwing.
 *
 * This also replaces the previous approach entirely: v1 fetched the active
 * theme's theme.json over HTTP from inside a useSelect mapper, which produced an
 * empty palette on classic themes and ignored the way core layers the default,
 * theme and user palettes together.
 */

import * as blockEditor from '@wordpress/block-editor';

/**
 * @param {...string} paths Setting paths, e.g. 'spacing.units'.
 * @return {Array} One resolved value per path, in order.
 */
export function useFlrSettings( ...paths ) {
	if ( typeof blockEditor.useSettings === 'function' ) {
		return blockEditor.useSettings( ...paths );
	}

	// The branch is decided by the bundled editor package and cannot change
	// during the life of the page, so the hook count stays stable.
	return paths.map( ( path ) => blockEditor.useSetting( path ) );
}
