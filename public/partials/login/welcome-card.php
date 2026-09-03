<?php
/**
 * Front-end markup for the welcome card block.
 *
 * In 1.x this file assigned $view only when the visitor was signed in, so a
 * signed-out visitor produced an undefined variable notice. What a signed-out
 * visitor should see is now an explicit setting rather than an oversight.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Login;
use FLR_BLOCKS\Flr_Blocks_Style;

if ( is_user_logged_in() ) {

	$view = Flr_Blocks_Helper::return_view( 'public/partials/login/already-logged-in.php', $form_attributes );

	return;

}

$behavior = $form_attributes['loggedOutBehavior'] ?? 'hide';

if ( 'hide' === $behavior ) {

	$view = '';

	return;

}

if ( 'login-link' === $behavior ) {

	$login = new Flr_Blocks_Login();

	$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
			. Flr_Blocks_Form_Markup::links(
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
				]
			)
			. '</div>';

	return;

}

$message = trim( (string) ( $form_attributes['loggedOutMessage'] ?? '' ) );

if ( '' === $message ) {
	$message = _x( 'Please log in to see your account.', 'welcome_card_logged_out_message', 'frontend-login-and-registration-blocks' );
}

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>'
		. '<p class="flr-blocks-description">' . esc_html( $message ) . '</p>'
		. '</div>';
