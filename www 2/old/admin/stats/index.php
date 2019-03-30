<?php
//////////////////////////////////////////////////////////////
//															//
// 	Open-Realty Web site Statistics Module (English)`		//
// 	tested with Open-Realty (OR) versions 1.13 and 1.14		//
// 	Oct-2003 (C) the_sandking@hotmail.com					// 
//															//
//  Free for use with Open-Realty (OR)						//
//	http://www.open-realty.org)								//
//															//
// 	Any Political uses of this script are prohibited.		//	 
//															//
// 	Based in part on original GPL code (AudiStat v1.3)		//	
// 	by Alexandre Dubus) http://adubus.free.fr/audistat		//
//															//
// 	Parameters :											//	
// 	year=YYYY												//	
// 	month=MM												//
// 	mday=dd													//
// 	phpinfo <- to debug										//
//															//
// 	QUICK SETUP INSTRUCTIONS								//
//															//
// 	Create stats directory beneath the /admin section of OR	//
// 	/admin/stats  											//
//	Extract all the files contained in the .zip archive to  //
// 	the new stats directory.								//
// 	Copy the file "stat_func.inc" to OR's main include dir 	//
//  at /include. 											//
//															//				
//  Open the included file "new_styles.css"					//
//	Open your template's "style.css" file.					//
//  														//
//  Paste the contents of "new_styles.css" into your		// 
//	template's "style.css" stylesheet file and save			//
//															//
// 	Add ONE (1) of the following code snippets to your 		//
//	template's "user_bottom.html" 							//
//   -----------------------------------------------------  //
/*

   	// Statistics for PHP section of page
 	require($config[basepath] . "/include/stat_func.inc");
 	logstats(); 
	
	(OR) 
	
	
	<?php 
	// Statistics for HTML section of page
	require($config[basepath] . "/include/stat_func.inc");
 	logstats(); 
	?>
	
*/
//   -----------------------------------------------------  //															//
//															//
//  Optionally, create a link to the stats viewing page		//
//	"/admin/stats/index.php" in your "admin_top.php" file. 	//
// 	Or access the stats directly by using 					//
//	http://www.yoursite.com/admin/stats/index.php			//
//															//
// 	The script will automatically create the new DB tables 	//
// 	the first time a page is hit, after the installation.	//
//															//
//////////////////////////////////////////////////////////////

include("../../include/common.php");
	
	//login check
	loginCheck('Admin');
	
	global $lang, $conn, $config;
	
include($config[template_path]."/admin_top.html");


//  setup month name array  
$m_name = array('','January','February','March','April','May','June','July','August','September','October','November','December');

