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
								   htmlFor="flr-blocks-username-or-email">{__('Username or E-mail', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-username-or-email" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && _x('Enter your username or e-mail', 'email_or_username_placeholder_text','flr-blocks')}/>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<div className="flr-blocks-input-group">
						{attributes.showLabels && <label className="flr-blocks-input-label" style={textStyle}
											  htmlFor="flr-blocks-password">{__('Password', 'flr-blocks')}</label>}
						<input className="flr-blocks-input-control" id="flr-blocks-password" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your password', 'flr-blocks')}/>
					</div>
				</div>


				<div className="flr-blocks-form-row">
					<div className="flr-blocks-form-check-group">
						<input id="flr-blocks-rememberme" checked="checked" type="checkbox"
							   className="flr-blocks-form-check-input"/>
						<label className="flr-blocks-form-check-label" htmlFor="flr-blocks-rememberme">{__('Remember me', 'flr-blocks')}</label>
					</div>
				</div>

				<div className="flr-blocks-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="wp-submit"
							className="flr-blocks-login-btn flr-blocks-btn wp-block-button__link wp-element-button">
						{__('Login', 'flr-blocks')}
					</button>
				</div>

			</div>

		</>

	);
}
