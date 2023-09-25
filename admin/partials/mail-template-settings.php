<?php
/**
 * Mail template settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

use FLWGB\Mail;

?>


<form method="post" action="options.php">

	<?php

	settings_fields( 'flwgb-mail-settings-group' );

	$data = [
			[
					"id"       => "flwgb_register_mail_to_user",
					"title"    => _x( "Registration Mail Template for User", "register_mail_to_user", "flwgb" ),
					"tags"     => "{{username}}",
					"template" => Mail::mail_templates( 'register_mail_to_user_template' ),
					"content"  => "flwgb_register_mail_to_user"
			],
			[
					"id"       => "flwgb_register_mail_to_user_with_activation",
					"title"    => _x( "Registration Mail Template for User (With Activation Code)", "register_mail_to_user_with_activation", "flwgb" ),
					"tags"     => "{{username}}, {{activation_link}}",
					"template" => Mail::mail_templates( 'register_mail_to_user_template_with_activation' ),
					"content"  => "flwgb_register_mail_to_user_with_activation"
			],
			[
					"id"       => "flwgb_register_mail_to_admin",
					"title"    => _x( "Registration Mail Template for Admin", "register_mail_to_admin", "flwgb" ),
					"tags"     => "{{username}}, {{email}}",
					"template" => Mail::mail_templates( 'register_mail_to_admin_template' ),
					"content"  => "flwgb_register_mail_to_admin"
			],
			[
					"id"       => "flwgb_reset_request_mail_to_user",
					"title"    => _x( "Password Reset Request Mail Template", "reset_password_request_mail_to_user", "flwgb" ),
					"tags"     => "{{username}}, {{reset_link}}",
					"template" => Mail::mail_templates( 'reset_password_request_mail_to_user_template' ),
					"content"  => "flwgb_reset_request_mail_to_user"
			],
			[
					"id"       => "flwgb_reset_password_mail_to_user",
					"title"    => _x( "Password Change Mail Template for User", "reset_password_mail_to_user", "flwgb" ),
					"tags"     => "{{username}}",
					"template" => Mail::mail_templates( 'reset_password_mail_to_user_template' ),
					"content"  => "flwgb_reset_password_mail_to_user"
			]
	]

	?>

	<table class="form-table">

		<?php foreach ( $data as $item ): ?>

			<tr>
				<th scope="row">

					<label for="<?php echo $item['id'] ?>">
						<?php echo esc_html( $item['title'] ); ?>
					</label>

				</th>
				<td>

					<p><?php echo esc_html_x( "You can use these tags:", "you_can_use_this_tags_text", "flwgb" ); ?>
						<?php echo $item['tags'] ?> </p>

					<?php

					$template  =  $item['template'];
					$content   = get_option( $item['content'] ) ?: $template;
					$editor_id = $item['id'];
					$settings  = array( 'media_buttons' => false, 'wpautop' => false );

					wp_editor( $content, $editor_id, $settings );

					?>

				</td>
			</tr>

		<?php endforeach; ?>


	</table>

	<?php submit_button(); ?>

</form>
