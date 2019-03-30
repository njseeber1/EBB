<?php
include_once $root.'dal/clsDataTable.php';
include_once $root.'utils/stringHelper.php';
class Resources extends DefaultTable
{
	var $resourceId;
	var $companyId;
	var $documentName;
	var $description;
	var $contentType;

	function Resources()
	{
		$this->tableName = 'resources';
        $this->rowsPerPage = 10;
        $this->fieldList = array('resourceId', 'companyId', 'documentName', 'description','contentType');
        $this->fieldList['resourceId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setResourceId($resourceId){
		$this->resourceId = $resourceId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setDocumentName($documentName){
		$this->documentName = PutEscapeSequence($documentName);
	}
	
	public function setDescription($description){
		$this->description = PutEscapeSequence($description);
	}
	
	public function setContentType($contentType){
		$this->contentType = PutEscapeSequence($contentType);
	}
		
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'documentName'=>$this->documentName,'description'=>$this->description);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->resourceId = $this->lastInsert;
			return $this->resourceId;
		}catch(Exception $ex) {
			return $this->resourceId;
		}
	}
	
	public function GetResourceList(){
		$query = "SELECT resourceId, documentName, CONCAT('<a href=\"frmResources.php?mode=Update&resourceId=',resourceId,'\">','Edit','</a>') AS editResource, CONCAT('<a href=\"frmResources.php?mode=Delete&resourceId=',resourceId,'\">','Delete','</a>') AS deleteResource  FROM resources WHERE companyId = ".$this->companyId;
		$this->prepareConnection();
		$dtResourceList = $this->SqlQueryAll($query);
		return $dtResourceList;
	}
	
	public function GetResources(){
		$query = "SELECT resourceId, documentName, description, contentType FROM resources WHERE companyId = ".$this->companyId;
		$this->prepareConnection();
		$dtResources = $this->SqlQueryAll($query);
		return $dtResources;
	}
	
	public function GetResourceDetails(){
		$query = "SELECT resourceId, documentName, description, contentType FROM resources WHERE resourceId = ".$this->resourceId;
		$this->prepareConnection();
		$dtResourceDetails = $this->SqlQuery($query);
		return $dtResourceDetails;
	}
	
	function UpdateResource(){
		$fieldArray = array('resourceId'=>$this->resourceId,'documentName'=>$this->documentName,'description'=>$this->description);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function UpdateContentType(){
		$fieldArray = array('resourceId'=>$this->resourceId,'contentType'=>$this->contentType);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteResource(){
		$fieldArray = array('resourceId'=>$this->resourceId);
		$this->prepareConnection();
		$this->Delete($fieldArray);
	}
}
?>