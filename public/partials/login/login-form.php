<?php
/**
 * Front-end markup for the login form block.
 *
 * The element structure and class names here are mirrored by
 * src/shared/form-parts in the editor, and both are styled by the single
 * stylesheet public/css/flr-blocks-forms.css. Nothing on this page carries an
 * inline style of its own: every visual choice arrives as a --flr-* custom
 * property on the wrapper, built by Flr_Blocks_Style::wrapper().
 *
 * The ids and the state class names are a contract with
 * src/login-form/frontend.js. Do not rename flr-blocks-login-form,
 * flr-blocks-login-submit, flr-blocks-login-form-result or
 * flr-blocks-login-loading without changing that module too.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Style;

if ( is_user_logged_in() ) {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/login/already-logged-in.php', $form_attributes );

	return;
}

$options = Flr_Blocks_Style::options( $form_attributes );

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<form name="flr-blocks-login-form" id="flr-blocks-login-form" method="post" class="flr-blocks-form">';

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-username-or-email',
		'key'          => 'usernameOrEmail',
		'type'         => 'text',
		'required'     => true,
		'autocomplete' => 'username',
		'label'        => _x( 'Username or E-mail', 'email_or_username_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your username or e-mail', 'email_or_username_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-password',
		'key'          => 'password',
		'type'         => 'password',
		'required'     => true,
		'autocomplete' => 'current-password',
		'label'        => _x( 'Password', 'password_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your password', 'password_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

if ( ! empty( $options['showRememberMe'] ) ) {

	$view .= Flr_Blocks_Form_Markup::checkbox_row(
		'flr-blocks-rememberme',
		esc_html(
			Flr_Blocks_Style::text(
				$form_attributes,
				'labels',
				'rememberMe',
				_x( 'Remember me', 'remember_me_text', 'frontend-login-and-registration-blocks' )
			)
		)
	);

}

$view .= Flr_Blocks_Form_Markup::form_action( 'flrblocksloginhandle' );

$view .= Flr_Blocks_Form_Markup::submit(
	$form_attributes,
	'login',
	'flr-blocks-login-submit',
	'flr-blocks-login-loading',
	Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'submit',
		_x( 'Login', 'login_text', 'frontend-login-and-registration-blocks' )
	)
);

$view .= '</form>';

$view .= Flr_Blocks_Form_Markup::result( 'flr-blocks-login-form-result' );

if ( ! empty( $options['showLinks'] ) ) {

	$view .= Flr_Blocks_Form_Markup::links(
		[
			[
				'url'   => Flr_Blocks_Helper::get_page_permalink( get_option( 'flr_blocks_lost_password_page' ) ),
				'label' => Flr_Blocks_Style::text(
					$form_attributes,
					'labels',
					'lostPassword',
					_x( 'Lost Password', 'reset_password_button_text', 'frontend-login-and-registration-blocks' )
				),
			],
			[
				'url'   => Flr_Blocks_Helper::get_page_permalink( get_option( 'flr_blocks_register_page' ) ),
				'label' => Flr_Blocks_Style::text(
					$form_attributes,
					'labels',
					'register',
					_x( 'Register', 'register_button_text', 'frontend-login-and-registration-blocks' )
				),
			],
		]
	);

}

$view .= '</div>';
