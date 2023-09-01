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
								   htmlFor="flwgb-username-or-email">{__('Username or E-mail', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-username-or-email" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your username or e-mail', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels && <label className="flwgb-input-label" style={textStyle}
											  htmlFor="flwgb-password">{__('Password', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-password" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your password', 'flwgb')}/>
					</div>
				</div>


				<div className="flwgb-form-row">
					<div className="flwgb-form-check-group">
						<input id="flwgb-rememberme" checked="checked" type="checkbox"
							   className="flwgb-form-check-input"/>
						<label className="flwgb-form-check-label" htmlFor="flwgb-rememberme">{__('Remember me', 'flwgb')}</label>
					</div>
				</div>

				<div className="flwgb-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="wp-submit"
							className="flwgb-login-btn flwgb-btn">
						{__('Login', 'flwgb')}
					</button>
				</div>

			</div>

		</>

	);
}
