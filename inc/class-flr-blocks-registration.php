<?php
/**
 * Register operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Registration {

	/**
	 * Load registration actions.
	 *
	 * @since    1.0.0
	 */
	public function load_register_actions() {

		//Load ajax callback
		add_action( 'wp_ajax_nopriv_flrblocksregisterhandle', [ $this, 'flr_blocks_register_handle_ajax_callback' ] );
		add_action( 'wp_ajax_flrblocksregisterhandle', [ $this, 'flr_blocks_register_handle_ajax_callback' ] );

	}

	/**
	 * Registration form HTML output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of register form
	 * @since 1.0.0
	 */
	public function register_form( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get register form HTML output from Frontend class
		return $frontend->get_the_form( 'public/partials/register/register-form.php', $block_attributes );
	}


	/**
	 * POST operation for registration.
	 *
	 * @return void a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flr_blocks_register_handle_ajax_callback() {

		check_ajax_referer( 'flrblocksregisterhandle', 'security' );

		if ( ! get_option( 'users_can_register' ) ) {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Users are not allowed to register on this website.", "users_can_register_error", "frontend-login-and-registration-blocks" )
			) );

			wp_die();

		}

		$password       = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-for-register', 'post' );
		$password_again = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-again-for-register', 'post' );
		$username       = Flr_Blocks_Helper::sanitize( 'flr-blocks-username-for-register', 'post', 'username' );
		$email          = Flr_Blocks_Helper::sanitize( 'flr-blocks-email-for-register', 'post', 'email' );
		$first_name     = Flr_Blocks_Helper::sanitize( 'flr-blocks-first-name-for-register', 'post', 'text' );
		$last_name      = Flr_Blocks_Helper::sanitize( 'flr-blocks-last-name-for-register', 'post', 'text' );

		// Enhanced input validation
		if ( get_option( 'flr_blocks_enable_username_validation' ) === 'yes' ) {
			$username_validation = Flr_Blocks_Helper::validate_username_security( $username );
			if ( ! $username_validation['valid'] ) {
				wp_send_json( array(
					'status'  => false,
					'message' => $username_validation['message']
				) );
				wp_die();
			}
		}

		$email_validation = Flr_Blocks_Helper::validate_email_security( $email );
		if ( ! $email_validation['valid'] ) {
			wp_send_json( array(
				'status'  => false,
				'message' => $email_validation['message']
			) );
			wp_die();
		}

		$params = [
			'username'        => $username,
			'email'           => $email,
			'admin_email'     => get_bloginfo( 'admin_email' ),
			'activation_link' => ''
		];

		if ( ( ! empty( $password ) && ! empty( $password_again ) ) && ( $password != $password_again ) ) {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "Your passwords do not match", "password_match_error", "frontend-login-and-registration-blocks" )
			) );

			wp_die();

		}

		// Validate password strength
		if ( ! empty( $password ) ) {
			if ( get_option( 'flr_blocks_enable_password_strength' ) === 'yes' ) {
				$password_validation = Flr_Blocks_Helper::validate_password_strength( $password );
				if ( ! $password_validation['valid'] ) {
					wp_send_json( array(
						'status'  => false,
						'message' => $password_validation['message']
					) );
					wp_die();
				}
			}
		}

		if ( username_exists( $username ) ) {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "This username already exist.", "username_exist_error", "frontend-login-and-registration-blocks" )
			) );

			wp_die();

		}

		if ( email_exists( $email ) ) {

			wp_send_json( array(
				'status'  => false,
				'message' => esc_html_x( "This user already exist.", "user_exist_error", "frontend-login-and-registration-blocks" )
			) );

			wp_die();

		}

		$userdata = array(
			'user_login' => $username,
			'user_email' => $email,
			'user_pass'  => $password,
			'first_name' => $first_name,
			'last_name'  => $last_name,
		);

		$new_user = wp_insert_user( $userdata );


		if ( ! is_wp_error( $new_user ) ) {

			// Update custom fields
			do_action( 'flr_blocks_save_register_form_extra_user_fields', $new_user );

			$message = "";

			if ( get_option( "flr_blocks_has_activation" ) === 'yes' ) {

				// Generate cryptographically secure activation code
				$code = wp_generate_password( 32, false );

				$add_user_activation      = add_user_meta( $new_user, 'flr_blocks_user_activation', 'not_activated' );
				$add_user_activation_code = add_user_meta( $new_user, 'flr_blocks_user_activation_code', $code );

				if ( $add_user_activation && $add_user_activation_code ) {

					$message = esc_html_x( "You have been signed up successfully. Please click the membership activation link sent your e-mail.", "register_succession_with_activation", "frontend-login-and-registration-blocks" );

					$get_permalink = Flr_Blocks_Helper::get_page_permalink( get_option( "flr_blocks_activation_page" ) );

					// add query arguments to the $get_permalink with email and activation code
					$params['activation_link'] = add_query_arg(
						array(
							'key'  => $code,
							'user' => $email,
						),
						$get_permalink
					);

				}

			} else {

				$message = esc_html_x( "You have been signed up successfully. You can sign in with your username and password.", "register_succession", "frontend-login-and-registration-blocks" );

			}

			$mail = new Flr_Blocks_Mail();

			if ( get_option( "flr_blocks_has_activation" ) === 'yes' ) {

				$mail->send_mail( 'flr_blocks_register_mail_to_user_with_activation', 'register_mail_to_user_template_with_activation', $params, _x( 'Welcome to Join Us', 'register_mail_title_to_user', 'frontend-login-and-registration-blocks' ) );

			} else {

				$mail->send_mail( 'flr_blocks_register_mail_to_user', 'register_mail_to_user_template', $params, _x( 'Welcome to Join Us', 'register_mail_title_to_user', 'frontend-login-and-registration-blocks' ) );

			}

			$mail->send_mail( 'flr_blocks_register_mail_to_admin', 'register_mail_to_admin_template', $params, _x( 'New Member Registration', 'register_mail_title_to_admin', 'frontend-login-and-registration-blocks' ), true );

			wp_send_json( array(
				'status'  => true,
				'message' => $message,
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
