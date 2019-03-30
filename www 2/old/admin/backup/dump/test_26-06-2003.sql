#
# Admin Backup module
# Open-Realty version 1.0.7+
# http://www.open-realty.org
#
# Host: localhost
# Backed Up On: 26 Jun, 2003 at 17:02
# Database : `test`
# --------------------------------------------------------
#
# Table structure for table `default_activitylog`
#
DROP TABLE IF EXISTS default_activitylog;
CREATE TABLE `default_activitylog` (
  `id` int(11) NOT NULL auto_increment,
  `log_date` datetime NOT NULL default '0000-00-00 00:00:00',
  `user` int(11) NOT NULL default '0',
  `action` varchar(150) NOT NULL default '',
  `ip_address` varchar(15) NOT NULL default '',
  KEY `id` (`id`)
) TYPE=MyISAM;
#
# Dumping data for table `default_activitylog`
#
INSERT INTO default_activitylog VALUES (1,'2003-06-26 08:34:45',1,'Updated User: 1','127.0.0.1');
INSERT INTO default_activitylog VALUES (2,'2003-06-26 08:37:40',1,'Created User: member','127.0.0.1');
INSERT INTO default_activitylog VALUES (3,'2003-06-26 08:38:01',1,'Uploaded User Image 2_nophoto.gif','127.0.0.1');
INSERT INTO default_activitylog VALUES (4,'2003-06-26 08:38:37',1,'Created User: agent','127.0.0.1');
INSERT INTO default_activitylog VALUES (5,'2003-06-26 08:38:46',1,'Uploaded User Image 3_nophoto.gif','127.0.0.1');
INSERT INTO default_activitylog VALUES (6,'2003-06-26 08:40:00',1,'Created Listing 2','127.0.0.1');
INSERT INTO default_activitylog VALUES (7,'2003-06-26 08:41:21',1,'Created Listing 3','127.0.0.1');
INSERT INTO default_activitylog VALUES (8,'2003-06-26 08:41:40',1,'Deleted Listing 3','127.0.0.1');
INSERT INTO default_activitylog VALUES (9,'2003-06-26 08:43:06',1,'Uploaded Listing Image 2_01073139.jpg','127.0.0.1');
INSERT INTO default_activitylog VALUES (10,'2003-06-26 08:43:41',1,'Created User: user','127.0.0.1');
INSERT INTO default_activitylog VALUES (11,'2003-06-26 09:03:15',1,'Deleted User: 3','127.0.0.1');
INSERT INTO default_activitylog VALUES (12,'2003-06-26 09:03:22',1,'Deleted User: 4','127.0.0.1');
INSERT INTO default_activitylog VALUES (13,'2003-06-26 09:04:04',1,'Created User: agent','127.0.0.1');
INSERT INTO default_activitylog VALUES (14,'2003-06-26 09:05:25',1,'Deleted User: 5','127.0.0.1');
INSERT INTO default_activitylog VALUES (15,'2003-06-26 09:05:53',1,'Created User: agent','127.0.0.1');
INSERT INTO default_activitylog VALUES (16,'2003-06-26 09:13:02',1,'Updated User: 6','127.0.0.1');
INSERT INTO default_activitylog VALUES (17,'2003-06-26 09:13:25',1,'Deleted User: 6','127.0.0.1');
INSERT INTO default_activitylog VALUES (18,'2003-06-26 09:14:05',1,'Created User: agent','127.0.0.1');
INSERT INTO default_activitylog VALUES (19,'2003-06-26 09:21:18',1,'Updated Listing 1','127.0.0.1');
INSERT INTO default_activitylog VALUES (20,'2003-06-26 09:21:36',1,'Updated Listing 2','127.0.0.1');
INSERT INTO default_activitylog VALUES (21,'2003-06-26 09:28:57',1,'Updated Listing 1','127.0.0.1');
INSERT INTO default_activitylog VALUES (22,'2003-06-26 09:29:31',1,'Updated Listing 2','127.0.0.1');
INSERT INTO default_activitylog VALUES (23,'2003-06-26 09:49:44',1,'Updated User: 2','127.0.0.1');
INSERT INTO default_activitylog VALUES (24,'2003-06-26 10:03:56',1,'Updated User: 2','127.0.0.1');
INSERT INTO default_activitylog VALUES (25,'2003-06-26 10:05:01',1,'Created Listing 4','127.0.0.1');
INSERT INTO default_activitylog VALUES (26,'2003-06-26 10:16:40',1,'Created Listing 5','127.0.0.1');
INSERT INTO default_activitylog VALUES (27,'2003-06-26 10:16:50',1,'Deleted Listing 5','127.0.0.1');
INSERT INTO default_activitylog VALUES (28,'2003-06-26 10:17:23',1,'Created Listing 6','127.0.0.1');
INSERT INTO default_activitylog VALUES (29,'2003-06-26 10:18:15',1,'Created Listing 7','127.0.0.1');
INSERT INTO default_activitylog VALUES (30,'2003-06-26 10:30:19',1,'Created Listing 8','127.0.0.1');
INSERT INTO default_activitylog VALUES (31,'2003-06-26 10:42:35',1,'Updated User: 7','127.0.0.1');
INSERT INTO default_activitylog VALUES (32,'2003-06-26 11:12:03',1,'Updated User: 7','127.0.0.1');
#
# Table structure for table `default_agentformelements`
#
DROP TABLE IF EXISTS default_agentformelements;
CREATE TABLE `default_agentformelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_type` varchar(20) NOT NULL default '',
  `field_name` varchar(20) NOT NULL default '',
  `field_caption` varchar(80) NOT NULL default '',
  `default_text` text NOT NULL,
  `field_elements` text NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `required` char(3) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_agentformelements`
#
INSERT INTO default_agentformelements VALUES (3,'textarea','info','Info','','',10,'No');
INSERT INTO default_agentformelements VALUES (4,'text','phone','Phone','','',1,'No');
INSERT INTO default_agentformelements VALUES (5,'text','mobile','Mobile','','',3,'No');
INSERT INTO default_agentformelements VALUES (6,'text','fax','Fax','','',5,'No');
INSERT INTO default_agentformelements VALUES (7,'url','homepage','Homepage','','',7,'No');
#
# Table structure for table `default_listingsdb`
#
DROP TABLE IF EXISTS default_listingsdb;
CREATE TABLE `default_listingsdb` (
  `ID` int(11) NOT NULL auto_increment,
  `user_ID` int(11) NOT NULL default '0',
  `Title` varchar(80) NOT NULL default '',
  `expiration` date NOT NULL default '0000-00-00',
  `notes` text NOT NULL,
  `creation_date` date NOT NULL default '0000-00-00',
  `last_modified` timestamp(14) NOT NULL,
  `hitcount` int(11) NOT NULL default '0',
  `featured` char(3) NOT NULL default 'no',
  `active` char(3) NOT NULL default 'yes',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `ID_2` (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_listingsdb`
