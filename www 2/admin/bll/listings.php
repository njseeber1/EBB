<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root.'/admin/dal/clsDataTable.php';
include_once $root.'/admin/utils/stringHelper.php';
class Listings extends DefaultTable
{
	var $listingId;
	var $companyId;
	var $listingDate;
	var $status;
	var $priority;
	var $remarks;
	var $title;
	var $category;
	var $classification;
	var $location;
	var $city;
	var $area;
	var $rent;
	var $listPrice;
	var $annualSales;
	var $inventory;
	var $grossIncome;
	var $yearEstablished;
	var $brokerId;
	var $description;
	var $locationLink;
	var $listRank;
	var $type;
	var $count;
	
		
	function Listings()
	{
		$this->tableName = 'listings';
        $this->rowsPerPage = 10;
        $this->fieldList = array('listingId', 'companyId',  'listingDate','status', 'priority', 'remarks', 'title', 'category', 'classification', 'location', 'city', 'area', 'rent', 'listPrice', 'annualSales', 'inventory', 'grossIncome', 'yearEstablished', 'brokerId', 'description', 'locationLink', 'listRank', 'type', 'count');
        $this->fieldList['listingId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setCount($count){
		$this->count = $count;
	}
	public function setType($type){
		$this->type = $type;
	}
	public function setListingId($listingId){
		$this->listingId = $listingId;
	}	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}	
	public function setListingDate($listingDate){
		$this->listingDate = $listingDate;
	}
	public function setStatus($status){
		$this->status = $status;
	}
	public function setPriority($priority){
		$this->priority = $priority;
	}
	public function setRemarks($remarks){
		$this->remarks = PutEscapeSequence($remarks);
	}
	public function setTitle($title){
		$this->title = PutEscapeSequence($title);
	}
	public function setCategory($category){
		$this->category = $category;
	}
	public function setClassification($classification){
		$this->classification = $classification;
	}
	public function setLocation($location){
		$this->location = PutEscapeSequence($location);
	}
	public function setCity($city){
		$this->city = PutEscapeSequence($city);
	}
	public function setArea($area){
		$this->area = PutEscapeSequence($area);
	}
	public function setRent($rent){
		$this->rent = PutEscapeSequence($rent);
	}
	public function setListPrice($listPrice){
		$this->listPrice = PutEscapeSequence($listPrice);
	}
	public function setAnnualSales($annualSales){
		$this->annualSales = PutEscapeSequence($annualSales);
	}
	public function setInventory($inventory){
		$this->inventory = PutEscapeSequence($inventory);
	}
	public function setGrossIncome($grossIncome){
		$this->grossIncome = PutEscapeSequence($grossIncome);
	}
	public function setYearEstablished($yearEstablished){
		$this->yearEstablished = PutEscapeSequence($yearEstablished);
	}
	public function setBrokerId($brokerId){
		$this->brokerId = $brokerId;
	}
	public function setDescription($description){
		$this->description = PutEscapeSequence($description);
	}	
	public function setLocationLink($locationLink){
		$this->locationLink = PutEscapeSequence($locationLink);
	}
	public function setListRank($listRank){
		$this->listRank = $listRank;
	}
	
	//------------------------------------
	
	public function Save(){
		$this->listingId = 0;
		try{
			$fieldArray = array('companyId'=>$this->companyId,'listingDate'=>$this->listingDate,'status'=>$this->status,'priority'=>$this->priority,'remarks'=>$this->remarks,'title'=>$this->title,'category'=>$this->category,'classification'=>$this->classification,'location'=>$this->location,'city'=>$this->city,'area'=>$this->area,'rent'=>$this->rent,'listPrice'=>$this->listPrice,'annualSales'=>$this->annualSales,'inventory'=>$this->inventory,'grossIncome'=>$this->grossIncome,'yearEstablished'=>$this->yearEstablished,'brokerId'=>$this->brokerId,'description'=>$this->description,'locationLink'=>$this->locationLink);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->listingId = $this->lastInsert;
			return $this->listingId;
		}catch(Exception $ex) {
			return $this->listingId;
		}
	}
	
	public function GetListings(){
		$query = "SELECT listingId, listingDate, title, CONCAT('<a href=\"frmListings.php?mode=Update&listingId=',listingId,'\">','Edit','</a>') AS editListing, CONCAT('<a href=\"frmListings.php?mode=Delete&listingId=',listingId,'\">','Delete','</a>') AS deleteListing  FROM listings WHERE companyId = ".$this->companyId." ORDER BY listingDate DESC ";
		$this->prepareConnection();
		$dtListing = $this->SqlQueryAll($query);
		return $dtListing;
	}
	
