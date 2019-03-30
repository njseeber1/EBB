<?php
session_start();
$user = $_SESSION['user'];
$host = $_SERVER['PHP_SELF'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	header('Location: dashboard.php');
	break;
}
?>