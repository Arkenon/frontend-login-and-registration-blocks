<?php
/**
 * Behaviour tests for Flr_Blocks_Style.
 *
 * Run with: npm run test:tokens
 *
 * The cases that matter most are the ones under "the rgba trap": core's
 * safecss_filter_attr() discards any declaration still containing a parenthesis
 * after it has stripped the CSS functions it knows, and rgba()/hsl()/color-mix()
 * are not on that list. A token carrying one would render in the editor and
 * vanish on the front end, so this class has to drop it on both sides instead.
 *
 * @package Frontend_Login_And_Registration_Blocks
 */

require_once __DIR__ . '/bootstrap.php';

use FLR_BLOCKS\Flr_Blocks_Style;

$flr_pass = 0;
$flr_fail = 0;

/**
 * Assert that two values match.
 *
 * @param string $label Test description.
 * @param mixed $actual Value under test.
 * @param mixed $expected Expected value.
 */
function flr_check( string $label, $actual, $expected ) {

	global $flr_pass, $flr_fail;

	if ( $actual === $expected ) {
		$flr_pass++;
		echo "  ok   $label\n";
	} else {
		$flr_fail++;
		echo "  FAIL $label\n";
		echo '       expected: ' . var_export( $expected, true ) . "\n";
		echo '       actual:   ' . var_export( $actual, true ) . "\n";
	}

}

echo "\n== token map ==\n";
flr_check( 'map loads', isset( Flr_Blocks_Style::map()['groups']['inputStyles'] ), true );

echo "\n== happy path ==\n";
flr_check(
	'plain tokens',
	Flr_Blocks_Style::css_vars( [
		'inputStyles'  => [ 'radius' => '8px', 'bg' => '#ffffff' ],
		'buttonStyles' => [ 'bg' => '#3858e9', 'width' => '100%' ],
	] ),
	'--flr-input-bg:#ffffff;--flr-input-radius:8px;--flr-button-bg:#3858e9;--flr-button-width:100%'
);

flr_check(
	'border object expands to three vars',
	Flr_Blocks_Style::css_vars( [
		'inputStyles' => [ 'border' => [ 'color' => '#dcdcde', 'width' => '1px', 'style' => 'solid' ] ],
	] ),
	'--flr-input-border-color:#dcdcde;--flr-input-border-width:1px;--flr-input-border-style:solid'
);

flr_check(
	'8 digit hex alpha survives',
	Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'focusShadow' => '0 0 0 3px #3858e926' ] ] ),
	'--flr-input-focus-shadow:0 0 0 3px #3858e926'
);

flr_check(
	'var() reference survives',
	Flr_Blocks_Style::css_vars( [ 'labelStyles' => [ 'color' => 'var(--wp--preset--color--primary)' ] ] ),
	'--flr-label-color:var(--wp--preset--color--primary)'
);

flr_check(
	'clamp() length survives',
	Flr_Blocks_Style::css_vars( [ 'layoutStyles' => [ 'maxWidth' => 'clamp(320px, 50vw, 480px)' ] ] ),
	'--flr-form-max-width:clamp(320px, 50vw, 480px)'
);

echo "\n== the rgba trap ==\n";
flr_check(
	'rgba shadow dropped',
	Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'focusShadow' => '0 0 0 3px rgba(56,88,233,.15)' ] ] ),
	''
);
flr_check(
	'rgba colour dropped',
	Flr_Blocks_Style::css_vars( [ 'labelStyles' => [ 'color' => 'rgba(0,0,0,.5)' ] ] ),
	''
);
flr_check(
	'good token kept when a sibling rgba token is dropped',
	Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'radius' => '8px', 'focusShadow' => 'rgba(0,0,0,.2)' ] ] ),
	'--flr-input-radius:8px'
);

echo "\n== malformed values ==\n";
flr_check( 'keyword not in allow list', Flr_Blocks_Style::css_vars( [ 'buttonStyles' => [ 'width' => '50%' ] ] ), '' );
flr_check( 'unknown group key ignored', Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'bogus' => 'x' ] ] ), '' );
flr_check( 'bad length', Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'radius' => '8 furlongs' ] ] ), '' );
flr_check( 'semicolon injection', Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'radius' => '8px;color:red' ] ] ), '' );
flr_check( 'url() refused', Flr_Blocks_Style::css_vars( [ 'labelStyles' => [ 'color' => 'url(https://example.com/x.png)' ] ] ), '' );
flr_check( 'array where scalar expected', Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'radius' => [ 1, 2 ] ] ] ), '' );
flr_check( 'empty attributes', Flr_Blocks_Style::css_vars( [] ), '' );
flr_check(
	'no leading or trailing semicolon',
	( static function () {
		$value = Flr_Blocks_Style::css_vars( [ 'inputStyles' => [ 'radius' => '8px' ] ] );

		return '' !== $value && ';' !== $value[0] && ';' !== substr( $value, -1 );
	} )(),
	true
);

echo "\n== useThemeButton ==\n";
$flr_theme_button = [
	'fieldOptions' => [ 'useThemeButton' => true ],
	'inputStyles'  => [ 'radius' => '8px' ],
	'buttonStyles' => [ 'bg' => '#3858e9', 'radius' => '8px' ],
];
flr_check( 'button tokens suppressed', Flr_Blocks_Style::css_vars( $flr_theme_button ), '--flr-input-radius:8px' );
flr_check( 'wrapper class added', str_contains( Flr_Blocks_Style::classes( $flr_theme_button ), 'flr-theme-button' ), true );
flr_check( 'core button classes restored', Flr_Blocks_Style::button_class( $flr_theme_button, 'login' ), 'flr-blocks-login-btn flr-blocks-btn wp-block-button__link wp-element-button' );
flr_check( 'core button classes absent by default', Flr_Blocks_Style::button_class( [], 'login' ), 'flr-blocks-login-btn flr-blocks-btn' );

echo "\n== classes ==\n";
flr_check( 'preset class', Flr_Blocks_Style::classes( [ 'preset' => 'card' ] ), 'flr-blocks-form-wrapper flr-preset-card' );
flr_check( 'label position class', Flr_Blocks_Style::classes( [ 'fieldOptions' => [ 'labelPosition' => 'hidden' ] ] ), 'flr-blocks-form-wrapper flr-labels-hidden' );
flr_check( 'top label position adds nothing', Flr_Blocks_Style::classes( [] ), 'flr-blocks-form-wrapper' );

echo "\n== options and text ==\n";
flr_check( 'default option', Flr_Blocks_Style::options( [] )['showLabels'], true );
flr_check( 'overridden option', Flr_Blocks_Style::options( [ 'fieldOptions' => [ 'showLabels' => false ] ] )['showLabels'], false );
flr_check( 'text fallback', Flr_Blocks_Style::text( [], 'labels', 'submit', 'Login' ), 'Login' );
flr_check( 'text override', Flr_Blocks_Style::text( [ 'labels' => [ 'submit' => 'Sign in' ] ], 'labels', 'submit', 'Login' ), 'Sign in' );
flr_check( 'blank override falls back', Flr_Blocks_Style::text( [ 'labels' => [ 'submit' => '   ' ] ], 'labels', 'submit', 'Login' ), 'Login' );

echo "\n--------------------------------\n";
echo "passed: $flr_pass   failed: $flr_fail\n";

exit( $flr_fail > 0 ? 1 : 0 );
