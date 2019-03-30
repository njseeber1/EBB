<?php 

/* 
 * mini window plugin for SquirrelMail
 *
 * This is the whole thing except functions
 * which are in mini_functions.php. This page has
 * two phases the expandable folders display
 * and the message reading page.
 *
 */


/* include what we need */
require_once('../../functions/strings.php');

/* check for SM versions greater than 1.3 */
if (substr($version, 2,4) > 3.1) {
    define('SM_PATH', '../../');
    require_once(SM_PATH.'include/validate.php');
    require_once(SM_PATH.'/functions/imap.php');
    require_once('mini_functions.php');
}
else {
    chdir ('../');
    require_once('../functions/imap.php');
    require_once('../src/validate.php');
    require_once('mini_functions.php');
}

if (!isset($uid_support)) {
    $uid_support = '';
}

/* get our global vars */
$delimiter = $_SESSION['delimiter'];
$key = $_COOKIE['key'];
$username = $_SESSION['username'];
$onetimepad = $_SESSION['onetimepad'];
$length = strlen($default_folder_prefix);
if (!isset($PHP_SELF)) {
    $PHP_SELF = strip_tags($_SERVER['PHP_SELF']);
}
$mini_refresh = getPref($data_dir, $username, 'mini_refresh', '0');
$mini_width = getPref($data_dir, $username, 'mini_width', '380');
$mini_text_size = getPref($data_dir, $username, 'mini_text_size', '1');
if ($mini_text_size == '1') {
    $bsm = "<small>";
    $esm = "</small>";
}
elseif ($mini_text_size == '0') {
    $bsm = "<small><small>";
    $esm = "</small></small>";
}
elseif ($mini_text_size == '2') {
    $bsm = "";
    $esm = "";
}


/* if we are keeping the message as new */
if (isset($_GET['mini_keep_as_new'])) {
    $imapConn = sqimap_login($username, $key, $imapServerAddress,
                                      $imapPort, 10, $onetimepad);
    $box = urldecode($_GET['box']);
    sqimap_mailbox_select($imapConn, $box, true, false, false);
    sqimap_messages_remove_flag($imapConn, $_GET['mini_id'],
                                  $_GET['mini_id'], 'Seen');
    sqimap_logout($imapConn);
}

/* connect to IMAP, get list of folders with new messages and their numbers */ 
$imapConn = sqimap_login($username, $key, $imapServerAddress,
                                 $imapPort, 10, $onetimepad);
$boxes = get_mini_list($imapConn);

/* check collapse status and adjust vars as need be */
if (isset($_GET['mini_collapse'])) {
   $name = $_GET['mini_collapse'];
   $_SESSION[$name] = 'off'; 
}
if (isset($_GET['mini_read'])) {
    $link = 'Back';
}
else {
    $link = 'Refresh';
}

/* html goodness */
echo "<html><head><title>SquirrelMail</title>\n";
if ($mini_refresh > 0 && !isset($_GET['mini_read'])) {
    echo "<meta HTTP-EQUIV=i\"Pragma\" CONTENT=\"no-cache\">\n".
         "<meta HTTP-EQUIV=\"REFRESH\" CONTENT=\"$mini_refresh;URL=mini.php\">\n";
}
echo "</head><body bgcolor=\"$color[4]\" ".
     "text=\"$color[8]\" link=\"$color[7]\" ".
     "alink=\"$color[7]\" vlink=\"$color[7]\">\n".
     "<table width=\"100%\" bgcolor=\"$color[9]\"".
     " cellpadding=4><tr><td align=left>\n".
     "$bsm<b><a href=\"mini.php\">$link</a>\n".
     "</b>$esm</td><td align=right><small><b>\n".
     "<i>Mini SquirrelMail</i>&nbsp;&nbsp;\n".
     "</b></small></td></tr><tr><td colspan=2 bgcolor=\"$color[4]\">\n".
     "<center><table width=\"99%\" border=0 bgcolor=\"$color[4]\"".
     "cellspacing=0 cellpadding=0>\n";


