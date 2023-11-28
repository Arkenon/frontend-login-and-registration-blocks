<?php
/**
 * Plugin Name:       Frontend Login and Registration Blocks
 * Plugin URI:        https://frontendlogin.iyziweb.site/
 * Description:       Do login, register and lost password operations from frontend with Gutenberg blocks. Easily customize forms and add to your pages.
 * Requires at least: 6.1
 * Requires PHP:      7.4
 * Version:           1.0.0
 * Author:            Kadim Gültekin
 * Author URI:        https://github.com/Arkenon
 * Text Domain:       flr-blocks
 * Domain Path:       /languages
 * @package           Frontend_Login_And_Registration_Blocks
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

//TODO check path and url
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
function flr_blocks_get_plugin_data(): array {

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
define( 'FLR_BLOCKS_VERSION', flr_blocks_get_plugin_data()['version'] );


/**
 * The code that runs during plugin activation.
 * This action is documented in inc/class-flr-blocks-activator.php
 * @since    1.0.0
 */
function activate_flr_blocks() {

	Flr_Blocks_Helper::using( 'inc/class-flr-blocks-activator.php' );

	Flr_Blocks_Activator::activate();

}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in inc/class-flr-blocks-deactivator.php
 * @since    1.0.0
 */
function deactivate_flr_blocks() {

	Flr_Blocks_Helper::using( 'inc/class-flr-blocks-deactivator.php' );

	Flr_Blocks_Deactivator::deactivate();

}

/**
 * Register activation and deactivation hooks
 * @since    1.0.0
 */
register_activation_hook( __FILE__, 'activate_flr_blocks' );
register_deactivation_hook( __FILE__, 'deactivate_flr_blocks' );

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
