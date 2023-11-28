import {__} from '@wordpress/i18n';
import {
	ToggleControl,
	ColorPicker,
	SelectControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';

const LabelSettings = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<Panel>
			<PanelBody
				title={__('Label Settings', 'flr-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<ToggleControl
						label={__('Show labels', 'flr-blocks')}
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
						label={__('Font Weight & Font Color', 'flr-blocks')}
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
					<ColorPicker
						color={attributes.textColor}
						onChange={(val) =>
							setAttributes({textColor: val})
						}
						enableAlpha
						defaultValue="#000"
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default LabelSettings;
