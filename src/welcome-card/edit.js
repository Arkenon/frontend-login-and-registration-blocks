import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';

export default function Edit(props) {

	const blockProps = useBlockProps(props);

	return (

		<div {...blockProps}>

			{__('This is a placeholder for the WELCOME CARD BLOCK to display a welcome card for logged in users. Card has a logout button... Go to the front end of the page to preview the activation result.', 'frontend-login-and-registration-blocks')}

		</div>

	);
}
