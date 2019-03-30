<?php

/**
 * page_header.php
 *
 * Copyright (c) 1999-2004 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *
 * Prints the page header (duh)
 *
 * $Id: page_header.php,v 1.148.2.11 2004/04/06 14:09:13 tokul Exp $
 */

require_once(SM_PATH . 'functions/strings.php');
require_once(SM_PATH . 'functions/html.php');
require_once(SM_PATH . 'functions/imap_mailbox.php');
require_once(SM_PATH . 'functions/global.php');
require_once(SM_PATH . 'config/config.php');


/* Always set up the language before calling these functions */
function displayHtmlHeader( $title = 'SquirrelMail', $xtra = '', $do_hook = TRUE ) {
    global $squirrelmail_language, $skindir;


    if ( !sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION) ) {
        global $base_uri;
    }
    global $theme_css, $custom_css, $pageheader_sent;

    echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">' .
         "\n\n" . html_tag( 'html' ,'' , '', '', '' ) . "\n<head>\n";


    if ( !isset( $custom_css ) || $custom_css == 'none' ) {
        if ($theme_css != '') {
            echo "<link rel=\"stylesheet\" type=\"text/css\" href=\"$theme_css\" />";
        }
    } else {
        echo '<link rel="stylesheet" type="text/css" href="' .
             $base_uri . 'themes/css/'.$custom_css.'" />';
    }
    
    if ($squirrelmail_language == 'ja_JP') {
	// why it is added here. header ('Content-Type:..) is used in i18n.php
        echo "<!-- \xfd\xfe -->\n";
        echo '<meta http-equiv="Content-type" content="text/html; charset=euc-jp">' . "\n";
    }
    
    if ($do_hook) {
        do_hook('generic_header');
    }
    
    echo "\n<title>$title</title>$xtra\n";

    /* work around IE6's scrollbar bug */
    echo <<<ECHO
<style type="text/css">
<!--
  /* avoid stupid IE6 bug with frames and scrollbars */
  body { 
      voice-family: "\"}\""; 
      voice-family: inherit; 
      width: expression(document.documentElement.clientWidth - 30);
  }
-->
</style>

ECHO;
     //echo '<link rel="stylesheet" type="text/css" href="../skins/'.$skindir.'/smskin.css">';
    echo "\n</head>\n\n";

    /* this is used to check elsewhere whether we should call this function */
    $pageheader_sent = TRUE;
}

function makeInternalLink($path, $text, $target='') {
    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
    if ($target != '') {
        $target = " target=\"$target\"";
    }
    return '<a href="'.$base_uri.$path.'"'.$target.'>'.$text.'</a>';
}

function displayInternalLink($path, $text, $target='') {
    echo makeInternalLink($path, $text, $target);
}

