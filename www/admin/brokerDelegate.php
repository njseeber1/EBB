<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetBrokerList(){
		$json = new JSON();
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setCompanyId(1);
		$dtBrokerList = $broker->GetBrokersList();
		$jsonResult->ColumnHeadings = array('ID','Broker Name',' ',' ');
		if(count($dtBrokerList) > 0) $jsonResult->Data = $dtBrokerList;
		return $json->serialize($jsonResult);
	}
	
	function GetBrokers(){
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setCompanyId(1);
		$dtBrokers = $broker->GetBrokers();
		return $dtBrokers;
	}

	function GetBrokerDetails(){
		$json = new JSON();
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setCompanyId(1);
		$broker->setBrokerId($_GET['brokerId']);
		$dtBrokerDetails = $broker->GetBrokerDetails();
		return $dtBrokerDetails;
	}

	function UpdateBroker(){
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setCompanyId(1);
		$broker->setBrokerId($_POST['brokerId']);
		$broker->setBrokerName($_POST['brokerName']);
		$broker->UpdateBroker();
	}
	
	function SaveBroker(){
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setCompanyId(1);
		$broker->setBrokerName($_POST['brokerName']);
		$broker->setStatus(1);
		$brokerId = $broker->Save();
	}
	
	function DeleteBroker(){
		include_once('bll/brokers.php');
		$broker = new Brokers();
		$broker->setBrokerId($_GET['brokerId']);
		$broker->DeleteBroker();
	}
}
?>