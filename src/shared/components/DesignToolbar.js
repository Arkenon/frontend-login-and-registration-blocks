/**
 * The Design control in the block toolbar.
 *
 * Lets an author swap designs after the setup screen has gone, and get back to
 * a clean slate. Reset clears the style groups but deliberately leaves
 * fieldOptions alone: which fields a form shows is a content decision, not part
 * of its look.
 */

import { __ } from '@wordpress/i18n';
import { BlockControls } from '@wordpress/block-editor';
import {
	ToolbarGroup,
	ToolbarDropdownMenu,
	ToolbarButton,
	MenuGroup,
	MenuItem,
} from '@wordpress/components';
import { styles, seen, unseen } from '@wordpress/icons';
import { PRESETS, resetDesignAttributes } from '../presets';
import { useOptionGroup } from '../hooks/use-style-group';
import { resolveOptions } from '../style-vars';

/**
 * @param {Object}   props               Component props.
 * @param {Object}   props.attributes    Block attributes.
 * @param {Function} props.setAttributes Block attribute setter.
 * @return {Element} The toolbar controls.
 */
export default function DesignToolbar( props ) {
	const { attributes, setAttributes } = props;
	const { setOption } = useOptionGroup( props );
	const options = resolveOptions( attributes );
	const showLabels = options.showLabels !== false;

	return (
		<BlockControls group="block">
			<ToolbarGroup>
				<ToolbarDropdownMenu
					icon={ styles }
					label={ __(
						'Design',
						'frontend-login-and-registration-blocks'
					) }
				>
					{ ( { onClose } ) => (
						<>
							<MenuGroup
								label={ __(
									'Start from a design',
									'frontend-login-and-registration-blocks'
								) }
							>
								{ PRESETS.map( ( preset ) => (
									<MenuItem
										key={ preset.name }
										isSelected={
											attributes.preset === preset.name
										}
										onClick={ () => {
											setAttributes( preset.attributes );
											onClose();
										} }
									>
										{ preset.title }
									</MenuItem>
								) ) }
							</MenuGroup>

							<MenuGroup>
								<MenuItem
									onClick={ () => {
										setAttributes(
											resetDesignAttributes()
										);
										onClose();
									} }
								>
									{ __(
										'Reset design',
										'frontend-login-and-registration-blocks'
									) }
								</MenuItem>
							</MenuGroup>
						</>
					) }
				</ToolbarDropdownMenu>

				<ToolbarButton
					icon={ showLabels ? seen : unseen }
					label={ __(
						'Toggle field labels',
						'frontend-login-and-registration-blocks'
					) }
					isPressed={ showLabels }
					onClick={ () => setOption( 'showLabels', ! showLabels ) }
				/>
			</ToolbarGroup>
		</BlockControls>
	);
}