function displayPageHeader($color, $mailbox, $xtra='', $session=false) {

    global $hide_sm_attributions, $PHP_SELF, $frame_top,
           $compose_new_win, $compose_width, $compose_height,
           $attachemessages, $provider_name, $provider_uri,
           $javascript_on, $default_use_mdn, $mdn_user_support,
           $startMessage, $org_title;

    sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION );
    sqgetGlobalVar('delimiter', $delimiter, SQ_SESSION );
    $module = substr( $PHP_SELF, ( strlen( $PHP_SELF ) - strlen( $base_uri ) ) * -1 );
    if ($qmark = strpos($module, '?')) {
        $module = substr($module, 0, $qmark);
    }
    if (!isset($frame_top)) {
        $frame_top = '_top';
    }

    if ($session) {
	$compose_uri = $base_uri.'src/compose.php?mailbox='.urlencode($mailbox).'&amp;attachedmessages=true&amp;session='."$session";
    } else {
        $compose_uri = $base_uri.'src/compose.php?newmessage=1';
	$session = 0;
    }

    // only output JavaScript if actually turned on
    if($javascript_on) {
        switch ( $module ) {
        case 'src/read_body.php':
            $js ='';

            // compose in new window code
            if ($compose_new_win == '1') {
                if (!preg_match("/^[0-9]{3,4}$/", $compose_width)) {
                    $compose_width = '640';
                }
                if (!preg_match("/^[0-9]{3,4}$/", $compose_height)) {
                    $compose_height = '550';
                }
                $js .= "function comp_in_new(comp_uri) {\n".
		     "       if (!comp_uri) {\n".
		     '           comp_uri = "'.$compose_uri."\";\n".
                     '       }'. "\n".
                     '    var newwin = window.open(comp_uri' .
                     ', "_blank",'.
                     '"width='.$compose_width. ',height='.$compose_height.
                     ',scrollbars=yes,resizable=yes");'."\n".
                     "}\n\n";
            }

            // javascript for sending read receipts
            if($default_use_mdn && $mdn_user_support) {
                $js .= 'function sendMDN() {'."\n".
                       "    mdnuri=window.location+'&sendreceipt=1'; ".
                       "var newwin = window.open(mdnuri,'right');".
	               "\n}\n\n";
            }

            // if any of the above passes, add the JS tags too.
            if($js) {
                $js = "\n".'<script language="JavaScript" type="text/javascript">' .
                      "\n<!--\n" . $js . "// -->\n</script>\n";
            }
	     
            displayHtmlHeader ('SquirrelMail', $js);
            $onload = $xtra;
          break;
        case 'src/compose.php':
            $js = '<script language="JavaScript" type="text/javascript">' .
             "\n<!--\n" .
             "function checkForm() {\n";

            global $action, $reply_focus;
            if (strpos($action, 'reply') !== FALSE && $reply_focus)
            {
                if ($reply_focus == 'select') $js .= "document.forms['compose'].body.select();}\n";
                else if ($reply_focus == 'focus') $js .= "document.forms['compose'].body.focus();}\n";
            }
            else
                $js .= "var f = document.forms.length;\n".
                "var i = 0;\n".
                "var pos = -1;\n".
                "while( pos == -1 && i < f ) {\n".
                    "var e = document.forms[i].elements.length;\n".
                    "var j = 0;\n".
                    "while( pos == -1 && j < e ) {\n".
                        "if ( document.forms[i].elements[j].type == 'text' ) {\n".
                            "pos = j;\n".
                        "}\n".
                        "j++;\n".
                    "}\n".
                "i++;\n".
                "}\n".
                "if( pos >= 0 ) {\n".
                    "document.forms[i-1].elements[pos].focus();\n".
                "}\n".
            "}\n";
	    
            $js .= "// -->\n".
        	 "</script>\n";
            $onload = 'onload="checkForm();"';
            displayHtmlHeader ('SquirrelMail', $js);
            break;   

        default:
            $js = '<script language="JavaScript" type="text/javascript">' .
             "\n<!--\n" .
             "function checkForm() {\n".
                "var f = document.forms.length;\n".
                "var i = 0;\n".
                "var pos = -1;\n".
                "while( pos == -1 && i < f ) {\n".
                    "var e = document.forms[i].elements.length;\n".
                    "var j = 0;\n".
                    "while( pos == -1 && j < e ) {\n".
                        "if ( document.forms[i].elements[j].type == 'text' " .
                        "|| document.forms[i].elements[j].type == 'password' ) {\n".
                            "pos = j;\n".
                        "}\n".
                        "j++;\n".
                    "}\n".
                "i++;\n".
                "}\n".
                "if( pos >= 0 ) {\n".
                    "document.forms[i-1].elements[pos].focus();\n".
                "}\n".
		"$xtra\n".
            "}\n";
	    
            if ($compose_new_win == '1') {
                if (!preg_match("/^[0-9]{3,4}$/", $compose_width)) {
                    $compose_width = '640';
                }
                if (!preg_match("/^[0-9]{3,4}$/", $compose_height)) {
                    $compose_height = '550';
                }
                $js .= "function comp_in_new(comp_uri) {\n".
		     "       if (!comp_uri) {\n".
		     '           comp_uri = "'.$compose_uri."\";\n".
		     '       }'. "\n".
                     '    var newwin = window.open(comp_uri' .
                     ', "_blank",'.
                     '"width='.$compose_width. ',height='.$compose_height.
                     ',scrollbars=yes,resizable=yes");'."\n".
                     "}\n\n";

            }
        $js .= "// -->\n". "</script>\n";
	

        $onload = 'onload="checkForm();"';
        displayHtmlHeader ('SquirrelMail', $js);
      } // end switch module
    } else {
        // JavaScript off
        displayHtmlHeader ('SquirrelMail');
        $onload = '';
    }

    echo "<body text=\"$color[8]\" link=\"$color[7]\" vlink=\"$color[7]\" alink=\"$color[7]\" $onload>\n\n";
    /** Here is the header and wrapping table **/
    $shortBoxName = htmlspecialchars(imap_utf7_decode_local(
		      readShortMailboxName($mailbox, $delimiter)));
    if ( $shortBoxName == 'INBOX' ) {
        $shortBoxName = _("INBOX");
    }
    echo "<a name=\"pagetop\"></a>\n";
	echo "<table width='100%'><tr><td bgcolor=\"$color[3]\" class='top_bar_header'><div align='right' ><font color=\"$color[8]\">".$org_title." </font></div></td></tr></table>";
        echo html_tag( 'table', '', '', '', 'border="0" width="100%" cellspacing="0" cellpadding="2"' ) ."\n";

