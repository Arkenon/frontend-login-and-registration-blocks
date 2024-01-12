<?php
/**
 * E-mail operation methods, hooks and more.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


class Flr_Blocks_Mail {

	public function load_mail_actions(){

		//Load mail html format
		add_filter( 'wp_mail_content_type', [$this,'mail_html_format'] );
	}

	/**
	 * Html formatted mail body
	 *
	 * Created for wp_mail_content_type filter.
	 *
	 * @since    1.0.0
	 */
	public function mail_html_format() : string {
		return "text/html";
	}

	/**
	 *
	 * Mail template for lost password request
	 *
	 * @param string $option_name Email template option name
	 * @param string $template_name Email template name for translation
	 * @param array $params Parameters for email template
	 * @param string $mail_title E-mail subject
	 * @param bool $to_admin Indicates whether the email should be sent to the administrator or user
	 *
	 * @return bool
	 *
	 * @since 1.0.0
	 */
	public function send_mail( string $option_name, string $template_name, array $params, string $mail_title, bool $to_admin = false ): bool {

		$template = self::mail_templates( $template_name );

		$body = $this->replace_mail_parameters( $option_name, $template, $params );

		$headers = array( 'Content-Type: text/html; charset=UTF-8' );

		$send_mail = wp_mail( $to_admin ? $params['admin_email'] : $params['email'], $mail_title, $body, $headers );

		if ( is_wp_error( $send_mail ) ) {

			return false;

		}

		return true;

	}

	/**
	 *
	 * E-mail templates
	 *
	 * @return string
	 * @since 1.0.0
	 */
	public static function mail_templates( $template_name ): string {

		switch ( $template_name ) {

			case "register_mail_to_user_template":
				return _x( 'Hello {{username}}, <br> Welcome to our website.', 'register_mail_to_user_template', 'flr-blocks' );
				break;

			case "register_mail_to_user_template_with_activation":
				return _x( 'Hello {{username}}. You have been signed up successfully. Please click the membership activation link below: <br/> {{activation_link}}', 'register_mail_to_user_template_with_activation', 'flr-blocks' );
				break;

			case "register_mail_to_admin_template":
				return _x( 'New member registered to your web site. <br> Username: {{username}} | User E-Mail: {{email}}', 'register_mail_to_admin_template', 'flr-blocks' );
				break;

			case "reset_password_mail_to_user_template":
				return _x( 'Hello {{username}}, <br> This notice confirms that your password was changed. If you did not change your password, please contact the Site Administrator.', 'reset_password_mail_to_user_template', 'flr-blocks' );
				break;

			case "reset_password_request_mail_to_user_template":
				return _x( 'Hello {{username}}, <br> You can change your password from the link below <br> {{reset_link}} <br> Thanks for your attention.', 'reset_password_request_mail_to_user_template', 'flr-blocks' );
				break;

			default:
				return "";

		}

	}

	/**
	 * Replace texts with dynamic values (for e-mail templates)
	 *
	 * @param string $option_name Mail template option name
	 * @param string $template_name Mail template name for translation
	 * @param array $params Parameters for mail templates (username, mail, etc.)
	 *
	 * @return string $dynamicText Replaced text
	 *
	 * @since 1.0.0
	 */
	public function replace_mail_parameters( string $option_name, string $template, array $params ): string {

		$text = get_option( $option_name ) ?: $template;

		return preg_replace_callback( '/{{(.*?)}}/', function ( $matches ) use ( $params ) {

			$placeholder = $matches[1];

			return $params[ $placeholder ] ?? $matches[0];

		}, $text );

	}
}
