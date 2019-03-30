<?php
	include("include/common.php");
	include("$config[template_path]/user_top.html");
?>
	<table border="<?php echo $style[admin_listing_border] ?>" cellspacing="<?php echo $style[admin_listing_cellspacing] ?>" cellpadding="<?php echo $style[admin_listing_cellpadding] ?>" width="<?php echo $style[admin_table_width] ?>" class="form_main">
		<tr>
			<td width="21" height="330" valign="top">
				<?php renderFeaturedListingsVertical(4); ?>
			</td>
			<td width="603" valign="top"><h3>Welcome to Eagle Business Brokers.<br>
			  <table width="424" border="0" cellspacing="0" cellpadding="2">
  <tr>
    <td><div align="center"></div>      <div></div>      <div align="center"></div>      <div align="center"> </div>      <div align="center"></div>      <div align="center"></div>      <div align="center"></div>      
      <div align="center">
        <p>Under Construction</p>
        <p>&nbsp;</p>
        <p align="left">This information is for people trying to get legal help.
          There will be more information about Matthew's legal information. Legal
          information can be attained here and Matthew's lawer friend will have
          all of their information here with links and pictures. </p>
        </div></td>
    </tr>
</table>
				</h3>		  </td>
		</tr>
	</table>
<?php



	include("$config[template_path]/user_bottom.html");
?>
