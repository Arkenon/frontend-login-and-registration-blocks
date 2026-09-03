<?php
/**
 * Builds the repeated pieces of the form partials.
 *
 * Every form block emits the same rows: a labelled input, a checkbox with its
 * label, a submit button, a loading line, a row of links. Centralising them
 * here keeps the four partials short and, more importantly, keeps them emitting
 * identical structure and class names -- which is what lets one stylesheet
 * serve both the front end and the editor preview built from
 * src/shared/form-parts.
 *
 * Change a class name here and change it there in the same commit.
 *
 * @since      2.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Form_Markup {

	/**
	 * One labelled input row.
	 *
	 * Recognised config keys: id, name (defaults to id), key, type, required,
	 * autocomplete, label, placeholder.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $config Field configuration.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function field( array $attributes, array $config ): string {

		$options     = Flr_Blocks_Style::options( $attributes );
		$show_labels = ! empty( $options['showLabels'] );
		$required    = ! empty( $config['required'] );

		$id    = $config['id'];
		$name  = $config['name'] ?? $config['id'];
		$label = Flr_Blocks_Style::text( $attributes, 'labels', $config['key'], $config['label'] );

		$row = '<div class="flr-blocks-form-row"><div class="flr-blocks-input-group">';

		if ( $show_labels ) {
			$row .= '<label class="flr-blocks-input-label" for="' . esc_attr( $id ) . '"'
					. ( $required && ! empty( $options['requiredMark'] ) ? ' data-required="1"' : '' )
					. '>' . esc_html( $label ) . '</label>';
		}

		$placeholder = ! empty( $options['showPlaceholders'] )
			? Flr_Blocks_Style::text( $attributes, 'placeholders', $config['key'], $config['placeholder'] ?? '' )
			: '';

		$row .= '<input class="flr-blocks-input-control"'
				. ' id="' . esc_attr( $id ) . '"'
				. ' name="' . esc_attr( $name ) . '"'
				. ' type="' . esc_attr( $config['type'] ?? 'text' ) . '"'
				. ( $required ? ' required' : '' )
				. ( ! empty( $config['value'] ) ? ' value="' . esc_attr( $config['value'] ) . '"' : '' )
				. ( ! empty( $config['autocomplete'] ) ? ' autocomplete="' . esc_attr( $config['autocomplete'] ) . '"' : '' )
				. ( $show_labels ? '' : ' aria-label="' . esc_attr( $label ) . '"' )
				. ' placeholder="' . esc_attr( $placeholder ) . '" />';

		return $row . '</div></div>';

	}

	/**
	 * A textarea row, for the longer profile fields.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $config Field configuration.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function textarea( array $attributes, array $config ): string {

		$options     = Flr_Blocks_Style::options( $attributes );
		$show_labels = ! empty( $options['showLabels'] );

		$id    = $config['id'];
		$label = Flr_Blocks_Style::text( $attributes, 'labels', $config['key'], $config['label'] );

		$row = '<div class="flr-blocks-form-row"><div class="flr-blocks-input-group">';

		if ( $show_labels ) {
			$row .= '<label class="flr-blocks-input-label" for="' . esc_attr( $id ) . '">'
					. esc_html( $label ) . '</label>';
		}

		$placeholder = ! empty( $options['showPlaceholders'] )
			? Flr_Blocks_Style::text( $attributes, 'placeholders', $config['key'], $config['placeholder'] ?? '' )
			: '';

		$row .= '<textarea class="flr-blocks-textarea-control"'
				. ' id="' . esc_attr( $id ) . '"'
				. ' name="' . esc_attr( $config['name'] ?? $id ) . '"'
				. ' rows="' . esc_attr( $config['rows'] ?? 4 ) . '"'
				. ( $show_labels ? '' : ' aria-label="' . esc_attr( $label ) . '"' )
				. ' placeholder="' . esc_attr( $placeholder ) . '">'
				. esc_textarea( $config['value'] ?? '' )
				. '</textarea>';

		return $row . '</div></div>';

	}

	/**
	 * A checkbox with its label.
	 *
	 * The label may contain markup (the terms and privacy row links out), so it
	 * is passed through wp_kses with an anchor allowance rather than esc_html.
	 *
	 * @param string $id Field id and name.
	 * @param string $label Label markup.
	 * @param bool $checked Whether it starts ticked.
	 * @param bool $required Whether it must be ticked.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function checkbox_row( string $id, string $label, bool $checked = true, bool $required = false ): string {

		return '<div class="flr-blocks-form-row">
					<div class="flr-blocks-form-check-group">
						<input id="' . esc_attr( $id ) . '" name="' . esc_attr( $id ) . '" type="checkbox" class="flr-blocks-form-check-input"'
				. ( $checked ? ' checked="checked"' : '' )
				. ( $required ? ' required' : '' ) . '/>
						<label class="flr-blocks-form-check-label" for="' . esc_attr( $id ) . '">'
				. wp_kses( $label, [ 'a' => [ 'href' => [], 'target' => [], 'rel' => [] ] ] )
				. '</label>
					</div>
				</div>';

	}

	/**
	 * The submit row and the loading line that follows it.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $variant Button variant, e.g. login or register.
	 * @param string $submit_id Button id, read by the block's view module.
	 * @param string $loading_id Loading element id, read by the same module.
	 * @param string $label Button text.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function submit( array $attributes, string $variant, string $submit_id, string $loading_id, string $label ): string {

		return '<div class="flr-blocks-form-row flr-blocks-form-row--submit">
					<button type="submit" id="' . esc_attr( $submit_id ) . '" class="'
				. esc_attr( Flr_Blocks_Style::button_class( $attributes, $variant ) ) . '">'
				. esc_html( $label ) . '</button>
				</div>
				<div id="' . esc_attr( $loading_id ) . '" class="flr-blocks-loading flr-blocks-hide">'
				. esc_html_x( 'Loading...', 'loading_text', 'frontend-login-and-registration-blocks' )
				. '</div>';

	}

	/**
	 * The container the view module writes success and error messages into.
	 *
	 * It sits outside the form element and starts empty. The stylesheet hides it
	 * while it is empty, so the space between the form and whatever follows only
	 * opens up once there is actually a message to show.
	 *
	 * @param string $id Element id, read by the block's view module.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function result( string $id ): string {

		return '<div id="' . esc_attr( $id ) . '" class="flr-blocks-form-result"></div>';

	}

	/**
	 * The row of secondary links below a form.
	 *
	 * @param array $links Links, each [ 'url' => string, 'label' => string ].
	 * @param string $intro Optional text before the first link.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function links( array $links, string $intro = '' ): string {

		$links = array_values( array_filter( $links, static function ( $link ) {
			return ! empty( $link['label'] );
		} ) );

		if ( empty( $links ) ) {
			return '';
		}

		$row = '<div class="flr-blocks-links">';

		if ( '' !== $intro ) {
			$row .= '<span>' . esc_html( $intro ) . '</span>';
		}

		foreach ( $links as $index => $link ) {

			if ( $index > 0 ) {
				$row .= '<span aria-hidden="true">|</span>';
			}

			$row .= '<a href="' . esc_url( $link['url'] ) . '">' . esc_html( $link['label'] ) . '</a>';

		}

		return $row . '</div>';

	}

	/**
	 * The hidden action and nonce pair every form posts.
	 *
	 * @param string $action AJAX action name, also the nonce name.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function form_action( string $action ): string {

		return '<input type="hidden" name="action" value="' . esc_attr( $action ) . '">'
				. '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( $action ) ) . '">';

	}

	/**
	 * Optional descriptive text above a form.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $key Key within the content group.
	 * @param string $fallback Translated default.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function description( array $attributes, string $key, string $fallback ): string {

		$options = Flr_Blocks_Style::options( $attributes );

		if ( empty( $options['showDescription'] ) ) {
			return '';
		}

		$text = Flr_Blocks_Style::text( $attributes, 'content', $key, $fallback );

		if ( '' === trim( $text ) ) {
			return '';
		}

		return '<p class="flr-blocks-description">' . esc_html( $text ) . '</p>';

	}

}
