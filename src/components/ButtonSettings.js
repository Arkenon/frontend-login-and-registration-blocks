import {__} from '@wordpress/i18n';
import {
	__experimentalText as Text,
	__experimentalBorderControl as BorderControl,
	ColorPalette,
	SelectControl,
	RangeControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';

const ButtonSettings = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<Panel>
			<PanelBody
				title={__('Button Settings', 'flr-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<RangeControl
						label={__('Button Border Radius', 'flr-blocks')}
						value={attributes.buttonBorderRadius}
						onChange={(val) =>
							setAttributes({buttonBorderRadius: val})
						}
						min={0}
						max={25}
					/>
				</PanelRow>
				<PanelRow>
					<BorderControl
						label={__('Button Border', 'flr-blocks')}
						onChange={(newButtonBorder) =>
							setAttributes({
								buttonBorder: newButtonBorder,
							})
						}
						value={attributes.buttonBorder}
					/>
				</PanelRow>
				<PanelRow>
					<Text>
						{__('Button Background Color', 'flr-blocks')}
					</Text>
				</PanelRow>
				<PanelRow>
					<ColorPalette
						value={attributes.buttonBgColor}
						onChange={(val) =>
							setAttributes({buttonBgColor: val})
						}
					/>
				</PanelRow>
				<PanelRow>
					<SelectControl
						labelPosition={'top'}
						label={__('Button Font Weight', 'flr-blocks')}
						value={attributes.buttonTextFontWeight}
						options={[
							{label: 'Normal', value: 'normal'},
							{label: 'Bold', value: 'bold'},
						]}
						onChange={(val) =>
							setAttributes({buttonTextFontWeight: val})
						}
					/>
				</PanelRow>
				<PanelRow>
					<Text>{__('Button Text Color', 'flr-blocks')}</Text>
				</PanelRow>
				<PanelRow>
					<ColorPalette
						value={attributes.buttonTextColor}
						onChange={(val) =>
							setAttributes({buttonTextColor: val})
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default ButtonSettings;
