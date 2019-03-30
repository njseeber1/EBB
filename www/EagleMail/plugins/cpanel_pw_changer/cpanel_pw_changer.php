<?php
/****************************************************************************
*   CPanel Password Changer - A Plugin for SqurrelMail
*   Copyright (c) 2003 GNU GPL
*
*   Author: Henri Straforelli <henri@snippetmaster.com>
*
****************************************************************************/

chdir('..');
define('SM_PATH','../');

//include compatibility plugin;

if (defined('SM_PATH'))
   include_once(SM_PATH . 'plugins/compatibility/functions.php');
else if (file_exists('../plugins/compatibility/functions.php'))
   include_once('../plugins/compatibility/functions.php');
else if (file_exists('./plugins/compatibility/functions.php'))
   include_once('./plugins/compatibility/functions.php');

if (compatibility_check_sm_version(1, 3)) {
   include_once (SM_PATH . 'include/validate.php');
   include_once (SM_PATH . 'plugins/cpanel_pw_changer/config.php');
   include_once (SM_PATH . 'plugins/cpanel_pw_changer/languages/' . $language_file);
}
else {
   include_once ('../src/validate.php');
   include_once ('../plugins/cpanel_pw_changer/config.php');
   include_once ('../plugins/cpanel_pw_changer/languages/' . $language_file);
}


global $submit, $new_pw1, $new_pw2, $base_uri, $cpanel_un, $cpanel_pw, $cpanel_port, $cpanel_file_location, $cpanel_success_string, $show_cpanel_output, $disconnect, $do_htaccess_change, $cpanel_protect_file_location, $protect_file_path, $cpanel_protect_success_string, $language_file;

sqgetGlobalVar('new_pw1', $new_pw1, SQ_FORM);
sqgetGlobalVar('new_pw2', $new_pw2, SQ_FORM);
sqgetGlobalVar('submit', $submit, SQ_FORM);

compatibility_sqextractGlobalVar('submit');
compatibility_sqextractGlobalVar('new_pw1');
compatibility_sqextractGlobalVar('new_pw2');

$new_pw1 = trim($new_pw1);
$new_pw2 = trim($new_pw2);
$base_uri = trim($base_uri);

if (isset($submit)) {

	// check for errors!
	//
	if (empty($username)) {	// Assumes $username is available from Squirralmail global vars...
		$msg = $status[1];
		$errors = true;
	}
	elseif (empty($new_pw1) || empty($new_pw2)) {
		$msg = $status[2];
		$errors = true;
	}
	elseif (strlen($new_pw1) < 6) { 
		$msg = $status[3];
		$errors = true;
	}
	elseif (strlen($new_pw1) > 15) { 
		$msg = $status[4];
		$errors = true;
	}
	elseif ($new_pw1 != $new_pw2) {
		$msg = $status[5];
		$errors = true;
	}
}

