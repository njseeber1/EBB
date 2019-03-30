<?php
	include("include/common.php");
	include("$config[template_path]/user_top.html");
	global $conn, $config, $lang;

	if ($listingID != "")

	{

		if ($action == "mail")

		{

			if ($to == "")
			{
				echo ("<h3>$lang[email_listing_provide_email]</h3> ");
				include("$config[template_path]/user_bottom.html");
				exit;
			}

			if ($sender == "")
			{
				echo ("<h3>$lang[email_listing_enter_name]</h3>");
				include("$config[template_path]/user_bottom.html");
				exit;
			}

			if ($sender_email == "")
			{
				echo ("<h3>$lang[email_listing_enter_email_address]</h3>");
				include("$config[template_path]/user_bottom.html");
				exit;
			}

			$message = $lang[email_listing_default_message];

			$message = stripslashes($message);

			$header = "From: ".$sender." <".$sender_email.">\r\n";
			$header .= "X-Sender: $config[admin_email]\r\n";
			$header .= "Return-Path: $config[admin_email]\r\n";

			$temp = mail($to, $lang[email_listing_default_subject], $message, $header) or print "<h3>Could not send mail.</h3>"; 

			if ($temp = true)
			{
				echo "$lang[email_listing_sent] $to.<P><a href=\"listingview.php?listingID=$listingID\">Return to listing</a>   ";
			}

		}

		else

		{
			echo "<h3>$lang[email_listing_send_listing_to_friend]</h3>";
			echo "<form name=\"mailman\" action=\"email_listing.php\" method=\"post\"> ";
			echo "<table border=\"0\" cellpadding=2 cellspacing=0>";
			echo "<tr><td width=\"120\" align=center>$lang[email_listing_friend_email]:</td><td align=left><input type=text name=\"to\"></td></tr>";
			echo "<tr><td width=\"120\" align=center>$lang[email_listing_your_name]:</td><td align=left><input type=text name=\"sender\"></td></tr>";
			echo "<tr><td width=\"120\" align=center>$lang[email_listing_your_email]:</td><td align=left><input type=text name=\"sender_email\"></td></tr>";

			echo "<tr><td width=\"120\" align=center>$lang[email_listing_your_message]:</td><td align=left><textarea name=\"comment\" cols=60 rows=4></textarea></td></tr>";
			echo "<input type=\"hidden\" name=\"action\" value=\"mail\">";
			echo "<input type=\"hidden\" name=\"listingID\" value=\"$listingID\">";
			echo "<tr><td></td><td align=\"middle\"><input type=\"submit\" value=\"$lang[email_listing_send]\"></td></tr>";
			echo "</table></form>";

		} // end else action != mail

	} // end ($listingID != "")

	else

	{

		echo "<h3>You must have something to email!</h3>";

	}

		

	include("$config[template_path]/user_bottom.html");

?>