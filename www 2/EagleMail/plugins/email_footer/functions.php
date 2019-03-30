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



// this is pretty straight forward...
function email_footer_addition_do(&$argv)
{

    include_once (SM_PATH . 'plugins/email_footer/config.php');
    $email_footer = $enter_your_message_here;


    // if user is composing in HTML using the "html_mail" plugin, 
    // check for $enter_your_message_here_in_HTML and if not
    // available, turn linefeeds of regular footer into <br>'s
    //
    global $plugins, $footer_debug;
    if (in_array('html_mail',$plugins))
    {

        global $strip_html_send_plain;
        compatibility_sqextractGlobalVar('strip_html_send_plain');

        include_once(SM_PATH . 'plugins/html_mail/functions.php');
        if (!$strip_html_send_plain && html_area_is_on_and_is_supported_by_users_browser())
        {

            if (!empty($enter_your_message_here_in_HTML))
                $email_footer = $enter_your_message_here_in_HTML;

            else
                $email_footer = preg_replace("/(\015\012)|(\015)|(\012)/", '<br />', $email_footer);

        }

    }


    $message = &$argv[1];
    if (is_array($message->entities) && sizeof($message->entities) > 0)
       $message->entities[0]->body_part = $message->entities[0]->body_part . $email_footer;
    else
       $message->body_part = $message->body_part . $email_footer;


    if ($footer_debug) exit;
    return $message;


} // end email_footer_addition()



// lots of checks to make sure we're actually cleaning up the right stuff...
function email_footer_subtraction_do()
{  
     
    include_once (SM_PATH . 'plugins/email_footer/config.php');
    $email_footer = $enter_your_message_here;


    global $body;
 
    if ( !empty($body) && strlen(trim($body)) >= strlen(trim($email_footer)) && substr( $body, (-1 * strlen($email_footer)) ) == $email_footer )
        $body = substr( $body, 0, (-1 * strlen($email_footer)) );
        
} // end email_footer_subtraction()


?>
