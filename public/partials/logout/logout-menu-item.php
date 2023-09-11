<?php

use FLWGB\Helper;
use FLWGB\Logout;

Helper::using("inc/Logout.php");
$logout = new Logout();

if(is_user_logged_in()):

$view  ='<a ' . get_block_wrapper_attributes() . ' href="'.$logout->nonce_url_for_logout().'">' . esc_html_x( "Logout", "logout_text", "flwgb" ) . '</a>';

endif;