if (isset($submit) && ($errors == false)) {

    // Put together the CPanel change pop password command.	//http://un:pw@www.domain.com:2082/frontend/iconic/mail/dopasswdpop.html?email=name&domain=domain.com&password=newpassword

	$cpanel_domain = $_SERVER["SERVER_ADDR"];
	$cpanel_port = 2082;		// Your CPanel port. (https not supported unless CURL is installed.)

	$un_parts = explode("@", $username);	// Split the un into parts.  (username/domain name)
	$request = "email=".$un_parts[0]."&domain=".$un_parts[1]."&password=".$new_pw1;

	// Form the header of the HTTP request, with username and password.
	$header = "POST " . $cpanel_file_location . " HTTP/1.0\r\nAuthorization: Basic "; 
	$header .= base64_encode($cpanel_un . ":" . $cpanel_pw) .  "\r\n"; 
	$header .= "Content-type: application/x-www-form-urlencoded\r\n"; 
	$header .= "Content-length: " . strlen($request) . "\r\n"; 
	$header .= "Connection: close\r\n\r\n";

	// Connect to the server
	$fp = fsockopen($cpanel_domain, $cpanel_port, $errno, $errstr); 
	if ($fp) { 
		// Send the request
		fputs($fp, $header . $request); 
		// Get the result
		while (!feof($fp)) { $cpanel_response .= fgets($fp, 128); } 
	}

	// Close the connection
	$fp = fclose($fp);

	// Get rid of the HTTP result headers - they aren't needed.
	$nnpos = strpos($cpanel_response, "\n\n");
	$cpanel_response = substr($cpanel_response, $nnpos + 1);

	// Determine if the Cpanel request was successful or not by finding the 
	// "success" text string specified in the config file.
	//$cpanel_response_temp = implode('',$cpanel_response); 
	$cpanel_response_temp = strip_tags($cpanel_response); // remove all the HTML tags from the output 
	$array_temp = array("\n", "\r" ); 
	$cpanel_response_temp = str_replace($array_temp, "", $cpanel_response_temp); // remove the line breaks 
	$find_string = strpos($cpanel_response_temp, $cpanel_success_string);
		
	if ($find_string == true) { 

		$msg = $statusEmailChangeSUCCESS; 

		// Write a cookies with the new password
	    global $onetimepad, $key, $base_uri;
	    $onetimepad = OneTimePadCreate(strlen($new_pw1));
	    compatibility_sqsession_register($onetimepad, 'onetimepad');
	    $key = OneTimePadEncrypt($new_pw1, $onetimepad);
	    setcookie('key', $key, 0, $base_uri);
	}
	else { 
		$msg = $statusEmailChangeFAILURE; 
	}

	if ($do_htaccess_change == true) {	// Should we also change pw for an .htaccess file?

		// Put together the CPanel change directory pw protect command.	//http://www.candev.ca:2082/frontend/iconic/htaccess/newuser.html?user=hstraf@candev.ca&pass=newpass&dir=/home/candev/public_html/contractors

		$request = "user=".$username."&pass=".$new_pw1."&dir=".$protect_file_path;

		// Form the header of the HTTP request, with username and password.
		$header = "POST " . $cpanel_protect_file_location . " HTTP/1.0\r\nAuthorization: Basic "; 
		$header .= base64_encode($cpanel_un . ":" . $cpanel_pw) .  "\r\n"; 
		$header .= "Content-type: application/x-www-form-urlencoded\r\n"; 
		$header .= "Content-length: " . strlen($request) . "\r\n"; 
		$header .= "Connection: close\r\n\r\n";

		// Connect to the server
		$fp = fsockopen($cpanel_domain, $cpanel_port, $errno, $errstr); 
		if ($fp) { 
			// Send the request
			fputs($fp, $header . $request); 
			// Get the result
			while (!feof($fp)) { $cpanel_response2 .= fgets($fp, 128); } 
		}

		// Close the connection
		$fp = fclose($fp);

		// Get rid of the HTTP result headers - they aren't needed.
		$nnpos = strpos($cpanel_response2, "\n\n");
		$cpanel_response2 = substr($cpanel_response2, $nnpos + 1);

		// Determine if the Cpanel request was successful or not by finding the 
		// "success" text string specified in the config file.
		//$cpanel_response_temp = implode('',$cpanel_response2); 
		$cpanel_response_temp = strip_tags($cpanel_response2); // remove all the HTML tags from the output 
		$array_temp = array("\n", "\r" ); 
		$cpanel_response_temp = str_replace($array_temp, "", $cpanel_response_temp); // remove the line breaks 
		$find_string = strpos($cpanel_response_temp, $cpanel_protect_success_string);

		if ($find_string == true) { 

			$msg .= $statusWebProtectChangeSUCCESS; 
		}
		else { 
			$msg .= "<br>".$statusWebProtectChangeFAILURE; 
		}
	}

	if ($disconnect) {
		echo "\n\n"
               . '<html><body onLoad="parent.location.href=\'../../src/signout.php\'">'
               . '</body></html>';
        exit();
    }

}

if (compatibility_check_sm_version(1, 3)) {
   include_once (SM_PATH . 'include/validate.php');
   include_once (SM_PATH . 'functions/page_header.php');
   include_once (SM_PATH . 'include/load_prefs.php');
}
else {
   include_once ('../functions/strings.php');
   include_once ('../config/config.php');
   include_once ('../functions/page_header.php');
   include_once ('../functions/imap.php');
   include_once ('../src/load_prefs.php');
}

displayPageHeader($color, 'None');

?>

<table width="95%" align=center border=0 cellpadding=2 cellspacing=2>
   <tr>
	  <td align="center" bgcolor="<?php echo $color[0] ?>"><b><?php echo $formTitle?></b>
	     <table cellspacing="0" cellpadding="5" border="0" width="100%">
		    <tr>
		       <td bgcolor="<?php echo $color[4] ?>">
					<?php 
						if (isset($msg))
							{ echo "<br /><center><b><font color=\"red\">$msg</font></b></center><br /><br />"; }
						echo $formInstructions;
					?>
			   <form method=post>
			   <center>
			   <hr width="50%" size="1" noshade>
			   <table>
				  <tr>
					<td align=right><?php echo $formUsername?></td> 
					<td><b><?php echo $username?></b>
					   </td>
				  </tr>
				  <tr>
					 <td align=right><?php echo $formNewPw1?></td>
					 <td><input name=new_pw1 size=10 type=password maxlength="15"></td></tr>
				  <tr>
					 <td align=right><?php echo $formNewPw2?></td>
					 <td><input name=new_pw2 size=10 type=password maxlength="15"></td>
				  </tr>
				</table>
				<hr width="50%" size="1" noShade>
				<input name=submit type=submit value="<?php echo $formSubmitButton?>"></form> 
			  </td>
		   </tr>
	    </table>
	 </td>
  </tr>
</table>

<?php
	
if ((!empty($cpanel_response)) && ($show_cpanel_output == true)) {

	// Display the output from Cpanel here.
    echo "<hr><b><h2>CPanel Output - Change POP email account password</h2></b>";
	echo $cpanel_response;
}
if ((!empty($cpanel_response2)) && ($show_cpanel_output == true)) {

    echo "<hr><b><h2>CPanel Output - Change web protected folder password</h2></b>";
	echo $cpanel_response2;
}

?>

</body>
</html>