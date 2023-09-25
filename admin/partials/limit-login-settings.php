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

	settings_fields( 'flwgb-limit-login-settings-group' );

	?>

	<table id="flwgb-admin-general-settings" class="form-table">

		<tr>
			<th scope="row">

				<label for="flwgb_enable_limit_login">
					<?php echo esc_html_x( "Enable limit login attempts", "enable_limit_login", "flwgb" ); ?>
				</label>

				<p class="flwgb-admin-settings-description">
					<?php echo esc_html_x( "Protect your web site from too many unsuccessful login attempts.", "enable_limit_login_description", "flwgb" ); ?>
				</p>

			</th>
			<td>

				<select name="flwgb_enable_limit_login" id="flwgb_enable_limit_login">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flwgb" ) ?></option>
					<option value="yes" <?php echo get_option( 'flwgb_enable_limit_login' ) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "flwgb" ); ?></option>
					<option value="no" <?php echo get_option( 'flwgb_enable_limit_login' ) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "flwgb" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flwgb_limit_login_max_attempts">
					<?php echo esc_html_x("Maximum number of attempts", "limit_login_max_attempt", "flwgb" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flwgb_limit_login_max_attempts" id="flwgb_limit_login_max_attempts" value="<?php echo esc_attr(get_option( 'flwgb_limit_login_max_attempts' )); ?>">

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flwgb_limit_login_lockout_duration">
					<?php echo esc_html_x( "Lockout duration (as seconds)", "limit_login_lockout_duration", "flwgb" ); ?>
				</label>

			</th>
			<td>

				<input type="number" name="flwgb_limit_login_lockout_duration" id="flwgb_limit_login_lockout_duration" value="<?php echo esc_attr(get_option( 'flwgb_limit_login_lockout_duration' )); ?>">

			</td>
		</tr>

	</table>

	<?php submit_button(); ?>

</form>
