<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Block_Handler {

	public function load_flr_blocks() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action( 'enqueue_block_editor_assets', [ $this, 'set_script_translations' ] );
		add_action( 'wp_enqueue_scripts', [ $this, 'add_frontend_config' ] );
	}

	/**
	 * Register Block Types
	 *
	 * @since    1.0.0
	 */
	public function register_blocks() {

		$this->register_block_styles();

		$blocks = [
			'login-form'           => 'login_form_render_callback',
			'register-form'        => 'register_form_render_callback',
			'reset-password-form'  => 'reset_password_form_render_callback',
			'user-activation'      => 'user_activation_render_callback',
			'welcome-card'         => 'welcome_card_render_callback',
			'user-settings-form'   => 'user_settings_render_callback',
			'logout-nav-menu-item' => 'logout_menu_item_render_callback'
		];

		foreach ( $blocks as $block_name => $callback_method ) {
			register_block_type(
				plugin_dir_path( dirname( __FILE__ ) ) . '/build/' . $block_name,
				[
					'render_callback' => [ $this, $callback_method ]
				]
			);
		}
	}

	/**
	 * Register the shared stylesheets the blocks reference by handle.
	 *
	 * flr-blocks-forms is listed in both the style and editorStyle fields of
	 * every block, so the editor canvas and the front end load the same file
	 * with the same selectors. That is what keeps the preview honest, and it is
	 * why no rule in it needs !important: there is no second copy to fight.
	 *
	 * Registering by handle rather than pointing block.json at a built asset
	 * also means the sheet loads only on pages that actually use a block,
	 * instead of on every request.
	 *
	 * Must run before the register_block_type() loop so the handles resolve.
	 *
	 * @since    2.0.0
	 */
	private function register_block_styles() {

		wp_register_style(
			'flr-blocks-forms',
			FLR_BLOCKS_PLUGIN_URL . 'public/css/flr-blocks-forms.css',
			[],
			FLR_BLOCKS_VERSION
		);

		wp_register_style(
			'flr-blocks-editor-ui',
			FLR_BLOCKS_PLUGIN_URL . 'admin/css/flr-blocks-editor-ui.css',
			[],
			FLR_BLOCKS_VERSION
		);

	}

	public function set_script_translations() {
		$blocks = [
			'login-form',
			'register-form',
			'reset-password-form',
			'user-activation',
			'welcome-card',
			'user-settings-form',
			'logout-nav-menu-item'
		];

		foreach ( $blocks as $block ) {
			$script_handle = "frontend-login-with-gutenberg-blocks-{$block}-editor-script";
			wp_set_script_translations(
				$script_handle,
				'frontend-login-and-registration-blocks',
				plugin_dir_path( dirname( __FILE__ ) ) . 'languages'
			);
		}
	}

	/**
	 * Callback function for user settings form block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string User settings form html template
	 * @since    1.0.0
	 */
	public function user_settings_render_callback( array $block_attributes ): string {

		$login = new Flr_Blocks_User_Settings();

		return $login->user_settings_form( $block_attributes );

	}

	/**
	 * Callback function for login form block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string Login form HTML template
	 * @since    1.0.0
	 */
	public function login_form_render_callback( array $block_attributes ): string {

		$login = new Flr_Blocks_Login();

		return $login->login_form( $block_attributes );

	}

	/**
	 * Callback function for register form block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string Login form template HTML
	 * @since    1.0.0
	 */
	public function register_form_render_callback( array $block_attributes ): string {

		$register = new Flr_Blocks_Registration();

		return $register->register_form( $block_attributes );


	}

	/**
	 * Callback function for lost password form block
	 *
	 * @return string Lost password form template HTML
	 * @since    1.0.0
	 */
	public function reset_password_form_render_callback( array $block_attributes ): string {

		$lost_password = new Flr_Blocks_Lost_Password();

		return $lost_password->lost_password_form( $block_attributes );

	}

	/**
	 * Callback function for user activation block
	 *
	 * @return string User activation block template HTML
	 * @since    1.0.0
	 */
	public function user_activation_render_callback( array $block_attributes ): string {

		Flr_Blocks_Helper::using( 'inc/class-flr-blocks-user-activation.php' );

		$lost_password = new Flr_Blocks_User_Activation();

		return $lost_password->user_activation_block( $block_attributes );

	}

	/**
	 * Callback function for welcome card block
	 *
	 * @return string Welcome card block template HTML
	 * @since    1.0.0
	 */
	public function welcome_card_render_callback( array $block_attributes ): string {

		$lost_password = new Flr_Blocks_Login();

		return $lost_password->welcome_card( $block_attributes );

	}

	/**
	 * Callback function for logout menu item block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string User settings form html template
	 * @since    1.0.0
	 */
	public function logout_menu_item_render_callback( array $block_attributes ): string {

		Flr_Blocks_Helper::using( "inc/class-flr-blocks-logout.php" );
		$logout = new Flr_Blocks_Logout();

		return $logout->logout_menu_item( $block_attributes );

	}

	/**
	 * Global config for blocks
	 * Includes AJAX URL, nonce, and strings for frontend scripts.
	 * @since    1.2.0
	 */
	public function add_frontend_config() {
		// Only add config on pages that could use blocks
		if ( is_admin() || ! has_blocks() ) {
			return;
		}

		// Provide configuration data for frontend scripts
		$ajax_config = [
			'ajax_url' => admin_url( 'admin-ajax.php' ),
			'nonce'    => wp_create_nonce( 'flr_blocks_nonce' ),
			'strings'  => [
				'loading' => __( 'Loading...', 'frontend-login-and-registration-blocks' ),
				'error'   => __( 'An error occurred', 'frontend-login-and-registration-blocks' ),
				'success' => __( 'Success!', 'frontend-login-and-registration-blocks' )
			]
		];

		// Register minimal script handle for config
		wp_register_script( 'flr-blocks-config', '', [], FLR_BLOCKS_VERSION, false );
		wp_enqueue_script( 'flr-blocks-config' );

		// Add config via wp_add_inline_script
		wp_add_inline_script(
			'flr-blocks-config',
			'window.flr_blocks_ajax_object = ' . wp_json_encode( $ajax_config ),
			'before'
		);
	}
}
