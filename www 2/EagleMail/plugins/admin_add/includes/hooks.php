<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Admin Add
    Version ........ 0.1
    Purpose ........ Add / Remove Admins

*******************************************************************************/

      global $squirrelmail_plugin_hooks, $plugins;
      if (in_array('admin_options',$plugins))
         $squirrelmail_plugin_hooks['admin_optpage_register_block']['admin_add'] = 'admin_add';
      else
        $squirrelmail_plugin_hooks['optpage_register_block']['admin_add'] = 'admin_add';
?>