//setup array of country Top Level Domains 
$g_tld = array('ac'=>'United Kingdom Academic Institutions','ad'=>'Andorra','ae'=>'United Arab Emirates','af'=>'Afghanistan','ag'=>'Antigua and Barbuda','ai'=>'Anguilla','al'=>'Albania','am'=>'Armenia','an'=>'Netherlands Antilles','ao'=>'Angola','aq'=>'Antarctica','ar'=>'Argentina','as'=>'American Samoa','at'=>'Austria','au'=>'Australia','aw'=>'Aruba','az'=>'Azerbaijan','ba'=>'Bosnia and Herzegovina','bb'=>'Barbados','bd'=>'Bangladesh','be'=>'Belgium','bf'=>'Burkina Faso','bg'=>'Bulgaria','bh'=>'Bahrain','bi'=>'Burundi','bj'=>'Benin','bm'=>'Bermuda ','bn'=>'Brunei Darussalam','bo'=>'Bolivia','br'=>'Brazil','bs'=>'Bahamas','bt'=>'Bhutan','bv'=>'Bouvet Island','bw'=>'Botswana','by'=>'Belarus','bz'=>'Belize','ca'=>'Canada','cc'=>'Cocos (Keeling) Islands','cf'=>'Central African Republic','cg'=>'Congo','ch'=>'Switzerland','ci'=>'Cote d`Ivoire (Ivory Coast)','ck'=>'Cook Islands','cl'=>'Chile','cm'=>'Cameroon','cn'=>'China','co'=>'Colombia','com'=>'US Commercial','cr'=>'Costa Rica','cs'=>'Czechoslovakia (former)','cu'=>'Cuba','cv'=>'Cape Verde','cx'=>'Christmas Island','cy'=>'Cyprus','cz'=>'Czech Republic','de'=>'Germany','dj'=>'Djibouti','dk'=>'Denmark','dm'=>'Dominica','do'=>'Dominican Republic','dz'=>'Algeria','ec'=>'Ecuador','edu'=>'US Educational','ee'=>'Estonia','eg'=>'Egypt','eh'=>'Western Sahara','er'=>'Eritrea','es'=>'Spain','et'=>'Ethiopia','fi'=>'Finland','fj'=>'Fiji','fk'=>'Falkland Islands (Malvinas)','fm'=>'Micronesia','fo'=>'Faroe Islands','fr'=>'France','fx'=>'France (Metropolitan)','ga'=>'Gabon','gb'=>'Great Britain (UK)','gd'=>'Grenada','ge'=>'Georgia','gf' =>'French Guiana','gh'=>'Ghana','gi'=>'Gibraltar','gl'=>'Greenland','gm'=>'Gambia','gn'=>'Guinea','gov'=>'US Government','gp'=>'Guadaloupe','gq'=>'Equatorial Guinea','gr'=>'Greece','gs'=>'South Georgia and South Sandwich Islands','gt'=>'Guatemala','gu'=>'Guam','gw'=>'Guinea-Bissau','gy'=>'Guyana','hk'=>'Hong Kong','hm'=>'Heard and McDonald Islands','hn'=>'Honduras','hr'=>'Croatia (Hrvatska)','ht'=>'Haiti','hu'=>'Hungary','ic'=>'Iceland','id'=>'Indonesia','ie'=>'Ireland','il'=>'Israel','in'=>'India','io'=>'British Indian Ocean Territory','ip'=>'IP Address','iq'=>'Iraq','ir'=>'Iran','it'=>'Italy','jm'=>'Jamaica','jo'=>'Jordan','jp'=>'Japan','ke'=>'Kenya','kg'=>'Kyrgyzstan','kh'=>'Cambodia','ki'=>'Kiribati','km'=>'Comoros','kn'=>'Saint Kitts and Nevis','kp'=>'Korea (North)','kr'=>'Korea (South)','ku'=>'Kuwait','ky'=>'Cayman Islands','kz'=>'Kazakhstan','la'=>'Laos','lb'=>'Lebanon','lc'=>'Saint Lucia','li'=>'Liechtenstein','lk'=>'Sri Lanka','lr'=>'Liberia','ls'=>'Lesotho','lt'=>'Lithuania','lu'=>'Luxembourg','lv'=>'Latvia','ly'=>'Libya','ma'=>'Morocco','mc'=>'Monaco','md'=>'Moldova','mg'=>'Madagascar','mh'=>'Marshall Islands','mil'=>'US Military','mk'=>'Macedonia','ml'=>'Mali','mm'=>'Mynamar','mn'=>'Mongolia','mo'=>'Macau','mp'=>'Northern Mariana Islands','mq'=>'Martinique','mr'=>'Mauritania','ms'=>'Montserrat','mt'=>'Malta','mu'=>'Mauritius','mv'=>'Maldives','mw'=>'Malawi','mx'=>'Mexico','my'=>'Malaysia','mz'=>'Mozambique','na'=>'Namibia','nc'=>'New Caledonia','ne'=>'Niger','net'=>'US Network','nf'=>'Norfolk Island','ng'=>'Nigeria','ni'=>'Nicaragua','nl'=>'Netherlands','no'=>'Norway','np'=>'Nepal','nr'=>'Nauru','nt'=>'Neutral Zone','nu'=>'Niue','nz'=>'New Zealand (Aotearoa)','om'=>'Oman','org'=>'US Non-Profit Organization','pa'=>'Panama','pe'=>'Peru','pf'=>'French Polynesia','pg'=>'Papua New Guinea','ph'=>'Philippines','pk'=>'Pakistan','pl'=>'Poland','pm'=>'Saint Pierre and Miquelon','pn'=>'Pitcairn','pr'=>'Puerto Rico','pt'=>'Portugal','pw'=>'Palau','py'=>'Paraguay','qa'=>'Qatar','re'=>'Reunion','ro'=>'Romania','ru'=>'Russian Federation','rw'=>'Rwanda','sa'=>'Saudi Arabia','sb'=>'Solomon Islands','sc'=>'Seychelles','sd'=>'Sudan','se'=>'Sweden','sg'=>'Singapore','sh'=>'Saint Helena','si'=>'Slovenia','sj'=>'Svalbard and Jan Mayen Islands','sk'=>'Slovak Republic','sl'=>'Sierra Leone','sm'=>'San Marino','sn'=>'Senegal','so'=>'Somalia','sr'=>'Suriname','st'=>'Sao Tome and Principe','su'=>'USSR (former)','sv'=>'El Salvador','sy'=>'Syria','sz'=>'Swaziland','tc'=>'Turks and Caicos Islands','td'=>'Chad','tf'=>'French Southern Territories','tg'=>'Togo','th'=>'Thailand','tj'=>'Tajikistan','tk'=>'Tokelau','tm'=>'Turkmenistan','tn'=>'Tunisia','to'=>'Tonga','tp'=>'East Timor','tr'=>'Turkey','tt'=>'Trinidad and Tobago','tv'=>'Tuvalu','tw'=>'Taiwan','tz'=>'Tanzania','ua'=>'Ukraine','ug'=>'Uganda','uk'=>'United Kingdom','um'=>'US Minor Outlying Islands','us'=>'United States','uy'=>'Uruguay','uz'=>'Uzbekistan','va'=>'Vatican City State','vc'=>'Saint Vincent and the Grenadines','ve'=>'Venezuela','vg'=>'Virgin Islands (British)','vi'=>'Virgin Islands (US)','vn'=>'Viet Nam','vu'=>'Vanuatu','wf'=>'Wallis and Futuna Islands','ws'=>'Samoa','ye'=>'Yemen','yt'=>'Mayotte','yu'=>'Yugoslavia','za'=>'South Africa','zm'=>'Zambia','zr'=>'Zaire','zw'=>'Zimbabwe','Unknown'=>'Unknown');


