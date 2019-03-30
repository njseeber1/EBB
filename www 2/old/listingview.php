<?php
	
	
	include("include/common.php");
	include("$config[template_path]/user_top.html");
	
		
	if ($_GET['listingID'] == "")
	{
		echo "<a href=\"index.php\">$lang[perhaps_you_were_looking_something_else]</a>";
	}	
		
		
	elseif ($_GET['listingID'] != "")
	{
		// first, check to see whether the listing is currently active
		$show_listing = checkActive($_GET['listingID']);
		if ($show_listing == "yes")
		{
			?>
				<!-- This Script opens a new window it is used by the mortgage calc. -->
				<script type="text/javascript">
				<!--
				function open_window(url)
				{
					cwin = window.open(url,"attach","width=350,height=400,toolbar=no,resizable=yes");
				}
				-->
				</script>
				<style type="text/css">
<!--
.style1 {
	color: #666666;
	font-weight: bold;
}
.style2 {color: #666666}
-->
                </style>
				
		<table border="<?php echo $style[form_border] ?>" cellspacing="<?php echo $style[form_cellspacing] ?>" cellpadding="<?php echo $style[form_cellpadding] ?>" width="<?php echo $style[admin_table_width] ?>" class="form_main" align="center" >
			<tr>
			  <td colspan="2" bgcolor="#6699CC" class="row_main"><p class="style1"></p>			  
			    <table width="158" border="0" cellspacing="0" cellpadding="0">
                  <tr>
                    <td width="100%" bgcolor="#6699CC"><span class="style1">Listing Information</span></td>
                  </tr>
                </table></td>
		    </tr>
			<tr>
			  <td width="256" height="21" class="row_main"><p>
                  <?php renderUserInfoOnListingsPage($_GET['listingID']) ?>
                  <br>
                  <?php getListingEmail($_GET['listingID']) ?>
                  <br>
			  </p>			    </td>
		      <td height="21" valign="top" class="row_main">	          <br>              </td>
		  </tr>
			<tr>
			  <td height="18" bgcolor="6F90D2" class="style2 row_main"><strong>Business Information</strong></td>
		      <td height="18" bgcolor="6F90D2" class="style2 row_main"><div align="left"><strong>Lease
              Information</strong></div></td>
		  </tr>
			<tr>
			  <td height="43" valign="top" class="row_main"><?php renderTemplateArea(feature1,$_GET['listingID']); ?></td>
		      <td width="256" height="43" valign="top" class="row_main"><?php renderTemplateArea(top_left,$_GET['listingID']); ?>
	          <div align="left"></div></td>
		  </tr>
			<tr>
				
					<?php
					renderListingsImages($_GET['listingID'])
					?>

				<td height="18" bgcolor="6F90D2" class="style2 row_main">&nbsp;</td>
			</tr>
			<tr>
			  <td class="row_main"><table width="<?php echo $style[left_right_table_width] ?>" cellpadding="<?php echo $style[left_right_table_cellpadding] ?>" cellspacing="<?php echo $style[left_right_table_cellspacing] ?>" border="<?php echo $style[left_right_table_border] ?>">
                <tr>
                  <td align="left" class="row_main" width="50%" valign="top">&nbsp;
                  </td>
                  <td align="right" class="row_main" width="50%" valign="top">
                    <?php renderTemplateArea(top_right,$_GET['listingID']); ?>
                  </td>
                </tr>
              </table>
			    
		      </td>
		  </tr>
			<tr>
			  <td bgcolor="6F90D2" class="style2 row_main"><strong>Additional Information</strong></td>
		  </tr>
			<tr>
			  <td class="row_main"><p> </p>
			    <table width="98%">
                  <tr>
                    <td valign="top">
                      <?php renderTemplateArea(feature2,$_GET['listingID']); ?>
                      <br>
                      <br>
                    </td>
                  </tr>
                </table>
			    <table width="<?php echo $style[left_right_table_width] ?>" cellpadding="<?php echo $style[left_right_table_cellpadding] ?>" cellspacing="<?php echo $style[left_right_table_cellspacing] ?>" border="<?php echo $style[left_right_table_border] ?>">
                  <tr>
                    <td align="left" class="row_main" width="50%" valign="top">&nbsp;
                    </td>
                    <td align="right" class="row_main" width="50%" valign="top">&nbsp;
                    </td>
                  </tr>
                </table>
			    
                <?php makeYahooMap($_GET['listingID'], "address", "city", "zip") ?>
                <table width="<?php echo $style[left_right_table_width] ?>" cellpadding="<?php echo $style[left_right_table_cellpadding] ?>" cellspacing="<?php echo $style[left_right_table_cellspacing] ?>" border="<?php echo $style[left_right_table_border] ?>">
                  <tr>
                    <td align="left" class="row_main" width="50%" valign="top">
                      <?php renderTemplateArea(bottom_left,$_GET['listingID']); ?>
                    </td>
                    <td align="right" class="row_main" width="50%" valign="top">&nbsp;
                    </td>
                  </tr>
                </table>
                <?php hitcount($_GET['listingID']) ?></td>
		  </tr>
	 	</table>
		
		<?php
		} // end if ($show_listing == "yes")
	} // end elseif ($_GET['listingID'] != "")
	
	include("$config[template_path]/user_bottom.html");
?>