<?php
/**
 * Logout operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLWGB;

class Logout {

	/**
	 * Logout menu item for navigation block
	 *
	 * @return string Logout url
	 * @since 1.0.0
	 */
	public function logout_menu_item(array $block_attributes ): string {

		$frontend = new Frontend();

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

		$redirect_url             = urlencode( esc_url( $_SERVER['REQUEST_URI'] ) );
		$logout_url               = wp_logout_url( home_url( '/' ) );
		$logout_url_with_redirect = add_query_arg( 'redirect_to', $redirect_url, $logout_url );

		return wp_nonce_url( $logout_url_with_redirect, 'log-out' );

	}

}
