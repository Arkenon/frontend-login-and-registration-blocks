=== Login, Registration and Lost Password Blocks ===
Contributors:      arkenon, Verdure Wordpress
Tags:              login block, lost password block, login form, custom login, wp login
Requires at least: 6.1
Tested up to:      6.8
Requires PHP:      7.4
Stable tag:        1.2.0
License:           GPL-2.0-or-later
License URI:       https://www.gnu.org/licenses/gpl-2.0.html

Login, Registration and Lost Password Blocks plugin provides blocks helps you to add login, register, lost password forms from front end.

== Description ==

Login, Registration and Lost Password Blocks plugin provides blocks helps you to add login, register, lost password forms from front end.

Additionally, you can create user settings page, add limit login attempts and user activation functionality and more to your website...


== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/frontend-login-and-registration-blocks` directory, or install the plugin through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress


=== Why Choose Frontend Login and Registration Forms ===

**1. Easy to Use**
You can add login, register, lost password or user settings with just a one click. They are all blocks!

**2. Customization**
Each block has color, font and size option in the right sidebar of block editor. You can easily customize your forms.

☑ Login Form Block
☑ Register Form Block
☑ Lost Password Form Block
☑ User Settings Form Block
☑ User Activation Form Block
☑ Welcome Card Block
☑ Menu Item Block (Login/Logout)
☑ Limit Login Attempts
☑ Limit Reset Request Attempts
☑ E-Mail Settings
☑ Strength Password
☑ Username Validation
☑ Customizable Form Fields
☑ Customizable Colors

== Note: Please read the guide before using the plugin. ==
☑ [Documentation](https://guide-frontendlogin.iyziweb.site/)
☑ [Official Web Site](https://frontendlogin.iyziweb.site/)


== Compatibility ==

* Block Editor
* Site Editor


== Changelog ==

= 1.2.0 =
* Fixed security issues reported from Plugin Check plugin
* Enhanced security for Register Form Block
* Enhanced security for Lost Password Form Block
* Enhanced security for User Settings Form Block
* Enhanced security for User Activation Form Block
* Enhanced security for Login Form Block
* Added new settings to Admin Settings Page
* Added Password Strength Meter
* Added Username Validation
* Revised code for better performance
* class-flr-blocks-i18n.php removed  (load_plugin_textdomain() has been discouraged error)
* Thanks to [Verdure Wordpress](https://github.com/vegetable-bits) for the contribution

= 1.1.1 =
* Add xhrFields ( withCredentials: true) to ajax requests

= 1.1.0 =
* Translation files updated
* Script translation support added

= 1.0.9 =
* Fixed security issues reported from Plugin Check plugin
* Checked compatibility with WordPress 6.8
* Plugin name changed to "Login, Registration and Lost Password Blocks" from "Frontend Login and Registration Blocks"

= 1.0.8 =
* Fixed Lost Password form security issue. (Resting password with userid was causing security issue)

= 1.0.7 =
* Register form security check added
* Register form code improvements
* Php mailer functionality checking added into send_mail() function
* A warning message added to the mail options for SMTP settings
* Enable E-Mail option added
* Tested up to Wp Version 6.6
* Translation files updated

= 1.0.6 =
* Additional fields added to Register Form Block

= 1.0.5 =
* Register Form & User Settings Form hooks created
* 'nav-tab-active' class added to active tab in General Settings Form

= 1.0.4 =
* Tested up to WordPress 6.5

= 1.0.3 =
* Textdomain values fixed in all blocks
* Register Form Block: Padding added to right sidebar settings panel

= 1.0.2 =
* Color presets added into ColorPicker and BorderControl components
* Php warnings fixed at php files located Public/partial folder

= 1.0.1 =
* Readme.txt updated
* Code revisions
* Fixed "function exists" function in frontend-login-and-registration-blocks.php

= 1.0.0 =
* Release
