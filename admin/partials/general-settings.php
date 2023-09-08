<?php

/**
 * General settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_With_Gutenberg_Blocks
 * @subpackage Frontend_Login_With_Gutenberg_Blocks/admin/partials
 */

use FLWGB\Helper;

$pages = get_pages();

?>

<form method="post" action="options.php">

	<?php

	settings_fields( 'flwgb-general-settings-group' );

	?>

	<table id="flwgb-admin-general-settings" class="form-table">

		<tr>
			<th scope="row">

				<label for="flwgb_has_activation">
					<?php echo esc_html_x( "Enable user activation", "has_activation", "flwgb" ); ?>
				</label>

				<p class="flwgb-admin-settings-description">
					<?php echo esc_html_x( "If you want to send an activation code to your users, select 'Yes'.", "has_activation_description", "flwgb" ); ?>
				</p>

			</th>
			<td>

				<select name="flwgb_has_activation" id="flwgb_has_activation">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flwgb" ) ?></option>
					<option value="yes" <?php echo get_option( 'flwgb_has_activation' ) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "flwgb" ); ?></option>
					<option value="no" <?php echo get_option( 'flwgb_has_activation' ) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "flwgb" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flwgb_has_user_dashboard">
					<?php echo esc_html_x( "Enable user settings", "has_user_settings", "flwgb" ); ?>
				</label>

				<p class="flwgb-admin-settings-description">
					<?php echo esc_html_x( "If you want to show a user settings page, select Yes. (Don't forget to select a User Settings page below)", "has_user_settings_description", "flwgb" ); ?>
				</p>

			</th>
			<td>

				<select name="flwgb_has_user_dashboard" id="flwgb_has_user_dashboard">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flwgb" ) ?></option>
					<option value="yes" <?php echo get_option( 'flwgb_has_user_dashboard' ) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "flwgb" ); ?></option>
					<option value="no" <?php echo get_option( 'flwgb_has_user_dashboard' ) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "flwgb" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th scope="row">

				<label for="flwgb_redirect_from_wp_login_admin">
					<?php echo esc_html_x( "Hide wp-login&wp-admin", "hide_wp_login_admin", "flwgb" ); ?>
				</label>

				<p class="flwgb-admin-settings-description">
					<?php echo esc_html_x( "If you choose 'Yes', users who are not logged in will be redirected to the home page.", "hide_wp_login_admin_description", "flwgb" ); ?>
				</p>

			</th>
			<td>

				<select name="flwgb_redirect_from_wp_login_admin" id="flwgb_redirect_from_wp_login_admin">

					<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flwgb" ) ?></option>
					<option value="yes" <?php echo get_option( 'flwgb_redirect_from_wp_login_admin' ) === 'yes' ? "selected" : ""; ?>><?php echo esc_html_x( "Yes", "yes_text", "flwgb" ); ?></option>
					<option value="no" <?php echo get_option( 'flwgb_redirect_from_wp_login_admin' ) === 'no' ? "selected" : ""; ?>><?php echo esc_html_x( "No", "no_text", "flwgb" ); ?></option>

				</select>

			</td>
		</tr>

		<tr>
			<th>
				<hr>
			</th>
			<td>
				<hr>
			</td>
		</tr>
		<?php

		$selections = [
				[
						'option'      => 'flwgb_login_page',
						"title"    => _x( "Login Page", "login_page", "flwgb" ),
						"description"    => _x( "Select a page if created a login page.", "login_page_description", "flwgb" ),
				],
				[
						'option'      => 'flwgb_redirect_after_login',
						"title"    => _x( "Redirection Page After Login", "redirect_page_after_login", "flwgb" ),
						"description"    => _x( "Select a page if you want to redirect users to a specific page after login.", "redirect_page_after_login_description", "flwgb" ),
				],
				[
						'option' => 'flwgb_lost_password_page',
						"title"    => _x( "Lost (Reset) Password Page", "lost_password_page", "flwgb" ),
				],
				[
						'option' => 'flwgb_register_page',
						"title"    => _x( "Registration Page", "registration_page", "flwgb" ),
				],
				[
						'option'      => 'flwgb_activation_page',
						"title"    => _x( "User Activation Page", "activation_page", "flwgb" ),
						"description"    => _x( "Select a page if you selected 'Yes' in the 'Enable user activation' setting", "activation_page_description", "flwgb" ),
				],
				[
						'option'      => 'flwgb_user_settings_page',
						"title"    => _x( "User Settings Page", "user_settings_page", "flwgb" ),
						"description"    => _x( "Select a page if you selected 'Yes' in the 'Enable user settings' setting", "user_settings_page_description", "flwgb" ),
				],
				[
						'option' => 'flwgb_terms_and_conditions_page',
						"title"    => _x( "Terms and Conditions Page", "terms_and_conditions_page", "flwgb" ),
				],
				[
						'option' => 'flwgb_privacy_policy_page',
						"title"    => _x( "Privacy Policy Page", "privacy_policy_page", "flwgb" ),
				]
		];

		foreach ( $selections as $select ):

			?>

			<tr>
				<th scope="row">

					<label for="<?php echo $select['option']; ?>">
						<?php echo esc_html( $select['title'] ); ?>
					</label>

					<p class="flwgb-admin-settings-description">
						<?php echo esc_html( $select['description'] ?? null); ?>
					</p>

				</th>
				<td>

					<select name="<?php echo $select['option']; ?>" id="<?php echo $select['option']; ?>">

						<option value=""><?php echo esc_html_x( "Please select...", "select_text", "flwgb" ) ?></option>

						<?php

						foreach ( $pages as $page ) {

							Helper::get_select_options_from_query( $page, $select['option'] );

						}

						?>

					</select>

				</td>
			</tr>

		<?php endforeach; ?>

	</table>

	<?php submit_button(); ?>

</form>
