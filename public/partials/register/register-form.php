<?php
/**
 * Front-end markup for the registration form block.
 *
 * Mirrored by src/register-form/edit.js in the editor and styled entirely by
 * public/css/flr-blocks-forms.css through the --flr-* custom properties on the
 * wrapper. See public/partials/login/login-form.php for the shape.
 *
 * The ids and the state class names are a contract with
 * src/register-form/frontend.js.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Login;
use FLR_BLOCKS\Flr_Blocks_Style;

if ( is_user_logged_in() ) {

	$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
			. '<p class="flr-blocks-description">'
			. esc_html_x( 'This form is only shown to users who are not logged in.', 'alert_for_non_logged_in_users', 'frontend-login-and-registration-blocks' )
			. '</p></div>';

	return;

}

$login   = new Flr_Blocks_Login();
$options = Flr_Blocks_Style::options( $form_attributes );

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<form name="flr-blocks-register-form" id="flr-blocks-register-form" method="post" class="flr-blocks-form">';

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-username-for-register',
		'key'          => 'username',
		'type'         => 'text',
		'required'     => true,
		'autocomplete' => 'username',
		'label'        => _x( 'Username', 'username_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your username', 'username_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-email-for-register',
		'key'          => 'email',
		'type'         => 'email',
		'required'     => true,
		'autocomplete' => 'email',
		'label'        => _x( 'Your e-mail', 'email_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your e-mail', 'email_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

/**
 * Filters extra fields appended after the e-mail field.
 *
 * The text_style and input_style keys carried inline CSS in 1.x. Styling is
 * token driven in 2.0, so they are now always empty strings and are kept only
 * so existing callbacks do not hit an undefined index. Add classes instead.
 *
 * @since 1.0.0
 *
 * @param string $fields Markup to append.
 * @param array $hook_attributes Context for the callback.
 */
$view .= apply_filters(
	'flr_blocks_register_form_extra_fields',
	'',
	[
		'form_attributes' => $form_attributes,
		'field_options'   => $options,
		'label_class'     => 'flr-blocks-input-label',
		'input_class'     => 'flr-blocks-input-control',
		'text_style'      => '',
		'input_style'     => '',
	]
);

if ( ! empty( $options['showFirstName'] ) ) {

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-first-name-for-register',
			'key'          => 'firstName',
			'type'         => 'text',
			'autocomplete' => 'given-name',
			'label'        => _x( 'First Name', 'first_name_input_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your first name', 'first_name_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

}

if ( ! empty( $options['showLastName'] ) ) {

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-last-name-for-register',
			'key'          => 'lastName',
			'type'         => 'text',
			'autocomplete' => 'family-name',
			'label'        => _x( 'Last Name', 'last_name_input_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your last name', 'last_name_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

}

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-password-for-register',
		'key'          => 'password',
		'type'         => 'password',
		'required'     => true,
		'autocomplete' => 'new-password',
		'label'        => _x( 'Password', 'password_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your password', 'password_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-password-again-for-register',
		'key'          => 'passwordAgain',
		'type'         => 'password',
		'required'     => true,
		'autocomplete' => 'new-password',
		'label'        => _x( 'Password Again', 'password_again_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your password again', 'password_again_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

if ( ! empty( $options['showTermsAndPrivacy'] ) ) {

	$terms_label = Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'terms',
		sprintf(
			/* translators: %1$s: terms and conditions URL, %2$s: privacy policy URL */
			__( 'I have read and accept <a href="%1$s" target="_blank">terms and conditions</a> and <a href="%2$s" target="_blank">privacy policy</a>', 'frontend-login-and-registration-blocks' ),
			esc_url( get_option( 'flr_blocks_terms_and_conditions_page' ) ),
			esc_url( get_option( 'flr_blocks_privacy_policy_page' ) )
		)
	);

	$view .= Flr_Blocks_Form_Markup::checkbox_row( 'flr-blocks-terms-and-privacy', $terms_label, true, true );

}

$view .= Flr_Blocks_Form_Markup::form_action( 'flrblocksregisterhandle' );

$view .= Flr_Blocks_Form_Markup::submit(
	$form_attributes,
	'register',
	'flr-blocks-register-submit',
	'flr-blocks-register-loading',
	Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'submit',
		_x( 'Register', 'register_button_text', 'frontend-login-and-registration-blocks' )
	)
);

$view .= '</form>';

$view .= Flr_Blocks_Form_Markup::result( 'flr-blocks-register-form-result' );

if ( ! empty( $options['showLinks'] ) ) {

	$view .= Flr_Blocks_Form_Markup::links(
		[
			[
				'url'   => $login->get_login_url(),
				'label' => Flr_Blocks_Style::text(
					$form_attributes,
					'labels',
					'login',
					_x( 'Login', 'login_text', 'frontend-login-and-registration-blocks' )
				),
			],
		],
		Flr_Blocks_Style::text(
			$form_attributes,
			'labels',
			'haveAccount',
			_x( 'Already signed up?', 'already_signed_in_message', 'frontend-login-and-registration-blocks' )
		)
	);

}

$view .= '</div>';
