<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Helper;

if ( is_user_logged_in() ) {

	$view = '<div style="text-align: center;">' . esc_html_x( "This form is only shown to users who are not logged in.", "alert_for_non_logged_in_users", "frontend-login-and-registration-blocks" ) . '</div>';

	return;

}

if ( Flr_Blocks_Helper::sanitize( 'reset', 'get', 'text' ) === 'in-progress' ) {

	$rp_key   = Flr_Blocks_Helper::sanitize( 'rp_key', 'get' );
	$rp_login = Flr_Blocks_Helper::sanitize( 'rp_login', 'get' );

	$user = check_password_reset_key( $rp_key, $rp_login );

	if ( ! is_wp_error( $user ) ) {

		$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-in-progress.php', $form_attributes );

	} else {

		$view = '<p class="alert alert-danger">
					<strong class="font-s-14">' . esc_html_x( "Wrong reset password link. Please check your reset link sent to your e-mail address or send a new request.", "wrong_reset_password_link", "frontend-login-and-registration-blocks" ) . '</strong>
				 </p>';

	}

} else {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-request.php', $form_attributes );

}
