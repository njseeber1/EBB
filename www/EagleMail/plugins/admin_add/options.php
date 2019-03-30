<?php
/*******************************************************************************

    Author ......... Jimmy Conner
    Contact ........ jimmy@advcs.org
    Home Site ...... http://www.advcs.org/
    Program ........ Admin Add
    Version ........ 0.1
    Purpose ........ Add / Remove Admins

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
if (!$auth) header("Location " . SM_PATH . "index.php");

include_once(SM_PATH . 'plugins/admin_add/includes/display_save.php');

displayPageHeader($color, 'None');

bindtextdomain('admin_add', SM_PATH . 'plugins/admin_add/locale');
textdomain('admin_add');

print "<br><center><font size=+1>". _("Admin Add / Remove") . "</font></center>\n";
print "<center><table><form method=post action=\"" . SM_PATH . "plugins/admin_add/options.php\">\n";
print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
print "<tr><td colspan=2>" . _("Add an Admin") . "<br><input type=text name='newa' maxlength=50> <input type=submit name=submit value='" . _("Add") . "'><br>";
print "</form></td>";

print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>\n<tr>";
print '<td><center><form method=post action="' . SM_PATH . 'plugins/admin_add/options.php">' . _("Admins") . '<br><select name="amens" size=5>\n';
foreach($admins as $value) {
   $value = trim($value);
   if (strlen($value)>0)
      print "<option value='$value'>$value</option>\n";
}
print "</select><br><input type=submit name=submit value='" . _("Remove") . "'></form></td>\n";

print "<tr><td colspan=4><hr width='100%' color='$color[9]'></td></tr>";
print "</table></center>\n";

textdomain('squirrelmail');

?>