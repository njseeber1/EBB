<?php
#	error_reporting(E_ALL);
#	ini_set('display_errors', 1);
	$root = $_SERVER['DOCUMENT_ROOT'];
	include_once($root.'/admin/bll/listings.php');

	$listing = new Listings();
	$listing->setCompanyId(1);
	if($_GET['status'] == 'sold'){
		$dtListings = $listing->GetSoldListings(true);
		echo $dtListings;
	}
	else if($_GET['status'] == 'current'){
		$dtListings = $listing->GetCurrentListings(true);
		echo $dtListings;
	}
?>