/* if we are reading a message */
if (isset($_GET['mini_read'])) {
    $id = $_GET['id'];
    $box = $_GET['box'];
    $mini_header = urldecode(stripslashes($_GET['mini_header']));
    $mini_message = mini_message ($id, $box);
    echo "<tr><td>$bsm<b>Subject</b>$esm</td><td>\n".
         "$bsm<b>From</b>$esm</td></tr>\n".
         "<tr><td width=\"50%\">$bsm<a$mini_header$esm</td></tr>".
         "</table></td></tr></table></center>\n".
         "<br><table width=\"100%\" bgcolor=\"$color[0]\"><tr>".
         "<td align=center>$mini_message</td></tr></table></center>".
         "<center>$bsm<b><a href=\"mini.php\">Back</a>&nbsp;&nbsp;&nbsp;".
         "<a href=\"mini.php?mini_keep_as_new=yes&mini_id=$id&box=".
         urlencode($box)."\">keep as new</a>$esm</b></center>\n";
    exit;
}

/* finish all the tables. */
echo "<tr><td align=center>$bsm<b>&nbsp;&nbsp;&nbsp;Folder&nbsp;&nbsp;".
     "</b>$esm</td><td align=center>$bsm<b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;".
     "New Mail</b>$esm</td></tr><tr><td colspan=2 align=center>$bsm\n".
     "<table width=\"99%\" bgcolor=\"$color[0]\" border=0>\n";

/* loop through boxes and either display summary or add in the details if selected */
if (count($boxes) > 0) {
    foreach($boxes as $index=>$value) {
        if ($index != 'INBOX') {
            $index_dsp = substr($index,$length);
        }
        else {
            $index_dsp = $index;
        }
        echo "<tr bgcolor=\"$color[0]\">\n".
             "<td width=\"50%\">";
        if ((isset($_GET['mini_expand']) && $index == substr($_GET['mini_expand'],7)) ||
            (isset($_SESSION['expand_'.$index]) && $_SESSION['expand_'.$index] == 'on')) {
            echo "<a style=\"text-decoration:none\" ".
                 "href=\"mini.php?mini_collapse=expand_".urlencode($index).
                 "\">-</a><b>&nbsp;$bsm<font color=\"$color[6]\">".
                 $index_dsp."</font>$esm</b></td>\n".
                 "<td width=\"50%\" align=center>$bsm<font color=\"$color[6]\">".
                 count($value)."</font>$esm</b></td></tr>\n";
            $mini_headers  = get_mini_headers ($imapConn, $index, $value); 
            echo "<tr><td bgcolor=\"$color[5]\">$bsm".
                 "<b>Subject</b>$esm</td>\n".
                 "<td bgcolor=\"$color[5]\">$bsm".
                 "<b>From</b>$esm</td></tr>\n";
            foreach($mini_headers as $id=>$header_value) {
                echo "<tr bgcolor=\"$color[4]\"><td width=\"50%\">".
                     "$bsm<a href=\"mini.php?id=$id&box=$index&mini_read=yes".
                     "&mini_header=".urlencode(addslashes($header_value)).
                     "\" style=\"text-decoration:none\" ".
                     $header_value."$esm</td></tr>\n";
            }
        }
        else {
            echo "<a style=\"text-decoration:none\" href=\"mini.php?mini_expand=expand_".
                 urlencode($index)."\">+</a><b>&nbsp;$bsm<font color=\"$color[6]\">".
                 $index_dsp."</font>$esm</b></td><td width=\"50%\" align=center>".
                 "$bsm<font color=\"$color[6]\">".count($value)."</font>$esm".
                 "</b></td></tr>\n";
        } 
    }
}
else {
    echo "<tr><td align=center>No New Messages</td></tr>\n";
}

/* do our session stuff for collapsed folder contents here.*/
if (isset($_GET['mini_expand'])) {
    $value = 'on';
    $name  = $_GET['mini_expand'];
    $_SESSION[$name] = $value;
}

/* close up shop */
echo "</table>$bsm<br>$esm</td></tr></table></center>\n".
     "</td></tr></table></center>";
echo "<br><center><input type=button name=close value=\"Close\"".
     " onClick=\"self.close()\"></center>\n";
echo "</body></html>\n";

?>
