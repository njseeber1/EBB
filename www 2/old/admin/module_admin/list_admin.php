<?php
/* ***************************************************** */
/*       MAILING LIST MOD FOR OPEN REALTY 1.1.0+         */
/*                   VERSION 010904                      */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../../include/common.php");
global $conn, $config, $lang;
include("$config[template_path]/admin_top.html");
	?><table border="<? echo $style['admin_listing_border'] ?>" cellspacing="<? echo $style['admin_listing_cellspacing'] ?>" cellpadding="<? echo $style['admin_listing_cellpadding'] ?>" width="<? echo $style['admin_table_width'] ?>" class="form_main">
		<tr>
			
			<td valign="top" align="center">	
		<div align="center"><h3><? echo "$config[site_title]";?> Mailing List.</h3>	</div><br>
<p align="center" style="FONT-SIZE: 11px;">Use this form to send a complete list of the newest listings to people on your mailing list.<br>Unless you want to add more text to the message it has been prewritten for you.</p>

			
			<?
$vars=explode(",","send,subject,message,email,action"); 
foreach($vars as $v){ 
if ($HTTP_GET_VARS[$v]!=""){$$v=$HTTP_GET_VARS[$v];} 
if ($HTTP_POST_VARS[$v]!=""){$$v=$HTTP_POST_VARS[$v];} 
} 
//THIS MUST AIM AT YOUR MAIL_LIST.TXT (CHMOD=777)
$getfile="lists/mail_list.txt";
if (!file_exists($getfile)) {
@chmod ($getfile, 0777);
	$newfile = fopen($getfile,"w+");
	fclose($newfile);
	}
$newfile = fopen($getfile,"r");
$content = fread($newfile, filesize($getfile));
fclose($newfile);
$content=stripslashes($content);
$out="";
$lines = explode("%",$content);
foreach($lines as $l){
	if ($l != $email){$out .= "%".$l;}
	else{$found=1;}
}


	if ($send != "yes" && $send != "test"){
$mailheaders .= "Content-Type: text/html; charset=iso-8859-1\n";
function mail_latest($num_of_listings)
	{
	//to send more information need to start calls here
	/*Maybe it would be better to send some detail other than a link. Could show where it is and the agent as an improvement.. Something to add in future RO*/
global $config, $conn, $lang;
		$sql = "SELECT ID, Title FROM ".$config[table_prefix]."listingsDB WHERE (".$config[table_prefix]."listingsDB.active = 'yes') ORDER BY creation_date DESC";
		$recordSet = $conn->SelectLimit($sql, $num_of_listings, 0);
		while (!$recordSet->EOF)
		{
			$ID = make_db_unsafe ($recordSet->fields[ID]);
			$Title = make_db_unsafe ($recordSet->fields[Title]);
echo " $Title:\n$config[baseurl]/listingview.php?listingID=$ID\n";
			$recordSet->MoveNext();
		} // end while
		echo "";
	} // end function mail_latest
{
echo "<table align=\"center\"><tr><th>";
echo "<form method=\"post\"><input type=\"hidden\" name=send value=yes>";
echo "Email Subject:<input type=\"text\" name=\"subject\" size=20 value=\" $lang[list_admin_mail_subject]\"><br><br>";
//information text for admin     
echo "<b>$lang[list_admin_mail_info]</b>:<br>";
//open the letter
echo "<textarea cols=70 rows=10 name=\"message\" wrap=\"soft\">";
echo "$mailheader";
//edit the message above the links in your language file
echo "$lang[list_admin_mail_message]\n\n";
//send the links alter this number to suit listings to be sent
mail_latest(5); 
//add remove me link
echo "\n$lang[list_mail_removeme]";
//close the letter
print '</textarea><br><br>
     <input type="submit" value="send"> 
     </form>';
	 echo "</th></tr></table>";
}
}
$mailheaders = "From: $config[site_title]\n";
$mailheaders .= "Reply-To:$config[admin_email]\n";
if ($send == "yes"){
	$message=stripslashes($message);
	$subject=stripslashes($subject);
	$lines = explode("%",$content);
		for ($key=1;$key<sizeof($lines);$key++){
		mail ($lines[$key],$subject,$message,$mailheaders);
		}// this is a prinout of the email sent
		echo "<table align=\"center\" width=\"400\"><tr><td>";
	print "<b>The following email has been sent!</b>";
	print "<pre>$mailheaders\n$subject\n$message</pre>";
		echo "</td></tr></table>";
	}
include("$config[template_path]/admin_bottom.html");
?>

