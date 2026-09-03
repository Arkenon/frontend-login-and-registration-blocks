/**
 * Inspector for the login/logout navigation item.
 */

import { __ } from '@wordpress/i18n';
import { InspectorControls } from '@wordpress/block-editor';
import { PanelBody, ToggleControl } from '@wordpress/components';

/**
 * @param {Object}   props               Block edit props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Block attribute setter.
 * @return {Element} The inspector.
 */
export default function Inspector( { attributes, setAttributes } ) {
	return (
		<InspectorControls group="settings">
			<PanelBody
				title={ __(
					'Visibility',
					'frontend-login-and-registration-blocks'
				) }
			>
				<ToggleControl
					__nextHasNoMarginBottom
					label={ __(
						'Show to signed-out visitors',
						'frontend-login-and-registration-blocks'
					) }
					checked={ attributes.showWhenLoggedOut !== false }
					onChange={ ( value ) =>
						setAttributes( { showWhenLoggedOut: value } )
					}
					help={ __(
						'When off, the item disappears entirely instead of turning into a login link.',
						'frontend-login-and-registration-blocks'
					) }
				/>
			</PanelBody>
		</InspectorControls>
	);
}
