<?php
	///////////////////////////////////////////////////
	// common include file
	// you will have to set your preferences below...
	// please be careful with this file -- make a backup if you're at all worried
	// about screwing stuff up.

	$config = array();
	global $config;


	///////////////////////////////////////////////////
	// SITE INFORMATION
	// make sure this info is accurate
	$config['version'] = '&nbsp;LLC'; //Do Not Modify
	// Your site's web address (don't forget the http://) - leave off the trailing slash
	$config['baseurl'] = 'http://www.eaglebusinessbrokers.com';
	// The actual location of openlistings on the machine -- leave off the trailing slash
	// Windows users need to use double slashes eg. c:��www��open-realty
	$config['basepath'] = 'test/test';
	$config['admin_name'] = 'Jesse Wallace'; // Your name -- all email will come from this name
	$config['admin_email'] = 'Freeziekat@yahoo.com'; // all email which is sent from the site will come from this address
	$config['site_title'] = 'Eagle Business Brokers'.$config['version']; // Site title
	$config['company_name'] = 'Eagle Business Brokers, LLC.'; // Company Name used on Legal Page.
	$config['company_location'] = 'Fly High with us'; // Company Location for header. E.g. "of Susquehanna County, Pennsylvania"
	$config['company_logo'] = '/images/title.jpg'; //Location of company logo.

	///////////////////////////////////////////////////
	// DATABASE TYPE
	// default is mysql -- make sure you edit this file
	// to make sure DB settings are correct!
	global $db_type;
	$db_type = 'mysql';
	// possible choices are: access, ado, db2, ado_access, vfp, fbsql, ibase
	// firebird, borland_ibase, informix, mssql, mysql, mysqlt, maxsql, oci8
	// oci8po, odbc, oracle, postgres, postgres7, sqlanywhere, sybase

	$db_user = 'eaglebusiness';		//database user
	$db_password = 'TWR#-LXZ&*Ry';		//database password
	$db_database = 'eaglebusiness';	//database definition file
	$db_server = 'localhost';		//database server -- usually localhost, but one never knows
	
	// The following is needed only if you are going to use the builtin mysql backup untility.
	// Not required for most functions in the backup utility.
	$phpmyadmin = 'http://127.0.0.1/mysql/index.php';	// Path to phpMyAdmin
	// The following needs to me set to no if your server does not allow you to create indexes.
	$config['manage_index_permissions'] = 'Yes';
	///////////////////////////////////////////////////
	// Table Prefix
	// this allows multiple sites to use the same database, change the value below to a unique 
	// value for every site. Leave it as is for single site installs.
	
	$config['table_prefix'] = "default_"; 

	///////////////////////////////////////////////////
	// TEMPLATE DATA
	//$config[template_path] = $config[basepath].'/template/generic'; // leave off the trailing slashes
	//$config[template_url] = $config[baseurl].'/template/generic'; // leave off the trailing slashes
	$config['template_path'] = $config['basepath'].'/template/blue1'; // leave off the trailing slashes
	$config['template_url'] = $config['baseurl'].'/template/blue1'; // leave off the trailing slashes

	include($config['template_path'].'/style.php'); // style definitions


	///////////////////////////////////////////////////
	//LANGUAGE FILE PATH -- USED FOR MULTI-LANGUAGE SUPPORT
	include($config['basepath'].'/include/language/english.php');


	///////////////////////////////////////////////////
	// DISPLAY SETTINGS
	$config['listings_per_page'] = 10; //number of listings to show on one page:
	$config['add_linefeeds'] = 'yes'; // convert returns to line feeds? yes or no
	$config['strip_html'] = 'yes'; // Should HTML be stripped out of listings? yes or no
	$config['allowed_html_tags'] ='<a><b><i><u><br>'; // which html tags can a person input?
	$config['money_sign'] = '$'; // default is dollars, but it could be "&#163;" for pounds or "&#128;" for euros
	$config['show_no_photo'] = 'yes'; // if a listing doesn't have a photo, should it use the /images/nophoto.gif instead?
	$config['number_format_style'] = '1'; // support for international numbering format. See the documentation for details

	function money_formats ($number)
	{
		global $config;
		// formats prices correctly
		// defaults to $123, but other folks in other lands do it differently
		// uncomment the correct one
		$output = $config['money_sign'].$number; // usa, uk - $123,345
		// $output = $number.$config['money_sign']; // germany, spain -- 123.456,78 �
		// $output = $config['money_sign'].' '.$number"; // honduras -- � 123,456.78
		return $output;
	}

	///////////////////////////////////////////////////
	// UPLOAD SETTINGS
	$config['max_listings_uploads'] = 7; // max # of pics for a given listing
	$config['max_listings_upload_size'] = '10000000'; // (in bytes)
	$config['max_listings_upload_width'] = 900; // max width (in pixels)
	$config['listings_upload_path'] = $config['basepath'].'/images/listing_photos'; // leave off the trailing slash
	$config['listings_view_images_path'] = $config['baseurl'].'/images/listing_photos';

	$config['max_user_uploads'] = 5; // max # of pics for a given user
	$config['max_user_upload_size'] = '1000000';
	$config['max_user_upload_width'] = 900; // max width (in pixels)
	$config['user_upload_path'] = $config['basepath'].'/images/user_photos'; // leave off the trailing slash
	$config['user_view_images_path'] = $config['baseurl'].'/images/user_photos';

	$config['allowed_upload_types'] = array('image/pjpeg','image/jpeg','image/gif', 'image/x-png'); // allowed file types
	$config['allowed_upload_extensions'] = array('jpg','gif','png'); //possible allowed file extensions
	$config['make_thumbnail'] = 'yes'; // use an external thumb