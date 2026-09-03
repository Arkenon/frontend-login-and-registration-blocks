<?php
/**
 * Front-end markup for the login/logout navigation item.
 *
 * The wording of both states comes from the block, falling back to the
 * translated defaults. Typography, colour and spacing arrive through
 * get_block_wrapper_attributes() from the block supports.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Login;
use FLR_BLOCKS\Flr_Blocks_Logout;

if ( is_user_logged_in() ) {

	$logout = new Flr_Blocks_Logout();

	$label = trim( (string) ( $form_attributes['logoutLabel'] ?? '' ) );

	if ( '' === $label ) {
		$label = _x( 'Logout', 'logout_text', 'frontend-login-and-registration-blocks' );
	}

	$view = '<a ' . get_block_wrapper_attributes() . ' href="' . esc_url( $logout->nonce_url_for_logout() ) . '">'
			. esc_html( $label ) . '</a>';

	return;

}

if ( false === ( $form_attributes['showWhenLoggedOut'] ?? true ) ) {

	$view = '';

	return;

}

$login = new Flr_Blocks_Login();

$label = trim( (string) ( $form_attributes['loginLabel'] ?? '' ) );

if ( '' === $label ) {
	$label = _x( 'Login', 'login_text', 'frontend-login-and-registration-blocks' );
}

$view = '<a ' . get_block_wrapper_attributes() . ' href="' . esc_url( $login->get_login_url() ) . '">'
		. esc_html( $label ) . '</a>';
