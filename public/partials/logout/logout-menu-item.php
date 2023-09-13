<?php

use FLWGB\Helper;
use FLWGB\Login;
use FLWGB\Logout;

Helper::using("inc/Logout.php");
Helper::using("inc/Login.php");

$logout = new Logout();
$login = new Login();

if(is_user_logged_in()):

	$view  ='<a ' . get_block_wrapper_attributes() . ' href="'.esc_url($logout->nonce_url_for_logout()).'">' . esc_html_x( "Logout", "logout_text", "flwgb" ) . '</a>';

else :

	$view  ='<a ' . get_block_wrapper_attributes() . ' href="'.esc_url($login->get_login_url()).'">' . esc_html_x( "Login", "login_text", "flwgb" ) . '</a>';

endif;
