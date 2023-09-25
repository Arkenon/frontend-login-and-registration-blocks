<?php
/**
 * Reset password operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class LostPassword {

	/**
	 * Reset password form html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of reset password form
	 * @since 1.0.0
	 */
	public function lost_password_form( array $block_attributes ): string {

		$frontend = new Frontend();

		//Get reset password form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/reset-password/reset-password-form.php', $block_attributes );
	}

	/**
	 * Load reset password actions.
	 *
	 * @since    1.0.0
	 */
	public function load_reset_password_actions() {

		add_action( 'wp_ajax_nopriv_flwgbresetpasswordhandle', [ $this, 'flwgb_reset_password_handle_ajax_callback' ] );
		add_action( 'wp_ajax_flwgbresetpasswordhandle', [ $this, 'flwgb_reset_password_handle_ajax_callback' ] );

		add_action( 'wp_ajax_nopriv_flwgbresetrequesthandle', [
			$this,
			'flwgb_reset_password_request_handle_ajax_callback'
		] );
		add_action( 'wp_ajax_flwgbresetrequesthandle', [ $this, 'flwgb_reset_password_request_handle_ajax_callback' ] );

	}

	/**
	 * POST operation for sending reset password request.
	 *
	 * @since 1.0.0
	 */
	public function flwgb_reset_password_request_handle_ajax_callback() {

		header( 'Access-Control-Allow-Origin: *' );

		check_ajax_referer( 'flwgbresetrequesthandle', 'security' );

		$email      = Helper::post( 'flwgb-email' );
		$user       = get_user_by( 'email', $email );
		$user_id    = $user->ID;
		$username   = $user->user_login;
		$code       = sha1( $user_id . time() );
		$reset_link = site_url( get_option( 'flwgb_lost_password_page' ) ) . '/?reset=in-progress&key=' . $code . '&user=' . $user_id;

		$params = [
			'username'   => $username,
			'email'      => $email,
			'reset_link' => $reset_link
		];

		$mail = new Mail();

		$send_reset_password_email = $mail->send_mail( 'flwgb_reset_request_mail_to_user', 'reset_password_request_mail_to_user_template', $params, _x( 'Reset Password Request', 'reset_request_mail_title', 'flwgb' ) );

		if ( $send_reset_password_email ) {

			update_user_meta( $user_id, 'flwgb_lost_password_key', $code );

			echo json_encode( array(
				'status'  => true,
				'message' => esc_html_x( "We have successfully get your request. We have sent you an e-mail. Please check your inbox...", "reset_password_request_confirmation", "flwgb" )
			) );

		} else {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "Something went wrong. Please try again later.", "general_error_message", "flwgb" )
			) );

		}

		wp_die();

	}

	/**
	 * POST operation for reset password form.
	 *
	 * @return string|false a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flwgb_reset_password_handle_ajax_callback() {

		header( 'Access-Control-Allow-Origin: *' );

		check_ajax_referer( 'flwgbresetpasswordhandle', 'security' );

		$user_id  = Helper::post( 'userid' );
		$user     = get_userdata( $user_id );
		$email    = $user->user_email;
		$username = $user->user_login;

		$new_password       = Helper::post( 'resetpass_pwd' );
		$new_password_again = Helper::post( 'resetpass_pwd_again' );

		$params = [
			'username' => $username,
			'email'    => $email,
		];

		if ( $new_password === $new_password_again ) {

			$reset_pass = wp_update_user( array(
				'ID'        => Helper::post( 'userid' ),
				'user_pass' => wp_slash( Helper::post( 'resetpass_pwd' ) )
			) );

			if ( ! is_wp_error( $reset_pass ) ) {

				delete_user_meta( intval( Helper::post( 'userid' ) ), 'flwgb_lost_password_key' );

				$mail = new Mail();

				$mail->send_mail( 'flwgb_reset_password_mail_to_user', 'reset_password_mail_to_user_template', $params, _x( 'Your Password Changed', 'reset_password_mail_title', 'flwgb' ));

				echo json_encode( array(
					'status'  => true,
					'message' => esc_html_x( "Your password has been changed. Please sign in...", "password_changed_confirmation", "flwgb" )
				) );

			} else {

				echo json_encode( array(
					'status'  => false,
					'message' => $reset_pass->get_error_message()
				) );

			}

		} else {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "Your passwords do not match", "password_match_error", "flwgb" )
			) );

		}

		wp_die();

	}

}
