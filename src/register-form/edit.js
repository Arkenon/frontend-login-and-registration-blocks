/**
 * Editor view of the registration form.
 *
 * Mirrors public/partials/register/register-form.php field for field, so the
 * canvas shows what the page will render.
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
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
	CheckboxRow,
	SubmitButton,
	LinksRow,
	fieldProps,
} from '../shared/form-parts';

export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const options = resolveOptions( attributes );

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
						'Register Form',
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
					<Field
						id="flr-blocks-username-for-register"
						type="text"
						required
						{ ...fieldProps(
							attributes,
							options,
							'username',
							__(
								'Username',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your username',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					<Field
						id="flr-blocks-email-for-register"
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

					{ options.showFirstName && (
						<Field
							id="flr-blocks-first-name-for-register"
							type="text"
							{ ...fieldProps(
								attributes,
								options,
								'firstName',
								__(
									'First Name',
									'frontend-login-and-registration-blocks'
								),
								__(
									'Enter your first name',
									'frontend-login-and-registration-blocks'
								)
							) }
						/>
					) }

					{ options.showLastName && (
						<Field
							id="flr-blocks-last-name-for-register"
							type="text"
							{ ...fieldProps(
								attributes,
								options,
								'lastName',
								__(
									'Last Name',
									'frontend-login-and-registration-blocks'
								),
								__(
									'Enter your last name',
									'frontend-login-and-registration-blocks'
								)
							) }
						/>
					) }

					<Field
						id="flr-blocks-password-for-register"
						type="password"
						required
						{ ...fieldProps(
							attributes,
							options,
							'password',
							__(
								'Password',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your password',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					<Field
						id="flr-blocks-password-again-for-register"
						type="password"
						required
						{ ...fieldProps(
							attributes,
							options,
							'passwordAgain',
							__(
								'Password Again',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your password again',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					{ options.showTermsAndPrivacy !== false && (
						<CheckboxRow
							id="flr-blocks-terms-and-privacy"
							label={ resolveText(
								attributes,
								'labels',
								'terms',
								__(
									'I have read and accept the terms and conditions and privacy policy',
									'frontend-login-and-registration-blocks'
								)
							) }
						/>
					) }

					<SubmitButton attributes={ attributes } variant="register">
						{ resolveText(
							attributes,
							'labels',
							'submit',
							__(
								'Register',
								'frontend-login-and-registration-blocks'
							)
						) }
					</SubmitButton>
				</Form>

				{ options.showLinks !== false && (
					<LinksRow
						intro={ resolveText(
							attributes,
							'labels',
							'haveAccount',
							__(
								'Already signed up?',
								'frontend-login-and-registration-blocks'
							)
						) }
						links={ [
							{
								key: 'login',
								label: resolveText(
									attributes,
									'labels',
									'login',
									__(
										'Login',
										'frontend-login-and-registration-blocks'
									)
								),
							},
						] }
					/>
				) }
			</div>
		</>
	);
}
