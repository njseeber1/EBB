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
    $config['version'] = '1.1.5b'; //Do Not Modify
    // Your site's web address (don't forget the http://) - leave off the trailing slash
    $config['baseurl'] = 'http://www.liquidconceptions.com';
    // The actual location of openlistings on the machine -- leave off the trailing slash
    // Windows users need to use double slashes eg. c:\\www\\open-realty
    $config['basepath'] = '/home/freeziek/public_html';
    $config['admin_name'] = 'Jesse Wallace'; // Your name -- all email will come from this name
    $config['admin_email'] = 'jesse@liquidexpressions.com'; // all email which is sent from the site will come from this address
    $config['site_title'] = 'Liquid Conceptions '.$config['version']; // Site title
    $config['company_name'] = 'Liquid Conceptions Design Group'; // Company Name used on Legal Page.
    $config['company_location'] = 'COLORADO'; // Company Location for header. E.g. "of Susquehanna County, Pennsylvania"
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

    $db_user = 'freeziek_orlt1';      //database user
    $db_password = 'Nfp[S9SjNLC7';      //database password
    $db_database = 'freeziek_orlt1';  //database definition file
    $db_server = 'localhost';       //database server -- usually localhost, but one never knows

    // The following is needed only if you are going to use the builtin mysql backup untility.
    // Not required for most functions in the backup utility.
    $phpmyadmin = '';   // Path to phpMyAdmin
    // The following needs to me set to no if your server does not allow you to create indexes.
    $config['manage_index_permissions'] = 'Yes';
    ///////////////////////////////////////////////////
    // Table Prefix
    // this allows multiple sites to use the same database, change the value below to a unique
    // value for every site. Leave it as is for single site installs.

    $config['table_prefix'] = "default_";

    ///////////////////////////////////////////////////
    // TEMPLATE DATA
    //$config[template_path] = $config[basepath].'/template/green_dlp'; // leave off the trailing slashes
    //$config[template_url] = $config[baseurl].'/template/green_dlp'; // leave off the trailing slashes
    $config['template_path'] = $config['basepath'].'/template/green_dlp'; // leave off the trailing slashes
    $config['template_url'] = $config['baseurl'].'/template/green_dlp'; // leave off the trailing slashes

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
    $config['max_listings_upload_size'] = '100000'; // (in bytes)
    $config['max_listings_upload_width'] = 700; // max width (in pixels)
    $config['listings_upload_path'] = $config['basepath'].'/images/listing_photos'; // leave off the trailing slash
    $config['listings_view_images_path'] = $config['baseurl'].'/images/listing_photos';

    $config['max_user_uploads'] = 5; // max # of pics for a given user
    $config['max_user_upload_size'] = '100000';
    $config['max_user_upload_width'] = 700; // max width (in pixels)
    $config['user_upload_path'] = $config['basepath'].'/images/user_photos'; // leave off the trailing slash
    $config['user_view_images_path'] = $config['baseurl'].'/images/user_photos';

    $config['allowed_upload_types'] = array('image/pjpeg','image/jpeg','image/gif', 'image/x-png'); // allowed file types
    $config['allowed_upload_extensions'] = array('jpg','gif','png'); //possible allowed file extensions
    $config['make_thumbnail'] = 'yes'; // use an external thumbnailing tool to resize images
    $config['thumbnail_width'] = '100'; // max width (in pixels) of thumbnails
    // This line is for GD Lib Image Support
    $config['path_to_thumbnailer'] = $config['basepath'].'/include/thumbnail_gd.php'; // path to the thumnailing tool
    $config['gdversion2'] = True; // This Sets what version of gdLibs you have installed Set to tru is you have GD >= 2.0

    // These two lines are for ImageMagick Support
    //$config['path_to_thumbnailer'] = $config['basepath'].'/include/thumbnail_imagemagick.php'; // path to the thumnailing tool
    //$config['path_to_imagemagick'] = '/usr/X11R6/bin/convert'; // path to the convert tool, OPTIONAL! (Fill this only if you use ImageMagick)



    ///////////////////////////////////////////////////
    // LISTING EXPIRATION SETTINGS
    $config['use_expiration'] = 'no'; // should the system use expiration? yes or no
    $config['days_until_listings_expire'] = '365'; // listings should be active for this number of days


    ///////////////////////////////////////////////////
    // USER SETTINGS
    $config['allow_user_signup'] = 'yes'; // can users sign up through the web site? yes or no
    $config['user_default_active'] = "yes"; // are new users active by default? yes or no
    $config['user_default_agent'] = "no"; // are new users agents by default?  yes or no
    $config['user_default_admin'] = 'no'; // are new users admins by default?  yes or no
    // I recommend that you leave the following entries marked "no"... unless there's a particular
    // reason you want new users to be able to do administrative tasks by default...
    $config['user_default_feature'] = 'no'; // can new users feature listings by default? yes or no
    $config['user_default_moderate'] = 'no'; // can new users moderate listings by default? yes or no
    $config['user_default_logview'] = 'no'; // can new users view logs by default? yes or no
    $config['user_default_editForms'] = 'no'; // can new users edit forms by default? yes or no
    $config['user_default_canChangeExpirations'] = 'no'; // can users change the expiration dates of their listings? yes or no

    ///////////////////////////////////////////////////
    // RENTAL SEARCH SETTINGS
    $config['rental_step'] = '20';
    $config['max_rental_price'] = '100';
    $config['min_rental_price'] = '800';

    ///////////////////////////////////////////////////
    // MODERATION SETTINGS
    $config['moderate_users'] = "no"; // should new users require moderator approval to be "active?" yes or no
    $config['moderate_listings'] = "no"; // should listings require moderator approval to be "live?" yes or no
    $config['email_notification_of_new_users'] = "yes"; // should the site admin receive an email notification if someone registers? yes or no
    $config['email_notification_of_new_listings'] = 'yes'; // should the site admin receive an email notification if someone adds a listing? yes or no

    ///////////////////////////////////////////////////
    // MISCELLENEOUS SETTINGS
    // you shouldn't have to mess with these things unless you rename a folder, etc...

    // main file location
    include($config['basepath'].'/include/main.php');

    // this is the setup for the ADODB library
    include($config['basepath'].'/include/adodb/adodb.inc.php');
    $conn = &ADONewConnection($db_type);
    $conn->PConnect($db_server, $db_user, $db_password, $db_database);



?>



