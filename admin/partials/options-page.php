<?php
/**
 * Provide an admin options page view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @since      1.0.0
 * @package    Frontend_Login_And_Registration_Blocks
 * @subpackage Frontend_Login_And_Registration_Blocks/admin/partials
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

use FLR_BLOCKS\Flr_Blocks_Helper;

if ( ! current_user_can( "administrator" ) ) {

	wp_die( __( "You are not authorized to see this page." ) );

}

$default_tab = null;
$tab         = Flr_Blocks_Helper::sanitize( 'tab', 'get', 'text' ) ?? $default_tab;

?>

<!-- Our admin page content should all be inside .wrap -->
<div class="wrap">

	<!-- Print the page title -->
	<h1>
		<?php echo esc_html(get_admin_page_title()); ?>
	</h1>

	<?php settings_errors(); ?>

	<!-- Here are our tabs -->
	<nav class="nav-tab-wrapper">

		<a href="?page=frontend-login-with-gutenberg-blocks-settings"
		   class="nav-tab <?php if ( empty($tab) ): ?>nav-tab-active<?php endif; ?>">
			<?php echo esc_html_x( "General Settings", "admin_general_settings", "flr-blocks" ); ?>
		</a>

		<a href="?page=frontend-login-with-gutenberg-blocks-settings&tab=mail-templates"
		   class="nav-tab <?php if ( $tab === 'mail-templates' ): ?>nav-tab-active<?php endif; ?>">
			<?php echo esc_html_x( "E-Mail Templates", "admin_mail_settings", "flr-blocks" ); ?>
		</a>

		<a href="?page=frontend-login-with-gutenberg-blocks-settings&tab=limit-login"
		   class="nav-tab <?php if ( $tab === 'limit-login' ): ?>nav-tab-active<?php endif; ?>">
			<?php echo esc_html_x( "Limit Login Attempts", "limit_login_settings", "flr-blocks" ); ?>
		</a>

	</nav>

	<div class="tab-content">

		<?php
		switch ( $tab ) :

			case 'mail-templates':
				Flr_Blocks_Helper::print_view( "admin/partials/mail-template-settings.php" );
				break;

			case 'limit-login':
				Flr_Blocks_Helper::print_view( "admin/partials/limit-login-settings.php" );
				break;

			default:
				Flr_Blocks_Helper::print_view( "admin/partials/general-settings.php" );
				break;

		endswitch;
		?>

	</div>

</div>
