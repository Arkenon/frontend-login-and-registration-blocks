import {__} from '@wordpress/i18n';
import {
	ToggleControl,
	Panel,
	PanelBody,
	PanelRow
} from '@wordpress/components';

const LabelSettings = ({options}) => {

	const {attributes, setAttributes} = options;

	const showFirstName = attributes.additionalFields.showFirstName;
	const showLastName = attributes.additionalFields.showLastName;

	const handleFieldChange = (field) => (val) => {

		setAttributes({
			additionalFields: {
				...attributes.additionalFields,
				[field]: val
			}
		})

	}

	return (
		<Panel>
			<PanelBody
				title={__('Additional Fields', 'frontend-login-and-registration-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<ToggleControl
						label={__('Show First Name', 'frontend-login-and-registration-blocks')}
						checked={showFirstName}
						onChange={handleFieldChange('showFirstName')}
					/>
				</PanelRow>
				<PanelRow>
					<ToggleControl
						label={__('Show Last Name', 'frontend-login-and-registration-blocks')}
						checked={showLastName}
						onChange={handleFieldChange('showLastName')}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default LabelSettings;
