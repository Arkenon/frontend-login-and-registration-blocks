import { registerBlockType } from '@wordpress/blocks';
import { people } from '@wordpress/icons';
import metadata from './block.json';
import Edit from './edit';
import { registerPresetVariations } from '../shared/presets/register-variations';

registerBlockType( metadata.name, {
	icon: people,
	edit: Edit,
} );

registerPresetVariations( metadata.name, people );
