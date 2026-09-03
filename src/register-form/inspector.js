/**
 * Inspector for the registration form.
 *
 * Same two tab layout as the login form: what the form contains under Settings,
 * how it looks under Styles, with every style group a resettable ToolsPanel.
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import {
	LayoutPanel,
	LabelPanel,
	InputPanel,
	ButtonPanel,
	LinkPanel,
	NoticePanel,
} from '../shared/components/panels';
import {
	FieldOptionsPanel,
	TextOverridesPanel,
} from '../shared/components/settings';

/**
 * @param {Object} props Block edit props.
 * @return {Element} The inspector.
 */
export default function Inspector( props ) {
	return (
		<>
			<InspectorControls group="settings">
				<FieldOptionsPanel
					{ ...props }
					extraToggles={ [
						{
							key: 'showFirstName',
							label: __(
								'Ask for a first name',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showLastName',
							label: __(
								'Ask for a last name',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showTermsAndPrivacy',
							label: __(
								'Show terms and privacy checkbox',
								'frontend-login-and-registration-blocks'
							),
							help: __(
								'The pages it links to are set on the plugin settings screen.',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showLinks',
							label: __(
								'Show the link back to login',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>

				<TextOverridesPanel
					{ ...props }
					fields={ [
						{
							key: 'username',
							label: __(
								'Username',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Username',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'email',
							label: __(
								'E-mail',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Your e-mail',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'firstName',
							label: __(
								'First name',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'First Name',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'lastName',
							label: __(
								'Last name',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Last Name',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'password',
							label: __(
								'Password',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Password',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'passwordAgain',
							label: __(
								'Repeat password',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Password Again',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'submit',
							label: __(
								'Submit button',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Register',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'haveAccount',
							label: __(
								'Text before the login link',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Already signed up?',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'login',
							label: __(
								'Login link',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Login',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>
			</InspectorControls>

			<InspectorControls group="styles">
				<LayoutPanel { ...props } />
				<LabelPanel { ...props } />
				<InputPanel { ...props } />
				<ButtonPanel { ...props } />
				<LinkPanel { ...props } />
				<NoticePanel { ...props } />
			</InspectorControls>
		</>
	);
}
