import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import Options from "./options";

export default function Edit(props) {

	const {attributes} = props;

	console.log(attributes.additionalFields)

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
							   htmlFor="flr-blocks-username">{__('Username', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-username" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your username', 'frontend-login-and-registration-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels &&
						<label className="flr-blocks-input-label" style={textStyle}
							   htmlFor="flr-blocks-email">{__('Your e-mail', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-email" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your e-mail', 'frontend-login-and-registration-blocks')}/>
					</div>
				</div>

				{
					attributes.additionalFields.showFirstName && <div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-first-name">{__('First Name', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-first-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your first name', 'frontend-login-and-registration-blocks')}/>
					</div>

				}

				{
					attributes.additionalFields.showLastName && <div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-last-name">{__('Last Name', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-last-name" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your last name', 'frontend-login-and-registration-blocks')}/>
					</div>

				}

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-password">{__('Password', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-password" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your password', 'frontend-login-and-registration-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
														 htmlFor="flr-blocks-password-again">{__('Password Again', 'frontend-login-and-registration-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-password-again" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your password again', 'frontend-login-and-registration-blocks')}/>
					</div>
				</div>


				{
					attributes.showTermsAndPrivacy &&
					<div className="flr-blocks-form-row">
						<div className="flr-blocks-form-check-group">
							<input id="flr-blocks-terms-and-privacy" checked="checked" type="checkbox"
								   className="flr-blocks-form-check-input"/>
							<label className="flr-blocks-form-check-label"
								   htmlFor="flr-blocks-terms-and-privacy">{__('I have read and accept terms and conditions and privacy policy.', 'frontend-login-and-registration-blocks')}</label>
						</div>
					</div>
				}

				<div className="flr-blocks-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="wp-submit"
							className="flr-blocks-register-btn flr-blocks-btn wp-block-button__link wp-element-button">
						{__('Register', 'frontend-login-and-registration-blocks')}
					</button>
				</div>

			</div>

		</>

	);
}
