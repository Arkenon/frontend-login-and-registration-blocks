/**
 * Editor view of the login form.
 *
 * The wrapper carries the same classes and the same --flr-* custom properties
 * that Flr_Blocks_Style puts on the rendered element, and the markup below
 * mirrors public/partials/login/login-form.php, so the canvas is a faithful
 * preview rather than an approximation.
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps } from '@wordpress/block-editor';
import { unlock } from '@wordpress/icons';
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
					icon={ unlock }
					title={ __(
						'Login Form',
						'frontend-login-and-registration-blocks'
					) }
					setAttributes={ setAttributes }
				/>
			</div>
		);
	}

	const links = [
		{
			key: 'lostPassword',
			label: resolveText(
				attributes,
				'labels',
				'lostPassword',
				__( 'Lost Password', 'frontend-login-and-registration-blocks' )
			),
		},
		{
			key: 'register',
			label: resolveText(
				attributes,
				'labels',
				'register',
				__( 'Register', 'frontend-login-and-registration-blocks' )
			),
		},
	];

	return (
		<>
			<DesignToolbar { ...props } />
			<Inspector { ...props } />

			<div { ...blockProps }>
				<Form>
					<Field
						id="flr-blocks-username-or-email"
						type="text"
						required
						{ ...fieldProps(
							attributes,
							options,
							'usernameOrEmail',
							__(
								'Username or E-mail',
								'frontend-login-and-registration-blocks'
							),
							__(
								'Enter your username or e-mail',
								'frontend-login-and-registration-blocks'
							)
						) }
					/>

					<Field
						id="flr-blocks-password"
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

					{ options.showRememberMe !== false && (
						<CheckboxRow
							id="flr-blocks-rememberme"
							label={ resolveText(
								attributes,
								'labels',
								'rememberMe',
								__(
									'Remember me',
									'frontend-login-and-registration-blocks'
								)
							) }
						/>
					) }

					<SubmitButton attributes={ attributes } variant="login">
						{ resolveText(
							attributes,
							'labels',
							'submit',
							__(
								'Login',
								'frontend-login-and-registration-blocks'
							)
						) }
					</SubmitButton>
				</Form>

				{ options.showLinks !== false && <LinksRow links={ links } /> }
			</div>
		</>
	);
}
