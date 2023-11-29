<?php
/**
 * Register operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

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
	 * Registeration form html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of register form
	 * @since 1.0.0
	 */
	public function register_form( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get register form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/register/register-form.php', $block_attributes );
	}


	/**
	 * POST operation for registration.
	 *
	 * @return string|false a JSON encoded string on success or FALSE on failure.
	 * @since 1.0.0
	 */
	public function flr_blocks_register_handle_ajax_callback() {

		header( 'Access-Control-Allow-Origin: *' );

		if ( ! get_option( 'users_can_register' ) ) {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "Users are not allowed to register on this website.", "users_can_register_error", "flr-blocks" )
			) );

			wp_die();

		}

		$password       = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-for-register', 'post' );
		$password_again = Flr_Blocks_Helper::sanitize( 'flr-blocks-password-again-for-register', 'post' );
		$username       = Flr_Blocks_Helper::sanitize( 'flr-blocks-username-for-register', 'post', 'username' );
		$email          = Flr_Blocks_Helper::sanitize( 'flr-blocks-email-for-register', 'post', 'email' );

		$params = [
			'username'        => $username,
			'email'           => $email,
			'admin_email'     => get_bloginfo( 'admin_email' ),
			'activation_link' => ''
		];

		if ( ( ! empty( $password ) && ! empty( $password_again ) ) && ( $password != $password_again ) ) {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "Your passwords do not match", "password_match_error", "flr-blocks" )
			) );

			wp_die();

		}

		if ( username_exists( $username ) ) {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "This username already exist.", "username_exist_error", "flr-blocks" )
			) );

			wp_die();

		}

		if ( email_exists( $email ) ) {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "This user already exist.", "user_exist_error", "flr-blocks" )
			) );

			wp_die();

		}

		$userdata = array(
			'user_login' => $username,
			'user_email' => $email,
			'user_pass'  => $password,
		);

		$newuser = wp_insert_user( $userdata );

		if ( ! is_wp_error( $newuser ) ) {

			$message = "";

			if ( get_option( "flr_blocks_has_activation" ) ) {

				$code = sha1( $email . time() );

				$add_user_activation      = add_user_meta( $newuser, 'flr_blocks_user_activation', 'not_activated' );
				$add_user_activation_code = add_user_meta( $newuser, 'flr_blocks_user_activation_code', $code );

				if ( $add_user_activation && $add_user_activation_code ) {

					$message = esc_html_x( "You have been signed up successfully. Please click the membership activation link sent your e-mail.", "register_succession_with_activation", "flr-blocks" );

					$activation_link = site_url() . '/' . get_option( "flr_blocks_activation_page" ) . '?key=' . $code . '&user=' . $newuser;

					$params['activation_link'] = $activation_link;

				}

			} else {

				$message = esc_html_x( "You have been signed up successfully. You can sign in with your username and password.", "register_succession", "flr-blocks" );

			}

			$mail = new Flr_Blocks_Mail();

			if ( get_option( "flr_blocks_has_activation" ) ) {

				$mail->send_mail( 'flr_blocks_register_mail_to_user_with_activation', 'register_mail_to_user_template_with_activation', $params, _x( 'Welcome to Join Us', 'register_mail_title_to_user', 'flr-blocks' ) );

			} else {

				$mail->send_mail( 'flr_blocks_register_mail_to_user', 'register_mail_to_user_template', $params, _x( 'Welcome to Join Us', 'register_mail_title_to_user', 'flr-blocks' ) );

			}

			$mail->send_mail( 'flr_blocks_register_mail_to_admin', 'register_mail_to_admin_template', $params, _x( 'New Member Registration', 'register_mail_title_to_admin', 'flr-blocks' ), true );

			echo json_encode( array(
				'status'  => true,
				'message' => $message,
			) );

		} else {

			echo json_encode( array(
				'status'  => false,
				'message' => esc_html_x( "Something went wrong. Please try again later.", "general_error_message", "flr-blocks" )
			) );

		}

		wp_die();

	}

}
