<?php

use FLWGB\Helper;

//Login Form
if ( is_user_logged_in() ) {

	$view = Helper::return_view( 'public/partials/login/already-logged-in.php' );

} else {

	$input_style = 'border-radius:' . $form_attributes['inputBorderRadius'] . 'px';
	$text_style  = 'color:' . $form_attributes['textColor'] . '; font-weight:' . $form_attributes['textFontWeight'];

	$button_border_color = array_key_exists( 'color', $form_attributes['buttonBorder'] ) ? 'border-color: ' . $form_attributes['buttonBorder']['color'] . ';' : "";
	$button_border_style = array_key_exists( 'style', $form_attributes['buttonBorder'] ) ? 'border-style: ' . $form_attributes['buttonBorder']['style'] . ';' : "";
	$button_border_width = array_key_exists( 'width', $form_attributes['buttonBorder'] ) ? 'border-width: ' . $form_attributes['buttonBorder']['width'] . ';' : "";

	$button_style = 'color:' . $form_attributes['buttonTextColor'] . '; ' .
	                'background-color: ' . $form_attributes['buttonBgColor'] . '; ' .
	                $button_border_color .
	                $button_border_style .
	                $button_border_width .
	                'border-radius: ' . $form_attributes['buttonBorderRadius'] . 'px;' .
	                'font-weight: ' . $form_attributes['buttonTextFontWeight'];

	$view = '<div '.get_block_wrapper_attributes().'>
				<form name="flwgb-login-form" id="flwgb-login-form" method="post">';

	$view .= '<div class="flwgb-form-row">
							<div class="flwgb-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-username-or-email">' . esc_html_x( "Username or E-mail", "email_or_username_input_text", "flwgb" ) . '</label>';
	}

	$view .= '<input class="flwgb-input-control" id="flwgb-username-or-email" name="flwgb-username-or-email" type="text" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your username or e-mail", "email_or_username_placeholder_text", "flwgb" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flwgb-form-row">
										<div class="flwgb-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-password">' . esc_html_x( "Password", "password_input_text", "flwgb" ) . '</label>';
	}

	$view .= '<input class="flwgb-input-control" id="flwgb-password" name="flwgb-password" type="password" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your password", "password_placeholder_text", "flwgb" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flwgb-form-row">
						<div class="flwgb-form-check-group">
							<input id="flwgb-rememberme" checked="checked" type="checkbox" name="flwgb-rememberme" class="flwgb-form-check-input"/>
							<label class="flwgb-form-check-label" for="flwgb-rememberme">' . esc_html_x( "Remember me", "remember_me_text", "flwgb" ) . '</label>
						</div>
					</div>';

	$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flwgbloginhandle' ) . '">';

	$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flwgbloginhandle' ) ) . '">';

	$view .= '<div class="flwgb-form-row">
						<button style="' . $button_style . '" type="submit" id="flwgb-login-submit" class="flwgb-login-btn flwgb-btn">
							' . esc_html_x( "Login", "login_text", "flwgb" ) . '
						</button>
						' . do_action( 'wp_login' ) . '
					</div>
					<div id="flwgb-login-loading" class="flwgb-loading flwgb-hide">' . esc_html_x( "Loading...", "loading_text", "flwgb" ) . '</div>';
	$view .= '</form>';
	$view .= '<div id="flwgb-login-form-result"></div>';
	$view .= '<div style="text-align:center;">
				<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flwgb_lost_password_page' ) ) ) . '">
						' . esc_html_x( "Lost Password", "reset_password_button_text", "flwgb" ) . '
				</a> | ';

	$view .= '<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flwgb_register_page' ) ) ) . '">
						' . esc_html_x( "Register", "register_button_text", "flwgb" ) . '
				</a>
			</div>
    </div>';

}