function db_query_daystats($querystring) {
	global $conn, $config, $m_name;

	$day_stat = array();
	$day_stat2 = array();
	$max = 0;
	
	$sql = "SELECT DAYOFMONTH(time_str), COUNT(*) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 1";
	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	while (list($day,$count) =$recordSet->FetchRow())
	{
		$day_stat[$day] = $count;

		if ($max < $count) $max=$count;
	}
	
	$sql2 = "SELECT DAYOFMONTH(time_str) as day , remote_host FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1,2 ORDER BY 1";
	$recordSet2= $conn->Execute($sql2);
		
        if ($recordSet2 === false)
        {
            log_error($sql2);
        }
		reset($day_stat2);

		for($i=0;$i<31;$i++) 
		{
			$day_stat2[$i]=0;
		}
			while (list($day,$c) = $recordSet2->FetchRow())
			{
			
				$day_stat2[$day] += 1;
			}
?>

<P>

<TABLE class="Table1" cellSpacing=1 cellPadding=0>
 <TR class="TR1">
  <TH colspan="2">Stats per day</TH></TR>
 <TR class="TR2">
  <TD class="TD10" rowspan="2"><?= $max ?> --</TD>
  <TD class="TD11">
<TABLE cellSpacing=0 cellpadding=0>
 <TR>

<?php
	reset($day_stat);
	while (list($day,$count) = each($day_stat)) 
	{
?>

     <TD class="TD12">

      <IMG src="images/blue.jpg" width="12" height="<?=100*$day_stat[$day]/$max?>"><IMG src="images/orange.gif" width="4" height="<?=100*$day_stat2[$day]/$max?>" STYLE="position:relative; left:-8"></TD>

<?php

      }
?>

 </TR>
</TABLE>
   </TD>
  </TR>

    <TR class="TR3">
     <TD class="TD1">

<TABLE cellSpacing=0 cellpadding=0>
  <TR>

<?php

	reset($day_stat);
	$i=0;

	while (list($day,$count) = each($day_stat)) {
		$d = sprintf("%02d",$day);
?>
     <TD class="TD12"><?= $d ?></TD>
<?php

	}
?>

    </TR>
</TABLE>

		</TD>
	</TR>
</TABLE>

<?php

}

function db_query_hourstats($querystring) {
	global $conn, $config;
	$hour_stat   = array();
	$hour_stat2  = array();
	
	$sql = "SELECT HOUR(time_str) as hour, COUNT(*) as count FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 1";
	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

		reset($hour_stat);

		$max=0;

		for($i=0;$i<24;$i++) {$hour_stat[$i]=0;
		}

			while (list($hour,$count) = $recordSet->FetchRow())
			{
				if ($count>$max) $max = $count;
						
				$hour_stat[$hour] = $count;
			}

		$sql2 = "SELECT HOUR(time_str) as hour , remote_host FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1,2 ORDER BY 1";
		$recordSet2= $conn->Execute($sql2);

        if ($recordSet2 === false)
        {
            log_error($sql2);
        }

		reset($hour_stat2);

		for($i=0;$i<24;$i++) {$hour_stat2[$i]=0;
		}
			while (list($hour,$count) = $recordSet2->FetchRow()) 
			{
				$hour_stat2[$hour] += 1;
			}
?>

<P>

<TABLE class="Table1" cellSpacing=1 cellPadding=0>
 <TR class="TR1">
  <TH colspan="2">Stats per hour</TH></TR>
 <TR class="TR2">
  <TD class="TD10" rowspan="2"><?= $max ?>--</TD>
  <TD class="TD11">
   <TABLE cellspacing=0 cellPadding=0>
    <TR>

<?php

	for ($hour=0;$hour<24;$hour++) 	
	{

?>
     <TD class="TD12">
      <IMG src="images/blue.jpg" width="12" height="<?= 100 * $hour_stat[$hour] / $max ?>"><IMG src="images/orange.gif" width="4" height="<?= 100 * $hour_stat2[$hour] / $max ?>" STYLE="position:relative; left:-8"></TD>

<?php
    }

?>
    </TR></TABLE></TD></TR>
 <TR class="TR3">
  <TD class="TD1">
   <TABLE cellspacing=0 cellPadding=0>
    <TR>

<?php

	for ($hour=0;$hour<24;$hour++) 
	{
		$h = sprintf("%02d",$hour);
?>

     <TD class="TD12"><?= $h ?></TD>

<?php

	}

?>

    </TR></TABLE></TD></TR></TABLE>

<?php

} //end function db_query_hourstats($querystring) 

