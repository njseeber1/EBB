<?php
$root = $_SERVER['DOCUMENT_ROOT'];
include_once($root.'/admin/bll/settings.php');
include_once($root.'/admin/bll/queries.php');
$setting = new Settings();
$setting->setCompanyId(1); 
$dtSettings = $setting->GetSettings();

// SAVE QUERY TO DB

	$query = new Queries();
	$query->setName($_POST['name']);
	$query->setPhone($_POST['phone']);
	$query->setEmail($_POST['email']);
	$query->setSubject($_POST['subject']);
	$query->setMessage($_POST['message']);
	$query->setTitle($_POST['title']);
	$query->Save();

// END SAVE QUERY

include_once($root.'/include/sendMail.php');
if($_POST['mode']=="submit" & $dtSettings[0]->email != ''){
	$to = $dtSettings[0]->email;
		$from = $_POST['email'];
		$subject = "Enquiry";
		$message = '<table width="500" border="0" align="center" cellpadding="5" cellspacing="0">';
		$message .= '<tr>';
		$message .= '<td width="150"  align="left" valign="top" class="formtext">Name :</td>';
		$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['name'].'</td>';
		$message .= '</tr><tr>';
		if(!is_null($_POST['title'])){
			$message .= '<td width="150"  align="left" valign="top" class="formtext">For Property Titled:</td>';
			$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['title'].'</td>';
			$message .= '</tr><tr>';
		}
		$message .= '<td width="150"  align="left" valign="top" class="formtext">Phone :</td>';
		$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['phone'].'</td>';
		$message .= '</tr><tr>';
		$message .= '<td width="150"  align="left" valign="top" class="formtext">Email :</td>';
		$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['email'].'</td>';
		$message .= '</tr><tr>';
		$message .= '<td width="150"  align="left" valign="top" class="formtext">Subject :</td>';
		$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['subject'].'</td>';
		$message .= '</tr><tr>';
		$message .= '<td width="150"  align="left" valign="top" class="formtext">Message :</td>';
		$message .= '<td width="350"  align="left" valign="top" class="formtext">'.$_POST['message'].'</td>';
		$message .= '</tr></table>';
		if(send($to, $from,$_POST['name'], $subject, $message)){
			$success='Your message has been sent.';
			$status = 0;
		}else{
			$success = 'Message sending failed. Please send an email to meabraham@msn.com.';
			$status = 1;
		}
		echo json_encode(array("status"=>$status, "message"=>$success));
}	
?>