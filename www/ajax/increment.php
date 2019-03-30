<?php 
//	error_reporting(E_ALL);
//	ini_set('display_errors', 1);
	$root = $_SERVER['DOCUMENT_ROOT'];
	include_once($root.'/admin/bll/listings.php');

	$listing = new Listings();
	$listing->setCompanyId(1);

	$postdata = file_get_contents("php://input");
	$data = json_decode($postdata, true);
	
	$listing->setListingId($data["id"]);

	$l = $listing->GetCurrentListings(false);
	$count = $l[0]->count;
	$newL = new Listings();
	$newL->setListingId($data["id"]);
	$newL->setCount(($count + 1));
	$newL->Increment();
?>