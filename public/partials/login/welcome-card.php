<?php

use FLR_BLOCKS\Flr_Blocks_Helper;

// Exit if accessed directly.
defined( 'ABSPATH' ) or die;

global $user_login;


if(is_user_logged_in()):

	$view = Flr_Blocks_Helper::return_view("public/partials/login/already-logged-in.php");

endif;
