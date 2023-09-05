<?php
/**
 * Class for plugin settings.
 *
 * This is used to register settings, create an options page at admin dashboard.
 *
 * @since      1.0.0
 * @package    Frontend_Login_With_Gutenberg_Blocks
 * @subpackage Frontend_Login_With_Gutenberg_Blocks/inc
 */

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Options {

	/**
	 * Load options page
	 *
	 * @since    1.0.0
	 */
	public function load_flwgb_options() {

		if ( current_user_can( "administrator" ) ) {

			// Register the options menu page
			add_action( 'admin_menu', [ $this, 'flwgb_options_page' ] );

		}

		// Register the options with their default values
		add_action( 'admin_init', [ $this, 'flwgb_register_settings' ] );

	}

	/**
	 * Add a menu page into admin dashboard
	 *
	 * @since    1.0.0
	 */
	public function flwgb_options_page() {

		add_menu_page(
			'Frontend Login with Gutenberg Blocks',
			'Frontend Login',
			'manage_options',
			'frontend-login-with-gutenberg-blocks-settings',
			[ $this, 'flwgb_settings_page_html' ],
			'dashicons-migrate'
		);
	}

	/**
	 * Register settings for options page
	 *
	 * @since    1.0.0
	 */
	public function flwgb_register_settings() {

		// General settings
		register_setting( 'flwgb-general-settings-group', 'flwgb_redirect_after_login' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_login_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_redirect_from_wp_login_admin' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_lost_password_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_register_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_activation_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_user_settings_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_terms_and_conditions_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_privacy_policy_page' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_has_activation' );
		register_setting( 'flwgb-general-settings-group', 'flwgb_has_user_dashboard' );

		// E-Mail settings
		register_setting( 'flwgb-mail-settings-group', 'flwgb_register_mail_to_user' );
		register_setting( 'flwgb-mail-settings-group', 'flwgb_register_mail_to_user_with_activation' );
		register_setting( 'flwgb-mail-settings-group', 'flwgb_register_mail_to_admin' );
		register_setting( 'flwgb-mail-settings-group', 'flwgb_reset_request_mail_to_user' );
		register_setting( 'flwgb-mail-settings-group', 'flwgb_reset_password_mail_to_user' );

		// Limit login attempt settings
		register_setting( 'flwgb-limit-login-settings-group', 'flwgb_enable_limit_login' );
		register_setting( 'flwgb-limit-login-settings-group', 'flwgb_limit_login_max_attempts' );
		register_setting( 'flwgb-limit-login-settings-group', 'flwgb_limit_login_lockout_duration' );

	}

	/**
	 * Define the options page markup
	 *
	 * @since    1.0.0
	 */
	public function flwgb_settings_page_html() {

		$backend = new Backend();

		//Get options page html output from Backend class
		$backend->get_options_page();

	}

}

