/**
 * The six style panels shared by every form block.
 *
 * Each one drives a single grouped attribute through useStyleGroup, so a panel
 * is a list of settings rather than a pile of state wiring. Colour controls come
 * from useMultipleOriginColorsAndGradients(), which layers the default, theme
 * and user palettes the way core does -- on classic themes as well as block
 * themes. That replaces v1's fetch of the raw theme.json file, which returned
 * nothing at all unless the site ran a block theme.
 */

import { __ } from '@wordpress/i18n';
import { Notice } from '@wordpress/components';
import {
	ToolsPanel,
	ColorGradientSettingsDropdown,
	useMultipleOriginColorsAndGradients,
	FONT_WEIGHTS,
} from '../controls';
import {
	SizeItem,
	SelectItem,
	ToggleGroupItem,
	BorderItem,
	ShadowItem,
} from '../controls/items';
import { useStyleGroup } from '../../hooks/use-style-group';
import { resolveOptions } from '../../style-vars';

const TEXT_TRANSFORMS = [
	{
		label: __( 'None', 'frontend-login-and-registration-blocks' ),
		value: 'none',
	},
	{
		label: __( 'Uppercase', 'frontend-login-and-registration-blocks' ),
		value: 'uppercase',
	},
	{
		label: __( 'Lowercase', 'frontend-login-and-registration-blocks' ),
		value: 'lowercase',
	},
	{
		label: __( 'Capitalize', 'frontend-login-and-registration-blocks' ),
		value: 'capitalize',
	},
];

const DECORATIONS = [
	{
		label: __( 'None', 'frontend-login-and-registration-blocks' ),
		value: 'none',
	},
	{
		label: __( 'Underline', 'frontend-login-and-registration-blocks' ),
		value: 'underline',
	},
];

/**
 * Colour dropdowns for one style group.
 *
 * Each entry becomes its own ToolsPanelItem; the component does that wrapping
 * itself as long as it is handed a panelId.
 *
 * @param {Object} props               Component props.
 * @param {Object} props.styleGroup    Result of useStyleGroup for this group.
 * @param {string} props.panelId       Client id of the owning ToolsPanel.
 * @param {Object} props.colorSettings Result of the multi origin colour hook.
 * @param {Array}  props.settings      One entry per colour, as [{ tokenKey, label, isShownByDefault }].
 * @return {Element} The colour controls.
 */
function ColorGroup( { styleGroup, panelId, colorSettings, settings } ) {
	const { values, setKey } = styleGroup;

	return (
		<ColorGradientSettingsDropdown
			__experimentalIsRenderedInSidebar
			panelId={ panelId }
			{ ...colorSettings }
			gradients={ [] }
			disableCustomGradients
			enableAlpha
			settings={ settings.map( ( setting ) => ( {
				label: setting.label,
				colorValue: values[ setting.tokenKey ],
				onColorChange: ( value ) => setKey( setting.tokenKey, value ),
				isShownByDefault: setting.isShownByDefault ?? false,
			} ) ) }
		/>
	);
}

