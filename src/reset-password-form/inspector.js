/**
 * Inspector for the reset password form.
 *
 * Adds a Messages panel for the two explanatory paragraphs, and a Description
 * style panel, on top of the shared set.
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, TextareaControl } from '@wordpress/components';
import {
	LayoutPanel,
	LabelPanel,
	InputPanel,
	ButtonPanel,
	LinkPanel,
	NoticePanel,
	DescriptionPanel,
} from '../shared/components/panels';
import {
	FieldOptionsPanel,
	TextOverridesPanel,
} from '../shared/components/settings';

/**
 * The two paragraphs shown above each step.
 *
 * @param {Object} props Block edit props.
 * @return {Element} The panel.
 */
function ContentPanel( props ) {
	const { attributes, setAttributes } = props;

	const setContent = ( key, value ) => {
		const next = { ...( attributes.content || {} ) };

		if ( value === '' ) {
			delete next[ key ];
		} else {
			next[ key ] = value;
		}

		setAttributes( {
			content: Object.keys( next ).length ? next : undefined,
		} );
	};

	return (
		<PanelBody
			title={ __(
				'Descriptions',
				'frontend-login-and-registration-blocks'
			) }
			initialOpen={ false }
		>
			<TextareaControl
				__nextHasNoMarginBottom
				label={ __(
					'Above the e-mail step',
					'frontend-login-and-registration-blocks'
				) }
				value={ attributes.content?.requestDescription ?? '' }
				placeholder={ __(
					'Please enter your e-mail address. We will send you an e-mail to reset your password.',
					'frontend-login-and-registration-blocks'
				) }
				onChange={ ( value ) =>
					setContent( 'requestDescription', value )
				}
			/>

			<TextareaControl
				__nextHasNoMarginBottom
				label={ __(
					'Above the new password step',
					'frontend-login-and-registration-blocks'
				) }
				value={ attributes.content?.progressDescription ?? '' }
				placeholder={ __(
					'Choose a new password for your account.',
					'frontend-login-and-registration-blocks'
				) }
				onChange={ ( value ) =>
					setContent( 'progressDescription', value )
				}
			/>
		</PanelBody>
	);
}

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
							key: 'showDescription',
							label: __(
								'Show the explanatory text',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>

				<ContentPanel { ...props } />

				<TextOverridesPanel
					{ ...props }
					fields={ [
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
							key: 'requestSubmit',
							label: __(
								'Request button',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Send Request',
								'frontend-login-and-registration-blocks'
							),
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
							key: 'changeSubmit',
							label: __(
								'Change password button',
								'frontend-login-and-registration-blocks'
							),
							placeholder: __(
								'Change Password',
								'frontend-login-and-registration-blocks'
							),
						},
					] }
				/>
			</InspectorControls>

			<InspectorControls group="styles">
				<LayoutPanel { ...props } />
				<DescriptionPanel { ...props } />
				<LabelPanel { ...props } />
				<InputPanel { ...props } />
				<ButtonPanel { ...props } />
				<LinkPanel { ...props } />
				<NoticePanel { ...props } />
			</InspectorControls>
		</>
	);
}
