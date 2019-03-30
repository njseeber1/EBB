<!-- This script and many more are available free online at -->
<!-- The JavaScript Source!! http://javascript.internet.com -->
<!-- Original:  ScriptBreaker -->
<!-- Web Site:  http://www.ScriptBreaker.com -->
<!-- Begin -->



<SCRIPT LANGUAGE="JavaScript">
	function goToURL() { history.go(-1); }
</script>

<script language="JavaScript" src="<?php echo $config[template_url]; ?>/sliding_menu.js"></script>

<table width=91><tr><td width="1"></td><td>

<script language="JavaScript">
	//Link[nr] = "position [0 is menu/1 is item],Link name,url,target (blank|top|frame_name)"
	var Link = new Array();
	<? 
	/* ***************************************************** */
	/*    MENU MOD FOR OPEN REALTY 1.1.0+ VERSION 241003     */
	/*              RealtyOne www.outbackweb.net             */
	/* ***************************************************** */
	global $conn, $config, $page;
	$i = 0;
	$ordernr = 0;
							
	$sql = "SELECT * FROM ".$config['table_prefix']."menu ORDER BY place ASC";
	$recordSet = $conn->Execute($sql);
	if ($recordSet === false)
	{
		log_error($sql);
	} // Endif $recordset === false

	while (!$recordSet->EOF)
	{
		$indent = $recordSet->fields['indent'];
		$place = $recordSet->fields['place'];
		$title = $recordSet->fields['title'];
		$linkurl = $recordSet->fields['linkurl'];
		#Enter your link method here#
		?>
		<?php

		if ($indent == 0)
		{	
			$i = $i + 1;
		}
		echo " Link[$ordernr] = \"$indent|$title|$config[baseurl]/$linkurl||$i\";\n";             

		$ordernr = $ordernr + 1;
		#END link method here#
		
		// We are in the forms section. This must always be at the bottom of the menu		
		if (eregi("phorm", $PHP_SELF))
		{
				$menuitem = $i;
		}
		
		// If the name of the page is the same as the menu item we set the menu item to open
		if ($PHP_SELF == "/$linkurl")
		{
			$menuitem = $i;
		}

		// Same as above but use the id of the page rather than the page name
		if ($HTTP_GET_VARS["id"])
		{
			$id = $HTTP_GET_VARS["id"];
			if (eregi("id", $linkurl))
			{
				$start = strpos($linkurl, "id"); 
				$start += 3;
				$stop=$start + 2;
				$id_linkurl = substr($linkurl, $start, $stop);
				$id_linkurl = eregi_replace("&","",$id_linkurl);
		
				if ($id_linkurl==$id)
				{
					$menuitem = $i;
				}
			}
		}
		$recordSet->MoveNext();
	} // Endwhile

	// If we have a direct hit start off with the top menu items.
	if ($menuitem == NULL)
	{
		$menuitem = 1;
	}
	?>

	startup(<?php echo $menuitem ?>);
</script>

</td></tr></table>

