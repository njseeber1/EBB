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

   if (!defined('SM_PATH'))
      define('SM_PATH','../../');

   function squirrelmail_plugin_init_virus_scan() {
      include_once(SM_PATH . 'plugins/virus_scan/includes/hooks.php');
   }

   function virus_scan_block (&$Args) {
      include(SM_PATH . 'plugins/virus_scan/includes/block_function.php');
   }

   function virus_scan_display_option() {
      include_once(SM_PATH . 'plugins/virus_scan/includes/display_options.php');
   }

   function virus_scan_checkforupdate() {
      @include(SM_PATH . 'plugins/virus_scan/config.php');
      include_once(SM_PATH . 'plugins/virus_scan/includes/scan.php');
      CheckforVirusUpdates(1);
   }

   function virus_scan_version() {
      return '0.5';
   }

?>