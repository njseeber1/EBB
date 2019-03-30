<?php
session_start();
include_once('bll/users.php');
if($_POST['mode'] == 'admin'){
	$user = new Users();
	$user->setCompanyId(1);
	$user->setEmail($_POST['email']);
	$user->setPassword($_POST['password']);
	$dtUser= $user->Login();
	$drUser = $dtUser[0]; 
	//login failed
	if (count($drUser) < 1){
		// $user->setUserName('Adminstrator');
		// $user->setPassword('123456');
		// $user->setEmail('balu.m.v@gmail.com');
		// $result = $user->Save();
		if($result == 0)header('Location: login.php?error=login-failed');
		else echo 'User Created Successfully.';
	}else{
		$_SESSION['user']=$drUser;
		header('Location: dashboard.php');
	}
}
?>