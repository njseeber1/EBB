<?php
include_once 'dal/clsDataTable.php';
include_once 'utils/stringHelper.php';
class Brokers extends DefaultTable
{
	var $brokerId;
	var $companyId;
	var $brokerName;
	var $status;
	var $errors;
    var $message;
	
	function Brokers()
	{
		$this->tableName = 'brokers';
        $this->rowsPerPage = 10;
        $this->fieldList = array('brokerId', 'companyId', 'brokerName', 'status');
        $this->fieldList['brokerId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setBrokerId($brokerId){
		$this->brokerId = $brokerId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setBrokerName($brokerName){
		$this->brokerName = PutEscapeSequence($brokerName);
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'brokerName'=>$this->brokerName,'status'=>$this->status);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->brokerId = $this->lastInsert;
			return $this->brokerId;
		}catch(Exception $ex) {
			return $this->brokerId;
		}
	}
	
	public function GetBrokersList(){
		$query = "SELECT brokerId, brokerName, CONCAT('<a href=\"frmBrokers.php?mode=Update&brokerId=',brokerId,'\">','Edit','</a>') AS editBroker, CONCAT('<a href=\"frmBrokers.php?mode=Delete&brokerId=',brokerId,'\">','Delete','</a>') AS deleteBroker  FROM brokers WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtBrokersList = $this->SqlQueryAll($query);
		return $dtBrokersList;
	}
	
	public function GetBrokers(){
		$query = "SELECT brokerId, brokerName FROM brokers WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtBrokers = $this->SqlQueryAll($query);
		return $dtBrokers;
	}
	
	public function GetBrokerDetails(){
		$query = "SELECT brokerId, brokerName FROM brokers WHERE brokerId = ".$this->brokerId;
		$this->prepareConnection();
		$dtBrokerDetails = $this->SqlQuery($query);
		return $dtBrokerDetails;
	}
	
	function UpdateBroker(){
		$fieldArray = array('brokerId'=>$this->brokerId,'brokerName'=>$this->brokerName);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteBroker(){
		$fieldArray = array('brokerId'=>$this->brokerId, 'status'=>0);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
}
?>