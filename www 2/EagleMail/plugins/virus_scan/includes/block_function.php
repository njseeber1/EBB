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

      global $username, $message, $imapConnection,$virusscanupdate;
      $filename = SM_PATH . 'plugins/virus_scan/config.php';
      if (file_exists($filename))
         include($filename);
      else
         return;
      $dot = strrpos($Args[7], "."); 
      $ext = strtolower(substr($Args[7],$dot+1));
      $s = "abcdefghijklmnopqrstuvwxyz1234567890_";
      for ($a = 0; $a < strlen($ext); $a++) {
         $pos = strpos($s, substr($ext,$a,1));
         if ($pos === false) {
            $ext = str_replace(substr($ext,$a,1),'',$ext);
            $a--;
         }
      }
      $blockme = false;
      if ($virusscan == 1 && (in_array($ext,$scanext))) {
         include_once(SM_PATH . "plugins/virus_scan/includes/scan.php");
         $message2 = $message->getEntity($Args[5]);
         $header = $message2->rfc822_header;
         $body = mime_fetch_body ($imapConnection, $Args[3], $Args[5]);
         $body = decodeBody($body, $message2->header->encoding);
         $v = VirusScan($body);
         $virus = $v[0];
         $url = $v[1];
         if ($virus != '') {
            $blockme = true;
            if (in_array(strtolower($username),$excluded)) {
               bindtextdomain('virus_scan', SM_PATH . 'plugins/virus_scan/locale');
               textdomain('virus_scan');
               $Args[1]['download link']['text'] = _("Download (Virus)") . "<br>$virus";;
               textdomain('squirrelmail');
            } else {
               bindtextdomain('virus_scan', SM_PATH . 'plugins/virus_scan/locale');
               textdomain('virus_scan');
               $Args[1]['download link']['text'] = _("Blocked (Virus)") . "<br>$virus";;
               $Args[6] = SM_PATH . "plugins/virus_scan/virus.php?virus=$virus&url=$url";
               $Args[1]['download link']['href'] = SM_PATH . "plugins/virus_scan/virus.php?virus=$virus&url=$url";
               textdomain('squirrelmail');
            }
         }
      }
?>