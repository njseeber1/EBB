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

      global  $filename, $_POST;
      if (isset($_POST['exu'])) {
         $exu = strtolower(strip_tags($_POST['exu']));
         if (strlen($exu) > 0 && !in_array($exu,$excluded)) {
            $excluded[] = $exu;
            CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror,$filename);
            Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
            exit();
         }
      }

      if (isset($_POST['newb'])) {
         $newb = strtolower(strip_tags($_POST['newb']));
         $s = "abcdefghijklmnopqrstuvwxyz1234567890_";
         for ($a = 0; $a < strlen($newb); $a++) {
            $pos = strpos($s, substr($newb,$a,1));
            if ($pos === false) {
               $newb = str_replace(substr($newb,$a,1),'',$newb);
               $a--;
            }
         }
         if (strlen($newb) > 0 && !in_array($newb,$scanext)) {
            $scanext[] = $newb;
            CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror,$filename);
         }
         Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
         exit();
      }

      if (isset($_POST['wtypes'])) {
         $wtypes = strip_tags($_POST['wtypes']);
         for ($a = 0; $a < count($scanext); $a++) {
            if ($scanext[$a] == $wtypes)
               unset($scanext[$a]);
         }
         CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror,$filename);
         Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
         exit();
      }

      if (isset($_POST['exclude'])) {
         $exclude = strip_tags($_POST['exclude']);
         for ($a = 0; $a < count($excluded); $a++) {
            if ($excluded[$a] == $exclude)
               unset($excluded[$a]);
         }
         CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror,$filename);
         Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
         exit();
      }

      $vsupdate = false;
      if (isset($_POST['vscan'])) {
         $virusscan = strip_tags($_POST['vscan']);
         $vsupdate = true;
      }

      if (isset($_POST['vscanupdate'])) {
         $virusscanupdate = strip_tags($_POST['vscanupdate']);
         $vsupdate = true;
      }

      if (isset($_POST['vscanhourcheck'])) {
         $virushourcheck = strip_tags($_POST['vscanhourcheck']);
         $vsupdate = true;
      }

      if (isset($_POST['vscanmirror'])) {
         $virusmirror = strip_tags($_POST['vscanmirror']);
         $vsupdate = true;
      }
      if ($vsupdate == true) {
         CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror,$filename);
         Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
         exit();
      }


?>