function db_query_lastsites($querystring) {

	global $conn, $config;

	$sql = "SELECT remote_host, MAX(time_str) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 15";
	$recordSet= $conn->Execute($sql);
	
        if ($recordSet === false)
        {
            log_error($sql);
        }
?>

<P>
<TABLE class="Table1" cellSpacing=1>
 <TR class="TR1">
  <TH colspan="3">Last Visitors</TH></TR>
 <TR class="TR1">
  <TH class="TD6">#</TH>
  <TH class="TD5">Date</TH>
  <TH>Hostname</TH></TR>

<?php
	$idx=1;
	
	 while (list($site,$date) = $recordSet->FetchRow())
	{
	
	
?>

 <TR class="TR2">
  <TD class="TD4"><?= $idx ?> 
   <IMG src="images/closed.gif" id="c<?=$idx?>" class="Outline" width="12" height="12" onclick="clickHandler('c<?=$idx?>')" style="CURSOR: hand"></TD>
  <TD class="TD2"><?= $date ?></TD>
  <TD class="TD2"><?= $site ?></TD></TR>
 <TBODY div id=dc<?=$idx?> style="Display:none">
 <TR class="TR3">
  <TD class="TD4">.</TD>
  <TD class="TD3">&nbsp;</TD>

<?php

		$sql3 = "SELECT referer, time_str FROM " . $config[table_prefix] . "stats WHERE $querystring AND remote_host=\"$site\" ORDER BY 2 LIMIT 1";
		$recordSet3= $conn->Execute($sql3);
	
        if ($recordSet3 === false)
        {
            log_error($sql3);
        }

		list($ref,$date) = $recordSet3->FetchRow();

			if ($ref == "-") 
			{

?>
  <TD class="TD2">First referrer: direct hit</TD></TR>
  
<?php
			} 
			else 
			{

				if (strlen($ref) > 55) 
				{
				$sstr = substr($ref,0,55)." ".substr($ref,55);
				} 
					else 
					{
						$sstr = $ref;
					}
?>

  <TD class="TD2">First referrer: <A href="<?= $ref ?>"><?= $sstr ?></A></TD></TR>

<?php

	} //end while 

		$sql2 = "SELECT request, time_str FROM " . $config[table_prefix] . "stats WHERE $querystring AND remote_host=\"$site\" ORDER BY 2 DESC LIMIT 15";
		$recordSet2= $conn->Execute($sql2);
		
        if ($recordSet2 === false)
        {
            log_error($sql2);
        }

		while (list($req,$date) = $recordSet2->FetchRow())
		{
	

?>

 <TR class="TR3">
  <TD class="TD4">.</TD>
  <TD class="TD3"><?= $date ?></TD>
  <TD class="TD2"><A href="<?= $req ?>"><?= $req ?></A></TD></TR>
<?php			


		} //end while 
?>

 </TBODY>

<?php

		$idx++;

	}
?>

</TABLE>

<?php

}

function table_head($tablename) {

?>
<P>
<TABLE class="Table1" cellSpacing=1>
 <TR class="TR1">
  <TH colspan="4">Top <?= $tablename ?></TH></TR>
 <TR class="TR1">
  <TH class="TD6">#</TH>
  <TH class="TD7" colspan="2">Hits</TH>
  <TH class="TD8"><?= $tablename ?></TH></TR>

<?php

} //end function table_head($tablename) 

function table_obj($obj_stat,$total,$link) {
	reset ($obj_stat);

	while (list($idx,$val) = each ($obj_stat)) 
	{
		$obj     = $obj_stat[$idx]['obj'];
		$count   = $obj_stat[$idx]['count'];
		$percent = sprintf("%3.2f",$count * 100 / $total);
?>

 <TR class="TR2">
  <TD class="TD4"><?= $idx ?></TD>
  <TD class="TD3"><?= $count ?></TD>
  <TD class="TD2"><IMG src="images/blue.jpg" width="<?= 100 * $count/$total ?>" height="8"><?= $percent ?>%</TD>
<?php
		if ($link == 1) 
		{
?>

  <TD class="TD2"><A href="<?= $obj ?>"><?= $obj ?></A></TD></TR>

<?php
		} //end if ($link == 1)
			else 
			{
?>
  <TD class="TD2"><?= $obj ?></TD></TR>
<?php
			} // end else
	} //end while (list($idx,$val) = each ($obj_stat)) 
?>

</TABLE>

<?php

} // end function table_obj($obj_stat,$total,$link)


function db_query_top($recordset,$tablename,$link) 
{
	$obj_stat = array();
	$total = 0;
	$idx = 1;

	while (list($obj,$count) = $recordset->FetchRow()) 
	{
		$obj_stat [$idx]['obj']   = $obj;
		$obj_stat [$idx]['count'] = $count;
		$total += $count;
		$idx ++;
	
	}

	table_head($tablename);
	table_obj($obj_stat,$total,$link);
} //end function db_query_top($recordSet,$tablename,$link)

function db_query_topurls($querystring) {
	global $conn, $config;
	
	$url_stat         = array();
	$total            = 0;

	$sql = "SELECT request, COUNT(*) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 30";
	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	db_query_top($recordSet,"URLs",1);

} //endfunction db_query_topurls($querystring)

