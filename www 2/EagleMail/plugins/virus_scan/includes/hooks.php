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

      global $squirrelmail_plugin_hooks, $plugins;
      if (in_array('admin_options',$plugins))
         $squirrelmail_plugin_hooks['admin_optpage_register_block']['virus_scan'] = 'virus_scan_display_option';
      else
         $squirrelmail_plugin_hooks['optpage_register_block']['virus_scan'] = 'virus_scan_display_option';
      $squirrelmail_plugin_hooks['login_verified']['virus_scan'] = 'virus_scan_checkforupdate';
      $squirrelmail_plugin_hooks['attachment application/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment audio/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment chemical/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment image/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment message/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment model/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment multipart/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment text/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment video/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment x-conference/*']['virus_scan'] = 'virus_scan_block';
      $squirrelmail_plugin_hooks['attachment x-world/*']['virus_scan'] = 'virus_scan_block';
?>