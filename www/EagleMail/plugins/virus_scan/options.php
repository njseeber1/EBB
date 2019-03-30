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

define('SM_PATH','../../');

/* SquirrelMail required files. */
require_once(SM_PATH . 'include/validate.php');
require_once(SM_PATH . 'functions/page_header.php');
require_once(SM_PATH . 'functions/imap.php');
require_once(SM_PATH . 'include/load_prefs.php');

global $username;

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

$filename = SM_PATH . 'plugins/virus_scan/config.php';

if (!@is_writable($filename) && @file_exists($filename)) {
   displayPageHeader($color, 'None');
   print "<center>ERROR : $filename must be writable by the webserver!</center>";
   exit();
}

if (!@file_exists($filename)) {
   @touch($filename);
   $scanext = Array('scr','pif','bat','vbs','exe','com','zi','zip');
   $excluded = Array('');
   $virusscan = 1;
   $virusscanupdate = 1;
   $virushourcheck = 12;
   $virusmirror = 'advcs.org';
   CreateScanArray($scanext,$excluded,$virusscan,$virusscanupdate,$virushourcheck,$virusmirror, $filename);
}

@include($filename);


global $virusstrings, $hours, $mirrors;
include_once(SM_PATH . "plugins/virus_scan/includes/scan.php");

if (!isset($virusmirror) || !in_array($virusmirror, $mirrors))
   $virusmirror = 'advcs.org';
if (!isset($virushourcheck) || $virushourcheck < 4 || $virushourcheck > 48 || !in_array($virushourcheck, $hours))
   $virushourcheck = 12;
if (!isset($virusscan))
   $virusscan = 1;

VirusOpen();