function db_query_topsites($querystring) {
		global $conn, $config;

	$sql = "select remote_host,COUNT(*) from " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 30";
	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	db_query_top($recordSet,"Visitors",0);

} //end function db_query_topsites($querystring)

function db_query_toprefs($querystring) {
	
	global  $conn, $config, $HTTP_HOST;
	
	$obj_stat = array();

	$sql = "select referer, COUNT(*) as count from " . $config[table_prefix] . "stats WHERE $querystring AND referer NOT LIKE \"%$HTTP_HOST%\" GROUP BY 1 ORDER BY 2 DESC LIMIT 20";

	$recordSet = $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	$sql2 = "select request from " . $config[table_prefix] . "stats WHERE $querystring AND referer LIKE \"%$HTTP_HOST%\" ";
	$recordSet2= $conn->Execute($sql2);

		if ($recordSet2 === false)
        {
            log_error($sql2);
        }
		$n_local = $recordSet2->RecordCount();
		//$n_local = mysql_num_rows($recordSet2);

	$sql3 = "select request from " . $config[table_prefix] . "stats WHERE $querystring";
	$recordSet3= $conn->Execute($sql3);

		if ($recordSet3 === false)
        {
            log_error($sql3);
        }
		
		$total = $recordSet3->RecordCount();
		$idx = 1;

		 while (list($obj,$count) = $recordSet3->FetchRow())
		
		{
			$obj = $recordSet->fields[request];
			$count = $recordSet->fields[count]; 
			
			$obj_stat [$idx]['obj'] = $obj;
			$obj_stat [$idx]['count'] = $count;
			$idx ++;
		}

		table_head("Referrers");
		$idx_max = $idx;
		reset ($obj_stat);

		while (list($idx,$val) = each ($obj_stat)) 
		{
			$obj = $obj_stat[$idx]['obj'];
			$count = $obj_stat[$idx]['count'];
			$percent = sprintf("%3.2f",$count * 100 / $total);
?>

 <TR class="TR2">
  <TD class="TD4"><?= $idx ?>
   <IMG src="images/closed.gif" id="cref<?=$idx?>" class="Outline" width="12" height="12" onclick="clickHandler('cref<?=$idx?>')" style="CURSOR: hand"></TD>
  <TD class="TD3"><?= $count ?></TD>
  <TD class="TD2"><IMG src="images/blue.jpg" width="<?= 100 * $count/$total ?>" height="8"><?= $percent ?>%</TD>

<?php
		if (strcmp($obj,"-") == 1) 
		{
			if (strlen($obj) > 55) 
			{
				$sstr = substr($obj,0,55)." ".substr($obj,55);
			} 
			else 
				{
				$sstr = $obj;
				}
?>
  <TD class="TD2"><A href="<?= $obj ?>"><?= $sstr ?></A></TD></TR>

<?php

		} 
			else 
			{

?>
  <TD class="TD2">direct hit</TD></TR>

<?php		

			}
?>
 <TBODY div id=dcref<?=$idx?> style="Display:none">

<?php
		$sql = "select request,COUNT(*) from " . $config[table_prefix] . "stats WHERE $querystring AND referer = \"$obj\" GROUP BY 1 ORDER BY 2 DESC LIMIT 15";
	$recordSet = $conn->Execute($sql);

		if ($recordSet === false)
        {
            log_error($sql);
        }

		while (list($rr,$c) = $recordSet->FetchRow())
		{

?>
 <TR class="TR3">
  <TD class="TD4">.</TD>
  <TD class="TD3" colspan=2>.</TD>
  <TD class="TD2">-----&gt; <A href="<?= $rr ?>"><?=$rr?></A>(<?=$c?>)</TD></TR>

<?php

		}

?>

 </TBODY>

<?php

	}

	$percent = sprintf("%3.2f",$n_local * 100 / $total);

?>

 <TR class="TR2">
  <TD class="TD4"><?= $idx_max ?>
   <IMG src="images/closed.gif" id="cref<?=$idx_max?>" class="Outline" width="12" height="12" onclick="clickHandler('cref<?=$idx_max?>')" style="CURSOR: hand"></TD>
  <TD class="TD3"><?= $n_local ?></TD>
  <TD class="TD2"><IMG src="images/blue.jpg" width="<?= 100 * $n_local/$total ?>" height="8"><?= $percent ?>%</TD>
  <TD class="TD2">local referrer</TD></TR>
 <TBODY div id=dcref<?=$idx_max?> style="Display:none">

<?php

	$sql = "select request, COUNT(*) as c from " . $config[table_prefix] . "stats WHERE $querystring AND referer LIKE \"%$HTTP_HOST%\" GROUP BY 1 ORDER BY 2 DESC LIMIT 15";

		$recordSet = $conn->Execute($sql);

		if ($recordSet === false)
        {
            log_error($sql);
        }
	while (list($rr,$c) = $recordSet->FetchRow())
	{
		

?>

 <TR class="TR3">
  <TD class="TD4">.</TD>
  <TD class="TD3" colspan=2>.</TD>
  <TD class="TD2">-----&gt; <?=$rr?> (<?=$c?>) </TD></TR>

<?php


	}

?>
 </TBODY>
</TABLE>

<?php

}

