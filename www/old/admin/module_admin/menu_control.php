<?php
/* ***************************************************** */
/*    MENU MOD FOR OPEN REALTY 1.1.0+ VERSION 241003     */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../../include/common.php");
global $action, $conn, $config, $lang;
global $title, $linkurl;
loginCheck('Admin');
?>


<?

include("$config[template_path]/admin_top.html");


?>
<table border="<? echo $style['admin_listing_border'] ?>" cellspacing="<? echo $style['admin_listing_cellspacing'] ?>" cellpadding="<? echo $style['admin_listing_cellpadding'] ?>" width="<? echo $style['admin_table_width'] ?>" class="form_main">
		<tr>
			
			<td valign="top" align="center">	
<?php

//make the menu for the admin to get around
function writemenu()
{
global $PHP_SELF, $lang, $config;
echo "<table align=center width=100% border=1><tr><td align=center width=100%><h3>$lang[menu_admin_page_header]</h3><a href=\"$PHP_SELF?action=\">$lang[menu_admin_menu_main]</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?action=add\">$lang[menu_admin_menu_add_new]</a></td></tr></table>";
} 

writemenu();


# ==================================================== #
#                  NEW PAGE SCREEN                     #
# ==================================================== #
if($action=="add")
{
global $conn, $config, $lang;
if($title||$linkurl||$place)
{


			
			$sql = "INSERT INTO ".$config['table_prefix']."menu (place, title, linkurl) VALUES ('$place', '$title', '$linkurl')";

				$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; 
				
					$recordSet = $conn->Execute($sql); 
					
					if ($recordSet === false)  
							{ 	
							log_error($sql); 	
							} 
					 else 
							 { 
							 
									echo "<p style=\"color: green;\">$lang[menu_admin_the_menu_item]<b>$title</b> $lang[menu_admin_add_success] </p><br>$lang[menu_admin_notification_1]<hr>";
							log_action ("Created Menu Item $title");
								echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?action=main>";
							}
		    


				}
		
	else
		{
echo "<form action=\"$PHP_SELF\" method=\"post\">";
?>
<!--//title -->
<b><?php echo $lang['menu_admin_Title'] ?></b>:<br><i><?php echo $lang['menu_admin_title_hint'] ?></i><br><input name="title" type="text" value="" size="35" maxlength="70"><br>
<!--//linkurl -->
<br><b><?php echo $lang['menu_admin_linkurl'] ?></b>:<br><i><?php echo $lang['menu_admin_linkurl_hint'] ?></i><br><input name="linkurl" type="text" value="" size="64" maxlength="255"><br>
<!--//link placement -->
<br><b><?php echo $lang['menu_admin_link_placement'] ?></b>:<br><i><?php echo $lang['menu_admin_link_placement_hint'] ?></i><br><input name="place" type="text" value="" size="3" maxlength="3"><br>

<!--//submit and close -->
<br><input name="action" type="hidden" value="add">
<input type="submit" value="Add Menu Item">
</form>
<?php
	}
			}//end action
			
			
# ==================================================== #
#                  EDIT SCREEN                         #
# ==================================================== #
if($action=="edit")
{
//If they have entered data into the form, do this
if($title||$linkurl||$place)
{
$sql = "UPDATE ".$config['table_prefix']."menu SET place='$place', title='$title', linkurl='$linkurl' WHERE id='$id'";
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; 
				
					$recordSet = $conn->Execute($sql); 
					
					if ($recordSet === false)  
						{ 	
							log_error($sql); 	
						} 


if($sql)
{
echo "$lang[menu_admin_the_menu_item]<i>$title</i>$lang[menu_admin_update_success]<br>";
log_action ("Edited Page $title");
								
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?action=>";
}
else
{
echo ">$lang[menu_admin_update_failed]<br>";
}
}

//give them the form
else
{
$sql = "SELECT * FROM ".$config['table_prefix']."menu WHERE id='$id'";
		$ADODB_FETCH_MODE = ADODB_FETCH_ASSOC; 
				
					$recordSet = $conn->Execute($sql); 
					
					if ($recordSet === false)  
						{ 	
							log_error($sql); 	
						} 
while (!$recordSet->EOF)
				{
			
	$title = make_db_unsafe ($recordSet->fields['title']);
	$place = make_db_unsafe ($recordSet->fields['place']);
	$linkurl = make_db_unsafe ($recordSet->fields['linkurl']);	
	
		$recordSet->MoveNext();
				  } 

echo "<form action=\"$PHP_SELF\" method=\"post\"><input name=\"id\" type=\"hidden\" value=\"$id\"><b>$lang[menu_admin_Title]</b>:<br><i>$lang[menu_admin_title_hint]</i><br><input name=\"title\" type=\"text\" value=\"$title\" size=\"35\" maxlength=\"70\"><br><b>$lang[menu_admin_linkurl]</b>:<br><i>$lang[menu_admin_linkurl_hint]</i><br><input name=\"linkurl\" type=\"text\" value=\"$linkurl\" size=\"64\" maxlength=\"255\"><b>$lang[menu_admin_link_placement]</b>:<br><i>$lang[menu_admin_link_placement_hint]</i><br><input name=\"place\" type=\"text\" value=\"$place\" size=\"3\" maxlength=\"3\"><br><br><br><input name=\"action\" type=\"hidden\" value=\"edit\"><input type=\"submit\" value=\"$lang[menu_admin_update]\"></form>";
}

}

