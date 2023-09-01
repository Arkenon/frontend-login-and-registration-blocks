<?php

use FLWGB\Helper;

global $user_login;

if(is_user_logged_in()):

	$view = Helper::return_view("public/partials/login/already-logged-in.php");

endif;
