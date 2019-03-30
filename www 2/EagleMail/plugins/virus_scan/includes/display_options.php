<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Virus Scan
    Version ........ 0.5
    Purpose ........ Allows an admin to scan any types of attachments for known
                     Mass Mailing Viruses

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
   bindtextdomain('virus_scan', SM_PATH . 'plugins/virus_scan/locale');
   textdomain('virus_scan');
   $optpage_blocks[] = array (
        'name' => _("Virus Scan"),
        'url'  => SM_PATH . 'plugins/virus_scan/options.php',
        'desc' => _("These settings allow you to scan attachments for known mass emailing viruses, and block them."),
        'js'   => false
   );
   textdomain('squirrelmail');
?>