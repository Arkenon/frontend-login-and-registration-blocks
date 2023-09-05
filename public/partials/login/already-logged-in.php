<?php

global $user_login;

$view = '<div style="box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);transition: 0.3s;width:100%;" '.get_block_wrapper_attributes().'>
			<div style="padding: 16px;text-align:center;">
				<div style="display: flex; align-items: center;justify-content: center;">
					<span class="dashicons dashicons-admin-users"></span>
					' . esc_html_x( "Hello", "hello_text", "flwgb" ) . ' ' . $user_login . ',
					<br>
				</div>';

if ( get_option( 'flwgb_has_user_dashboard' ) === 'yes' ) :

	$view .= '<a style="text-decoration:none;font-size:14px;" href="' . esc_url( site_url( get_option( 'flwgb_user_settings_page' ) ) ) . '">
				' . esc_html_x( "Go to user dashboard", "go_to_user_dashboard_text", "flwgb" ) . '
			  </a> |';

endif;

$view .= '<a style="text-decoration:none;font-size:14px;" href="' . esc_url( wp_logout_url( home_url() ) ) . '">
			' . esc_html_x( "Logout", "logout_text", "flwgb" ) . '
		  </a>
			</div>
		</div>';
