<?php
/**
 * Mail template settings tab content for admin options page
 *
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

use FLR_BLOCKS\Flr_Blocks_Mail;

?>


<form method="post" action="options.php">

	<?php

	settings_fields( 'flr-blocks-mail-settings-group' );

	$data = [
			[
					"id"       => "flr_blocks_register_mail_to_user",
					"title"    => _x( "Registration Mail Template for User", "register_mail_to_user", "flr-blocks" ),
					"tags"     => "{{username}}",
					"template" => Flr_Blocks_Mail::mail_templates( 'register_mail_to_user_template' ),
					"content"  => "flr_blocks_register_mail_to_user"
			],
			[
					"id"       => "flr_blocks_register_mail_to_user_with_activation",
					"title"    => _x( "Registration Mail Template for User (With Activation Code)", "register_mail_to_user_with_activation", "flr-blocks" ),
					"tags"     => "{{username}}, {{activation_link}}",
					"template" => Flr_Blocks_Mail::mail_templates( 'register_mail_to_user_template_with_activation' ),
					"content"  => "flr_blocks_register_mail_to_user_with_activation"
			],
			[
					"id"       => "flr_blocks_register_mail_to_admin",
					"title"    => _x( "Registration Mail Template for Admin", "register_mail_to_admin", "flr-blocks" ),
					"tags"     => "{{username}}, {{email}}",
					"template" => Flr_Blocks_Mail::mail_templates( 'register_mail_to_admin_template' ),
					"content"  => "flr_blocks_register_mail_to_admin"
			],
			[
					"id"       => "flr_blocks_reset_request_mail_to_user",
					"title"    => _x( "Password Reset Request Mail Template", "reset_password_request_mail_to_user", "flr-blocks" ),
					"tags"     => "{{username}}, {{reset_link}}",
					"template" => Flr_Blocks_Mail::mail_templates( 'reset_password_request_mail_to_user_template' ),
					"content"  => "flr_blocks_reset_request_mail_to_user"
			],
			[
					"id"       => "flr_blocks_reset_password_mail_to_user",
					"title"    => _x( "Password Change Mail Template for User", "reset_password_mail_to_user", "flr-blocks" ),
					"tags"     => "{{username}}",
					"template" => Flr_Blocks_Mail::mail_templates( 'reset_password_mail_to_user_template' ),
					"content"  => "flr_blocks_reset_password_mail_to_user"
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

					<p><?php echo esc_html_x( "You can use these tags:", "you_can_use_this_tags_text", "flr-blocks" ); ?>
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
