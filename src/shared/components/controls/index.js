/**
 * The one place the editor's experimental APIs are named.
 *
 * Several of the controls this plugin needs are still exported under an
 * __experimental prefix. They have been stable for years and current core still
 * exports the prefixed aliases, but funnelling every one of them through this
 * module means a future rename is a one file change rather than a hunt through
 * a dozen panels.
 *
 * The unprefixed aliases (BorderControl, BoxControl, ...) only appeared in
 * WordPress 6.6, so the prefixed names are the ones to use while 6.5 is the
 * supported floor.
 */

export {
	__experimentalToolsPanel as ToolsPanel,
	__experimentalToolsPanelItem as ToolsPanelItem,
	__experimentalBorderControl as BorderControl,
	__experimentalUnitControl as UnitControl,
	__experimentalBoxControl as BoxControl,
	__experimentalToggleGroupControl as ToggleGroupControl,
	__experimentalToggleGroupControlOption as ToggleGroupControlOption,
	__experimentalHStack as HStack,
	__experimentalVStack as VStack,
	__experimentalText as Text,
} from '@wordpress/components';

export {
	__experimentalColorGradientSettingsDropdown as ColorGradientSettingsDropdown,
	__experimentalUseMultipleOriginColorsAndGradients as useMultipleOriginColorsAndGradients,
} from '@wordpress/block-editor';

/** Units offered wherever a length has no more specific set. */
export const LENGTH_UNITS = [
	{ value: 'px', label: 'px', default: 0 },
	{ value: 'em', label: 'em', default: 0 },
	{ value: 'rem', label: 'rem', default: 0 },
	{ value: '%', label: '%', default: 0 },
];

/** Font weights offered by the label and button panels. */
export const FONT_WEIGHTS = [
	{ label: 'Thin', value: '100' },
	{ label: 'Light', value: '300' },
	{ label: 'Regular', value: '400' },
	{ label: 'Medium', value: '500' },
	{ label: 'Semi bold', value: '600' },
	{ label: 'Bold', value: '700' },
	{ label: 'Extra bold', value: '800' },
];