#
INSERT INTO default_listingsdb VALUES (1,1,'WhiteHouse','2003-07-01','This is an example listing!','2002-07-01',20030626114801,20,'yes','yes');
INSERT INTO default_listingsdb VALUES (2,1,'test#101','2004-06-25','test','2003-06-26',20030626093856,4,'yes','yes');
INSERT INTO default_listingsdb VALUES (4,1,'test#102','2004-06-25','','2003-06-26',20030626120021,1,'no','yes');
INSERT INTO default_listingsdb VALUES (6,1,'test#103','2004-06-25','','2003-06-26',20030626101723,0,'no','yes');
INSERT INTO default_listingsdb VALUES (7,1,'test#104','2004-06-25','','2003-06-26',20030626101815,0,'no','yes');
INSERT INTO default_listingsdb VALUES (8,1,'test#105','2004-06-25','','2003-06-26',20030626103019,0,'no','yes');
#
# Table structure for table `default_listingsdbelements`
#
DROP TABLE IF EXISTS default_listingsdbelements;
CREATE TABLE `default_listingsdbelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_name` varchar(20) NOT NULL default '',
  `field_value` text NOT NULL,
  `listing_id` int(11) NOT NULL default '0',
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`),
  KEY `idx_listingid3` (`listing_id`)
) TYPE=MyISAM;
#
# Dumping data for table `default_listingsdbelements`
#
INSERT INTO default_listingsdbelements VALUES (1052,'prop_tax','0',1,1);
INSERT INTO default_listingsdbelements VALUES (1053,'garage_size','40 car',1,1);
INSERT INTO default_listingsdbelements VALUES (1054,'status','Active',1,1);
INSERT INTO default_listingsdbelements VALUES (1055,'mls','13013',1,1);
INSERT INTO default_listingsdbelements VALUES (1056,'home_features','Balcony||Patio/Deck||Waterfront||Dishwasher||Disposal||Gas Range||Microwave||Washer/Dryer||Carpeted Floors||Hardwood Floors||Air Conditioning||Alarm||Cable/Satellite TV||Fireplace||Wheelchair Access ',1,1);
INSERT INTO default_listingsdbelements VALUES (1057,'community_features','Fitness Center||Golf Course||Pool||Spa/Jacuzzi||Sports Complex||Tennis Courts||Bike Paths||Boating||Courtyard||Playground/Park||Association Fee||Clubhouse||Controlled Access||Public Transportation',1,1);
INSERT INTO default_listingsdbelements VALUES (1051,'lot_size','20 Acres',1,1);
INSERT INTO default_listingsdbelements VALUES (1050,'sq_feet','35,000',1,1);
INSERT INTO default_listingsdbelements VALUES (1049,'year_built','1800',1,1);
INSERT INTO default_listingsdbelements VALUES (1048,'floors','6',1,1);
INSERT INTO default_listingsdbelements VALUES (1047,'baths','35',1,1);
INSERT INTO default_listingsdbelements VALUES (1046,'beds','10',1,1);
INSERT INTO default_listingsdbelements VALUES (1045,'type','Rental',1,1);
INSERT INTO default_listingsdbelements VALUES (1044,'full_desc','Exclusive to this site! For two hundred years, the White House hasstood as a symbol of the Presidency, the United States government,and the American people.',1,1);
INSERT INTO default_listingsdbelements VALUES (1043,'price','800',1,1);
INSERT INTO default_listingsdbelements VALUES (1042,'neighborhood','Capitol',1,1);
INSERT INTO default_listingsdbelements VALUES (1041,'zip','20500',1,1);
INSERT INTO default_listingsdbelements VALUES (1040,'state','District of Columbia',1,1);
INSERT INTO default_listingsdbelements VALUES (1039,'city','Washington',1,1);
INSERT INTO default_listingsdbelements VALUES (1038,'address','1600 Pennsylvania Avenue',1,1);
INSERT INTO default_listingsdbelements VALUES (1075,'mls','',2,1);
INSERT INTO default_listingsdbelements VALUES (1074,'status','Active',2,1);
INSERT INTO default_listingsdbelements VALUES (1073,'garage_size','Car park',2,1);
INSERT INTO default_listingsdbelements VALUES (1072,'prop_tax','2000',2,1);
INSERT INTO default_listingsdbelements VALUES (1071,'lot_size','920m2',2,1);
INSERT INTO default_listingsdbelements VALUES (1070,'sq_feet','2000',2,1);
INSERT INTO default_listingsdbelements VALUES (1069,'year_built','1960',2,1);
INSERT INTO default_listingsdbelements VALUES (1068,'floors','1',2,1);
INSERT INTO default_listingsdbelements VALUES (1067,'baths','2',2,1);
INSERT INTO default_listingsdbelements VALUES (1066,'beds','4',2,1);
INSERT INTO default_listingsdbelements VALUES (1065,'type','Rental',2,1);
INSERT INTO default_listingsdbelements VALUES (1064,'full_desc','',2,1);
INSERT INTO default_listingsdbelements VALUES (1061,'zip','123456',2,1);
INSERT INTO default_listingsdbelements VALUES (1062,'neighborhood','',2,1);
INSERT INTO default_listingsdbelements VALUES (1063,'price','200',2,1);
INSERT INTO default_listingsdbelements VALUES (1060,'state','Arizona',2,1);
INSERT INTO default_listingsdbelements VALUES (1059,'city','Charleville',2,1);
INSERT INTO default_listingsdbelements VALUES (1058,'address','123 this street',2,1);
INSERT INTO default_listingsdbelements VALUES (1076,'address','123 this street',4,1);
INSERT INTO default_listingsdbelements VALUES (1077,'city','Charleville',4,1);
INSERT INTO default_listingsdbelements VALUES (1078,'state','California',4,1);
INSERT INTO default_listingsdbelements VALUES (1079,'zip','123456',4,1);
INSERT INTO default_listingsdbelements VALUES (1080,'neighborhood','',4,1);
INSERT INTO default_listingsdbelements VALUES (1081,'price','',4,1);
INSERT INTO default_listingsdbelements VALUES (1082,'full_desc','',4,1);
INSERT INTO default_listingsdbelements VALUES (1083,'type','Farms',4,1);
INSERT INTO default_listingsdbelements VALUES (1084,'beds','',4,1);
INSERT INTO default_listingsdbelements VALUES (1085,'baths','',4,1);
INSERT INTO default_listingsdbelements VALUES (1086,'floors','',4,1);
INSERT INTO default_listingsdbelements VALUES (1087,'year_built','',4,1);
INSERT INTO default_listingsdbelements VALUES (1088,'sq_feet','',4,1);
INSERT INTO default_listingsdbelements VALUES (1089,'lot_size','',4,1);
INSERT INTO default_listingsdbelements VALUES (1090,'garage_size','',4,1);
INSERT INTO default_listingsdbelements VALUES (1091,'prop_tax','',4,1);
INSERT INTO default_listingsdbelements VALUES (1092,'status','Active',4,1);
INSERT INTO default_listingsdbelements VALUES (1093,'mls','',4,1);
INSERT INTO default_listingsdbelements VALUES (1122,'floors','',6,1);
INSERT INTO default_listingsdbelements VALUES (1121,'baths','',6,1);
INSERT INTO default_listingsdbelements VALUES (1120,'beds','',6,1);
INSERT INTO default_listingsdbelements VALUES (1119,'type','Home',6,1);
INSERT INTO default_listingsdbelements VALUES (1118,'full_desc','',6,1);
INSERT INTO default_listingsdbelements VALUES (1117,'price','',6,1);
INSERT INTO default_listingsdbelements VALUES (1116,'neighborhood','',6,1);
INSERT INTO default_listingsdbelements VALUES (1115,'zip','4565',6,1);
INSERT INTO default_listingsdbelements VALUES (1114,'state','Alabama',6,1);
INSERT INTO default_listingsdbelements VALUES (1113,'city','Horsham',6,1);
INSERT INTO default_listingsdbelements VALUES (1112,'address','200 Wills Street',6,1);
INSERT INTO default_listingsdbelements VALUES (1123,'year_built','',6,1);
INSERT INTO default_listingsdbelements VALUES (1124,'sq_feet','',6,1);
INSERT INTO default_listingsdbelements VALUES (1125,'lot_size','',6,1);
INSERT INTO default_listingsdbelements VALUES (1126,'garage_size','',6,1);
INSERT INTO default_listingsdbelements VALUES (1127,'prop_tax','',6,1);
INSERT INTO default_listingsdbelements VALUES (1128,'status','Active',6,1);
INSERT INTO default_listingsdbelements VALUES (1129,'mls','',6,1);
INSERT INTO default_listingsdbelements VALUES (1130,'address','321 this street',7,1);
INSERT INTO default_listingsdbelements VALUES (1131,'city','Charleville',7,1);
INSERT INTO default_listingsdbelements VALUES (1132,'state','Alabama',7,1);
INSERT INTO default_listingsdbelements VALUES (1133,'zip','4565',7,1);
INSERT INTO default_listingsdbelements VALUES (1134,'neighborhood','',7,1);
INSERT INTO default_listingsdbelements VALUES (1135,'price','',7,1);
INSERT INTO default_listingsdbelements VALUES (1136,'full_desc','',7,1);
INSERT INTO default_listingsdbelements VALUES (1137,'type','Home',7,1);
INSERT INTO default_listingsdbelements VALUES (1138,'beds','',7,1);
INSERT INTO default_listingsdbelements VALUES (1139,'baths','',7,1);
INSERT INTO default_listingsdbelements VALUES (1140,'floors','',7,1);
INSERT INTO default_listingsdbelements VALUES (1141,'year_built','',7,1);
INSERT INTO default_listingsdbelements VALUES (1142,'sq_feet','',7,1);
INSERT INTO default_listingsdbelements VALUES (1143,'lot_size','',7,1);
INSERT INTO default_listingsdbelements VALUES (1144,'garage_size','',7,1);
INSERT INTO default_listingsdbelements VALUES (1145,'prop_tax','',7,1);
INSERT INTO default_listingsdbelements VALUES (1146,'status','Active',7,1);
INSERT INTO default_listingsdbelements VALUES (1147,'mls','',7,1);
INSERT INTO default_listingsdbelements VALUES (1148,'address','63 Wills Street',8,1);
INSERT INTO default_listingsdbelements VALUES (1149,'city','Charleville',8,1);
INSERT INTO default_listingsdbelements VALUES (1150,'state','Alabama',8,1);
INSERT INTO default_listingsdbelements VALUES (1151,'zip','123456',8,1);
INSERT INTO default_listingsdbelements VALUES (1152,'neighborhood','',8,1);
INSERT INTO default_listingsdbelements VALUES (1153,'price','',8,1);
INSERT INTO default_listingsdbelements VALUES (1154,'full_desc','',8,1);
INSERT INTO default_listingsdbelements VALUES (1155,'type','Home',8,1);
INSERT INTO default_listingsdbelements VALUES (1156,'beds','',8,1);
INSERT INTO default_listingsdbelements VALUES (1157,'baths','',8,1);
INSERT INTO default_listingsdbelements VALUES (1158,'floors','',8,1);
INSERT INTO default_listingsdbelements VALUES (1159,'year_built','',8,1);
INSERT INTO default_listingsdbelements VALUES (1160,'sq_feet','',8,1);
INSERT INTO default_listingsdbelements VALUES (1161,'lot_size','',8,1);
INSERT INTO default_listingsdbelements VALUES (1162,'garage_size','',8,1);
INSERT INTO default_listingsdbelements VALUES (1163,'prop_tax','',8,1);
INSERT INTO default_listingsdbelements VALUES (1164,'status','Active',8,1);
INSERT INTO default_listingsdbelements VALUES (1165,'mls','',8,1);
#
# Table structure for table `default_listingsformelements`
#
DROP TABLE IF EXISTS default_listingsformelements;
CREATE TABLE `default_listingsformelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_type` varchar(20) NOT NULL default '',
  `field_name` varchar(20) NOT NULL default '',
  `field_caption` varchar(80) NOT NULL default '',
  `default_text` text NOT NULL,
  `field_elements` text NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `required` char(3) NOT NULL default '',
  `location` varchar(15) NOT NULL default '',
  `display_on_browse` char(3) NOT NULL default 'No',
  `searchable` int(10) unsigned NOT NULL default '0',
  `search_type` varchar(10) default NULL,
  `search_label` varchar(50) default NULL,
  `search_step` int(11) NOT NULL default '0',
  `display_priv` char(3) NOT NULL default 'No',
  PRIMARY KEY  (`ID`),
  KEY `idx_searchable` (`searchable`)
) TYPE=MyISAM;
#
# Dumping data for table `default_listingsformelements`
#
INSERT INTO default_listingsformelements VALUES (1,'text','city','City','','',2,'Yes','top_left','Yes',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (2,'text','address','Address','','',0,'Yes','top_left','Yes',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (3,'text','mls','mls','','',33,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (21,'checkbox','home_features','Home Features','','Balcony||Patio/Deck||Waterfront||Dishwasher||Disposal||Gas Range||Microwave||Washer/Dryer||Carpeted Floors||Hardwood Floors||Air Conditioning||Alarm||Cable/Satellite TV||Fireplace||Wheelchair Access ',80,'No','feature1','No',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (5,'number','prop_tax','Annual Property Tax','','',29,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (6,'select','status','Status','','Active||Pending||Sold',31,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (7,'text','lot_size','Lot Size','','',27,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (8,'text','garage_size','Garage Size','','',29,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (9,'text','year_built','Year Built','','',23,'No','top_left','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (10,'number','sq_feet','Square Feet','','',25,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (11,'text','baths','Baths','','',19,'No','top_left','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (12,'number','floors','Floors','','',21,'No','top_left','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (13,'text','beds','Beds','','',17,'No','top_left','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (14,'select','type','Type','','Home||Land||Farms||Commercial||Rental',15,'No','top_right','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (16,'textarea','full_desc','Full Description','','',13,'No','center','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (17,'text','neighborhood','Neighborhood','','',7,'No','top_left','',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (18,'price','price','Price','','',9,'No','top_left','',1,'minmax','Price',5000,'No');
INSERT INTO default_listingsformelements VALUES (19,'text','zip','Zip','','',5,'Yes','top_left','Yes',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (20,'select','state','State','','Alabama||Alaska||Arizona||Arkansas||California||Colorado||Connecticut||Delaware||District of Columbia||Florida||Georgia||Hawaii||Idaho||Illinois||Indiana||Iowa||Kansas||Kentucky||Louisiana||Maine||Maryland||Massachusetts||Alabama||Alaska||Arizona||Arkansas||California||Colorado||Connecticut||Delaware||District of Columbia||Florida||Georgia||Hawaii||Idaho||Illinois||Indiana||Iowa||Kansas||Kentucky||Louisiana||Maine||Maryland||Massachusetts||Michigan||Minnesota||Mississippi||Missouri||Montana||Nebraska||Nevada||New Hampshire||New Jersey||New Mexico||New York||North Carolina||North Dakota||Ohio||Oklahoma||Oregon||Pennsylvania||Rhode Island||South Carolina||South Dakota||Tennessee||Texas||Utah||Vermont||Virginia||Washington||West Virginia||Wisconsin||Wyoming',4,'Yes','top_left','Yes',0,'','',0,'No');
INSERT INTO default_listingsformelements VALUES (22,'checkbox','community_features','Community Features','','Fitness Center||Golf Course||Pool||Spa/Jacuzzi||Sports Complex||Tennis Courts||Bike Paths||Boating||Courtyard||Playground/Park||Association Fee||Clubhouse||Controlled Access||Public Transportation',85,'No','feature2','No',1,'optionlist','Community Features',0,'No');
#
# Table structure for table `default_listingsimages`
#
DROP TABLE IF EXISTS default_listingsimages;
CREATE TABLE `default_listingsimages` (
  `ID` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `caption` varchar(255) NOT NULL default '',
  `file_name` varchar(80) NOT NULL default '',
  `thumb_file_name` varchar(80) NOT NULL default '',
  `description` text NOT NULL,
  `listing_id` int(11) NOT NULL default '0',
  `rank` int(11) NOT NULL default '5',
  `active` char(3) NOT NULL default 'yes',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_listingsimages`
