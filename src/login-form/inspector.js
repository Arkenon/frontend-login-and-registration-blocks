/**
 * Inspector for the login form.
 *
 * Content settings and style settings live in the editor's two sidebar tabs
 * rather than in one stack of panels, and every style group is a ToolsPanel so
 * each control can be added, cleared and reset individually.
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
							key: 'showRememberMe',
							label: __(
								'Show "Remember me"',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showLinks',
							label: __(
								'Show lost password and register links',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>

				<TextOverridesPanel
					{ ...props }
					fields={ [
						{
							key: 'usernameOrEmail',
							label: __(
								'Username or e-mail',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Username or E-mail',
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
							key: 'rememberMe',
							label: __(
								'Remember me',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Remember me',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'submit',
							label: __(
								'Submit button',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Login',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'lostPassword',
							label: __(
								'Lost password link',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Lost Password',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'register',
							label: __(
								'Register link',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Register',
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
