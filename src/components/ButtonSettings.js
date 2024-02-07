import {__} from '@wordpress/i18n';
import {
	__experimentalText as Text,
	SelectControl,
	RangeControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';
import {FlrColorPalette, FlrBorderControl} from "./CustomControls";

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
					<FlrBorderControl
						options={options}
						attributeName="buttonBorder"
					/>
				</PanelRow>
				<PanelRow>
					<Text>
						{__('Button Background Color', 'flr-blocks')}
					</Text>
				</PanelRow>
				<PanelRow>
					<FlrColorPalette
						options={options}
						attributeName="buttonBgColor"
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
					<FlrColorPalette
						options={options}
						attributeName="buttonTextColor"
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default ButtonSettings;
