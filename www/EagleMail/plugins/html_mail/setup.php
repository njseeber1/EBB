<?php

function squirrelmail_plugin_init_html_mail() 
{

   global $squirrelmail_plugin_hooks;

   $squirrelmail_plugin_hooks['generic_header']['html_mail']           = 'html_mail_header';
   $squirrelmail_plugin_hooks['compose_bottom']['html_mail']           = 'html_mail_compose_bottom';
   $squirrelmail_plugin_hooks['compose_send']['html_mail']             = 'html_mail_alter_type';
   $squirrelmail_plugin_hooks['compose_before_textarea']['html_mail']  = 'html_mail_emoticons';
   $squirrelmail_plugin_hooks['compose_form']['html_mail']             = 'html_mail_disable_squirrelspell';

   $squirrelmail_plugin_hooks['options_display_inside']['html_mail']   = 'html_mail_display_inside';
   $squirrelmail_plugin_hooks['options_display_save']['html_mail']     = 'html_mail_display_save';
   $squirrelmail_plugin_hooks['options_loading_prefs']['html_mail']    = 'html_mail_loading_prefs';

}


function html_mail_version()
{
   return '2.0';
}


function html_mail_alter_type(&$argv) 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   return html_mail_alter_type_do($argv);

}


function html_mail_emoticons() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_emoticons_do();

}


function html_mail_disable_squirrelspell() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_disable_squirrelspell_do();

}


function html_mail_compose_bottom() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_footer();

}


function html_mail_header() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_header_do();

}


function html_mail_display_inside() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_display();

}


function html_mail_display_save() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_save();

}


function html_mail_loading_prefs() 
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/html_mail/functions.php');
   else
      include_once('../plugins/html_mail/functions.php');

   html_mail_prefs_load();

}


?>
