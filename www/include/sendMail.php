<?php
function send($to, $from,$name, $subject, $message){
$headers = "Content-Type: text/html; charset=iso-8859-1\n Return-Path:<abraham@eaglebusinessbrokers.com>\r\n";
$cc = '';
if($result = mail($to, $subject, $message, $headers."From: ".$from."\r\nCc: ".$cc)){
	
	return true;
}else{
	return false;
}
}//function send
?>