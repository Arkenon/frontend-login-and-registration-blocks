<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

if ( ! is_user_logged_in() ) {

	$view = '<div style="text-align: center;">' . esc_html_x( "This form is only shown to logged in users...", "alert_for_logged_in_users", "frontend-login-and-registration-blocks" ) . '</div>';

	return;

}

$current_user = wp_get_current_user();
$ID           = $current_user->ID;
$user_email   = $current_user->user_email;
$first_name   = $current_user->first_name;
$last_name    = $current_user->last_name;
$website      = $current_user->user_url;
$bio          = $current_user->user_description;

$input_border_radius     = $form_attributes['inputBorderRadius'] ?? '';
$text_color              = $form_attributes['textColor'] ?? '';
$text_font_weight        = $form_attributes['textFontWeight'] ?? '';
$button_text_color       = $form_attributes['buttonTextColor'] ?? '';
$button_text_font_weight = $form_attributes['buttonTextFontWeight'] ?? '';
$button_bg_color         = $form_attributes['buttonBgColor'] ?? '';
$button_border_radius    = $form_attributes['buttonBorderRadius'] ?? '';

$input_style = 'border-radius:' . $input_border_radius . 'px';
$text_style  = 'color:' . $text_color . '; font-weight:' . $text_font_weight;

$button_border_color = array_key_exists( 'color', $form_attributes['buttonBorder'] ) ? 'border-color: ' . $form_attributes['buttonBorder']['color'] . ';' : "";
$button_border_style = array_key_exists( 'style', $form_attributes['buttonBorder'] ) ? 'border-style: ' . $form_attributes['buttonBorder']['style'] . ';' : "";
$button_border_width = array_key_exists( 'width', $form_attributes['buttonBorder'] ) ? 'border-width: ' . $form_attributes['buttonBorder']['width'] . ';' : "";

$button_style = 'color:' . $button_text_color . '; ' .
                'background-color: ' . $button_bg_color . '; ' .
                $button_border_color .
                $button_border_style .
                $button_border_width .
                'border-radius: ' . $button_border_radius . 'px;' .
                'font-weight: ' . $button_text_font_weight;

$view = '<div ' . get_block_wrapper_attributes() . '>';
$view .= '<form name="flr-blocks-user-settings-form" id="flr-blocks-user-settings-form" method="post">
			<div style="display: flex; flex-direction: column; margin-bottom: 50px; justify-content: center; align-items: center;">';
// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage
$view .= '<img src="' . get_avatar_url( $ID ) . '" alt="user avatar" style="max-width: 100%; height: auto; border-radius: 100%;">
				<a style="font-size:12px;" target="_blank" href="' . esc_url_raw( 'https://en.gravatar.com/' ) . '">' . esc_html_x( 'You can change your profile picture on Gravatar.', 'change_avatar_description', 'frontend-login-and-registration-blocks' ) . '</a>
			</div>
            <div class="flr-blocks-form-row">
               <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-user-first-name">
									' . esc_html_x( "First Name (optional)", "user_first_name_text", "frontend-login-and-registration-blocks" ) . '
								  </label>';

}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-user-first-name" name="flr-blocks-user-first-name" type="text" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your first name", "user_first_name_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" value="' . esc_attr( $first_name ) . '" />';
$view .= '</div>
			</div>';

$view .= '<div class="flr-blocks-form-row">
				         <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-user-last-name">
												' . esc_html_x( "Last Name (optional)", "user_last_name_text", "frontend-login-and-registration-blocks" ) . '
										</label>';

}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-user-last-name" name="flr-blocks-user-last-name" type="text" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your last name", "user_last_name_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" value="' . esc_attr( $last_name ) . '" />';
$view .= '</div>
			</div>';

$view .= '<div class="flr-blocks-form-row">
               <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-email-update">
									' . esc_html_x( "Your e-mail", "email_input_text", "frontend-login-and-registration-blocks" ) . '
								 </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-email-update" name="flr-blocks-email-update" type="text" required style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your e-mail", "email_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" value="' . esc_attr( $user_email ) . '" />';
$view .= '</div>
           </div>';

$view .= '<div class="flr-blocks-form-row">
				         <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-user-website">
										' . esc_html_x( "Website Url (optional)", "user_website_text", "frontend-login-and-registration-blocks" ) . '
									 </label>';

}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-user-website" name="flr-blocks-user-website" type="text" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your website url", "user_website_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" value="' . esc_attr( $website ) . '" />';
$view .= '</div>
			</div>';

$hook_attributes = [
	'current_user'    => $current_user,
	'text_style'      => $text_style,
	'input_style'     => $input_style,
	'form_attributes' => $form_attributes
];
$view            .= apply_filters( 'flr_blocks_user_settings_extra_fields', '', $hook_attributes );

$view .= '<div class="flr-blocks-form-row">
						<div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-user-bio">
											' . esc_html_x( "Your short biography (optional)", "user_bio_text", "frontend-login-and-registration-blocks" ) . '
										 </label>';

}

$view .= '<textarea class="flr-blocks-textarea-control" name="flr-blocks-user-bio" id="flr-blocks-user-bio" cols="30" rows="10" >';

if ( $bio ) {

	$view .= esc_textarea( $bio );

}

$view .= '</textarea>';
$view .= '</div>
			</div>';

$view .= '<div class="flr-blocks-form-row">
					      <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-current-password">
											' . esc_html_x( "Current Password", "current_password_input_text", "frontend-login-and-registration-blocks" ) . '
										  </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-current-password" name="flr-blocks-current-password" type="password" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your current password", "current_password_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" />';
$view .= '</div>
			</div>';

$view .= '<div class="flr-blocks-form-row">
					      <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password-update">
											' . esc_html_x( "New Password", "new_password_input_text", "frontend-login-and-registration-blocks" ) . '
										 </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password-update" name="flr-blocks-password-update" type="password" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your new password", "new_password_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" />';
$view .= '</div>
			</div>';

$view .= '<div class="flr-blocks-form-row">
					    <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-password-again-update">
											' . esc_html_x( "New Password Again", "new_password_again_input_text", "frontend-login-and-registration-blocks" ) . '
										  </label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-password-again-update" name="flr-blocks-password-again-update" type="password" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your new password again", "new_password_again_placeholder_text", "frontend-login-and-registration-blocks" );

}

$view .= '" />';

$view .= '</div>
			</div>';

$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flrblocksusersettingsupdatehandle' ) . '">';

$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flrblocksusersettingsupdatehandle' ) ) . '">';

$view .= '<input type="hidden" name="user_id" value="' . esc_attr( $ID ) . '">';

$view .= '<div class="flr-blocks-form-row">
							<button style="' . $button_style . '" type="submit" id="flr-blocks-user-settings-submit" class="flr-blocks-update-user-btn flr-blocks-btn wp-block-button__link wp-element-button">
								' . esc_html_x( "Update User", "update_user_button_text", "frontend-login-and-registration-blocks" ) . '
							</button>
						</div>
						<div id="flr-blocks-user-settings-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...", "loading_text", "frontend-login-and-registration-blocks" ) . '</div>';
$view .= '</form>
	<div id="flr-blocks-user-settings-form-result"></div>
</div></div>';
