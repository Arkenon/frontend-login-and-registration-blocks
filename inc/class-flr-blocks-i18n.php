<?php

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly


/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */
class Flr_Blocks_I18n {

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_flr_blocks_textdomain(): void {

		load_plugin_textdomain(
			"flr-blocks",
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

	/**
	 * Set translations for custom blocks
	 *
	 * @since    1.0.0
	 */
	/*public function load_block_translations(): void {
		wp_set_script_translations( 'frontend-login-with-gutenberg-blocks-login-form-editor-script-js', 'flr-blocks' );

	}*/

}
