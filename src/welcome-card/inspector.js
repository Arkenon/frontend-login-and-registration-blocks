/**
 * Inspector for the welcome card.
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import {
	PanelBody,
	ToggleControl,
	TextControl,
	TextareaControl,
	SelectControl,
} from '@wordpress/components';
import {
	LayoutPanel,
	DescriptionPanel,
	AvatarPanel,
	LinkPanel,
	NoticePanel,
} from '../shared/components/panels';
import { DEFAULT_GREETING } from './edit';

/**
 * @param {Object} props Block edit props.
 * @return {Element} The inspector.
 */
export default function Inspector( props ) {
	const { attributes, setAttributes } = props;

	const setLabel = ( key, value ) => {
		const next = { ...( attributes.labels || {} ) };

		if ( value === '' ) {
			delete next[ key ];
		} else {
			next[ key ] = value;
		}

		setAttributes( {
			labels: Object.keys( next ).length ? next : undefined,
		} );
	};

	return (
		<>
			<InspectorControls group="settings">
				<PanelBody
					title={ __(
						'Greeting',
						'frontend-login-and-registration-blocks'
					) }
				>
					<TextareaControl
						__nextHasNoMarginBottom
						label={ __(
							'Greeting text',
							'frontend-login-and-registration-blocks'
						) }
						value={ attributes.greeting }
						placeholder={ DEFAULT_GREETING }
						onChange={ ( value ) =>
							setAttributes( { greeting: value } )
						}
						help={ __(
							'Available placeholders: {display_name}, {username}, {first_name}, {email}',
							'frontend-login-and-registration-blocks'
						) }
					/>
				</PanelBody>

				<PanelBody
					title={ __(
						'Card contents',
						'frontend-login-and-registration-blocks'
					) }
				>
					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'Show the profile picture',
							'frontend-login-and-registration-blocks'
						) }
						checked={ attributes.showAvatar !== false }
						onChange={ ( value ) =>
							setAttributes( { showAvatar: value } )
						}
					/>

					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'Show the dashboard link',
							'frontend-login-and-registration-blocks'
						) }
						checked={ attributes.showDashboardLink !== false }
						onChange={ ( value ) =>
							setAttributes( { showDashboardLink: value } )
						}
						help={ __(
							'Only appears when a user dashboard page is set on the plugin settings screen.',
							'frontend-login-and-registration-blocks'
						) }
					/>

					{ attributes.showDashboardLink !== false && (
						<TextControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							label={ __(
								'Dashboard link text',
								'frontend-login-and-registration-blocks'
							) }
							value={ attributes.labels?.dashboard ?? '' }
							placeholder={ __(
								'Go to user dashboard',
								'frontend-login-and-registration-blocks'
							) }
							onChange={ ( value ) =>
								setLabel( 'dashboard', value )
							}
						/>
					) }

					<ToggleControl
						__nextHasNoMarginBottom
						label={ __(
							'Show the logout link',
							'frontend-login-and-registration-blocks'
						) }
						checked={ attributes.showLogoutLink !== false }
						onChange={ ( value ) =>
							setAttributes( { showLogoutLink: value } )
						}
					/>

					{ attributes.showLogoutLink !== false && (
						<TextControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							label={ __(
								'Logout link text',
								'frontend-login-and-registration-blocks'
							) }
							value={ attributes.labels?.logout ?? '' }
							placeholder={ __(
								'Logout',
								'frontend-login-and-registration-blocks'
							) }
							onChange={ ( value ) =>
								setLabel( 'logout', value )
							}
						/>
					) }
				</PanelBody>

				<PanelBody
					title={ __(
						'Signed-out visitors',
						'frontend-login-and-registration-blocks'
					) }
					initialOpen={ false }
				>
					<SelectControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label={ __(
							'What they see',
							'frontend-login-and-registration-blocks'
						) }
						value={ attributes.loggedOutBehavior }
						options={ [
							{
								label: __(
									'Nothing, hide the block',
									'frontend-login-and-registration-blocks'
								),
								value: 'hide',
							},
							{
								label: __(
									'A message',
									'frontend-login-and-registration-blocks'
								),
								value: 'message',
							},
							{
								label: __(
									'A link to log in',
									'frontend-login-and-registration-blocks'
								),
								value: 'login-link',
							},
						] }
						onChange={ ( value ) =>
							setAttributes( { loggedOutBehavior: value } )
						}
					/>

					{ attributes.loggedOutBehavior === 'message' && (
						<TextareaControl
							__nextHasNoMarginBottom
							label={ __(
								'Message',
								'frontend-login-and-registration-blocks'
							) }
							value={ attributes.loggedOutMessage }
							placeholder={ __(
								'Please log in to see your account.',
								'frontend-login-and-registration-blocks'
							) }
							onChange={ ( value ) =>
								setAttributes( { loggedOutMessage: value } )
							}
						/>
					) }

					{ attributes.loggedOutBehavior === 'login-link' && (
						<TextControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							label={ __(
								'Link text',
								'frontend-login-and-registration-blocks'
							) }
							value={ attributes.labels?.login ?? '' }
							placeholder={ __(
								'Login',
								'frontend-login-and-registration-blocks'
							) }
							onChange={ ( value ) => setLabel( 'login', value ) }
						/>
					) }
				</PanelBody>
			</InspectorControls>

			<InspectorControls group="styles">
				<LayoutPanel { ...props } />
				<AvatarPanel { ...props } />
				<DescriptionPanel { ...props } />
				<LinkPanel { ...props } />
				<NoticePanel { ...props } />
			</InspectorControls>
		</>
	);
}
