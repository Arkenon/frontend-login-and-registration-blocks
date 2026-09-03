<?php
/**
 * Emits the renderer's verdict for every parity case as JSON on stdout.
 *
 * Consumed by tests/parity.mjs, which compares it against the editor's verdict.
 * The cases arrive as a JSON file of attribute bundles so the same harness can
 * cover both single tokens and whole design presets.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

require_once __DIR__ . '/bootstrap.php';

use FLR_BLOCKS\Flr_Blocks_Style;

$flr_input = $argv[1] ?? '';

if ( '' === $flr_input || ! is_readable( $flr_input ) ) {
	fwrite( STDERR, "Usage: php parity-php.php <cases.json>\n" );
	exit( 1 );
}

$flr_cases   = json_decode( file_get_contents( $flr_input ), true );
$flr_results = [];

foreach ( $flr_cases as $flr_case ) {
	$flr_results[] = [
		'vars'    => Flr_Blocks_Style::css_vars( $flr_case['attributes'] ),
		'classes' => Flr_Blocks_Style::classes( $flr_case['attributes'] ),
		'button'  => Flr_Blocks_Style::button_class( $flr_case['attributes'], 'login' ),
	];
}

echo json_encode( $flr_results, JSON_UNESCAPED_SLASHES );
