<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Admin Add
    Version ........ 0.1
    Purpose ........ Add / Remove Admins

*******************************************************************************/

   if (!defined('SM_PATH'))
      define('SM_PATH','../../');

   function squirrelmail_plugin_init_admin_add() {
      include(SM_PATH . 'plugins/admin_add/includes/hooks.php');
   }

   function admin_add () {
      include(SM_PATH . 'plugins/admin_add/includes/block.php');
   }

   function admin_add_version() {
      return '0.1';
   }

?>