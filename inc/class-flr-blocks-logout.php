<?php
/**
 * Logout operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Logout {

	/**
	 * Logout menu item for navigation block
	 *
	 * @return string Logout url
	 * @since 1.0.0
	 */
	public function logout_menu_item( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get logout menu item html output from Frontend class
		return $frontend->get_the_form( 'public/partials/logout/logout-menu-item.php', $block_attributes );

	}

	/**
	 * Create a nonce url for log out
	 *
	 * @return string nonce url
	 * @since 1.0.0
	 */
	public function nonce_url_for_logout(): string {
		$request_uri = isset( $_SERVER['REQUEST_URI'] ) ? sanitize_url( wp_unslash( $_SERVER['REQUEST_URI'] ) ) : '';

		// Validate and sanitize redirect URL for security
		$redirect_url = $this->validate_redirect_url( $request_uri );

		$logout_url = wp_logout_url( $redirect_url );

		// Add additional logout hook for session cleanup
		add_action( 'wp_logout', [ $this, 'secure_logout_cleanup' ] );

		return wp_nonce_url( $logout_url, 'log-out' );
	}

	/**
	 * Validate redirect URL to prevent open redirect vulnerabilities
	 *
	 * @param string $url URL to validate
	 * @return string Safe redirect URL
	 * @since 1.2.0
	 */
	private function validate_redirect_url( string $url ): string {

		// Default safe redirect
		$safe_url = home_url( '/' );

		if ( empty( $url ) ) {
			return $safe_url;
		}

		// Parse the URL
		$parsed_url = wp_parse_url( $url );

		// Only allow relative URLs or URLs from the same domain
		if ( isset( $parsed_url['host'] ) ) {
			$site_host = wp_parse_url( home_url(), PHP_URL_HOST );
			if ( $parsed_url['host'] !== $site_host ) {
				return $safe_url; // Prevent open redirect
			}
		}

		// Additional security: check if it's a valid WordPress redirect
		if ( wp_validate_redirect( $url, $safe_url ) ) {
			return esc_url_raw( $url );
		}

		return $safe_url;
	}

	/**
	 * Perform secure logout cleanup
	 *
	 * @since 1.2.0
	 */
	public function secure_logout_cleanup(): void {

		// Clear any custom plugin sessions or transients
		if ( is_user_logged_in() ) {
			$user_id = get_current_user_id();

			// Clear login attempt counters for this user's IP on successful logout
			$user_ip = Flr_Blocks_Helper::get_real_user_ip();
			delete_transient( "login_attempts_" . $user_ip );

			// Clear any user-specific transients
			delete_transient( "user_activation_" . $user_id );
		}

		// Force session regeneration on next login
		if ( session_status() === PHP_SESSION_ACTIVE ) {
			session_destroy();
		}
	}
}
