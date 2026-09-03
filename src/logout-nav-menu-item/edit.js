/**
 * Editor view of the login/logout navigation item.
 *
 * The link says Logout to a signed-in visitor and Login to everyone else. Since
 * an author is always signed in, a toolbar control switches which of the two
 * the canvas shows, so both can be worded and styled without signing out.
 * editorPreviewState is never read by the renderer.
 */

import { __ } from '@wordpress/i18n';
import {
	useBlockProps,
	BlockControls,
	RichText,
} from '@wordpress/block-editor';
import { ToolbarGroup } from '@wordpress/components';
import Inspector from './inspector';
import {
	ToggleGroupControl,
	ToggleGroupControlOption,
} from '../shared/components/controls';

export default function Edit( props ) {
	const { attributes, setAttributes } = props;
	const blockProps = useBlockProps();

	const loggedIn =
		( attributes.editorPreviewState || 'loggedIn' ) === 'loggedIn';

	const value = loggedIn ? attributes.logoutLabel : attributes.loginLabel;
	const fallback = loggedIn
		? __( 'Logout', 'frontend-login-and-registration-blocks' )
		: __( 'Login', 'frontend-login-and-registration-blocks' );

	return (
		<>
			<BlockControls group="other">
				<ToolbarGroup>
					<div className="flr-step-switch">
						<ToggleGroupControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							isBlock
							hideLabelFromVision
							label={ __(
								'Preview state',
								'frontend-login-and-registration-blocks'
							) }
							value={
								attributes.editorPreviewState || 'loggedIn'
							}
							onChange={ ( state ) =>
								setAttributes( { editorPreviewState: state } )
							}
						>
							<ToggleGroupControlOption
								value="loggedIn"
								label={ __(
									'Signed in',
									'frontend-login-and-registration-blocks'
								) }
							/>
							<ToggleGroupControlOption
								value="loggedOut"
								label={ __(
									'Signed out',
									'frontend-login-and-registration-blocks'
								) }
							/>
						</ToggleGroupControl>
					</div>
				</ToolbarGroup>
			</BlockControls>

			<Inspector { ...props } />

			<div { ...blockProps }>
				<RichText
					identifier={ loggedIn ? 'logoutLabel' : 'loginLabel' }
					tagName="span"
					allowedFormats={ [] }
					value={ value }
					placeholder={ fallback }
					onChange={ ( text ) =>
						setAttributes(
							loggedIn
								? { logoutLabel: text }
								: { loginLabel: text }
						)
					}
					aria-label={ __(
						'Menu item text',
						'frontend-login-and-registration-blocks'
					) }
				/>
			</div>
		</>
	);
}
