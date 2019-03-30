<?php

/*
   WOT: Image Buttons plugin (GPL v2)
   WEN: Mon Sep  1 21:58:59 MDT 2003
   WHY: To display image links rather than text links on the top menu bar
   WHO: Brad Donison <bucovina@users.sourceforge.net>
*/

if (defined('SM_PATH'))
    include_once(SM_PATH . 'plugins/image_buttons/config.php');
else
    include_once('../plugins/image_buttons/config.php');

function squirrelmail_plugin_init_image_buttons() {
    global $squirrelmail_plugin_hooks;

    $squirrelmail_plugin_hooks['internal_link']['image_buttons'] = 'image_buttons_register_block';
    if ($GLOBALS['image_buttons_select'] == 1) {
        $squirrelmail_plugin_hooks['options_display_inside']['image_buttons'] = 'image_buttons_display_inside';
        $squirrelmail_plugin_hooks['options_display_save']['image_buttons']   = 'image_buttons_display_save';
        $squirrelmail_plugin_hooks['options_loading_prefs']['image_buttons']  = 'image_buttons_loading_prefs';
    }
}

function image_buttons_register_block($args) {

    if (defined('SM_PATH'))
        include_once(SM_PATH . 'plugins/image_buttons/functions.php');
    else
        include_once('../plugins/image_buttons/functions.php');
    return image_buttons_do($args);
}

function image_buttons_display_inside() {

    if (defined('SM_PATH'))
        include_once(SM_PATH . 'plugins/image_buttons/functions.php');
    else
        include_once('../plugins/image_buttons/functions.php');
    image_buttons_display();
}

function image_buttons_display_save() {

    if (defined('SM_PATH'))
        include_once(SM_PATH . 'plugins/image_buttons/functions.php');
    else
        include_once('../plugins/image_buttons/functions.php');
    image_buttons_save();
}

function image_buttons_loading_prefs() {

    if (defined('SM_PATH'))
        include_once(SM_PATH . 'plugins/image_buttons/functions.php');
    else
        include_once('../plugins/image_buttons/functions.php');
    image_buttons_prefs();
}

function image_buttons_version() {
    return '1.3';
}
?>
