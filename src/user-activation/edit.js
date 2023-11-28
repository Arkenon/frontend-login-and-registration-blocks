import './editor.scss';
import {useBlockProps} from '@wordpress/block-editor';
import {__} from '@wordpress/i18n';

export default function Edit(props) {

	const blockProps = useBlockProps(props);

	return (

		<div {...blockProps}>

			{__('This is a placeholder for the USER ACTIVATION BLOCK. Go to the front end of the page to preview the activation result.','flr-blocks')}

		</div>

	);
}
