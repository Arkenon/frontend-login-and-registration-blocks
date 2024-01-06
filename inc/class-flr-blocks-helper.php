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

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Flr_Blocks_Helper {

	/**
	 * Secures $_POST operation
	 *
	 * @param string $name $_POST['name']
	 *
	 * @return mixed|null $_POST['name'] or null when !isset($_POST['name'])
	 * @since 1.0.0
	 */
	public static function sanitize( string $name, string $method, string $type = "" ) {

		$value = '';

		if ($method == 'post') {
			if (isset($_POST[$name])) {
				$value = sanitize_text_field($_POST[$name]);
			}
		} else {
			if (isset($_GET[$name])) {
				$value = sanitize_text_field($_GET[$name]);
			}
		}

		if ( isset( $value ) ) {
			switch ( $type ) {
				case "title":
					return sanitize_title( $value );
					break;
				case "id":
					return absint( $value );
					break;
				case "textarea":
					return sanitize_textarea_field( $value );
					break;
				case "url":
					return esc_url_raw( $value );
					break;
				case "email":
					return sanitize_email( $value );
					break;
				case "username":
					return sanitize_user( $value );
					break;
				default:
					return $value;
			}
		}

		return null;

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
	 * Returns an html variable as a view
	 * To return a view uses include_once() function
	 *
	 * @param string $path Path for view page
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string $view
	 * @var string $view html output
	 * @since 1.0.0
	 *
	 */
	public static function return_view( string $path, array $form_attributes = [] ): string {

		$view = "";

		//Get attributes
		extract($form_attributes);

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
	 * @param array $option_name Option name
	 *
	 * @since 1.0.0
	 */
	public static function get_select_options_from_query( WP_Post $query_item, string $option_name ) {

		$selected = $query_item->post_name === esc_attr( get_option( $option_name ) ) ? " selected" : "";

		echo '<option value="' . esc_attr( $query_item->post_name ) . '"' . $selected . '>
			' . esc_html($query_item->post_title) . '
		  </option>';

	}

}

