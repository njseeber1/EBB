<?php
class validation
{
	function validateEmail($address) {
		return preg_match('/^[a-z0-9_-][a-z0-9._-]+@([a-z0-9]*\.)+[a-z]{2,6}/i', $address);
	}//validateEmail
	
	function standardisePhone($phone){
		$p = preg_replace('/[^[0-9]/','',$phone);
		return substr($p, 0, 2) . '-' . substr($p, 2, 3) . '-' . substr($p, 5, 3) . '-' . substr($p, 8);
	}//standardisePhone
	
	function validatePhone($phone){
		$parts = explode('-', $phone);
		//if ($parts[3] < 200){
			//return false;
		//}
		//if ($parts[1] < 200) {
			//return false;
		//}
		if (strlen($parts[3]) != 4) {
			return false;
		}
		return true;
	}//validatePhone
	
	function standardiseDate($date) {
		$p = preg_replace('/[^[0-9]/','',$date);
		return substr($p, 0, 2) . '-' . substr($p, 2, 2) . '-' . substr($p, 4);
	}//standardiseDate
	
}//class
?>