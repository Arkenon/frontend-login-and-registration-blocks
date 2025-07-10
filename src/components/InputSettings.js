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
				title={__('Input Settings', 'frontend-login-and-registration-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<RangeControl
						label={__('Input Border Radius', 'frontend-login-and-registration-blocks')}
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
						label={__('Show Placeholders', 'frontend-login-and-registration-blocks')}
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
