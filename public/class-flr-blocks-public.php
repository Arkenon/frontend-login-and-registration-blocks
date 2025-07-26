<?php
/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/public
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flr_Blocks_Public {

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() : void {

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

		wp_enqueue_style( "flr-blocks-public", FLR_BLOCKS_PLUGIN_URL . '/public/css/flr-blocks-public.css', array(), FLR_BLOCKS_VERSION, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() : void {

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

		wp_enqueue_script( "flr-blocks-public", FLR_BLOCKS_PLUGIN_URL . '/public/js/flr-blocks-public.js', array(), FLR_BLOCKS_VERSION, array('strategy' => 'defer') );
		wp_localize_script( "flr-blocks-public", 'flr_blocks_ajax_object', array( 'ajax_url' => admin_url( 'admin-ajax.php' ) ) );

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
		return Flr_Blocks_Helper::return_view( $path, $block_attributes );

	}

}
