<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Admin Add
    Version ........ 0.1
    Purpose ........ Add / Remove Admins

*******************************************************************************/

      global $optpage_blocks, $username;

      $admins = array();
      if (!@file_exists(SM_PATH . 'config/admins')) return;
      $file = @fopen(SM_PATH . 'config/admins',r);
      while (!@feof($file)){
         $x = trim(@fgets($file,100));
         if (strlen($x)>0)
            $admins[]= $x;
      }
      @fclose($file);

      $auth = in_array($username, $admins);
      if (!$auth) return;
      $optpage_blocks[] = array(
            'name' => _("Admin Add / Remove"),
            'url'  => SM_PATH . 'plugins/admin_add/options.php',
            'desc' => _("Add or Remove Admins from your Webmail Installation!"),
            'js'   => false);
?>