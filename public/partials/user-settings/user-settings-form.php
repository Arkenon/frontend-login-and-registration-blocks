<?php
/**
 * Front-end markup for the user settings form block.
 *
 * Mirrored by src/user-settings-form/edit.js and styled entirely through the
 * --flr-* custom properties on the wrapper. The ids are a contract with
 * src/user-settings-form/frontend.js.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Style;

if ( ! is_user_logged_in() ) {

	$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
			. '<p class="flr-blocks-description">'
			. esc_html_x( 'This form is only shown to logged in users...', 'alert_for_logged_in_users', 'frontend-login-and-registration-blocks' )
			. '</p></div>';

	return;

}

$current_user = wp_get_current_user();
$options      = Flr_Blocks_Style::options( $form_attributes );

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<form name="flr-blocks-user-settings-form" id="flr-blocks-user-settings-form" method="post" class="flr-blocks-form">';

if ( ! empty( $options['showAvatar'] ) ) {

	// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage -- Gravatar URL, not a media library attachment.
	$view .= '<img class="flr-blocks-avatar" src="' . esc_url( get_avatar_url( $current_user->ID ) ) . '" alt="'
			. esc_attr_x( 'Your profile picture', 'avatar_alt_text', 'frontend-login-and-registration-blocks' ) . '">';

	if ( ! empty( $options['showGravatarLink'] ) ) {

		$view .= Flr_Blocks_Form_Markup::links(
			[
				[
					'url'   => 'https://gravatar.com/',
					'label' => Flr_Blocks_Style::text(
						$form_attributes,
						'labels',
						'gravatar',
						_x( 'You can change your profile picture on Gravatar.', 'change_avatar_description', 'frontend-login-and-registration-blocks' )
					),
				],
			]
		);

	}
}

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-user-first-name',
		'key'          => 'firstName',
		'type'         => 'text',
		'value'        => $current_user->first_name,
		'autocomplete' => 'given-name',
		'label'        => _x( 'First Name (optional)', 'user_first_name_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your first name', 'user_first_name_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-user-last-name',
		'key'          => 'lastName',
		'type'         => 'text',
		'value'        => $current_user->last_name,
		'autocomplete' => 'family-name',
		'label'        => _x( 'Last Name (optional)', 'user_last_name_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your last name', 'user_last_name_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

$view .= Flr_Blocks_Form_Markup::field(
	$form_attributes,
	[
		'id'           => 'flr-blocks-email-update',
		'key'          => 'email',
		'type'         => 'email',
		'required'     => true,
		'value'        => $current_user->user_email,
		'autocomplete' => 'email',
		'label'        => _x( 'Your e-mail', 'email_input_text', 'frontend-login-and-registration-blocks' ),
		'placeholder'  => _x( 'Enter your e-mail', 'email_placeholder_text', 'frontend-login-and-registration-blocks' ),
	]
);

if ( ! empty( $options['showWebsite'] ) ) {

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-user-website',
			'key'          => 'website',
			'type'         => 'url',
			'value'        => $current_user->user_url,
			'autocomplete' => 'url',
			'label'        => _x( 'Website Url (optional)', 'user_website_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your website url', 'user_website_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

}

/**
 * Filters extra fields appended after the website field.
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
	'flr_blocks_user_settings_extra_fields',
	'',
	[
		'current_user'    => $current_user,
		'form_attributes' => $form_attributes,
		'field_options'   => $options,
		'label_class'     => 'flr-blocks-input-label',
		'input_class'     => 'flr-blocks-input-control',
		'text_style'      => '',
		'input_style'     => '',
	]
);

if ( ! empty( $options['showBio'] ) ) {

	$view .= Flr_Blocks_Form_Markup::textarea(
		$form_attributes,
		[
			'id'          => 'flr-blocks-user-bio',
			'key'         => 'bio',
			'rows'        => 6,
			'value'       => $current_user->user_description,
			'label'       => _x( 'Your short biography (optional)', 'user_bio_text', 'frontend-login-and-registration-blocks' ),
			'placeholder' => _x( 'Tell us a little about yourself', 'user_bio_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

}

if ( ! empty( $options['showPasswordSection'] ) ) {

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-current-password',
			'key'          => 'currentPassword',
			'type'         => 'password',
			'autocomplete' => 'current-password',
			'label'        => _x( 'Current Password', 'current_password_input_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your current password', 'current_password_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-password-update',
			'key'          => 'newPassword',
			'type'         => 'password',
			'autocomplete' => 'new-password',
			'label'        => _x( 'New Password', 'new_password_input_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your new password', 'new_password_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

	$view .= Flr_Blocks_Form_Markup::field(
		$form_attributes,
		[
			'id'           => 'flr-blocks-password-again-update',
			'key'          => 'newPasswordAgain',
			'type'         => 'password',
			'autocomplete' => 'new-password',
			'label'        => _x( 'New Password Again', 'new_password_again_input_text', 'frontend-login-and-registration-blocks' ),
			'placeholder'  => _x( 'Enter your new password again', 'new_password_again_placeholder_text', 'frontend-login-and-registration-blocks' ),
		]
	);

}

$view .= Flr_Blocks_Form_Markup::form_action( 'flrblocksusersettingsupdatehandle' );

$view .= '<input type="hidden" name="user_id" value="' . esc_attr( $current_user->ID ) . '">';

$view .= Flr_Blocks_Form_Markup::submit(
	$form_attributes,
	'update-user',
	'flr-blocks-user-settings-submit',
	'flr-blocks-user-settings-loading',
	Flr_Blocks_Style::text(
		$form_attributes,
		'labels',
		'submit',
		_x( 'Update User', 'update_user_button_text', 'frontend-login-and-registration-blocks' )
	)
);

$view .= '</form>';

$view .= Flr_Blocks_Form_Markup::result( 'flr-blocks-user-settings-form-result' );

$view .= '</div>';