function db_query_topsearch($querystring) 
{
global $conn, $config;

	$site_stat         = array();
	$site_stat_percent = array();
	$total             = 0;

	$sql = "select referer,COUNT(*) from " . $config[table_prefix] . "stats WHERE $querystring AND (INSTR(referer,'?q=') OR INSTR(referer,'?p=') OR INSTR(referer,'?query=') OR INSTR(referer,'?qkw=') OR INSTR(referer,'?search=') OR INSTR(referer,'?qr=') OR INSTR(referer,'?string=')) GROUP BY 1 ORDER BY 2 DESC LIMIT 30";

	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	$idx = 1;

	while (list($site,$count) = $recordSet->FetchRow()) {

		$url = parse_url($site);
		$sql = $url['query'];
		unset ($q);
		$a = explode('&', $query);
		reset ($a);

		while (list($k,$v) = each($a)) 
		{
			$b = split('=',$v);
			$key = htmlspecialchars(urldecode($b[0]));
			$val = htmlspecialchars(urldecode($b[1]));
			if ($key == 'q') $sql = $val;
		}

		if (isset($q)) {
			$site_stat [$idx]['obj']  = $q;
			$site_stat [$idx]['count'] = $count;
			$total += $count;
			$idx ++;
		}
	}

	table_head("Searchs");
	table_obj($site_stat,$total,0);
}


function db_query_topagents($querystring) {
global $conn, $config;
	$sql = "SELECT
	IF ( INSTR(user_agent,'MSIE 6.0') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'MSIE 6.0'),8),
	IF ( INSTR(user_agent,'MSIE 5.5') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'MSIE 5.5'),8),
	IF ( INSTR(user_agent,'MSIE 5.0') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'MSIE 5.0'),8),
	IF ( INSTR(user_agent,'MSIE 4.0') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'MSIE 4.0'),8),
	IF ( INSTR(user_agent,'Opera') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Opera'),5),
	IF ( INSTR(user_agent,'Konqueror') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Konqueror'),9),
	IF ( INSTR(user_agent,'Mozilla/4') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Mozilla/4'),9),
	IF ( INSTR(user_agent,'Mozilla/5') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Mozilla/5'),9),
	IF ( INSTR(user_agent,'Mozilla') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Mozilla'),7),
	IF ( INSTR(user_agent,'Google') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Google'),6),
	'Other'
	))))))))))
	,COUNT(*) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 30";

	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	db_query_top($recordSet,"Agents",0);
} //end function db_query_topagents($querystring)


function db_query_toposs($querystring) {
	global $conn, $config;
	$sql = "SELECT
	IF ( INSTR(user_agent,'Windows 2000') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows 2000'),12),
	IF ( INSTR(user_agent,'Windows 98') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows 98'),10),
	IF ( INSTR(user_agent,'Windows 95') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows 95'),10),
	IF ( INSTR(user_agent,'Win95') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Win95'),5),
	IF ( INSTR(user_agent,'Win98') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Win98'),5),
	IF ( INSTR(user_agent,'Windows NT 4.0') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows NT 4.0'),14),
	IF ( INSTR(user_agent,'Windows NT 5.0') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows NT 5.0'),14),
	IF ( INSTR(user_agent,'Windows NT 5.1') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows NT 5.1'),14),
	IF ( INSTR(user_agent,'Windows XP') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows XP'),10),
	IF ( INSTR(user_agent,'Windows ME') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows ME'),10),
	IF ( INSTR(user_agent,'WinNT') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'WinNT'),5),
	IF ( INSTR(user_agent,'Mac_PowerPC') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Mac_PowerPC'),11),
	IF ( INSTR(user_agent,'Macintosh') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Macintosh'),9),
	IF ( INSTR(user_agent,'SunOS') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'SunOS'),5),
	IF ( INSTR(user_agent,'Linux') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Linux'),5),
	IF ( INSTR(user_agent,'Windows') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Windows'),7),
	IF ( INSTR(user_agent,'Google') > 0 , SUBSTRING(user_agent,INSTR(user_agent,'Google'),6),

	'Other'

	)))))))))))))))))

	,COUNT(*) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 30";

	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	db_query_top($recordSet,"Operating Systems",0);

}

function db_query_topctrys($querystring) {

	global $conn, $config, $g_tld;
	$tld_stat         = array();
	$total            = 0;
	$total_unknown    = 0;

	$sql = "SELECT RIGHT(remote_host,INSTR(REVERSE(remote_host),\".\")-1),COUNT(*) FROM " . $config[table_prefix] . "stats WHERE $querystring GROUP BY 1 ORDER BY 2 DESC LIMIT 30";

	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	$idx=1;

	while (list($tld, $count) = $recordSet->FetchRow()) 
	{

		if (isset($g_tld[$tld])) 
		{
			$tld_stat[$idx]['obj'] = $g_tld[$tld];
			$tld_stat[$idx]['count']= $count;
			$idx++;
		} 
			else
			$total_unknown += $count;
			$total += $count;
	}

	if ($total_unknown>0)
	{
		$tld_stat[$idx]['obj'] = "Unresolved/Unknown";
		$tld_stat[$idx]['count'] = $total_unknown;
	}
	
	table_head("Countries");
	table_obj($tld_stat,$total,0);
}



