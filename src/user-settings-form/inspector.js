/**
 * Inspector for the user settings form.
 *
 * Adds the avatar toggles and an Avatar style panel on top of the shared set.
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
	AvatarPanel,
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
							key: 'showAvatar',
							label: __(
								'Show the profile picture',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showGravatarLink',
							label: __(
								'Show the Gravatar link',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showWebsite',
							label: __(
								'Show the website field',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showBio',
							label: __(
								'Show the biography field',
								'frontend-login-and-registration-blocks'
							),
						},
						{
							key: 'showPasswordSection',
							label: __(
								'Show the password fields',
								'frontend-login-and-registration-blocks'
							),
							help: __(
								'Members can change their password from this form.',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>

				<TextOverridesPanel
					{ ...props }
					fields={ [
						{
							key: 'firstName',
							label: __(
								'First name',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'First Name (optional)',
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
								'Last Name (optional)',
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
							key: 'website',
							label: __(
								'Website',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Website Url (optional)',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'bio',
							label: __(
								'Biography',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Your short biography (optional)',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'currentPassword',
							label: __(
								'Current password',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Current Password',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'newPassword',
							label: __(
								'New password',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'New Password',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'newPasswordAgain',
							label: __(
								'Repeat new password',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'New Password Again',
								'frontend-login-and-registration-blocks'
							),
							hasPlaceholder: true,
						},
						{
							key: 'gravatar',
							label: __(
								'Gravatar link',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'You can change your profile picture on Gravatar.',
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
								'Update User',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>
			</InspectorControls>

			<InspectorControls group="styles">
				<LayoutPanel { ...props } />
				<AvatarPanel { ...props } />
				<LabelPanel { ...props } />
				<InputPanel { ...props } />
				<ButtonPanel { ...props } />
				<LinkPanel { ...props } />
				<NoticePanel { ...props } />
			</InspectorControls>
		</>
	);
}
