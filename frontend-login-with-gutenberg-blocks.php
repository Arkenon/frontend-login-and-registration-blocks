<?php
/**
 * Plugin Name:       Frontend Login with Gutenberg Blocks
 * Plugin URI:        https://xideathemes.gitbook.io/frontend-login-with-gutenberg-blocks/
 * Description:       Do login, register and lost password operations from frontend with Gutenberg blocks. Easily customize forms and add to your pages.
 * Requires at least: 5.9
 * Requires PHP:      7.0
 * Version:           1.0.0
 * Author:            Kadim Gültekin
 * Text Domain:       flwgb
 * Domain Path:       /languages
 * @package           Frontend_Login_With_Gutenberg_Blocks
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

use FLWGB\Activator;
use FLWGB\Deactivator;
use FLWGB\Flwgb;
use FLWGB\Helper;

//Get helper functions at first.
require plugin_dir_path( __FILE__ ) . 'inc/Helper.php';

/**
 * Get plugin data.
 *
 * @since    1.0.0
 */
function flwgb_get_plugin_data(): array {

	return get_file_data(
		__FILE__,
		array(
			'version' => 'Version'
		)
	);

}

/**
 * Define plugin data.
 *
 * @since    1.0.0
 */
define( 'FLWGB_VERSION', flwgb_get_plugin_data()['version'] );


/**
 * The code that runs during plugin activation.
 * This action is documented in inc/Activator.php
 * @since    1.0.0
 */
function activate_flwgb() {

	Helper::using( 'inc/Activator.php' );

	Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in inc/Deactivator.php
 * @since    1.0.0
 */
function deactivate_flwgb() {

	Helper::using( 'inc/Deactivator.php' );

	Deactivator::deactivate();

}

/**
 * Register activation and deactivation hooks
 * @since    1.0.0
 */
register_activation_hook( __FILE__, 'activate_flwgb' );
register_deactivation_hook( __FILE__, 'deactivate_flwgb' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, public-facing site hooks and more...
 */
Helper::using( 'inc/Flwgb.php' );

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
$plugin = new Flwgb();

$plugin->run();