function db_query_all_months($querystring,$paramsup) {
	global $conn, $config, $m_name, $googlestats;

	$sql = "SELECT YEAR(time_str) as year, MONTH(time_str) as month,DAYOFMONTH(time_str)as mday,COUNT(*) as hits,COUNT(DISTINCT remote_host) as visits FROM " . $config[table_prefix] . "stats $querystring GROUP BY 1,2,3 ORDER BY 1,2,3";

	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

?>

<P>

<TABLE class="Table1" cellSpacing=1>
 <TR class="TR1">
  <TH rowspan="2">Period</TH>
  <TH colspan="2">Mean hits per day</TH>
  <TH colspan="2">Total</TH></TR>
 <TR class="TR1">
  <TH>Visits</TH>
  <TH>Hits</TH>
  <TH>Visits</TH>
  <TH>Hits</TH></TR>

<?php

	$idx=10;
	$init = 1;
	$yyear = 0;
	$mmonth = 0;
	$one = 0;
	$chain = "";
	$thits = 0;
	$tvisits = 0;

	while (list($year,$month,$mday,$hits,$visits) = $recordSet->FetchRow())
	{
	
	//echo "$year, $month, $mday, $hits, $visits <br>";
	
		$idx++;

		if ($init == 0 && ($year != $yyear || $month != $mmonth)) 
		{
			if ($one == 1) 
			{
?>

 </TBODY>

<?php

			}
			$one = 1;

?>
 <TR class="TR2">
  <TD class="TD9"><A HREF="?year=<?= $yyear ?>&month=<?= $mmonth ?><?= $paramsup ?>"><?= $m_name[$mmonth] ?> <?= $yyear ?></A>
   <IMG src="images/closed.gif" id="c<?=$idx?>" class="Outline" width="12" height="12" onclick="clickHandler('c<?=$idx?>')" style="CURSOR: hand"></TD>
  <TD><?= round($mvisits / $nday) ?></TD>
  <TD><?= round($mhits / $nday) ?></TD>
  <TD><?= $mvisits ?></TD>
  <TD><?= $mhits ?></TD></TR>
 <TBODY div id="dc<?=$idx?>" style="display:none;">

<?= $chain ?>

<?php
			$chain = "";
			$nday= 0;
			$mvisits = 0;
			$mhits = 0;
		}

		$mmonth = $month;
		$yyear = $year;
		$nday ++;
		$init = 0;
		$mhits += $hits;
		$mvisits += $visits;
		$thits += $hits;
		$tvisits += $visits;
		$chain = $chain .

" <TR class=\"TR2\">

  <TD class=\"TD9\" colspan=\"3\">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<A HREF=\"?year=$year&month=$month&mday=$mday$paramsup\">$mday</A><BR></TD>

  <TD>$visits</TD>

  <TD>$hits</TD></TR>

";


	} //end while 
	
if ($nday >0 ) 
{

?>
 </TBODY>
 <TR class="TR2">
  <TD class="TD9"><A HREF="?year=<?= $yyear ?>&month=<?= $mmonth ?><?= $paramsup ?>"><?= $m_name[$mmonth] ?> <?= $yyear ?></A>
   <IMG src="images/closed.gif" id="c<?=$idx?>" class="Outline" width="12" height="12" onclick="clickHandler('c<?=$idx?>')" style="CURSOR: hand"></TD>
  <TD><?= round($mvisits / $nday) ?></TD>
  <TD><?= round($mhits / $nday) ?></TD>
  <TD><?= $mvisits ?></TD>
  <TD><?= $mhits ?></TD></TR>
 <TBODY div id="dc<?=$idx?>" style="display:none;">

<?= $chain ?>

 </TBODY>

<?php

} //end if ($nday >0

?>

 <TR class="TR3">
  <TD colspan="3"><b>Total</b><BR></TD>
  <TD><?= $tvisits ?></TD>
  <TD><?= $thits ?></TD></TR></TABLE>

<?php

if ($googlestats == 1) 
{

?>

<A HREF="?">All Stats</A>

<?php

}
	else 
	{

?>
	<A HREF="?googlestats=1">Google Stats</A>

<?php

	}

} //end function db_query_all_months($querystring,$paramsup)

