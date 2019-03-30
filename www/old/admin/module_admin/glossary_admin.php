<?php
/* ***************************************************** */
/*  GLOSSARY MOD FOR OPEN REALTY 1.1.0+ VERSION 010804   */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../../include/common.php");
global $id, $action, $lang, $config;
loginCheck('Admin');
$db = mysql_connect("$db_server", "$db_user", "$db_password");
mysql_select_db("$db_database", $db);
include("$config[template_path]/admin_top.html");
function writemenu()
{
global $action, $lang, $config;
echo "<table align=center width=100% border=1  bordercolor=Gray><tr><td align=center width=100%>";
echo "<h3>$lang[admin_gloss_menu_header]</h3>";
echo "<a href=\"$PHP_SELF?\">$lang[admin_gloss_menu_home]</a>]&nbsp;[";
echo "<a href=\"$PHP_SELF?page=add\">$lang[admin_gloss_menu_addnew]</a>]&nbsp;[";
echo "<a href=\"$PHP_SELF?page=help\">$lang[admin_gloss_menu_help]</a>]";
echo "</td></tr></table>";

} 

?> 
<!-- begin the O-R Table -->
<table border="<?php echo $style[admin_listing_border] ?>" cellspacing="<?php echo $style[admin_listing_cellspacing] ?>" cellpadding="<?php echo $style[admin_listing_cellpadding] ?>" width="<?php echo $style[admin_table_width] ?>" class="form_main">
		<tr><td valign="top" width="100%">
		<!-- Begin the page table -->
<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr><td align="center"> 
<?   writemenu();  ?>
  </td> 
    </tr>      
<tr> 
<td align="center" width="100%">
<? 
if ( file_exists("../../glossary_install.php" ) ) {
			echo "<div align=\"center\"><h4 style='color:#ff0000;'>$lang[admin_gloss_install_file_warn]</h4></div>";
		}