if (isset($_GET['updatenow'])) {
   if ($_GET['updatenow'] == 1) {
      CheckforVirusUpdates(1);
      include(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php');
      Header("Location: " . SM_PATH . "plugins/virus_scan/options.php");
      exit();
   }
}
@include_once(SM_PATH . 'plugins/virus_scan/includes/display_save.php');

displayPageHeader($color, 'None');

bindtextdomain('virus_scan', SM_PATH . 'plugins/virus_scan/locale');
textdomain('virus_scan');

print "<br><center><font size=+1>". _("Virus Scan") . "<br>". _("Admin Interface") . "</font></center>\n";
print "<center><table><form method=post action=\"" . SM_PATH . "plugins/virus_scan/options.php\">\n";
print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
print "<tr><td colspan=2>" . _("Add a file extension") . "<br><input type=text name='newb' maxlength=5> <input type=submit name=submit value='" . _("Add") . "'><br>";
print "</form></td>";

print '<td colspan=2><center><form method=post action="' . SM_PATH . 'plugins/virus_scan/options.php">&nbsp;&nbsp;&nbsp;&nbsp;' . _("Add an excluded user") . '<br>';
print "&nbsp;&nbsp;&nbsp;&nbsp;<input type=text name='exu' maxlength=50><input type=submit name=submit value='" . _("Add") . "'><br><br><br>";
print "</td></tr>\n";

print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>\n<tr>";
print '<td colspan=2><center><form method=post action="' . SM_PATH . 'plugins/virus_scan/options.php">' . _("Scan Extensions") . '<br><select name="wtypes" size=5>\n';
foreach($scanext as $value) {
   if (strlen($value)>0)
      print "<option value='$value'>*.$value</option>\n";
}
print "</select><br><input type=submit name=submit value='" . _("Remove") . "'></form></td>\n";

print '<td colspan=2><center><form method=post action="' . SM_PATH . 'plugins/virus_scan/options.php">' . _("Excluded Users") . '<br><select name="exclude" size=5>\n';
foreach($excluded as $value) {
   if (strlen($value)>0)
      print "<option value='$value'>$value</option>\n";
}
print "</select><br><input type=submit name=submit value='" . _("Remove") . "'></form></center></td></tr>\n";

print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
print '<tr><td colspan=2><center><table><tr><td><form method=post action="' . SM_PATH . 'plugins/virus_scan/options.php">' . _("Virus Scan") . '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
print '</td><td><select name="vscan" size=1><option value=0';
if ($virusscan == 0 || $virusscan == '')
   echo ' SELECTED';
print  '>' . _("Disabled") . '</option>';
print '<option value=1';
if ($virusscan == 1)
   echo ' SELECTED';
print  '>' . _("Enabled") . '</option></select></td></tr>';
print '<tr><td>' . _("Auto Update") . '&nbsp;&nbsp;</td><td><select name="vscanupdate" size=1><option value=0';
if ($virusscanupdate == 0 || $virusscanupdate == '')
   echo ' SELECTED';
print  '>' . _("Disabled") . '</option>';
print  '<option value=1';
if ($virusscanupdate == 1)
   echo ' SELECTED';
print  '>' . _("Enabled") . '</option></select></td></tr>';


print '<tr><td>' . _("Update Mirror") . '&nbsp;&nbsp;</td><td><select name="vscanmirror" size=1>';

foreach ($mirrors as $temp) {
   print  "<option value='$temp'";
   if ($virusmirror == $temp)
      echo ' SELECTED';
   print  ">$temp</option>";
}
print '</select></td></tr>';

print '<tr><td>' . _("Update Every") . '&nbsp;&nbsp;</td><td><select name="vscanhourcheck" size=1>';
foreach ($hours as $temp) {
   print  "<option value=$temp";
   if ($virushourcheck == $temp)
      echo ' SELECTED';
   print  ">$temp</option>";
}
print '</select> '._("Hours") . '</td></tr>';

if (!isset($_GET['viruslist']))
   $viruslist = "?viruslist";
else
   $viruslist = '';
clearstatcache();
print '<tr><td colspan=2><center><input type=submit value="' . _("Save") . '"></center></form></td></tr></table></center></td>';
print '<td valign=top><center><table><tr><td>' . _("Version") . '</td><td> : ' . strip_tags($virusstrings['version']) . '</td></tr>';
print '<tr><td>' . _("Time Stamp") . ' </td><td> : ' . strip_tags($virusstrings['date']) . '</td></tr>';
print '<tr><td>' . _("Last Check") . ' </td><td> : ' . @date("m/d/Y H:i:s",filemtime(SM_PATH . 'plugins/virus_scan/includes/virussignatures.php')) . '</td></tr>';

print '<tr><td>' . _("Total Signatures") . '</td><td> : ' . (count($virusstrings)-2) . '</td></tr></table></center></td></tr>';

print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";

print "<tr><td colspan=4><table>";
print '<tr><td colspan=3><b><a href="' . SM_PATH . 'plugins/virus_scan/options.php?updatenow=1">'. _("Update Virus Signatures") . '</a></td></tr>';

if (isset($_GET['viruslist'])) {
   print '<tr><td colspan=3><b><a href="' . SM_PATH . 'plugins/virus_scan/options.php' . $viruslist . '">'. _("Hide Virus Signatures") . '</a></td></tr>';
   print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
   $count = count($virusstrings)-2;
   for ($a = 0; $a < $count; $a=$a+3) {
      if (isset($virusstrings[$a]))
         print "<tr><td><a href=\"" . strip_tags($virusstrings[$a]['url']) . "\" target=\"_new\">" . strip_tags($virusstrings[$a]['name']) . "</a></td>";
      if (isset($virusstrings[$a+1]))
         print "<td><a href=\"" . strip_tags($virusstrings[$a+1]['url']) . "\" target=\"_new\">" . strip_tags($virusstrings[$a+1]['name']) . "</a></td>";
      if (isset($virusstrings[$a+2]))
         print "<td><a href=\"" . strip_tags($virusstrings[$a+2]['url']) . "\" target=\"_new\">" . strip_tags($virusstrings[$a+2]['name']) . "</a></td></tr>";
   }
   print "</table></td></tr>";   
   print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
} else {
   print '<tr><td colspan=3><b><a href="' . SM_PATH . 'plugins/virus_scan/options.php' . $viruslist . '">' . _("Show Virus Signatures") . '</a></td></tr>';
   print "</table></td></tr>";   
   print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
}

print "</table></center>\n";

textdomain('squirrelmail');

function CreateScanArray($scanext, $excluded, $scan, $update, $virushourcheck, $virusmirror, $filename) {
   $string = "<?php\r\n\r\nglobal \$scanext;\r\n\r\n";
   $string .= "\$virusscan = $scan;\r\n";
   $string .= "\$virusscanupdate = $update;\r\n";
   $string .= "\$virusmirror = '$virusmirror';\r\n";
   $string .= "\$virushourcheck = $virushourcheck;\r\n\r\n";
   $string .= "\$excluded = Array(";
   $string .= OutputScanArray($excluded);
   $string .= ");\r\n\r\n";
   $string .= "\$scanext = Array(";
   $string .= OutputScanArray($scanext);
   $string .= ");\r\n\r\n?>";
   if ($file =  @fopen($filename, 'w')) {
      @fwrite ($file, $string);
     @fclose($file);
   }
}

function OutputScanArray($ar, $name = '') {
   $string = '';
   $end = count($ar);
   $c = 0;
   sort($ar);
   reset($ar);
   foreach ($ar as $key => $value) {
      $c++;
      if (!is_array($value)) {
         $string .= "'$value'";
         if ($c != $end) 
            $string .= ",\r\n";
      } else {
         OutputScanArray($value, $name = '');
      }
   }
   return $string;
}

?>