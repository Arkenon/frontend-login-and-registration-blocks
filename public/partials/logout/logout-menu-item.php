<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Login;
use FLR_BLOCKS\Flr_Blocks_Logout;

$logout = new Flr_Blocks_Logout();
$login = new Flr_Blocks_Login();

if(is_user_logged_in()):

	$view  ='<a ' . get_block_wrapper_attributes() . ' href="'.esc_url($logout->nonce_url_for_logout()).'">' . esc_html_x( "Logout", "logout_text", "frontend-login-and-registration-blocks" ) . '</a>';

else :

	$view  ='<a ' . get_block_wrapper_attributes() . ' href="'.esc_url($login->get_login_url()).'">' . esc_html_x( "Login", "login_text", "frontend-login-and-registration-blocks" ) . '</a>';

endif;
