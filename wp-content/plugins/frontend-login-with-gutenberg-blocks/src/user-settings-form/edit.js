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

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-user-first-name">{__('First Name (optional)', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-user-first-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your first name', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-user-last-name">{__('Last Name (optional)', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-user-last-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your last name', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-user-website">{__('Website Url (optional)', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-user-website" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your website url', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-user-bio">{__('Your short bio (optional)', 'flwgb')}</label>}
						<textarea className="flwgb-textarea-control" name="flwgb-user-bio" id="flwgb-user-bio" cols="30" rows="10">

						</textarea>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-email-update">{__('Your e-mail', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-email-update" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your e-mail', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels && <label className="flwgb-input-label" style={textStyle}
														 htmlFor="flwgb-current-password">{__('Current Password', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-current-password" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your current password', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels && <label className="flwgb-input-label" style={textStyle}
														 htmlFor="flwgb-password-update">{__('New Password', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-password-update" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your new password', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels && <label className="flwgb-input-label" style={textStyle}
														 htmlFor="flwgb-password-again-update">{__('New Password Again', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-password-again-update" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your new password again', 'flwgb')}/>
					</div>
				</div>


				<div className="flwgb-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="flwgb-user-settings-submit"
							className="flwgb-update-user-btn flwgb-btn">
						{__('Update User', 'flwgb')}
					</button>
				</div>

			</div>

		</>

	);
}
