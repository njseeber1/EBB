/************************************************************************************	(c) Ger Versluis 2000 version 5.411 24 December 2001 (updated Jan 31st, 2003 by Dynamic Drive for Opera7)*	For info write to menus@burmees.nl		          **	You may remove all comments for faster loading	          *		***********************************************************************************/	var NoOffFirstLineMenus=6;			// Number of first level items	var LowBgColor='#FFFFFF';			// Background color when mouse is not over	var LowSubBgColor='white';			// Background color when mouse is not over on subs	var HighBgColor='#325380';			// Background color when mouse is over	var HighSubBgColor='#325380';			// Background color when mouse is over on subs	var FontLowColor='black';			// Font color when mouse is not over	var FontSubLowColor='black';			// Font color subs when mouse is not over	var FontHighColor='white';			// Font color when mouse is over	var FontSubHighColor='white';			// Font color subs when mouse is over	var BorderColor='#ffffff';			// Border color	var BorderSubColor='#325380';			// Border color for subs	var BorderWidth=1;				// Border width	var BorderBtwnElmnts=1;			// Border between elements 1 or 0	var FontFamily="verdana,arial"	// Font family menu items	var FontSize=8;				// Font size menu items	var FontBold=1;				// Bold menu items 1 or 0	var FontItalic=0;				// Italic menu items 1 or 0	var MenuTextCentered='left';			// Item text position 'left', 'center' or 'right'	var MenuCentered='left';			// Menu horizontal position 'left', 'center' or 'right'	var MenuVerticalCentered='top';		// Menu vertical position 'top', 'middle','bottom' or static	var ChildOverlap=.2;				// horizontal overlap child/ parent	var ChildVerticalOverlap=.2;			// vertical overlap child/ parent	var StartTop=139;				// Menu offset x coordinate	var StartLeft=0;				// Menu offset y coordinate	var VerCorrect=0;				// Multiple frames y correction	var HorCorrect=0;				// Multiple frames x correction	var LeftPaddng=12;				// Left padding	var TopPaddng=2;				// Top padding	var FirstLineHorizontal=1;			// SET TO 1 FOR HORIZONTAL MENU, 0 FOR VERTICAL	var MenuFramesVertical=1;			// Frames in cols or rows 1 or 0	var DissapearDelay=1000;			// delay before menu folds in	var TakeOverBgColor=0;			// Menu frame takes over background color subitem frame	var FirstLineFrame='navig';			// Frame where first level appears	var SecLineFrame='space';			// Frame where sub levels appear	var DocTargetFrame='space';			// Frame where target documents appear	var TargetLoc='';				// span id for relative positioning	var HideTop=0;				// Hide first level when loading new document 1 or 0	var MenuWrap=0;				// enables/ disables menu wrap 1 or 0	var RightToLeft=0;				// enables/ disables right to left unfold 1 or 0	var UnfoldsOnClick=0;			// Level 1 unfolds onclick/ onmouseover	var WebMasterCheck=0;			// menu tree checking on or off 1 or 0	var ShowArrow=1;				// Uses arrow gifs when 1	var KeepHilite=1;				// Keep selected path highligthed	var Arrws=['http://www.eaglebusinessbrokers.com/template/vertical-menu/images/tri.gif',7,12,'http://www.eaglebusinessbrokers.com/template/vertical-menu/images/tridown.gif',10,10,'http://www.eaglebusinessbrokers.com/template/vertical-menu/images/tri.gif',7,12];	// Arrow source, width and heightfunction BeforeStart(){return}function AfterBuild(){return}function BeforeFirstOpen(){return}function AfterCloseAll(){return}// Menu tree//	MenuX=new Array(Text to show, Link, background image (optional), number of sub elements, height, width);//	For rollover images set "Text to show" to:  "rollover:Image1.jpg:Image2.jpg"Menu1=new Array("Home","http://www.eaglebusinessbrokers.com","",0,20,94);Menu2=new Array("About","http://www.eaglebusinessbrokers.com/aboutus.php","",4);	Menu2_1=new Array("About Us","http://www.eaglebusinessbrokers.com/aboutus.php","",0,20,94);	Menu2_2=new Array("Sold Listings","http://www.eaglebusinessbrokers.com/listing_browse.php?&status=sold","",0,20,94);	Menu2_3=new Array("View Agents","http://www.eaglebusinessbrokers.com/view_users.php","",0,20,94);		Menu2_4=new Array("Contact Us","http://www.eaglebusinessbrokers.com/contactus.php","",0);		Menu3=new Array("Properties","http://www.eaglebusinessbrokers.com/listing_browse.php?","",11);	Menu3_1=new Array("Liquor Stores","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Liquor+Stores","",0,20,100);	Menu3_2=new Array("Restaurants","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Restaurants","",0);	Menu3_3=new Array("Hotels","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Hotels","",0);	Menu3_4=new Array("Gas Stations","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Convenience%2FGas+Stations","",0);	Menu3_5=new Array("Laundromats","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Laundromats","",0);	Menu3_6=new Array("Bars & Clubs","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Bars+%26+Clubs","",0);	Menu3_7=new Array("Residential","http://www.eaglebusinessbrokers.com/brittany/","",0);	Menu3_8=new Array("Dry cleaners","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Dry+Cleaners","",0);	Menu3_9=new Array("Daycare","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Daycare","",0);	Menu3_10=new Array("Manufacturing","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Manafacturing","",0);    Menu3_11=new Array("Others","http://www.eaglebusinessbrokers.com/listing_browse.php?&type%5B%5D=Others","",0);	Menu4=new Array("Search","javascript:top.location.href='http://www.eaglebusinessbrokers.com/listingsearch.php'","",2);	Menu4_1=new Array("Commercial","http://www.eaglebusinessbrokers.com/listingsearch.php","",0,20,100);	Menu4_2=new Array("Residential","http://www.eaglebusinessbrokers.com/brittany","",0);	Menu5=new Array("Resources","javascript:top.location.href='http://www.eaglebusinessbrokers.com/moreinfo.php'","",5);	Menu5_1=new Array("For Buyers","http://www.eaglebusinessbrokers.com/buyers.php","",0,20,100);	Menu5_2=new Array("For Sellers","http://www.eaglebusinessbrokers.com/sellers.php","",0);	Menu5_3=new Array("Financial","http://www.eaglebusinessbrokers.com/banker.php","",0);	Menu5_4=new Array("Legal Help","http://www.eaglebusinessbrokers.com/lawyer.php","",0);	Menu5_5=new Array("More","http://www.eaglebusinessbrokers.com/moreinfo.php","",0);Menu6=new Array("Members","javascript:top.location.href='blank.htm'","",3);	Menu6_1=new Array("My Favorites","http://www.eaglebusinessbrokers.com/members/listfavorites.php","",0,20,97);	Menu6_2=new Array("Saved Searches","http://www.eaglebusinessbrokers.com/members/listsavedsearches.php","",0);	Menu6_3=new Array("Join Mail List","http://www.eaglebusinessbrokers.com/modules/list_public.php","",0);		