function html_header() {

	global $HTTP_HOST;
	global $m_name;
	global $mday;
	global $month;
	global $year;
	global $_SERVER;
	global $googlestats;
	$HTTP_HOST = $_SERVER['HTTP_HOST'];
	$title = "Site statistics -- $HTTP_HOST";

	if (isset($month) && isset($year)) 
	{
		$title = $title . " - " . $mday. " " . $m_name[$month] . " " . $year;
	}

	if ($googlestats == 1) 
	{
		$title2 = "<span style=\"letter-spacing: 6pt\">Google &nbsp;</span> $title";
		$title = "Google $title";
	} 
		else 
		{
			$title2 = $title;
		}

?>

  <SCRIPT language="JavaScript">
   <!--
   function clickHandler(id) {
    var targetId, srcElement, targetElement;
    var srcElement = document.getElementById(id);
    var targetElement = document.getElementById("d" + id);

    if (targetElement.style.display == "none") 
	{
     srcElement.src = "images/open.gif";
     targetElement.style.display = "";
    } 
		else 
		{
		     srcElement.src = "images/closed.gif";
		     targetElement.style.display = "none";
    	}
} // end function clickHandler(id) 

   //-->

  </SCRIPT>

<CENTER>
<TABLE class="Table1" cellSpacing="1">
    <TR class="TR1">
      <TD><H3><?= $title2 ?></H3></TD></TR></TABLE>
<HR>

<?php

} //end function html_header()

function html_footer() {

	global $m_name;

	// compute the current date
	$today   = getdate();
	$day    = $today['mday'];
	$cur_month    = $m_name[$today['mon']];
	$cur_year   = $today['year'];
	$hour   = $today['hours'];
	$minute  = $today['minutes'];
	$second = $today['seconds'];

// Place any extra HTML code you want for the footer below here
?>

</CENTER>

<?php

} //end function html_footer() 

function db_update_remote_host() {
global $conn, $config;

	$sql = "SELECT remote_host FROM " . $config[table_prefix] . "stats GROUP BY 1";
	$recordSet= $conn->Execute($sql);
		
        if ($recordSet === false)
        {
            log_error($sql);
        }

	while (list($site) = $recordSet->FetchRow()) 
	{

		if (preg_match("/^\d+\.\d+\.\d+\.\d+$/",$site)) 
		{
			$host = gethostbyaddr($site);

			if (!isset($host) || preg_match("/^\d+\.\d+\.\d+\.\d+$/",$host)) 
			{
				// add a final space to avoid re-matching
				$host = $site . " ";
			}

			$sql2 = "UPDATE " . $config[table_prefix] . "stats SET remote_host=\"$host\" WHERE remote_host=\"$site\"";
			$recordSet2= $conn->Execute($sql2);
		
        	if ($recordSet2 === false)
        	{
           		 log_error($sql2);
       		}

		} //end if (preg_match("/^\d+\.\d+\.\d+\.\d+$/",$site))
	
	} //end while (list($site) = mysql_fetch_row($recordSet)) 

} // end function db_update_remote_host() 


//// BEGIN HTML OUTPUT  ///////////////////////////////////////////////////////


if (isset($_GET['phpinfo'])) {phpinfo();return;}
if (isset($_GET['month'])) {$month = $_GET['month'];}
if (isset($_GET['year'])) {$year = $_GET['year'];}
if (isset($_GET['mday'])) {$mday = $_GET['mday'];}
if (isset($_GET['googlestats'])) {$googlestats = 1;} else {$googlestats = 0;}

//error_reporting(0);

db_update_remote_host();
html_header ();


#test

if ($googlestats == 1) 
{
	$querystring = "user_agent LIKE \"%Google%\" AND ";
	$paramsup = "&googlestats=1";
} 	
	else 
	{
		$querystring = "";
		$paramsup = "";	
	}

if (isset($month) && isset($year) && !isset($mday)) 
{
	$querystring .= "MONTH(time_str) = $month AND YEAR(time_str) = $year";
	db_query_daystats  ($querystring);
	db_query_hourstats ($querystring);
	db_query_lastsites ($querystring);
	db_query_toprefs   ($querystring);
	db_query_topurls   ($querystring);
	db_query_topsites  ($querystring);
	db_query_topsearch ($querystring);
	db_query_topagents ($querystring);
	db_query_toposs    ($querystring);
	db_query_topctrys  ($querystring);

} 
	elseif (isset($month) && isset($year) && isset($mday)) 
	{
	$querystring .= "DAYOFMONTH(time_str) = $mday AND MONTH(time_str) = $month AND YEAR(time_str) = $year";
	db_query_hourstats ($querystring);
	db_query_lastsites ($querystring);
	db_query_toprefs   ($querystring);
	db_query_topurls   ($querystring);
	db_query_topsites  ($querystring);
	db_query_topsearch ($querystring);
	db_query_topagents ($querystring);
	db_query_toposs    ($querystring);
	db_query_topctrys  ($querystring);
	} 

	elseif (!isset($month) && !isset($year)) 
	{
		if ($googlestats == 1) 
		{
			$querystring = "WHERE user_agent LIKE \"%Google%\"";
		}

		db_query_all_months($querystring,$paramsup);
}

//html_footer();
html_footer();

//// Add the footer 

 include("$config[template_path]/admin_bottom.html");
 $conn->Close(); // close the db connection
?>

