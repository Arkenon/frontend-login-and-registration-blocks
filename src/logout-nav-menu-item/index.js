import { registerBlockType } from '@wordpress/blocks';
import { login } from '@wordpress/icons';
import metadata from './block.json';
import Edit from './edit';

registerBlockType( metadata.name, {
	icon: login,
	edit: Edit,
} );
