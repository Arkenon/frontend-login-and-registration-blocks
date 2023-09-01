<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Frontend_Login_With_Gutenberg_Blocks
 * @subpackage Frontend_Login_With_Gutenberg_Blocks/public
 */

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Frontend {

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( "flwgb-public-css", plugin_dir_url( __FILE__ ) . 'css/flwgb-public.css', array(), FLWGB_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Plugin_Name_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plugin_Name_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( "flwgb-public-js", plugin_dir_url( __FILE__ ) . 'js/flwgb-public.js', array( 'jquery' ), FLWGB_VERSION, false );
		wp_localize_script( 'jquery', 'flwgb_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );
	}

	/**
	 * Get a form from defined path
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string Login form html
	 * @since    1.0.0
	 */
	public function get_the_form(string $path, array $block_attributes) : string  {

		//Return html output of the form
		return Helper::return_view( $path, $block_attributes );

	}

}
