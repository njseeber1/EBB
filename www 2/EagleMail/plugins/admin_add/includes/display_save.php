<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Admin Add
    Version ........ 0.1
    Purpose ........ Add / Remove Admins

*******************************************************************************/

      global $admins, $amen, $_POST, $newa;
      if (isset($_POST['newa'])) {
         $newa = strip_tags(trim($_POST['newa']));
         if (strlen($newa) > 0 && !in_array($newa,$admins)) {
            $admins[] = $newa;
            WriteAdmins($admins);
            Header("Location: " . SM_PATH . "plugins/admin_add/options.php");
         }
      }
      if (isset($_POST['amens'])) {

         $amens = strip_tags(trim($_POST['amens']));
         for ($a = 0; $a < count($admins); $a++) {
            if (trim($admins[$a]) == trim($amens))
               unset($admins[$a]);
         }
         WriteAdmins($admins);
         Header("Location: " . SM_PATH . "plugins/admin_add/options.php");
      }


   function WriteAdmins($admins) {
      sort($admins);
      reset($admins);
      $file = fopen(SM_PATH . 'config/admins', w);
      for ($a = 0; $a < count($admins); $a++){
         if (strlen(trim($admins[$a])) > 0)
            fputs($file,trim($admins[$a]) . "\r\n");
      }
      fputs($file,"\r\n");
      fclose($file);
   }
?>