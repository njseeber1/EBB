<?php

function logstats()
	{
	global $conn, $lang, $config, $_SERVER;
	
	if (isset($_SERVER['REMOTE_ADDR']))
		$remote_host = $_SERVER['REMOTE_ADDR'];
	else
		$remote_host = "-";

	if (isset($_SERVER['HTTP_REFERER']))
		$referer = $_SERVER['HTTP_REFERER'];
	else
		$referer = "-";

	if (isset($_SERVER['HTTP_USER_AGENT']))
		$user_agent	= $_SERVER['HTTP_USER_AGENT'];
	else
		$user_agent	= "-";

	$request	= "http://" . $_SERVER['HTTP_HOST'] . $_SERVER['PHP_SELF'];
	$a_remote_host	= make_db_safe($remote_host);
	$a_request	= make_db_safe($request);
	$a_referer	= make_db_safe($referer);
	$a_user_agent	= make_db_safe($user_agent);


		$sql = "CREATE TABLE IF NOT EXISTS " . $config[table_prefix] . "stats ( time_str DATETIME, remote_host TEXT, request TEXT, referer TEXT, user_agent TEXT )";
		 $recordSet = $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }
		
		$sql = "INSERT " . $config[table_prefix] . "stats (time_str, remote_host, request, referer, user_agent) VALUES (NOW(), $a_remote_host, $a_request, $a_referer, $a_user_agent)";
		$recordSet = $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

 $conn->Close();
		
} //end function logstats()

?>
