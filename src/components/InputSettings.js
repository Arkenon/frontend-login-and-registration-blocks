import {__} from '@wordpress/i18n';
import {
	ToggleControl,
	RangeControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';

const InputSettings = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<Panel>
			<PanelBody
				title={__('Input Settings', 'flwgb')}
				initialOpen={false}
			>
				<PanelRow>
					<RangeControl
						label={__('Input Border Radius', 'flwgb')}
						value={attributes.inputBorderRadius}
						onChange={(val) =>
							setAttributes({inputBorderRadius: val})
						}
						min={0}
						max={25}
					/>
				</PanelRow>
				<PanelRow>
					<ToggleControl
						label={__('Show Placeholders', 'flwgb')}
						help={attributes.showPlaceholders ? 'Show' : 'Hide'}
						checked={attributes.showPlaceholders}
						onChange={(val) =>
							setAttributes({showPlaceholders: val})
						}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default InputSettings;
