<?php

use FLR_BLOCKS\Flr_Blocks_Helper;

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
			<form name="flr-blocks-reset-pass-form" id="flr-blocks-reset-pass-form" method="post">';

			$view .= '<div class="flr-blocks-form-row">
							<div class="flr-blocks-input-group">';

							if ( $form_attributes['showLabels'] ) {

								$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="resetpass_pwd">' . esc_html_x( "New Password","new_password_input_text", "flr-blocks" ) . '</label>';
							}

							$view .= '<input class="flr-blocks-input-control" id="resetpass_pwd" name="resetpass_pwd" type="password" required style=' . $input_style . ' placeholder="';

							if ( $form_attributes['showPlaceholders'] ) {

								$view .= esc_attr_x( "Enter your new password", "new_password_placeholder_text", "flr-blocks" );

							}

							$view .= '" />';
							$view .= '</div>

					</div>';

			$view .= '<div class="flr-blocks-form-row">
						<div class="flr-blocks-input-group">';

							if ( $form_attributes['showLabels'] ) {

								$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="resetpass_pwd_again">' . esc_html_x( "New Password Again", "new_password_again_input_text", "flr-blocks" ) . '</label>';
							}

							$view .= '<input class="flr-blocks-input-control" id="resetpass_pwd_again" name="resetpass_pwd_again" type="password" required style=' . $input_style . ' placeholder="';

							if ( $form_attributes['showPlaceholders'] ) {

								$view .= esc_attr_x( "Enter your new password again", "new_password_again_placeholder_text", "flr-blocks" );

							}

							$view .= '" />';
							$view .= '</div>

					</div>';

			$view .= '<input type="hidden" name="action" value="'.esc_attr('flrblocksresetpasswordhandle').'">';
			$view .= '<input type="hidden" name="security" value="'.esc_attr(wp_create_nonce('flrblocksresetpasswordhandle')).'">';
			$view .= '<input type="hidden" name="userid" value="' . esc_attr(Flr_Blocks_Helper::get( 'user' )) . '">';

			$view .= '<div class="flr-blocks-form-row">
							<button style="'.$button_style.'" type="submit" id="flr-blocks-reset-password-submit" class="flr-blocks-reset-password-btn flr-blocks-btn">
								' . esc_html_x( "Change Password", "submit_reset_password_button_text", "flr-blocks" ) . '
							</button>
						</div>
				<div id="flr-blocks-reset-password-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...","loading_text", "flr-blocks" ) . '</div>';
		$view .= '</form>
	<div id="flr-blocks-reset-password-form-result"></div>
</div>';




