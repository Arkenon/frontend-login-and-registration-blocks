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
	 * Validate password strength
	 *
	 * @param string $password Password to validate
	 * @param int $min_length Minimum password length (default: 8)
	 *
	 * @return array Validation result with status and message
	 * @since 1.0.0
	 */
	public static function validate_password_strength( string $password, int $min_length = 8 ): array {

		// Check minimum length
		if ( strlen( $password ) < $min_length ) {
			return [
				'valid' => false,
				'message' => sprintf(
					/* translators: %d is the minimum password length */
					\esc_html__( 'Password must be at least %d characters long.', 'frontend-login-and-registration-blocks' ),
					$min_length
				)
			];
		}

		// Check for at least one uppercase letter
		if ( ! preg_match( '/[A-Z]/', $password ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Password must contain at least one uppercase letter.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for at least one lowercase letter
		if ( ! preg_match( '/[a-z]/', $password ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Password must contain at least one lowercase letter.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for at least one number
		if ( ! preg_match( '/[0-9]/', $password ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Password must contain at least one number.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for at least one special character
		if ( ! preg_match( '/[^A-Za-z0-9]/', $password ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Password must contain at least one special character.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for common weak passwords
		$weak_passwords = [
			'password', 'password123', '123456', '123456789', 'qwerty', 'abc123',
			'password1', 'admin', 'test', 'user', 'guest', 'demo'
		];

		if ( in_array( strtolower( $password ), $weak_passwords, true ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'This password is too common. Please choose a different password.', 'frontend-login-and-registration-blocks' )
			];
		}

		return [
			'valid' => true,
			'message' => \esc_html__( 'Password strength is good.', 'frontend-login-and-registration-blocks' )
		];
	}

	/**
	 * Enhanced email validation with additional security checks
	 *
	 * @param string $email Email to validate
	 * @return array Validation result with status and message
	 * @since 1.0.0
	 */
	public static function validate_email_security( string $email ): array {

		// Basic email validation
		if ( ! is_email( $email ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Please enter a valid email address.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for suspicious patterns
		$suspicious_patterns = [
			'/\+.*\+/',           // Multiple plus signs
			'/\.{2,}/',           // Multiple consecutive dots
			'/[<>"\']/',          // Potential XSS characters
			'/\s/',               // Whitespace in email
		];

		foreach ( $suspicious_patterns as $pattern ) {
			if ( preg_match( $pattern, $email ) ) {
				return [
					'valid' => false,
					'message' => \esc_html__( 'Email address contains invalid characters.', 'frontend-login-and-registration-blocks' )
				];
			}
		}

		// Check domain length and format
		$email_parts = explode( '@', $email );
		if ( count( $email_parts ) !== 2 ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Email address format is invalid.', 'frontend-login-and-registration-blocks' )
			];
		}

		$domain = $email_parts[1];
		if ( strlen( $domain ) > 253 || strlen( $domain ) < 1 ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Email domain is invalid.', 'frontend-login-and-registration-blocks' )
			];
		}

		return [
			'valid' => true,
			'message' => \esc_html__( 'Email address is valid.', 'frontend-login-and-registration-blocks' )
		];
	}

	/**
	 * Enhanced username validation with security checks
	 *
	 * @param string $username Username to validate
	 * @return array Validation result with status and message
	 * @since 1.0.0
	 */
	public static function validate_username_security( string $username ): array {

		// Length validation
		if ( strlen( $username ) < 3 ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Username must be at least 3 characters long.', 'frontend-login-and-registration-blocks' )
			];
		}

		if ( strlen( $username ) > 60 ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Username must be less than 60 characters long.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Character validation
		if ( ! preg_match( '/^[a-zA-Z0-9._-]+$/', $username ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Username can only contain letters, numbers, dots, underscores, and hyphens.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Reserved usernames
		$reserved_usernames = [
			'admin', 'administrator', 'root', 'test', 'demo', 'guest', 'user',
			'www', 'ftp', 'mail', 'email', 'api', 'support', 'help', 'info',
			'null', 'undefined', 'false', 'true', 'system', 'security'
		];

		if ( in_array( strtolower( $username ), $reserved_usernames, true ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'This username is reserved. Please choose a different username.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Check for consecutive special characters
		if ( preg_match( '/[._-]{2,}/', $username ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Username cannot contain consecutive special characters.', 'frontend-login-and-registration-blocks' )
			];
		}

		// Cannot start or end with special characters
		if ( preg_match( '/^[._-]|[._-]$/', $username ) ) {
			return [
				'valid' => false,
				'message' => \esc_html__( 'Username cannot start or end with special characters.', 'frontend-login-and-registration-blocks' )
			];
		}

		return [
			'valid' => true,
			'message' => \esc_html__( 'Username is valid.', 'frontend-login-and-registration-blocks' )
		];
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

