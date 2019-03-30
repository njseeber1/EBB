<?php
	include("../../include/common.php");
	loginCheck('Admin');
	include("$config[template_path]/admin_top.html");


echo "<center><h3>$lang[status_page_header]</h3>";

$data = shell_exec('uptime');
$uptime = explode(' up ', $data);
$uptime = explode(',', $uptime[1]);
$uptime = $uptime[0].', '.$uptime[1];
$server = $_SERVER[SERVER_NAME];
$software = $_SERVER[SERVER_SOFTWARE];
$o_system = $_ENV[OS];
$s_admin = $_SERVER[SERVER_ADMIN];






echo "<table align=\"center\" width=\"90%\" cellspacing=\"2\" cellpadding=\"2\" border=\"0\">";
echo "<tr>";
    echo "<th colspan=\"6\">$lang[status_Server_Information]</th>";
echo "</tr><tr>";
    echo "<td colspan=\"3\" align=\"right\"><b>$lang[status_Current_server_uptime]:&nbsp;</b></td><td colspan=\"3\">$uptime</td>";
echo "</tr><tr>";
    echo "<td colspan=\"3\" align=\"right\"><b>$lang[status_Server_name]:&nbsp;</b></td><td colspan=\"3\">$server</td>";
echo "</tr><tr>";
    echo "<td colspan=\"3\" align=\"right\"><b>$lang[status_Server_software]:&nbsp;</b></td><td colspan=\"3\">$software</td>";
echo "</tr><tr>";
    echo "<td colspan=\"3\" align=\"right\"><b>$lang[status_Operating_System]:&nbsp;</b></td><td colspan=\"3\">$o_system</td>";
echo "</tr><tr>";
    echo "<td colspan=\"3\" align=\"right\"><b>$lang[status_Server_Admin]:&nbsp;</b></td><td colspan=\"3\">$s_admin</td>";
	
	
echo "</tr><tr><th colspan=\"6\" align=\"center\" valign=\"top\">&nbsp;<br>* $lang[status_SERVICES] *<br>&nbsp;</th></tr><tr>";


    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_FTP]:&nbsp;</b></td>";
     if($connect = @fsockopen("localhost", 21, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
}
    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_SSH]:&nbsp;</b></td>";
     if($connect = @fsockopen("localhost", 22, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
}

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_TELNET]:&nbsp;</b></td>";
     if($connect = @fsockopen("localhost", 23, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
} 

echo "</tr><tr>";

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_SMTP]:&nbsp;</b></td>";
    if($connect = @fsockopen("localhost", 25, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
} 

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_HTTP]:&nbsp;</b></td>";
     if($connect = @fsockopen("localhost", 80, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
} 

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_POP3]:&nbsp;</b></td>";
    if($connect = @fsockopen("localhost", 110, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
}

 
echo "</tr><tr>";

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_IMAP]:&nbsp;</b></td>";
    if($connect = @fsockopen("localhost", 143, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
} 

    echo "<td width=\"16%\" align=\"right\"><b>$lang[status_HTTPS]:&nbsp;</b></td>";
    if($connect = @fsockopen("localhost", 443, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
}  

   echo " <td width=\"16%\" align=\"right\"><b>$lang[status_MYSQL]:&nbsp;</b></td>";
    if($connect = @fsockopen("localhost", 3306, $errno, $errstr, 30)) {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Online]\" src=\"images/greendot.jpg\"></td>";
} else {
echo "<td width=\"16%\"><img alt=\"$lang[status_System_Offline]\" src=\"images/reddot.jpg\"></td>";
} 


echo "</tr></table>";





	include("$config[template_path]/admin_bottom.html");

	$conn->Close(); // close the db connection
?>