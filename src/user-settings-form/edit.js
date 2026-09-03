/**
 * Editor view of the user settings form.
 *
 * Mirrors public/partials/user-settings/user-settings-form.php. The avatar and
 * the field values belong to whoever is viewing the page, so the canvas shows
 * the current editor's own avatar as a stand-in.
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { useSelect } from '@wordpress/data';
import { store as coreStore } from '@wordpress/core-data';
import { people } from '@wordpress/icons';
import Inspector from './inspector';
import DesignToolbar from '../shared/components/DesignToolbar';
import FormSetupPlaceholder from '../shared/components/FormSetupPlaceholder';
import {
	buildStyleVars,
	buildWrapperClasses,
	resolveOptions,
	resolveText,
} from '../shared/style-vars';
import {
	Form,
	Field,
	SubmitButton,
	LinksRow,
	Avatar,
	fieldProps,
} from '../shared/form-parts';

export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const options = resolveOptions( attributes );

	const currentUser = useSelect(
		( select ) => select( coreStore ).getCurrentUser(),
		[]
	);

	const showSetup = ! attributes.templateChosen;

	// The setup screen is editor chrome, not a preview of the form, so it takes
	// neither the wrapper's tokens nor flr-blocks-editor-preview -- that class
	// makes every control inside it inert, which would swallow the clicks on the
	// design cards.
	const blockProps = useBlockProps(
		showSetup
			? { className: 'flr-blocks-setup-wrapper' }
			: {
					className: `${ buildWrapperClasses(
						attributes
					) } flr-blocks-editor-preview`,
					style: buildStyleVars( attributes ),
			  }
	);

	if ( showSetup ) {
		return (
			<div { ...blockProps }>
				<FormSetupPlaceholder
					icon={ people }
					title={ __(
						'User Settings Form',
						'frontend-login-and-registration-blocks'
					) }
					previewFields={ 3 }
					setAttributes={ setAttributes }
				/>
			</div>
		);
	}

	return (
		<>
			<DesignToolbar { ...props } />
			<Inspector { ...props } />

			<div { ...blockProps }>
				<Form>
					{ options.showAvatar !== false && (
						<>
							<Avatar
								src={ currentUser?.avatar_urls?.[ 96 ] || '' }
								alt={ __(
									'Your profile picture',
									'frontend-login-and-registration-blocks'
								) }
							/>

							{ options.showGravatarLink !== false && (
								<LinksRow
									links={ [
										{
											key: 'gravatar',
											label: resolveText(
												attributes,
												'labels',
												'gravatar',
												__(
													'You can change your profile picture on Gravatar.',
													'frontend-login-and-registration-blocks'
												)
											),
										},
									] }
								/>
							) }
						</>
					) }

					<Field
						id="flr-blocks-user-first-name"
						type="text"
						{ ...fieldProps(
							attributes,
							options,
							'firstName',
							__(
								'First Name (optional)',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your first name',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					<Field
						id="flr-blocks-user-last-name"
						type="text"
						{ ...fieldProps(
							attributes,
							options,
							'lastName',
							__(
								'Last Name (optional)',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your last name',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					<Field
						id="flr-blocks-email-update"
						type="email"
						required
						{ ...fieldProps(
							attributes,
							options,
							'email',
							__(
								'Your e-mail',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your e-mail',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					{ options.showWebsite !== false && (
						<Field
							id="flr-blocks-user-website"
							type="url"
							{ ...fieldProps(
								attributes,
								options,
								'website',
								__(
									'Website Url (optional)',
									'frontend-login-and-registration-blocks'
								),
								__(
									'Enter your website url',
									'frontend-login-and-registration-blocks'
								)
							) }
						/>
					) }

					{ options.showBio !== false && (
						<div className="flr-blocks-form-row">
							<div className="flr-blocks-input-group">
								{ options.showLabels !== false && (
									<label
										className="flr-blocks-input-label"
										htmlFor="flr-blocks-user-bio"
									>
										{ resolveText(
											attributes,
											'labels',
											'bio',
											__(
												'Your short biography (optional)',
												'frontend-login-and-registration-blocks'
											)
										) }
									</label>
								) }
								<textarea
									className="flr-blocks-textarea-control"
									id="flr-blocks-user-bio"
									rows={ 6 }
									readOnly
									tabIndex={ -1 }
								/>
							</div>
						</div>
					) }

					{ options.showPasswordSection !== false && (
						<>
							<Field
								id="flr-blocks-current-password"
								type="password"
								{ ...fieldProps(
									attributes,
									options,
									'currentPassword',
									__(
										'Current Password',
										'frontend-login-and-registration-blocks'
									),
									__(
										'Enter your current password',
										'frontend-login-and-registration-blocks'
									)
								) }
							/>

							<Field
								id="flr-blocks-password-update"
								type="password"
								{ ...fieldProps(
									attributes,
									options,
									'newPassword',
									__(
										'New Password',
										'frontend-login-and-registration-blocks'
									),
									__(
										'Enter your new password',
										'frontend-login-and-registration-blocks'
									)
								) }
							/>

							<Field
								id="flr-blocks-password-again-update"
								type="password"
								{ ...fieldProps(
									attributes,
									options,
									'newPasswordAgain',
									__(
										'New Password Again',
										'frontend-login-and-registration-blocks'
									),
									__(
										'Enter your new password again',
										'frontend-login-and-registration-blocks'
									)
								) }
							/>
						</>
					) }

					<SubmitButton
						attributes={ attributes }
						variant="update-user"
					>
						{ resolveText(
							attributes,
							'labels',
							'submit',
							__(
								'Update User',
								'frontend-login-and-registration-blocks'
							)
						) }
					</SubmitButton>
				</Form>
			</div>
		</>
	);
}
