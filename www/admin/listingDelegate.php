<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	include_once('include/json.php');
	function GetListings(){
		$json = new JSON();
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setCompanyId(1);
		$dtListings = $listing->GetListings();
		$jsonResult->ColumnHeadings = array('ID','Date', 'Title',' ',' ');
		if(count($dtListings) > 0) $jsonResult->Data = $dtListings;
		return $json->serialize($jsonResult);
	}

	function GetListingDetails(){
		$json = new JSON();
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setCompanyId(1);
		$listing->setListingId($_GET['listingId']);
		$dtListingDetails = $listing->GetListingDetails();
		return $dtListingDetails;
	}
	
	function GetTopListings(){
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setCompanyId(1);
		$dtTopListings = $listing->GetTopListings();
		return $dtTopListings;
	}

	function UpdateListing(){
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setCompanyId(1);
		$listing->setListingId($_POST['listingId']);
		$listing->setListingDate($_POST['listingDate']);
		$listing->setStatus($_POST['status']);
		$listing->setPriority($_POST['priority']);
		$listing->setRemarks($_POST['remarks']);
		$listing->setTitle($_POST['title']);
		$listing->setCategory($_POST['category']);
		$listing->setClassification($_POST['classification']);
		$listing->setLocation($_POST['location']);
		$listing->setCity($_POST['city']);
		$listing->setArea($_POST['area']);
		$listing->setRent($_POST['rent']);
		$listing->setListPrice($_POST['listPrice']);
		$listing->setAnnualSales($_POST['annualSales']);
		$listing->setInventory($_POST['inventory']);
		$listing->setGrossIncome($_POST['grossIncome']);
		$listing->setYearEstablished($_POST['yearEstablished']);
		$listing->setBrokerId($_POST['brokerId']);
		$listing->setDescription($_POST['description']);
		$listing->setLocationLink($_POST['locationLink']);
		$listing->setListRank($_POST['listRank']);		
		$listing->UpdateListing();
		if(isset($_FILES['listingImage'])){ 
			if(is_uploaded_file($_FILES['listingImage']['tmp_name'])) {
				if (!is_dir('../uploads/listings')) { 
							mkdir('../uploads/listings');
				}echo 'listing image';
				move_uploaded_file($_FILES['listingImage']['tmp_name'], '../uploads/listings/listing_'.$_POST['listingId'].'.jpg');
			}
		}
		if(isset($_FILES['brochure'])){
			if(is_uploaded_file($_FILES['brochure']['tmp_name'])) {
				if (!is_dir('../uploads/downloads')) {
							mkdir('../uploads/downloads');
				}
				move_uploaded_file($_FILES['brochure']['tmp_name'], '../uploads/downloads/brochure_'.$_POST['listingId'].'.pdf');
			}
		}
	}
	
	function SaveListing(){
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setCompanyId(1);
		$listing->setListingDate($_POST['listingDate']);
		$listing->setStatus($_POST['status']);
		$listing->setPriority($_POST['priority']);
		$listing->setRemarks($_POST['remarks']);
		$listing->setTitle($_POST['title']);
		$listing->setCategory($_POST['category']);
		$listing->setClassification($_POST['classification']);
		$listing->setLocation($_POST['location']);
		$listing->setCity($_POST['city']);
		$listing->setArea($_POST['area']);
		$listing->setRent($_POST['rent']);
		$listing->setListPrice($_POST['listPrice']);
		$listing->setAnnualSales($_POST['annualSales']);
		$listing->setInventory($_POST['inventory']);
		$listing->setGrossIncome($_POST['grossIncome']);
		$listing->setYearEstablished($_POST['yearEstablished']);
		$listing->setBrokerId($_POST['brokerId']);
		$listing->setDescription($_POST['description']);
		$listing->setLocationLink($_POST['locationLink']);
		$listing->setListRank($_POST['listRank']);		
		$listingId = $listing->Save();
		if(isset($_FILES['listingImage'])){
			if(is_uploaded_file($_FILES['listingImage']['tmp_name'])) {
				if (!is_dir('../uploads/listings')) {
							mkdir('../uploads/listings');
				}
				move_uploaded_file($_FILES['listingImage']['tmp_name'], '../uploads/listings/listing_'.$listingId.'.jpg');
			}
		}
		if(isset($_FILES['brochure'])){
			if(is_uploaded_file($_FILES['brochure']['tmp_name'])) {
				if (!is_dir('../uploads/downloads')) {
							mkdir('../uploads/downloads');
				}
				move_uploaded_file($_FILES['brochure']['tmp_name'], '../uploads/downloads/brochure_'.$listingId.'.pdf');
			}
		}
	}
	
	function DeleteListing(){
		include_once('bll/listings.php');
		$listing = new Listings();
		$listing->setListingId($_GET['listingId']);
		$listing->DeleteListing();
	}
}
?>