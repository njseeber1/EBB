TEMPLATE Title: Drop down menu for Open-Realty (http://www.open-realty.org) 
MOD Author: DL Puckett <deborah@deborahsperspective.com> 

======================================================================
Changes made to Contactus.php so bottom header would fit in correctly.
Changes made to index.php
Chnages made to listingview.php

=======================================================================


INSTALLATION: 

Download zip file and open Zip.
Extract contactus.php,listingview.php, and index.php into your main open-realty root folder. The rest extract into your template folder.

Change the template information in your "common.php" file to:
$config['template_path'] = $config['basepath'].'/template/dropdown_menu';
$config['template_url'] = $config['baseurl'].'/template/dropdown_menu';
========================================================================================================
Files that need to be changed:
exmplmenu_var.js
user_top.html

Menu Changes are made in the exmplmenu_var.js. Open this file make your changes and then upload the file.

Look for and make changes here: Replace www.yoursite.com with your url.

var Arrws=['http://www.yoursite.com/template/dropdown_menu/images/tri.gif',7,12,'http://www.yoursite.com/template/dropdown_menu/images/tridown.gif',10,10,'http://www.yoursite.com/template/dropdown_menu/images/trileft.gif',7,12];	// Arrow source, width and height

Make changes on all the menus: look for on all menus: Replace www.yoursite.com with your url.

Example: 

Menu2_1=new Array("About Us","http://www.yoursite.com/aboutus.php","",0,20,115);
	Menu2_2=new Array("View Agents","http://www.yoursite.com/view_users.php","",0,20,115);	
	Menu2_3=new Array("Contact Us","http://www.yoursite.com/contactus.php","",0);

Read config_menu.htm for more information on how to make changes in colors, size etc...

If you do not use the full url to where all your files are, the menu will not work.
 
Be very careful making changes in this file, if you accedently delete something the menu will not work.


user_top.html changes:

Open user top and look for //Replace www.yoursite.com with your url.
<script type='text/javascript' src='http://www.yourwebsite.com/template/dropdown_menu/exmplmenu_var.js'></script>
<script type='text/javascript' src='http://www.yourwebsite.com/template/dropdown_menu/menu_com.js'></script>
 
 When you are finished upload all these files including
 exmplmenu_var.js
 menu_com.js
 user_top.html
 No need to upload
 config_menu.htm

============================================================================================================
.PSD files included so you can customize the graphics. When you save for web keep same names and upload .jpgs.
============================================================================================================
To change colors of the CSS if you wish, Files that can be changed are: admin_top.html

To change the headers in the menu change class= "header" in the css style sheet.


In the head look for //here you can make changes to color, borders text etc... in the admin file//

#navcontainer A

#navcontainer A:hover, #navcontainer A:active

#navcontainer A.active:link, #navcontainer A.active:visited


===============================================================================================



!!!!WARNING!!!! BACKUP ALL FILES AND DATABASES BEFORE ATTEMPTING TO INSTALL MOD! 