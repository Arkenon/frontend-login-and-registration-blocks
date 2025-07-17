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

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

class Flr_Blocks_Block_Handler {

	public function load_flr_blocks() {
		add_action( 'init', [ $this, 'register_blocks' ] );
		add_action('enqueue_block_editor_assets', [$this, 'set_script_translations']);
	}

	/**
	 * Register Block Types
	 *
	 * @since    1.0.0
	 */
	public function register_blocks() {

		$blocks = [
			'login-form' => 'login_form_render_callback',
			'register-form' => 'register_form_render_callback',
			'reset-password-form' => 'reset_password_form_render_callback',
			'user-activation' => 'user_activation_render_callback',
			'welcome-card' => 'welcome_card_render_callback',
			'user-settings-form' => 'user_settings_render_callback',
			'logout-nav-menu-item' => 'logout_menu_item_render_callback'
		];

		foreach ($blocks as $block_name => $callback_method) {
			register_block_type(
				plugin_dir_path(dirname(__FILE__)) . '/build/' . $block_name,
				[
					'render_callback' => [$this, $callback_method]
				]
			);
		}
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

		foreach ($blocks as $block) {
			$script_handle = "frontend-login-with-gutenberg-blocks-{$block}-editor-script";
			wp_set_script_translations(
				$script_handle,
				'frontend-login-and-registration-blocks',
				plugin_dir_path(dirname(__FILE__)) . 'languages'
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
	 * @return string Login form html template
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
	 * @return string Login form template html
	 * @since    1.0.0
	 */
	public function register_form_render_callback( array $block_attributes ): string {

		$register = new Flr_Blocks_Registration();

		return $register->register_form( $block_attributes );


	}

	/**
	 * Callback function for lost password form block
	 *
	 * @return string Lost password form template html
	 * @since    1.0.0
	 */
	public function reset_password_form_render_callback( array $block_attributes ): string {

		$lost_password = new Flr_Blocks_Lost_Password();

		return $lost_password->lost_password_form( $block_attributes );

	}

	/**
	 * Callback function for user activation block
	 *
	 * @return string User activation block template html
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
	 * @return string Welcome card block template html
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
}
