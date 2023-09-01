<?php

use FLWGB\Helper;
use FLWGB\Login;
use FLWGB\UserActivation;

Helper::using('inc/UserActivation.php');

$login = new Login();
$login_url = $login->get_login_url();

$activation = new UserActivation();

$activation_code = Helper::get( 'key' );
$user_id         = Helper::get( 'user' );

if(!empty($activation_code)){

	$activation_result = $activation->activate_user( $activation_code, $user_id );
	$color = $activation_result['status'] ? "green" : "red";

} else {

	$activation_result = array(
		'status' => false,
		'message' => esc_html_x( "Wrong activation code. Please contact with your site administrator.", "wrong_activation_code", "flwgb" )
	);
	$color = $activation_result['status'] ? "green" : "red";

}



$view = '<div style="text-align: center" '.get_block_wrapper_attributes().'>';
$view .= '<p style="color:' . $color . '">' . $activation_result['message'] . '</p>';
$view .= '<a style="text-decoration:none;" href="' . esc_url( $login_url ) . '">
				' . esc_html_x( "Login", "login_text", "flwgb" ) . '
		  </a>';
$view .= '</div>';
