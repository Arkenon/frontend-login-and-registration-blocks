import { registerBlockType } from '@wordpress/blocks';
import { rotateLeft } from '@wordpress/icons';
import metadata from './block.json';
import Edit from './edit';
import { registerPresetVariations } from '../shared/presets/register-variations';

registerBlockType( metadata.name, {
	icon: rotateLeft,
	edit: Edit,
} );

registerPresetVariations( metadata.name, rotateLeft );
