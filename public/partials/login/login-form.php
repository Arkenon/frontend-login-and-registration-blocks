<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Helper;

//Login Form
if ( is_user_logged_in() ) {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/login/already-logged-in.php' );

} else {

	$input_style = Flr_Blocks_Helper::get_input_style($form_attributes);
	$text_style = Flr_Blocks_Helper::get_label_style($form_attributes);
	$button_style = Flr_Blocks_Helper::get_button_style($form_attributes);

	$view = '<div '.get_block_wrapper_attributes().'>
				<form name="flr-blocks-login-form" id="flr-blocks-login-form" method="post">';

	$view .= '<div class="flr-blocks-form-row">
							<div class="flr-blocks-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-username-or-email">' . esc_html_x( "Username or E-mail", "email_or_username_input_text", "frontend-login-and-registration-blocks" ) . '</label>';
	}

	$view .= '<input class="flr-blocks-input-control" id="flr-blocks-username-or-email" name="flr-blocks-username-or-email" type="text" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your username or e-mail", "email_or_username_placeholder_text", "frontend-login-and-registration-blocks" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flr-blocks-form-row">
										<div class="flr-blocks-input-group">';

	if ( $form_attributes['showLabels'] ) {

		$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password">' . esc_html_x( "Password", "password_input_text", "frontend-login-and-registration-blocks" ) . '</label>';
	}

	$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password" name="flr-blocks-password" type="password" required style=' . $input_style . ' placeholder="';

	if ( $form_attributes['showPlaceholders'] ) {

		$view .= esc_attr_x( "Enter your password", "password_placeholder_text", "frontend-login-and-registration-blocks" );

	}

	$view .= '" /></div></div>';

	$view .= '<div class="flr-blocks-form-row">
						<div class="flr-blocks-form-check-group">
							<input id="flr-blocks-rememberme" checked="checked" type="checkbox" name="flr-blocks-rememberme" class="flr-blocks-form-check-input"/>
							<label class="flr-blocks-form-check-label" for="flr-blocks-rememberme">' . esc_html_x( "Remember me", "remember_me_text", "frontend-login-and-registration-blocks" ) . '</label>
						</div>
					</div>';

	$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flrblocksloginhandle' ) . '">';

	$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flrblocksloginhandle' ) ) . '">';

	$view .= '<div class="flr-blocks-form-row">
						<button style="' . $button_style . '" type="submit" id="flr-blocks-login-submit" class="flr-blocks-login-btn flr-blocks-btn wp-block-button__link wp-element-button">
							' . esc_html_x( "Login", "login_text", "frontend-login-and-registration-blocks" ) . '
						</button>
						' . do_action( 'wp_login' ) . '
					</div>
					<div id="flr-blocks-login-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...", "loading_text", "frontend-login-and-registration-blocks" ) . '</div>';
	$view .= '</form>';
	$view .= '<div id="flr-blocks-login-form-result"></div>';
	$view .= '<div style="text-align:center;">
				<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flr_blocks_lost_password_page' ) ) ) . '">
						' . esc_html_x( "Lost Password", "reset_password_button_text", "frontend-login-and-registration-blocks" ) . '
				</a> | ';

	$view .= '<a style="text-decoration:none;" href="' . esc_url( site_url( get_option( 'flr_blocks_register_page' ) ) ) . '">
						' . esc_html_x( "Register", "register_button_text", "frontend-login-and-registration-blocks" ) . '
				</a>
			</div>
    </div>';

}
