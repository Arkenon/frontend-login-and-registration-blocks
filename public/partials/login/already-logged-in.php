<?php
/**
 * The card a signed-in member sees.
 *
 * Rendered both by the welcome card block and by the login form block, which
 * shows it in place of a form once the visitor is signed in. Every attribute
 * read here has a fallback, because the login form block does not carry the
 * welcome card's own settings.
 *
 * Mirrored by src/welcome-card/edit.js.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Form_Markup;
use FLR_BLOCKS\Flr_Blocks_Helper;
use FLR_BLOCKS\Flr_Blocks_Logout;
use FLR_BLOCKS\Flr_Blocks_Style;

Flr_Blocks_Helper::using( 'inc/class-flr-blocks-logout.php' );

$logout       = new Flr_Blocks_Logout();
$current_user = wp_get_current_user();

/**
 * Fill the greeting placeholders in.
 *
 * Each substitution is escaped before it goes in, so the assembled string is
 * safe to echo without escaping the whole thing again and mangling any markup
 * the author did not write.
 */
$greeting = trim( (string) ( $form_attributes['greeting'] ?? '' ) );

if ( '' === $greeting ) {
	/* translators: %s is replaced by the member's display name. */
	$greeting = _x( 'Hello {display_name},', 'welcome_card_greeting', 'frontend-login-and-registration-blocks' );
}

$greeting = strtr(
	$greeting,
	[
		'{username}'     => $current_user->user_login,
		'{display_name}' => $current_user->display_name,
		'{first_name}'   => '' !== $current_user->first_name ? $current_user->first_name : $current_user->display_name,
		'{email}'        => $current_user->user_email,
	]
);

$view = '<div ' . Flr_Blocks_Style::wrapper( $form_attributes ) . '>';

$view .= '<div class="flr-blocks-card">';

if ( false !== ( $form_attributes['showAvatar'] ?? true ) ) {

	// phpcs:ignore PluginCheck.CodeAnalysis.ImageFunctions.NonEnqueuedImage -- Gravatar URL, not a media library attachment.
	$view .= '<img class="flr-blocks-avatar" src="' . esc_url( get_avatar_url( $current_user->ID ) ) . '" alt="'
			. esc_attr_x( 'Your profile picture', 'avatar_alt_text', 'frontend-login-and-registration-blocks' ) . '">';

}

$view .= '<p class="flr-blocks-description">' . esc_html( $greeting ) . '</p>';

$links = [];

if ( false !== ( $form_attributes['showDashboardLink'] ?? true )
	&& 'yes' === get_option( 'flr_blocks_has_user_dashboard' ) ) {

	$links[] = [
		'url'   => Flr_Blocks_Helper::get_page_permalink( get_option( 'flr_blocks_user_settings_page' ) ),
		'label' => Flr_Blocks_Style::text(
			$form_attributes,
			'labels',
			'dashboard',
			_x( 'Go to user dashboard', 'go_to_user_dashboard_text', 'frontend-login-and-registration-blocks' )
		),
	];

}

if ( false !== ( $form_attributes['showLogoutLink'] ?? true ) ) {

	$links[] = [
		'url'   => $logout->nonce_url_for_logout(),
		'label' => Flr_Blocks_Style::text(
			$form_attributes,
			'labels',
			'logout',
			_x( 'Logout', 'logout_text', 'frontend-login-and-registration-blocks' )
		),
	];

}

$view .= Flr_Blocks_Form_Markup::links( $links );

$view .= '</div></div>';
