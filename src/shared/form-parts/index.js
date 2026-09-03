/**
 * The editor's rendition of the form markup.
 *
 * These components exist so the canvas emits the same element structure and the
 * same class names as the PHP partials do on the front end. Both sides then
 * consume public/css/flr-blocks-forms.css, which is what makes the preview
 * trustworthy. If you change a class name here, change it in the matching
 * partial in public/partials/ in the same commit.
 *
 * The preview is a mock-up, never a working form: fields are read only and
 * skipped by the tab order so an author cannot try to log in from the editor.
 */

import { buildButtonClasses, resolveText } from '../style-vars';

/**
 * The form body. A div rather than a form element, because the editor already
 * renders inside one and nesting them is invalid.
 *
 * @param {Object}  props          Component props.
 * @param {Element} props.children The rows to render.
 * @return {Element} The form body.
 */
export function Form( { children } ) {
	return <div className="flr-blocks-form">{ children }</div>;
}

/**
 * One labelled input.
 *
 * @param {Object}  props                   Component props.
 * @param {string}  props.id                Field id, matched by the front end markup.
 * @param {string}  props.label             Visible label.
 * @param {string}  [props.type]            Input type.
 * @param {string}  [props.placeholder]     Placeholder text.
 * @param {boolean} [props.showLabel]       Render the label element at all.
 * @param {boolean} [props.showPlaceholder] Render the placeholder.
 * @param {boolean} [props.required]        Mark the field as required.
 * @return {Element} The field.
 */
export function Field( {
	id,
	label,
	type = 'text',
	placeholder = '',
	showLabel = true,
	showPlaceholder = false,
	required = false,
} ) {
	return (
		<div className="flr-blocks-form-row">
			<div className="flr-blocks-input-group">
				{ showLabel && (
					<label
						className="flr-blocks-input-label"
						htmlFor={ id }
						data-required={ required ? '1' : undefined }
					>
						{ label }
					</label>
				) }
				<input
					className="flr-blocks-input-control"
					id={ id }
					type={ type }
					readOnly
					tabIndex={ -1 }
					placeholder={ showPlaceholder ? placeholder : '' }
					aria-label={ ! showLabel ? label : undefined }
				/>
			</div>
		</div>
	);
}

/**
 * A checkbox with its label.
 *
 * @param {Object}  props           Component props.
 * @param {string}  props.id        Field id.
 * @param {string}  props.label     Visible label.
 * @param {boolean} [props.checked] Whether to draw it ticked.
 * @return {Element} The checkbox row.
 */
export function CheckboxRow( { id, label, checked = true } ) {
	return (
		<div className="flr-blocks-form-row">
			<div className="flr-blocks-form-check-group">
				<input
					id={ id }
					type="checkbox"
					className="flr-blocks-form-check-input"
					checked={ checked }
					readOnly
					tabIndex={ -1 }
				/>
				<label className="flr-blocks-form-check-label" htmlFor={ id }>
					{ label }
				</label>
			</div>
		</div>
	);
}

/**
 * The submit button, carrying the same classes the renderer gives it.
 *
 * @param {Object}  props            Component props.
 * @param {Object}  props.attributes Block attributes.
 * @param {string}  props.variant    Button variant, e.g. login or register.
 * @param {Element} props.children   Button text.
 * @return {Element} The submit row.
 */
export function SubmitButton( { attributes, variant, children } ) {
	return (
		<div className="flr-blocks-form-row flr-blocks-form-row--submit">
			<button
				type="button"
				className={ buildButtonClasses( attributes, variant ) }
				tabIndex={ -1 }
			>
				{ children }
			</button>
		</div>
	);
}

/**
 * The row of secondary links below the form.
 *
 * @param {Object} props         Component props.
 * @param {Array}  props.links   Links to draw, as [{ key, label }].
 * @param {string} [props.intro] Text before the first link.
 * @return {Element} The links row.
 */
export function LinksRow( { links, intro = '' } ) {
	return (
		<div className="flr-blocks-links">
			{ intro && <span>{ intro }</span> }
			{ links.map( ( link, index ) => (
				<span key={ link.key }>
					{ index > 0 && <span aria-hidden="true"> | </span> }
					{ /* A span, not an anchor: the real href is only known at
					     render time, and a preview link should not be clickable. */ }
					<span className="flr-blocks-link-preview">
						{ link.label }
					</span>
				</span>
			) ) }
		</div>
	);
}

/**
 * Optional explanatory text above a form.
 *
 * @param {Object}  props          Component props.
 * @param {Element} props.children The text.
 * @return {Element|null} The description.
 */
export function Description( { children } ) {
	if ( ! children ) {
		return null;
	}

	return <p className="flr-blocks-description">{ children }</p>;
}

/**
 * A success or error message, shown in the editor so its styling can be seen.
 *
 * @param {Object}  props          Component props.
 * @param {string}  [props.status] Either success or error.
 * @param {Element} props.children The message.
 * @return {Element} The notice.
 */
export function PreviewNotice( { status = 'success', children } ) {
	return (
		<div
			className={
				status === 'error' ? 'flr-blocks-danger' : 'flr-blocks-success'
			}
		>
			{ children }
		</div>
	);
}

/**
 * The user avatar used by the account blocks.
 *
 * @param {Object} props     Component props.
 * @param {string} props.src Image source.
 * @param {string} props.alt Alternative text.
 * @return {Element} The avatar.
 */
export function Avatar( { src, alt } ) {
	return <img className="flr-blocks-avatar" src={ src } alt={ alt } />;
}

/**
 * A note that only the editor shows, for behaviour a preview cannot convey.
 *
 * @param {Object}  props          Component props.
 * @param {Element} props.children The note text.
 * @return {Element} The note.
 */
export function EditorNote( { children } ) {
	return <p className="flr-blocks-editor-notice">{ children }</p>;
}

/**
 * Resolve a label, its placeholder and whether each should show.
 *
 * Saves every field in every block repeating the same three lookups.
 *
 * @param {Object} attributes  Block attributes.
 * @param {Object} options     Resolved field options.
 * @param {string} key         Field key.
 * @param {string} label       Translated default label.
 * @param {string} placeholder Translated default placeholder.
 * @return {Object} Props for Field.
 */
export function fieldProps( attributes, options, key, label, placeholder ) {
	return {
		label: resolveText( attributes, 'labels', key, label ),
		placeholder: resolveText(
			attributes,
			'placeholders',
			key,
			placeholder
		),
		// showLabels drops the element entirely and falls back to aria-label;
		// labelPosition "hidden" keeps it in the DOM and hides it visually, which
		// is the accessible choice and is handled in CSS, not here.
		showLabel: options.showLabels !== false,
		showPlaceholder: !! options.showPlaceholders,
	};
}
