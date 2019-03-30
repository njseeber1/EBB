<?php
include_once 'dal/clsDataTable.php';
include_once 'utils/stringHelper.php';
class Offices extends DefaultTable
{
	var $officeId;
	var $companyId;
	var $officeName;
	var $location;
	var $address;
	var $email;
	var $phone;
	var $fax;
	var $status;
	var $googleMapLink;
	var $errors;
    var $message;

	function Offices()
	{
		$this->tableName = 'offices';
        $this->rowsPerPage = 10;
        $this->fieldList = array('officeId', 'companyId', 'officeName', 'location', 'address', 'email', 'phone', 'fax', 'status','googleMapLink');
        $this->fieldList['officeId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setOfficeId($officeId){
		$this->officeId = $officeId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setOfficeName($officeName){
		$this->officeName = PutEscapeSequence($officeName);
	}
	
	public function setLocation($location){
		$this->location = PutEscapeSequence($location);
	}
	
	public function setAddress($address) {
        $this->address = PutEscapeSequence($address);
	}
	
	public function setEmail($email){
		$this->email = PutEscapeSequence($email);
	}
	
	public function setPhone($phone){
		$this->phone = PutEscapeSequence($phone);
	}
	
	public function setFax($fax){
		$this->fax = PutEscapeSequence($fax);
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
	
	public function setGoogleMapLink($googleMapLink){
		$this->googleMapLink = $googleMapLink;
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'officeName'=>$this->officeName,'location'=>$this->location,'address'=>$this->address,  'email'=>$this->email, 'phone'=>$this->phone, 'fax'=>$this->fax,'status'=>$this->status);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->officeId = $this->lastInsert;
			return $this->officeId;
		}catch(Exception $ex) {
			return $this->officeId;
		}
	}
	
	public function GetOfficeList(){
		$query = "SELECT officeId, officeName, location, CONCAT('<a href=\"frmOffice.php?mode=Update&officeId=',officeId,'\">','Edit','</a>') AS editOffice, CONCAT('<a href=\"frmOffice.php?mode=Delete&officeId=',officeId,'\">','Delete','</a>') AS deleteOffice  FROM offices WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtOfficeList = $this->SqlQueryAll($query);
		return $dtOfficeList;
	}
	
	public function GetOfficeDetails(){
		$query = "SELECT officeId, companyId, officeName, location, address, email, phone, fax  FROM offices WHERE officeId = ".$this->officeId;
		$this->prepareConnection();
		$dtOfficeDetails = $this->SqlQuery($query);
		return $dtOfficeDetails;
	}
	
	function UpdateOffice(){
		$fieldArray = array('officeId'=>$this->officeId,'officeName'=>$this->officeName,'location'=>$this->location,'address'=>$this->address,  'email'=>$this->email, 'phone'=>$this->phone, 'fax'=>$this->fax);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteOffice(){
		$fieldArray = array('officeId'=>$this->officeId, 'status'=>0);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	public function GetCompanyOffices(){
		$query = "SELECT officeId, officeName, UPPER(location) AS location, address, email, phone, fax, googleMapLink  FROM offices WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtOffices = $this->SqlQueryAll($query);
		return $dtOffices;
	}
}
?>