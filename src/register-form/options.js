import {InspectorControls} from '@wordpress/block-editor';
import {ToggleControl} from '@wordpress/components';
import {__} from '@wordpress/i18n';
import LabelSettings from "../components/LabelSettings";
import ButtonSettings from "../components/ButtonSettings";
import InputSettings from "../components/InputSettings";
import AdditionalFieldsSettings from "../components/AdditionalFieldsSettings";

const Options = ({options}) => {

	const {attributes, setAttributes} = options;

	return (
		<InspectorControls>

			<div style={{padding:"20px"}}>
				<ToggleControl
					label={__('Show Terms and Conditions / Privacy Policy Checkbox', 'frontend-login-and-registration-blocks')}
					help={attributes.showTermsAndPrivacy ? 'Show' : 'Hide'}
					checked={attributes.showTermsAndPrivacy}
					onChange={(val) =>
						setAttributes({showTermsAndPrivacy: val})
					}
				/>
			</div>


			<LabelSettings options={options} />

			<InputSettings options={options}/>

			<ButtonSettings options={options}/>

			<AdditionalFieldsSettings options={options}/>

		</InspectorControls>
	)

}

export default Options;
