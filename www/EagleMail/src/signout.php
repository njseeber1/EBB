<?php

/**
 * signout.php -- cleans up session and logs the user out
 *
 * Copyright (c) 1999-2004 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 *  Cleans up after the user. Resets cookies and terminates session.
 *
 * $Id: signout.php,v 1.66.2.1 2004/02/24 15:57:39 kink Exp $
 */

/* Path for SquirrelMail required files. */
define('SM_PATH','../');

/* SquirrelMail required files. */
require_once(SM_PATH . 'include/validate.php');
require_once(SM_PATH . 'functions/prefs.php');
require_once(SM_PATH . 'functions/plugin.php');
require_once(SM_PATH . 'functions/strings.php');
require_once(SM_PATH . 'functions/html.php');

/* Erase any lingering attachments */
if (isset($attachments) && is_array($attachments) 
    && sizeof($attachments)){
    $hashed_attachment_dir = getHashedDir($username, $attachment_dir);
    foreach ($attachments as $info) {
        $attached_file = "$hashed_attachment_dir/$info[localfilename]";
        if (file_exists($attached_file)) {
            unlink($attached_file);
        }
    }
}

if (!isset($frame_top)) {
    $frame_top = '_top';
}

/* If a user hits reload on the last page, $base_uri isn't set
 * because it was deleted with the session. */
if (! sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION) ) {
    require_once(SM_PATH . 'functions/display_messages.php');
    $base_uri = sqm_baseuri();
}

do_hook('logout');

sqsession_destroy();

if ($signout_page) {
    header('Status: 303 See Other');
    header("Location: $signout_page");
    exit; /* we send no content if we're redirecting. */
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<HTML>
   <HEAD>
<?php
    if ($theme_css != '') {
?>
<link href="../skins/XP_Blue/XP_Blue_login.css" rel="stylesheet" type="text/css">
<?php  
   }
?>
<TITLE><?php echo $org_title ?> - Signout</TITLE>
<style type="text/css">
<!--
.topbar {
	background-image: url(../images/login_back.gif);
	background-repeat: repeat-x;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1"></HEAD>

<body text="#000000" bgcolor="#00309C" link="#0000CC" vlink="#0000CC" alink="#0000CC" >

<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="mainbox">
  <tr> 
    <td colspan="3" align="center" valign="middle" bgcolor="#00309C">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3" align="center" valign="middle" bgcolor="#00309C"> <p class="topline">&nbsp;</p></td>
  </tr>
  <tr bgcolor="#5B7EDC"> 
    <td colspan="3" align="center" valign="middle"> <table width="558" height="359" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#5B7EDC"> 
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="bottom" bgcolor="#5B7EDC"><div align="right"><font color="#FFFFFF" size="6" face="Verdana, Arial, Helvetica, sans-serif"><strong><em><br>
              </em></strong></font></div></td>
          <td height="193" align="center" valign="bottom" bgcolor="#5B7EDC"><div align="right"><font color="#FFFFFF" size="6" face="Verdana, Arial, Helvetica, sans-serif"><strong><em><br>
              </em></strong></font></div></td>
          <td width="343" rowspan="2" align="left" valign="middle"> <div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="<?php echo "$org_logo"; ?>" ><br>
              <br>
              </font><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">You 
              have successfully been logged out...</font><br>
              <br>
              <a href="login.php"><img  src="../skins/XP_Blue/login_go.gif" border="0"></a> 
            </div></td>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr bgcolor="#5B7EDC"> 
          <td width="5" align="center" valign="top">&nbsp;</td>
          <td width="158" align="center" valign="top"><div align="right"> </div></td>
          <td width="42" height="154" align="center" valign="top"> <div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <br>
              </font><font color="#0000FF" size="4" face="Verdana, Arial, Helvetica, sans-serif"></font></div></td>
          <td width="10" align="left" valign="middle"><br> </td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td colspan="3" align="center" valign="middle" bgcolor="#00309C" class="bottomline">&nbsp;</td>
  </tr>
  <tr> 
    <td width="42%" align="center" valign="middle" bgcolor="#00309C"><font color="#0000FF" size="4" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif">&nbsp;</font></td>
    <td width="49%" align="center" valign="middle" bgcolor="#00309C"><div align="right"> 
        <p><font color="#FFFFFF" size="2" face="Verdana, Arial, Helvetica, sans-serif"><font face="Arial, Helvetica, sans-serif"><?php echo "$org_title"; ?></font><br>
          <font face="Arial, Helvetica, sans-serif"><?php echo "$org_name"; ?></font><br>
          </font></p>
      </div></td>
    <td width="9%" align="center" valign="middle" bgcolor="#00309C">&nbsp;</td>
  </tr>
</table>

</body>
</html>
