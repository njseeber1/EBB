<?php

/**
 * login.php -- simple login screen
 *
 * Copyright (c) 1999-2004 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * This a simple login screen. Some housekeeping is done to clean
 * cookies and find language.
 *
 * $Id: login.php,v 1.98.2.3 2004/04/19 20:23:29 kink Exp $
 */

/* Path for SquirrelMail required files. */
define('SM_PATH','../');

/* SquirrelMail required files. */
require_once(SM_PATH . 'functions/strings.php');
require_once(SM_PATH . 'config/config.php');
require_once(SM_PATH . 'functions/i18n.php');
require_once(SM_PATH . 'functions/plugin.php');
require_once(SM_PATH . 'functions/constants.php');
require_once(SM_PATH . 'functions/page_header.php');
require_once(SM_PATH . 'functions/html.php');
require_once(SM_PATH . 'functions/global.php');
require_once(SM_PATH . 'functions/forms.php');

/*
 * $squirrelmail_language is set by a cookie when the user selects
 * language and logs out
 */
set_up_language($squirrelmail_language, TRUE, TRUE);

/**
 * Find out the base URI to set cookies.
 */
if (!function_exists('sqm_baseuri')){
    require_once(SM_PATH . 'functions/display_messages.php');
}
$base_uri = sqm_baseuri();

/*
 * In case the last session was not terminated properly, make sure
 * we get a new one.
 */

sqsession_destroy();
 
header('Pragma: no-cache');

do_hook('login_cookie');

/* Output the javascript onload function. */

$header = "<script language=\"JavaScript\" type=\"text/javascript\">\n" .
          "<!--\n".
          "  function squirrelmail_loginpage_onload() {\n".
          "    document.forms[0].js_autodetect_results.value = '" . SMPREF_JS_ON . "';\n".
          "    var textElements = 0;\n".
          "    for (i = 0; i < document.forms[0].elements.length; i++) {\n".
          "      if (document.forms[0].elements[i].type == \"text\" || document.forms[0].elements[i].type == \"password\") {\n".
          "        textElements++;\n".
          "        if (textElements == " . (isset($loginname) ? 2 : 1) . ") {\n".
          "          document.forms[0].elements[i].focus();\n".
          "          break;\n".
          "        }\n".
          "      }\n".
          "    }\n".
          "  }\n".
          "// -->\n".
          "</script>\n";
$custom_css = '../skins/BigBlue/login.css';          
displayHtmlHeader( "$org_name - " . _("Login"), $header, FALSE );

echo '<body text="#000000" bgcolor="#00309C" link="#0000CC" vlink="#0000CC" alink="#0000CC" onload="squirrelmail_loginpage_onload();">' .
     "\n" . addForm('redirect.php', 'POST');

$username_form_name = 'login_username';
$password_form_name = 'secretkey';
do_hook('login_top');

$loginname_value = (sqGetGlobalVar('loginname', $loginname) ? htmlspecialchars($loginname) : '');

/* If they don't have a logo, don't bother.. */
if (isset($org_logo) && $org_logo) {
    /* Display width and height like good little people */
    $width_and_height = '';
    if (isset($org_logo_width) && is_numeric($org_logo_width) &&
     $org_logo_width>0) {
        $width_and_height = " width=\"$org_logo_width\"";
    }
    if (isset($org_logo_height) && is_numeric($org_logo_height) &&
     $org_logo_height>0) {
        $width_and_height .= " height=\"$org_logo_height\"";
    }
}
?> 


