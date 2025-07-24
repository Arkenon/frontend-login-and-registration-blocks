<?php
/**
 * Login operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

class Flr_Blocks_Login {

	private $max_attempts = 5; //times
	private $lockout_duration = 300; //seconds

	public function load_login_actions() {

		///Load ajax callback
		add_action( 'wp_ajax_nopriv_flrblocksloginhandle', [ $this, 'login_handle_ajax_callback' ] );
		add_action( 'wp_ajax_flrblocksloginhandle', [ $this, 'login_handle_ajax_callback' ] );

		//Limit login
		if ( get_option( 'flr_blocks_enable_limit_login' ) === 'yes' ) {

			add_action( 'wp_login_failed', [ $this, 'limit_login_attempts' ] );

		}

		//Redirect from wp-login and wp-admin to homepage
		add_action( 'init', [ $this, 'redirect_login_admin_pages' ] );

	}

	/**
	 * Welcome Card html output (for logged in users)
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of welcome card
	 * @since 1.0.0
	 */
	public function welcome_card( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get html output from Frontend class
		return $frontend->get_the_form( 'public/partials/login/welcome-card.php', $block_attributes );

	}

	/**
	 * Login form html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of login form
	 * @since 1.0.0
	 */
	public function login_form( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get login form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/login/login-form.php', $block_attributes );

	}

	/**
	 * POST operation for login.
	 *
	 * @since 1.0.0
	 */
	public function login_handle_ajax_callback() {

		if ( get_option( 'flr_blocks_enable_limit_login' ) === 'yes' && $this->get_login_attempts_count()['login_attempts'] >= $this->get_limit_login_options()['max_attempts'] ) {

			$this->login_attempts_error();

			wp_die();

		}

		check_ajax_referer( 'flrblocksloginhandle', 'security' );

		$credentials                  = array();
		$credentials['user_login']    = Flr_Blocks_Helper::sanitize( 'flr-blocks-username-or-email', 'post', 'text' ) ?? '';
		$credentials['user_password'] = Flr_Blocks_Helper::sanitize( 'flr-blocks-password', 'post' ) ?? '';
		$credentials['remember']      = Flr_Blocks_Helper::sanitize( 'flr-blocks-rememberme', 'post', 'text' ) === 'on';

		$user = wp_signon( $credentials, is_ssl() );


		if ( is_wp_error( $user ) ) {

			$this->login_failed_response();

		} else {

			wp_set_current_user( $user->ID, $user->user_login );

			if ( get_option( 'flr_blocks_has_activation' ) === 'yes' ) {

				Flr_Blocks_Helper::using( "inc/class-flr-blocks-user-activation.php" );
				$activation = new Flr_Blocks_User_Activation();

				if ( $activation->check_is_user_activated( $user->ID ) ) {

					$this->login_success_response();

				} else {

					wp_send_json( array(
						'status'  => false,
						'message' => esc_html_x( "Please activate your account. We sent you an email. Click the activation link in the email.", "user_not_activated", "frontend-login-and-registration-blocks" )
					) );

					wp_logout();

				}

			} else {

				$this->login_success_response();

			}

		}

		wp_die();

	}

	/**
	 * Json result for login. When login success
	 *
	 * @return void Json result
	 * @since 1.0.0
	 */
	private function login_success_response(): void {

		wp_send_json( array(
			'status'     => true,
			'return_url' => site_url( get_option( 'flr_blocks_redirect_after_login' ) ) ?? null,
			'message'    => esc_html_x( "You have successfully logged in...", "login_successful", "frontend-login-and-registration-blocks" )
		) );

	}

	/**
	 * Json result for login. When login failed
	 *
	 * @return void Json result
	 * @since 1.0.0
	 */
	private function login_failed_response(): void {

		wp_send_json( array(
			'status'  => false,
			'message' => esc_html_x( "Invalid username or password.", "invalid_username_or_pass", "frontend-login-and-registration-blocks" )
		) );

	}

	/**
	 * Get login attempts count
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_login_attempts_count(): array {

		$get_remote_addr = isset( $_SERVER['REMOTE_ADDR'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REMOTE_ADDR'] ) ) : '';

		$user_ip = preg_replace( '/[^0-9., ]/', '', $get_remote_addr );

		return [
			'user_ip'        => $user_ip,
			'login_attempts' => get_transient( "login_attempts_" . $user_ip )
		];
	}

	/**
	 * Get limit login options from database
	 *
	 * @return array
	 * @since 1.0.0
	 */
	public function get_limit_login_options(): array {

		$max_attempts     = ! get_option( 'flr_blocks_limit_login_max_attempts' ) ? $this->max_attempts : get_option( 'flr_blocks_limit_login_max_attempts' );
		$lockout_duration = ! get_option( 'flr_blocks_limit_login_lockout_duration' ) ? $this->lockout_duration : get_option( 'flr_blocks_limit_login_lockout_duration' );

		return [
			'max_attempts'     => $max_attempts,
			'lockout_duration' => $lockout_duration
		];

	}

	/**
	 * Limit login attempt to prevent brute force attacks
	 *
	 * @since 1.0.0
	 */
	public function limit_login_attempts() {

		$lockout_duration = $this->get_limit_login_options()['lockout_duration'];

		$user_ip        = $this->get_login_attempts_count()['user_ip'];
		$login_attempts = $this->get_login_attempts_count()['login_attempts'];

		set_transient( "login_attempts_" . $user_ip, $login_attempts + 1, $lockout_duration );

	}

	/**
	 * Json result for to login attempt error.
	 *
	 * @return string Json result
	 * @since 1.0.0
	 */
	private function login_attempts_error(): void {

		$limit_login_options = $this->get_limit_login_options();

		if ( $limit_login_options['lockout_duration'] >= 60 ) {

			$duration_type  = "minutes";
			$duration_limit = $limit_login_options['lockout_duration'] / 60;

		} else {

			$duration_type  = "seconds";
			$duration_limit = $limit_login_options['lockout_duration'];

		}

		wp_send_json( array(
			'status'  => false,
			// translators: %1$s duration limit %2$s duration type (second or minute)
			'message' => sprintf( _x( 'You have made too many unsuccessful login attempts. Please wait %1$s %2$s', 'unsuccessful_login_attempts_error', 'frontend-login-and-registration-blocks' ), $duration_limit, $duration_type )
		) );

	}

	/**
	 * Redirect non-logged in users from wp-login and wp-admin to homepage
	 *
	 * @since 1.0.0
	 */
	public function redirect_login_admin_pages() {

		if ( get_option( 'flr_blocks_redirect_from_wp_login_admin' ) === 'yes' && ! is_user_logged_in() && ! defined( 'DOING_AJAX' ) ) {

			// This not a form action, nonce verification is not needed
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			$request_uri    = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_url( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';
			$request_method = isset( $_SERVER['REQUEST_METHOD'] ) ? sanitize_text_field( wp_unslash( $_SERVER['REQUEST_METHOD'] ) ) : '';
			$login_url      = $this->get_login_url();
			$current_page   = esc_url_raw( $request_uri );
			$url            = isset( $_REQUEST['redirect_to'] ) ? "wp-login.php" : $current_page;
			// phpcs:enable WordPress.Security.NonceVerification.Recommended

			if ( $url === "wp-login.php" && $request_method === 'GET' ) {
				wp_redirect( esc_url_raw( $login_url ) );
				exit;
			}
		}
	}

	/**
	 * Return the url of login page
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public function get_login_url(): string {

		return get_option( 'flr_blocks_login_page' ) ? site_url( get_option( 'flr_blocks_login_page' ) ) : home_url();

	}


}
