<?php
   /*
    *  Username display
    *
    */

   function squirrelmail_plugin_init_username() {
      global $squirrelmail_plugin_hooks;

      $squirrelmail_plugin_hooks['left_main_before']['username'] = 
         'username_show_LMB';
      $squirrelmail_plugin_hooks['left_main_after']['username'] =
         'username_show_LMA';
      $squirrelmail_plugin_hooks['options_display_inside']['username'] = 
         'username_show_options';
      $squirrelmail_plugin_hooks['options_display_save']['username'] = 
         'username_save_options';
      $squirrelmail_plugin_hooks['loading_prefs']['username'] = 
         'username_load_options';
      $squirrelmail_plugin_hooks['right_main_after_header']['username'] = 
         'username_show_motd';
   }
   
   function username_version() {

      return '2.3';

   }

   function username_show_LMB() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_show_LMB_do();

   }

   function username_show_LMA() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_show_LMA_do();

   }

   function username_show_motd() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_show_motd_do();

   }

   function username_show_options() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_show_options_do();

   }

   function username_save_options() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_save_options_do();

   }

   function username_load_options() {

      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/username/functions.php');
      else
         include_once('../plugins/username/functions.php');

      username_load_options_do();

   }


?>
