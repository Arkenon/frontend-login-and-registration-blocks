/**
 * The Settings tab panels: what the form contains and what it says.
 *
 * These are data driven so all four form blocks share them. A block passes the
 * list of toggles it actually has and the list of fields whose wording can be
 * overridden; nothing here is block specific.
 */

import { __ } from '@wordpress/i18n';
import {
	PanelBody,
	ToggleControl,
	TextControl,
	SelectControl,
} from '@wordpress/components';
import { useOptionGroup } from '../../hooks/use-style-group';
import { resolveOptions } from '../../style-vars';

/**
 * Field visibility and behaviour.
 *
 * @param {Object} props              Block edit props.
 * @param {Array}  props.extraToggles Block specific toggles, [{ key, label, help }].
 * @return {Element} The panel.
 */
export function FieldOptionsPanel( { extraToggles = [], ...props } ) {
	const { attributes } = props;
	const { setOption } = useOptionGroup( props );
	const options = resolveOptions( attributes );

	return (
		<PanelBody
			title={ __( 'Fields', 'frontend-login-and-registration-blocks' ) }
		>
			<ToggleControl
				__nextHasNoMarginBottom
				label={ __(
					'Show labels',
					'frontend-login-and-registration-blocks'
				) }
				checked={ options.showLabels !== false }
				onChange={ ( value ) => setOption( 'showLabels', value ) }
				help={ __(
					'Turn off to rely on placeholders alone. Fields keep an accessible name either way.',
					'frontend-login-and-registration-blocks'
				) }
			/>

			{ options.showLabels !== false && (
				<SelectControl
					__next40pxDefaultSize
					__nextHasNoMarginBottom
					label={ __(
						'Label position',
						'frontend-login-and-registration-blocks'
					) }
					value={ options.labelPosition || 'top' }
					options={ [
						{
							label: __(
								'Above the field',
								'frontend-login-and-registration-blocks'
							),
							value: 'top',
						},
						{
							label: __(
								'Beside the field',
								'frontend-login-and-registration-blocks'
							),
							value: 'inline',
						},
						{
							label: __(
								'Visually hidden',
								'frontend-login-and-registration-blocks'
							),
							value: 'hidden',
						},
					] }
					onChange={ ( value ) =>
						setOption( 'labelPosition', value )
					}
				/>
			) }

			<ToggleControl
				__nextHasNoMarginBottom
				label={ __(
					'Show placeholders',
					'frontend-login-and-registration-blocks'
				) }
				checked={ !! options.showPlaceholders }
				onChange={ ( value ) => setOption( 'showPlaceholders', value ) }
			/>

			<ToggleControl
				__nextHasNoMarginBottom
				label={ __(
					'Mark required fields',
					'frontend-login-and-registration-blocks'
				) }
				checked={ !! options.requiredMark }
				onChange={ ( value ) => setOption( 'requiredMark', value ) }
				help={ __(
					'Adds an asterisk after the label of every required field.',
					'frontend-login-and-registration-blocks'
				) }
			/>

			{ extraToggles.map( ( toggle ) => (
				<ToggleControl
					key={ toggle.key }
					__nextHasNoMarginBottom
					label={ toggle.label }
					help={ toggle.help }
					checked={ !! options[ toggle.key ] }
					onChange={ ( value ) => setOption( toggle.key, value ) }
				/>
			) ) }

			<ToggleControl
				__nextHasNoMarginBottom
				label={ __(
					'Use theme button style',
					'frontend-login-and-registration-blocks'
				) }
				checked={ !! options.useThemeButton }
				onChange={ ( value ) => setOption( 'useThemeButton', value ) }
				help={ __(
					'Hands the submit button to your theme. The Submit button style panel is disabled while this is on.',
					'frontend-login-and-registration-blocks'
				) }
			/>
		</PanelBody>
	);
}

/**
 * Wording overrides for labels, placeholders and buttons.
 *
 * Every field falls back to its translated default when left blank, so an empty
 * box here is not an empty label on the page.
 *
 * @param {Object} props        Block edit props.
 * @param {Array}  props.fields [{ key, label, hasPlaceholder }].
 * @return {Element} The panel.
 */
export function TextOverridesPanel( { fields = [], ...props } ) {
	const { attributes, setAttributes } = props;
	const options = resolveOptions( attributes );

	const setText = ( group, key, value ) => {
		const next = { ...( attributes[ group ] || {} ) };

		if ( value === '' ) {
			delete next[ key ];
		} else {
			next[ key ] = value;
		}

		setAttributes( {
			[ group ]: Object.keys( next ).length ? next : undefined,
		} );
	};

	return (
		<PanelBody
			title={ __( 'Wording', 'frontend-login-and-registration-blocks' ) }
			initialOpen={ false }
		>
			{ fields.map( ( field ) => (
				<div key={ field.key }>
					<TextControl
						__next40pxDefaultSize
						__nextHasNoMarginBottom
						label={ field.label }
						value={ attributes.labels?.[ field.key ] ?? '' }
						placeholder={ field.placeholder }
						onChange={ ( value ) =>
							setText( 'labels', field.key, value )
						}
					/>

					{ field.hasPlaceholder && options.showPlaceholders && (
						<TextControl
							__next40pxDefaultSize
							__nextHasNoMarginBottom
							label={ sprintfLabel( field.label ) }
							value={
								attributes.placeholders?.[ field.key ] ?? ''
							}
							onChange={ ( value ) =>
								setText( 'placeholders', field.key, value )
							}
						/>
					) }
				</div>
			) ) }
		</PanelBody>
	);
}

/**
 * Label for a placeholder field, derived from its field name.
 *
 * @param {string} fieldLabel The field's own label.
 * @return {string} The control label.
 */
function sprintfLabel( fieldLabel ) {
	return `${ fieldLabel } — ${ __(
		'placeholder',
		'frontend-login-and-registration-blocks'
	) }`;
}
