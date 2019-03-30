<?php
	include("include/common.php");
	include("$config[template_path]/user_top.html");
?>
	<table border="<?php echo $style[admin_listing_border] ?>" cellspacing="<?php echo $style[admin_listing_cellspacing] ?>" cellpadding="<?php echo $style[admin_listing_cellpadding] ?>" width="<?php echo $style[admin_table_width] ?>" class="form_main">
		<tr>
			
			<td width="603" valign="top"><h3>			  <table width="424" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td width="76"><div align="center"><a href="listing_browse.php?&type%5B%5D=Liquor+Stores"><img src="eagle_1.jpg" width="76" height="289" border="0" usemap="#Map7"></a></div></td>
    <td width="72"><div></div> 
      <div align="center"><img src="eagle_2.jpg" width="72" height="289" border="0" usemap="#Map6"></div></td>
    <td width="77"><div align="center"><img src="eagle_3.jpg" width="77" height="289" border="0" usemap="#Map5"> </div></td>
    <td width="70"><div align="center"><img src="eagle_4.jpg" width="70" height="289" border="0" usemap="#Map4"></div></td>
    <td width="67"><div align="center"><img src="eagle_5.jpg" width="67" height="289" border="0" usemap="#Map3"></div></td>
    <td width="58"><div align="center"><img src="eagle_6.jpg" width="58" height="289" border="0" usemap="#Map2"></div></td>
    <td width="10"><div align="center"><img src="eagle_7.jpg" width="60" height="289" border="0" usemap="#Map"></div></td>
  </tr>
</table>
				</h3>		  </td>
		</tr>
	</table>

<map name="Map">
  <area shape="rect" coords="1,-1,59,288" href="listing_browse.php?&type%5B%5D=Others">
</map>
<map name="Map2">
  <area shape="rect" coords="-1,-1,56,288" href="listing_browse.php?&type%5B%5D=Bars+%26+Clubs">
</map>
<map name="Map3">
  <area shape="rect" coords="-1,-1,66,289" href="listing_browse.php?&type%5B%5D=Laundromats">
</map>
<map name="Map4">
  <area shape="rect" coords="-1,-1,70,288" href="listing_browse.php?&type%5B%5D=Convenience%2FGas+Stations">
</map>
<map name="Map5">
  <area shape="rect" coords="-1,-1,75,288" href="listing_browse.php?&type%5B%5D=Hotels">
</map>
<map name="Map6">
  <area shape="rect" coords="1,-1,70,287" href="listing_browse.php?&type%5B%5D=Restaurants">
</map>
<map name="Map7">
  <area shape="rect" coords="-1,-7,74,281" href="listing_browse.php?user_ID=&status=Active&&type%5B%5D=Liquor+Stores">
</map>
</body></body></html>
<a href="http://www.myclba.com" target="_blank"><img border="none" style="margin-left:70px;" src="<?php echo $config[template_url] ?>/images/clba_logo.png" width="90px"/></a>
            <a href="http://www.dmcar.com/" target="_blank"><img border="none" src="<?php echo $config[template_url] ?>/images/dmcab_logo.jpg" /></a>
            <a href="http://www.realtor.com/" target="_blank"><img border="none" src="<?php echo $config[template_url] ?>/images/realtor_logo.png" /></a>
<?php
	
	include("$config[template_path]/user_bottom.html");
?>