	public function GetTopListings(){
		$this->rowsPerPage = 4;
		$query = "SELECT *, CONCAT((CASE category WHEN 1 THEN 'For Sale:' WHEN 2 THEN 'For Lease:' ELSE 'For Sale/Lease:' END), ' ', title) AS title, description
		FROM listings WHERE companyId = ".$this->companyId." AND status != 3  ORDER BY listRank, priority, listingDate DESC";
		$this->prepareConnection();
		$dtTopListing = $this->SqlQuery($query);
		return $dtTopListing;
	}
	
	public function GetTopSoldListings(){
		$this->rowsPerPage = 4;
		$query = "SELECT listingId, title, description
		FROM listings WHERE companyId = ".$this->companyId." AND status = 3 ORDER BY listRank, priority, listingDate DESC";
		$this->prepareConnection();
		$dtTopListing = $this->SqlQuery($query);
		return $dtTopListing;
	}
	
	public function GetCurrentListings($json = false){
		$filter = '';
		if($this->listingId != '') $filter .= ' AND l.listingId = '.$this->listingId;
		if($this->category != 0) $filter .= ' AND l.category = '.$this->category;
		if($this->classification != 0) $filter .= ' AND l.classification = '.$this->classification;
		$query = "SELECT l.listingId, l.count, l.listingDate, l.title, l.location, l.city, l.area, l.rent, l.listPrice, l.annualSales, l.inventory, l.grossIncome, l.yearEstablished, b.brokerName, l.description, l.locationLink, l.classification, l.type
		FROM listings AS l
		LEFT JOIN brokers AS b ON l.brokerId = b.brokerId 
		WHERE l.companyId = ".$this->companyId." AND l.status != 3 ".$filter." ORDER BY l.listRank, l.priority, l.listingDate DESC";
		$this->prepareConnection();
		$dtCurrentListings = $this->SqlQueryAll($query);
		if($json)
			return json_encode($dtCurrentListings);
		else
			return $dtCurrentListings;
	}
	
	public function GetSoldListings($json = false){
		$filter = '';
		if($this->listingId != '') $filter .= ' AND l.listingId = '.$this->listingId;
		if($this->classification != 0) $filter .= ' AND l.classification = '.$this->classification;
		if(!is_null($this->type)) $filter .= " AND l.type = '$this->type' ";
		$query = "SELECT l.listingId, l.classification, l.listingDate, l.title, l.location, l.city, l.area, l.rent, l.listPrice, l.annualSales, l.inventory, l.grossIncome, l.yearEstablished, b.brokerName, l.description, l.locationLink, l.type
		FROM listings AS l
		LEFT JOIN brokers AS b ON l.brokerId = b.brokerId 
		WHERE l.companyId = ".$this->companyId." AND l.status = 3 ".$filter." ORDER BY l.listRank, l.priority, l.listingDate DESC";
		$this->prepareConnection();
		$dtSoldListings = $this->SqlQueryAll($query);
		if($json)
			return json_encode($dtSoldListings);
		else
			return $dtSoldListings;
	}
	
	public function GetListingDetails(){
		$query = "SELECT listingId, companyId, listingDate, status, priority, remarks, title, category, classification, location, city, area, rent, listPrice, annualSales, inventory, grossIncome, yearEstablished, brokerId, description, locationLink, listRank
		FROM listings WHERE listingId = ".$this->listingId;
		$this->prepareConnection();
		$dtListingDetails = $this->SqlQuery($query);
		return $dtListingDetails;
	}
	
	public function UpdateListing(){
		$fieldArray = array('listingId'=>$this->listingId,'listingDate'=>$this->listingDate,'status'=>$this->status,'priority'=>$this->priority,'remarks'=>$this->remarks,'title'=>$this->title,'category'=>$this->category,'classification'=>$this->classification,'location'=>$this->location,'city'=>$this->city,'area'=>$this->area,'rent'=>$this->rent,'listPrice'=>$this->listPrice,'annualSales'=>$this->annualSales,'inventory'=>$this->inventory,'grossIncome'=>$this->grossIncome,'yearEstablished'=>$this->yearEstablished,'brokerId'=>$this->brokerId,'description'=>$this->description,'locationLink'=>$this->locationLink, 'count'=>$this->count);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}

	public function Increment(){
		$fieldArray = array('listingId'=>$this->listingId,'count'=>$this->count);
		$this->prepareConnection();
		echo $this->Update($fieldArray);
	}
	
	function DeleteListing(){
		$fieldArray = array('listingId'=>$this->listingId);
		$this->prepareConnection();
		$this->Delete($fieldArray);
	}

	public function getCount($id){
		$query = "SELECT l.count FROM listings AS l WHERE l.id = $id";
		$this->prepareConnection();
		$count = $this->SqlQueryAll($query);
		return $count;
	}
}
?>
