<?php

use FLWGB\Helper;

$input_style = 'border-radius:' . $form_attributes['inputBorderRadius'] . 'px';
$text_style  = 'color:' . $form_attributes['textColor'] . '; font-weight:' . $form_attributes['textFontWeight'];

$button_border_color  = array_key_exists('color',$form_attributes['buttonBorder']) ? 'border-color: '. $form_attributes['buttonBorder']['color'].';' : "";
$button_border_style  = array_key_exists('style',$form_attributes['buttonBorder']) ? 'border-style: '.$form_attributes['buttonBorder']['style'].';' : "";
$button_border_width  = array_key_exists('width',$form_attributes['buttonBorder']) ? 'border-width: '.$form_attributes['buttonBorder']['width'].';' : "";

$button_style = 'color:' . $form_attributes['buttonTextColor'] . '; ' .
                'background-color: ' . $form_attributes['buttonBgColor'] . '; ' .
                $button_border_color .
                $button_border_style .
                $button_border_width .
                'border-radius: ' . $form_attributes['buttonBorderRadius'] . 'px;' .
                'font-weight: ' . $form_attributes['buttonTextFontWeight'];


$view = '<div '.get_block_wrapper_attributes().'>
			<form name="flwgb-reset-pass-form" id="flwgb-reset-pass-form" method="post">';

			$view .= '<div class="flwgb-form-row">
							<div class="flwgb-input-group">';

							if ( $form_attributes['showLabels'] ) {

								$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="resetpass_pwd">' . esc_html_x( "New Password","new_password_input_text", "flwgb" ) . '</label>';
							}

							$view .= '<input class="flwgb-input-control" id="resetpass_pwd" name="resetpass_pwd" type="password" required style=' . $input_style . ' placeholder="';

							if ( $form_attributes['showPlaceholders'] ) {

								$view .= esc_attr_x( "Enter your new password", "new_password_placeholder_text", "flwgb" );

							}

							$view .= '" />';
							$view .= '</div>

					</div>';

			$view .= '<div class="flwgb-form-row">
						<div class="flwgb-input-group">';

							if ( $form_attributes['showLabels'] ) {

								$view .= '<label class="flwgb-input-label" style="' . $text_style . '" for="resetpass_pwd_again">' . esc_html_x( "New Password Again", "new_password_again_input_text", "flwgb" ) . '</label>';
							}

							$view .= '<input class="flwgb-input-control" id="resetpass_pwd_again" name="resetpass_pwd_again" type="password" required style=' . $input_style . ' placeholder="';

							if ( $form_attributes['showPlaceholders'] ) {

								$view .= esc_attr_x( "Enter your new password again", "new_password_again_placeholder_text", "flwgb" );

							}

							$view .= '" />';
							$view .= '</div>

					</div>';

			$view .= '<input type="hidden" name="action" value="'.esc_attr('flwgbresetpasswordhandle').'">';
			$view .= '<input type="hidden" name="security" value="'.esc_attr(wp_create_nonce('flwgbresetpasswordhandle')).'">';
			$view .= '<input type="hidden" name="userid" value="' . esc_attr(Helper::get( 'user' )) . '">';

			$view .= '<div class="flwgb-form-row">
							<button style="'.$button_style.'" type="submit" id="flwgb-reset-password-submit" class="flwgb-reset-password-btn flwgb-btn">
								' . esc_html_x( "Change Password", "submit_reset_password_button_text", "flwgb" ) . '
							</button>
						</div>
				<div id="flwgb-reset-password-loading" class="flwgb-loading flwgb-hide">' . esc_html_x( "Loading...","loading_text", "flwgb" ) . '</div>';
		$view .= '</form>
	<div id="flwgb-reset-password-form-result"></div>
</div>';