<link href="../skins/XP_Blue/XP_Blue_login.css" rel="stylesheet" type="text/css">
<table width="100%" height="100%" border="0" align="center" cellpadding="0" cellspacing="0" class="mainbox">
  <tr> 
    <td colspan="3" align="center" valign="middle" bgcolor="#00309C">&nbsp;</td>
  </tr>
  <tr> 
    <td colspan="3" align="center" valign="middle" bgcolor="#00309C"> <p class="topline">&nbsp;</p></td>
  </tr>
  <tr bgcolor="#5B7EDC"> 
    <td colspan="3" align="center" valign="middle"> <table width="604" height="359" border="0" align="center" cellpadding="0" cellspacing="0">
        <tr bgcolor="#5B7EDC"> 
          <td align="center" valign="top">&nbsp;</td>
          <td align="center" valign="bottom" bgcolor="#5B7EDC"><div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><img src="<?php echo "$org_logo"; ?>" ><br>
              </font><font color="#333333" size="6" face="Verdana, Arial, Helvetica, sans-serif"><em><font color="#FFFFFF"><strong>welcome</strong></font></em></font><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"> 
              </font><font color="#FFFFFF" size="6" face="Verdana, Arial, Helvetica, sans-serif"><strong><em><br>
              </em></strong></font></div></td>
          <td height="193" align="center" valign="bottom" bgcolor="#5B7EDC"><div align="right"><font color="#FFFFFF" size="6" face="Verdana, Arial, Helvetica, sans-serif"><strong><em><br>
              </em></strong></font></div></td>
          <td align="left" valign="middle" bgcolor="#5B7EDC" class="login_middle">&nbsp;</td>
          <td width="287" rowspan="2" align="left" valign="middle"> <br> <table width="97%" border="0" cellspacing="1" cellpadding="0">
              <tr> 
                <td width="14%" align="left" valign="bottom">&nbsp;</td>
                <td width="52%" height="11" align="left" valign="bottom"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">User 
                  Name:</font></td>
                <td width="34%" align="left" valign="bottom">&nbsp;</td>
              </tr>
              <tr> 
                <td align="left" valign="middle">&nbsp;</td>
                <td height="28" align="left" valign="middle"> 
                  <?php	echo "<input type=\"text\" name=\"$username_form_name\" VALUE=\"\" size=\"23\" tabindex=\"1\" class=\"inputlogin\">";
								?>
                </td>
                <td align="left" valign="middle">&nbsp;</td>
              </tr>
              <tr> 
                <td align="left" valign="bottom">&nbsp;</td>
                <td height="11" align="left" valign="bottom"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">Password:</font></td>
                <td align="left" valign="bottom">&nbsp;</td>
              </tr>
              <tr> 
                <td align="left" valign="middle">&nbsp;</td>
                <td height="28" align="left" valign="middle"> <INPUT NAME="<?php echo $password_form_name; ?>" size="23" TYPE="PASSWORD" class="inputlogin" tabindex=\"2\"> 
                  <INPUT TYPE=HIDDEN NAME="js_autodetect_results" VALUE="SMPREF_JS_OFF"> 
                  <INPUT TYPE=HIDDEN NAME="just_logged_in" value=1> 
                  <?php
if ($rcptaddress != '') {
    echo "         <INPUT TYPE=HIDDEN NAME=\"rcptemail\" VALUE=\"".htmlspecialchars($rcptaddress)."\">\n";
}
?>
                </td>
                <td align="left" valign="middle"><input name="button" type="image" src="../skins/XP_Blue/login_go.gif" value="Login" border="0"></td>
              </tr>
              <tr> 
                <td align="left" valign="bottom">&nbsp;</td>
                <td height="25" align="left" valign="bottom"> <div align="right"> 
                  </div></td>
                <td align="left" valign="bottom">&nbsp;</td>
              </tr>
            </table>
            <?php do_hook('login_form'); ?>
          </td>
          <td align="left" valign="middle">&nbsp;</td>
        </tr>
        <tr bgcolor="#5B7EDC"> 
          <td width="8" align="center" valign="top">&nbsp;</td>
          <td width="271" align="center" valign="top"><div align="right"><font color="#FFFFFF" size="2" face="Arial, Helvetica, sans-serif">To 
              begin, login with your email address</font></div></td>
          <td width="10" height="154" align="center" valign="top"> <div align="right"><font color="#333333" size="2" face="Verdana, Arial, Helvetica, sans-serif"><br>
              <br>
              </font><font color="#0000FF" size="4" face="Verdana, Arial, Helvetica, sans-serif"></font></div></td>
          <td width="9" align="left" valign="middle" bgcolor="#5B7EDC" class="login_middle">&nbsp;</td>
          <td width="21" align="left" valign="middle"><br> </td>
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

<?php
do_hook('login_bottom');
echo "</body>\n".
     "</html>\n";
?>
