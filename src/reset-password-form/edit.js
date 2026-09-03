/**
 * Editor view of the reset password form.
 *
 * The block renders two different forms on the front end depending on the
 * request: the request step normally, the change step when a visitor follows a
 * valid reset link. Which one the canvas shows is chosen with the toolbar
 * control below and stored in editorPreviewStep, an attribute the renderer
 * never reads -- see public/partials/reset-password/reset-password-form.php.
 */

import { __ } from '@wordpress/i18n';
import { useBlockProps, BlockControls } from '@wordpress/block-editor';
import { ToolbarGroup } from '@wordpress/components';
import { rotateLeft } from '@wordpress/icons';
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
	Description,
	fieldProps,
} from '../shared/form-parts';
import {
	ToggleGroupControl,
	ToggleGroupControlOption,
} from '../shared/components/controls';

export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const options = resolveOptions( attributes );
	const step = attributes.editorPreviewStep || 'request';

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
					icon={ rotateLeft }
					title={ __(
						'Reset Password Form',
						'frontend-login-and-registration-blocks'
					) }
					previewFields={ 1 }
					setAttributes={ setAttributes }
				/>
			</div>
		);
	}

	return (
		<>
			<DesignToolbar { ...props } />

			<BlockControls group="other">
				<ToolbarGroup>
					<div className="flr-step-switch">
						<ToggleGroupControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							isBlock
							hideLabelFromVision
							label={ __(
								'Preview step',
								'frontend-login-and-registration-blocks'
							) }
							value={ step }
							onChange={ ( value ) =>
								setAttributes( { editorPreviewStep: value } )
							}
						>
							<ToggleGroupControlOption
								value="request"
								label={ __(
									'Request',
									'frontend-login-and-registration-blocks'
								) }
							/>
							<ToggleGroupControlOption
								value="change"
								label={ __(
									'New password',
									'frontend-login-and-registration-blocks'
								) }
							/>
						</ToggleGroupControl>
					</div>
				</ToolbarGroup>
			</BlockControls>

			<Inspector { ...props } />

			<div { ...blockProps }>
				{ step === 'request' ? (
					<Form>
						{ options.showDescription !== false && (
							<Description>
								{ resolveText(
									attributes,
									'content',
									'requestDescription',
									__(
										'Please enter your e-mail address. We will send you an e-mail to reset your password.',
										'frontend-login-and-registration-blocks'
									)
								) }
							</Description>
						) }

						<Field
							id="flr-blocks-email"
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

						<SubmitButton
							attributes={ attributes }
							variant="reset-request"
						>
							{ resolveText(
								attributes,
								'labels',
								'requestSubmit',
								__(
									'Send Request',
									'frontend-login-and-registration-blocks'
								)
							) }
						</SubmitButton>
					</Form>
				) : (
					<Form>
						{ options.showDescription !== false && (
							<Description>
								{ resolveText(
									attributes,
									'content',
									'progressDescription',
									__(
										'Choose a new password for your account.',
										'frontend-login-and-registration-blocks'
									)
								) }
							</Description>
						) }

						<Field
							id="resetpass_pwd"
							type="password"
							required
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
							id="resetpass_pwd_again"
							type="password"
							required
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

						<SubmitButton
							attributes={ attributes }
							variant="reset-password"
						>
							{ resolveText(
								attributes,
								'labels',
								'changeSubmit',
								__(
									'Change Password',
									'frontend-login-and-registration-blocks'
								)
							) }
						</SubmitButton>
					</Form>
				) }
			</div>
		</>
	);
}
