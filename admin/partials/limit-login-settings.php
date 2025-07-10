<?php

/**
 * Limit login settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

<form method="post" action="options.php">

	<?php

	settings_fields( 'flr-blocks-limit-login-settings-group' );

	?>

	<table id="flr-blocks-admin-general-settings" class="form-table">

		<tr>
			<th scope="row">

				<label for="flr_blocks_enable_limit_login">
					<?php echo esc_html_x( "Enable limit login attempts", "enable_limit_login", "frontend-login-and-registration-blocks" ); ?>
				</label>

				<p class="flr-blocks-admin-settings-description">
					<?php echo esc_html_x( "Protect your web site from too many unsuccessful login attempts.", "enable_limit_login_description", "frontend-login-and-registration-blocks" ); ?>
				</p>

			</th>
			<td>

				<select name="flr_blocks_enable_limit_login" id="flr_blocks_enable_limit_login">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "frontend-login-and-registration-blocks" ) ?></option>
					<option value="yes" <?php echo esc_html(get_option( 'flr_blocks_enable_limit_login' )) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "frontend-login-and-registration-blocks" ); ?></option>
					<option value="no" <?php echo esc_html(get_option( 'flr_blocks_enable_limit_login' )) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "frontend-login-and-registration-blocks" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_limit_login_max_attempts">
					<?php echo esc_html_x("Maximum number of attempts", "limit_login_max_attempt", "frontend-login-and-registration-blocks" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flr_blocks_limit_login_max_attempts" id="flr_blocks_limit_login_max_attempts" value="<?php echo esc_attr(get_option( 'flr_blocks_limit_login_max_attempts' )); ?>">

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_limit_login_lockout_duration">
					<?php echo esc_html_x( "Lockout duration (as seconds)", "limit_login_lockout_duration", "frontend-login-and-registration-blocks" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flr_blocks_limit_login_lockout_duration" id="flr_blocks_limit_login_lockout_duration" value="<?php echo esc_attr(get_option( 'flr_blocks_limit_login_lockout_duration' )); ?>">

			</td>
		</tr>

	</table>

	<?php submit_button(); ?>

</form>
