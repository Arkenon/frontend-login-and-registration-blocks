<?php
/**
 * Reset password operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Lost_Password {

	/**
	 * Reset password form html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of reset password form
	 * @since 1.0.0
	 */
	public function lost_password_form( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get reset password form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/reset-password/reset-password-form.php', $block_attributes );
	}

	/**
	 * Load reset password actions.
	 *
	 * @since    1.0.0
	 */
	public function load_reset_password_actions() {

		add_action( 'wp_ajax_nopriv_flrblocksresetpasswordhandle', [
			$this,
			'flr_blocks_reset_password_handle_ajax_callback'
		] );
		add_action( 'wp_ajax_flrblocksresetpasswordhandle', [
			$this,
			'flr_blocks_reset_password_handle_ajax_callback'
		] );

		add_action( 'wp_ajax_nopriv_flrblocksresetrequesthandle', [
			$this,
			'flr_blocks_reset_password_request_handle_ajax_callback'
		] );
		add_action( 'wp_ajax_flrblocksresetrequesthandle', [
			$this,
			'flr_blocks_reset_password_request_handle_ajax_callback'
		] );

	}

	/**
	 * POST operation for sending reset password request.
	 *
	 * @since 1.0.0
	 */
	public function flr_blocks_reset_password_request_handle_ajax_callback() {

		check_ajax_referer( 'flrblocksresetrequesthandle', 'security' );

		// Rate limiting for password reset requests
		$user_ip = $this->get_real_user_ip();
		$reset_attempts = get_transient( "reset_attempts_" . $user_ip );
		$max_reset_attempts = 3; // Maximum 3 reset requests per hour
		$reset_lockout_duration = 3600; // 1 hour

		if ( $reset_attempts >= $max_reset_attempts ) {
			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Too many password reset requests. Please wait 1 hour before trying again.", "reset_rate_limit_error", "frontend-login-and-registration-blocks" )
			) );
			wp_die();
		}

		$email = Flr_Blocks_Helper::sanitize( 'flr-blocks-email', 'post', 'email' );

		if ( ! email_exists( $email ) ) {
			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Sorry, we can't find a user with that email address.", "reset_password_request_user_not_found", "frontend-login-and-registration-blocks" )
			) );
			wp_die();
		}

		$user = get_user_by( 'email', $email );

		$key = get_password_reset_key( $user );

		if ( is_wp_error( $key ) ) {
			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Something went wrong while generating the reset key. Please try again.", "general_error_message", "frontend-login-and-registration-blocks" )
			) );
			wp_die();
		}


		$username               = $user->user_login;
		$lost_password_page_url = site_url( get_option( 'flr_blocks_lost_password_page' ) );

		$reset_link = add_query_arg(
			[
				'rp_key'   => $key,
				'rp_login' => rawurlencode( $username ),
				'reset'    => 'in-progress'
			],
			$lost_password_page_url
		);

		$params = [
			'username'   => $username,
			'email'      => $email,
			'reset_link' => $reset_link,
		];

		$mail = new Flr_Blocks_Mail();

		$send_reset_password_email = $mail->send_mail( 'flr_blocks_reset_request_mail_to_user', 'reset_password_request_mail_to_user_template', $params, _x( 'Reset Password Request', 'reset_request_mail_title', 'frontend-login-and-registration-blocks' ) );

		// Increment reset attempt counter
		$reset_attempts = get_transient( "reset_attempts_" . $user_ip ) ?: 0;
		set_transient( "reset_attempts_" . $user_ip, $reset_attempts + 1, $reset_lockout_duration );

		if ( $send_reset_password_email ) {

			wp_send_json( array(
				'status'  => true,
				'message' => esc_html_x( "We have successfully get your request. We have sent you an e-mail. Please check your inbox...", "reset_password_request_confirmation", "frontend-login-and-registration-blocks" )
			) );

		} else {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Reset password e-mail can not sent. Please contact with site administrator.", "general_error_message", "frontend-login-and-registration-blocks" )
			) );

		}

		wp_die();

	}

	/**
	 * POST operation for a reset password form.
	 *
	 * @return void a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flr_blocks_reset_password_handle_ajax_callback() {

		check_ajax_referer( 'flrblocksresetpasswordhandle', 'security' );

		$rp_key             = Flr_Blocks_Helper::sanitize( 'rp_key', 'post' );
		$rp_login           = Flr_Blocks_Helper::sanitize( 'rp_login', 'post' );
		$new_password       = Flr_Blocks_Helper::sanitize( 'resetpass_pwd', 'post' );
		$new_password_again = Flr_Blocks_Helper::sanitize( 'resetpass_pwd_again', 'post' );

		if ( empty( $rp_key ) || empty( $rp_login ) || empty( $new_password ) || empty( $new_password_again ) ) {
			wp_send_json( [
				'status'  => false,
				'message' => __( 'All fields are required.', 'frontend-login-and-registration-blocks' )
			] );
		}

		if ( $new_password !== $new_password_again ) {
			wp_send_json( [
				'status'  => false,
				'message' => __( 'Passwords do not match.', 'frontend-login-and-registration-blocks' )
			] );
		}

		$user = check_password_reset_key( $rp_key, $rp_login );

		if ( is_wp_error( $user ) ) {
			wp_send_json( [
				'status'  => false,
				'message' => __( 'Your password reset link appears to be invalid. Please request a new one.', 'frontend-login-and-registration-blocks' )
			] );
		}

		reset_password( $user, $new_password );

		$params = [
			'username' => $user->user_login,
			'email'    => $user->user_email,
		];

		$mail = new Flr_Blocks_Mail();

		$mail->send_mail( 'flr_blocks_reset_password_mail_to_user', 'reset_password_mail_to_user_template', $params, _x( 'Your Password Changed', 'reset_password_mail_title', 'frontend-login-and-registration-blocks' ) );

		wp_send_json( [
			'status'  => true,
			'message' => __( 'Your password has been reset successfully.', 'frontend-login-and-registration-blocks' )
		] );

		wp_die();

	}

	/**
	 * Get real user IP address (handles proxies and load balancers)
	 *
	 * @return string User IP address
	 * @since 1.0.0
	 */
	private function get_real_user_ip(): string {

		// Check for various HTTP headers that may contain the real IP
		$ip_headers = [
			'HTTP_CF_CONNECTING_IP',     // Cloudflare
			'HTTP_CLIENT_IP',            // Proxy
			'HTTP_X_FORWARDED_FOR',      // Load balancer/proxy
			'HTTP_X_FORWARDED',          // Proxy
			'HTTP_X_CLUSTER_CLIENT_IP',  // Cluster
			'HTTP_FORWARDED_FOR',        // Proxy
			'HTTP_FORWARDED',            // Proxy
			'REMOTE_ADDR'                // Standard
		];

		foreach ( $ip_headers as $header ) {
			if ( ! empty( $_SERVER[ $header ] ) ) {
				$ip = sanitize_text_field( wp_unslash( $_SERVER[ $header ] ) );

				// Handle comma-separated IPs (X-Forwarded-For can contain multiple IPs)
				if ( strpos( $ip, ',' ) !== false ) {
					$ip = trim( explode( ',', $ip )[0] );
				}

				// Validate IP address and exclude private ranges for security
				if ( filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE ) ) {
					return $ip;
				}

				// If public IP validation fails, use basic validation for internal networks
				if ( filter_var( $ip, FILTER_VALIDATE_IP ) ) {
					return $ip;
				}
			}
		}

		return '0.0.0.0'; // Fallback if no valid IP found
	}

}
