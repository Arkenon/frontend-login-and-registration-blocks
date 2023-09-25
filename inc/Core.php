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

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

Helper::using( 'inc/Loader.php' );


class Core extends Loader {

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
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
	 * - \PLUGIN_NAMESPACE\Blocks. Load block types
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_required_dependencies() {

		/**
		 * The class responsible for registering block types
		 */
		Helper::using( 'inc/Blocks.php' );

		/**
		 * The class responsible for defining internationalization functionality
		 */
		Helper::using( 'inc/I18n.php' );

	}

	/**
	 * Get admin dashboard options page
	 *
	 * Creates a menu item in admin dashboard and prints an options page
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_options() {

		/**
		 * The class responsible for admin options.
		 */
		Helper::using( 'inc/Options.php' );

		$plugin_options = new Options();

		self::add_action( 'plugins_loaded', $plugin_options, 'load_flwgb_options' );

	}

	/**
	 * Get login form actions
	 *
	 * Load login actions from Login Class
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_login_actions() {

		/**
		 * The class responsible for login operations.
		 */
		Helper::using( 'inc/Login.php' );

		$login = new Login();

		self::add_action( 'plugins_loaded', $login, 'load_login_actions' );

	}

	/**
	 * Get register form ajax actions.
	 *
	 * Get ajax handle action from Register.php
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_register_form_actions() {

		/**
		 * The class responsible for registeration operations.
		 */
		Helper::using( 'inc/Register.php' );

		$register = new Register();

		self::add_action( 'plugins_loaded', $register, 'load_register_actions' );

	}

	/**
	 * Get user settings form ajax actions.
	 *
	 * Get ajax handle action from UserSettings.php
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_user_settings_form_actions() {

		/**
		 * The class responsible for user settings operations.
		 */
		Helper::using( 'inc/UserSettings.php' );

		$user_settings = new UserSettings();

		self::add_action( 'plugins_loaded', $user_settings, 'load_user_settings_actions' );

	}

	/**
	 * Get lost password form ajax actions.
	 *
	 * Get ajax handle action from Register.php
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_reset_password_form_actions() {

		/**
		 * The class responsible for registration operations.
		 */
		Helper::using( 'inc/LostPassword.php' );

		$lost_password = new LostPassword();

		self::add_action( 'plugins_loaded', $lost_password, 'load_reset_password_actions' );

	}

	/**
	 * Get block types
	 *
	 * Block types registered at class \FLWGB\Blocks
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_block_types() {

		$plugin_options = new Blocks();

		self::add_action( 'plugins_loaded', $plugin_options, 'load_flwgb_blocks' );

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

		$plugin_i18n = new I18n();

		self::add_action( 'plugins_loaded', $plugin_i18n, 'load_flwgb_textdomain' );

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
		Helper::using( 'admin/Backend.php' );

		$plugin_admin = new Backend();

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

		Helper::using( 'public/Frontend.php' );

		$plugin_public = new Frontend();

		self::add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		self::add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

	}

	/**
	 *
	 * Actions from Mail class.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_wp_mail_actions() {

		Helper::using( 'inc/Mail.php' );

		$mail = new Mail();

		//Set mail content type as html
		self::add_filter( 'wp_mail_content_type', $mail, 'mail_html_format' );

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
