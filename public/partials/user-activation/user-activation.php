<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Login;
use FLR_BLOCKS\Flr_Blocks_User_Activation;

Flr_Blocks_Helper::using( 'inc/class-flr-blocks-user-activation.php' );

$login     = new Flr_Blocks_Login();
$login_url = $login->get_login_url();

$activation = new Flr_Blocks_User_Activation();

$activation_code = Flr_Blocks_Helper::sanitize( 'key', 'get' );
$user_email      = Flr_Blocks_Helper::sanitize( 'user', 'get', 'email' );

if ( ! empty( $activation_code ) ) {

	$activation_result = $activation->activate_user( $activation_code, $user_email );

} else {

	$activation_result = array(
		'status'  => false,
		'message' => esc_html_x( "Wrong activation code. Please contact with your site administrator.", "wrong_activation_code", "frontend-login-and-registration-blocks" )
	);

}

$color = $activation_result['status'] ? "green" : "red";


$view = '<div style="text-align: center" ' . get_block_wrapper_attributes() . '>';
$view .= '<p style="color:' . $color . '">' . $activation_result['message'] . '</p>';
$view .= '<a style="text-decoration:none;" href="' . esc_url( $login_url ) . '">
				' . esc_html_x( "Login", "login_text", "frontend-login-and-registration-blocks" ) . '
		  </a>';
$view .= '</div>';