//Second Icon Bar


        echo html_tag( 'tr', '', '', '', 'class="main_header_bar"' ) ."\n"
        . ($hide_sm_attributions ? html_tag( 'td', '', 'left', '', 'colspan="2"' )
                                 : html_tag( 'td', '', 'left' ) )
        . "\n";
    $urlMailbox = urlencode($mailbox);
	//echo "<div id='bar_dots'></div>";
	//echo "&nbsp;<img src=\"../skins/".$GLOBALS['skindir']."/bar_dots.png\" border=\"0\" align=\"absmiddle\">";
    echo displayInternalLink('src/right_main.php?PG_SHOWALL=0&amp;sort=0&amp;startMessage=1&amp;mailbox=INBOX',_("<div id='inbox_button'><p class='button_text'>"._("Inbox")."</p></div>") );
  //  echo "<img src=\"../skins/".$GLOBALS['skindir']."/divider.png\" border=\"0\" align=\"absmiddle\">\n";
    echo displayInternalLink('src/compose.php?mailbox='.$urlMailbox.'&amp;startMessage='.$startMessage,_("<div id='compose_button'><p class='button_text'>"._("Compose")."</p></div>") );
 //   echo "<img src=\"../skins/".$GLOBALS['skindir']."/divider.png\" border=\"0\" align=\"absmiddle\">\n";
    displayInternalLink ('src/addressbook.php', _("<div id='addresses_button'><p class='button_text'>"._("Addresses")."</p></div>"));
  //  echo "<img src=\"../skins/".$GLOBALS['skindir']."/divider.png\" border=\"0\" align=\"absmiddle\">\n";
   // displayInternalLink ('src/folders.php', _("<img src=\"../skins/".$GLOBALS['skindir']."/folders.png\" border=\"0\" align=\"absmiddle\" alt=\"Folders\">"));
    displayInternalLink ('src/folders.php', _("<div id='folders_button'><p class='button_text'>"._("Folders")."</p></div>"));
	//echo "<div id='right_logo'>&nbsp;&nbsp;</div>";
	displayInternalLink ('src/options.php', _("<div id='options_button' title='"._("Options")."'>&nbsp;&nbsp;</div>"));
	displayInternalLink ("src/search.php?mailbox=$urlMailbox", _("<div id='search_button' title='"._("Search")."'>&nbsp;&nbsp;</div>"));
	displayInternalLink ('src/help.php', _("<div id='help_button' title='"._("Help")."'>&nbsp;&nbsp;</div>"));


 //   echo "<img src=\"../skins/".$GLOBALS['skindir']."/divider.png\" border=\"0\" align=\"absmiddle\">\n";

    do_hook('menuline');
    if (!$hide_sm_attributions)
    {
        echo html_tag( 'td', '', 'right' ) ."\n";
        if (!isset($provider_uri)) $provider_uri= 'http://www.squirrelmail.org/';
        if (!isset($provider_name)) $provider_name= 'SquirrelMail';
        echo '<a href="'.$provider_uri.'" target="_blank">'.$provider_name.'</a>&nbsp;&nbsp;';
        echo "</td>\n";
    }
    echo "     </td>\n";
