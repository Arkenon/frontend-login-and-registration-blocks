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

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Backend {
	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( "flwgb-admin-css", plugin_dir_url( __FILE__ ) . 'css/flwgb-admin.css', array(), FLWGB_VERSION, 'all' );

	}

	/**
	 * Register the stylesheets for the block editor (Common styles).
	 *
	 * @since    1.0.0
	 */
	public function editor_styles() {

		add_editor_style( array( plugin_dir_url( __FILE__ ) . 'css/flwgb-editor.css' ) );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( "flwgb-admin-js", plugin_dir_url( __FILE__ ) . 'js/flwgb-admin.js', array( 'jquery' ), FLWGB_VERSION, false );

	}

	/**
	 * Print admin panel options page.
	 *
	 * @since    1.0.0
	 */
	public function get_options_page() {

		//Include options page html template from options_page.php
		Helper::print_view( 'admin/partials/options-page.php' );

	}
}
