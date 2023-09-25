<?php
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Blocks {

	public function load_flwgb_blocks() {
		add_action( 'init', [ $this, 'register_flwgb_blocks' ] );
	}

	/**
	 * Register Block Types
	 *
	 * @since    1.0.0
	 */
	public function register_flwgb_blocks() {

		//Login Form Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/login-form',
			[
				'render_callback' => [ $this, 'login_form_render_callback' ]
			] );

		//Register Form Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/register-form',
			[
				'render_callback' => [ $this, 'register_form_render_callback' ]
			] );

		//Lost Password Form Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/reset-password-form',
			[
				'render_callback' => [ $this, 'reset_password_form_render_callback' ]
			] );

		//User Activation Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/user-activation',
			[
				'render_callback' => [ $this, 'user_activation_render_callback' ]
			] );

		//Welcome Card Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/welcome-card',
			[
				'render_callback' => [ $this, 'welcome_card_render_callback' ]
			] );

		//User Settings Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/user-settings-form',
			[
				'render_callback' => [ $this, 'user_settings_render_callback' ]
			] );

		//Logout Menu Item Block
		register_block_type( plugin_dir_path( dirname( __FILE__ ) ) . '/build/logout-nav-menu-item',
			[
				'render_callback' => [ $this, 'logout_menu_item_render_callback' ]
			] );

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

		$login = new UserSettings();

		return $login->user_settings_form( $block_attributes );

	}

	/**
	 * Callback function for login form block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string Login form html template
	 * @since    1.0.0
	 */
	public function login_form_render_callback( array $block_attributes ): string {

		$login = new Login();

		return $login->login_form( $block_attributes );

	}

	/**
	 * Callback function for register form block
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string Login form template html
	 * @since    1.0.0
	 */
	public function register_form_render_callback( array $block_attributes ): string {

		$register = new Register();

		return $register->register_form( $block_attributes );


	}

	/**
	 * Callback function for lost password form block
	 *
	 * @return string Lost password form template html
	 * @since    1.0.0
	 */
	public function reset_password_form_render_callback( array $block_attributes ): string {

		$lost_password = new LostPassword();

		return $lost_password->lost_password_form( $block_attributes );

	}

	/**
	 * Callback function for user activation block
	 *
	 * @return string User activation block template html
	 * @since    1.0.0
	 */
	public function user_activation_render_callback( array $block_attributes ): string {

		Helper::using( 'inc/UserActivation.php' );

		$lost_password = new UserActivation();

		return $lost_password->user_activation_block( $block_attributes );

	}

	/**
	 * Callback function for welcome card block
	 *
	 * @return string Welcome card block template html
	 * @since    1.0.0
	 */
	public function welcome_card_render_callback( array $block_attributes ): string {

		$lost_password = new Login();

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

		Helper::using( "inc/Logout.php" );
		$logout = new Logout();

		return $logout->logout_menu_item( $block_attributes );

	}
}
