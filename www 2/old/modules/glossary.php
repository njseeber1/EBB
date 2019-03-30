<?php
/* ***************************************************** */
/*  GLOSSARY MOD FOR OPEN REALTY 1.1.0+ VERSION 010804   */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../include/common.php");
global $action, $lang, $config;
include("$config[template_path]/user_top.html");
?> 
<!-- begin the O-R Table -->
<table border="<?php echo $style[admin_listing_border] ?>" cellspacing="<?php echo $style[admin_listing_cellspacing] ?>" cellpadding="<?php echo $style[admin_listing_cellpadding] ?>" width="<?php echo $style[admin_table_width] ?>" class="form_main">
		<tr><td valign="top" width="100%">
		<!-- Begin the page table -->
<table width='100%' border='0' cellspacing='2' cellpadding='2'> 
  <tr><td align="center"> <?
echo "<table cellspacing=\"2\" cellpadding=\"2\" border=\"0\" align=\"center\"><tr><td><h3>$lang[gloss_page_head]</h3></td>";
echo "<td align=\"right\"><form name=\"getword\" action=\"$PHP_SELF\" method=\"get\"><input name=\"word\" type=\"text\" value=\"\"> <input type=\"submit\" value=\"$lang[gloss_search]\"></form></td>";
echo "</tr><tr><td colspan=\"2\">$lang[gloss_welcome_text]</td>";
echo "</tr><tr><td colspan=\"2\" align=\"center\">";
echo "<a href=\"$PHP_SELF?letter=number\">#</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=A\">$lang[gloss_a]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=B\">$lang[gloss_b]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=C\">$lang[gloss_c]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=D\">$lang[gloss_d]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=E\">$lang[gloss_e]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=F\">$lang[gloss_f]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=G\">$lang[gloss_g]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=H\">$lang[gloss_h]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=I\">$lang[gloss_i]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=J\">$lang[gloss_j]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=K\">$lang[gloss_k]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=L\">$lang[gloss_l]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=M\">$lang[gloss_m]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=N\">$lang[gloss_n]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=O\">$lang[gloss_o]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=P\">$lang[gloss_p]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=Q\">$lang[gloss_q]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=R\">$lang[gloss_r]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=S\">$lang[gloss_s]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=T\">$lang[gloss_t]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=U\">$lang[gloss_u]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=V\">$lang[gloss_v]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=W\">$lang[gloss_w]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=X\">$lang[gloss_x]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=Y\">$lang[gloss_y]</a>&nbsp;&nbsp;";
echo "<a href=\"$PHP_SELF?letter=Z\">$lang[gloss_z]</a>&nbsp;&nbsp;";
echo "</td></tr></table>";
echo "<HR>";?>
  </td> 
    </tr>      
<tr> 
<td> 

<?php  if (!isset($goto))  {   ?> 

<?
$db = mysql_connect("$db_server", "$db_user", "$db_password");
mysql_select_db("$db_database", $db);
if($word)
{
$getWord=mysql_query("SELECT word,definition FROM ".$config['table_prefix']."glossary WHERE word LIKE '%$word%' ORDER BY id", $db);

if($getWordArray=mysql_fetch_array($getWord))
{
echo "$lang[gloss_reults_for] $word:<br>";
do
{
echo "<br><b>$getWordArray[word]:</b>";

echo "<p>$getWordArray[definition]</p>";


}
while($getWordArray=mysql_fetch_array($getWord));

}
else
{
echo "$lang[gloss_no_match] $word";
}
}
if($letter)
{
if($letter=="number")
{
$getWord=mysql_query("SELECT word,definition FROM ".$config['table_prefix']."glossary WHERE word LIKE '0%' OR word LIKE '1%' OR word LIKE '2%' OR word LIKE '3%' OR word LIKE '4%' OR word LIKE '5%' OR word LIKE '6%' OR word LIKE '7%' OR word LIKE '8%' OR word LIKE '9%' ORDER BY id", $db);
}
else
{
$getWord=mysql_query("SELECT word,definition FROM ".$config['table_prefix']."glossary WHERE word LIKE '$letter%' ORDER BY id", $db);
}

if($getWordArray=mysql_fetch_array($getWord))
{
echo "$lang[gloss_reults_for] <b>$letter:</b><br><dl>";
do
{
echo "<br><b>$getWordArray[word]:</b>";
echo "<p>$getWordArray[definition]</p>";

}
while($getWordArray=mysql_fetch_array($getWord));
echo "</dl>";
}
else
{
echo "$lang[gloss_no_info] <b>$letter</b>";
}
}
if(!$word&&!$letter)
{
echo "<br>";
}
if($word||$letter)
{
echo "<HR>";
}
?>
    
<?php }  ?> 

   
<!-- ENTER FOOTER INFORMATION  -->
<p></p>
<!-- END OF FOOTER INFORMATION  -->
</td> </tr> </table> 
	
</td>

</tr></table>


<?php

	include("$config[template_path]/user_bottom.html");
?>    