<?php
  /**
   ** setup.php
   **
   **  Copyright (c) 1999-2000 The SquirrelMail development team
   **  Licensed under the GNU GPL. For full terms see the file COPYING.
   **
   ** Uses standard plugin format to create a couple of forms to
   ** enable import/export of CSV files to/from the address book.
   **/

   function squirrelmail_plugin_init_abook_import_export() {
      global $squirrelmail_plugin_hooks;
      $squirrelmail_plugin_hooks["addressbook_bottom"]["abook_import_export"] = "abook_import_export";
   }

   function plugin_version() {
      return "0.8";
   }

   function abook_import_export() {
      if (defined('SM_PATH'))
         include_once(SM_PATH . 'plugins/abook_import_export/functions.php');
      else
         include_once('../plugins/abook_import_export/functions.php');

      create_plugin_form();
   }
?>
