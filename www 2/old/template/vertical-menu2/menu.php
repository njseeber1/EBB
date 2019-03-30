<script type="text/javascript">
<!--
function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_preloadImages() { //v3.0
  var d=document; if(d.images){ if(!d.MM_p) d.MM_p=new Array();
    var i,j=d.MM_p.length,a=MM_preloadImages.arguments; for(i=0; i<a.length; i++)
    if (a[i].indexOf("#")!=0){ d.MM_p[j]=new Image; d.MM_p[j++].src=a[i];}}
}

function MM_findObj(n, d) { //v4.0
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && document.getElementById) x=document.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}
//-->
</script>

<a href="<?php echo $config[baseurl]; ?>/index.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Home','','<?php echo $config[template_url] ?>/images/buttons/rhome.jpg',1)">
<img name="Home" border="0" src="<?php echo $config[template_url] ?>/images/buttons/shome.jpg" width="155" height="48" alt="<?php echo $lang['menu_home']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/listingsearch.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Search','','<?php echo $config[template_url] ?>/images/buttons/rsearch.jpg',1)">
<img name="Search" border="0" src="<?php echo $config[template_url] ?>/images/buttons/ssearch.jpg" width="155" height="48" alt="<?php echo $lang['menu_search_listings']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/rentalsearch.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Rental Search','','<?php echo $config[template_url] ?>/images/buttons/rrsearch.jpg',1)">
<img name="Rental Search" border="0" src="<?php echo $config[template_url] ?>/images/buttons/srsearch.jpg" width="155" height="48" alt="<?php echo $lang['menu_search_rental_listings']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Land" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Land','','<?php echo $config[template_url] ?>/images/buttons/rland.jpg',1)">
<img name="Land" border="0" src="<?php echo $config[template_url] ?>/images/buttons/sland.jpg" width="155" height="48" alt="<?php echo $lang['menu_land']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Home" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Homes','','<?php echo $config[template_url] ?>/images/buttons/rhomes.jpg',1)">
<img name="Homes" border="0" src="<?php echo $config[template_url] ?>/images/buttons/shomes.jpg" width="155" height="48" alt="<?php echo $lang['menu_homes']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Farms" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Farms','','<?php echo $config[template_url] ?>/images/buttons/rfarms.jpg',1)">
<img name="Farms" border="0" src="<?php echo $config[template_url] ?>/images/buttons/sfarms.jpg" width="155" height="48" alt="<?php echo $lang['menu_farms']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Commercial" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Commercial','','<?php echo $config[template_url] ?>/images/buttons/rcommercial.jpg',1)">
<img name="Commercial" border="0" src="<?php echo $config[template_url] ?>/images/buttons/scommercial.jpg" width="155" height="48" alt="<?php echo $lang['menu_commercial']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/view_users.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Our Agents','','<?php echo $config[template_url] ?>/images/buttons/ragents.jpg',1)">
<img name="Our Agents" border="0" src="<?php echo $config[template_url] ?>/images/buttons/sagents.jpg" width="155" height="48" alt="<?php echo $lang['menu_view_agents']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/aboutus.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('About Us','','<?php echo $config[template_url] ?>/images/buttons/rabout.jpg',1)">
<img name="About Us" border="0" src="<?php echo $config[template_url] ?>/images/buttons/sabout.jpg" width="155" height="48" alt="<?php echo $lang['menu_about_us']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/contactus.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Contact Us','','<?php echo $config[template_url] ?>/images/buttons/rcontact.jpg',1)">
<img name="Contact Us" border="0" src="<?php echo $config[template_url] ?>/images/buttons/scontact.jpg" width="155" height="48" alt="<?php echo $lang['menu_contact_us']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/members/listfavorites.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Favorite Listings','','<?php echo $config[template_url] ?>/images/buttons/rsavlist.jpg',1)">
<img name="Contact Us" border="0" src="<?php echo $config[template_url] ?>/images/buttons/ssavlist.jpg" width="155" height="48" alt="<?php echo $lang['menu_favorite_listings']; ?>"></a><br>
<a href="<?php echo $config[baseurl]; ?>/members/listsavedsearches.php" onMouseOut="MM_swapImgRestore()" onMouseOver="MM_swapImage('Saved Searches','','<?php echo $config[template_url] ?>/images/buttons/rsavsearch.jpg',1)">
<img name="Contact Us" border="0" src="<?php echo $config[template_url] ?>/images/buttons/ssavsearch.jpg" width="155" height="48" alt="<?php echo $lang['menu_saved_searches']; ?>"></a><br>
