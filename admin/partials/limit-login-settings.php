<?php

/**
 * Limit login settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

?>

<form method="post" action="options.php">

	<?php

	settings_fields( 'flr-blocks-limit-login-settings-group' );

	?>

	<table id="flr-blocks-admin-general-settings" class="form-table">

		<tr>
			<th scope="row">

				<label for="flr_blocks_enable_limit_login">
					<?php echo esc_html_x( "Enable limit login attempts", "enable_limit_login", "flr-blocks" ); ?>
				</label>

				<p class="flr-blocks-admin-settings-description">
					<?php echo esc_html_x( "Protect your web site from too many unsuccessful login attempts.", "enable_limit_login_description", "flr-blocks" ); ?>
				</p>

			</th>
			<td>

				<select name="flr_blocks_enable_limit_login" id="flr_blocks_enable_limit_login">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flr-blocks" ) ?></option>
					<option value="yes" <?php echo get_option( 'flr_blocks_enable_limit_login' ) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "flr-blocks" ); ?></option>
					<option value="no" <?php echo get_option( 'flr_blocks_enable_limit_login' ) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "flr-blocks" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_limit_login_max_attempts">
					<?php echo esc_html_x("Maximum number of attempts", "limit_login_max_attempt", "flr-blocks" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flr_blocks_limit_login_max_attempts" id="flr_blocks_limit_login_max_attempts" value="<?php echo esc_attr(get_option( 'flr_blocks_limit_login_max_attempts' )); ?>">

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flr_blocks_limit_login_lockout_duration">
					<?php echo esc_html_x( "Lockout duration (as seconds)", "limit_login_lockout_duration", "flr-blocks" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flr_blocks_limit_login_lockout_duration" id="flr_blocks_limit_login_lockout_duration" value="<?php echo esc_attr(get_option( 'flr_blocks_limit_login_lockout_duration' )); ?>">

			</td>
		</tr>

	</table>

	<?php submit_button(); ?>

</form>
