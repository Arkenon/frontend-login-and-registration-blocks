<?php
/**
 * Router for the reset password block.
 *
 * Which of the two steps renders is decided by the request, never by a block
 * attribute: the editorPreviewStep attribute exists only so an author can look
 * at either step on the canvas, and must not be read here.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Style;

if ( is_user_logged_in() ) {

	$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
			. '<p class="flr-blocks-description">'
			. esc_html_x( 'This form is only shown to users who are not logged in.', 'alert_for_non_logged_in_users', 'frontend-login-and-registration-blocks' )
			. '</p></div>';

	return;

}

if ( Flr_Blocks_Helper::sanitize( 'reset', 'get', 'text' ) !== 'in-progress' ) {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-request.php', $form_attributes );

	return;

}

$user = check_password_reset_key(
	Flr_Blocks_Helper::sanitize( 'rp_key', 'get' ),
	Flr_Blocks_Helper::sanitize( 'rp_login', 'get' )
);

if ( is_wp_error( $user ) ) {

	$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
			. '<p class="flr-blocks-danger">'
			. esc_html_x( 'Wrong reset password link. Please check your reset link sent to your e-mail address or send a new request.', 'wrong_reset_password_link', 'frontend-login-and-registration-blocks' )
			. '</p></div>';

	return;

}

$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-in-progress.php', $form_attributes );
