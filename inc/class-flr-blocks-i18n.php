<?php

namespace FLR_BLOCKS;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;


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
	public function load_flr_blocks_textdomain() {

		load_plugin_textdomain(
			"flr-blocks",
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
