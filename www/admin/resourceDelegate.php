<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetResourceList(){
		$json = new JSON();
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setCompanyId(1);
		$dtResourceList = $resource->GetResourceList();
		$jsonResult->ColumnHeadings = array('ID','Document Name',' ',' ');
		if(count($dtResourceList) > 0) $jsonResult->Data = $dtResourceList;
		return $json->serialize($jsonResult);
	}
	
	function GetResources(){
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setCompanyId(1);
		$dtResources = $resource->GetResources();
		return $dtResources;
	}

	function GetResourceDetails(){
		$json = new JSON();
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setCompanyId(1);
		$resource->setResourceId($_GET['resourceId']);
		$dtResourceDetails = $resource->GetResourceDetails();
		return $dtResourceDetails;
	}

	function UpdateResource(){
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setCompanyId(1);
		$resource->setResourceId($_POST['resourceId']);
		$resource->setDocumentName($_POST['documentName']);
		$resource->setDescription($_POST['description']);
		$resource->UpdateResource();
		if(isset($_FILES['document'])){
			if(is_uploaded_file($_FILES['document']['tmp_name'])) {
				if (!is_dir('../uploads/resources')) {
							mkdir('../uploads/resources');
				}
				$doc = $_FILES['document']['name'];
				$ext = pathinfo($doc, PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['document']['tmp_name'], '../uploads/resources/'.$_POST['documentName'].'.'.$ext);
				
				$resource->setContentType($ext);
				$resource->setResourceId($_POST['resourceId']);
				$resource->UpdateContentType();
			}
		}
	}
	
	function SaveResource(){
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setCompanyId(1);
		$resource->setDocumentName($_POST['documentName']);
		$resource->setDescription($_POST['description']);
		$resourceId = $resource->Save();
		if(isset($_FILES['document'])){
			if(is_uploaded_file($_FILES['document']['tmp_name'])) {
				if (!is_dir('../uploads/resources')) {
							mkdir('../uploads/resources');
				}
				$doc = $_FILES['document']['name'];
				$ext = pathinfo($doc, PATHINFO_EXTENSION);
				move_uploaded_file($_FILES['document']['tmp_name'], '../uploads/resources/'.$_POST['documentName'].'.'.$ext);
				
				$resource->setContentType($ext);
				$resource->setResourceId($resourceId);
				$resource->UpdateContentType();
			}
		}	
		
	}
	
	function DeleteResource(){
		include_once('bll/resources.php');
		$resource = new Resources();
		$resource->setResourceId($_GET['resourceId']);
		$resource->DeleteResource();
	}
}
?>