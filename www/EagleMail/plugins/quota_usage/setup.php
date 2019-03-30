<?php

   /*
    *  quota_usage
    *  By Bill Shupp <hostmaster@shupp.org>
    *  (c) 2001,2002 (GNU GPL - see ../../COPYING)
    *
    */


   function squirrelmail_plugin_init_quota_usage() {
       global $squirrelmail_plugin_hooks;
       $squirrelmail_plugin_hooks["left_main_before"]["quota_usage"] = 
            "display_quota_usage_left";
   }


   function display_quota_usage_left() {

      include_once('functions.php');

      display_quota_usage_left_do();

   }


   function quota_usage_version() {

      return '1.2';
 
   }

?>
