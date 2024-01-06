<?php
/**
 * User settings operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Flr_Blocks_User_Settings {

	/**
	 * Load user settings actions.
	 *
	 * @since    1.0.0
	 */
	public function load_user_settings_actions() {

		//Load ajax callback
		add_action( 'wp_ajax_nopriv_flrblocksusersettingsupdatehandle', [
			$this,
			'flr_blocks_user_settings_handle_ajax_callback'
		] );
		add_action( 'wp_ajax_flrblocksusersettingsupdatehandle', [
			$this,
			'flr_blocks_user_settings_handle_ajax_callback'
		] );

	}


	/**
	 * User settings form html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of user settings form
	 * @since 1.0.0
	 */
	public function user_settings_form( array $block_attributes ) {

		$frontend = new Flr_Blocks_Public();

		//Get user settings form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/user-settings/user-settings-form.php', $block_attributes );

	}

	/**
	 * POST operation for user settings.
	 *
	 * @return string|false a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flr_blocks_user_settings_handle_ajax_callback() {

		header( 'Access-Control-Allow-Origin: *' );

		$user_id = Flr_Blocks_Helper::sanitize( 'user_id', 'post', 'id' );

		$user_info = get_userdata( $user_id );

		$user_info->first_name  = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-first-name', 'post', 'text' );
		$user_info->last_name   = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-last-name', 'post', 'text' );
		$user_info->user_email  = Flr_Blocks_Helper::sanitize( 'flr-blocks-email-update', 'post', 'email' );
		$user_info->user_url    = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-website', 'post', 'text' );
		$user_info->description = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-bio', 'post', 'textarea' );

		$update = wp_update_user( $user_info );

		if ( ! is_wp_error( $update ) ) {

			$current_password   = Flr_Blocks_Helper::sanitize( 'flr-blocks-current-password', 'post' );
			$new_password       = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-update', 'post' );
			$new_password_again = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-again-update', 'post' );

			if ( ! empty( $new_password ) && ! empty( $new_password_again ) ) {

				if ( $user_info ) {

					if ( wp_check_password( $current_password, $user_info->user_pass, $user_id ) ) {

						if ( ( ! empty( $new_password ) && ! empty( $new_password_again ) ) && ( $new_password != $new_password_again ) ) {

							wp_send_json( array(
								'status'  => false,
								'message' => esc_html_x( "Your passwords do not match", "password_match_error", "flr-blocks" )
							) );

							wp_die();

						} else {

							wp_set_password( $new_password, $user_id );

							wp_send_json( array(
								'status'  => true,
								'message' => esc_html_x( "Operation has been completed successfully.", "general_success_message", "flr-blocks" )
							) );

							wp_die();

						}

					} else {

						wp_send_json( array(
							'status'  => false,
							'message' => esc_html_x( "Make sure your user information is correct.", "check_your_user_info_error", "flr-blocks" )
						) );

						wp_die();

					}


				} else {

					wp_send_json( array(
						'status'  => false,
						'message' => esc_html_x( "Your current password is wrong. Please check it again.", "current_password_error", "flr-blocks" )
					) );

					wp_die();

				}
			} else {

				wp_send_json( array(
					'status'  => true,
					'message' => esc_html_x( "Operation has been completed successfully.", "general_success_message", "flr-blocks" )
				) );

				wp_die();

			}

		} else {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Something went wrong. Please try again later.", "general_error_message", "flr-blocks" )
			) );

			wp_die();

		}

	}

}
