<?php
/* ***************************************************** */
/*       MAILING LIST MOD FOR OPEN REALTY 1.1.0+         */
/*                   VERSION 010904                      */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
global $email;
$lang['list_admin_link'] = "MailingList";
$lang['list_guest_link'] = "MailingList";
$lang['list_subscribe'] = "Subscribe";
$lang['list_unsubscribe'] = "UnSubscribe";
$lang['list_unsub_fail'] = "We can not find the email $email in our database.<br> Please recheck your entry.";
$lang['list_subscribe_confirm'] = "Your Subscription has been recieved.<br> A confirmation email has been sent to $email";
$lang['list_unsubscribe_confirm'] = "The email $email has been deleted from our mailing list<br>We hope there was no problem with our service, However if you feel there was <a href=\"mailto:$config[admin_email]\">please let us know</a> so the problem can be rectified.";
$lang['list_sub_fail'] = "your entry of $email was not accepted";
$lang['list_doubled_email'] = " becouse it is allready in our system.";
$lang['list_site_email'] = " becouse it is not your email.";
$lang['list_fake_email'] = " Becouse Its An Obvious Fake.";
$lang['list_submit'] = "Submit your Email";
$lang['list_admin_mail_subject'] = "Our Latest Listings";
$lang['list_admin_mail_info'] = "Message To Be Sent";
//deletion link added to all emails (THE LAW SAYS IT MUST BE THERE)
$lang['list_mail_removeme'] ="\n\nIf you no longer require this free service please click this link to be removed instantly\n\n$config[baseurl]/list_public.php?action=delete&email=$email";
//message applies to all emails sent
$lang['list_admin_mail_message'] = "You have recieved this email becouse you subscribed to our mailing list to recieve The latest listings from $config[site_title] \n If you no longer require this service please use the link at the bottom of this email. ";
// this message is sent on subscription to the list
$lang['list_subscribe_email'] = "Thankyou for becoming part of our mailing list. \n ";
?>
