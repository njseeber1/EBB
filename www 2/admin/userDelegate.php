<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetUserList(){
		$json = new JSON();
		include_once('bll/users.php');
		$user = new Users();
		$user->setCompanyId(1);
		$dtUserList = $user->GetUserList();
		$jsonResult->ColumnHeadings = array('User ID','User Name','E-mail Address',' ',' ');
		if(count($dtUserList) > 0) $jsonResult->Data = $dtUserList;
		return $json->serialize($jsonResult);
	}

	function GetUserDetails(){
		$json = new JSON();
		include_once('bll/users.php');
		$user = new Users();
		$user->setCompanyId(1);
		$user->setUId($_GET['uId']);
		$dtUser = $user->GetUserDetails();
		return $dtUser;
	}

	function UpdateUser(){
		include_once('bll/users.php');
		$user = new Users();
		$user->setUId($_POST['uId']);
		$user->setUserName($_POST['name']);
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$dtUser = $user->UpdateUser();
	}
	
	function SaveUser(){
		include_once('bll/users.php');
		$user = new Users();
		$user->setCompanyId(1);
		$user->setUserName($_POST['name']);
		$user->setEmail($_POST['email']);
		$user->setPassword($_POST['password']);
		$user->setStatus(1);
		$dtUser = $user->Save();
	}
	
	function DeleteUser(){
		include_once('bll/users.php');
		$user = new Users();
		$user->setUId($_GET['uId']);
		$user->DeleteUser();
	}
}
?>