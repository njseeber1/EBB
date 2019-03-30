<?php
include('mailHelper.php');

function send($to, $from,$name, $subject, $message){
	return mailHelper::sendMail($to, $from,$name, $subject, $message);
}//function send
?>