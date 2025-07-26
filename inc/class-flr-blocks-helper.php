<?php

/**
 * Helper functions.
 *
 * This class has helper functions to develop our plugin easier.
 *
 * @since 1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

use WP_Post;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Helper {

	/**
	 * Sanitize input
	 *
	 * @param string $name Input name
	 * @param string $method GET or POST or REQUEST
	 * @param string $type Type of input (title, id, textarea, url, email, username, text, bool), default is text
	 *
	 * @return bool|int|string|null
	 * @since 1.0.0
	 */
	public static function sanitize( string $name, string $method, string $type = "text" ) {

		$value  = "";
		$method = strtolower( $method );

		// This is a helper function for sanitizing input, nonce verification is not needed here
		// phpcs:disable WordPress.Security.NonceVerification.Missing
		// phpcs:disable WordPress.Security.NonceVerification.Recommended
		$input = $method === 'post' ? $_POST : ( $method === 'get' ? $_GET : $_REQUEST );

		if ( isset( $input[ $name ] ) ) {
			$value = wp_unslash( $input[ $name ] );
			$value = is_array( $value ) ? self::sanitizeArray( $value ) : sanitize_text_field( $value );
		}

		if ( isset( $value ) ) {
			switch ( $type ) {
				case "title":
					return sanitize_title( $value );
				case "id":
					return absint( $value );
				case "textarea":
					return sanitize_textarea_field( $value );
				case "url":
					return esc_url_raw( $value );
				case "email":
					return sanitize_email( $value );
				case "username":
					return sanitize_user( $value );
				case "bool":
					return rest_sanitize_boolean( $value );
				default:
					return $value;
			}
		}

		return null;
		// phpcs:enable WordPress.Security.NonceVerification.Missing
		// phpcs:enable WordPress.Security.NonceVerification.Recommended
	}

	/**
	 * Sanitize an array recursively
	 *
	 * @param array $array
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public static function sanitizeArray( array $array ): array {
		return array_map( function ( $value ) {
			if ( is_array( $value ) ) {
				return self::sanitizeArray( $value );
			}

			return sanitize_text_field( $value );
		}, array_combine(
			array_map( 'sanitize_text_field', array_keys( $array ) ),
			$array
		) );
	}

	/**
	 * Print a php page as a view
	 * To return a view uses include_once() function
	 *
	 * @param string $path Path for view page
	 *
	 * @since 1.0.0
	 */
	public static function print_view( string $path ) {

		include_once plugin_dir_path( dirname( __FILE__ ) ) . $path;

	}

	/**
	 * Returns an HTML variable as a view
	 * To return a view uses include_once() function
	 *
	 * @param string $path Path for view page
	 * @param array $form_attributes
	 *
	 * @return string $view
	 * @since 1.0.0
	 */
	public static function return_view( string $path, array $form_attributes = [] ): string {

		$view = "";

		// Note: $form_attributes is available as array to the included view files
		// No need for dangerous extract() - view files use $form_attributes['key'] directly
		//Include php file which has a variable named $view and equals to html output
		include_once plugin_dir_path( dirname( __FILE__ ) ) . $path;

		return $view;

	}

	/**
	 * Includes a class or function.
	 *
	 * @param string $path Path for view page
	 *
	 * @since 1.0.0
	 */
	public static function using( string $path ) {

		require_once plugin_dir_path( dirname( __FILE__ ) ) . $path;

	}

	/**
	 * Select option input helper for post query
	 *
	 * @param WP_Post $query_item Post item
	 * @param string $option_name Option name
	 *
	 * @since 1.0.0
	 */
	public static function get_select_options_from_query( WP_Post $query_item, string $option_name ) {

		$selected = $query_item->post_name === esc_attr( get_option( $option_name ) ) ? " selected='true'" : "";

		$options = '<option value="' . esc_attr( $query_item->post_name ) . '"' . $selected . '>
			' . esc_html( $query_item->post_title ) . '
		  </option>';

		echo wp_kses(
			$options,
			[
				'option' => [
					'value'    => [],
					'selected' => []
				]
			]
		);

	}

	/**
	 * Get and check form button attributes
	 *
	 * @param array $form_attributes Block attributes
	 *
	 * @return string $button_style CSS style for the button
	 * @since 1.0.2
	 */
	public static function get_button_style( array $form_attributes ): string {

		$button_text_color       = $form_attributes['buttonTextColor'] ?? '';
		$button_text_font_weight = $form_attributes['buttonTextFontWeight'] ?? '';
		$button_bg_color         = $form_attributes['buttonBgColor'] ?? '';
		$button_border_radius    = $form_attributes['buttonBorderRadius'] ?? '';
		$button_border_color     = array_key_exists( 'color', $form_attributes['buttonBorder'] ) ? 'border-color: ' . $form_attributes['buttonBorder']['color'] . ';' : "";
		$button_border_style     = array_key_exists( 'style', $form_attributes['buttonBorder'] ) ? 'border-style: ' . $form_attributes['buttonBorder']['style'] . ';' : "";
		$button_border_width     = array_key_exists( 'width', $form_attributes['buttonBorder'] ) ? 'border-width: ' . $form_attributes['buttonBorder']['width'] . ';' : "";

		$button_style = 'color:' . $button_text_color . '; ' .
		                'background-color: ' . $button_bg_color . '; ' .
		                $button_border_color .
		                $button_border_style .
		                $button_border_width .
		                'border-radius: ' . $button_border_radius . 'px;' .
		                'font-weight: ' . $button_text_font_weight;

		return $button_style;
	}

	/**
	 * Get and check form label attributes
	 *
	 * @param array $form_attributes Block attributes
	 *
	 * @return string $label_style CSS style for the label
	 * @since 1.0.2
	 */
	public static function get_label_style( array $form_attributes ): string {

		$text_color       = $form_attributes['textColor'] ?? '';
		$text_font_weight = $form_attributes['textFontWeight'] ?? '';
		$label_style      = 'color:' . $text_color . '; font-weight:' . $text_font_weight;

		return $label_style;
	}

	/**
	 * Get and check form label attributes
	 *
	 * @param array $form_attributes Block attributes
	 *
	 * @return string $input_style CSS style for the label
	 * @since 1.0.2
	 */
	public static function get_input_style( array $form_attributes ): string {

		$input_border_radius = $form_attributes['inputBorderRadius'] ?? '';
		$input_style         = 'border-radius:' . $input_border_radius . 'px';

		return $input_style;
	}

}