if (!isset($page))  {    $page = "add";   ?> 

<table width="100%" border="0" cellspacing="2" cellpadding="2" align="center"> 
  <tr> 
  <td align="center" width="100%"> 

    <?   
//echo "<a href=\"$PHP_SELF?page=add\">Add a word</a>&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?page=help\">Help</a><br><br>";

$getWords=mysql_query("SELECT * FROM ".$config[table_prefix]."glossary ORDER BY word");
if($getcurrentarray=mysql_fetch_array($getWords))
{
echo "<table width=\"100%\" cellspacing=\"1\" cellpadding=\"0\" border=\"1\" bordercolor=\"Gray\" rules=\"rows\" align=\"center\">";
echo "<tr style=\"font-size:10px;\">";
echo "<th align=\"left\" nowrap>$lang[admin_gloss_list_word]</th>";
echo "<td width=\"10\"><img src=\"no.gif\" width=\"15\" height=\"1\" border=\"0\"></td>";
echo "<th align=\"left\" width=\"100%\">$lang[admin_gloss_list_meaning]</th>";
echo "<td width=\"10\"><img src=\"no.gif\" width=\"15\" height=\"1\" border=\"0\"></td>";
echo "<th>$lang[admin_gloss_list_editlink]</th>";
echo "<td width=\"10\"><img src=\"no.gif\" width=\"15\" height=\"1\" border=\"0\"></td>";
echo "<th>$lang[admin_gloss_list_deletelink]</th>";
echo "<td width=\"10\"><img src=\"no.gif\" width=\"15\" height=\"1\" border=\"0\"></td>";
echo "</tr>";
do
{
//show the word array
echo " <tr><td nowrap><b>$getcurrentarray[word]</b></td>";
echo "<td></td>";
//show the description array
echo "<td><i>$getcurrentarray[definition]</i></td>";
//spacer
echo "<td></td>";
//conect this word to the edit by ID   
echo "<td align=\"center\"><a href=\"$PHP_SELF?page=edit&id=$getcurrentarray[id]\">$lang[admin_gloss_list_editlink]</a></td>";
//spacer
echo "<td></td>";
//connect this word to delete by id
echo "<td align=\"center\"><a href=\"$PHP_SELF?page=delete&id=$getcurrentarray[id]\">$lang[admin_gloss_list_deletelink]</a>";
echo "</td>";
//spacer
echo "<td></td></tr>";

//get all the words from database and repeat above for each
}
while($getcurrentarray=mysql_fetch_array($getWords));
//close the table
echo "</table>";
}
else
{//if theres none what to do
echo "<br><br>$lang[admin_gloss_database_empty] <a href=\"$PHP_SELF?page=add\">$lang[admin_gloss_menu_addnew]</a>";
}
	   ?>
  </td> 
    </tr> 
</table>
<?php }  else if ($page == "help")  {    $page = "add";  ?>

<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
 If any help is required put it here 
  </td> 
  </tr> 
</table>     

<?php }  else if ($page == "add")  {    $page = "edit";  ?> 

<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
<?
if($word&&$definition)
{
$addWord=mysql_query("INSERT INTO `".$config[table_prefix]."glossary` (`word`, `definition`) VALUES ('$word', '$definition')", $db);
if($addWord)
{
echo "$word $lang[admin_gloss_success_add]<br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
if(!$addWord)
{
echo "$lang[admin_gloss_error_adding] $word<br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
}
if(!$word||!$definition)
{
echo "
<form name=\"glossary\" action=\"$PHP_SELF?\" method=\"post\">
<b>$lang[admin_gloss_list_word]</b>
<br>
<i>$lang[admin_gloss_word_info]</i>
<br>
<input name=\"word\" type=\"text\" value=\"\" maxlength=\"40\">
<br>
<br>
<b>$lang[admin_gloss_list_meaning]</b>
<br>
<i>$lang[admin_gloss_meaning_info]</i>
<br>
<textarea name=\"definition\" rows=\"6\" cols=\"50\" ></textarea>
<br>
<input name=\"page\" type=\"hidden\" value=\"add\">
<input type=\"submit\" value=\"$lang[admin_gloss_button_add]\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" value=\"$lang[admin_gloss_button_reset]\">
</form>
";
}
?>
  </td> 
  </tr> 
</table> 
<?php }  else if ($page == "edit")  {    $page = "delete";  ?> 

<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
<?
if($word&&$definition)
{
$$edit_data=mysql_query("UPDATE ".$config[table_prefix]."glossary SET word='$word', definition='$definition' WHERE id='$id'",$db);
if($$edit_data)
{
echo "$lang[admin_gloss_success_edit] $word <br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
if(!$$edit_data)
{
echo "$lang[admin_gloss_error_edit] $word<br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
}
if(!$word&&!$defintion)
{
$dbconn=mysql_query("SELECT * FROM `".$config[table_prefix]."glossary` WHERE id=$id",$db);
if($getdata=mysql_fetch_array($dbconn))
{
echo "
<form name=\"glossary\" action=\"$PHP_SELF?\" method=\"post\">
<b>$lang[admin_gloss_list_word]</b>
<br>
<i>$lang[admin_gloss_word_info]</i>
<br>
<input name=\"word\" type=\"text\" value=\"";
printf($getdata["word"]);
echo "\" maxlength=\"40\">
<br>
<br>
<b>$lang[admin_gloss_list_definition]</b>
<br>
<i>$lang[admin_gloss_meaning_info]</i>
<br>
<textarea name=\"definition\" rows=\"6\" cols=\"50\" >";
printf($getdata["definition"]);
echo "</textarea>
<br>
<input name=\"page\" type=\"hidden\" value=\"edit\">
<input name=\"id\" type=\"hidden\" value=\"$id\">
<input type=\"submit\" value=\"$lang[admin_gloss_button_update]\">&nbsp;&nbsp;&nbsp;&nbsp;<input type=\"reset\" value=\"$lang[admin_gloss_button_reset]\">
</form>
";
}
else
{
echo "$lang[admin_gloss_general_error]";
}
}
?>
  </td> 
  </tr> 
</table> 

<?php }  else if ($page == "delete")  {    $page = "main";  ?>

<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr> 
  <td> 
<?
if($check=="yes")
{
$delete_data=mysql_query("DELETE FROM ".$config[table_prefix]."glossary WHERE id=$id",$db);
if($delete_data)
{
echo "$lang[admin_gloss_success_delete]<br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
if(!$delete_data)
{
echo "$lang[admin_gloss_delete_error]<br> <br>$lang[admin_gloss_redirect_wait]";
echo "<meta http-equiv=\"refresh\" content=2;URL=$PHP_SELF?>";
}
}
else
{
$getDeleteInfo=mysql_query("SELECT * FROM ".$config[table_prefix]."glossary WHERE id='$id'",$db);
$deleteInfo=mysql_fetch_array($getDeleteInfo);
echo "$lang[admin_gloss_verify_delete]<br>";
echo "
<dl>
<dt><b>
";
printf($deleteInfo["word"]);
echo "
</b></dt>
<dd>
";
printf($deleteInfo["definition"]);
echo "
</dd>
</dl>
";
echo "<br><a href=\"$PHP_SELF?page=delete&id=$id&check=yes\">$lang[admin_gloss_yes]</a>&nbsp;&nbsp;&nbsp;<a href=\"$PHP_SELF?\">$lang[admin_gloss_no]</a>";
}
?>
  </td> 
  </tr> 
</table> 

<?php }  ?> 

   
<!-- ENTER FOOTER INFORMATION  -->
<p>
<?php echo $lang[admin_gloss_footer]; ?>
</p>
<!-- END OF FOOTER INFORMATION  -->
</td> </tr> </table> 
	
</td>

</tr></table>


<?php

	include("$config[template_path]/user_bottom.html");
?>    