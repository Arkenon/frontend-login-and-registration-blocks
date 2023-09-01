<?php

namespace FLWGB;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;


class Mail {

	/**
	 * Html formatted mail body
	 *
	 * Created for wp_mail_content_type filter.
	 *
	 * @since    1.0.0
	 */
	public function mail_html_format() {
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

		$body = Helper::replace_mail_parameters( $option_name, $template, $params );

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
				return _x( 'Hello {{username}}, <br> Welcome to our website.', 'register_mail_to_user_template', 'flwgb' );
				break;

			case "register_mail_to_user_template_with_activation":
				return _x( 'Hello {{username}}. You have been sign up successfully. Please click the membership activation link below: <br/> {{activation_link}}', 'register_mail_to_user_template_with_activation', 'flwgb' );
				break;

			case "register_mail_to_admin_template":
				return _x( 'New member registered to your web site. <br> Username: {{username}} | User E-Mail: {{email}}', 'register_mail_to_admin_template', 'flwgb' );
				break;

			case "reset_password_mail_to_user_template":
				return _x( 'Hello {{username}}, <br> This notice confirms that your password was changed. If you did not change your password, please contact the Site Administrator.', 'reset_password_mail_to_user_template', 'flwgb' );
				break;

			case "reset_password_request_mail_to_user_template":
				return _x( 'Hello {{username}}, <br> You can change your password from the link below <br> {{reset_link}} <br> Thanks for your attention.', 'reset_password_request_mail_to_user_template', 'flwgb' );
				break;

			default:
				return "";

		}

	}
}
