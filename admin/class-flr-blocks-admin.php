<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flr_Blocks_Admin {
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( "flr-blocks-admin-css", FLR_BLOCKS_PLUGIN_URL . '/admin/css/flr-blocks-admin.css', array(), FLR_BLOCKS_VERSION, 'all' );

	}

	/**
	 * Register the stylesheets for the block editor (Common styles).
	 *
	 * @since    1.0.0
	 */
	public function editor_styles() {

		add_editor_style( array( FLR_BLOCKS_PLUGIN_URL . '/admin/css/flr-blocks-editor.css' ) );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( "flr-blocks-admin-js", FLR_BLOCKS_PLUGIN_URL . '/admin/js/flr-blocks-admin.js', array(), FLR_BLOCKS_VERSION, false );

	}

	/**
	 * Print admin panel options page.
	 *
	 * @since    1.0.0
	 */
	public function get_options_page() {

		//Include options page html template from options_page.php
		Flr_Blocks_Helper::print_view( 'admin/partials/options-page.php' );

	}
}
