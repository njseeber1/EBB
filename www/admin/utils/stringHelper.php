<?php
function PutEscapeSequence($string){
	return str_replace("\\","\\\\",str_replace("'","''",$string));
}

function RemoveSpaces($string){
	return preg_replace('/\s+/', '',strtolower($string));
}

function ConvertToPhoneNumber($string){
	$phone = preg_replace('/[^[0-9]/','',$string);
	$IC = '';
	$NC = '';
	$AC = '';
	$PN = '';
	if(strlen($phone) > 12) $phone = substr($phone, 12);
	switch(strlen($phone)){
		case 7:
			$AC = substr($phone, 0, 3);
			$PN = substr($phone, 4);
			break;
		case 8:
			$NC = substr($phone, 0, 1);
			$AC = substr($phone, 1, 4);
			$PN = substr($phone, 4);
			break;
		case 9:
			$NC = substr($phone, 0, 2);
			$AC = substr($phone, 2, 4);
			$PN = substr($phone, 4);
			break;
		case 10:
			$NC = substr($phone, 0, 3);
			$AC = substr($phone, 3, 5);
			$PN = substr($phone, 4);
			break;
		case 11:
			$IC = substr($phone, 0, 1);
			$NC = substr($phone, 1, 4);
			$AC = substr($phone, 4, 6);
			$PN = substr($phone, 4);
			break;
		case 12:			
			$IC = '+'.substr($phone, 0, 2);
			$NC = substr($phone, 2, 5);
			$AC = substr($phone, 5, 7);
			$PN = substr($phone, 4);
			break;
	}
	return $IC . ' ' . $NC . ' ' . $AC. ' ' .$PN;
}
?>