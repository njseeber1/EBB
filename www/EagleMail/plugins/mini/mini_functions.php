<?php

/*
 * mini_functions.php
 * Some functions for the mini plugin
 */

/* returns the text entity of the message or an explination about why it could not */
function mini_message ($id, $mailbox) {
    /* get the vars we need */
    global $imapServerAddress, $imapPort, $color, $data_dir,
           $username, $version, $uid_support;
    $delimiter = $_SESSION['delimiter'];
    $key = $_COOKIE['key'];
    $username = $_SESSION['username'];
    $onetimepad = $_SESSION['onetimepad'];
    
    /* set the text size stuff */
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
        $trim_to -= 12;
    }

    /* connect to imap */
    $imapConn = sqimap_login($username, $key, $imapServerAddress, 
                                     $imapPort, 10, $onetimepad);

    /* select the mailbox errors set to true */
    sqimap_mailbox_select($imapConn, $mailbox, true, false, false);

    /* get the message structure */
    $details = sqimap_get_message($imapConn, $id, $mailbox);
    $nogo = '';
    $ent = '1';

    /* account for changes in the message object */
    if (substr($version, 2,4) > 3.1) {
        $type_1 = $details->type0;
        $type_2 = $details->entities[0]->type0;
        $type_3 = $details->entities[0]->entities[0]->type0;
    }
    else {
        $type_1 = $details->header->type0;
        $type_2 = $details->entities[0]->header->type0;
        $type_3 = $details->entities[0]->entities[0]->header->type0;
    }
    /* here is the check for text parts */
    switch ($type_1) {
        case 'multipart':
            $mini_extra = "$bsm<b>".
                          'This message has additional parts '.
                          'please use<br>the main SquirrelMail'.
                          ' interface to open them</b>'.
                          "$esm</td></tr>";
            if ($type_2 != 'text' && $type_3 != 'text') {
                $nogo = '<tr><td align=center>'."$bsm<b>".
                    'Could not find a text part so please '.
                    'use the main<br>SquirrelMail window to read this message'."$esm";
            } 
            elseif ($type_3 == 'text') {
                $ent = '1.1';
            }
            break;
        case 'text':
            $mini_extra = '</td></tr>';
            break;
        default:
            $nogo = "$bsm<b>".
                    'Could not find a text part so please '.
                    'use the main<br>SquirrelMail window to read this message'."$esm";
            break; 
    }
    if (!empty($nogo)) {
        return $nogo;
    }
    
    /* if we made it here then lets get the message body */
    $sid = sqimap_session_id($uid_support);
    $query = $sid." FETCH $id BODY[$ent]\r\n";
    fputs ($imapConn, $query);
    $response = sqimap_read_data_list($imapConn, $sid, 
                           true, $resonses, $message); 
    array_shift($response[0]);
    $body = join("", $response[0]);
    $response = $mini_extra."<tr><td bgcolor=\"$color[4]\">$bsm<pre>".
                htmlentities($body)."</pre>$esm\n";
    return $response;
}

/* returns a list of folders with the message numbers of mail that is new */
function get_mini_list($imapConn) {
    global $trash_folder, $uid_support;
    $boxes = sqimap_mailbox_list($imapConn);
    $box_count = count($boxes);
    $parent_unseen = 0;
    $results = array();
    
    /* loop through the folders and get the unseen message numbers */
    for ($i=0;$i<$box_count;$i++) {
        $cur_box = $boxes[$i]['unformatted'];
        $length = strlen($cur_box);
        $message = '';
        $search_response = array();
        $responses = array(); 

        /* if it is selectable search for unseen */
        if (!preg_match("/NoSelect/i", $boxes[$i]['raw']) &&
            !strstr($boxes[$i]['unformatted'], $trash_folder)) {

            /* do a status of the folder to see if we should select it for searching */
            $sid = sqimap_session_id($uid_suport);
            $query = $sid." STATUS \"$cur_box\" (MESSAGES UNSEEN)\r\n";
            fputs ($imapConn, $query);
            $status_response = sqimap_read_data_list($imapConn, $sid, 
                                              true, $responses, $message); 
            if (preg_match("/^\*\sSTATUS\s.+\d+\)/", $status_response[0][0], $regs)) {

                /* select the mailbox */
                sqimap_mailbox_select($imapConn, $cur_box, true, false, false);

                /* do the search */
                $message = '';
                $responses = array(); 
                $sid = sqimap_session_id($uid_support);
                $query = $sid." SEARCH UNSEEN UNSEEN\r\n";
                fputs ($imapConn, $query);
                $search_response = sqimap_read_data_list($imapConn, $sid, 
                                              true, $responses, $message); 
                if (preg_match("/^\*\sSEARCH\s(.+)/", $search_response[0][0], $regs)) {
                    $new_ids = explode(" ", $regs[1]);
                    $results[$boxes[$i]['unformatted']] = $new_ids;
                }
            }
        }
    }
    return $results;
}

/* gets the subject and from for a list of messges */
function get_mini_headers ($imapConn, $mailbox, $ids) {
    /* get some vars */
    global $username, $data_dir, $uid_support;
    $mini_width = getPref($data_dir, $username, 'mini_width', '380');
    $mini_text_size = getPref($data_dir, $username, 'mini_text_size', '1');
    $trim_to = intval((.098*$mini_width));  
    if ($mini_text_size == '1') {
        $bsm = "<small>";
        $esm = "</small>";
        $trim_to -= 5;
    }
    elseif ($mini_text_size == '0') {
        $bsm = "<small><small>";
        $esm = "</small></small>";
    }
    elseif ($mini_text_size == '2') {
        $bsm = "";
        $esm = "";
        $trim_to -= 10;
    }

    /* select the mailbox */
    sqimap_mailbox_select($imapConn, $mailbox, true, false, false);

    /* fetch each message one at a time */
    foreach($ids as $value) {
        $responses = array();
        $message = '';
        $sid = sqimap_session_id($uid_support);
        $query = $sid." FETCH ".trim($value)." ".
                    "BODY.PEEK[HEADER.FIELDS (SUBJECT FROM)]\r\n";
        fputs ($imapConn, $query);
        $fetch_results = sqimap_read_data_list($imapConn, $sid, 
                            true, $responses, $message); 

        /* get the subject and from and do some formatting */
        if (preg_match("/^Subject/i", $fetch_results[0][1])) {
            $full_subject = $fetch_results[0][1];
            $full_from = $fetch_results[0][2];
            $subject = substr($fetch_results[0][1],0,$trim_to);
            $from = substr($fetch_results[0][2],0,($trim_to-5));
        }
        else {
            $full_subject = $fetch_results[0][2];
            $full_from = $fetch_results[0][1];
            $subject = substr($fetch_results[0][2],0,$trim_to);
            $from = substr($fetch_results[0][1],0,($trim_to-5));
        }
        if (strlen(trim(substr($subject,8))) == 0) {
            $subject = 'XXXXXXXX(No Subject)';
            $full_subject = $subject;
        }
        if (strlen($from) == ($trim_to-5)) {
            $from .= "...";
        }
        if (strlen($subject) == $trim_to) {
            $subject .= '...';
            $header_results = " title=\"$full_subject\">";
        }
        else {
            $header_results = ">";
        }

        /* build th eresult */
        $header_results .= htmlentities(trim(substr($subject,8))).
                          "</a>$esm</td><td width=\"50%\">".
                          "$bsm<a title=\"".htmlentities($full_from)."\">".
                          htmlentities(trim(substr($from,5)))."</a>";
        $results[$value] = $header_results; 
    }
    //$results = array_reverse($results);
    return $results;   
}
?>
