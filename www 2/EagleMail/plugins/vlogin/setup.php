<?php

/**
  * SquirrelMail Virtual Host Login Plugin
  * Copyright (C) 2003, 2004 Paul Lesneiwski <pdontthink@angrynerds.com>
  * This program is licensed under GPL. See COPYING for details
  *
  */


if (!defined('SM_PATH'))
   define('SM_PATH', '../');


function squirrelmail_plugin_init_vlogin() {

  global $squirrelmail_plugin_hooks;


  $squirrelmail_plugin_hooks['login_before']['vlogin']               = 'vlogin_domain';

  $squirrelmail_plugin_hooks['optpage_loadhook_display']['vlogin']   = 'vlogin_display_options';
  $squirrelmail_plugin_hooks['optpage_loadhook_personal']['vlogin']  = 'vlogin_display_options';
  $squirrelmail_plugin_hooks['optpage_loadhook_folder']['vlogin']    = 'vlogin_display_options';
  $squirrelmail_plugin_hooks['optpage_loadhook_highlight']['vlogin'] = 'vlogin_display_options';
  $squirrelmail_plugin_hooks['optpage_loadhook_order']['vlogin']     = 'vlogin_display_options';


  // yes, this is all necessary, in order to offer 
  // standard functionality to present, but also to
  // offer functionality that will be more like what
  // we'll be moving toward... after the move is
  // complete, we won't need to have any dynamic
  // code here:
  //
  include_once(SM_PATH . 'plugins/vlogin/data/config.php');


  global $useSessionBased;
  if ($useSessionBased)
  {

     $squirrelmail_plugin_hooks['login_cookie']['vlogin'] = 'vlogin_overrideSmConfig';

     // unfortunately, we can only set org_title in the title 
     // bar of the browser if we use this hook - otherwise, it's 
     // unecessary
     //
     $squirrelmail_plugin_hooks['webmail_top']['vlogin'] = 'vlogin_overrideSmConfig';

  }
  else
  {

     include_once(SM_PATH . 'plugins/vlogin/functions.php');
     overrideSmConfig();

  }


}


function vlogin_domain() 
{

   include_once(SM_PATH . 'plugins/vlogin/functions.php');
   vlogin_domain_do();

}


function vlogin_display_options() 
{

   include_once(SM_PATH . 'plugins/vlogin/functions.php');
   vlogin_display_options_do();

}


function vlogin_overrideSmConfig() 
{

   include_once(SM_PATH . 'plugins/vlogin/functions.php');
   overrideSmConfig();

}


function vlogin_version() 
{

   return '3.4.1';

}

?>
