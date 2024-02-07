<?php
/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks and more.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

Flr_Blocks_Helper::using( 'inc/class-flr-blocks-loader.php' );


class Flr_Blocks_Core extends Flr_Blocks_Loader {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		//Run the constructor of parent class (Loader)
		parent::__construct();

		//Include required files (required)
		self::load_required_dependencies();

		//Load block types (required)
		self::set_block_types();

		//Load internationalization functionality (required)
		self::set_locale();

		//Load admin options functionality (optional)
		self::set_options();

		//Defines all hooks for the admin area (optional)
		self::define_admin_hooks();

		//Defines all hooks for the public area (optional)
		self::define_public_hooks();

		//Load login actions
		self::set_login_actions();

		//Load reset password actions
		self::set_register_form_actions();

		//Load user settings actions
		self::set_user_settings_form_actions();

		//Load reset password actions
		self::set_reset_password_form_actions();

		//Load e-mail actions
		self::set_wp_mail_actions();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - \FLR_BLOCKS\Flr_Blocks_Block_Handler : Load block types
	 * - \FLR_BLOCKS\Flr_Blocks_I18n : Load internalization functionality
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_required_dependencies() {

		/**
		 * The class responsible for registering block types
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-block-handler.php' );

		/**
		 * The class responsible for defining internationalization functionality
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-i18n.php' );

	}

	/**
	 *
	 * Get admin dashboard options page actions
	 *
	 * Load admin dashboard options page actions from Flr_Blocks_Options class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_options() {

		/**
		 * The class responsible for admin options.
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-options.php' );

		$plugin_options = new Flr_Blocks_Options();

		self::add_action( 'plugins_loaded', $plugin_options, 'load_flr_blocks_options' );

	}

	/**
	 * Get login form actions
	 *
	 * Load login actions from Flr_Blocks_Login class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_login_actions() {

		/**
		 * The class responsible for login operations.
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-login.php' );

		$login = new Flr_Blocks_Login();

		self::add_action( 'plugins_loaded', $login, 'load_login_actions' );

	}

	/**
	 * Get registration (sign up) form actions
	 *
	 * Load registration actions from Flr_Blocks_Registration class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_register_form_actions() {

		/**
		 * The class responsible for registration operations.
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-registration.php' );

		$register = new Flr_Blocks_Registration();

		self::add_action( 'plugins_loaded', $register, 'load_register_actions' );

	}

	/**
	 * Get user settings form actions
	 *
	 * Load user settings actions from Flr_Blocks_User_Settings class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_user_settings_form_actions() {

		/**
		 * The class responsible for user settings operations.
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-user-settings.php' );

		$user_settings = new Flr_Blocks_User_Settings();

		self::add_action( 'plugins_loaded', $user_settings, 'load_user_settings_actions' );

	}

	/**
	 * Get lost/reset password form actions
	 *
	 * Load lost/reset password actions from Flr_Blocks_Lost_Password class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_reset_password_form_actions() {

		/**
		 * The class responsible for registration operations.
		 */
		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-lost-password.php' );

		$lost_password = new Flr_Blocks_Lost_Password();

		self::add_action( 'plugins_loaded', $lost_password, 'load_reset_password_actions' );

	}

	/**
	 * Get block types
	 *
	 * Block types registered at Flr_Blocks_Block_Handler class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_block_types() {

		$plugin_options = new Flr_Blocks_Block_Handler();

		self::add_action( 'plugins_loaded', $plugin_options, 'load_flr_blocks' );

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Flr_Blocks_I18n();

		self::add_action( 'plugins_loaded', $plugin_i18n, 'load_flr_blocks_textdomain' );
		/*self::add_action( 'plugins_loaded', $plugin_i18n, 'load_block_translations' );*/

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		/**
		 * The class responsible for defining all actions that occur in the admin area and block editor
		 * Editor styles for only common css rules of blocks.
		 */
		Flr_Blocks_Helper::using( 'admin/class-flr-blocks-admin.php' );

		$plugin_admin = new Flr_Blocks_Admin();

		self::add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		self::add_action( 'init', $plugin_admin, 'editor_styles' );
		self::add_action( 'pre_get_posts', $plugin_admin, 'editor_styles' );
		self::add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		Flr_Blocks_Helper::using( 'public/class-flr-blocks-public.php' );

		$plugin_public = new Flr_Blocks_Public();

		self::add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		self::add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 * Get mail actions
	 *
	 * Load mail actions from Flr_Blocks_Mail class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_wp_mail_actions() {

		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-mail.php' );

		$mail = new Flr_Blocks_Mail();

		self::add_action( 'plugins_loaded', $mail, 'load_mail_actions' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {

		self::run_plugin();

	}

}
