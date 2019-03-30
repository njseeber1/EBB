<?php
	error_reporting(E_ALL);
	include('../include/adodb/adodb.inc.php');
	$db = array();
	$db2 = array();
	global $config;
	///////////////////////////////////////////////////
	// IMPORT FROM
	// DATABASE TYPE
	// default is mysql -- make sure you edit this file
	// to make sure DB settings are correct!
	$db['type'] = 'mysql';
	$db['user'] = 'root';		//database user
	$db['password'] = '';		//database password
	$db['database'] = 'roatanlife';	//database definition file
	$db['server'] = 'localhost';		//database server -- usually localhost, but one never knows

	///////////////////////////////////////////////////
	// IMPORT TO
	$db2['type'] = 'mysql';
	$db2['user'] = 'root';		//database user
	$db2['password'] = '';		//database password
	$db2['database'] = 'roatanmls';	//database definition file
	$db2['server'] = 'localhost';		//database server -- usually localhost, but one never knows
	
	///////////////////////////////////////////////////
	// User Variables
	$config['path_to_mls_images'] = '/home/roatanmls/www/roatanmls.com/images/listing_photos';
	$config['path_to_import_images'] = '../images/listing_photos';
	$config['importas'] = '3'; //THis should match the user ID that you want the listings imported as.
	$config['moderate_listings'] = 'no';
	$config['import_table_prefix'] = ''; //Table Prefix in Import Database
	$config['mls_table_prefix']= 'default_'; //Table Prefix in MLS System
	$config['import_email'] = 'ryan@ryanbonham.com'; //Email Address for import errors to be sent to
	$config['days_until_listings_expire'] = '';

	///////////////////////////////////////////////////
	// Delete All Records for this user.
	$conn2 = &ADONewConnection($db2['type']);
	$conn2->Connect($db2['server'], $db2['user'], $db2['password'], $db2['database']);
	$importas = $config['importas'];
	$sql = "DELETE FROM " . $config['mls_table_prefix'] . "listingsDB where user_ID = '$importas'";
	if ($conn2->Execute($sql) === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg()); 
		}
	$sql = "DELETE FROM " . $config['mls_table_prefix'] . "listingsDBElements where user_id = '$importas'";
	if ($conn2->Execute($sql) === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg()); 
		}
	// Delete Images from MLS Directory
	$sql = "SELECT file_name, thumb_file_name FROM " . $config['mls_table_prefix'] . "listingsImages where user_id = $importas";
	$recordSet = $conn2->Execute($sql);
	if ($recordSet === false)
	{
		echo "$sql<br>";
		die($conn2->ErrorMsg());
	}
	while (!$recordSet->EOF)
	{
		$file = $recordSet->fields['file_name'];
		$thumb_file = $recordSet->fields['thumb_file_name'];
		$file = $config['path_to_mls_images'].'/'.$file;
		$thumb_file = $config['path_to_mls_images'].'/'.$thumb_file;
		unlink($file);
		unlink($thumb_file);
		$recordSet->MoveNext();
	}
	$sql = "DELETE FROM " . $config['mls_table_prefix'] . "listingsImages where user_id = $importas";
	if ($conn2->Execute($sql) === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg()); 
		}
	$conn2->Close();

	$conn1 = &ADONewConnection($db['type']);
	$conn1->Connect($db['server'], $db['user'], $db['password'], $db['database']);
	// Get Listings from Import Database
	$sql = "SELECT * FROM " . $config['import_table_prefix'] . "listingsDB WHERE mlsimport <> 'no'";
	$recordSet1 = $conn1->Execute($sql);
	$recordcount = 0;
	if ($recordSet1 === false)
	{
		echo "$sql<br>";
		die($conn1->ErrorMsg());
	}
	$i=0;
	while (!$recordSet1->EOF)
	{
		$importme[$i]['edit_title'] = $recordSet1->fields['Title'];
		$importme[$i]['$edit_notes'] = $recordSet1->fields['notes'];
		$importme[$i]['$importID'] = $recordSet1->fields['ID'];
		$i++;
		$recordSet1->MoveNext();
	}
	$i=0;
	$recordSet1->Close();
	$conn1->Close();
	$conn2 = &ADONewConnection($db2['type']);
	$conn2->Connect($db2['server'], $db2['user'], $db2['password'], $db2['database']);
	
	for ($i=0;$i<count($importme);$i++) 
	{
		$conn2 = &ADONewConnection($db2['type']);
		$conn2->Connect($db2['server'], $db2['user'], $db2['password'], $db2['database']);
	

		$edit_title = $importme[$i]['edit_title'];
		$edit_notes = $importme[$i]['$edit_notes'];
		$importID = $importme[$i]['$importID'];
		$userID = $config['importas'];
		$random_number = rand(1,10000);
		// check to see if moderation is turned on...
		if ($config['moderate_listings'] == "no")
		{
			$set_active = "yes";
		}
		else
		{
			$set_active = "no";
		}
		
		// create the account with the random number as the password
		
		$expiration_date  = mktime (0,0,0,date("m")  ,date("d")+$config['days_until_listings_expire'],date("Y"));

		$sql = "INSERT INTO " . $config['mls_table_prefix'] . "listingsDB (title, notes, user_ID, active, creation_date, last_modified, expiration) VALUES (\"$edit_title\", '$random_number',  '$userID', '$set_active', ".$conn2->DBDate(time()).",".$conn2->DBTimeStamp(time()).",".$conn2->DBDate($expiration_date).")";
		
		
		if ($conn2->Execute($sql) === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg()); 
		}
		// then we need to retrieve the new listing id
		$sql = "SELECT id FROM " . $config['mls_table_prefix'] . "listingsDB WHERE notes = '$random_number'";
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC;
		$recordSet = $conn2->Execute($sql);
		if ($recordSet === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg());
		}
		while (!$recordSet->EOF)
		{
			$new_listing_id = $recordSet->fields['id']; // this is the new listing's ID number
			$recordSet->MoveNext();
		} // end while
		
		// now it's time to replace the password
		$sql = "UPDATE " . $config['mls_table_prefix'] . "listingsDB SET notes = \"$edit_notes\" WHERE ID = '$new_listing_id'";
		if ($conn2->Execute($sql) === false)
		{
			echo "$sql<br>";
			die($conn2->ErrorMsg());
		}
		$conn2->Close();
		// Listings is now in the database, get all the listingsDB Elements from Import Database
		unset ($z);
		unset ($importme2);
		$sql = "SELECT * FROM " . $config['import_table_prefix'] . "listingsDBElements where listing_id = $importID";
		$conn1 = &ADONewConnection($db['type']);
		$conn1->Connect($db['server'], $db['user'], $db['password'], $db['database']);
		$recordSet2 = $conn1->Execute($sql);
		$z=0;
		while (!$recordSet2->EOF)
		{
			$importme2[$z]['field_name'] = $recordSet2->fields['field_name'];
			if($recordSet2->fields['field_value'] == 'Business')
				$importme2[$z]['field_value'] = "Commercial Opportunities";
			else
				$importme2[$z]['field_value'] = $recordSet2->fields['field_value'];

			$z++;
			$recordSet2->MoveNext();
		}
		$z=0;
		$recordSet2->Close();
		$conn1->Close();
		$conn2 = &ADONewConnection($db2['type']);
		$conn2->Connect($db2['server'], $db2['user'], $db2['password'], $db2['database']);
		
		for ($z=0;$z<count($importme2);$z++) 
		{
			$sql_field_name = $importme2[$z]['field_name'];
			$sql_field_name = ereg_replace ("'","''",$sql_field_name);
			$sql_field_value = $importme2[$z]['field_value'];
			$sql_field_value = ereg_replace ("'","''",$sql_field_value);
			// Insert the ListingsDBElements
			$sql = "INSERT INTO " . $config['mls_table_prefix'] . "listingsDBElements (field_name, field_value, listing_id, user_id) VALUES ('$sql_field_name', \"$sql_field_value\", $new_listing_id, $userID)";
			if ($conn2->Execute($sql) === false)
			{
				echo "$sql<br>";
				die($conn2->ErrorMsg());
			}
		} //End while (!$recordSet2->EOF)
		$conn2->Close();
		// We need to import the listing images
		unset ($z);
		unset ($importme2);
		$sql = "SELECT * FROM " . $config['import_table_prefix'] ."listingsImages where listing_id = $importID";
		$conn1 = &ADONewConnection($db['type']);
		$conn1->Connect($db['server'], $db['user'], $db['password'], $db['database']);
		$recordSet2 = $conn1->Execute($sql);
		$z=0;
		while (!$recordSet2->EOF)
		{
			$importme2[$z]['caption'] = $recordSet2->fields['caption'];
			$importme2[$z]['file_name'] = $recordSet2->fields['file_name'];
			$importme2[$z]['thumb_file_name'] = $recordSet2->fields['thumb_file_name'];
			$importme2[$z]['description'] = $recordSet2->fields['description'];
			$importme2[$z]['rank'] = $recordSet2->fields['rank'];
			$z++;
			$recordSet2->MoveNext();
		}
		$z=0;
		$recordSet2->Close();
		$conn1->Close();
		$conn2 = &ADONewConnection($db2['type']);
		$conn2->Connect($db2['server'], $db2['user'], $db2['password'], $db2['database']);
		
		for ($z=0;$z<count($importme2);$z++) 
		{
			$sql_caption = $importme2[$z]['caption'];
			$sql_caption = ereg_replace ("'","''",$sql_caption);
			$sql_file_name = $importme2[$z]['file_name'];
			$sql_file_name = ereg_replace ("'","''",$sql_file_name);
			$sql_file_name_mls = ereg_replace ($importID.'_',$new_listing_id.'_',$sql_file_name);
			$sql_thumb_file_name = $importme2[$z]['thumb_file_name'];
			$sql_thumb_file_name = ereg_replace ("'","''",$sql_thumb_file_name);
			$sql_thumb_file_name_mls = ereg_replace ('thumb_'.$importID.'_','thumb_'.$new_listing_id.'_',$sql_file_name);
			$sql_description = $importme2[$z]['description'];
			$sql_description = ereg_replace ("'","''",$sql_description);
			$sql_rank = $importme2[$z]['rank'];
			
			// Insert the ListingsDBElements
			$sql = "INSERT INTO " . $config['mls_table_prefix'] . "listingsImages ( user_id, caption, file_name, thumb_file_name, description, listing_id, rank, active) VALUES ($userID, '$sql_caption', '$sql_file_name_mls', '$sql_thumb_file_name_mls', '$sql_description', '$new_listing_id', $sql_rank, '$set_active')";
			if ($conn2->Execute($sql) === false)
			{
				echo "$sql<br>";
				die($conn2->ErrorMsg());
			}
			// Move the actual file.
			$file = $config['path_to_import_images'].'/'.$sql_file_name;
			$file1 = $config['path_to_mls_images'].'/'.$sql_file_name_mls;
			if (!copy($file, $file1)) 
			{
				print ("failed to copy $file...<br>\n");
			}
			$file = $config['path_to_import_images'].'/'.$sql_thumb_file_name;
			$file1 = $config['path_to_mls_images'].'/'.$sql_thumb_file_name_mls;
			if (!copy($file, $file1)) 
			{
				print ("failed to copy $file...<br>\n");
			}
		} //End while (!$recordSet2->EOF)
		$conn2->Close();

		   	     	  

		$recordcount++;
	} // End while (!$recordSet1->EOF)
	echo "Imported $recordcount Records";


	function log_error($sql)
	{
		// logs SQL errrors for later inspection
		global $config, $lang;
		$message = $_SERVER[REMOTE_ADDR]. " -- ".date("F j, Y, g:i:s a")." -- ".$sql."\r\n";
		
		$header = "From: ".$sender." <".$sender_email.">\r\n";
		$header .= "X-Sender: $config['import_email']\r\n";
		$header .= "Return-Path: $config['import_email']\r\n";

		mail("$config['import_email']", "SQL Error", $message, $header);
		die("$lang['alert_site_admin']");
	} // end function log_action
?>