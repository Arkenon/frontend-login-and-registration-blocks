import {__} from '@wordpress/i18n';
import {
	ToggleControl,
	ColorPicker,
	SelectControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';
import {FlrColorPalette, FlrBorderControl} from "./CustomControls";

const LabelSettings = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<Panel>
			<PanelBody
				title={__('Label Settings', 'frontend-login-and-registration-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<ToggleControl
						label={__('Show labels', 'frontend-login-and-registration-blocks')}
						help={attributes.showLabels ? 'Show' : 'Hide'}
						checked={attributes.showLabels}
						onChange={(val) =>
							setAttributes({showLabels: val})
						}
					/>
				</PanelRow>
				<PanelRow>
					<SelectControl
						labelPosition={'top'}
						label={__('Font Weight & Font Color', 'frontend-login-and-registration-blocks')}
						value={attributes.textFontWeight}
						options={[
							{label: 'Normal', value: 'normal'},
							{label: 'Bold', value: 'bold'},
						]}
						onChange={(val) =>
							setAttributes({textFontWeight: val})
						}
					/>
				</PanelRow>
				<PanelRow>
					<FlrColorPalette
						options={options}
						attributeName="textColor"
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default LabelSettings;
