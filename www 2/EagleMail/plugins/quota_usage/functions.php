<?php

   /*
    *  quota_usage
    *  By Bill Shupp <hostmaster@shupp.org>
    *  (c) 2001,2002 (GNU GPL - see ../../COPYING)
    *
    */


   function display_quota_usage_left_do() {
      global $username, $key, $imapServerAddress, $imapPort, $imap,
         $imap_general, $filters, $imap_stream, $imapConnection, 
         $UseSeparateImapConnection;

      // Detect if we have already connected to IMAP or not.
      // Also check if we are forced to use a separate IMAP connection
      if ((!isset($imap_stream) && !isset($imapConnection)) ||
          $UseSeparateImapConnection) {
         $stream = sqimap_login($username, $key, $imapServerAddress, 
            $imapPort, 10);
         $previously_connected = false;
      } elseif (isset($imapConnection)) {
         $stream = $imapConnection;
         $previously_connected = true;
      } else {
         $previously_connected = true;
         $stream = $imap_stream;
      }



     global $fontsize, $warn_percent, $yellow_alert_percent, $intro_text;
     include_once('config.php');


      $usage = sqimap_get_quota($stream, "INBOX");
      if(!ereg("NOQUOTA", $usage)) {
         $usagearray = explode(":", $usage);
         $taken = $usagearray[0];
         $total = $usagearray[1];
         $percent = number_format(($taken/$total) * 100, 1);
         $quota = number_format((($total *1024) - 1023) / 1000000, 1);

         if($percent >= $warn_percent) {
            $percentcolor = "#FF0000";
         } else if (!empty($yellow_alert_percent) && $yellow_alert_percent > 0 
                 && $percent >= $yellow_alert_percent) {
            $percentcolor = "#FFE349";
            //$percentcolor = "yellow";
         } else {
            $percentcolor = "green";
         }
         echo "<center><font size=$fontsize>" 
            . (!empty($intro_text) ? _($intro_text) . "<br>" : '')
            . "\n";
         echo "<table border=0 cellpadding=0 cellspacing=0 width=90%>\n";
         echo " <tr>\n";
         echo "     <td align=middle><font size=$fontsize><b>"
            .$percent."% " . _("of") . " ".$quota."M</b></font>\n";
         echo "     </td>\n";
         echo " </tr>\n";
         echo " <tr bgcolor=#cccccc>\n";
         echo "     <td align=left>\n";
         echo "         <table border=0 cellpadding=0 width="
            .(($percent>=100)?"100":$percent)."%>\n";
         echo "             <tr bgcolor=#cccccc>\n";
         echo "             <td bgcolor=$percentcolor><font size=$fontsize>"
            .(($percent>=100)?"<center><b>" . _("Over Quota!") . "</center></b>":"&nbsp")
            ."</font></td>\n";
         echo "             </tr>\n";
         echo "         </table>\n";
         echo "     </td>\n";
         echo " </tr>\n";
         echo "</table>\n";
         echo "</font></center><p>\n";
      }
      
      if (!$previously_connected)
         sqimap_logout($stream);

   }

     ///////////////////////////////////////////////
     // Gets current quota usage                  //
     ///////////////////////////////////////////////

   function sqimap_get_quota ($imap_stream, $mailbox) {
      if (check_quota_capability($imap_stream, "QUOTA")) {
        fputs ($imap_stream, "a001 GETQUOTAROOT \"$mailbox\"\r\n");
        $read_ary = sqimap_read_data ($imap_stream, 'a001', true, $result,
            $message);

        if (check_sm_version(1, 5, 0))
            $read_ary = $read_ary['a001'];

        foreach ($read_ary as $response)
        {
            if (is_array($response))
                foreach ($response as $resp)
                {
                   if (strpos($resp, 'STORAGE') !== FALSE)
                   {
                       $tempusage = ereg_replace("^.*[(]STORAGE +(.*)[)].*$", "\\1", $resp);
                       $usagearray = explode(" ", $tempusage);
                       return $usagearray[0].":".$usagearray[1];
                   }
                }
            else
                if (strpos($response, 'STORAGE') !== FALSE)
                {
                    $tempusage = ereg_replace("^.*[(]STORAGE +(.*)[)].*$", "\\1", $response);
                    $usagearray = explode(" ", $tempusage);
                    return $usagearray[0].":".$usagearray[1];
                }
        }

      }
      return "NOQUOTA";
   }


   function check_quota_capability($imap_stream, $capability) {
        global $imap_general_debug;

        fputs ($imap_stream, "a001 CAPABILITY\r\n");
        $read_ary = sqimap_read_data($imap_stream, 'a001', true, $a, $b);

        if (check_sm_version(1, 5, 0))
            $read_ary = $read_ary['a001'];

        foreach ($read_ary as $response)
        {
            if (is_array($response))
                foreach ($response as $resp)
                {
                   if (strpos($resp, 'QUOTA') !== FALSE)
                       return TRUE;
                }
            else
                if (strpos($response, 'QUOTA') !== FALSE)
                    return TRUE;
        }
        return false;

    }

?>
