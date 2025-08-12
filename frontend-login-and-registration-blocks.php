<?php
/**
 * Plugin Name: Login, Registration and Lost Password Blocks
 * Plugin URI: https://frontendlogin.iyziweb.site/
 * Description: A collection of Gutenberg blocks for login, registration and lost password forms and more...
 * Requires at least: 6.1
 * Requires PHP: 7.4
 * Version: 1.2.0
 * Author: Kadim Gültekin
 * Author URI: https://github.com/Arkenon
 * Text Domain: frontend-login-and-registration-blocks
 * Domain Path: /languages
 * License: GPL v2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

define( 'FLR_BLOCKS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'FLR_BLOCKS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Activator;
use FLR_BLOCKS\Flr_Blocks_Deactivator;
use FLR_BLOCKS\Flr_Blocks_Core;

//Get helper functions at first.
require plugin_dir_path( __FILE__ ) . 'inc/class-flr-blocks-helper.php';

/**
 * Get plugin data.
 *
 * @since    1.0.0
 */
if ( ! function_exists( 'flr_blocks_get_plugin_data' ) ) {
	function flr_blocks_get_plugin_data(): array {

		return get_file_data(
			__FILE__,
			array(
				'version' => 'Version'
			)
		);

	}
}

/**
 * Define plugin data.
 *
 * @since    1.0.0
 */
define( 'FLR_BLOCKS_VERSION', flr_blocks_get_plugin_data()['version'] );


/**
 * The code that runs during plugin activation.
 * This action is documented in inc/class-flr-blocks-activator.php
 * @since    1.0.0
 */
if ( ! function_exists( 'flr_blocks_activate' ) ) {

	function flr_blocks_activate() {

		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-activator.php' );

		Flr_Blocks_Activator::activate();

	}

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in inc/class-flr-blocks-deactivator.php
 * @since    1.0.0
 */
if ( ! function_exists( 'flr_blocks_deactivate' ) ) {

	function flr_blocks_deactivate() {

		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-deactivator.php' );

		Flr_Blocks_Deactivator::deactivate();

	}

}

/**
 * Register activation and deactivation hooks
 * @since    1.0.0
 */
register_activation_hook( __FILE__, 'flr_blocks_activate' );
register_deactivation_hook( __FILE__, 'flr_blocks_deactivate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, public-facing site hooks and more...
 */
Flr_Blocks_Helper::using( 'inc/class-flr-blocks-core.php' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
$plugin = new Flr_Blocks_Core();

$plugin->run();
