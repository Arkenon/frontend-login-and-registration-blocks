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
							   htmlFor="flwgb-username">{__('Username', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-username" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your username', 'flwgb')}/>
					</div>
				</div>

				<div className="flwgb-form-row">
					<div className="flwgb-input-group">
						{attributes.showLabels &&
						<label className="flwgb-input-label" style={textStyle}
							   htmlFor="flwgb-email">{__('Your e-mail', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-email" type="text"
							   style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your e-mail', 'flwgb')}/>
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
					<div className="flwgb-input-group">
						{attributes.showLabels && <label className="flwgb-input-label" style={textStyle}
														 htmlFor="flwgb-password-again">{__('Password Again', 'flwgb')}</label>}
						<input className="flwgb-input-control" id="flwgb-password-again" type="password" style={inputStyle}
							   placeholder={attributes.showPlaceholders && __('Enter your password again', 'flwgb')}/>
					</div>
				</div>


				{
					attributes.showTermsAndPrivacy &&
					<div className="flwgb-form-row">
						<div className="flwgb-form-check-group">
							<input id="flwgb-terms-and-privacy" checked="checked" type="checkbox"
								   className="flwgb-form-check-input"/>
							<label className="flwgb-form-check-label" htmlFor="flwgb-terms-and-privacy">{__('I have read and accept terms and conditions and privacy policy.', 'flwgb')}</label>
						</div>
					</div>
				}

				<div className="flwgb-form-row">
					<button style={buttonStyle} type="submit" name="wp-submit" id="wp-submit"
							className="flwgb-register-btn flwgb-btn">
						{__('Register', 'flwgb')}
					</button>
				</div>

			</div>

		</>

	);
}
