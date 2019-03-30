<?php
/**
 * Module Header page
 *
 * @author Brian Peterson
 *
 * $Id: gpg_popup_header.php,v 1.1 2003/11/20 16:56:47 walter Exp $
 */
 
if (!defined (SM_PATH)){
    if (file_exists('./gpg_functions.php')){
        define (SM_PATH , '../../');
    } elseif (file_exists('../gpg_functions.php')){
        define (SM_PATH , '../../../');
    } elseif (file_exists('../plugins/gpg/gpg_functions.php')){
        define (SM_PATH , '../');
    } else echo "unable to define SM_PATH in gpg_module_header.php, exiting abnormally";
}
require_once(SM_PATH.'plugins/gpg/gpg_options_header.php');

/*
 * Function for easily bailing out on malformed requests.
 *
 * @param strign $err   Error String
 * @return void
 *
 */
function gpg_bail($err)
{
    echo '<font color=red><b>'
         . _("There was a problem with your request.")
         . _("Please try again.")
         . '<p><pre>';

//  print_r($err);
    echo '</pre><p></b></font>';
  //exit();
}

// call the main Squirrelmail page header function
//displayPageHeader($color, 'None');
    echo "<body text=\"$color[8]\" bgcolor=\"$color[4]\" link=\"$color[7]\" vlink=\"$color[7]\" alink=\"$color[7]\" $onload>\n\n";


/**
 * set the localization variables
 * Now tell gettext where the locale directory for your plugin is
 * this is in relation to the src/ directory
 */
bindtextdomain('gpg', SM_PATH . 'plugins/gpg/locale');
/* Switch to your plugin domain so your messages get translated */
textdomain('gpg');

if (! isset($err)) $err = array();

echo '<br>';
/**
 * $Log: gpg_popup_header.php,v $
 * Revision 1.1  2003/11/20 16:56:47  walter
 * - solution to SM header in menu popup window
 *
 *
 */
?>