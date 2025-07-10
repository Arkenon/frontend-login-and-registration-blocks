<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $user_login;

use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Logout;

Flr_Blocks_Helper::using('inc/class-flr-blocks-logout.php');
$logout = new Flr_Blocks_Logout();

$view = '<div style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);transition: 0.3s;width:100%;" ' . get_block_wrapper_attributes() . '>
			<div style="padding: 16px;text-align:center;">
				<div style="display: flex; align-items: center;justify-content: center;">
					<span class="dashicons dashicons-admin-users"></span>
					' . esc_html_x( "Hello", "hello_text", "frontend-login-and-registration-blocks" ) . ' ' . $user_login . ',
					<br>
				</div>';

if ( get_option( 'flr_blocks_has_user_dashboard' ) === 'yes' ) :

	$view .= '<a style="text-decoration:none;font-size:14px;" href="' . esc_url( site_url( get_option( 'flr_blocks_user_settings_page' ) ) ) . '">
				' . esc_html_x( "Go to user dashboard", "go_to_user_dashboard_text", "frontend-login-and-registration-blocks" ) . '
			  </a> |';

endif;

$view .= '<a style="text-decoration:none;font-size:14px;" href="' . esc_url( $logout->nonce_url_for_logout() ) . '">
			' . esc_html_x( "Logout", "logout_text", "frontend-login-and-registration-blocks" ) . '
		  </a>
			</div>
		</div>';
