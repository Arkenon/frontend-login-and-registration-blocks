/**
 * The screen a form block shows before it has been given a design.
 *
 * Core has no generic mechanism that turns block variations into a setup
 * screen -- the blocks that offer one (columns, query, social links) each render
 * their own -- so this is that screen. Picking a design is a single
 * setAttributes of the preset's attribute bundle; Start blank sets only the flag
 * that dismisses this screen, leaving the block on the stylesheet defaults.
 */

import { __ } from '@wordpress/i18n';
import { Placeholder, Button } from '@wordpress/components';
import { HStack } from './controls';
import { PRESETS } from '../presets';
import PresetPreview from './PresetPreview';

/**
 * @param {Object}   props               Component props.
 * @param {Element}  props.icon          Block icon.
 * @param {string}   props.title         Block title.
 * @param {number}   props.previewFields How many rows the miniatures show.
 * @param {Function} props.setAttributes Block attribute setter.
 * @return {Element} The setup screen.
 */
export default function FormSetupPlaceholder( {
	icon,
	title,
	previewFields = 2,
	setAttributes,
} ) {
	const choose = ( preset ) =>
		setAttributes( preset ? preset.attributes : { templateChosen: true } );

	return (
		<Placeholder
			icon={ icon }
			label={ title }
			className="flr-setup"
			instructions={ __(
				'Pick a design to start from. Every colour, size and spacing stays editable afterwards.',
				'frontend-login-and-registration-blocks'
			) }
		>
			<ul className="flr-setup__grid">
				{ PRESETS.map( ( preset ) => (
					<li key={ preset.name }>
						<Button
							className="flr-setup__card"
							onClick={ () => choose( preset ) }
							label={ preset.description }
							showTooltip
						>
							<PresetPreview
								preset={ preset }
								fields={ previewFields }
							/>
							<span className="flr-setup__title">
								{ preset.title }
							</span>
						</Button>
					</li>
				) ) }
			</ul>

			<HStack justify="flex-start">
				<Button variant="tertiary" onClick={ () => choose( null ) }>
					{ __(
						'Start blank',
						'frontend-login-and-registration-blocks'
					) }
				</Button>
			</HStack>
		</Placeholder>
	);
}
