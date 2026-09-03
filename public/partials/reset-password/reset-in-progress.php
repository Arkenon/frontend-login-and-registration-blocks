<?php
/**
 * Step two of a password reset: choose the new password.
 *
 * Reached only when check_password_reset_key() accepted the link, which
 * public/partials/reset-password/reset-password-form.php verifies first.
 *
 * Mirrored by src/reset-password-form/edit.js when its editor preview is set to
 * the change step. The ids are a contract with
 * src/reset-password-form/frontend.js.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Style;

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<form name="flr-blocks-reset-pass-form" id="flr-blocks-reset-pass-form" method="post" class="flr-blocks-form">';

$view .= Flr_Blocks_Form_Markup::description(
	$form_attributes,
	'progressDescription',
	_x( 'Choose a new password for your account.', 'reset_in_progress_description', 'frontend-login-and-registration-blocks' )
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'resetpass_pwd',
		'key'          => 'newPassword',
		'type'         => 'password',
		'required'     => true,
		'autocomplete' => 'new-password',
		'label'        => _x( 'New Password', 'new_password_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your new password', 'new_password_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'resetpass_pwd_again',
		'key'          => 'newPasswordAgain',
		'type'         => 'password',
		'required'     => true,
		'autocomplete' => 'new-password',
		'label'        => _x( 'New Password Again', 'new_password_again_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your new password again', 'new_password_again_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::form_action( 'flrblocksresetpasswordhandle' );

$view .= '<input type="hidden" name="rp_key" value="' . esc_attr( Flr_Blocks_Helper::sanitize( 'rp_key', 'get' ) ) . '">';
$view .= '<input type="hidden" name="rp_login" value="' . esc_attr( Flr_Blocks_Helper::sanitize( 'rp_login', 'get' ) ) . '">';

$view .= Flr_Blocks_Form_Markup::submit(
	$form_attributes,
	'reset-password',
	'flr-blocks-reset-password-submit',
	'flr-blocks-reset-password-loading',
	Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'changeSubmit',
		_x( 'Change Password', 'submit_reset_password_button_text', 'frontend-login-and-registration-blocks' )
	)
);

$view .= '</form>';

$view .= Flr_Blocks_Form_Markup::result( 'flr-blocks-reset-password-form-result' );

$view .= '</div>';
