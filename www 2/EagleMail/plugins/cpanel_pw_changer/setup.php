<?php
/****************************************************************************
*   CPanel Password Changer - A Plugin for SqurrelMail
*   Copyright (c) 2003 GNU GPL
*
*   Author: Henri Straforelli <henri@etwebhosting.com>
*
****************************************************************************/

// Required for installation of hook into SM
function squirrelmail_plugin_init_cpanel_pw_changer() {

   global $squirrelmail_plugin_hooks;
   $squirrelmail_plugin_hooks['optpage_register_block']['cpanel_pw_changer'] = 'cpanel_pw_changer_plugin_optpage_register_block';
}


function cpanel_pw_changer_version() {
   return '1.2';
}


function cpanel_pw_changer_plugin_optpage_register_block() {

	global $language_file, $optpage_blocks, $optionTitle, $optionDescription;

	// include compatibility plugin
	//
	if (defined('SM_PATH')) 
	   include_once(SM_PATH . 'plugins/compatibility/functions.php');
	else if (file_exists('../plugins/compatibility/functions.php'))
	   include_once('../plugins/compatibility/functions.php');
	else if (file_exists('./plugins/compatibility/functions.php'))
	   include_once('./plugins/compatibility/functions.php');

	if (compatibility_check_sm_version(1, 3)) {
		include_once (SM_PATH . 'plugins/cpanel_pw_changer/config.php');
		include_once (SM_PATH . 'plugins/cpanel_pw_changer/languages/' . $language_file);
	}
	else {
		include_once ('../plugins/cpanel_pw_changer/config.php');
		include_once ('../plugins/cpanel_pw_changer/languages/' . $language_file);
	}

	$optpage_blocks[] = array(
		'name' => _("$optionTitle"),
		'url'  => '../plugins/cpanel_pw_changer/cpanel_pw_changer.php',
		'desc' => _("$optionDescription"),
		'js'   => false);
}

?>