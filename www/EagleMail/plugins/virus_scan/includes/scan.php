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

$fname = SM_PATH . 'plugins/virus_scan/includes/virussignatures.php';
if (@file_exists($fname) && !@is_writable($fname)) {
   displayPageHeader($color, 'None');
   print "<center>ERROR : $fname must be writable by the webserver!</center>";
   exit();
}

$fname = SM_PATH . 'plugins/virus_scan/attachments.php';
$fname2 = SM_PATH . 'plugins/virus_scan/config.php';
if (@file_exists($fname) && !@file_exists($fname2)) {
   if (!@rename($fname, $fname2)) {
      displayPageHeader($color, 'None');
      print "<center>ERROR : Renaming $fname to $fname2!</center>";
      exit();
   }
}
global $hours, $mirrors;
$hours = array(4,6,8,12,24,48);
$mirrors = array('advcs.org','sqmail.org');

if (@file_exists(SM_PATH . 'plugins/virus_scan/config.php'))
   include(SM_PATH . 'plugins/virus_scan/config.php');

function VirusOpen () {
   global $virusstrings, $virusscanupdate, $maxsigsize;
   if (@file_exists(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php')) {
      include(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
   } else {
      $virusstrings = Array (
         'version' => '0.01',
         'date' => '01/01/2002 00:00:00',
         0 => Array (
            'name' => 'W32.Sobig.F',
            's' => '3cdf78d10cf4ca79c503a8ca1c8fb0df57868abae75470ca27f24e3bc701bcc775ab8b2389147d5205593a629610da5a62',
            'url' => 'http://securityresponse.symantec.com/avcenter/venc/data/w32.sobig.f@mm.html')
      );
      WriteSignatures($virusstrings, SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
      if ($virusscanupdate == 1 && @file_exists(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php')) {
         CheckforVirusUpdates(1);
         include(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
      }
   }
}

function VirusScan($text) {
   global $virusstrings;
   if (count($virusstrings) < 1)
      VirusOpen ();
   $virus = $url = '';
   if (strlen($text) > 1048576)
      return Array ($virus,$url);
   $text = strtolower(bin2hex($text));
   $count = count($virusstrings)-2;
   for ($a = 0; $a < $count; $a++) {
      if (isset($virusstrings[$a]) && strpos($text, $virusstrings[$a]['s']) !== false) {
         $virus = strip_tags($virusstrings[$a]['name']);
         $url = strip_tags($virusstrings[$a]['url']);
         break;
      }
   }
   return Array ($virus,$url);
}

function CheckforVirusUpdates($update = 0) {
   global $maxsigsize, $virusstrings, $virushourcheck, $virusmirror, $hours, $mirrors, $updatenow, $version;
   if (!isset($virushourcheck) || $virushourcheck < 4 || $virushourcheck > 48)
      $virushourcheck = 12;
   if (!isset($virusmirror) || !in_array($virusmirror, $mirrors))
      $virusmirror = 'advcs.org';

   if (@file_exists(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php') && @!is_writable(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php')) return;

   if (@filemtime(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php') + ($virushourcheck * 3600) < time() || $update != 0) {
      $vers = $virusstrings['version'];
      $version2 = str_replace(" ","%20",$version);
      $pa = "sigv=$vers&vs=" . virus_scan_version() . "&sm=$version2";
      $file = @fopen("http://$virusmirror/sm/virusscan/virussignatures.php?version=1&$pa",'r');
      if (!$file) {
         foreach ($mirrors as $temp) {
            if ($virusmirror != $temp) {
               $file = @fopen("http://$temp/sm/virusscan/virussignatures.php?version=1&$pa",'r');
               if ($file) {
                  $virusmirror = $temp;
                  break;
               }
            }
         }
      }
      if ($file) {
         $v = @fgets($file);
         @fclose($file);
         if ($v > $vers) {
            $file = @fopen("http://$virusmirror/sm/virusscan/virussignatures.php?date",'r');
            $d = @fgets($file);
            @fclose($file);
            $file = @fopen("http://$virusmirror/sm/virusscan/virussignatures.php?$pa",'r');
            $s1 = @fgets($file);
            $v = @fgets($file);
            if ($v > $vers) {
               $virusstrings2 = array();
               $s2 = array();
               $virusstrings2['version'] = trim($v);
               $virusstrings2['date'] = trim($d);
               while (!feof($file)) {
                  $s = @fgets($file, 99000);
                  $s2 = explode('=', $s);
                  if ($s2[0] != '' && $s2[1] != '')
                     $virusstrings2[] = array('name' => trim($s2[0]),'s' => strtolower(trim($s2[1])),'url' => trim($s2[2]));
               }
               WriteSignatures($virusstrings2, SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
            }
            @fclose($file);
         } else {
            @touch(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
         }
      }
   }
}

function WriteSignatures($ar, $filename) {
   $string = "<?php\r\n\r\nglobal \$virusstrings;\r\n\r\n";
   $string .= "\$virusstrings = Array (\r\n";
   $string .= WriteSignatures2($ar);
   $string .= ");\r\n\r\n?>";
   if ($file =  @fopen($filename, 'w')) {
      @fwrite ($file, $string);
     @fclose($file);
   }
}

function WriteSignatures2($ar, $a = 0) {
   $string = '';
   $s = "                              ";
   $end = count($ar);
   $c = 0;
   $a++;
   $d = substr($s, 0, $a * 3);
   foreach ($ar as $key => $value) {
      $c++;
      if (!is_array($value)) {
         if (is_string($key))
            $key = "'$key'";
         $string .= $d . "$key => '$value'";
         if ($c != $end) 
            $string .= ",\r\n";
         else if ($a > 1)
            $string .= "),\r\n";
         else
            $string .= ")\r\n";
      } else {
         if (is_string($key))
            $key = "'$key'";
         $string .= $d . "$key => Array (\r\n";
         $string .= WriteSignatures2($value, $a);
         if ($c == $end) $string = substr($string, 0, strlen($string)-3) . "\r\n";
      }
   }
   return $string;
}

?>