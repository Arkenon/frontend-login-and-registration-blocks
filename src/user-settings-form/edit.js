import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import Options from "./options";

export default function Edit(props) {

	const {attributes} = props;

	const blockProps = useBlockProps(props);

	const inputStyle = {
		'border-radius': attributes.inputBorderRadius,
	}

	const textStyle = {
		'color': attributes.textColor,
		'font-weight': attributes.textFontWeight
	}

	const buttonStyle = {
		'color': attributes.buttonTextColor,
		'backgroundColor': attributes.buttonBgColor,
		'border-color': attributes.buttonBorder.color,
		'border-style': attributes.buttonBorder.style,
		'border-width': attributes.buttonBorder.width,
		'border-radius': attributes.buttonBorderRadius,
		'font-weight': attributes.buttonTextFontWeight
	}

	return (

		<>

			<Options options={props}/>

			<div {...blockProps}>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-user-first-name">{__('First Name (optional)', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-user-first-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your first name', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-user-last-name">{__('Last Name (optional)', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-user-last-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your last name', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-user-website">{__('Website Url (optional)', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-user-website" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your website url', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-user-bio">{__('Your short bio (optional)', 'flr-blocks')}</label>}
						<textarea className="flr-blocks-textarea-control" name="flr-blocks-user-bio" id="flr-blocks-user-bio" cols="30" rows="10">

						</textarea>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-email-update">{__('Your e-mail', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-email-update" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your e-mail', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-current-password">{__('Current Password', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-current-password" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your current password', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-password-update">{__('New Password', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-password-update" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your new password', 'flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-password-again-update">{__('New Password Again', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-password-again-update" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your new password again', 'flr-blocks')}/>
					</div>
				</div>


				<div className="flr-blocks-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="flr-blocks-user-settings-submit"
							className="flr-blocks-update-user-btn flr-blocks-btn wp-block-button__link wp-element-button">
						{__('Update User', 'flr-blocks')}
					</button>
				</div>

			</div>

		</>

	);
}
