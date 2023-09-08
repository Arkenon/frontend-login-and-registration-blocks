<?php

/**
 * Helper functions.
 *
 * This class has helper functions to develop our plugin easier.
 *
 * @since 1.0.0
 * @package    Frontend_Login_With_Gutenberg_Blocks
 * @subpackage Frontend_Login_With_Gutenberg_Blocks/inc
 */

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

use FLWGB\I18n\I18n;

class Helper {

	/**
	 * Filters string for $_POST, $_GET or $_REQUEST operations
	 *
	 * @param string $str
	 *
	 * @return array|string $str or array
	 * @since 1.0.0
	 */
	private static function filter_request_string( string $str ) {

		return is_array( $str ) ? array_map( [
			'self',
			'filter_request_string'
		], $str ) : htmlspecialchars( trim( $str ) );

	}

	/**
	 * Secures $_POST operation
	 *
	 * @param string $name $_POST['name']
	 *
	 * @return mixed|null $_POST['name'] or null when !isset($_POST['name'])
	 * @since 1.0.0
	 */
	public static function post( string $name ) {

		$_POST = array_map( [ 'self', 'filter_request_string' ], $_POST );

		return $_POST[ $name ] ?? null;

	}

	/**
	 * Secures $_GET operation
	 *
	 * @param string $name $_GET['name']
	 *
	 * @return mixed|null $_GET['name'] or null when !isset($_GET['name'])
	 * @since 1.0.0
	 */
	public static function get( string $name ) {

		$_GET = array_map( [ 'self', 'filter_request_string' ], $_GET );

		return $_GET[ $name ] ?? null;

	}

	/**
	 * Secures $_REQUEST operation
	 *
	 * @param string $name $_REQUEST['name']
	 *
	 * @return mixed|null $_REQUEST['name'] or null when !isset($_REQUEST['name'])
	 * @since 1.0.0
	 */
	public static function request( string $name ) {

		$_REQUEST = array_map( [ 'self', 'filter_request_string' ], $_REQUEST );

		return $_REQUEST[ $name ] ?? null;

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
	public static function return_view( string $path, array $block_attributes = [] ): string {

		$view = "";

		//Get attributes
		$form_attributes = $block_attributes;

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
	 * @param string $query_item Post item
	 * @param array $option_name Option name
	 *
	 * @since 1.0.0
	 */
	public static function get_select_options_from_query( $query_item, $option_name ) {

		$selected = $query_item->post_name === esc_attr( get_option( $option_name ) ) ? " selected" : "";

		echo '<option value="' . esc_attr( $query_item->post_name ) . '"' . $selected . '>
			' . $query_item->post_title . '
		  </option>';

	}

}

