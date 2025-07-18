import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';
import Options from "./options";

export default function Edit(props) {

	const {attributes, setAttributes} = props;

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

	const desc = attributes.description ? attributes.description : 'Please enter your e-mail address. We will send you an e-mail to reset your password.';

	const formSelectBtnStyles = {
		'cursor': 'pointer', 'border': '1px solid gray', 'padding': '5px','text-decoration':'none'
	}

	return (
		<>

			<Options options={props}/>

			<div {...blockProps}>

				<div style={{'display': 'flex', 'justify-content': 'center', 'align-items': 'center', 'gap':'15px','margin-bottom':'30px'}}>
					<a style={formSelectBtnStyles} onClick={() => setAttributes({selectedForm: 'requestForm'})}>{__('Step 1', 'frontend-login-and-registration-blocks')}</a>
					<a style={formSelectBtnStyles} onClick={() => setAttributes({selectedForm: 'changePasswordForm'})}>{__('Step 2', 'frontend-login-and-registration-blocks')}</a>
				</div>

				{
					attributes.selectedForm === 'requestForm' &&
					<div>
						<p style={{'text-align':'center','font-weight':'bold'}}>{__('Password Reset Request Form', 'frontend-login-and-registration-blocks')}</p>
						{
							attributes.showDescription &&
							<div style={{'text-align': 'center'}}>
								<p>{__(desc,'frontend-login-and-registration-blocks')}</p>
							</div>
						}
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


						<div className="flr-blocks-form-row">
							<button style={buttonStyle} type="submit" name="wp-submit" id="wp-submit"
									className="flr-blocks-reset-password-btn flr-blocks-btn wp-block-button__link wp-element-button">
								{__('Send Request', 'frontend-login-and-registration-blocks')}
							</button>
						</div>

					</div>
				}

				{
					attributes.selectedForm === 'changePasswordForm' &&
					<div>
						<p style={{'text-align':'center','font-weight':'bold'}}>{__('Change Password Form', 'frontend-login-and-registration-blocks')}</p>
						<div className="flr-blocks-form-row">
							<div className="flr-blocks-input-group">
								{attributes.showLabels &&
								<label className="flr-blocks-input-label" style={textStyle}
									   htmlFor="flr-blocks-password">{__('Password', 'frontend-login-and-registration-blocks')}</label>}
								<input className="flr-blocks-input-control" id="flr-blocks-password" type="password"
									   style={inputStyle}
									   placeholder={attributes.showPlaceholders && __('Enter your password', 'frontend-login-and-registration-blocks')}/>
							</div>
						</div>

						<div className="flr-blocks-form-row">
							<div className="flr-blocks-input-group">
								{attributes.showLabels &&
								<label className="flr-blocks-input-label" style={textStyle}
									   htmlFor="flr-blocks-password-again">{__('Password Again', 'frontend-login-and-registration-blocks')}</label>}
								<input className="flr-blocks-input-control" id="flr-blocks-password-again" type="password"
									   style={inputStyle}
									   placeholder={attributes.showPlaceholders && __('Enter your password again', 'frontend-login-and-registration-blocks')}/>
							</div>
						</div>


						<div className="flr-blocks-form-row">
							<button style={buttonStyle} type="submit" name="wp-submit-pwd" id="wp-submit-pwd"
									className="flr-blocks-reset-password-btn flr-blocks-btn wp-block-button__link wp-element-button">
								{__('Change Password', 'frontend-login-and-registration-blocks')}
							</button>
						</div>

					</div>
				}
			</div>


		</>

	);
}
