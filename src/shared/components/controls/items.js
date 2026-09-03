/**
 * Small ToolsPanelItem wrappers.
 *
 * Every style control follows the same shape: a ToolsPanelItem whose hasValue
 * and onDeselect come from useStyleGroup, wrapping one input bound to one key of
 * that group. These components carry that shape so the six panels can read as a
 * list of settings rather than a wall of boilerplate.
 *
 * All of them take the object returned by useStyleGroup as `styleGroup`.
 */

import { __ } from '@wordpress/i18n';
import { SelectControl, TextControl } from '@wordpress/components';
import {
	ToolsPanelItem,
	BorderControl,
	UnitControl,
	ToggleGroupControl,
	ToggleGroupControlOption,
	LENGTH_UNITS,
} from './index';

/**
 * A length, edited with a unit picker.
 *
 * @param {Object}  props                    Component props.
 * @param {Object}  props.styleGroup         Result of useStyleGroup for this group.
 * @param {string}  props.tokenKey           Key within the group.
 * @param {string}  props.label              Control label.
 * @param {Array}   [props.units]            Units to offer.
 * @param {number}  [props.min]              Smallest allowed value.
 * @param {number}  [props.max]              Largest allowed value.
 * @param {boolean} [props.isShownByDefault] Show without opening the panel menu.
 * @return {Element} The control.
 */
export function SizeItem( {
	styleGroup,
	tokenKey,
	label,
	units = LENGTH_UNITS,
	min = 0,
	max,
	isShownByDefault = false,
} ) {
	const { values, setKey, item } = styleGroup;

	return (
		<ToolsPanelItem { ...item( tokenKey, { label, isShownByDefault } ) }>
			<UnitControl
				__next40pxDefaultSize
				label={ label }
				value={ values[ tokenKey ] }
				units={ units }
				min={ min }
				max={ max }
				onChange={ ( value ) => setKey( tokenKey, value ) }
			/>
		</ToolsPanelItem>
	);
}

/**
 * A keyword, edited with a dropdown.
 *
 * @param {Object}  props                    Component props.
 * @param {Object}  props.styleGroup         Result of useStyleGroup for this group.
 * @param {string}  props.tokenKey           Key within the group.
 * @param {string}  props.label              Control label.
 * @param {Array}   props.options            Choices, as [{ label, value }].
 * @param {boolean} [props.isShownByDefault] Show without opening the panel menu.
 * @return {Element} The control.
 */
export function SelectItem( {
	styleGroup,
	tokenKey,
	label,
	options,
	isShownByDefault = false,
} ) {
	const { values, setKey, item } = styleGroup;

	return (
		<ToolsPanelItem { ...item( tokenKey, { label, isShownByDefault } ) }>
			<SelectControl
				__next40pxDefaultSize
				__nextHasNoMarginBottom
				label={ label }
				value={ values[ tokenKey ] ?? '' }
				options={ [
					{
						label: __(
							'Default',
							'frontend-login-and-registration-blocks'
						),
						value: '',
					},
					...options,
				] }
				onChange={ ( value ) => setKey( tokenKey, value ) }
			/>
		</ToolsPanelItem>
	);
}

/**
 * A short keyword list, edited with a segmented control.
 *
 * @param {Object}  props                    Component props.
 * @param {Object}  props.styleGroup         Result of useStyleGroup for this group.
 * @param {string}  props.tokenKey           Key within the group.
 * @param {string}  props.label              Control label.
 * @param {Array}   props.options            Choices, as [{ label, value }].
 * @param {boolean} [props.isShownByDefault] Show without opening the panel menu.
 * @return {Element} The control.
 */
export function ToggleGroupItem( {
	styleGroup,
	tokenKey,
	label,
	options,
	isShownByDefault = false,
} ) {
	const { values, setKey, item } = styleGroup;

	return (
		<ToolsPanelItem { ...item( tokenKey, { label, isShownByDefault } ) }>
			<ToggleGroupControl
				__next40pxDefaultSize
				__nextHasNoMarginBottom
				isBlock
				label={ label }
				value={ values[ tokenKey ] }
				onChange={ ( value ) => setKey( tokenKey, value ) }
			>
				{ options.map( ( option ) => (
					<ToggleGroupControlOption
						key={ option.value }
						value={ option.value }
						label={ option.label }
					/>
				) ) }
			</ToggleGroupControl>
		</ToolsPanelItem>
	);
}

/**
 * A border, edited with colour, width and style together.
 *
 * Only the single (non split) BorderControl is used: a split border would have
 * to expand into twelve custom properties for no gain on a form field.
 *
 * @param {Object}  props                    Component props.
 * @param {Object}  props.styleGroup         Result of useStyleGroup for this group.
 * @param {string}  [props.tokenKey]         Key within the group.
 * @param {string}  props.label              Control label.
 * @param {Array}   props.colors             Palette, from the colour settings hook.
 * @param {boolean} [props.isShownByDefault] Show without opening the panel menu.
 * @return {Element} The control.
 */
export function BorderItem( {
	styleGroup,
	tokenKey = 'border',
	label,
	colors,
	isShownByDefault = false,
} ) {
	const { values, setKey, item } = styleGroup;

	return (
		<ToolsPanelItem { ...item( tokenKey, { label, isShownByDefault } ) }>
			<BorderControl
				__next40pxDefaultSize
				label={ label }
				colors={ colors }
				value={ values[ tokenKey ] }
				onChange={ ( value ) => setKey( tokenKey, value ) }
				enableAlpha
				enableStyle
				withSlider
			/>
		</ToolsPanelItem>
	);
}

/**
 * A raw CSS shadow.
 *
 * Kept as a text field on purpose: core's ShadowControl only reaches the theme's
 * shadow presets, while a preset here needs an arbitrary value. The help text
 * spells out the one rule that is not obvious -- alpha has to be written as
 * 8 digit hex, because core's style attribute filter discards any declaration
 * still containing rgba().
 *
 * @param {Object}  props                    Component props.
 * @param {Object}  props.styleGroup         Result of useStyleGroup for this group.
 * @param {string}  props.tokenKey           Key within the group.
 * @param {string}  props.label              Control label.
 * @param {boolean} [props.isShownByDefault] Show without opening the panel menu.
 * @return {Element} The control.
 */
export function ShadowItem( {
	styleGroup,
	tokenKey,
	label,
	isShownByDefault = false,
} ) {
	const { values, setKey, item } = styleGroup;

	return (
		<ToolsPanelItem { ...item( tokenKey, { label, isShownByDefault } ) }>
			<TextControl
				__next40pxDefaultSize
				__nextHasNoMarginBottom
				label={ label }
				value={ values[ tokenKey ] ?? '' }
				placeholder="0 2px 8px #0000001a"
				help={ __(
					'CSS shadow value. Write transparency as 8 digit hex, for example #0000001a, because rgba() cannot be saved to a block style.',
					'frontend-login-and-registration-blocks'
				) }
				onChange={ ( value ) => setKey( tokenKey, value ) }
			/>
		</ToolsPanelItem>
	);
}
