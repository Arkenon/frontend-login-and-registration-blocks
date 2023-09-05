import {__} from '@wordpress/i18n';
import {InspectorControls} from '@wordpress/block-editor';
import {
	ToggleControl,
	Panel,
	PanelBody,
	PanelRow,
	TextareaControl,
} from '@wordpress/components';
import LabelSettings from "../components/LabelSettings";
import InputSettings from "../components/InputSettings";
import ButtonSettings from "../components/ButtonSettings";

const Options = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<InspectorControls>

			<LabelSettings options={options} />

			<InputSettings options={options} />

			<ButtonSettings options={options} />

			<Panel>
				<PanelBody title={__('Description Settings', 'flwgb')} initialOpen={false}>
					<PanelRow>
						<ToggleControl
							label={__('Show Description', 'flwgb')}
							help={
								attributes.showPlaceholders
									? 'Show'
									: 'Hide'
							}
							checked={attributes.showDescription}
							onChange={(val) => setAttributes({showDescription: val})}
						/>
					</PanelRow>
					<PanelRow>
						<TextareaControl
							label="Description"
							value={attributes.description}
							onChange={(val) => setAttributes({description: val})}
						/>
					</PanelRow>

				</PanelBody>
			</Panel>
		</InspectorControls>
	)
}

export default Options;