# ==================================================== #
#                  DELETE SCREEN                       #
# ==================================================== #
	if($action=="delete")
	{
			if($id)
			{
			#Retrieve title from the database for the log#
			$sql = "SELECT * FROM ".$config['table_prefix']."menu WHERE id=$id";
			$recordSet = $conn->Execute($sql);
					if ($recordSet === false)
					{
						log_error($sql);
					}
			while (!$recordSet->EOF)
		{
		$id = $recordSet->fields['id'];
		$title = make_db_unsafe ($recordSet->fields['title']);
			#log the delete#
			log_action ("Deleted Menu Item $title");
			$recordSet->MoveNext();
		}//end log info retrieval
		# now we can delete it #
			$sql = "DELETE FROM ".$config['table_prefix']."menu WHERE id='$id'";
					$recordSet = $conn->Execute($sql);
							if ($recordSet === false)
								{
									log_error($sql);
								}
			if($sql)
					{
					echo "$lang[menu_admin_delete_success]";

								echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?action=main>";
					}
			else
					{
					echo "$lang[menu_admin_delete_failed]";
					}
			}//end id

	}//end action




if($action=="main"||!$action)
{


		$sql = "SELECT id, place, title, linkurl, hits FROM ".$config['table_prefix']."menu ORDER BY place ASC";
		$recordSet = $conn->Execute($sql);
		if ($recordSet === false)
		{
			log_error($sql);
		}
		echo "<h3 align=\"center\">Menu Elements</h3>";

echo "<table border =\"1\" rules=\"rows\" frame=\"void\" width=\"90%\" cellspacing=\"12\" cellpadding=\"0\"><tr><td><b>$lang[menu_admin_ID]</b></td><td><b>$lang[menu_admin_order]</b></td><td><b>$lang[menu_admin_link_text]</b></td><td><b>$lang[menu_admin_file_address]</b></td><td><b>$lang[menu_admin_hits]</b></td><td><b>$lang[menu_admin_edit]</b></td><td><b>$lang[menu_admin_delete]</b></td></tr>";
		while (!$recordSet->EOF)
		{
	$id = $recordSet->fields['id'];
	$title = $recordSet->fields['title'];
	$place = $recordSet->fields['place'];
	$linkurl = $recordSet->fields['linkurl'];
	$hits = $recordSet->fields['hits'];

			
echo "<tr><td>$id</td><td>$place</td>";
echo "<td><a href=\"$config[baseurl]/$linkurl\" target=\"_blank\"><b>$title</b></a></td>";
echo "<td>$linkurl</td>";
echo "<td>$hits</td>";
echo "<td><a href=\"$PHP_SELF?action=edit&id=$id\">$lang[menu_admin_edit]</a>";
echo "</td><td><a href=\"$PHP_SELF?action=delete&id=$id\" onClick=\"return confirmDelete()\">$lang[menu_admin_delete]</a>";
echo "</td></tr>";

$recordSet->MoveNext();
} // end while

echo "</table>";


}
?>
</td></tr></table>
<?php

	include("$config[template_path]/admin_bottom.html");
?>