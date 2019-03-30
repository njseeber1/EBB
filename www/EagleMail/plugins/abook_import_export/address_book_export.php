<?php

define('SM_PATH', '../../');
require_once(SM_PATH . 'include/validate.php');
include_once(SM_PATH . 'functions/addressbook.php');

/*
 * Main Code
 *
 */

global $username;

$abook = addressbook_init(true,true);
$rows = $abook->list_addr();

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

header('Cache-control: private', false);
header('Content-Type: application/CSV');
if(preg_match('/MSIE 5.5/',$_ENV['HTTP_USER_AGENT']) ||
   preg_match('/MSIE 6.0/',$_ENV['HTTP_USER_AGENT'])) {
    header('Content-Disposition: filename="' . $username . '-addresses.csv"');
} else {
    header('Content-Disposition: attachment; filename="' . $username . '-addresses.csv"');
}

foreach($rows as $row) {
	echo implode(',', array_slice($row, 0, -2)) . "\n";
}

?>
