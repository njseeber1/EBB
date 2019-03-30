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

require_once(SM_PATH . 'include/validate.php');
require_once(SM_PATH . 'functions/page_header.php');
require_once(SM_PATH . 'functions/imap.php');
require_once(SM_PATH . 'include/load_prefs.php');

displayPageHeader($color, 'None');
$virus = strip_tags($_GET['virus']);
$url = strip_tags($_GET['url']);


bindtextdomain('block_attach', SM_PATH . 'plugins/block_attach/locale');
textdomain('block_attach');

print "<center><br><br><table width='70%'><tr><td>";

print "<center><b>" . _("This file contains a virus!") . "</b></center><br>";
print _("This file contains the ") . "\"<b>$virus</b>\" " . _("virus") . ".<br><b>";
print _("It is not recommended for you to download this file.") . "</b><br>";
print _("Please go") . " <a href='$url' target='_new'>" . _("here") . "</a> " . _("for more details") . "<br><br>";

print _("Downloading and executing of these files can cause your computer to stop working, or for this virus to spread from your computer to others on your network."). '<br><br>';
print _("If you know that this file does not contain a virus, is from a legitimate and known user, and you need to download the file, you can do any of the following...") . '<br>';
print _("1. Have the sender send the file in a compressed file format.") . '<br>';
print _("2. Have the sender change the file extension (.exe to .ex_) and download it and rename it.") . '<br>';
print _("3. Download this email through another method that doesn't block the attachments (Outlook, POP3, ect...)") . '<br>';
print _("4. Contact your webmail administrator") . '<br>';

print "</td></tr></table</center>";

textdomain('squirrelmail');

?>