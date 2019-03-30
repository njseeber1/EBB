<?php
include('class.phpmailer.php');

/*
$mail->IsSMTP(); // telling the class to use SMTP
$mail->Host       = "mail.cogcrm.com"; // SMTP server
$mail->SMTPDebug  = 2;                     // enables SMTP debug information (for testing)
                                           // 1 = errors and messages
                                           // 2 = messages only
$mail->SMTPAuth   = true;                  // enable SMTP authentication
$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
$mail->Username   = "admin@cogcrm.com";  // GMAIL username
$mail->Password   = "";            // GMAIL password
*/

class mailHelper{
	static private $mail=NULL;
	
	public static function getMailer(){
	 	if(self::$mail==NULL){
			self::$mail=new PHPMailer();
	        self::$mail->IsSMTP(); // telling the class to use SMTP
	        self::$mail->Host       = "mail.cogstudios.in"; // SMTP server
	        self::$mail->SMTPAuth   = true;                  // enable SMTP authentication
			self::$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
			self::$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
			self::$mail->Port       = 465;                   // set the SMTP port for the GMAIL server
			self::$mail->Username   = "support@cogstudios.in";  // GMAIL username
			self::$mail->Password   = "support@1";            // GMAIL password
	        
		}
	
	  return self::$mail;
	   
	
	}
	
	public static function sendMail($to, $from,$name, $subject, $body){
		$mailer = self::getMailer();
		$mailer->SetFrom($from, $name);

		$mailer->AddReplyTo($from,$name);

		$mailer->Subject    = $subject;

		$mailer->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mailer->MsgHTML($body);

		$address = $to;
		$mailer->AddAddress($address, $to);
		if(!$mailer->Send()){
			return false;
		}
		return true;
		
		
	}
	
	public static function sendMailWitAttachments($to, $from,$name, $subject, $body,$attachmentPaths){
		$mailer = self::getMailer();
		$mailer->SetFrom($from, $name);

		$mailer->AddReplyTo($from,$name);

		$mailer->Subject    = $subject;

		$mailer->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test

		$mailer->MsgHTML($body);

		$address = $to;
		$mailer->AddAddress($address, $to);
		
		 foreach ($attachmentPaths as $path) {
			 $mailer->AddAttachment($path);
		    }
		
		
		if(!$mailer->Send()){
			//Notify error service
			return false;
		}
		
		return true;
		
		
	}
	

}
?>