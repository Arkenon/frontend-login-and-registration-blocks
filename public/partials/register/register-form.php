<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Login;

if( is_user_logged_in()){

	$view = '<div style="text-align: center;">'.esc_html_x( "This form is only shown to users who are not logged in.", "alert_for_non_logged_in_users", "flr-blocks" ).'</div>';
	return;

}

$login = new Flr_Blocks_Login();
$login_url = $login->get_login_url();

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
$view = '<div '.get_block_wrapper_attributes().'>';
$view .= '<form name="flr-blocks-register-form" id="flr-blocks-register-form" method="post">
            <div class="flr-blocks-form-row">
               <div class="flr-blocks-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-username-for-register">
						        ' . esc_html_x( "Username", "username_input_text", "flr-blocks" ) . '
						     </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-username-for-register" name="flr-blocks-username-for-register" type="text" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your username", "username_placeholder_text", "flr-blocks" );

}

$view .= '" /></div></div>';

$view .= '<div class="flr-blocks-form-row">
               <div class="flr-blocks-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-email-for-register">
								' . esc_html_x( "Your e-mail", "email_input_text", "flr-blocks" ) . '
							 </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-email-for-register" name="flr-blocks-email-for-register" type="text" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your e-mail", "email_placeholder_text", "flr-blocks" );

}

$view .= '" /></div></div>';

$view .= '<div class="flr-blocks-form-row">
	            <div class="flr-blocks-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password-for-register">
								' . esc_html_x( "Password", "password_input_text", "flr-blocks" ) . '
							  </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password-for-register" name="flr-blocks-password-for-register" type="password" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your password", "password_placeholder_text", "flr-blocks" );

}

$view .= '" /></div></div>';

$view .= '<div class="flr-blocks-form-row">
	            <div class="flr-blocks-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password-again-for-register">
							    ' . esc_html_x( "Password Again", "password_again_input_text", "flr-blocks" ) . '
							 </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password-again-for-register" name="flr-blocks-password-again-for-register" type="password" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your password again", "password_again_placeholder_text", "flr-blocks" );

}

$view .= '" /></div></div>';

if($form_attributes['showTermsAndPrivacy']):
$view .= '<div class="flr-blocks-form-row">
				<div class="flr-blocks-input-group">
					<input id="flr-blocks-terms-and-privacy" checked="checked" type="checkbox" name="flr-blocks-terms-and-privacy" required class="flr-blocks-form-check-input"/>
						<label class="flr-blocks-form-check-label" for="flr-blocks-terms-and-privacy">
						' .
         //translators: %1$s terms and cond. url %2$s privacy policy url
         sprintf( __( 'I have read and accept <a href="%1$s" target="_blank">terms and conditions</a> and <a href="%2$s" target="_blank">privacy policy</a>', 'flr-blocks' ), get_option( 'flr_blocks_terms_and_conditions_page' ), get_option( 'flr_blocks_privacy_policy_page' ) ) . '
						</label>
					</div>
				</div>';
endif;

$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flrblocksregisterhandle' ) . '">';

$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flrblocksregisterhandle' ) ) . '">';

$view .= '<div class="flr-blocks-form-row">
						<button style="' . $button_style . '" type="submit" id="flr-blocks-register-submit" class="flr-blocks-register-btn flr-blocks-btn">
							' . esc_html_x( "Register", "register_button_text", "flr-blocks" ) . '
						</button>
					</div>
					<div id="flr-blocks-register-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...", "loading_text", "flr-blocks" ) . '</div>';
$view .= '</form>
			<div id="flr-blocks-register-form-result"></div>';
			$view .= '<div style="text-align:center;">
						'. esc_html_x( "Already signed up? ", "already_signed_in_message", "flr-blocks" ).'
						<a style="text-decoration:none;" href="' . esc_url( $login_url ) . '">
						    ' . esc_html_x( "Login", "login_text", "flr-blocks" ) . '
						</a>
					 </div>
    </div>
</div>';
