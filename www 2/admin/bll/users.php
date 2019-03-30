<?php
include_once 'dal/clsDataTable.php';
include_once 'utils/stringHelper.php';
class Users extends DefaultTable
{
	var $uId;
	var $companyId;
	var $userName;
	var $password;
	var $email;
	var $status;
	var $errors;
    var $message;
	function Users()
	{
		$this->tableName = 'users';
        $this->rowsPerPage = 10;
        $this->fieldList = array('uId','companyId','userName', 'password','email', 'status');
        $this->fieldList['uId'] = array('pkey' => 'y');
		$this->errors = array();
	}
	
	public function setUId($uId){
		$this->uId = $uId;
	}
	
	public function setCompanyId($companyId){
		$this->companyId = $companyId;
	}
	
	public function setUserName($userName){
		$this->userName = PutEscapeSequence($userName);
	}
	
	public function setPassword($password) {
        $this->password = md5(PutEscapeSequence($password));
	}

    public function setConfirmPass($confirmPass) {
		if(STRLEN($confirmPass) == 0 or STRLEN($confirmPass) > 25){
			$this->errors[]="Password";
		}else if($this->password == md5(PutEscapeSequence($confirmPass))){
	        $this->confirmPass =$confirmPass;
		} else {
			$this->errors[]="Password";
		}
	}
	
	public function setEmail($email){
		$this->email = PutEscapeSequence($email);
	}
	
	public function setStatus($status){
		$this->status = $status;
	}
		
	//------------------------------------
	
	public function Save(){
			$dtUser = $this->CheckExistingUser();
			$this->uId = 0;
			if(count($dtUser) == 0){
				try{
					if(count($this->errors)==0){
						$fieldArray = array('companyId'=>$this->companyId,'userName'=>$this->userName,'password'=>$this->password,  'email'=>$this->email,'status'=>$this->status);
						$this->prepareConnection();
						$this->Insert($fieldArray);
						$this->uId = $this->lastInsert;
					}
					return $this->uId;
				}catch(Exception $ex) {
					return $this->uId;
				}
			}else{
				if($dtUser[0]->status == 0){
					$this->uId = $dtUser[0]->uId;
					$fieldArray = array('uId'=>$this->uId,'status'=>1);
					$this->prepareConnection();
					$this->Update($fieldArray);
				}
				return $this->uId;
			}
	}
	
	public function CheckExistingUser(){
		$query = "SELECT  uId, status FROM users WHERE email =  '".$this->email."'";
		$this->prepareConnection();
		$dtUser =	$this->SqlQuery($query);
		return $dtUser;
	}
	
	public function Login(){
		$query = "SELECT *  FROM users WHERE companyId = ".$this->companyId." AND  email = '".$this->email."' AND  password = '".$this->password."'";
		$this->prepareConnection();
		$dtUser= $this->SqlQuery($query);
		return $dtUser;
	}
	
	public function GetUserList(){
		$query = "SELECT uId, userName, email, CONCAT('<a href=\"editUser.php?uId=',uId,'\">','Edit','</a>') AS editUser, CONCAT('<a href=\"deleteUser.php?uId=',uId,'\">','Delete','</a>') AS deleteUser  FROM users WHERE companyId = ".$this->companyId." AND status = 1";
		$this->prepareConnection();
		$dtUserList = $this->SqlQueryAll($query);
		return $dtUserList;
	}
	
	public function GetUserDetails(){
		$query = "SELECT uId, userName, email  FROM users WHERE uId = ".$this->uId;
		$this->prepareConnection();
		$dtUserDetails = $this->SqlQuery($query);
		return $dtUserDetails;
	}
	
	function UpdateUser(){
		$fieldArray = array('uId'=>$this->uId,'userName'=>$this->userName,'password'=>$this->password,  'email'=>$this->email);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
	
	function DeleteUser(){
		$fieldArray = array('uId'=>$this->uId, 'status'=>0);
		$this->prepareConnection();
		$this->Update($fieldArray);
	}
}
?>