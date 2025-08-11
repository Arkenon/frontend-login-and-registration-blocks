<?php
/**
 * Class for plugin settings.
 *
 * This is used to register settings, create an options page at admin dashboard.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Options {

	/**
	 * Load options page
	 *
	 * @since    1.0.0
	 */
	public function load_flr_blocks_options() {

		if ( current_user_can( "administrator" ) ) {

			// Register the options menu page
			add_action( 'admin_menu', [ $this, 'flr_blocks_options_page' ] );

		}

		// Register the options with their default values
		add_action( 'admin_init', [ $this, 'flr_blocks_register_settings' ] );

	}

	/**
	 * Add a menu page into admin dashboard
	 *
	 * @since    1.0.0
	 */
	public function flr_blocks_options_page() {

		add_menu_page(
			'Frontend Login and Registration Blocks',
			'Frontend Login',
			'manage_options',
			'frontend-login-with-gutenberg-blocks-settings',
			[ $this, 'flr_blocks_settings_page_html' ],
			'dashicons-migrate'
		);
	}

	/**
	 * Register settings for options page
	 *
	 * @since    1.0.0
	 */
	public function flr_blocks_register_settings() {

		// General settings
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_redirect_after_login', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_login_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_redirect_from_wp_login_admin', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_lost_password_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_register_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_activation_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_user_settings_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_terms_and_conditions_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_privacy_policy_page', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_has_activation', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-general-settings-group', 'flr_blocks_has_user_dashboard', [ 'sanitize_callback' => 'sanitize_text_field' ] );

		// E-Mail settings
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_enable_mails', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_register_mail_to_user', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_register_mail_to_user_with_activation', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_register_mail_to_admin', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_reset_request_mail_to_user', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-mail-settings-group', 'flr_blocks_reset_password_mail_to_user', [ 'sanitize_callback' => 'sanitize_text_field' ] );

		// Limit login attempt settings
		register_setting( 'flr-blocks-limit-login-settings-group', 'flr_blocks_enable_limit_login', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-limit-login-settings-group', 'flr_blocks_limit_login_max_attempts', [ 'sanitize_callback' => 'intval' ] );
		register_setting( 'flr-blocks-limit-login-settings-group', 'flr_blocks_limit_login_lockout_duration', [ 'sanitize_callback' => 'intval' ] );

		//TODO add new options
		// Advanced settings
		register_setting( 'flr-blocks-advanced-settings-group', 'flr_blocks_enable_password_strength', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-advanced-settings-group', 'flr_blocks_enable_username_validation', [ 'sanitize_callback' => 'sanitize_text_field' ] );
		register_setting( 'flr-blocks-advanced-settings-group', 'flr_blocks_enaable_limit_reset_request_attempts', [ 'sanitize_callback' => 'sanitize_text_field' ] );
	}

	/**
	 * Define the options page markup
	 *
	 * @since    1.0.0
	 */
	public function flr_blocks_settings_page_html() {

		$backend = new Flr_Blocks_Admin();

		//Get options page html output from Backend class
		$backend->get_options_page();

	}

}

