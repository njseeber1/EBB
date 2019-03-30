<?php
$root = $_SERVER['DOCUMENT_ROOT'];
//include 'dal/clsDataTable.php';
include $root.'/admin/dal/clsDataTable.php';
include $root.'/admin/utils/stringHelper.php';
class Settings extends DefaultTable
{
	var $settingsId;
	var $companyId;
	var $messageEmail;
	var $linkedIn;
	var $facebook;
	var $twitter;
	var $googlePlus;
	var $skype;
	var $pinterest;
	var $errors;
    var $message;
	
	function Settings()
	{
		$this->tableName = 'settings';
        $this->rowsPerPage = 10;
        $this->fieldList = array('settingsId', 'companyId',  'messageEmail', 'linkedIn', 'facebook', 'twitter', 'googlePlus', 'skype','pinterest');
        $this->fieldList['settingsId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setSettingsId($settingsId){
		$this->settingsId = $settingsId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setMessageEmail($messageEmail){
		$this->messageEmail = PutEscapeSequence($messageEmail);
	}
	public function setLinkedIn($linkedIn){
		$this->linkedIn = PutEscapeSequence($linkedIn);
	}
	public function setFacebook($facebook){
		$this->facebook = PutEscapeSequence($facebook);
	}
	public function setTwitter($twitter){
		$this->twitter = PutEscapeSequence($twitter);
	}
	public function setGooglePlus($googlePlus){
		$this->googlePlus = PutEscapeSequence($googlePlus);
	}
	public function setSkype($skype){
		$this->skype = PutEscapeSequence($skype);
	}
	public function setPinterest($pinterest){
		$this->pinterest = PutEscapeSequence($pinterest);
	}	
	//------------------------------------
	
	public function Save(){
		try{
			$fieldArray = array('companyId'=>$this->companyId,'messageEmail'=>$this->messageEmail,'linkedIn'=>$this->linkedIn,'facebook'=>$this->facebook,'twitter'=>$this->twitter,'googlePlus'=>$this->googlePlus,'skype'=>$this->skype,'pinterest'=>$this->pinterest);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			$this->settingsId = $this->lastInsert;
			return $this->settingsId;
		}catch(Exception $ex) {
			return $this->settingsId;
		}
	}
	
	public function GetSettings(){
		$query = "SELECT c.companyId, c.companyName, c.address, c.street, c.city, c.district, c.state, c.web, c.postalCode, c.phone, c.mobile, c.email, s.settingsId, s.messageEmail,  s.linkedIn, s.facebook, s.twitter, s.googlePlus, s.skype, s.pinterest 
		FROM settings AS s
		LEFT JOIN companies AS c ON s.companyId = s.companyId
		WHERE s.companyId = ".$this->companyId;
		$this->prepareConnection();
		$dtSettings = $this->SqlQuery($query);
		return $dtSettings;
	}
	
	function UpdateSettings(){
		$fieldArray = array('settingsId'=>$this->settingsId,'messageEmail'=>$this->messageEmail,'linkedIn'=>$this->linkedIn,'facebook'=>$this->facebook,'twitter'=>$this->twitter,'googlePlus'=>$this->googlePlus,'skype'=>$this->skype,'pinterest'=>$this->pinterest);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
}
?>