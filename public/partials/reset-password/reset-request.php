<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

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

$desc = $form_attributes['description'] ?: _x( "Please enter your e-mail address. We will send you an e-mail to reset your password.", "send_reset_request_description", "flr-blocks" );

$view = '<div '.get_block_wrapper_attributes().'>
				<form name="flr-blocks-reset-pass-request-form" id="flr-blocks-reset-pass-request-form" method="post">';

if ( $form_attributes['showDescription'] ) {
	$view .= '<div style="text-align:center;">
							<p>' . esc_html( $desc ) . '</p>
						  </div>';
}

$view .= '<div class="flr-blocks-form-row">
						    <div class="flr-blocks-input-group">';

if ( $form_attributes['showLabels'] ) {

	$view .= '<label class="flr-blocks-input-label" style="' . $text_style . '" for="flr-blocks-email">' . esc_html_x("Your e-mail", "email_input_text", "flr-blocks" ) . '</label>';
}

$view .= '<input class="flr-blocks-input-control" id="flr-blocks-email" name="flr-blocks-email" required type="text" style=' . $input_style . ' placeholder="';

if ( $form_attributes['showPlaceholders'] ) {

	$view .= esc_attr_x( "Enter your e-mail", "email_placeholder_text", "flr-blocks" );

}

$view .= '" />';
$view .= '</div>

						</div>';

$view .= '<input type="hidden" name="action" value="' . esc_attr( 'flrblocksresetrequesthandle' ) . '">';

$view .= '<input type="hidden" name="security" value="' . esc_attr( wp_create_nonce( 'flrblocksresetrequesthandle' ) ) . '">';

$view .= '<div class="flr-blocks-form-row">
							<button style="' . $button_style . '" type="submit" id="flr-blocks-reset-request-submit" class="flr-blocks-reset-request-btn flr-blocks-btn">
								' . esc_html_x( "Send Request", "send_reset_request", "flr-blocks" ) . '
							</button>
						</div>
				<div id="flr-blocks-reset-request-loading" class="flr-blocks-loading flr-blocks-hide">' . esc_html_x( "Loading...", "loading_text", "flr-blocks" ) . '</div>';
$view .= '</form>
			<div id="flr-blocks-reset-request-form-result"></div>
	    </div>';


