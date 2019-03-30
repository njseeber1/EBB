<?php

global $action, $id, $config;
include("../include/common.php");



include("$config[template_path]/admin_top.html");



global $conn, $lang;

if ($config[allow_user_signup] == "yes")
	{
	// if users are allowed to make accounts....
	if ($edit_user_pass != $edit_user_pass2)
		{
		echo "<p>$lang[user_creation_password_identical]</p>";
		echo "<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"$lang[back_button_text]\" onClick=\"history.back()\"></FORM>";
		} // end else
	elseif ($edit_user_pass == "")
		{
		echo "<p>$lang[user_creation_password_blank]</p>";
		echo "<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"$lang[back_button_text]\" onClick=\"history.back()\"></FORM>";
		} // end else
	elseif ($edit_user_name == "")
		{
		echo "<p>$lang[user_editor_need_username]</p>";
		echo "<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"$lang[back_button_text]\" onClick=\"history.back()\"></FORM>";
		} // end else
	elseif ($user_email == "")
		{
		echo "<p>$lang[user_editor_need_email_address]</p>";
		echo "<FORM><INPUT TYPE=\"BUTTON\" VALUE=\"$lang[back_button_text]\" onClick=\"history.back()\"></FORM>";
		} // end else
	else
		{
		$sql_user_name = make_db_safe($edit_user_name);
		
	
		global $HTTP_POST_VARS, $pass_the_form;
		$pass_the_form = "No";
		
		// first, make sure the user name isn't in use
		$sql = "SELECT user_name from " . $config[table_prefix] . "UserDB WHERE user_name = $sql_user_name";
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$recordSet = $conn->Execute($sql);
			if ($recordSet === false) log_error($sql);
		$num = $recordSet->RecordCount();
		
		if ($num >= 1)
			{
			$pass_the_form = "No";
			$fail_message = "$lang[user_creation_username_taken]";
			} // end if
		
	
		else
			{
			// validate the user form
			$pass_the_form = validateForm(agentFormElements);
			}
	
		if ($pass_the_form == "No")
			{
			// if we're not going to pass it, tell that they forgot to fill in one of the fields
			echo "<p>$lang[required_fields_not_filled]</p>";
			}
	
		if ($pass_the_form == "Yes")
			{
			// what the program should do if the form is valid
			
			// generate a random number to enter in as the password (initially)
			// we'll need to know the actual account id to help with retrieving the user
			// We will be putting in a random number that we know the value of, we can easily
			// retrieve the account id in a few moments
			
			$random_number = rand(1,10000);

			// check to see if moderation is turned on...
			if ($config[moderate_users] == "no")
				{
				$set_active = "yes";
				}
			else
				{
				$set_active = "no";
				}

			$sql_user_name = make_db_safe($edit_user_name);
			$md5_user_pass = md5($edit_user_pass);
			$md5_user_pass = make_db_safe($md5_user_pass);
			$sql_user_email = make_db_safe($user_email);
			$sql_set_active = make_db_safe($set_active);
	
			// create the account with the random number as the password
			$sql = "INSERT INTO " . $config[table_prefix] . "UserDB (user_name, user_password, emailAddress, creation_date, last_modified, active, isAgent) VALUES ($sql_user_name, $random_number, $sql_user_email, ".$conn->DBDate(time()).",".$conn->DBTimeStamp(time()).", $sql_set_active, 'yes')";
			$recordSet = $conn->Execute($sql);
				if ($recordSet === false) log_error($sql);
			// then we need to retrieve the new user id
			$sql = "SELECT id FROM " . $config[table_prefix] . "UserDB WHERE user_password = '$random_number'";
			$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
			$recordSet = $conn->Execute($sql);
				if ($recordSet === false) log_error($sql);		
			while (!$recordSet->EOF)
				{
				$new_user_id =  $recordSet->fields[id]; // this is the new user's ID number
				$recordSet->MoveNext();
				} // end while
				
			// now it's time to replace the password
			$sql = "UPDATE " . $config[table_prefix] . "UserDB SET user_password = $md5_user_pass WHERE ID = $new_user_id";
			$recordSet = $conn->Execute($sql);
				if ($recordSet === false) log_error($sql);	
			
			// next, we'll give the user the default set of privledges
			// defined in the common.php file
			
			$sql_edit_isAdmin =  make_db_safe($config[user_default_admin]);
			$sql_edit_active =  make_db_safe($config[user_default_active]);
			$sql_edit_isAgent =  make_db_safe("yes");
			$sql_edit_canEditForms =  make_db_safe($config[user_default_editForms]);
			$sql_edit_canFeatureListings =  make_db_safe($config[user_default_feature]);
			$sql_edit_canViewLogs =  make_db_safe($config[user_default_logview]);
			$sql_edit_canModerate = make_db_safe($config[user_default_moderate]);
			$sql = "UPDATE " . $config[table_prefix] . "UserDB SET isAdmin = $sql_edit_isAdmin,";
			$sql .= "active = $sql_edit_active,";
			$sql .= "isAgent = $sql_edit_isAgent,";
			$sql .= "canEditForms = $sql_edit_canEditForms,";
			$sql .= "canFeatureListings = $sql_edit_canFeatureListings,";
			$sql .= "canViewLogs = $sql_edit_canViewLogs,";
			$sql .= "canModerate = $sql_edit_canModerate";
			$sql .= "WHERE ID = $new_user_id";
			$recordSet = $conn->Execute($sql);
				if ($recordSet === false) log_error($sql);
			
			// now that that's taken care of, it's time to insert all the rest
			// of the variables into the database
			
			$message = updateUserData($new_user_id);
			if ($message == "success")
				{
				$user_name = make_db_unsafe($user_name);
				echo "<p>$lang[user_creation_username_success], $edit_user_name</p>";
				if ($config[moderate_users] == "yes")
					{
					// if moderation is turned on...
					echo "<p>$lang[admin_new_user_moderated]</p>";
					}
				else 
				{
				echo "<p>$lang[you_may_now_view_priv]</p>";
				}
				log_action ("$lang[log_created_user]: $edit_user_name");
				if ($config[email_notification_of_new_users] == "yes")
					{
					// if the site admin should be notified when a new user is added
					global $config, $lang;
					
					$message = $_SERVER[REMOTE_ADDR]. " -- ".date("F j, Y, g:i:s a")."\r\n\r\n$lang[admin_new_user]:\r\n$config[baseurl]/admin/user_edit.php?edit=$new_user_id\r\n";
					$header = "From: ".$config['admin_email']." <".$config['admin_email'].">\r\n";
					$header .= "X-Sender: $config[admin_email]\r\n";
					$header .= "Return-Path: $config[admin_email]\r\n";

					mail("$config[admin_email]", "$lang[admin_new_user]", $message, $header); 
					} // end if
				} // end if
			else
				{
				echo "<p>$lang[alert_site_admin]</p>";
				} // end else
			} // end if
		} // end else
	} // end if ($config[allow_user_signup] == "yes")
else
	{
	// if users can't sign up...
	echo "<h3>$lang[no_user_signup]</h3>";
	}


include("$config[template_path]/admin_bottom.html");


	
$conn->Close(); // close the db connection
?>