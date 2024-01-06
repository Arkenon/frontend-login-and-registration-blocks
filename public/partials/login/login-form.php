<?php

use FLR_BLOCKS\Flr_Blocks_Helper;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

//Login Form
if ( is_user_logged_in() ) {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/login/already-logged-in.php' );

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
				<form name="flr-blocks-login-form" id="flr-blocks-login-form" method="post">';

	$view .= '<div class="flr-blocks-form-row">
							<div class="flr-blocks-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-username-or-email">' . esc_html_x( "Username or E-mail", "email_or_username_input_text", "flr-blocks" ) . '</label>';
	}

	$view .= '<input class="flr-blocks-input-control" id="flr-blocks-username-or-email" name="flr-blocks-username-or-email" type="text" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your username or e-mail", "email_or_username_placeholder_text", "flr-blocks" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flr-blocks-form-row">
										<div class="flr-blocks-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password">' . esc_html_x( "Password", "password_input_text", "flr-blocks" ) . '</label>';
	}

	$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password" name="flr-blocks-password" type="password" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your password", "password_placeholder_text", "flr-blocks" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flr-blocks-form-row">
						<div class="flr-blocks-form-check-group">
							<input id="flr-blocks-rememberme" checked="checked" type="checkbox" name="flr-blocks-rememberme" class="flr-blocks-form-check-input"/>
							<label class="flr-blocks-form-check-label" for="flr-blocks-rememberme">' . esc_html_x( "Remember me", "remember_me_text", "flr-blocks" ) . '</label>
						</div>
					</div>';

	$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flrblocksloginhandle' ) . '">';

	$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flrblocksloginhandle' ) ) . '">';

	$view .= '<div class="flr-blocks-form-row">
						<button style="' . $button_style . '" type="submit" id="flr-blocks-login-submit" class="flr-blocks-login-btn flr-blocks-btn">
							' . esc_html_x( "Login", "login_text", "flr-blocks" ) . '
						</button>
						' . do_action( 'wp_login' ) . '
					</div>
					<div id="flr-blocks-login-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...", "loading_text", "flr-blocks" ) . '</div>';
	$view .= '</form>';
	$view .= '<div id="flr-blocks-login-form-result"></div>';
	$view .= '<div style="text-align:center;">
				<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flr_blocks_lost_password_page' ) ) ) . '">
						' . esc_html_x( "Lost Password", "reset_password_button_text", "flr-blocks" ) . '
				</a> | ';

	$view .= '<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flr_blocks_register_page' ) ) ) . '">
						' . esc_html_x( "Register", "register_button_text", "flr-blocks" ) . '
				</a>
			</div>
    </div>';

}
