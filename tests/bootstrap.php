<?php
/**
 * Minimal bootstrap for the token tests.
 *
 * These tests exercise Flr_Blocks_Style against core's real safecss_filter_attr(),
 * which is the whole point of them, but they need no database and no themes, so
 * only the two files that function depends on are loaded.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

$flr_plugin_path = dirname( __DIR__ ) . '/';
$flr_abspath     = dirname( $flr_plugin_path, 3 ) . '/';

if ( ! is_readable( $flr_abspath . 'wp-includes/kses.php' ) ) {
	fwrite( STDERR, "Could not locate WordPress at {$flr_abspath}\n" );
	exit( 1 );
}

define( 'ABSPATH', $flr_abspath );
define( 'FLR_BLOCKS_PLUGIN_PATH', $flr_plugin_path );

require ABSPATH . 'wp-includes/plugin.php';
require ABSPATH . 'wp-includes/kses.php';

if ( ! function_exists( 'wp_allowed_protocols' ) ) {
	function wp_allowed_protocols() {
		return [ 'http', 'https', 'mailto' ];
	}
}

if ( ! function_exists( '_deprecated_argument' ) ) {
	function _deprecated_argument( $function_name, $version, $message = '' ) {}
}

if ( ! function_exists( 'sanitize_html_class' ) ) {
	function sanitize_html_class( $css_class ) {
		return preg_replace( '/[^A-Za-z0-9_-]/', '', $css_class );
	}
}

require_once FLR_BLOCKS_PLUGIN_PATH . 'inc/class-flr-blocks-style.php';
