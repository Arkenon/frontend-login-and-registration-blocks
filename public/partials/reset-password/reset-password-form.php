<?php

use FLR_BLOCKS\Flr_Blocks_Helper;

if ( is_user_logged_in() ) {

	$view = '<div style="text-align: center;">'.esc_html_x( "This form is only shown to users who are not logged in.", "alert_for_non_logged_in_users", "flr-blocks" ).'</div>';

	return;

}

if ( Flr_Blocks_Helper::get( 'reset' ) === 'in-progress' ) {

	$code = Flr_Blocks_Helper::get( 'key' );
	$user = Flr_Blocks_Helper::get( 'user' );

	$code2 = get_user_meta( $user, 'flr_blocks_lost_password_key', true );

	if ( $code === $code2 ) {

		$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-in-progress.php', $form_attributes );

	} else {

		$view = '<p class="alert alert-danger">
					<strong class="font-s-14">' . esc_html_x( "Wrong reset password link. Please check your reset link sent to your e-mail address or send a new request.", "wrong_reset_password_link", "flr-blocks" ) . '</strong>
				 </p>';

	}

} else {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/reset-password/reset-request.php', $form_attributes );

}
