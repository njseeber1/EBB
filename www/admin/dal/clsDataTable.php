<?php
/*
* @version  11/07/2009 Balu.M.V
* @copyright (c) 2009 COG Studios
*/
include_once 'clsConnection.php';
class DefaultTable
{
  	var $tableName; // table name
  	var $rowsPerPage;// used in pagination
  	var $pageNo; // current page number
  	private $lastPage; // highest page number
  	var $fieldList; // list of fields in this table
	private $totalRows; // total number of rows
  	private $dataArray; // data from the database
	var $sqlMessage; // Message for the user
	private $inTransaction; //flag to indicate db connection is in transaction
  	var $query      		= NULL;
	var $errors; // array of error messages
	var $message; // Message for the user
	private $mysqli;
	var $lastInsert;
	var $trackingFlag; //for Debugging
	var $isolationLevel; // Isolation Level for Transaction
	
	function DefaultTable(){
    	$this->tableName = 'default';
    	$this->rowsPerPage = 10;
    	$this->fieldList = array('column1', 'column2', 'column3');
    	$this->fieldList['column1'] = array('pkey' => 'y');
  	} // constructor
	
	// Properties
	public function getTrackingFlag(){
		return $this->trackingFlag;
	}
	
	public function setTrackingFlag($flag){
		$this->trackingFlag = $flag;
	}
	
    public function getRowsPerPage() {
        return $this->rowsPerPage;
    }//get RowsPerPage
		
    public function getPageNo() {
        return $this->pageNo;
    }//get PageNo
    public function setPageNo($pageNo) {
        $this->pageNo = $pageNo;
	}//set PageNo

    public function getLastPage() {
        return $this->lastPage;
    }//get LastPage
		
    public function getTotalRows() {
        return $this->totalRows;
    }//get TotalRows
	
    public function getSqlMessage() {
        return $this->sqlMessage;
    }//get TotalRows
	
	public function getMysqli(){
		return $this->mysqli;
	}//getMysqli
	
	public function setMysqli($mysqli){
		$this->inTransaction = true;
		$this->mysqli = $mysqli;
	}
	
	public function prepareConnection(){
		if($this->mysqli == NULL){
			$connection = new connection();
			$this->mysqli = $connection->GetMysqli();
			$this->inTransaction = false;
		}
	}//prepareConection
	
	public function setIsolationLevel($level){
		$this->isolationLevel = $level;
	}
	
	public function setTransaction($mysqli){
		$this->mysqli = $mysqli;
		$this->inTransaction = true;
	}//setTransaction
	
	public function startTransaction(){
		if($this->mysqli == NULL){
			$connection = new connection();
			$this->mysqli = $connection->GetMysqli();
		}
		$this->mysqli->startTransaction();
		$this->inTransaction = true;
		if($this->isolationLevel != ''){
				$this->Query("SET TRANSACTION ISOLATION LEVEL ".$this->isolationLevel);
		}
		//return $this->mysqli;
	}//startTransaction
	
	public function rollBack(){
		$this->mysqli->rollback();
		$this->inTransaction = false;
		$this->close();
	}//rollBack
	
	public function commit(){
		$this->mysqli->commit();
		$this->inTransaction = false;
		$this->close();
	}//commit
	
   function Select($fields, $where){
   		if(empty($fields )){
			$fields = '*';
		}//if  		
		if (empty($where)) {
         	$where = NULL;
      	} else {
         	$where = " WHERE ". $where;
      	} // if
		$query = "SELECT ".$fields." FROM ".$this->tableName." ". $where;
		$result = $this->mysqli->query_page_all($query, $this->rowsPerPage, $this->pageNo);
		$this->totalRows = $this->mysqli->query_total();
		$this->noOfRows  =  $this->totalRows;
		if ($this->rowsPerPage > 0) {
         	$this->lastPage = ceil($this->totalRows/$this->rowsPerPage);
      	} else {
         	$this->lastPage = 1;
      	} // if
		$this->close();
		return $result;
   } // select
   
   function SelectAll($fields, $where, $orderBy, $asc){
   		if(empty($fields )){
			$fields = '*';
		}//if  		
		if (empty($where)) {
         	$where = NULL;
      	} else {
         	$where = " WHERE ". $where;
      	} // if
		if($asc)
		{
			$order = ' ORDER BY '.$orderBy.' ASC';
		}
		else
		{
			$order = ' ORDER BY '.$orderBy.' DESC';
		}//if
		$query = "SELECT ".$fields." FROM ".$this->tableName." ". $where. " ". $order;
		$result = $this->mysqli->query_all($query);
		$this->close();
		return $result;
   } // select
   