// end main option bar

//Top Inbox Bar
    echo html_tag( 'tr', '', '', $color[9], 'class="small_header_bar"' ) ."\n"
        . html_tag( 'td', '', 'left' ) ."\n";
    if ( $shortBoxName <> '' && strtolower( $shortBoxName ) <> 'none' ) {
        echo '         ' . _("Current Folder") . ": <b>$shortBoxName&nbsp;</b>\n";
    } else {
        echo '&nbsp;';
    }
	
    echo  "      </td>\n";
	
	    echo html_tag( 'td', '', 'right') ."<b>\n";
		    displayInternalLink ('src/signout.php', _("Sign Out"), $frame_top);
    echo "&nbsp;&nbsp;</b></td>\n"
        . "   </tr>\n";
	
// End Small header bar



    echo "   </tr>\n".
        "</table><br>\n\n";
}

/* blatently copied/truncated/modified from the above function */
function compose_Header($color, $mailbox) {

    global $delimiter, $hide_sm_attributions, $base_uri, $PHP_SELF, 
           $data_dir, $username, $frame_top, $compose_new_win;


    $module = substr( $PHP_SELF, ( strlen( $PHP_SELF ) - strlen( $base_uri ) ) * -1 );
    if (!isset($frame_top)) {
        $frame_top = '_top';
    }

    /*
        Locate the first displayable form element
    */
    switch ( $module ) {
    case 'src/search.php':
        $pos = getPref($data_dir, $username, 'search_pos', 0 ) - 1;
        $onload = "onload=\"document.forms[$pos].elements[2].focus();\"";
        displayHtmlHeader (_("Compose"));
        break;
    default:
        $js = '<script language="JavaScript" type="text/javascript">' .
             "\n<!--\n" .
             "function checkForm() {\n";

            global $action, $reply_focus;
            if (strpos($action, 'reply') !== FALSE && $reply_focus)
            {
                if ($reply_focus == 'select') $js .= "document.forms['compose'].body.select();}\n";
                else if ($reply_focus == 'focus') $js .= "document.forms['compose'].body.focus();}\n";
            }
            else
                $js .= "var f = document.forms.length;\n".
                "var i = 0;\n".
                "var pos = -1;\n".
                "while( pos == -1 && i < f ) {\n".
                    "var e = document.forms[i].elements.length;\n".
                    "var j = 0;\n".
                    "while( pos == -1 && j < e ) {\n".
                        "if ( document.forms[i].elements[j].type == 'text' ) {\n".
                            "pos = j;\n".
                        "}\n".
                        "j++;\n".
                    "}\n".
                "i++;\n".
                "}\n".
                "if( pos >= 0 ) {\n".
                    "document.forms[i-1].elements[pos].focus();\n".
                "}\n".
            "}\n";
        $js .= "// -->\n".
        	 "</script>\n";
        $onload = 'onload="checkForm();"';
        displayHtmlHeader (_("Compose"), $js);
        break;   

    }

    echo "<body text=\"$color[8]\" link=\"$color[7]\" vlink=\"$color[7]\" alink=\"$color[7]\" $onload>\n\n";
}

?>
