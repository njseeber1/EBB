<?php
/* ***************************************************** */
/*       MAILING LIST MOD FOR OPEN REALTY 1.1.0+         */
/*                   VERSION 010904                      */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../include/common.php");
global $conn, $config, $lang, $action;
//get the path to the mailing list file
$listat = $config['basepath'].'/admin/module_admin/lists/mail_list.txt';

//top template include
include("$config[template_path]/user_top.html");
?>
	
<table border="<?php echo $style['admin_listing_border'] ?>" cellspacing="<?php echo $style['admin_listing_cellspacing'] ?>" cellpadding="<?php echo $style['admin_listing_cellpadding'] ?>" width="<?php echo $style['admin_table_width'] ?>" class="form_main">
		<tr>
			
			<td>	
		<div align="center">		<h3>
Welcome to the <?php echo $config['site_title']; ?> Mailing List.
		</h3>	</div>
<br>
<p align="center" style="FONT-SIZE: 11px;">The main use of this feature is to keep you upto date with new propertys as they are added to the site.<br>Your email address is completely safe here and will not be used for any other purpose or given to any third party. There are two options subscribe or unsubscribe. Your email address is required for both and all changes are instant</p>

			
			<?php



echo "<table  align=\"center\"><tr><td align=\"center\" style=\"FONT-SIZE: 11px; COLOR: #cc0000;\">";

/* *************************************************************
* List file Check 
***************************************************************/
			if (!file_exists($listat)) 
			{
			global $config, $found, $action;
			@chmod ($listat, 0777);
				$newfile = fopen($listat,"w+");
				fclose($newfile);
			}
				else
					{
						echo "";
					}
			$newfile = fopen($listat,"r");
			$content = fread($newfile, filesize($listat));
			fclose($newfile);
			$content=stripslashes($content);
			$out="";
			$lines = explode("%",$content);
		foreach($lines as $l)
		{
			if ($l != $email)
			{
			$out .= "%".$l;
			}
				else
				{
				$found=1;
				}
		}//end if exist
		
/* *************************************************************
* simple email format check
***************************************************************/
			function checkmail($string)
			{
			global $email;
				return preg_match("/^[^\s()<>@,;:\"\/\[\]?=]+@\w[\w-]*(\.\w[\w-]*)*\.[a-z]{2,}$/i",$string);
			}
/* *************************************************************
* Visitor Want to be added to the list
***************************************************************/		
	if ($action=="sign")
	{			
	global $lang, $config, $found, $action;
		if ($found==1 or $email=="" or !checkmail($email) or preg_match("/".$config['admin_email']."/",$email))
		{
		if ($email=="")
		{
		echo $lang['email_listing_enter_email_address'];
		}//end if email""
			else if ($found==1)
			{
			echo $lang['list_sub_fail'],$lang['list_doubled_email'];
			}//end found match
			else if (!checkmail($email))
			{
			echo $lang['list_sub_fail'],$lang['list_fake_email'];
			}//end checkemail
			else if (preg_match("/".$config[admin_email]."/",$email))
			{
		echo $lang['list_sub_fail'],$lang['list_site_email'];
			}//end sites email used
	$disp="yes";
		}//end checkall maybes
				else {
					$disp="no";
					$newfile = fopen($listat,"a+");
					$add = "%".$email;
					fwrite($newfile, $add);
					fclose($newfile);
					echo $lang['list_subscribe_confirm'];
					mail ($config['admin_email'],"New newsletter subscriber.",$email."\nDelete? $config[baseurl]list_public.php?action=delete&email=".$email,"From: Newsletter\nReply-To: $email\n");
					$submailheaders = "From: $config[site_title] subscription form\n";
					$submailheaders .= "Reply-To: $config[admin_email]\n";
					mail ($email,$config['site_title']." subscription",$lang['list_subscribe_email'],$submailheaders);
		}//end display
	}//end sign
	
/* *************************************************************
* Visitor Wants to be removed from the list
***************************************************************/
	
		if ($action=="delete")
		{		
		global $lang, $config, $found, $action;
		$disp="no";
			if ($found == 1)
			{
			@chmod ($listat, 0777);
			$newfile = fopen($listat,"w+");
			fwrite($newfile, $out);
			fclose($newfile);
			echo $lang['list_unsubscribe_confirm'];
			$disp="no";
			}//end foundit
					if ($found != 1)
					{
					echo "<font color=Red><b><u>$lang[list_unsub_fail]</u></b></font><br>";
					$disp="YES";
					}//end cant find
		}//end delete
		
/* *************************************************************
* 
**************************************************************
		$vars=explode(",","send,subject,message,email,action"); 
			foreach($vars as $v){ 
			
					if ($HTTP_GET_VARS[$v]!="")
					{
						$$v=$HTTP_GET_VARS[$v];
					} 
						else
						{
							echo "";
						}
					if ($HTTP_POST_VARS[$v]!="")
					{
					$$v=$HTTP_POST_VARS[$v];
					} 
						else
						{
							echo "";
						}
			} //end foreach*/
			
/* *************************************************************
* Main Page (subscribe, Unsubscribe)
***************************************************************/
echo "</td></tr></table>";
echo "<table border=\"0\" align=\"center\" style=\"FONT-SIZE: 11px;\"><tr><td align=\"center\">";

	echo "<form method=\"post\">";
	echo "$lang[email_listing_your_email]<br><input type=\"text\" name=\"email\" size=\"40\" /><br>";
	echo "$lang[list_subscribe]&nbsp;<input type=\"radio\" name=\"action\" value=\"sign\" checked=\"checked\" />&nbsp;&nbsp;";
	echo "&nbsp;&nbsp;<input type=\"radio\" name=\"action\" value=\"delete\" />$lang[list_unsubscribe]<br><br>";
	echo "<input type=\"submit\" value=\"$lang[list_submit]\"/></form>";

echo "</td></tr></table>";
?>
</td>
<!--- Optional Use of Featured Listings On right --->
			<td valign="top">
				<?php renderFeaturedListingsVertical(4); ?>
			</td>
			<!--- Close the table --->
		</tr>
	</table>
	
<?php
//footer include
include("$config[template_path]/user_bottom.html");
?>