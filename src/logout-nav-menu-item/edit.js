import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';

export default function Edit(props) {

	const blockProps = useBlockProps(props);

	return (

		<a {...blockProps}>

			{__('Logout','frontend-login-and-registration-blocks')}

		</a>

	);
}
