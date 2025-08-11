<?php

/**
 * Limit login settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

use FLR_BLOCKS\Flr_Blocks_Helper;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

?>

<form method="post" action="options.php">

	<?php

	settings_fields( 'flr-blocks-advanced-settings-group' );

	?>

	<table id="flr-blocks-admin-general-settings" class="form-table">

		<tr>
			<th scope="row">

				<label for="flr_blocks_enable_password_strength">
					<?php echo esc_html_x( "Enable password strength", "enable_password_strength", "frontend-login-and-registration-blocks" ); ?>
				</label>

				<p class="flr-blocks-admin-settings-description">
					<?php echo esc_html_x( "Force users to type a strong password during registration and lost password requests.", "enable_password_strength_description", "frontend-login-and-registration-blocks" ); ?>
				</p>

			</th>
			<td>

				<?php Flr_Blocks_Helper::render_toggle_input( 'flr_blocks_enable_password_strength' ) ?>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_enable_username_validation">
					<?php echo esc_html_x( "Enable username validation", "enable_username_validation", "frontend-login-and-registration-blocks" ); ?>
				</label>

				<p class="flr-blocks-admin-settings-description">
					<?php echo esc_html_x( "Validate usernames with security checks.", "enable_username_validation_description", "frontend-login-and-registration-blocks" ); ?>
				</p>

			</th>
			<td>

				<?php Flr_Blocks_Helper::render_toggle_input( 'flr_blocks_enable_username_validation' ) ?>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_enable_limit_reset_request_attempts">
					<?php echo esc_html_x( "Enable limit reset request form attempts", "enable_limit_reset_request", "frontend-login-and-registration-blocks" ); ?>
				</label>

				<p class="flr-blocks-admin-settings-description">
					<?php echo esc_html_x( "Limit requests for reset password form. (Only 3 requests in 1 hour)", "enable_limit_reset_request_description", "frontend-login-and-registration-blocks" ); ?>
				</p>

			</th>
			<td>

				<?php Flr_Blocks_Helper::render_toggle_input( 'flr_blocks_enable_limit_reset_request_attempts' ) ?>

			</td>
		</tr>

	</table>

	<?php submit_button(); ?>

</form>