   function SqlQuery($query){
   		$query = $query;
		$result = $this->mysqli->query_page_all($query, $this->rowsPerPage, $this->pageNo);
		$this->totalRows = $this->mysqli->query_total();
		$this->noOfRows  =  $this->totalRows;
		if ($this->rowsPerPage > 0) {
         	$this->lastPage = ceil($this->totalRows/$this->rowsPerPage);
      	} else {
         	$this->lastPage = 1;
      	} // if
		$this->close();
		return $result;
   } // SqlQuery
   
   function SqlQueryAll($query){
   		$query = $query;
		$result = $this->mysqli->query_all($query);
		$this->close();
		return $result;
   } // SqlQueryAll
   
   function Query($query){
   		$query = $query;
		$result = $this->mysqli->query($query);
		$this->close();
		return $result;
   } // SqlQueryAll
   
   function MultiQuery($query){
   		$query = $query;
		$result = $this->mysqli->multiQuery($query);
		$this->close();
		return $result;
   } // SqlQueryAll

  	function Insert($fieldArray)
   {
      	$this->errors = array();
		$fieldList = $this->fieldList;
      	foreach ($fieldArray as $field => $fieldvalue) {
        	if (!in_array($field, $fieldList)) {
            	unset ($fieldArray[$field]);
        	} // if
      	} // foreach
		$query = "INSERT INTO ". $this->tableName." SET ";
      	foreach ($fieldArray as $item => $value) {
         	$query .= $item." = '".$value."', ";
      	} // foreach
      	$query = rtrim($query, ', ');
		$this->sqlMessage = "Your Query is: ". $query;
      	$result = $this->mysqli->query_affected($query);
		
      	if ($result <> 0) {
         	if ($this->mysqli->last_error_was(1062)) {
            	$this->errors[] = "Data already exists.";
				$this->message = "This account name already exists.";
         	} 
      	} else{
				 $this->message = "Success";
		}// if
		$this->lastInsert = $this->mysqli->insert_id;
		$this->close();
   } // Insert
   
   function Update($fieldArray)
   {
      	$this->errors = array();
      	global $query;
      	$fieldList = $this->fieldList;
      	foreach ($fieldArray as $field => $fieldvalue) {
         	if (!in_array($field, $fieldList)) {
            	unset ($fieldArray[$field]);
         	} // if
      	} // foreach
      	$where  = NULL;
      	$update = NULL;
      	foreach ($fieldArray as $item => $value) {
         	if (isset($fieldList[$item]['pkey'])) {
            	$where .= $item." ='".$value."' AND ";
         	} else {
            	$update .= $item." ='".$value."', ";
         	} // if
      	} // foreach
		$where  = rtrim($where, ' AND ');
      	$update = rtrim($update, ', ');
		$query = " UPDATE ". $this->tableName." SET ". $update." WHERE ". $where;
		$this->sqlMessage = "Your Query is: ". $query;
      	$result = $this->mysqli->query_affected($query);
      	if ($result <> 0) {
         	if ($this->mysqli->last_error_was(1062)) {
            	$this->errors[] = "SQL Error.";
				$this->message = "Coluld not update this record.";
         	} 
      	} else{
				 $this->message = "Success";
		}// if
		$this->close();
   } // Update
   
   function Delete($fieldArray)
   {
      	$this->errors = array();
      	global $query;
      	$fieldList = $this->fieldList;
      	$where  = NULL;
      	foreach ($fieldArray as $item => $value) {
         	if (isset($fieldList[$item]['pkey'])) {
            	$where .= $item." = '".$value."' AND ";
         	} // if
      	} // foreach
		$where  = rtrim($where, ' AND ');
		$query = " DELETE FROM ". $this->tableName." WHERE ".$where;
      	$result = $this->mysqli->query_affected($query);
		if ($result <> 0) {
         	if ($this->mysqli->last_error_was(1062)) {
            	$this->errors[] = "SQL Error.";
				$this->message = "Coluld not Delete this record.";
         	} 
      	} else{
				 $this->message = "Success";
		}// if
		$this->close();
   } // Delete
   
   private function close(){
		if(!$this->inTransaction){
			$this->mysqli->close();
			$this->mysqli = NULL;
		}
   }//close
} // end class
?>