/**
 * Overall form width, field rhythm and the card shadow.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function LayoutPanel( props ) {
	const styleGroup = useStyleGroup( 'layoutStyles', props );

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __(
				'Form layout',
				'frontend-login-and-registration-blocks'
			) }
		>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="maxWidth"
				label={ __(
					'Maximum width',
					'frontend-login-and-registration-blocks'
				) }
				isShownByDefault
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fieldGap"
				label={ __(
					'Space between fields',
					'frontend-login-and-registration-blocks'
				) }
				isShownByDefault
			/>
			<ShadowItem
				styleGroup={ styleGroup }
				tokenKey="cardShadow"
				label={ __(
					'Card shadow',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</ToolsPanel>
	);
}

/**
 * Field label typography.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function LabelPanel( props ) {
	const styleGroup = useStyleGroup( 'labelStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __( 'Labels', 'frontend-login-and-registration-blocks' ) }
		>
			<ColorGroup
				styleGroup={ styleGroup }
				panelId={ props.clientId }
				colorSettings={ colorSettings }
				settings={ [
					{
						tokenKey: 'color',
						label: __(
							'Text',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'requiredColor',
						label: __(
							'Required marker',
							'frontend-login-and-registration-blocks'
						),
					},
				] }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fontSize"
				label={ __( 'Size', 'frontend-login-and-registration-blocks' ) }
				isShownByDefault
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="fontWeight"
				label={ __(
					'Weight',
					'frontend-login-and-registration-blocks'
				) }
				options={ FONT_WEIGHTS }
				isShownByDefault
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="textTransform"
				label={ __(
					'Letter case',
					'frontend-login-and-registration-blocks'
				) }
				options={ TEXT_TRANSFORMS }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="letterSpacing"
				label={ __(
					'Letter spacing',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="gap"
				label={ __(
					'Space below label',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</ToolsPanel>
	);
}

/**
 * Input fields, including the states v1 had no way to reach at all.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function InputPanel( props ) {
	const styleGroup = useStyleGroup( 'inputStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __(
				'Input fields',
				'frontend-login-and-registration-blocks'
			) }
		>
			<ColorGroup
				styleGroup={ styleGroup }
				panelId={ props.clientId }
				colorSettings={ colorSettings }
				settings={ [
					{
						tokenKey: 'color',
						label: __(
							'Text',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'bg',
						label: __(
							'Background',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'placeholderColor',
						label: __(
							'Placeholder',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'focusBorderColor',
						label: __(
							'Focus outline',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'focusBg',
						label: __(
							'Focus background',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'disabledBg',
						label: __(
							'Disabled background',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'disabledColor',
						label: __(
							'Disabled text',
							'frontend-login-and-registration-blocks'
						),
					},
				] }
			/>
			<BorderItem
				styleGroup={ styleGroup }
				label={ __(
					'Border',
					'frontend-login-and-registration-blocks'
				) }
				colors={ colorSettings.colors }
				isShownByDefault
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="radius"
				label={ __(
					'Corner radius',
					'frontend-login-and-registration-blocks'
				) }
				isShownByDefault
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="paddingBlock"
				label={ __(
					'Vertical padding',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="paddingInline"
				label={ __(
					'Horizontal padding',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fontSize"
				label={ __(
					'Text size',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<ShadowItem
				styleGroup={ styleGroup }
				tokenKey="shadow"
				label={ __(
					'Shadow',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<ShadowItem
				styleGroup={ styleGroup }
				tokenKey="focusShadow"
				label={ __(
					'Focus ring',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</ToolsPanel>
	);
}

/**
 * The submit button.
 *
 * When the author hands the button back to the theme there is nothing to style
 * here, and showing dead controls would be worse than saying so: an
 * unresolvable custom property falls back to the CSS initial value rather than
 * to the theme's rule, so the tokens have to be suppressed wholesale.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function ButtonPanel( props ) {
	const styleGroup = useStyleGroup( 'buttonStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	if ( resolveOptions( props.attributes ).useThemeButton ) {
		return (
			<ToolsPanel
				{ ...styleGroup.panel }
				label={ __(
					'Submit button',
					'frontend-login-and-registration-blocks'
				) }
			>
				<Notice status="info" isDismissible={ false }>
					{ __(
						'This button uses your theme’s button style. Turn off "Use theme button style" in Settings to style it here.',
						'frontend-login-and-registration-blocks'
					) }
				</Notice>
			</ToolsPanel>
		);
	}

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __(
				'Submit button',
				'frontend-login-and-registration-blocks'
			) }
		>
			<ColorGroup
				styleGroup={ styleGroup }
				panelId={ props.clientId }
				colorSettings={ colorSettings }
				settings={ [
					{
						tokenKey: 'bg',
						label: __(
							'Background',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'color',
						label: __(
							'Text',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'bgHover',
						label: __(
							'Background on hover',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'colorHover',
						label: __(
							'Text on hover',
							'frontend-login-and-registration-blocks'
						),
					},
					{
						tokenKey: 'borderColorHover',
						label: __(
							'Border on hover',
							'frontend-login-and-registration-blocks'
						),
					},
				] }
			/>
			<ToggleGroupItem
				styleGroup={ styleGroup }
				tokenKey="width"
				label={ __(
					'Width',
					'frontend-login-and-registration-blocks'
				) }
				options={ [
					{
						label: __(
							'Full',
							'frontend-login-and-registration-blocks'
						),
						value: '100%',
					},
					{
						label: __(
							'Fit',
							'frontend-login-and-registration-blocks'
						),
						value: 'auto',
					},
				] }
				isShownByDefault
			/>
			<ToggleGroupItem
				styleGroup={ styleGroup }
				tokenKey="justify"
				label={ __(
					'Alignment',
					'frontend-login-and-registration-blocks'
				) }
				options={ [
					{
						label: __(
							'Left',
							'frontend-login-and-registration-blocks'
						),
						value: 'flex-start',
					},
					{
						label: __(
							'Center',
							'frontend-login-and-registration-blocks'
						),
						value: 'center',
					},
					{
						label: __(
							'Right',
							'frontend-login-and-registration-blocks'
						),
						value: 'flex-end',
					},
					{
						label: __(
							'Stretch',
							'frontend-login-and-registration-blocks'
						),
						value: 'stretch',
					},
				] }
			/>
			<BorderItem
				styleGroup={ styleGroup }
				label={ __(
					'Border',
					'frontend-login-and-registration-blocks'
				) }
				colors={ colorSettings.colors }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="radius"
				label={ __(
					'Corner radius',
					'frontend-login-and-registration-blocks'
				) }
				isShownByDefault
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="paddingBlock"
				label={ __(
					'Vertical padding',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="paddingInline"
				label={ __(
					'Horizontal padding',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fontSize"
				label={ __(
					'Text size',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="fontWeight"
				label={ __(
					'Weight',
					'frontend-login-and-registration-blocks'
				) }
				options={ FONT_WEIGHTS }
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="textTransform"
				label={ __(
					'Letter case',
					'frontend-login-and-registration-blocks'
				) }
				options={ TEXT_TRANSFORMS }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="letterSpacing"
				label={ __(
					'Letter spacing',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<ShadowItem
				styleGroup={ styleGroup }
				tokenKey="shadow"
				label={ __(
					'Shadow',
					'frontend-login-and-registration-blocks'
				) }
			/>
			<ShadowItem
				styleGroup={ styleGroup }
				tokenKey="shadowHover"
				label={ __(
					'Shadow on hover',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</ToolsPanel>
	);
}

/**
 * The secondary links below the form.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function LinkPanel( props ) {
	const styleGroup = useStyleGroup( 'linkStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __( 'Links', 'frontend-login-and-registration-blocks' ) }
		>
			<ColorGroup
				styleGroup={ styleGroup }
				panelId={ props.clientId }
				colorSettings={ colorSettings }
				settings={ [
					{
						tokenKey: 'color',
						label: __(
							'Text',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
					{
						tokenKey: 'colorHover',
						label: __(
							'Text on hover',
							'frontend-login-and-registration-blocks'
						),
					},
				] }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fontSize"
				label={ __( 'Size', 'frontend-login-and-registration-blocks' ) }
				isShownByDefault
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="decoration"
				label={ __(
					'Underline',
					'frontend-login-and-registration-blocks'
				) }
				options={ DECORATIONS }
			/>
			<SelectItem
				styleGroup={ styleGroup }
				tokenKey="decorationHover"
				label={ __(
					'Underline on hover',
					'frontend-login-and-registration-blocks'
				) }
				options={ DECORATIONS }
			/>
			<ToggleGroupItem
				styleGroup={ styleGroup }
				tokenKey="justify"
				label={ __(
					'Alignment',
					'frontend-login-and-registration-blocks'
				) }
				options={ [
					{
						label: __(
							'Left',
							'frontend-login-and-registration-blocks'
						),
						value: 'flex-start',
					},
					{
						label: __(
							'Center',
							'frontend-login-and-registration-blocks'
						),
						value: 'center',
					},
					{
						label: __(
							'Right',
							'frontend-login-and-registration-blocks'
						),
						value: 'flex-end',
					},
					{
						label: __(
							'Apart',
							'frontend-login-and-registration-blocks'
						),
						value: 'space-between',
					},
				] }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="gap"
				label={ __(
					'Space between links',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</ToolsPanel>
	);
}

/**
 * Success and error messages, plus the checkbox row that sits with them.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function NoticePanel( props ) {
	const noticeGroup = useStyleGroup( 'noticeStyles', props );
	const checkGroup = useStyleGroup( 'checkStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	return (
		<>
			<ToolsPanel
				{ ...noticeGroup.panel }
				label={ __(
					'Messages',
					'frontend-login-and-registration-blocks'
				) }
			>
				<ColorGroup
					styleGroup={ noticeGroup }
					panelId={ props.clientId }
					colorSettings={ colorSettings }
					settings={ [
						{
							tokenKey: 'successBg',
							label: __(
								'Success background',
								'frontend-login-and-registration-blocks'
							),
							isShownByDefault: true,
						},
						{
							tokenKey: 'successColor',
							label: __(
								'Success text',
								'frontend-login-and-registration-blocks'
							),
							isShownByDefault: true,
						},
						{
							tokenKey: 'successBorder',
							label: __(
								'Success border',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							tokenKey: 'errorBg',
							label: __(
								'Error background',
								'frontend-login-and-registration-blocks'
							),
							isShownByDefault: true,
						},
						{
							tokenKey: 'errorColor',
							label: __(
								'Error text',
								'frontend-login-and-registration-blocks'
							),
							isShownByDefault: true,
						},
						{
							tokenKey: 'errorBorder',
							label: __(
								'Error border',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							tokenKey: 'loadingColor',
							label: __(
								'Loading text',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>
				<SizeItem
					styleGroup={ noticeGroup }
					tokenKey="radius"
					label={ __(
						'Corner radius',
						'frontend-login-and-registration-blocks'
					) }
				/>
				<SizeItem
					styleGroup={ noticeGroup }
					tokenKey="paddingBlock"
					label={ __(
						'Vertical padding',
						'frontend-login-and-registration-blocks'
					) }
				/>
				<SizeItem
					styleGroup={ noticeGroup }
					tokenKey="paddingInline"
					label={ __(
						'Horizontal padding',
						'frontend-login-and-registration-blocks'
					) }
				/>
				<SizeItem
					styleGroup={ noticeGroup }
					tokenKey="fontSize"
					label={ __(
						'Text size',
						'frontend-login-and-registration-blocks'
					) }
				/>
				<ToggleGroupItem
					styleGroup={ noticeGroup }
					tokenKey="justify"
					label={ __(
						'Alignment',
						'frontend-login-and-registration-blocks'
					) }
					options={ [
						{
							label: __(
								'Left',
								'frontend-login-and-registration-blocks'
							),
							value: 'left',
						},
						{
							label: __(
								'Center',
								'frontend-login-and-registration-blocks'
							),
							value: 'center',
						},
						{
							label: __(
								'Right',
								'frontend-login-and-registration-blocks'
							),
							value: 'right',
						},
					] }
				/>
			</ToolsPanel>

			<ToolsPanel
				{ ...checkGroup.panel }
				label={ __(
					'Checkboxes',
					'frontend-login-and-registration-blocks'
				) }
			>
				<ColorGroup
					styleGroup={ checkGroup }
					panelId={ props.clientId }
					colorSettings={ colorSettings }
					settings={ [
						{
							tokenKey: 'accent',
							label: __(
								'Checked colour',
								'frontend-login-and-registration-blocks'
							),
							isShownByDefault: true,
						},
						{
							tokenKey: 'labelColor',
							label: __(
								'Label text',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>
				<SizeItem
					styleGroup={ checkGroup }
					tokenKey="size"
					label={ __(
						'Box size',
						'frontend-login-and-registration-blocks'
					) }
					isShownByDefault
				/>
				<SizeItem
					styleGroup={ checkGroup }
					tokenKey="labelFontSize"
					label={ __(
						'Label size',
						'frontend-login-and-registration-blocks'
					) }
				/>
				<SizeItem
					styleGroup={ checkGroup }
					tokenKey="gap"
					label={ __(
						'Space beside box',
						'frontend-login-and-registration-blocks'
					) }
				/>
			</ToolsPanel>
		</>
	);
}

/**
 * The explanatory paragraph some forms show above their fields.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function DescriptionPanel( props ) {
	const styleGroup = useStyleGroup( 'descriptionStyles', props );
	const colorSettings = useMultipleOriginColorsAndGradients();

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __(
				'Description',
				'frontend-login-and-registration-blocks'
			) }
		>
			<ColorGroup
				styleGroup={ styleGroup }
				panelId={ props.clientId }
				colorSettings={ colorSettings }
				settings={ [
					{
						tokenKey: 'color',
						label: __(
							'Text',
							'frontend-login-and-registration-blocks'
						),
						isShownByDefault: true,
					},
				] }
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="fontSize"
				label={ __( 'Size', 'frontend-login-and-registration-blocks' ) }
				isShownByDefault
			/>
			<ToggleGroupItem
				styleGroup={ styleGroup }
				tokenKey="justify"
				label={ __(
					'Alignment',
					'frontend-login-and-registration-blocks'
				) }
				options={ [
					{
						label: __(
							'Left',
							'frontend-login-and-registration-blocks'
						),
						value: 'left',
					},
					{
						label: __(
							'Center',
							'frontend-login-and-registration-blocks'
						),
						value: 'center',
					},
					{
						label: __(
							'Right',
							'frontend-login-and-registration-blocks'
						),
						value: 'right',
					},
				] }
			/>
		</ToolsPanel>
	);
}

/**
 * The member avatar shown by the account blocks.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
export function AvatarPanel( props ) {
	const styleGroup = useStyleGroup( 'avatarStyles', props );

	return (
		<ToolsPanel
			{ ...styleGroup.panel }
			label={ __( 'Avatar', 'frontend-login-and-registration-blocks' ) }
		>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="size"
				label={ __( 'Size', 'frontend-login-and-registration-blocks' ) }
				isShownByDefault
			/>
			<SizeItem
				styleGroup={ styleGroup }
				tokenKey="radius"
				label={ __(
					'Corner radius',
					'frontend-login-and-registration-blocks'
				) }
				isShownByDefault
			/>
		</ToolsPanel>
	);
}
