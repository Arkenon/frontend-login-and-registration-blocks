<?php
/**
 * Design token to CSS custom property serialiser.
 *
 * Every visual setting a user makes on the inner parts of a form (labels, inputs,
 * the submit button, links, the checkbox row, notices) is stored as a grouped
 * object attribute and rendered as a --flr-* custom property on the block wrapper.
 * The defaults for those properties live in public/css/flr-blocks-forms.css, so
 * this class only ever emits the values the user actually set.
 *
 * The token map is shared with the editor (src/shared/style-vars.js) through
 * flr-style-tokens.json so the two sides cannot drift apart.
 *
 * @since      2.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_Style {

	/**
	 * Decoded flr-style-tokens.json, cached for the request.
	 *
	 * @var array|null
	 */
	private static ?array $map = null;

	/**
	 * Length values: a number with an optional CSS unit.
	 */
	private const LENGTH_PATTERN = '/^[+-]?(?:\d+\.?\d*|\.\d+)(?:px|em|rem|%|vw|vh|vmin|vmax|ch|ex|pt|pc|cm|mm|in)?$/';

	/**
	 * Colour values: 3, 4, 6 or 8 digit hex, or a bare CSS colour keyword.
	 */
	private const COLOR_PATTERN = '/^(?:#(?:[0-9a-f]{3,4}|[0-9a-f]{6}|[0-9a-f]{8})|[a-z]+)$/i';

	/**
	 * Border style keywords accepted by BorderControl.
	 */
	private const BORDER_STYLES = [ 'none', 'hidden', 'solid', 'dashed', 'dotted', 'double', 'groove', 'ridge', 'inset', 'outset' ];

	/**
	 * Load and cache the shared token map.
	 *
	 * @return array
	 * @since 2.0.0
	 */
	public static function map(): array {

		if ( null === self::$map ) {

			$file = FLR_BLOCKS_PLUGIN_PATH . 'flr-style-tokens.json';

			$decoded = is_readable( $file )
				// phpcs:ignore WordPress.WP.AlternativeFunctions.file_get_contents_file_get_contents -- Reading a bundled plugin file, not a remote resource.
				? json_decode( file_get_contents( $file ), true )
				: null;

			self::$map = is_array( $decoded ) ? $decoded : [ 'groups' => [], 'options' => [] ];

		}

		return self::$map;

	}

	/**
	 * Merge the saved option overrides for a block onto the shared defaults.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $group Option group name.
	 *
	 * @return array
	 * @since 2.0.0
	 */
	public static function options( array $attributes, string $group = 'fieldOptions' ): array {

		$defaults = self::map()['options'][ $group ] ?? [];
		$saved    = is_array( $attributes[ $group ] ?? null ) ? $attributes[ $group ] : [];

		return array_merge( $defaults, $saved );

	}

	/**
	 * Build the --flr-* declaration list for a block.
	 *
	 * Emits no leading or trailing semicolon: WordPress 6.5 joins the core
	 * supports style string and this one with a space, while 6.6 and later trim
	 * both and join them with a semicolon. Neither tolerates an empty part.
	 *
	 * @param array $attributes Block attributes.
	 *
	 * @return string CSS declarations, e.g. --flr-input-radius:8px;--flr-button-bg:#3858e9
	 * @since 2.0.0
	 */
	public static function css_vars( array $attributes ): string {

		$declarations = [];

		foreach ( self::map()['groups'] as $group => $tokens ) {

			$values = is_array( $attributes[ $group ] ?? null ) ? $attributes[ $group ] : [];

			if ( empty( $values ) ) {
				continue;
			}

			foreach ( $tokens as $key => $token ) {

				if ( ! array_key_exists( $key, $values ) ) {
					continue;
				}

				if ( 'border' === ( $token['type'] ?? '' ) ) {

					$declarations = array_merge(
						$declarations,
						self::border_declarations( $values[ $key ], $token )
					);

					continue;

				}

				$value = self::sanitize( $token['type'] ?? 'keyword', $values[ $key ], $token );

				if ( null !== $value ) {
					$declarations[] = $token['var'] . ':' . $value;
				}

			}

		}

		// When the theme owns the button its tokens must not be emitted at all:
		// an unresolvable var() falls back to the initial value rather than to the
		// theme rule, so a half applied set would break the button, not restyle it.
		if ( ! empty( self::options( $attributes )['useThemeButton'] ) ) {

			$declarations = array_filter(
				$declarations,
				static function ( $declaration ) {
					return 0 !== strpos( $declaration, '--flr-button-' );
				}
			);

		}

		if ( empty( $declarations ) ) {
			return '';
		}

		// Mirror what core does to the merged style attribute, so that a value the
		// front end would silently drop is dropped here too and the editor preview
		// never promises something the site cannot render.
		return trim( safecss_filter_attr( implode( ';', $declarations ) ), ';' );

	}

	/**
	 * Expand a BorderControl value into its three custom properties.
	 *
	 * @param mixed $border Border object from the editor.
	 * @param array $token Token definition.
	 *
	 * @return array
	 * @since 2.0.0
	 */
	private static function border_declarations( $border, array $token ): array {

		if ( ! is_array( $border ) ) {
			return [];
		}

		$declarations = [];

		foreach ( [ 'color' => 'color', 'width' => 'length', 'style' => 'keyword' ] as $side => $type ) {

			if ( ! isset( $border[ $side ], $token['vars'][ $side ] ) ) {
				continue;
			}

			$value = self::sanitize(
				$type,
				$border[ $side ],
				'style' === $side ? [ 'allow' => self::BORDER_STYLES ] : []
			);

			if ( null !== $value ) {
				$declarations[] = $token['vars'][ $side ] . ':' . $value;
			}

		}

		return $declarations;

	}

	/**
	 * Validate a single token value.
	 *
	 * Returns null for anything that is not a well formed value of its type, or
	 * that core's own CSS filter would reject. src/shared/style-vars.js applies
	 * the same rules in the editor.
	 *
	 * @param string $type Token type.
	 * @param mixed $value Raw attribute value.
	 * @param array $token Token definition.
	 *
	 * @return string|null
	 * @since 2.0.0
	 */
	private static function sanitize( string $type, $value, array $token ) {

		if ( ! is_scalar( $value ) ) {
			return null;
		}

		$value = trim( (string) $value );

		if ( '' === $value ) {
			return null;
		}

		// A single declaration only: a semicolon would smuggle in a second one.
		// url() is refused outright so that src/shared/style-vars.js can agree
		// with this class without having to model core's protocol checks.
		if ( str_contains( $value, ';' ) || str_contains( strtolower( $value ), 'url(' ) ) {
			return null;
		}

		switch ( $type ) {

			case 'keyword':
				$allow = $token['allow'] ?? [];

				return ( empty( $allow ) || in_array( $value, $allow, true ) ) ? $value : null;

			case 'number':
				return is_numeric( $value ) ? $value : null;

			case 'length':
				return ( preg_match( self::LENGTH_PATTERN, $value ) || self::is_function_expression( $value ) )
					? $value
					: null;

			case 'color':
				return ( preg_match( self::COLOR_PATTERN, $value ) || self::is_function_expression( $value ) )
					? $value
					: null;

			case 'shadow':
				// Shadows are free form; core's CSS filter is the real gate here.
				return self::survives_css_filter( $value ) ? $value : null;

			default:
				return null;

		}

	}

	/**
	 * Whether a value uses only CSS functions core allows.
	 *
	 * @param string $value Token value.
	 *
	 * @return bool
	 * @since 2.0.0
	 */
	private static function is_function_expression( string $value ): bool {

		return str_contains( $value, '(' ) && self::survives_css_filter( $value );

	}

	/**
	 * Whether a value survives core's CSS attribute filter untouched.
	 *
	 * Calling safecss_filter_attr() rather than reimplementing its regexes keeps
	 * this in lockstep with core across versions.
	 *
	 * @param string $value Token value.
	 *
	 * @return bool
	 * @since 2.0.0
	 */
	private static function survives_css_filter( string $value ): bool {

		$declaration = '--flr-probe:' . $value;

		return trim( safecss_filter_attr( $declaration ), ';' ) === $declaration;

	}

	/**
	 * Plugin owned classes for the block wrapper.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $extra Additional classes.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function classes( array $attributes, array $extra = [] ): string {

		$options = self::options( $attributes );
		$classes = array_merge( [ 'flr-blocks-form-wrapper' ], $extra );

		$preset = isset( $attributes['preset'] ) ? sanitize_html_class( (string) $attributes['preset'] ) : '';

		if ( '' !== $preset ) {
			$classes[] = 'flr-preset-' . $preset;
		}

		$label_position = $options['labelPosition'] ?? 'top';

		if ( in_array( $label_position, [ 'inline', 'hidden' ], true ) ) {
			$classes[] = 'flr-labels-' . $label_position;
		}

		if ( ! empty( $options['useThemeButton'] ) ) {
			$classes[] = 'flr-theme-button';
		}

		if ( ! empty( $options['requiredMark'] ) ) {
			$classes[] = 'flr-required-marks';
		}

		return implode( ' ', array_unique( array_filter( $classes ) ) );

	}

	/**
	 * Full opening tag attribute string for the block wrapper, core supports included.
	 *
	 * @param array $attributes Block attributes.
	 * @param array $extra Extra wrapper attributes. A class key may be an array.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function wrapper( array $attributes, array $extra = [] ): string {

		$extra_classes = (array) ( $extra['class'] ?? [] );
		unset( $extra['class'] );

		$arguments = array_merge( $extra, [ 'class' => self::classes( $attributes, $extra_classes ) ] );

		$style = self::css_vars( $attributes );

		if ( '' !== $style ) {
			$arguments['style'] = $style;
		}

		return get_block_wrapper_attributes( $arguments );

	}

	/**
	 * Class list for a submit button.
	 *
	 * The core button classes are added only when the user opted the theme's
	 * button styling back in, because they would otherwise win over our tokens.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $variant Button variant, e.g. login or register.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function button_class( array $attributes, string $variant ): string {

		$classes = [ 'flr-blocks-' . $variant . '-btn', 'flr-blocks-btn' ];

		if ( ! empty( self::options( $attributes )['useThemeButton'] ) ) {
			$classes[] = 'wp-block-button__link';
			$classes[] = 'wp-element-button';
		}

		return implode( ' ', $classes );

	}

	/**
	 * A user supplied text override, falling back to the translated default.
	 *
	 * @param array $attributes Block attributes.
	 * @param string $group Attribute group, e.g. labels or placeholders.
	 * @param string $key Key within the group.
	 * @param string $fallback Translated default.
	 *
	 * @return string
	 * @since 2.0.0
	 */
	public static function text( array $attributes, string $group, string $key, string $fallback ): string {

		$saved = $attributes[ $group ][ $key ] ?? '';

		return ( is_string( $saved ) && '' !== trim( $saved ) ) ? $saved : $fallback;

	}

}
