<?php
/**
 * User settings operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

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
	public function user_settings_form( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get user settings form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/user-settings/user-settings-form.php', $block_attributes );

	}

	/**
	 * POST operation for user settings.
	 *
	 * @return void a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flr_blocks_user_settings_handle_ajax_callback() {

		// Verify nonce for security
		check_ajax_referer( 'flrblocksusersettingsupdatehandle', 'security' );

		$user_id         = Flr_Blocks_Helper::sanitize( 'user_id', 'post', 'id' );
		$current_user_id = get_current_user_id();

		// Critical authorization check: users can only edit their own profile
		// unless they have edit_users capability (administrators)
		if ( $user_id !== $current_user_id && ! current_user_can( 'edit_users' ) ) {
			wp_send_json( array(
				'status'  => false,
				'message' => esc_html__( 'Unauthorized access. You can only edit your own profile.', 'frontend-login-and-registration-blocks' )
			) );
			wp_die();
		}

		$user_info = get_userdata( $user_id );

		if ( ! $user_info ) {
			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "User data could not be fetched.", "user_data_not_fetch_error", "frontend-login-and-registration-blocks" )
			) );
			wp_die();
		}

		$user_info->first_name  = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-first-name', 'post', 'text' );
		$user_info->last_name   = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-last-name', 'post', 'text' );
		$user_info->user_email  = Flr_Blocks_Helper::sanitize( 'flr-blocks-email-update', 'post', 'email' );
		$user_info->user_url    = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-website', 'post', 'text' );
		$user_info->description = Flr_Blocks_Helper::sanitize( 'flr-blocks-user-bio', 'post', 'textarea' );

		// Enhanced email validation if email is being updated
		if ( ! empty( $user_info->user_email ) ) {
			$email_validation = Flr_Blocks_Helper::validate_email_security( $user_info->user_email );
			if ( ! $email_validation['valid'] ) {
				wp_send_json( array(
					'status'  => false,
					'message' => $email_validation['message']
				) );
				wp_die();
			}
		}

		// Update custom fields
		do_action( 'flr_blocks_save_user_form_extra_user_fields', $user_id );

		$update = wp_update_user( $user_info );

		if ( ! is_wp_error( $update ) ) {

			$current_password   = Flr_Blocks_Helper::sanitize( 'flr-blocks-current-password', 'post' );
			$new_password       = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-update', 'post' );
			$new_password_again = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-again-update', 'post' );

			// Password update logic if new passwords are provided
			if ( ! empty( $new_password ) && ! empty( $new_password_again ) ) {

				if ( wp_check_password( $current_password, $user_info->user_pass, $user_id ) ) {

					if ( ( $new_password != $new_password_again ) ) {

						wp_send_json( array(
							'status'  => false,
							'message' => esc_html_x( "Your passwords do not match", "password_match_error", "frontend-login-and-registration-blocks" )
						) );

						wp_die();

					} else {

						// Validate new password strength
						if ( get_option( 'flr_blocks_enable_password_strength' ) !== 'no' ) {
							$password_validation = Flr_Blocks_Helper::validate_password_strength( $new_password );
							if ( ! $password_validation['valid'] ) {
								wp_send_json( array(
									'status'  => false,
									'message' => $password_validation['message']
								) );
								wp_die();
							}
						}

						wp_set_password( $new_password, $user_id );

					}

				} else {

					wp_send_json( array(
						'status'  => false,
						'message' => esc_html_x( "Please check your current password.", "check_your_user_info_error", "frontend-login-and-registration-blocks" )
					) );

					wp_die();

				}
			}

			wp_send_json( array(
				'status'     => true,
				'return_url' => Flr_Blocks_Helper::get_page_permalink( get_option( 'flr_blocks_user_settings_page' ) ),
				'message'    => esc_html_x( "User information has been updated successfully.", "general_success_message", "frontend-login-and-registration-blocks" )
			) );

		} else {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Something went wrong. Please try again later.", "general_error_message", "frontend-login-and-registration-blocks" )
			) );

		}

		wp_die();

	}

}