#
INSERT INTO default_listingsimages VALUES (1,1,'View From the Lawn','1_white-house.jpg','thumb_1_white-house.jpg','This property has six floors, 132 rooms, 35 bathrooms, 147 windows, 412 doors, 12 chimneys, 8 staircases, and 3 elevators.',1,1,'yes');
INSERT INTO default_listingsimages VALUES (2,1,'Vermeil Room','1_vermeil_room.jpg','thumb_1_vermeil_room.jpg','The Vermeil Room, sometimes called the Gold Room, was last refurbished in 1991; it serves as a display room and, for formal occasions, as a ladies sitting room. The soft yellow of the paneled walls complements the collection of vermeil, or gilded silver, bequeathed to the White House in 1956 by Mrs. Margaret Thompson Biddle.',1,5,'yes');
INSERT INTO default_listingsimages VALUES (3,1,'The China Room','1_china_room.jpg','thumb_1_china_room.jpg','The Presidential Collection Room, now the China Room, was designated by Mrs. Woodrow Wilson in 1917 to display the growing collection of White House china. The room was redecorated in 1970, retaining the traditional red color scheme determined by the portrait of Mrs. Calvin Coolidge--painted by Howard Chandler Christy in 1924. President Coolidge, who was scheduled to sit for Christy, was too occupied that day with events concerning the Teapot Dome oil scandal. So the President postponed his appointment, and Mrs. Coolidge posed instead.',1,5,'yes');
INSERT INTO default_listingsimages VALUES (4,1,'State Dining Room','1_dining_room.jpg','thumb_1_dining_room.jpg','The State Dining Room, which now seats as many as 140 guests, was originally much smaller and served at various times as a drawing room, office, and Cabinet Room. Not until the Andrew Jackson administration was it called the State Dining Room, although it had been used for formal dinners by previous Presidents.',1,5,'yes');
INSERT INTO default_listingsimages VALUES (5,1,'The Green Room','1_green_room.jpg','thumb_1_green_room.jpg','Although intended by architect James Hoban to be the Common Dining Room, the Green Room has served many purposes since the White House was first occupied in 1800. The inventory of February 1801 indicates that it was first used as a Lodging Room. Thomas Jefferson, the second occupant of the White House, used it as a dining room with a canvas floor cloth, painted green, foreshadowing the present color scheme. James Madison made it a sitting room since his Cabinet met in the East Room next door, and the Monroes used it as the Card Room with two tables for the whist players among their guests. ',1,5,'yes');
INSERT INTO default_listingsimages VALUES (6,1,'','2_01073139.jpg','thumb_2_01073139.jpg','',2,5,'yes');
#
# Table structure for table `default_memberformelements`
#
DROP TABLE IF EXISTS default_memberformelements;
CREATE TABLE `default_memberformelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_type` varchar(20) NOT NULL default '',
  `field_name` varchar(20) NOT NULL default '',
  `field_caption` varchar(80) NOT NULL default '',
  `default_text` text NOT NULL,
  `field_elements` text NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `required` char(3) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_memberformelements`
#
INSERT INTO default_memberformelements VALUES (3,'textarea','info','Info','','',10,'No');
INSERT INTO default_memberformelements VALUES (4,'text','phone','Phone','','',1,'No');
INSERT INTO default_memberformelements VALUES (5,'text','mobile','Mobile','','',3,'No');
INSERT INTO default_memberformelements VALUES (6,'text','fax','Fax','','',5,'No');
INSERT INTO default_memberformelements VALUES (7,'url','homepage','Homepage','','',7,'No');
#
# Table structure for table `default_userdb`
#
DROP TABLE IF EXISTS default_userdb;
CREATE TABLE `default_userdb` (
  `ID` int(11) NOT NULL auto_increment,
  `user_name` varchar(80) NOT NULL default '',
  `emailAddress` varchar(80) NOT NULL default '',
  `Comments` text NOT NULL,
  `user_password` varchar(50) NOT NULL default '',
  `isAdmin` char(3) NOT NULL default 'No',
  `canEditForms` char(3) NOT NULL default 'No',
  `creation_date` date NOT NULL default '0000-00-00',
  `canFeatureListings` char(3) NOT NULL default 'No',
  `canViewLogs` char(3) NOT NULL default 'No',
  `last_modified` timestamp(14) NOT NULL,
  `hitcount` int(11) NOT NULL default '0',
  `canModerate` char(3) NOT NULL default 'no',
  `isAgent` char(3) NOT NULL default 'no',
  `active` char(3) NOT NULL default 'no',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`,`user_name`),
  KEY `ID_2` (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_userdb`
#
INSERT INTO default_userdb VALUES (1,'admin','admin@localhost.net','','5f4dcc3b5aa765d61d8327deb882cf99','yes','yes','2002-07-01','yes','yes',20030626093851,2,'yes','yes','yes');
INSERT INTO default_userdb VALUES (2,'member','member@here.com','','aa08769cdcb26674c6706093503ff0a3','no','no','2003-06-26','no','no',20030626100356,1,'no','no','no');
INSERT INTO default_userdb VALUES (7,'agent','agent@here.cam','','b33aed8f3134996703dc39f9a7c95783','no','no','2003-06-26','no','no',20030626111203,1,'no','no','no');
#
# Table structure for table `default_userdbelements`
#
DROP TABLE IF EXISTS default_userdbelements;
CREATE TABLE `default_userdbelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_name` varchar(80) NOT NULL default '',
  `field_value` text NOT NULL,
  `user_id` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`),
  UNIQUE KEY `ID` (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_userdbelements`
#
INSERT INTO default_userdbelements VALUES (11,'edit_canViewLogs','yes',1);
INSERT INTO default_userdbelements VALUES (10,'edit_canEditForms','yes',1);
INSERT INTO default_userdbelements VALUES (9,'edit_isAdmin','yes',1);
INSERT INTO default_userdbelements VALUES (8,'edit_isAgent','yes',1);
INSERT INTO default_userdbelements VALUES (7,'edit_active','yes',1);
INSERT INTO default_userdbelements VALUES (12,'edit_canModerate','yes',1);
INSERT INTO default_userdbelements VALUES (13,'edit_canFeatureListings','yes',1);
INSERT INTO default_userdbelements VALUES (14,'phone','00000000',1);
INSERT INTO default_userdbelements VALUES (15,'mobile','0000000000',1);
INSERT INTO default_userdbelements VALUES (16,'fax','00000000',1);
INSERT INTO default_userdbelements VALUES (17,'homepage','http://localhost.net',1);
INSERT INTO default_userdbelements VALUES (18,'info','I am the system administrator!',1);
INSERT INTO default_userdbelements VALUES (123,'fax','',2);
INSERT INTO default_userdbelements VALUES (122,'mobile','',2);
INSERT INTO default_userdbelements VALUES (121,'phone','',2);
INSERT INTO default_userdbelements VALUES (120,'edit_canFeatureListings','no',2);
INSERT INTO default_userdbelements VALUES (119,'edit_canModerate','no',2);
INSERT INTO default_userdbelements VALUES (117,'edit_canEditForms','no',2);
INSERT INTO default_userdbelements VALUES (118,'edit_canViewLogs','no',2);
INSERT INTO default_userdbelements VALUES (116,'edit_isAdmin','no',2);
INSERT INTO default_userdbelements VALUES (149,'info','',7);
INSERT INTO default_userdbelements VALUES (148,'homepage','',7);
INSERT INTO default_userdbelements VALUES (147,'fax','',7);
INSERT INTO default_userdbelements VALUES (146,'mobile','',7);
INSERT INTO default_userdbelements VALUES (145,'phone','',7);
INSERT INTO default_userdbelements VALUES (144,'edit_canFeatureListings','no',7);
INSERT INTO default_userdbelements VALUES (143,'edit_canModerate','no',7);
INSERT INTO default_userdbelements VALUES (142,'edit_canViewLogs','no',7);
INSERT INTO default_userdbelements VALUES (141,'edit_canEditForms','no',7);
INSERT INTO default_userdbelements VALUES (140,'edit_isAdmin','no',7);
INSERT INTO default_userdbelements VALUES (139,'edit_isAgent','no',7);
INSERT INTO default_userdbelements VALUES (138,'edit_active','yes',7);
INSERT INTO default_userdbelements VALUES (115,'edit_isAgent','no',2);
INSERT INTO default_userdbelements VALUES (114,'edit_active','yes',2);
INSERT INTO default_userdbelements VALUES (124,'homepage','',2);
INSERT INTO default_userdbelements VALUES (125,'info','',2);
#
# Table structure for table `default_userfavoritelistings`
#
DROP TABLE IF EXISTS default_userfavoritelistings;
CREATE TABLE `default_userfavoritelistings` (
  `ID` int(11) NOT NULL auto_increment,
  `user_ID` int(11) NOT NULL default '0',
  `listing_ID` int(11) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_userfavoritelistings`
#
INSERT INTO default_userfavoritelistings VALUES (1,1,2);
#
# Table structure for table `default_userformelements`
#
DROP TABLE IF EXISTS default_userformelements;
CREATE TABLE `default_userformelements` (
  `ID` int(11) NOT NULL auto_increment,
  `field_type` varchar(20) NOT NULL default '',
  `field_name` varchar(20) NOT NULL default '',
  `field_caption` varchar(80) NOT NULL default '',
  `default_text` text NOT NULL,
  `field_elements` text NOT NULL,
  `rank` int(11) NOT NULL default '0',
  `required` char(3) NOT NULL default '',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_userformelements`
#
INSERT INTO default_userformelements VALUES (3,'textarea','info','Info','','',10,'No');
INSERT INTO default_userformelements VALUES (4,'text','phone','Phone','','',1,'No');
INSERT INTO default_userformelements VALUES (5,'text','mobile','Mobile','','',3,'No');
INSERT INTO default_userformelements VALUES (6,'text','fax','Fax','','',5,'No');
INSERT INTO default_userformelements VALUES (7,'url','homepage','Homepage','','',7,'No');
#
# Table structure for table `default_userimages`
#
DROP TABLE IF EXISTS default_userimages;
CREATE TABLE `default_userimages` (
  `ID` int(11) NOT NULL auto_increment,
  `user_id` int(11) NOT NULL default '0',
  `caption` varchar(255) NOT NULL default '',
  `file_name` varchar(80) NOT NULL default '',
  `thumb_file_name` varchar(80) NOT NULL default '',
  `description` text NOT NULL,
  `rank` int(11) NOT NULL default '5',
  `active` char(3) NOT NULL default 'yes',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_userimages`
#
INSERT INTO default_userimages VALUES (1,2,'','2_nophoto.gif','2_nophoto.gif','',5,'yes');
INSERT INTO default_userimages VALUES (2,3,'','3_nophoto.gif','3_nophoto.gif','',5,'yes');
#
# Table structure for table `default_usersavedsearches`
#
DROP TABLE IF EXISTS default_usersavedsearches;
CREATE TABLE `default_usersavedsearches` (
  `ID` int(11) NOT NULL auto_increment,
  `user_ID` int(11) NOT NULL default '0',
  `Title` varchar(255) NOT NULL default '',
  `query_string` longtext NOT NULL,
  `last_viewed` timestamp(14) NOT NULL,
  `new_listings` tinyint(4) NOT NULL default '0',
  PRIMARY KEY  (`ID`)
) TYPE=MyISAM;
#
# Dumping data for table `default_usersavedsearches`
#
INSERT INTO default_usersavedsearches VALUES (1,1,'save test #1','&price-min=200&price-max=1000',20030626093735,0);
