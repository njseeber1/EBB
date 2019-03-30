<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once $root.'/admin/dal/clsDataTable.php';
include_once $root.'/admin/utils/stringHelper.php';
class Queries extends DefaultTable{

	var $name;
	var $email;
	var $phone;
	var $title;
	var $subject;
	var $message;

	function Queries(){
		$this->tableName = 'queries';
        $this->rowsPerPage = 10;
        $this->fieldList = array('name', 'email', 'phone', 'subject', 'message', 'title');
    //    $this->fieldList['listingId'] = array('pkey' => 'y');
		$this->errors = array();
	}

	public function Save(){
		try{
			$fieldArray = array(
					'name'=>$this->name,
					'phone'=>$this->phone,
					'email'=>$this->email,
					'subject'=>$this->subject,
					'title'=>$this->title,
					'message'=>$this->message
				);
			$this->prepareConnection();
			$this->Insert($fieldArray);
			return "Success";
		}catch(Exception $ex) {
			return "Error";
		}
	}

	public function setTitle($title){
		$this->title = PutEscapeSequence($title);
	}
	public function setName($name){
		$this->name = PutEscapeSequence($name);
	}
	public function setEmail($email){
		$this->email = PutEscapeSequence($email);
	}	
	public function setPhone($phone){
		$this->phone = PutEscapeSequence($phone);
	}	
	public function setSubject($subject){
		$this->subject = PutEscapeSequence($subject);
	}
	public function setMessage($message){
		$this->message = PutEscapeSequence($message);
	}

}
?>