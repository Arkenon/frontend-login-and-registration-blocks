/**
 * Editor view of the welcome card.
 *
 * The greeting supports placeholder tokens that are filled in from the visitor
 * at render time. The canvas resolves them against whoever is editing, so an
 * author sees a realistic sentence rather than raw braces.
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
	resolveText,
} from '../shared/style-vars';
import { Avatar, LinksRow, EditorNote } from '../shared/form-parts';

export const DEFAULT_GREETING = 'Hello {display_name},';

/**
 * Replace the greeting placeholders with a user's details.
 *
 * Mirrors the substitution in public/partials/login/already-logged-in.php.
 *
 * @param {string} greeting Raw greeting text.
 * @param {Object} user     The user to fill in, may be undefined.
 * @return {string} The resolved greeting.
 */
export function resolveGreeting( greeting, user ) {
	const values = {
		'{username}': user?.username || user?.slug || '',
		'{display_name}': user?.name || '',
		'{first_name}': user?.first_name || user?.name || '',
		'{email}': user?.email || '',
	};

	return Object.entries( values ).reduce(
		( text, [ token, value ] ) => text.split( token ).join( value ),
		greeting
	);
}

export default function Edit( props ) {
	const { attributes, setAttributes } = props;

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
						'Welcome Card',
						'frontend-login-and-registration-blocks'
					) }
					previewFields={ 1 }
					setAttributes={ setAttributes }
				/>
			</div>
		);
	}

	const links = [];

	if ( attributes.showDashboardLink !== false ) {
		links.push( {
			key: 'dashboard',
			label: resolveText(
				attributes,
				'labels',
				'dashboard',
				__(
					'Go to user dashboard',
					'frontend-login-and-registration-blocks'
				)
			),
		} );
	}

	if ( attributes.showLogoutLink !== false ) {
		links.push( {
			key: 'logout',
			label: resolveText(
				attributes,
				'labels',
				'logout',
				__( 'Logout', 'frontend-login-and-registration-blocks' )
			),
		} );
	}

	return (
		<>
			<DesignToolbar { ...props } />
			<Inspector { ...props } />

			<div { ...blockProps }>
				<div className="flr-blocks-card">
					{ attributes.showAvatar !== false && (
						<Avatar
							src={ currentUser?.avatar_urls?.[ 96 ] || '' }
							alt={ __(
								'Your profile picture',
								'frontend-login-and-registration-blocks'
							) }
						/>
					) }

					<p className="flr-blocks-description">
						{ resolveGreeting(
							attributes.greeting || DEFAULT_GREETING,
							currentUser
						) }
					</p>

					{ links.length > 0 && <LinksRow links={ links } /> }
				</div>

				<EditorNote>
					{ __(
						'Visitors who are not signed in see this block behave as set under Signed-out visitors.',
						'frontend-login-and-registration-blocks'
					) }
				</EditorNote>
			</div>
		</>
	);
}
