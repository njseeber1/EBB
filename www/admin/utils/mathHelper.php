<?php
function Compare($operator, $Parm1, $Parm2){
$flag = false;
	switch(strtolower($operator)){
		case 'less than':
			if($Parm1 < $Parm2) $flag = true;
			break;
		case 'greater than':
			if($Parm1 > $Parm2) $flag = true;
			break;
		case 'equal to':
			if($Parm1 == $Parm2) $flag = true;
			break;
		case '<':
			if($Parm1 < $Parm2) $flag = true;
			break;
		case '>':
			if($Parm1 > $Parm2) $flag = true;
			break;
		default:
			if($Parm1 == $Parm2) $flag = true;
			break;
	}
	if($flag) return 1;
	else return 0;
}
?>