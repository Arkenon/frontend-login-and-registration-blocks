<?php

use FLWGB\Login;

if( is_user_logged_in()){

	$view = '<div style="text-align: center;">'.esc_html_x( "This form is only shown to users who are not logged in.", "alert_for_non_logged_in_users", "flwgb" ).'</div>';
	return;

}

$login = new Login();
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
$view .= '<form name="flwgb-register-form" id="flwgb-register-form" method="post">
            <div class="flwgb-form-row">
               <div class="flwgb-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-username-for-register">
						        ' . esc_html_x( "Username", "username_input_text", "flwgb" ) . '
						     </label>';
}

$view .= '<input class="flwgb-input-control" id="flwgb-username-for-register" name="flwgb-username-for-register" type="text" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your username", "username_placeholder_text", "flwgb" );

}

$view .= '" /></div></div>';

$view .= '<div class="flwgb-form-row">
               <div class="flwgb-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-email-for-register">
								' . esc_html_x( "Your e-mail", "email_input_text", "flwgb" ) . '
							 </label>';
}

$view .= '<input class="flwgb-input-control" id="flwgb-email-for-register" name="flwgb-email-for-register" type="text" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your e-mail", "email_placeholder_text", "flwgb" );

}

$view .= '" /></div></div>';

$view .= '<div class="flwgb-form-row">
	            <div class="flwgb-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-password-for-register">
								' . esc_html_x( "Password", "password_input_text", "flwgb" ) . '
							  </label>';
}

$view .= '<input class="flwgb-input-control" id="flwgb-password-for-register" name="flwgb-password-for-register" type="password" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your password", "password_placeholder_text", "flwgb" );

}

$view .= '" /></div></div>';

$view .= '<div class="flwgb-form-row">
	            <div class="flwgb-input-group">';
if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="flwgb-password-again-for-register">
							    ' . esc_html_x( "Password Again", "password_again_input_text", "flwgb" ) . '
							 </label>';
}

$view .= '<input class="flwgb-input-control" id="flwgb-password-again-for-register" name="flwgb-password-again-for-register" type="password" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your password again", "password_again_placeholder_text", "flwgb" );

}

$view .= '" /></div></div>';

if($form_attributes['showTermsAndPrivacy']):
$view .= '<div class="flwgb-form-row">
				<div class="flwgb-input-group">
					<input id="flwgb-terms-and-privacy" checked="checked" type="checkbox" name="flwgb-terms-and-privacy" required class="flwgb-form-check-input"/>
						<label class="flwgb-form-check-label" for="flwgb-terms-and-privacy">
						' .
         //translators: %1$s terms and cond. url %2$s privacy policy url
         sprintf( __( 'I have read and accept <a href="%1$s" target="_blank">terms and conditions</a> and <a href="%2$s" target="_blank">privacy policy</a>', 'flwgb' ), get_option( 'flwgb_terms_and_conditions_page' ), get_option( 'flwgb_privacy_policy_page' ) ) . '
						</label>
					</div>
				</div>';
endif;

$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flwgbregisterhandle' ) . '">';

$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flwgbregisterhandle' ) ) . '">';

$view .= '<div class="flwgb-form-row">
						<button style="' . $button_style . '" type="submit" id="flwgb-register-submit" class="flwgb-register-btn flwgb-btn">
							' . esc_html_x( "Register", "register_button_text", "flwgb" ) . '
						</button>
					</div>
					<div id="flwgb-register-loading" class="flwgb-loading flwgb-hide">' . esc_html_x( "Loading...", "loading_text", "flwgb" ) . '</div>';
$view .= '</form>
			<div id="flwgb-register-form-result"></div>';
			$view .= '<div style="text-align:center;">
						'. esc_html_x( "Already signed up? ", "already_signed_in_message", "flwgb" ).'
						<a style="text-decoration:none;" href="' . esc_url( $login_url ) . '">
						    ' . esc_html_x( "Login", "login_text", "flwgb" ) . '
						</a>
					 </div>
    </div>
</div>';
