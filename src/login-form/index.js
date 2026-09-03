import { registerBlockType } from '@wordpress/blocks';
import { unlock } from '@wordpress/icons';
import metadata from './block.json';
import Edit from './edit';
import { registerPresetVariations } from '../shared/presets/register-variations';

// No save function: the block is rendered in PHP, so the default of returning
// null is what we want. No stylesheet import either -- the shared sheet is
// registered as a handle and listed in block.json, which keeps one copy of it
// instead of one per block.
registerBlockType( metadata.name, {
	icon: unlock,
	edit: Edit,
} );

registerPresetVariations( metadata.name, unlock );
