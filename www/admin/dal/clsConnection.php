<?php
include_once 'clsMysqlServer.php';
class connection
{
	private $connectionString;
	private $mysqli;

	function connection(){
		include $_SERVER['DOCUMENT_ROOT'].'/admin/config/db.php';
	//	include 'admin/config/db.php';
		$db = new SimpleXMLElement($connectionString);
		//$this->connectionString = 'server='.$db->connection[0]->host.'; database='.$db->connection[0]->database.'; username='.$db->connection[0]->user.'; password='.$db->connection[0]->password;
		$this->connectionString = 'server='.$db->connection[1]->host.'; database='.$db->connection[1]->database.'; username='.$db->connection[1]->user.'; password='.$db->connection[1]->password;
	}//contructor
	
	public function GetMysqli(){
		$this->mysqli = new MysqliDatabase($this->connectionString, FALSE);
		return $this->mysqli;
	}// GetCconnectionString
}//class
?>