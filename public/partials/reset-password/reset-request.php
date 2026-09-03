<?php
/**
 * Step one of a password reset: ask for the e-mail address.
 *
 * Mirrored by src/reset-password-form/edit.js when its editor preview is set to
 * the request step. The ids are a contract with
 * src/reset-password-form/frontend.js.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Style;

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<form name="flr-blocks-reset-pass-request-form" id="flr-blocks-reset-pass-request-form" method="post" class="flr-blocks-form">';

$view .= Flr_Blocks_Form_Markup::description(
	$form_attributes,
	'requestDescription',
	_x( 'Please enter your e-mail address. We will send you an e-mail to reset your password.', 'send_reset_request_description', 'frontend-login-and-registration-blocks' )
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-email',
		'key'          => 'email',
		'type'         => 'email',
		'required'     => true,
		'autocomplete' => 'email',
		'label'        => _x( 'Your e-mail', 'email_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your e-mail', 'email_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::form_action( 'flrblocksresetrequesthandle' );

$view .= Flr_Blocks_Form_Markup::submit(
	$form_attributes,
	'reset-request',
	'flr-blocks-reset-request-submit',
	'flr-blocks-reset-request-loading',
	Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'requestSubmit',
		_x( 'Send Request', 'send_reset_request', 'frontend-login-and-registration-blocks' )
	)
);

$view .= '</form>';

$view .= Flr_Blocks_Form_Markup::result( 'flr-blocks-reset-request-form-result' );

$view .= '</div>';
