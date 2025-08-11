<?php
/**
 * This class is responsible for user activation operations.
 *
 * If user activation enabled, this class creates and checks activation code.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/inc
 */

namespace FLR_BLOCKS;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

class Flr_Blocks_User_Activation {

	/**
	 * User Activation block html output
	 *
	 * @param array $block_attributes Get block attributes from block-name/edit.js
	 *
	 * @return string html result of user activation block
	 * @since 1.0.0
	 */
	public function user_activation_block( array $block_attributes ): string {

		$frontend = new Flr_Blocks_Public();

		//Get login form html output from Frontend class
		return $frontend->get_the_form( 'public/partials/user-activation/user-activation.php', $block_attributes );

	}

	/**
	 * Check user activation from database.
	 *
	 * @param int $user_id ID of current user
	 *
	 * @return bool If user activated returns True else False
	 * @since 1.0.0
	 *
	 */
	public function check_is_user_activated( int $user_id ): bool {

		$check_activation = get_user_meta( $user_id, 'flr_blocks_user_activation', true );

		if ( $check_activation === 'not_activated' ) {

			return false;

		}

		return true;

	}

	/**
	 *
	 * Activate user with activation code
	 *
	 * @param string $user_email ID of the user
	 * @param string $code Activation code
	 *
	 * @return array Activation result
	 *
	 * @since 1.0.0
	 *
	 */
	public function activate_user( string $code, string $user_email ): array {
		$user             = get_user_by( 'email', $user_email );
		if(!$user){
			return array(
				'status'  => false,
				'message' => esc_html_x( "User not found. Please check your email address.", "user_not_found", "frontend-login-and-registration-blocks" )
			);
		}

		$activation_code  = get_user_meta( $user->ID, 'flr_blocks_user_activation_code', true );
		$check_activation = $this->check_is_user_activated( $user->ID );

		if ( $activation_code === $code ) {

			if ( $check_activation ) {

				return array(
					'status'  => true,
					'message' => esc_html_x( "This account has already activated.", "user_already_activated", "frontend-login-and-registration-blocks" )
				);

			}

			$update = update_user_meta( $user->ID, 'flr_blocks_user_activation', 'activated' );

			if ( ! $update ) {

				return array(
					'status'  => false,
					'message' => esc_html_x( "Something went wrong. Please try again later.", "general_error_message", "frontend-login-and-registration-blocks" )
				);

			}

			return array(
				'status'  => true,
				'message' => esc_html_x( "Your account has activated successfully. You can sign in.", "your_account_has_activated", "frontend-login-and-registration-blocks" )
			);

		} else {

			return array(
				'status'  => false,
				'message' => esc_html_x( "Wrong activation code. Please contact with your site administrator.", "wrong_activation_code", "frontend-login-and-registration-blocks" )
			);

		}

	}

}
