<?php

function squirrelmail_plugin_init_autocomplete()
{
   global $squirrelmail_plugin_hooks;

   $squirrelmail_plugin_hooks['compose_bottom']['autocomplete']    
      = 'plugin_autocomplete_compose_bottom';
   $squirrelmail_plugin_hooks['options_display_inside']['autocomplete'] 
      = 'plugin_autocomplete_display_inside';
   $squirrelmail_plugin_hooks['options_display_save']['autocomplete'] 
      = 'plugin_autocomplete_display_save';
   $squirrelmail_plugin_hooks['loading_prefs']['autocomplete'] 
      = 'plugin_autocomplete_loading_prefs';
}   
   

function plugin_autocomplete_compose_bottom()
{

   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/autocomplete/functions.php');
   else
      include_once('../plugins/autocomplete/functions.php');

   plugin_autocomplete_compose_bottom_do();

}

function plugin_autocomplete_display_inside()
{

   if (defined('SM_PATH')) 
      include_once(SM_PATH . 'plugins/autocomplete/functions.php');
   else
      include_once('../plugins/autocomplete/functions.php');

   plugin_autocomplete_display_inside_do();

}

function plugin_autocomplete_display_save()
{

   if (defined('SM_PATH')) 
      include_once(SM_PATH . 'plugins/autocomplete/functions.php');
   else
      include_once('../plugins/autocomplete/functions.php');

   plugin_autocomplete_display_save_do();

}


function plugin_autocomplete_loading_prefs()
{

   if (defined('SM_PATH')) 
      include_once(SM_PATH . 'plugins/autocomplete/functions.php');
   else
      include_once('../plugins/autocomplete/functions.php');

   plugin_autocomplete_loading_prefs_do();

}


?>
