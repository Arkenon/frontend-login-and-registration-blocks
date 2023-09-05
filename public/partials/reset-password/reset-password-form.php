<?php

use FLWGB\Helper;

if ( is_user_logged_in() ) {

	$view = '<div style="text-align: center;">'.esc_html_x( "This form is only shown to users who are not logged in.", "alert_for_non_logged_in_users", "flwgb" ).'</div>';

	return;

}

if ( Helper::get( 'reset' ) === 'in-progress' ) {

	$code = Helper::get( 'key' );
	$user = Helper::get( 'user' );

	$code2 = get_user_meta( $user, 'flwgb_lost_password_key', true );

	if ( $code === $code2 ) {

		$view = Helper::return_view( 'public/partials/reset-password/reset-in-progress.php', $form_attributes );

	} else {

		$view = '<p class="alert alert-danger">
					<strong class="font-s-14">' . esc_html_x( "Wrong reset password link. Please check your reset link sent to your e-mail address or send a new request.", "wrong_reset_password_link", "flwgb" ) . '</strong>
				 </p>';

	}

} else {

	$view = Helper::return_view( 'public/partials/reset-password/reset-request.php', $form_attributes );

}
