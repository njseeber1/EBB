<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetOfficeList(){
		$json = new JSON();
		include_once('bll/offices.php');
		$office = new Offices();
		$office->setCompanyId(1);
		$dtOfficeList = $office->GetOfficeList();
		$jsonResult->ColumnHeadings = array('Office ID','Company Name','Location',' ',' ');
		if(count($dtOfficeList) > 0) $jsonResult->Data = $dtOfficeList;
		return $json->serialize($jsonResult);
	}

	function GetOfficeDetails(){
		$json = new JSON();
		include_once('bll/offices.php');
		$office = new Offices();
		$office->setCompanyId(1);
		$office->setOfficeId($_GET['officeId']);
		$dtOffice = $office->GetOfficeDetails();
		return $dtOffice;
	}

	function UpdateOffice(){
		include_once('bll/offices.php');
		$office = new Offices();
		$office->setCompanyId(1);
		$office->setOfficeId($_POST['officeId']);
		$office->setOfficeName($_POST['officeName']);
		$office->setLocation($_POST['location']);
		$office->setAddress($_POST['address']);
		$office->setEmail($_POST['email']);
		$office->setPhone($_POST['phone']);
		$office->setFax($_POST['fax']);
		$office->UpdateOffice();
	}
	
	function SaveOffice(){
		include_once('bll/offices.php');
		$office = new Offices();
		$office->setCompanyId(1);
		$office->setOfficeName($_POST['officeName']);
		$office->setLocation($_POST['location']);
		$office->setAddress($_POST['address']);
		$office->setEmail($_POST['email']);
		$office->setPhone($_POST['phone']);
		$office->setFax($_POST['fax']);
		$office->setStatus(1);
		$dtOffice = $office->Save();
	}
	
	function DeleteOffice(){
		include_once('bll/offices.php');
		$office = new Offices();
		$office->setOfficeId($_GET['officeId']);
		$office->DeleteOffice();
	}
}
?>