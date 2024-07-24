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
				title={__('Additional Fields', 'flr-blocks')}
				initialOpen={false}
			>
				<PanelRow>
					<ToggleControl
						label={__('Show First Name', 'flr-blocks')}
						checked={showFirstName}
						onChange={handleFieldChange('showFirstName')}
					/>
				</PanelRow>
				<PanelRow>
					<ToggleControl
						label={__('Show Last Name', 'flr-blocks')}
						checked={showLastName}
						onChange={handleFieldChange('showLastName')}
					/>
				</PanelRow>
			</PanelBody>
		</Panel>
	)

}

export default LabelSettings;
