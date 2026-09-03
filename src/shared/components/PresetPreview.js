/**
 * A miniature of a design, built from the design itself.
 *
 * Rather than shipping a static icon per preset, this renders the real form
 * classes with the preset's own custom properties and scales the result down.
 * The preview therefore cannot drift from what the preset actually does: change
 * a token and the thumbnail changes with it.
 *
 * It is decorative, so the whole thing is hidden from assistive technology --
 * the preset's name and description carry the meaning.
 */

import { buildStyleVars, buildWrapperClasses } from '../style-vars';

/**
 * @param {Object} props        Component props.
 * @param {Object} props.preset The preset to draw.
 * @param {number} props.fields How many input rows to show.
 * @return {Element} The miniature.
 */
export default function PresetPreview( { preset, fields = 2 } ) {
	const { attributes } = preset;

	// The core support attributes a preset sets under `style` are serialised by
	// core on the real block; here they are applied by hand so the thumbnail
	// shows the card, padding and border too, not just the token driven parts.
	const supports = attributes.style || {};
	const surface = {
		backgroundColor: supports.color?.background,
		color: supports.color?.text,
		padding: supports.spacing?.padding
			? `${ supports.spacing.padding.top } ${ supports.spacing.padding.right } ${ supports.spacing.padding.bottom } ${ supports.spacing.padding.left }`
			: undefined,
		borderRadius: supports.border?.radius,
		borderColor: supports.border?.color,
		borderStyle: supports.border?.style,
		borderWidth: supports.border?.width,
	};

	return (
		<span className="flr-preview" aria-hidden="true">
			<span className="flr-preview__scale">
				<span
					className={ buildWrapperClasses( attributes ) }
					style={ {
						...buildStyleVars( attributes ),
						...surface,
						display: 'block',
					} }
				>
					<span className="flr-blocks-form">
						{ Array.from( { length: fields } ).map(
							( unused, index ) => (
								<span
									className="flr-blocks-form-row"
									key={ index }
								>
									<span className="flr-blocks-input-group">
										<span className="flr-blocks-input-label">
											{ index === 0
												? 'Username'
												: 'Password' }
										</span>
										<span
											className="flr-blocks-input-control"
											style={ {
												display: 'block',
												height: '2.2em',
											} }
										/>
									</span>
								</span>
							)
						) }

						<span className="flr-blocks-form-row flr-blocks-form-row--submit">
							<span
								className="flr-blocks-btn"
								style={ { display: 'inline-block' } }
							>
								Log in
							</span>
						</span>

						<span className="flr-blocks-links">
							<span className="flr-blocks-link-preview">
								Lost password
							</span>
						</span>
					</span>
				</span>
			</span>
		</span>
	);
}
