<?php
  /**
   **  Email Footer (email_footer) v0.3.0
   **
   **  By Ray Black III <allah@accessnode.net>
   **  Changes By Paul Lesneiwski <pdontthink@angryners.com>
   **  (c) 2001 (GNU GPL - see ../../COPYING)
   **
   **  This plugin lets site operators set a default footer for
   **  all emails sent using their installation of SquirrelMail.
   **  
   **  To change the footer message, see the config.php file.
   **/


function squirrelmail_plugin_init_email_footer()
{
    global $squirrelmail_plugin_hooks;

    $squirrelmail_plugin_hooks['compose_send']['email_footer']
            = 'email_footer_addition';
// why do we need this??
//    $squirrelmail_plugin_hooks['compose_form']['email_footer']
//            = 'email_footer_subtraction';

} // end squirrelmail_plugin_init_email_footer()


function email_footer_version()
{

   return '0.3';

}


function email_footer_addition(&$argv)
{

    if (defined('SM_PATH'))
       include_once(SM_PATH . 'plugins/email_footer/functions.php');
    else
       include_once('../plugins/email_footer/functions.php');

    return email_footer_addition_do($argv);

}


function email_footer_subtraction()
{  
     
    if (defined('SM_PATH'))
       include_once(SM_PATH . 'plugins/email_footer/functions.php');
    else
       include_once('../plugins/email_footer/functions.php');

    email_footer_subtraction_do();
        
}


?>
