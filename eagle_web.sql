-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 03, 2019 at 01:38 PM
-- Server version: 5.6.39-cll-lve
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eagle_web`
--

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

CREATE TABLE `blogs` (
  `blogId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `heading` varchar(200) DEFAULT NULL,
  `blogDate` date DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`blogId`, `companyId`, `heading`, `blogDate`, `content`) VALUES
(1, 1, 'proposed change of the Law', '2015-03-13', '<p><strong>DENVER &mdash; Grocery stores in Colorado are launching a campaign to change liquor laws throughout the state. They want to sell full-strength beer and liquor. Opponents to the idea argue that a change will cause more harm than convenience. Right now grocery stores can&rsquo;t sell full-strength beer and they can only sell wine and other liquor at one location in the entire state. There have been more than a half-dozen attempts to change these laws in the past, they always failed. The effort is a bit different this time. &ldquo;It&rsquo;s really time for us to bring some choice and convenience to the Colorado customer,&rdquo; says Chris Howes of Colorado Consumers for Choice. He says the liquor laws which have been in place since the 1930s are out of date, and grocery stores should be able to sell the same alcohol as liquor stores. </strong></p>\r\n\r\n<p><strong>His group is gathering signatures for a potential ballot initiative in 2016 that would let voters decide what the laws should be, rather than lawmakers handling the process</strong>.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `brokers`
--

CREATE TABLE `brokers` (
  `brokerId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `brokerName` varchar(50) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `brokers`
--

INSERT INTO `brokers` (`brokerId`, `companyId`, `brokerName`, `status`) VALUES
(1, 1, 'Mathew Abraham', 1),
(2, 1, 'Samuel Abraham', 1),
(3, 1, 'George', 1),
(4, 1, 'Ludmila Blagonya', 1),
(5, 1, 'Samuel E Abraham', 0),
(6, 1, 'James King', 0),
(7, 1, 'Pierre Elie', 1),
(8, 1, 'Scott Baird', 1);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `companyId` int(10) UNSIGNED NOT NULL,
  `companyName` varchar(100) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `street` varchar(50) DEFAULT NULL,
  `city` varchar(50) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `state` varchar(50) DEFAULT NULL,
  `postalCode` varchar(15) DEFAULT NULL,
  `web` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `mobile` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`companyId`, `companyName`, `address`, `street`, `city`, `district`, `state`, `postalCode`, `web`, `email`, `phone`, `mobile`) VALUES
(1, 'Eagle Business Brokers', '3443 S Galena Street', 'Suite 210', 'Denver', NULL, NULL, 'CO 80231', 'http://www.eaglebusinessbrokers.com', 'meabraham@msn.com', '(303) 743-7303', '(303) 873-9068');

-- --------------------------------------------------------

--
-- Table structure for table `listings`
--

CREATE TABLE `listings` (
  `listingId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `listingDate` date DEFAULT NULL,
  `status` tinyint(3) UNSIGNED DEFAULT NULL,
  `priority` tinyint(3) UNSIGNED NOT NULL,
  `remarks` varchar(200) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `category` tinyint(3) UNSIGNED NOT NULL,
  `classification` tinyint(3) UNSIGNED NOT NULL,
  `location` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `area` varchar(100) DEFAULT NULL,
  `rent` varchar(50) DEFAULT NULL,
  `listPrice` varchar(50) DEFAULT NULL,
  `annualSales` varchar(50) DEFAULT NULL,
  `inventory` varchar(50) DEFAULT NULL,
  `grossIncome` varchar(50) DEFAULT NULL,
  `yearEstablished` varchar(20) DEFAULT NULL,
  `brokerId` int(10) UNSIGNED NOT NULL,
  `description` text,
  `locationLink` varchar(1000) DEFAULT NULL,
  `listRank` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `type` varchar(80) NOT NULL DEFAULT 'other',
  `count` int(9) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `listings`
--

INSERT INTO `listings` (`listingId`, `companyId`, `listingDate`, `status`, `priority`, `remarks`, `title`, `category`, `classification`, `location`, `city`, `area`, `rent`, `listPrice`, `annualSales`, `inventory`, `grossIncome`, `yearEstablished`, `brokerId`, `description`, `locationLink`, `listRank`, `type`, `count`) VALUES
(10, 1, '2015-02-04', 3, 1, 'Liquor Store in a very busy cross stree', 'Europa Liquor Englewood', 1, 1, '8727 E Dry Creek Rd', 'Centennial CO 80012', '3,000', '00', '00', '900,000', '00', '00', '1989', 1, '<p>A fantastic busiens opportunity in the heart of Green wood Village with great exposure and nested in a vibrent community. The Store has great growth potentnial.</p>\r\n\r\n<p>Specilaized products catering to the diverse ethnic community would be a great opportunity to grow. Very friendly &nbsp;customers and fantastic service.</p>\r\n\r\n<p>The store caters to a nitch customer base. The store enjoys a phenominal aove above average of 30% profit margin.</p>\r\n', '', 3, 'liquor', 0),
(11, 1, '2014-10-02', 3, 1, 'New Store on Florida', 'Florida Liquor Store', 1, 1, '7597 W Florida Ave', 'Lakewood CO 80032', '2800', '00', '00', '900,000', '00', '00', '2013', 1, '<p>Brand new store with fatastic State Of The Art Facillity</p>\r\n', '', 999, 'liquor', 0),
(12, 1, '2014-07-09', 3, 1, 'A profitable Store', 'Globe Liquor on Washington ', 1, 1, '4915 Washington St', 'Denver CO 80216', '1,500', '00', '00', '600,000', '100,000', '150,000', '1989', 1, '<p>A great liquor store on Washingtion street. Good neghborhood store</p>\r\n', '', 999, 'liquor', 0),
(13, 1, '2014-10-08', 3, 2, 'A store in a very busy street', 'Good Liquor ', 1, 1, '275 Sheridan Blvd ', 'Lakewood CO ', '2,500', '00', '00', '500,000', '00', '00', '2000', 1, '', '', 999, 'liquor', 0),
(14, 1, '2014-07-03', 3, 2, 'A great Store', 'Happy Liquor', 1, 1, '4141 Kipling St', 'Wheat Ridge CO 80123', '3,000', '00', '00', '900,000', '00.00', '00', '1986', 1, '<p>Great trasaction for both parties</p>\r\n', '', 999, 'liquor', 0),
(15, 1, '2014-09-11', 1, 2, 'Profitable Smoke supply Business', 'Nimbus Smoke Shop Denver ', 1, 1, '2960 S Federal Blvd', 'Denver CO 80123', '1,000', '1,700', '70,000', '150,000', '40,000', '120,000', '2014', 1, '<p>A fabulous smoke supply shop strategically located in one of the busiest traffic location. The store has been experiencing phenomenal growth since opened for business. &nbsp;Business is operated by absentee owner. It is ideal for an entrepreneurial industrious person to maximize the potential. With a healthy down payment , the Seller may carry as the seller is motivated to sell.&nbsp; Please do not talk to the employees with out listing agent present.&nbsp;</p>\r\n\r\n<p><span style=\"background-color:rgb(255, 255, 255); color:rgb(0, 0, 255); font-family:robotoregular; font-size:20px\">Please call Mathew Abraham 303-359-7868 before visiting the store</span></p>\r\n', '2960 S Federal Blvd Denver CO 80236', 999, 'other', 29),
(18, 1, '2013-05-30', 3, 2, 'Highlands Liquor ', 'Albertson\'s Center Liquor Store', 1, 1, '9455 S. University Blvd', 'Highlands Ranch CO  80126', '3,500', '00', '00', '1.4 Million ', '00', '00', '2004', 1, '<p>A very busy store located in the Albertsons Center.&nbsp;</p>\r\n', '', 999, 'liquor', 0),
(21, 1, '2015-03-28', 3, 2, 'Very Busy Store ', 'Stanley Lake Westminster', 1, 1, 'Wadsworth Blvd', 'Arvada CO 80003', '3,000', '000', '00', '800,000', '00.00', '00', '1998', 1, '', '', 999, 'liquor', 0),
(22, 1, '2013-10-30', 3, 2, 'Mexico and Buckley Intersection', 'Bottle Barn Aurora ', 1, 1, 'Mexico and Buckley', 'Aurora CO', '3,500', '00', '00', '1.4 Million', '000', '00', '2001', 1, '', '', 999, 'liquor', 0),
(23, 1, '2012-10-04', 3, 2, 'Best Cantonese Food ', 'Chinese Pavellion Tamarac Square ', 1, 1, 'Tamarac and Hampden ', 'Denver CO 80231', '1,500', '00', '00', '00', '00', '00', '201', 1, '<p><span style=\"font-size:20px\">A great Chinese Resturant with long tradition and popular for the unique cousine</span>.&nbsp;&nbsp;</p>\r\n', '', 999, 'barrestaurant', 0),
(24, 1, '0000-00-00', 3, 2, 'Close to Sloans Lake', 'Aloha Liquor Denver ', 1, 1, '38th ', 'Denver ', '1,200', '1,200', '00', '400,000', '00', '00', '1979', 1, '', '', 999, 'liquor', 0),
(25, 1, '2013-11-06', 3, 1, 'One of the Largest Liquor stores in Metro Denver', 'Arrow Liquor Denver ', 1, 1, '8055 W. Bowles Ave #2, ', ' Littleton, COâ€  80123 ', '15,000', '00', '00', '5,000,000', '00', '00', '2000', 1, '', '', 1, 'liquor', 0),
(26, 1, '2013-07-09', 3, 2, 'Great Store in Lakewood', 'Atlas Liquor located on Kipling ', 1, 1, 'Kiping ', 'Lakewood', '3,200', '4,000', '00', '1.1 Million ', '00.00', '00', '2001', 1, '', '', 999, 'liquor', 0),
(27, 1, '2008-03-29', 3, 2, 'A great neighborhood store', 'Neighborhood Liquor store on wadsworth ', 1, 1, 'Wadsworth', 'Lakewood', '2,500', '00', '00', '450,000', '00', '00', '1990', 1, '', '', 999, 'liquor', 0),
(28, 1, '2007-08-05', 3, 2, 'Leetsdale Bar', 'Blue Line Bar- Close to Cherry Creek', 1, 1, '5151 Leetsdale ', 'Denver CO ', '5,500', '00', '00', '00.00', '00', '00', '2003', 1, '', '', 999, 'barrestaurant', 0),
(29, 1, '0000-00-00', 3, 1, 'One of the finest Liquor Stores in Denver', 'Bonnie Brae Liquor- Historic Liquor Store', 1, 1, '785 S University Blvd', 'Denver CO 80209', '5,500', '00', '00', '3.Million', '00', '00', '1970', 1, '', '', 2, 'liquor', 0),
(30, 1, '0000-00-00', 3, 2, 'Open Space City of Westminster', '120th and Huron ', 1, 2, '120th and Huron ', 'Westminster', '12 acre land ', '00', '4,000,000', '00', '00.00', '00.00', 'N/A', 1, '<p>12 Acre land sold to City of Westminister to be designated as Open Space.&nbsp;</p>\r\n', '', 999, 'land', 0),
(31, 1, '0000-00-00', 3, 3, '30,000 Square Church ', 'Historic Covenant Church on Hampden', 1, 2, '8390 E Hampden Ave', 'Denver CO 80231', '30,000', '00', '3,000,000.00', '00.00', '00.00', '00.00', '1934', 1, '<p>One of the historic churches in Denver Colorado. Located in a very trendy neighborhod, close to Denver Tech Center and at the center of Denver Colorado</p>\r\n', '', 999, 'church', 0),
(32, 1, '0000-00-00', 3, 2, 'Located at the corner of Alameda and Chambers', 'J.J Burgers', 1, 1, '382 E Hampden Ave', 'Aurora CO', '1,200', '00', '00', '00', '00', '00', '2000', 1, '', '', 999, 'barrestaurant', 0),
(33, 1, '0000-00-00', 3, 3, 'One of the land marks in city of Parker ', 'Chock Cherry Liquor- Oldest Liquor Store on Parker Rd', 1, 1, '1415 Parker Rd', 'Parker CO 80134', '3,500', '00', '00', '700,000', '00', '00', '1987', 1, '', '', 999, 'liquor', 0),
(34, 1, '2015-01-01', 3, 3, 'A very busy liquor store in Lakewood', 'Josh Liquor located on Colfax', 1, 1, '6569 W Colfax Ave', 'Lakewood CO 80214', '3,500', '7,300', '595,000', '1.5 million ', '200,000', '330,000', '2008', 1, '<p><span style=\"font-size:18px\">A well establised liquor store with stable clientile at the location for a long time.</span></p>\r\n\r\n<p><span style=\"font-size:18px\">This store has great profit margin and opportunity to grow.</span></p>\r\n\r\n<p><span style=\"font-size:18px\">The listed&nbsp;price is $625,000 plus inventory of approximatley&nbsp;$200,000.</span></p>\r\n\r\n<p><span style=\"color:#FF0000\"><span style=\"font-size:18px\">The Buyer need $170,000- 250,000 in cash as down payment to secure an SBA loan</span></span></p>\r\n\r\n<p><span style=\"font-size:18px\">Motivated seller !!!! Call Mathew Abraham before visiting the store</span></p>\r\n\r\n<h2 style=\"font-style:italic\">&nbsp;</h2>\r\n\r\n<p><span style=\"color:#0000FF\"><strong><span style=\"font-size:20px\"><big><strong>Call</strong><strong>&nbsp;Mathew Abraham 303-359-7868&nbsp;</strong></big></span></strong></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '', 2, 'liquor', 0),
(35, 1, '0000-00-00', 3, 2, 'Auto Body and Repair Shop', 'Young\'s Auto Body- Famous Body Shop ', 1, 2, '2280 W Evans Ave', 'Denver CO ', '10,000', '00', '0', '2,000,000', '00', '00', '1970', 1, '<p>A fantasitc autobody shop with paint booth, ample parking</p>\r\n', '', 999, 'automobile', 0),
(36, 1, '0000-00-00', 3, 3, 'Church located at Lowry', 'Historic Church at Lowry', 1, 2, '1167 Xenia St', 'Denver  CO 80220', '18,000', '00', '00', '00', '00', '00', '1945', 1, '<p>A great church building located at Lowry Air Force Base</p>\r\n', '', 999, 'church', 0),
(38, 1, '0000-00-00', 3, 3, 'A great neighborhood eatery', 'Crown Burger- DU Area', 1, 1, '2387 S Downing St', 'Denver CO 80210', '900', '00', '00', '00.00', '00', '00', '1980', 1, '', '', 999, 'barrestaurant', 0),
(39, 1, '0000-00-00', 3, 2, 'Great', 'Village Center Liquor Highlands Ranch', 1, 1, '9553 S. University Blvd', 'Highlands Ranch CO 80126', '3,200', '00', '00', '2 Million', '00', '00.00', '2000', 1, '', '', 999, 'liquor', 0),
(40, 1, '0000-00-00', 3, 2, 'Right on Colorado Blvd and Mexico', 'Super Wine- Colorado and Mexico', 1, 1, '34', 'Denver CO ', '3,500', '7,000', '00', '1.3 Million ', '00', '00', '2000', 1, '', '', 999, 'liquor', 0),
(41, 1, '0000-00-00', 3, 2, 'Very busy ', 'Ware House Liquor ', 1, 1, 'Hampden ', 'Sheridan ', '10,000', '00', '00', '3,000,000', '200,000', '00', '1987', 1, '', '', 999, 'liquor', 0),
(42, 1, '0000-00-00', 3, 2, 'Fantastic Liquor ', 'Mission Vallejo  ', 1, 1, '15400 E. Hampden Ave', 'Aurrora CO 80013', '2,000', '00', '00', '850,000', '00', '00', '2000', 1, '', '', 999, 'liquor', 0),
(43, 1, '2000-03-03', 3, 3, 'Very Busy Store', 'Primo Liquor ', 1, 1, '23 ', 'Aurora ', '3,000', '00', '00', '600,000', '00', '00', '2009', 1, '', '', 999, 'liquor', 0),
(44, 1, '0000-00-00', 3, 2, 'Great Location ', 'Crown Liquor ', 1, 1, '4042 S Parker Road', 'Aurora CO 80014', '8,000', '6,000', '00', '2,000,000', '000', '00', '2000', 1, '', '', 999, 'liquor', 0),
(45, 1, '0000-00-00', 3, 2, 'In South E Denver', 'Pinky\'s Liquor ', 1, 1, 'Yosemite and Hampden ', 'Denver CO 80231', '1,500', '2,300', '00', '800,000', '00', '00', '1987', 1, '', '', 999, 'liquor', 0),
(47, 1, '2009-03-03', 3, 2, 'Parker Road Location ', 'Day Care in Denver ', 1, 1, 'Parker Road', 'Aurora CO', '3,000', '00', '00', '00', '00', '00', '2001', 1, '', '', 999, 'other', 0),
(48, 1, '0000-00-00', 3, 2, 'At Lowry Base', 'Dayton Liquor ', 1, 1, 'Dayton', 'Denver CO ', '1,200', '1,400', '00', '560,000', '00', '00', '2000', 1, '', '', 999, 'liquor', 0),
(49, 1, '0000-00-00', 3, 2, 'Good', 'Father and Son ', 1, 1, '120th', 'Thronton', '00', '00', '00', '400,000', '00', '0', '2001', 1, '', '', 999, 'liquor', 0),
(50, 1, '0000-00-00', 3, 2, 'Sheridan and Alameda', 'Good Liquor ', 1, 1, '275 S Sheridan Ave #104', 'Lakewood CO 80226', '00', '00', '00', '650,000', '00', '0', '2008', 1, '', '', 999, 'liquor', 0),
(52, 1, '0000-00-00', 3, 2, 'Iliff and Peoria ', 'I P Liquor ', 1, 1, 'Peora', 'Aurora CO', '0', '0', '0', '600,000', '0', '0', '0', 1, '', '', 999, 'liquor', 0),
(53, 1, '0000-00-00', 3, 2, 'At Sloans Lake', 'J J Liquor ', 1, 1, 'Sloans', 'Edgewater', '00', '00', '0', '00.00', '00', '1 Million', '2002', 1, '', '', 999, 'liquor', 0),
(54, 1, '0000-00-00', 3, 2, 'Wadsworth', 'Kelly\'s Liquor Broomfield', 1, 1, 'Depot Hill', 'Broomfield', '00', '0', '0', '900,000', '0', '0', '00', 1, '', '', 999, 'liquor', 0),
(55, 1, '0000-00-00', 3, 2, 'Great Location ', 'Liquor 2000', 1, 1, '120th & Main ', 'Broomfield', '0', '0', '0', '700,000', '00', '00', '2002', 1, '', '', 999, 'liquor', 0),
(56, 1, '2000-01-01', 3, 2, 'Great Liquor and Check Cashing ', 'Sake Liquor ', 1, 1, 'Federal Blvd', 'Denver CO ', '0', '00', '0', '800,000', '0', '00', '1976', 1, '', '', 999, 'liquor', 0),
(57, 1, '0000-00-00', 3, 2, 'Sun', 'Sunset Liquor ', 1, 1, 'Colfax', 'Denver', '0', '0', '00', '400,000', '00', '00', '2000', 1, '', '', 999, 'liquor', 0),
(58, 1, '0000-00-00', 3, 2, 'Great Warehouse', 'Sam\'s Warehouse Thronton', 1, 1, 'Federal ', 'Northglenn', '0', '00', '00', '1.8 Million', '0', '00', '00', 1, '', '', 999, 'liquor', 0),
(59, 1, '0000-00-00', 3, 2, 'Smoky Hill and Chambers ', 'Smokey Hill Liquor ', 1, 1, 'Smoky Hill ', 'Aurora CO', '00', '00', '00', '700,000', '0', '0', '2001', 1, '', '', 999, 'liquor', 0),
(60, 1, '0000-00-00', 3, 2, 'On Alameda ', 'Sky Deck Liquor ', 1, 1, 'Alameda Ave', 'Denver CO ', '00', '00', '00', '680,000', '0', '00', '1978', 1, '', '', 999, 'liquor', 0),
(61, 1, '0000-00-00', 3, 2, 'Fantastic Home ', 'Joplin Ct', 1, 3, '1114 S Joplin Ct', 'Aurora CO', '2,400', '00', '256,000', '0', '00', '00', '0', 2, '', '', 999, 'residential', 0),
(62, 1, '0000-00-00', 3, 2, 'Historic Restaurant ', 'Symposium Restaurant in historic Littleton ', 1, 1, 'Litteton Blvd', 'Litteton', '7,000', '00', '00', '00', '00', '00', '2004', 1, '', '', 999, 'barrestaurant', 0),
(64, 1, '2008-04-02', 3, 2, 'Breakfast Lunch Eatery ', 'Breakfst and Lunch Cafe', 1, 1, 'Downing St', 'Denver CO ', '850', '00', '00', '00', '00', '00.00', '2008', 1, '<p>A Cozy litte eatery close to DU and Hospital</p>\r\n', '', 999, 'barrestaurant', 0),
(65, 1, '2005-04-09', 3, 2, 'A very unique Thai Resturant', 'Thai Flavor Restaurant Aurora ', 1, 1, '1012 S Peoria Ave', 'Aurora CO', '2,000', '000', '00', '00.00', '00.00', '00', '2000', 1, '<p>A fantasic resturant very uniqe&nbsp;</p>\r\n', '', 999, 'barrestaurant', 0),
(66, 1, '0000-00-00', 3, 3, 'Great Shopping Center', 'Federal Neighborhood Strip Mall ', 1, 2, '2960-2990 S Federal Blvd', 'Denver 80213', '10,000', '00', '2-3 Million', '00', '00', '00', '1980', 1, '<p>A fantastic neighborhood shopping center stratigiclly located at Federal Blvd and Lorett Heights College.&nbsp;</p>\r\n', '', 999, 'store', 0),
(67, 1, '2015-04-03', 1, 3, 'A Fantastic Liquor Store ', 'Quick Liquor in Longmont ', 1, 1, '1751 Hover St ', 'Longmont CO 80501', '4,000', '7,000', '650,000', '2 Million', '200,000', '370,000', '1987', 1, '<p><span style=\"font-size:14px\">This retail Liquor store is a phenominal time tested business opportunity for a creative business owner. </span></p>\r\n\r\n<p><span style=\"font-size:14px\">The store carries an array of hard to find items which brings in a a very loyal happy customers.&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:14px\">The store could expand the sales by carrying the specialty beers and other additional products.&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:14px\">A very motivated Seller willing to train the Buyer to assure the continued success.</span></p>\r\n\r\n<p><span style=\"font-size:14px\">Listed price is $675,000 plus $200,000 inventory. The total price is $875,000.00.&nbsp;</span></p>\r\n\r\n<p><span style=\"color:#0000FF\"><span style=\"font-size:14px\">The Buyer need $220,000-250,000 cash as a down payment to qualify for a Small Business Administration Loan.</span></span></p>\r\n\r\n<p><span style=\"color:#FF0000\"><span style=\"font-size:14px\"><span style=\"background-color:#FFFFFF\">No communication with the employees.</span></span></span><span style=\"background-color:rgb(255, 255, 255); font-size:14px\">.</span></p>\r\n\r\n<p><span style=\"font-size:14px\"><span style=\"font-size:20px\"><big>Please&nbsp;<span style=\"color:#0000FF\">call</span></big></span><span style=\"color:#0000FF\"> <span style=\"font-size:20px\"><strong>M<strong>athew </strong>Abraham 303-359-7868 before visiting the store</strong></span></span></span></p>\r\n', '', 1, 'liquor', 51),
(69, 1, '0000-00-00', 3, 3, 'Fabulous Condo at Whispering Pines West', 'Whispering Pines Condo', 1, 3, '7375 E Quincy Ave Unit 102', 'Denver CO 80237', '967', '00', '125,000', '00', '00', '00', '1971', 1, '<p><span style=\"font-size:18px\">One of the best updated condominium in the development.&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:18px\">2 bed room, 2 bath 1 covered parking&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:18px\">New paint, new carpet, wood floor, double pane windowsregrigerator and dishwasher.</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Community pool and tennis court. All external maintance is included in the current HOA of $265</span></p>\r\n\r\n<p><span style=\"font-size:18px\">One covered parking is included.&nbsp;</span></p>\r\n\r\n<p><span style=\"font-size:18px\">Easy access to I-25 and 225, DTC, Air port. close to Cherry Creek park and other outdoor activities.</span>&nbsp;</p>\r\n\r\n<p><span style=\"color:#0000FF\"><span style=\"font-size:20px\">Call Mathew Abraham to set up a showing 303-359-7868</span></span></p>\r\n', '', 999, 'residential', 0),
(70, 1, '0000-00-00', 3, 2, 'Branded Gas Station', 'Conoco Brand Gas and Convenience Store', 1, 1, 'Sheridan and US 37', 'Denver  CO', '3,000', '00', '1.2 Milllion', '1 Million ', '80,000', '00', '2000', 1, '<p>A fantastic gas and convenient store locacted on N Federal Blvd and Boulder Turn Pike</p>\r\n', '', 999, 'store', 0),
(71, 1, '2013-04-07', 3, 2, 'Fantastic Ranch', 'Home near University Hospital', 1, 3, '12333 E Park Lane Dr', 'Aurora CO 80011', '1700', '00', '00', '00', '00', '00', '1963', 1, '<p>Fantastic remodeled ranch close to University of Denver Hospital</p>\r\n', '', 999, 'residential', 0),
(73, 1, '0000-00-00', 3, 2, 'Great Ranch ', 'Bible Park Ranch', 1, 3, '6502 E Dickerson Dr', 'Denver CO 80231', '2,500', '00', '00', '00', '00', '0', '1980', 1, '<p>A beautiful ranch close to Bible Park&nbsp;</p>\r\n', '', 999, 'residential', 0),
(74, 1, '0000-00-00', 3, 3, 'Great Shopping center', '7 Eleven Anchored shopping Center', 1, 2, '77-85 W Alameda Ave', 'Denver CO', '8,000', '00', '1.8 Million', '00', '00', '00', '1986', 1, '<p>A 7 Eleven anchored very busy center sold&nbsp;</p>\r\n', '', 999, 'store', 0),
(75, 1, '2015-02-02', 3, 3, 'A great Asian Resturant', 'A fabulous Asian Cousine', 1, 1, '15470 Andrews Dr', 'Denver CO 80239', '1,900', '3,700', '110,000', '600,000', '6,000', '120,000', '2000', 1, '<p>A well established popular Asian cousine with a great&nbsp;reputation. Close to on of the fastest growing area close to Denver International Airport, I-70 and easy access to Down Town. For easy dine in or take out. &nbsp;</p>\r\n', '', 0, 'other', 0),
(76, 1, '2015-05-15', 3, 3, 'Strategically Located Liquor Store', 'Liquor Bank', 1, 1, '462 Malley Dr', 'Northgelnn CO ', '2500', '3,500', '00', '1,000,000', '00', '00', '2000', 1, '', '', 0, 'other', 0),
(77, 1, '2015-06-01', 3, 3, 'Gas station/ Convenient Store', 'Gas Station / country Grocery Store', 1, 2, '39608 High way 24  Lake George  CO 80816', 'Florissant', '1 Acre almost', '00', '400,000', 'Vacant gas Station ', '00', '00', '1990', 1, '<p>The dream opportunity to live in God&#39;s country and make a fabulous living away from traffic and pollution.</p>\r\n\r\n<p>The longest successfully operated popular gas station convenient store between Fair play and Woodland Park.</p>\r\n\r\n<p>Currently closed but easily operable gas station and convenient store with phenomenal potential for a driven entrepreneur.</p>\r\n\r\n<p>The best supply pit stop for fishing, camping and outdoors activities.</p>\r\n\r\n<p>The owners retired do not want to operate the store any more.</p>\r\n\r\n<p>The facility has a live in quarters consists of 1680 Square foot with 3 bedroom 2 bath.&nbsp;</p>\r\n\r\n<p>The sale includes an additional detached rented house.</p>\r\n\r\n<p>The rental home currently is leased on a long term.</p>\r\n\r\n<p><span style=\"background-color:rgb(255, 255, 255); color:rgb(85, 85, 85); font-family:robotoregular; font-size:20px\"><big>Please&nbsp;<span style=\"color:rgb(0, 0, 255)\">call</span></big></span><span style=\"background-color:rgb(255, 255, 255); color:rgb(0, 0, 255); font-family:robotoregular; font-size:14px\">&nbsp;<span style=\"font-size:20px\"><span style=\"color:rgb(0, 74, 149); font-family:arial,helvetica,sans-serif\">Mathew&nbsp;Abraham 303-359-7868 before visiting the store</span></span></span></p>\r\n\r\n<p>&nbsp;</p>\r\n', '', 0, 'other', 0),
(78, 1, '2015-04-01', 3, 1, 'Profitable Liquor Store', 'E A Liquor', 1, 1, '1005 W. 120th Ave., ', ' Westminster Co. 80234', '2300', '3200', '00', '700,000', '100,000', '00', '2008', 1, '<p>A great neighbourhood Liquor Store with high margins</p>\r\n', '', 0, 'other', 0),
(79, 1, '0008-09-13', 3, 2, 'Auto Recycling ', 'One of the Oldest Recycling Location', 1, 4, '3576 E 52nd Ave,', ' Denver, CO 80216', '2 acers', '00', '00', '00', '00', '00', '1980', 4, '<p>The broker sold the land.&nbsp;</p>\r\n', '', 0, 'other', 0),
(80, 1, '2015-06-12', 3, 2, 'Great Brick Home ', 'Morris Heights 3 bed 2 bath', 1, 3, '12712 E Parklane Dr ', 'Aurora CO 80011', '1285', '00', '240,000', '00.00', '00.00', '00.00', '1963', 1, '<p>Spacious beautiful 3 bed room 2 bath house in Morris heights. House backs to greenbelt and park, huge back yard with covered patio with storage shed, spectacular Mountain View. Hardwood floor though out the house, covered attached parking. Walking distance to University of Colorado Hospital. Quick possession.&nbsp;</p>\r\n', '', 0, 'other', 0),
(81, 1, '2015-01-02', 3, 2, 'A land mark neighborhood Center', 'Historic Grocery Shopping Center', 1, 2, '10021 W 26th Ave  ', 'Wheat Ridge, CO 80215', '60,000', '00', '00', '00', '00', 'Good Cap Rate', '1970', 1, '<p>Successfully sold the center by partnering with a national firm&nbsp;</p>\r\n', '', 0, 'other', 0),
(82, 1, '2015-08-20', 3, 3, 'A historic Liquor Store', 'Marshall Liquor ', 1, 2, '5216 Marshall St', 'Arvada', '7,000', '00.00', '2 Million', '1.8 Million ', '500,000', '400,000', '1984', 1, '<p>A very successful historic Liquor Store with proeprty</p>\r\n', '', 0, 'other', 0),
(83, 1, '2015-07-17', 3, 2, 'Great Residential Lot', 'Prime Residential Lot', 1, 2, '8158 Vivian St', 'Arvada CO', '10028', '00.00', '240,000', '00', '00', '00', '2010', 4, '<p>A fantastic residential lot in a prime location&nbsp;</p>\r\n', '', 0, 'other', 0),
(84, 1, '2015-06-09', 3, 2, 'A Great spacious house', 'A gem in Aurora', 1, 3, '17651 Brown Cir ', 'Aurora CO', '1800', '00', '265000', '0', '00', '00', '2002', 4, '<p>A fabulous home in Aurora&nbsp;</p>\r\n', '', 0, 'other', 0),
(85, 1, '2015-09-01', 3, 3, 'A great Cash cow', 'Very Profitable Convenient  Store ', 1, 1, '1090 E 10th Ave ', 'Broomfield', '2100', '2500', '125,000 plus inventory', '500,000', '30,000', '150,000', '1979', 1, '<p>A fantastic convenient store in opearion for 19 years. Te store is located in a high traffic area. A very stable business with loyal clients. The store has great potential for growth. A very motivated Seller who desirous to concentrate other business venhtures.&nbsp;</p>\r\n', '', 0, 'other', 0),
(86, 1, '2015-09-01', 3, 2, 'A great home ', 'Very spacious Home', 1, 3, '10474 Buckeie St', 'Arvada CO', '2000', '00', '245,000', '00', '0', '0', '2000', 4, '<p>A Fantasticn home with 3 bed room 2 bath.&nbsp;</p>\r\n', '', 0, 'other', 0),
(87, 1, '2015-12-01', 3, 3, 'Parker Liquor with great potential ', 'Parker store with low rent', 1, 1, '12543 High Way 83', 'Parker CO ', '5,000', '3,050', '320,000', '850,000', '150,000', '150,000', '2000', 1, '<p>A fabulous Liquor Store with low rent with great potential for growth. Stratigically located for easy access to every thing. The store has great potential for growth.&nbsp;Seller is pursuing higher education.&nbsp;</p>\r\n', '', 0, 'other', 0),
(96, 1, '2016-04-07', 3, 2, 'Commercial Land ', 'Retail Center', 1, 2, '6 th and Catawba ', 'Aurora CO', '5 Acres ', '00', '00', '00', '00', '00', '1960', 1, '<p>Eagle Busienss Brokers are proud to be the party in successfully closing the land&nbsp;</p>\r\n', '', 0, 'other', 0),
(97, 1, '2016-04-28', 3, 2, 'Well established liquor Store for sale', '470 & Smoky Hill Rd', 1, 1, 'Smoky Hill & 470', 'Aurora CO', '2610', '4750', '525000', '1500000', '150000', '330000', '2011', 1, '<p>A fabulous, clean, very customer friendly store located in a prestigious neighborhood catering to the neighborhood. Store has great growth potential.&nbsp;</p>\r\n', '', 0, 'other', 0),
(99, 1, '2016-07-22', 1, 2, 'Washington Street Liquor ', 'Washington Street', 1, 1, '58th and Washington ', 'Denver  CO ', '1,500', '1653', '75,000', '300,000', '30,000', '100,000', '2000', 1, '<p>A well established liquor store located right on Washinton Street with low rent and has great potnetial for growth. The Selelr is relocationg to another state. Vey motivated Seller.</p>\r\n\r\n<p>Call Mathew Abraham 303-359-7868</p>\r\n', '', 0, 'other', 92),
(100, 1, '2016-09-30', 3, 3, 'Store in the prime location ', 'Eagle Nest\'s Premier Store', 1, 1, '24300 E Smoky HIll Rd ', 'Aurora ', '2610', '4000', '500,000', '1.5 Million', '200,000', '350,000', '2011', 1, '<p>A fabulous store</p>\r\n', '', 0, 'other', 0),
(101, 1, '2016-09-23', 3, 2, 'Land in prime location ', 'Commercial Land', 1, 2, '1401 S Parker Rd ', 'Denver  CO', '56000', '00', '350000', '00', '00', '00', '2015', 1, '', '', 0, 'other', 0),
(102, 1, '2016-09-07', 3, 2, 'Lease Negotiations ', 'Liquor  Lease ', 2, 2, '2020 S Parker Rd ', 'Denver ', '2600', '00', '00', '0', '0', '0', '0', 1, '', '', 0, 'other', 0),
(106, 1, '2017-01-16', 1, 3, 'Fantastic Sam\'s Saloon', 'Fantastic Sam\'s Saloon in Aurora ', 1, 1, 'South East Aurora ', 'Aurora CO', '2,100', '4100', '92,000', '255,000', '6,000', '247,000', '2009', 1, '<p style=\"text-align:justify\">A very profitable national franchise is for sale. The store is located in a very upscale neighborhood. The franchise provides trendy designs, cutting, styling, texturing, sculpturing and other beauty services at affordable prices delivering great value to the customers. A very customer friendly environment to come in and relax while receiving fabulous service. The store is operated by a husband wife team has 8 styling stations and 3 wash stations.</p>\r\n\r\n<p>Please do not visit the site with out getting permission from the listing broker.</p>\r\n\r\n<p>Please call<span style=\"font-size:14px\"><span style=\"color:rgb(0, 0, 255)\"><strong> Mathew Abraham 303-359-7868</strong></span></span></p>\r\n', '', 0, 'other', 45),
(107, 1, '2017-01-18', 1, 3, 'Fantastic Sam Franchise in Aurora ', 'Fantastic Sam Franchise in Aurora', 1, 1, 'In South East Aurora ', 'Aurora CO', '1350', '3982', '75,000', '293,327', '6,000', '273,327', '2000', 1, '<p>A vibrabt profitable national franchise located in a trendy neighborhood. The facility is located in a center anchored by national tenants and high end hospitality industry. With trendy decor and with friendly staff, a cusotmer can feel very comfortable and enjoy the service. The owner is also a stylist and work in the facility.</p>\r\n', '', 0, 'other', 52),
(109, 1, '2017-09-14', 1, 3, 'Fabulous income away from traffic in a golf course', 'Event center/ Restaurant Bar in a Golf Course', 1, 2, '48680 Snead Dr', 'Burlington CO 80807', '16,000', '00', '650,000', '350,000', '50,000', '200,000', '2000', 1, '<p>Rare opportunity to own the Real Estate operating Restaurant and Bar situated in a golf course. A fabulous cash cow, away from rat race. Enjoy absolute country living and command an exceptional living by catering exclusively to city golf course and general public. Facility include 16,000 square foot with seating capacity of 450. Ideal for banquets, weddings, holiday gatherings and special occasions. Commercial kitchen with 2 full bars, dance floor, 4 commercial bathrooms and 2 additional bathrooms. The rental of pro shop brings in $900.00 for 6 months.</p>\r\n', '', 0, 'other', 32),
(111, 1, '2018-04-01', 1, 3, 'Best store in Sterling Colorado', 'Liquor store with Real Estate ', 1, 1, '529 Iris Dr', 'Sterling Colorado', '3200', '00', '800,000', '1,3000,000', '300,000', '250,000', '1970', 1, '<p>A well established profitable iconic retail liquor store located in a 3,000 Square foot facility with detached 25/40 storage facility. This store has the oldest in town servicing the loyal customers with an array of finest exotic and hard to find items. Easy access with ample parking. The store has immense potential for growth due to storage capacity.</p>\r\n', '', 0, 'other', 3),
(112, 1, '2018-04-01', 1, 3, 'Liquor store with drive through', 'High volume Liquor store in Longmont', 1, 1, '0000 Street', 'Longmont', '5500', '13,325', '700,000', '2,600,000', '300,000', '570,000', '2010', 1, 'A fabulous cutting-edge retail liquor store commanding 2.6 million sales store located in very busy street with easy drive through. Open and inviting for hard to find selections with adequate parking. The store has the most effective cooler with over 40 doors and has plenty of room to cater to burgeoning micro brew demand.  Low rent and great potential for growth.!!!!\r\n', '', 0, 'other', 26),
(113, 1, '2018-05-30', 1, 3, 'Fantastic Opportunity', 'Denver East Liquor Store', 1, 1, '2020 S Parker Rd ', 'Denver CO ', '2600', '4050', '170,000', '600,000', '150,000', '136,000 EBIDA', '2016', 1, '<p>A fantastic retail Liquor store located in a vey busy street. Easy access to every thing. Store offers a friendly, warm atmosphere for easy shopping to find hard to find items very competitively priced. Since reopening the store, the growth has been phenomenal. Plenty of room for additional storage and growth.</p>\r\n\r\n<p>The owner decided to sell due to other busienss commitments.</p>\r\n', '', 0, 'other', 8);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `newsId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `heading` varchar(150) DEFAULT NULL,
  `author` varchar(50) DEFAULT NULL,
  `newsDate` date DEFAULT NULL,
  `content` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`newsId`, `companyId`, `heading`, `author`, `newsDate`, `content`) VALUES
(2, 1, 'Liquor Law', 'Daria Serna of Colorado Department of Revenue', '2015-04-02', '<p><span style=\"line-height:1.6em\">The law requires not only separate ownership but a separate entrance (for non-members) and a separate checkout counter, according to Daria Serna of the Colorado Department of Revenue.</span></p>\r\n\r\n<p>It&rsquo;s worth it to gargantuan membership stores to lease space to outsiders. Apparently that&rsquo;s not the case for ordinary supermarkets like King Soopers and Safeway. So far, research has turned up only one non-membership grocery store with an in-house liquor store not owned by the corporation. Called Alpine Wine &amp; Spirits, it&rsquo;s located in the City Market (a sister chain to King Soopers) at Vail.</p>\r\n\r\n<p>There&rsquo;s a lot of competition for limited shelf space in grocery stores. The older, smaller ones are especially hard-pressed to make the room needed for regular groceries and household-related merchandise. The newer ones are larger but even they are reluctant to lease space out to a separately owned liquor store.</p>\r\n\r\n<p>Most supermarkets are in shopping malls where there already is a separate liquor store. Obviously the bean counters have figured out that, with competition nearby, a liquor lease would not bring in as much income per square foot as direct sales of groceries would.</p>\r\n\r\n<p>A group called Colorado Consumers for Choice, backed by the supermarkets, is working up an initiative for the 2016 ballot that would permit all groceries to sell wine, beer and, possibly, stronger liquors. The draft hasn&rsquo;t been finalized yet and would need to clear its effort with the Title Board and the Colorado Supreme Court, before signatures are gathered.</p>\r\n\r\n<p>If voters approve the initiative, we&rsquo;ll soon find out whether supermarkets can suddenly find space for wine, beer etc. in their existing box stores, or whether they spend a lot of money to expand them.</p>\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `offices`
--

CREATE TABLE `offices` (
  `officeId` int(10) UNSIGNED NOT NULL,
  `companyId` int(11) NOT NULL,
  `officeName` varchar(100) DEFAULT NULL,
  `location` varchar(50) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone` varchar(30) DEFAULT NULL,
  `fax` varchar(30) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1',
  `googleMapLink` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `offices`
--

INSERT INTO `offices` (`officeId`, `companyId`, `officeName`, `location`, `address`, `email`, `phone`, `fax`, `status`, `googleMapLink`) VALUES
(1, 1, 'Eagle Business Brokers LLC', 'Denver', '3650 S Yosemite St\r\nSuite 204\r\nDenver CO 80237-1837', 'meabraham14@yahoo.com', '303-743-7303', '303-873-9068', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE `queries` (
  `id` int(11) NOT NULL,
  `name` varchar(80) DEFAULT '',
  `phone` varchar(80) DEFAULT '',
  `email` varchar(80) DEFAULT '',
  `subject` varchar(100) DEFAULT '',
  `message` text,
  `title` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`id`, `name`, `phone`, `email`, `subject`, `message`, `title`) VALUES
(4, 'jagfjasd', '303-786-7856', 'jpeter34@yahoo.com', 'fa', 'dfdaf', NULL),
(3, 'mn', '456-897-9876', 'King23@yahoo.com', 'hj', 'afddafd', NULL),
(5, 'kjis', '30-776-8978', 'samuel34@yahoo.com', 'faf', 'dfadads', NULL),
(6, 'fsadfds', '303-743-9878', 'Miriam1@msn.com', 'fshd', 'fasfdsfdfsd', NULL),
(7, 'hkfdsafjdsfksd', '303-234-8987', 'jackin43@google.com', 'zvvc', ' cvafdfdsfdsfds', NULL),
(8, 'fsdfsdfds', '719-546-8756', 'timothy21@yahoo.com', 'gsdgdfgfd', 'vdgfdfdfd', NULL),
(9, 'TEST', 'TEST', 'testing@nomail.com', 'TEST', 'From Pecos & 120th Liquor Store ', NULL),
(10, 'TEST', 'TEST', 'testing@nomail.com', 'TEST', 'From Whispering Pines Condo', NULL),
(11, 'TEST', 'TEST', 'testing@nomail.com', 'TEST', 'From Josh Liquor', NULL),
(12, 'TEST', 'TEST', 'test@nomail.com', 'TEST', 'From Big D Liquor', NULL),
(13, 'TEST', 'TEST', 'testing@nomail.com', 'TEST', 'From Quick Liquor', NULL),
(14, 'TEST', 'TEST', 'testing@nomail.com', 'TEST', 'From Thrift Store for Sale', NULL),
(15, 'uiy', '675-9845-987', 'meabraham@msn.com', 'send', 'mnkjhkk', NULL),
(16, 'TEST', '1234', 'testing@nomail.com', 'TEST', 'Now you should really see the title', 'Quick Liquor  '),
(17, 'TEST', '123', 'testing@nomail.com', 'TEST', 'TEST', 'Big D Liquor'),
(18, 'tom', '123-898-9894', 'bob24@gmail.com', 'kl', 'ffkafkjfkf', 'Thrift Store for Sale'),
(19, '', '', '', '', '', ''),
(20, 'Bob', '234-8967', 'bob24@gmail.com', 'kjlsjfd', 'lfjfjfjafkd', ''),
(21, 'hdakfa', '784-984-8948', 'Mary345@yahoo.com', 'akjlajfa', 'fgadda', 'Thrift Store for Sale'),
(22, 'reggie', '303-894-8945', 'reggie234@yahoo.com', 'Want to buy', 'I have been looking for liquor stoes for 34 yeras you are the best site I have seen. \r\ncan you pleas help me I need your car \r\nI have 234,000 in cash I can be reached at the above number', 'Thrift Store for Sale'),
(23, 'jjkfkd', '784-675-8945', 'mary32@gmail.com', 'kfjalfalf', 'I want to touch you', 'Pecos & 120th Liquor Store'),
(24, 'kdjdk', '303-895-8956', 'raju234@gmail.com', 'kjlfjajf', 'flajafwkdfjjeqjffskldjfdsjfkdfjsdfjsjfkjsfjv hjfjfsdffhjfqiffjsficnjnfjfhnjfjafkbfaehabcjkjjawfbjfjafahfjanafdfjadjfdjcnafbajfjdfbbfjabfjdfjuadubvvqoefrnfad;f favnrf', 'Pecos & 120th Liquor Store'),
(25, 'lfafkajdf', '784-784-9949', 'king67@gmail.com', 'kllkf', 'fkafdsfjkldjflda', 'Josh Liquor '),
(26, '', '', '', '', '', ''),
(27, 'Bahaa Gerges', '7202568172', 'geobahaa@gmail.com', 'Interested to buy', 'Hello Mathew\r\n\r\nWe have talked before. I wish you still remember.\r\nI am interested in purchasing this store. I have signed already the non-disclosure agreement but do not mind to signed it again if this required. No information changed anyway.\r\nI can pay $80000 cash to the buyer if he is fine with owner\'s carry.\r\nPlease send me the tax return for the last three years\r\n\r\nRegards,\r\n\r\nBahaa', 'Big D Liquor Northglenn'),
(28, 'Flavia e Alessandro', '55-11-996140663', 'flahedro@hotmail.com', 'Small business', 'We are Brazilian, with also Italian citizenship, living in Brazil. \r\nWe intend to move to usa through E2 visa. So IWe were thinking about buying a small business. \r\nDo you have experience with this kind of transaction? Could you assist us?\r\n\r\nThank you,\r\n\r\nAlessandro e Flavia Cappucci', ''),
(29, 'hayden gharibyar', '7203820011', 'hgharibyar@gmail.com', 'Sale of Business Opportunity', 'Hi,\r\n\r\nIt was great talking to you today. I am interested in selling my thrift store located at 8411 Pecos St. in Federal Heights. \r\n\r\nPlease call me to discuss more detail about it. \r\n\r\nRegards,\r\n\r\nHayden ', ''),
(30, '', '', '', '', '', ''),
(31, '', '', '', '', '', ''),
(32, 'Norma Wiggins', '575-445-8756', 'lenwig@msn.com', 'Full-service liquor store for sale', 'My liquor store is a Colorado \"S\" corporation, established in 1991,  offering an established, local customer base in Spanish Peaks country in southeast Colorado.  I bought the business in 1997. I am currently looking for a realtor who specializes in liquor stores. I want to sell the business and real estate, separate from inventory. I would appreciate hearing from you. ', ''),
(33, '', '', '', '', '', ''),
(34, 'Dale Grimm', '937-284-2715', 'publisher@newcarlislenews.net', 'I\'m ready to sell my business', 'I own four weekly community newspapers - New Carlisle, Enon, Tipp City and Troy (suburban Dayton, Ohio).\r\n\r\nI started the business in November, 2008 in my basement with $150. Today, we have a thriving business with about 60 contract workers (writers, editors, carriers).    2014 sales were in excess of $300,000 - all generated by our only salesman - me.  We have earned respect in all of our communities.\r\n\r\nIn two months, I will be 66 years old and I am ready to kick back. I cannot keep up the pace I could in the past.\r\n\r\nI do not want a complicated sale - the buyer would pay an agreed price and I will give them the keys.\r\n\r\nFeel free to contact me at this e-mail address or by phone at 937-284-2715 (cell & text).\r\n\r\nContrary to what you may have heard, newspapers are not dead.  We have proven it. ', ''),
(35, 'Doug Page', '4178491541', 'swmo21@yahoo.com', 'Liquor Store', 'Hello, \r\n\r\nI\'d like to be contacted to get more information regarding this opportunity on 12051 N Pecos St.  Thank you. \r\n\r\n\r\nDoug ', ''),
(36, '', '', '', '', '', ''),
(37, '', '', '', '', '', ''),
(38, 'Shannon Benton', '303-752-0660', 'sbenton@trea.org', 'Disposal of Commerial Office Building', 'TREA:  The Enlisted Associationâ€™s Board of Directors is considering selling its headquarters building located at 1111 S. Abilene Court.  We are downsizing and do not currently need the size facility we currently occupy. We are seeking a realtor would will review the current Aurora Real Estate market in order for the organization to make a decision on disposing of the property.   We would like to find out:\r\n\r\n1.	What you feel the property could sell for.\r\n2.	Estimated time you feel it would be on the market?\r\n3.	Comps in the area.\r\n\r\nI look forward to hearing back from you and setting an appointment date and time to discuss the disposal of the property at 1111 S. Abilene Court, Aurora, CO.\r\n\r\nRegards,\r\nShannon G. Benton\r\nInterim Director for Operations\r\nTREA:  The Enlisted Association\r\n1111 S. Abilene Court\r\nAurora, CO 80012\r\n303-752-0660\r\nwww.TREA.org\r\n', ''),
(39, '', '', '', '', '', ''),
(40, 'Prajwal Rana  (PJ)', '720-277-2020 ', 'prajwalrana@gmail.com', 'Buy business', 'Matthew, It was a pleasure speaking to you today. Please send me the disclosure documents so I can review and get back to you. Please also let me know if you have any other listings for me to consider.\r\n\r\nSincerely, PJ Rana ', 'Gas Station / country Grocery Store'),
(41, '', '', '', '', '', ''),
(42, 'bb', '780-897-8976', 'meabraham14@yahoo.com', 'g', 'kjjfkda f', ''),
(43, 'Harry Smith', '210-902-2933', 'smitharry147@gmail.com', 'Hello', 'Hello,\r\nI am interested in buying this listing for sale.Is it the guide price or the actual price.\r\nKindly respond via email with details.\r\nRegards', 'Gas Station / country Grocery Store'),
(44, '', '', '', '', '', ''),
(45, '', '', '', '', '', ''),
(46, '', '', '', '', '', ''),
(47, '', '', '', '', '', ''),
(48, 'Percy starr', '7209987052', 'Percystarr@icloud.com', 'Requesting more information', 'Hi just wondering if this convenient store is still for sale', 'Convenient Grocery Store '),
(49, '', '', '', '', '', ''),
(50, '', '', '', '', '', ''),
(51, 'Tom King', '303-743-7304', 'gene15@yahoo.com', 'Business', 'Please call me', ''),
(52, 'Harry Smith', '210-902-2933', 'harrysmith2385@gmail.com', 'Hello', 'Hello,\r\nI am interested in buying this business for sale.Is it the guide price or the actual price.\r\nKindly respond via email with details.\r\nRegards', 'Very spacious Home'),
(53, '', '', '', '', '', ''),
(54, '', '', '', '', '', ''),
(55, '', '', '', '', '', ''),
(56, '', '', '', '', '', ''),
(57, '', '', '', '', '', ''),
(58, '', '', '', '', '', ''),
(59, '', '', '', '', '', ''),
(60, '', '', '', '', '', ''),
(61, 'David Raz', '13473541711', 'davidraz@affordable-app-design.com', 'Promoting Your Business', 'HI there.I was just checking out your website - and I was impressed! Have you ever though about creating a mobile application that will help you stand out from your competitors? Or maybe even just to help with the clients you currently have - offering special discounts, updates etc? My company,affordable-app-design.com, creates apps for smartphones - at budget rates! Are you interested in hearing more?   Please let me know if you would like to speak further.You can email me at davidraz@affordable-app-design.com for more information. Thanks.', ''),
(62, 'Alberto enriquez', '720 670 7116', 'albertoenriquez7@msn.com', 'Liquor store for sale', 'Hello this is Alberto Enriquez I am inquiring about liquor store for sale could you contact me at 720 670 7116.', 'E A Liquor'),
(63, '', '', '', '', '', ''),
(64, '', '', '', '', '', ''),
(65, '', '', '', '', '', ''),
(66, 'Donna Tomich', '7203538108', 'donnatomich@aol.com', 'Smoke shop ', 'Please send NDA to my email for the smoke shop.\r\nThank you', ''),
(67, 'Rachel Portner', '13473541711', 'rachelportner@explainyourpitch.com', 'Promoting Your Business', 'Hey!\r\nI was on your website, and I gotta say I was impressed.\r\nMy company - explainyourpitch.com\r\nhelps companies explain their pitch and value proposition in under 90 seconds - via amazing homepage explainer videos, investor pitches, viral videos, and how-to explanations.\r\nCheck out my site -\r\nwww.explainyourpitch.com\r\nor Email me at - \r\nrachelportner@explainyourpitch.com  \r\nHave a great day! Thanks, Rachel Portner', ''),
(68, 'Derek Welsch', '9199951300', 'djxwelsch@att.net', 'Nimbus Sloan\'s Lake -- financials?', 'I spoke with Matthew yesterday and am interested in this business, but I cannot really make an offer without looking at the past year\'s financial overview (ie, more detailed listing of Costs vs. Revenue, etc.).  Can you email this to me?\r\nThanks,\r\nDerek \r\n', ''),
(69, 'Derek Welsch', '9199951300', 'djxwelsch@att.net', 'Re: Nimbus Sloan\'s Lake -- financials?', 'To clarify, I tried clicking to get the brochure on the web site, but I get an error (.pdf not found), so I don\'t know if the info I need is in there or what.  \r\nThanks!!', ''),
(70, 'Harry Smith', '210-902-2933', 'harrysmith2385@gmail.com', 'Hello', '\r\nHello,\r\nI am interested,Is it the guide price or the actual price?Kindly get back to me via email.\r\nRegards', 'Parker store with low rent'),
(71, 'Derek Welsch', '9199951300', 'djxwelsch@att.net', 'Any new info?', 'Been speaking with Michael about this one.  Very interested, but not enough info available to make a decision (awaiting from seller).\r\n\r\nThanks,\r\nDerek', ''),
(72, '', '', '', '', '', ''),
(73, 'terryfearon', '5753186601', 'terryfearon78@yahoo.com', 'get investment', 'Hi are you feeling good today? My name is terry fearon i from hobb new mexico.i want to come to colorado and start a water bed hotel business like to know if you can help me.thank you and i wish you all great day. ', ''),
(74, '', '', '', '', '', ''),
(75, '', '', '', '', '', ''),
(76, '', '', '', '', '', ''),
(77, 'mukesh khatri', '17193219436', 'mukesh.khatri2@gmail.com', 'Hi', 'Can u send more information about this business..', ''),
(78, 'mukesh khatri', '17193219436', 'mukesh.khatri2@gmail.com', 'Hi', 'Can u send more information about this business..does owner carry out the some loan..', 'Parker store with low rent'),
(79, '', '', '', '', '', ''),
(80, '', '', '', '', '', ''),
(81, 'Sara Levi', '0000000000', 'Sara.levi23@outlook.com', 'Ready to use E-mail list', 'Hi,\r\n \r\nWe provide ready to use email lists of prospects. Would you be interested in acquiring ready to use email lists for your lead generation purpose? Please let me know your target audience and few free samples would be sent for your review.\r\n\r\nYour quick note will be greatly appreciated.\r\n\r\nRegards,\r\nSara\r\n', ''),
(82, 'James  Yary', '720-584-9446', 'chicago7@yahoo.com', 'Westminster  Liquor', 'Hello Mathew  ,I  see  your  listing  on  88th  ave.  ,  is  it  still  available ?      is  the  stores  name  Lake  Plaza  liquors?    Okay  Thanks  James', 'Westminster Liquor Store'),
(83, 'Vince menard', '3038686276', 'vince@menardscarpetcleaning.com', 'will you carry? how much down', 'Interested in your liquor store how much down in will you carry the lease', 'Arvada Liquor Store'),
(84, '', '', '', '', '', ''),
(85, '', '', '', '', '', ''),
(86, '', '', '', '', '', ''),
(87, '', '', '', '', '', ''),
(88, '', '', '', '', '', ''),
(89, 'Mark Pham', '', 'sooospam@gmail.com', 'Gas Station.  2801 N. Nevada Ave.', 'Hello,\r\n\r\nMy family and I are interested in the gas station.  When can we meet you there to take a look?  \r\n\r\nCan we speak with the owner also?', ''),
(90, '', '', '', '', '', ''),
(91, 'Chelsea', '', 'business.sale.co@gmail.com', 'Selling Businesss', 'Hello, \r\n\r\nI am in the process of selling my business. I have a few interested buyers already. I will only need help closing the deal. Can you give me a quote for this type of work?\r\n\r\nThanks\r\nChelsea', ''),
(92, '', '', '', '', '', ''),
(93, 'Nicholas Heeter', '216-509-4528', 'turtle.arcreative@gmail.com', 'More information on Smoke Shop', 'I am very interested in getting some more information on the smoke shop. Myself and my business partner will be travelling to Denver next week and would love to set up a time to check out the business in person and check out the current inventory. Let me know if you have an NDA for us to fill out before you can send me the businesses portfolio. I tried to download the brochure from the website and there was an error. Hope to hear from you soon.', ''),
(94, '', '', '', '', '', ''),
(95, '', '', '', '', '', ''),
(96, '', '', '', '', '', ''),
(97, '', '', '', '', '', ''),
(98, '', '', '', '', '', ''),
(99, '', '', '', '', '', ''),
(100, '', '', '', '', '', ''),
(101, '', '', '', '', '', ''),
(102, 'Justin Johnson', '921-146-9086', 'info@ranksindia.com', 'SEO Services @ $99 Per Month', 'HI Sir/Madam\r\n\r\nCan you outsource some SEO business to us? We will work according to you and your \r\nclients and for a long term relationship we can start our SEO services in only $99 per month per website.\r\n\r\nLooking forward for your positive reply \r\n\r\nThanks & Regards\r\nJustin Johnson\r\nContact :9211469086\r\n\r\nPS: Humble request we are not spammers. We take hours to research on sites and keywords to contact webmasters.\r\nIf by sending this email we have made an offense to you or to your organization then we extremely apologize for the same.\r\nIn order to stop receiving such emails from us in future please reply with Remove or Not Interested as subject line.\r\nMany thanks for having your kind look to our email.', ''),
(103, 'Justin Johnson', '921-146-9086', 'info@ranksindia.com', 'SEO Services @ $99 Per Month', 'HI Sir/Madam\r\n\r\nCan you outsource some SEO business to us? We will work according to you and your \r\nclients and for a long term relationship we can start our SEO services in only $99 per month per website.\r\n\r\nLooking forward for your positive reply \r\n\r\nThanks & Regards\r\nJustin Johnson\r\nContact :9211469086\r\n\r\nPS: Humble request we are not spammers. We take hours to research on sites and keywords to contact webmasters.\r\nIf by sending this email we have made an offense to you or to your organization then we extremely apologize for the same.\r\nIn order to stop receiving such emails from us in future please reply with Remove or Not Interested as subject line.\r\nMany thanks for having your kind look to our email.', ''),
(104, 'Amaia Arrazola', '921-146-9086', 'info@ranks.co.in', 'SEO Services $99 Per Month', 'HI Sir/Madam \r\n\r\nCan you outsource some SEO business to us? \r\nWe will work according to you and your clients and for a long term relationship\r\n we can start our SEO services in only $99 per month per website. \r\n\r\nLooking forward for your positive reply \r\n\r\nThanks & Regards \r\nAmaia Arrazola \r\nContact :9211469086 \r\n\r\nPS: Humble request we are not spammers. \r\nWe take hours to research on sites and keywords to contact webmasters. \r\nIf by sending this email \r\nwe have made an offense to you or to your organization \r\nthen we extremely apologize for the same. In order to stop receiving \r\nsuch emails from us in future please reply with \"Remove or Not Interested\" \r\nas subject line. Many thanks for having your kind look to our email.', ''),
(105, '', '', '', '', '', ''),
(106, 'Ron Tremblay', '207-576-2592', 'Paseos155@aol.com', '', 'We\'re looking for a business in the Denver area', ''),
(107, 'James', '720-275-7920', 'james@colinscapital.com', 'Interested in Buying a Biz', 'We are looking to purchase one or more businesses with 2 or more years of financials for under $5,000.00.\r\n\r\nThank you,\r\n\r\nJames Kaufman\r\n', ''),
(108, '', '', '', '', '', ''),
(109, 'MAMIKON GINOSYAN', '3033388986', 'mamikon3000@mail.ru', '', 'Dear Sir/Madam,\r\nFirst allow me to introduce myself.\r\nMy name is Mamikon Ginosyan, I live in Aurora, Colorado.\r\nI am private investor and busineesman,dealing with different assets internationally.\r\nI am interested to purchase operating business in the state of Colorado, up to 100 per cent. I am interested to purchase a business which does not require investor\'s active participation.\r\nI seek a business with a price between 1.5 and 3.5 million $.\r\nI have portfolio of stocks of US publicly traded company,the portfolio is managed by several financial institutions-wealth managers in Denver. I would like to use the stocks for payment  for business to he purchased or as collateral for fibancing of businesses\' purchase.\r\nMy question is: can you assist me in finding of businesses I seek and in obtaining financing for  the purchases?\r\nThank you in advance for reply.\r\nYou can send your answer to my e-mail address: mamikon3000@mail.ru .\r\n\r\nBest regards,\r\n\r\nMamikon\r\nMamikon Ginosyan\r\nAurora CO', ''),
(110, '', '', '', '', '', ''),
(111, '', '', '', '', '', ''),
(112, '', '', '', '', '', ''),
(113, 'Jasenko Alimanovixlc', '5157077190', 'asenkoja@gmail.com', 'Business apraisel ', 'Hi,\r\n\r\nYou guys do business appraisel for home based business, travel agency?\r\n\r\nThanks\r\n\r\nJasenko', ''),
(114, 'Jasenko Alimanovic', '5157077190', 'asenkoja@gmail.com', 'Business apraisel ', 'Hi,\r\n\r\nYou guys do business appraisel for home based business, travel agency?\r\n\r\nThanks\r\n\r\nJasenko', ''),
(115, '', '', '', '', '', ''),
(116, 'Tj Patton', '7194999164', 'Tj@pattonpros.com', 'Selling landscape and snow removal company ', '', ''),
(117, '', '', '', '', '', ''),
(118, '', '', '', '', '', ''),
(119, '', '', '', '', '', ''),
(120, 'Akansha Sharma', '09211469086', 'info@ranksindia.com', 'seo service $99 per month', '   Hi Sir/Madam\r\n\r\nCan you outsource some SEO business to us? \r\nWe will work according to you and your clients and \r\nfor a long term relationship we can start our \r\nSEO services in only $99 per month per website. \r\nLooking forward for your positive reply.\r\n\r\nThanks & Regards\r\nAkansha Sharma\r\n\r\nPS: Humble request we are not spammers. We take hours to \r\nresearch on sites and keywords to contact webmasters. \r\nIf by sending this email we have made an offense to you \r\nor to your organization then we extremely apologize for the same.\r\nIn order to stop receiving such emails from us in future \r\nplease reply with \"Remove or Not Interested\" as subject line.\r\nMany thanks for having your kind look to our email.', ''),
(121, 'Akansha Sharma', '09211469086', 'info@ranksindia.com', 'seo service $99 per month', '   Hi Sir/Madam\r\n\r\nCan you outsource some SEO business to us? \r\nWe will work according to you and your clients and \r\nfor a long term relationship we can start our \r\nSEO services in only $99 per month per website. \r\nLooking forward for your positive reply.\r\n\r\nThanks & Regards\r\nAkansha Sharma\r\n\r\nPS: Humble request we are not spammers. We take hours to \r\nresearch on sites and keywords to contact webmasters. \r\nIf by sending this email we have made an offense to you \r\nor to your organization then we extremely apologize for the same.\r\nIn order to stop receiving such emails from us in future \r\nplease reply with \"Remove or Not Interested\" as subject line.\r\nMany thanks for having your kind look to our email.', ''),
(122, '', '', '', '', '', ''),
(123, '', '', '', '', '', ''),
(124, '', '', '', '', '', ''),
(125, '', '', '', '', '', ''),
(126, '', '', '', '', '', ''),
(127, 'Jose C Cardo', '7866022329', 'JCCARDO29@GMAIL.COM', 'New business', 'To whom it may concern,\r\n\r\nMy name is Jose. My wife and I have been playing with the idea of owning and operating a business. I think the opportunity has come and we are in search of one. As you can see we are new on this endeavor and would appreciate some assistance in completing this matter. Can you help us ?\r\n\r\nJose C Cardo \r\n', ''),
(128, '', '', '', '', '', ''),
(129, '', '', '', '', '', ''),
(130, '', '', '', '', '', ''),
(131, '', '', '', '', '', ''),
(132, '', '', '', '', '', ''),
(133, '', '', '', '', '', ''),
(134, 'Domain Sale', '(480) 366-3343', 'no-email@no-email.com', 'BUSINESSBROKERSDENVER.COM', 'We own this domain and have it for sale on GoDaddy if you are interested:  \r\n\r\nBUSINESSBROKERSDENVER.COM - https://www.godaddy.com/domains/searchresults.aspx?checkAvail=1&tmskey=&domainToCheck=BUSINESSBROKERSDENVER.COM\r\n', ''),
(135, '', '', '', '', '', ''),
(136, '', '', '', '', '', ''),
(137, '', '', '', '', '', ''),
(138, '', '', '', '', '', ''),
(139, '', '', '', '', '', ''),
(140, '', '', '', '', '', ''),
(141, '', '', '', '', '', ''),
(142, 'joseph martucci', '7208629625', 'jmartucc@us.ibm.com', 'Possible sale of our business', 'Hello,\r\n\r\nThinking of selling our commercial construction (painting) company.  It has been around 20+ years, we have owned for 10+.  ~1m in sales last year, and we have ~1m booked already for 2017.\r\nPlease call my cell or email the address above.\r\n\r\nRegards,\r\n\r\nJoseph (Tony) Martucci', ''),
(143, '', '', '', '', '', ''),
(144, '', '', '', '', '', ''),
(145, '', '', '', '', '', ''),
(146, '', '', '', '', '', ''),
(147, '', '', '', '', '', ''),
(148, '', '', '', '', '', ''),
(149, 'Joseph Schieffer', '7204097605', 'joeschief@gmail.com', 'Looking to buy independent barbershop', 'Hello,\r\nI would like to buy an independent barbershop in the Denver metro area.  Would you firm be able to assist me with this?\r\n\r\nThanks,\r\nJoseph', ''),
(150, '', '', '', '', '', ''),
(151, '', '', '', '', '', ''),
(152, 'Max Williams', '7077060205', 'seo1@googlepositions.com', 'Top Ranking On Google', 'Hello and Good Day\r\n\r\nI am Max Alias jitesh, Marketing Manager with a reputable online marketing company based in India.\r\n\r\nWe can fairly quickly promote your website to the top of the search rankings with no long term contracts!\r\n\r\nWe can place your website on top of the Natural Listings on Google, Yahoo and MSN. Our Search Engine Optimization team delivers more top rankings than anyone else and we can prove it. We do not use \"link farms\" or \"black hat\" methods that Google and the other search engines frown upon and can use to de-list or ban your site. The techniques are proprietary, involving some valuable closely held trade secrets. Our prices are less than half of what other companies charge.\r\n\r\nWe would be happy to send you a proposal using the top search phrases for your area of expertise. Please contact me at your convenience so we can start saving you some money.\r\n\r\nIn order for us to respond to your request for information, please include your companyâ€™s website address (mandatory) and or phone number.\r\n\r\nSo let me know if you would like me to mail you more details or schedule a call. We\'ll be pleased to serve you.\r\nI look forward to your mail.\r\n\r\nThanks and Regards\r\nMax Alias Jitesh', ''),
(153, 'Laura Smith', '(970) 215-5132', 'loveindiee@gmail.com', 'Do you service Fort Collins? ', 'I have a business I am interested in selling in Fort Collins. Email is best for now. Thanks! \r\n\r\nLaura ', ''),
(154, 'Gary Googins', '7202899379', 'googinsg@yahoo.com', 'Interested in Selling My Business', 'Business for sale:\r\nBloomfield Florist\r\n7338 Washington St\r\nDenver, CO 80229\r\n\r\nI\'m interested in finding out what your commission rates look like and what services are provided.', ''),
(155, 'mark brohl', '7204011512', 'brohlmark@gmail.com', 'We buy seller financed business notes', 'Dear Professionals:\r\nThe purpose of this message is to introduce my company, Mark Brohl/Private Note Broker,  to you.  We are in the business of purchasing Privately-Held Business Notes as well as Owner Financed Mortgage Notes.  We provide a lump sum of CASH NOW for the rights to receive future payments from these types of notes.\r\n\r\nAs you know, at least 70% of all businesses are sold with some form of seller financing.  Our program allows these note holders to cash out their note or sell a predetermined portion of their payments as opposed to liquidating their entire note.  This allows these individuals the opportunity to perhaps purchase another business through you.\r\n\r\nWe have found that many times a business will not sell because it is difficult for potential buyers to obtain financing and at the same time a business owner will not finance because he wants all of his cash up front.  \r\n\r\nOur program allows you to do more business by providing the owner the option of selling their note, or a portion of their note within one to six months of the deal being finalized. This will result in more commissions for you.\r\n\r\nAs is the custom with all good business people, we are more than willing to offer you a referral fee for each business note that you refer to us.\r\n\r\nPlease call me in order to discuss how we can form a mutually beneficial relationship.  I look forward to hearing from you soon.\r\n\r\nSincerely,\r\n-- \r\nMark Brohl/Private Note Broker\r\n720-401-1512\r\nbrohlmark@gmail.com\r\n\r\nP.S.  If you do not know of any clients who hold notes at the present time then please file this message under â€œCASH FOR NOTESâ€ and contact me when you do.\r\n\r\n', ''),
(156, 'chris root', '6192515838', 'chris@eboostconsulting.com', 'Selling Marketing Agency', 'I\'m interested in potentially selling a marketing agency I own. Very early in the process and just looking for basic info and a rough valuation.', ''),
(157, '', '', '', '', '', ''),
(158, '', '', '', '', '', ''),
(159, '', '', '', '', '', ''),
(160, '', '', '', '', '', ''),
(161, 'mark brohl', '7204011512', 'brohlmark@gmail.com', 'We buy seller financed business notes', 'Dear Professionals:\r\nI wanted to introduce my company, Mark Brohl/Private Note Broker,  to you.  We are in the business of purchasing Privately-Held Business Notes as well as Owner Financed Mortgage Notes.  We provide a lump sum of CASH NOW for the rights to receive future payments from these types of notes.\r\n\r\nAs you know, at least 70% of all businesses are sold with some form of seller financing.  Our program allows these note holders to cash out their note or sell a predetermined portion of their payments as opposed to liquidating their entire note.  This allows these individuals the opportunity to perhaps purchase another business through you.\r\n\r\nWe have found that many times a business will not sell because it is difficult for potential buyers to obtain financing and at the same time a business owner will not finance because he wants all of his cash up front.  \r\n\r\nOur program allows you to do more business by providing the owner the option of selling their note, or a portion of their note within one to six months of the deal being finalized. This will result in more commissions for you.\r\n\r\nAs is the custom with all good business people, we are more than willing to offer you a referral fee for each business note that you refer to us.\r\n\r\nPlease call me in order to discuss how we can form a mutually beneficial relationship.  I look forward to hearing from you soon.\r\n\r\nSincerely,\r\n-- \r\nMark Brohl/Private Note Broker\r\n720-401-1512\r\nbrohlmark@gmail.com\r\n\r\nP.S.  If you do not know of any clients who hold notes at the present time then please file this message under â€œCASH FOR NOTESâ€ and contact me when you do.\r\n\r\n', ''),
(162, '', '', '', '', '', ''),
(163, '', '', '', '', '', ''),
(164, '', '', '', '', '', ''),
(165, '', '', '', '', '', ''),
(166, '', '', '', '', '', ''),
(167, '', '', '', '', '', ''),
(168, '', '', '', '', '', ''),
(169, '', '', '', '', '', ''),
(170, '', '', '', '', '', ''),
(171, '', '', '', '', '', ''),
(172, 'Jim Eggers', '4025985565', 'jeggers@millardroofing.net', 'Denver Roofing Business', 'Dear Mr. Abraham,\r\n\r\nI am a business owner in Omaha Ne.  I am looking to purchase a reputable roofing business in the Denver area.  Size is not the most important attribute that I am looking for.  I am looking for a company with a good reputation and a clean bill of health.  I will be traveling next week to Denver to explore the area and look for businesses for sale.\r\n\r\nJim Eggers\r\n\r\n4025985565', ''),
(173, '', '', '', '', '', ''),
(174, '', '', '', '', '', ''),
(175, '', '', '', '', '', ''),
(176, 'Shantel Marsh', '7203134015', 'shanty2483@gmail.com', 'Interest in buying a small business ', 'I would like to purchase an existing small business and would like some guidance on how it can be done.\r\n\r\nThank you,', ''),
(177, '', '', '', '', '', ''),
(178, '', '', '', '', '', ''),
(179, '', '', '', '', '', ''),
(180, '', '', '', '', '', ''),
(181, '', '', '', '', '', ''),
(182, '', '', '', '', '', ''),
(183, 'David Frankel', '4259239011', 'dfcoug@yahoo.com', 'Looking to buy a business', 'Selling a rental investment in the next few months and looking to reinvest the profit in a owner/operator type of business. Specifically looking in Douglas County, Castle Rock, Parker, Lone Tree area.\r\n\r\nThank you,\r\n\r\nDavid', ''),
(184, '', '', '', '', '', ''),
(185, '', '', '', '', '', ''),
(186, 'Omar Khairzada', '(805) 302-1038', 'okhairzada@cbank.com', 'sba deals', 'Hello ,\r\nI have recently been approved to do deals in the western states and we at community bank specialize in business acquisitions \r\n\r\nwe pay referral fees and I would love an opportunity to chat about how we can work together \r\n\r\nmy best \r\nOmar Khairzada \r\n805-302-1038', ''),
(187, 'Natalia', 'Tel > +1 424.322.2442', 'secretary@escapetocostarica.today', 'Iâ€™m only Emailing you one time..', 'Hey There,\r\n\r\nAfter finding your Realtor Site Online, I thought to myself it would be an ideal time to get in contact with you.\r\n\r\nOur Company is looking for 10 Property Specialists with their own established database of satisfied clients who want to join us in in Costa Ricaâ€™s Largest Ocean View Development within 750 acres of National Park.\r\n\r\nTo say that this is a big opportunity is an understatement! We are looking to cultivate Long Term Relationships with only a few Realtors who not only get the long term benefit from the long term play every single month receiving income from our project, but also, If you decide to become a part of our community you might want to recommend existing clients into the development too, So we have organized a Realtors Referral Plan.\r\n \r\nWe would love you to partner with us. It would benefit you and our development at the same time.\r\n\r\nAfter a number of years searching we finally found the best located land with the best ocean views in Costa Rica. What we didnâ€™t quite count on was how much the beauty, nature and environment would change our lives from the fast paced life and cold climate we had had before.\r\n\r\nWaking up to the sound of many different bird species including Scarlet Macaws and Toucans Flying by, the Awe Inspiring Sunsets at Night is something many only dream about and we are really lucky to experience this daily and hopefully a few select individuals can join us in appreciating it with us.\r\n\r\nAbout our Ocean View Development.\r\n\r\nAt this moment in time we have 14 Phases of Development across 750 Acres of the only Private Rainforest Land in the Most Beautiful National Park. With 250 already cut lots with spectacular panoramic ocean views.\r\n\r\nOur Project Construction is starting this month on 2 initial Ocean View Villas, The First is already completely Funded and the second too being built at construction cost will soon be closed out... It is a great entry level opportunity into much larger projects.\r\n\r\nSimply Enter your Details into the following simple form to start the conversation\r\n\r\nEnter your Details Here > http://oceanview.escapetocostarica.info/ \r\n\r\nRegards\r\n\r\n(Director of Business Development)', ''),
(188, 'Abrahm Smith', '3057898972', 'abrahmsmith@yahoo.com', 'Fantastic Sams', 'Please send me more information on the Fantastic Sams.', ''),
(189, '', '', '', '', '', ''),
(190, '', '', '', '', '', ''),
(191, '', '', '', '', '', ''),
(192, '', '', '', '', '', ''),
(193, '', '', '', '', '', ''),
(194, '', '', '', '', '', ''),
(195, '', '', '', '', '', ''),
(196, '', '', '', '', '', ''),
(197, '', '', '', '', '', ''),
(198, 'John Lewis', '248-703-4940', 'john.cannaday.lewis@gmail.com', 'Business Opportunities', 'Hello,\r\n\r\nI am currently exploring opportunities for investment and would like to speak with about current businesses available. I am interested in the MJ industry but am also open to other opportunities.\r\n\r\nBest,\r\n\r\nJohn Lewis\r\n248.703.4940', ''),
(199, '', '', '', '', '', ''),
(200, 'Theresa Bullock', '3038172587', 'treellock@aol.com', 'Selling small Salon in Boulder', 'Looking to sell a small salon studio in Boulder. We have done some financial workup\'s already.  We are looking for realistic evaluation of business as well as what is realistic for the market and appropriate timeline expectations. ', ''),
(201, 'Donald Burmania', '3038860073', 'dburmania@hotmail.com', 'Business Inquiry', 'I am interested in finding out more about the two Fantastic Sam\'s franchises in Aurora.', 'Fantastic Sam Franchise in Aurora'),
(202, '', '', '', '', '', ''),
(203, '', '', '', '', '', ''),
(204, 'Daniel Feldman', '7206161944', 'danielfeldman369@gmail.com', 'Finding a location', 'I am looking for a location for our doggy day care business.  3000 square feet would be preferable.\r\n', ''),
(205, '', '', '', '', '', ''),
(206, '', '', '', '', '', ''),
(207, 'Daniel Feldman', '7206161944', 'danielfeldman369@gmail.com', 'Finding a location', 'I am looking for a 3000 square foot for my doggy day care business.', ''),
(208, '', '', '', '', '', ''),
(209, 'Scott', '303-668-3350', 'ssyn44@gmail.com', 'Looking to Sell Hair Salon In Aurora', 'Please call', ''),
(210, 'Bill Burtt', '303-249-7440', 'bburtt1@comcast.net', 'Exploring Brokers', 'Interested in selling gas station/convenience store in a leased facility (Fox Point Commons).  Believe Mathew left his card with me a year or two back.  Would like to discuss specifics of listing contract details etc.  I may be reached via e-mail or phone but only in the PM on phone.', ''),
(211, 'Tischer', '0977554433', 'sales@yoorhosting.com', 'What if your website could load faster with YOORshop...', 'Hello,\r\n\r\nAfter visiting your website to check its loading speed, we\'ve thought you could be interested in our top notch hosting services...\r\n \r\nDue to high competition these days, it is crucial that your website loads as fast as possible for your online success : more sales and better ranking in search engine results...\r\n\r\nYou can read the full the proposal via your web browser through this link :\r\nhttps://www.yoorshop.fr/index.php?rp=/announcements/1059/What-if-your-website-could-load-faster-with-YOORshop.html\r\n\r\nIf you have any questions, please use our contact form on our website :\r\nhttps://www.yoorshop.fr/contact.php\r\n\r\nThank you for your attention,\r\nYours faithfully,\r\nDaniel - Customer service YOORshop\r\nYOORshop SAS - RCS Lyon 817466147\r\n52 route du clos, 69700 Montagny - France\r\n\r\nNB : this message is a one time commercial proposal, this a NOT a subscription to any mailing list, you will not be contacted again', ''),
(212, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(213, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(214, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(215, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(216, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(217, 'Olivia Hunt', '9834567536', 'olivia968hunt@gmail.com', 'Â Increase Google Visibility', 'Hello,  My name is Olivia Hunt . I am a Digital Marketing Specialists for a Creative Agency. I was doing some industry benchmarking for a client of mine when I came across your website. I noticed a few technical errors which correspond with a drop of website traffic over the last 6-8 months which I thought I would bring to your attention. After closer inspection it appears your site is lacking in 4 key criteria. 1- Website Speed . 2- Link Diversity . 3- Domain Authority . 4- Competition Comparison . I can send you over the report which shows all of the above and so much more which will help you at least improve your site, its rankings and traffic. I would love the chance to help as well however; this report will at least give you a gauge on the quality of what I do.  If you are interested then please share your requirement and contact details. Is this the best email to send it to? Regards- Olivia Hunt ', ''),
(218, '', '', '', '', '', ''),
(219, '', '', '', '', '', ''),
(220, '', '', '', '', '', ''),
(221, '', '', '', '', '', ''),
(222, '', '', '', '', '', ''),
(223, 'susan obryan', '303.238.2641', 'jkliquorsco@yahoo.com', 'business valuation', '\r\nI am maybe interested in selling and would like to see what you estimate my store to be worth.   I work Wednesday thru Sunday 10am to 6pm  and would be happy to meet with you at any time.', ''),
(224, '', '', '', '', '', ''),
(225, '', '', '', '', '', ''),
(226, 'Jason Martinson', '7203019729', 'j3936867@gmail.com', 'Potential Business Sale - Karmaceuticals', 'We are interested in how the process works with your, what the terms of the agreement would be & how your firm charges for the brokerage service. Thank you', ''),
(227, '', '', '', '', '', '');
INSERT INTO `queries` (`id`, `name`, `phone`, `email`, `subject`, `message`, `title`) VALUES
(228, 'Gary Joseph', '9497938782', 'gary@biogeniccorp.com', 'Seeking collaboration & ideas including helping us sell our Non-franchise, Franchise like Business O', 'Dear Matthew,\r\n\r\nThe following offer includes the Physicianâ€™s brick and mortar Office and all of the patients for testing based on Medical Necessity.  This is the safest, most lucrative Medical Play on the planet! \r\n\r\nWe have the only on this planet earth non-invasive carry-on-size under 15 minute assessment test that is preventative in nature and saves lives that Medicare and private Insurance is paying over $500.00 per test!  \r\n \r\nThe BioGenic System is a Non-Invasive under 15 minute fully integrated and comprehensive system designed to detect all types of issues resulting from nervous system and cardiovascular abnormalities.   To uncover hidden diseases. \r\n \r\nThe device is FDA approved and performs a myriad of tests (outlined in the aforementioned material) designed to identify numerous risk factors such as: Silent Heart Attack, Hypertension, Cardiac Autonomic Neuropathy, Diabetic Neuropathy, Vascular Abnormalities, and others.  It has been designated as a Standard of Care by such prestigious organizations as The American Diabetes Association and The American Heart Association. \r\n \r\nWe estimate that 70% of those 70 or older are eligible for an annual test and 45% of those 45 or older with any cardiovascular risk factors.  This represents over 40 million individuals.  For those with diabetes the recommendation is generally two tests per year, and unfortunately as you may know diabetes is the fastest growing chronic care condition in the United States.  According to the CDC there are 29.1 million diabetics in the United States (1 out of 11) and another 86 million pre-diabetics, an astounding 1 out of 3!  Per the American Journal of Cardiology, â€œAs many as 90,000 American lives could be saved each year if all men ages 45-75 and women 55-75 received cardiovascular wellness testingâ€  \r\n \r\nWe have elected to pursue two different sales channels: i) Direct Sales to Physicians, and ii) Sales to Owner/Operators who place a unit in a physicianâ€™s office and enter a Fee for Service Agreement with the doctor.  The cost of the unit is $150,000. Itâ€™s state-of the-art diagnostics and design, its small footprint, and ability to be integrated with other revenue generating tests (i.e. Annual Wellness Visits) make it the Gold Standard in this sector.\r\n \r\nThe investor model is unique and it has been successful for a number of Owner/Operators.  Usually in these situations the Owner/Operator will purchase a unit for $150,000 and we will identify a physician who would like to offer these tests to their patient base in-house. Our Location Assistance Program will do so for you at no charge.  The device does not take up a lot of space, nor is it difficult to perform the tests.  Depending upon regional reimbursement rates, each test is reimbursed at between $500-$515 by Medicare and private pay is about 11% higher.  These Fee for Service Agreements provide for a fee of-$250 per test to the Owner/Operator.  Depending upon the physicianâ€™s patient base and mix, 7-8 tests per day is a good approximation.  Obviously, these numbers add up to an outstanding return over time.  The physician also generates a new revenue stream for himself, and this is before any additional testing from the Clinical Triggers and/or follow-up visit revenue based on the results of the tests.  \r\n \r\nWe may remotely audit the number of tests that are performed, and may disable the unit if the doctors are not remitting the required payments.  This valuable service helps you to monitor the status of your device each month to ensure your returns and is provided to you at no additional cost. We also offer competitive financing programs if you so desire. WE offer in-house financing with half down 0% for 48 Months or $1,562.50 per month.\r\n \r\nFor more information, I invite you to visit our web site at www.biogeniccorp.com   Please contact me after digesting the informationâ€¦or please forward to a great candidate and earn a significant Finderâ€™s Fee.  $25,000.00  Agreement attached\r\n\r\nBest Regards,\r\n\r\nGary Joseph\r\nNational Sales Manager\r\nBioGenic Corp\r\n303 Broadway Suite #104\r\nLaguna Beach, CA 92651\r\n949-793-8782 DIRECT CELL\r\n(800) 674-3161 TOLL FREE\r\n(800) 674-3161 FAX\r\nwww.biogeniccorp.com\r\n \r\nTodayâ€™s The Day!\r\n\r\n\r\nExecutive Summary/Business Plan\r\nBiogenic Corp (â€œBiogenicâ€) provides Diagnostic Partners with a unique turnkey opportunity to participate in the $3.4 trillion U.S. healthcare sector, without requiring any previous healthcare experience.   Becoming a Biogenic Diagnostic Partner means owning a medical diagnostic device that provides physicians with the opportunity to acquire the use of a diagnostic device that can grow their practice revenue, identify health risk factors for their patients at an early stage, and manage the growing migration of the reimbursement system to value/risk based delivery.\r\nWe provide the device, identify a physician location, and even provide monthly servicing if the Diagnostic Partner so desires for a very modest fee.  We will negotiate the Fee-for-Service (â€œFFSâ€) Agreement between the Diagnostic Partner and the physician, train the physician and his staff on its use, and mediate any issues which may arise with the physician.\r\nEach time the physician runs a test you are owed a fee pursuant to the FFS Agreement, averaging $250.00.  These units can be used up to 7xâ€™s per day in some locations.   At a sub-optimal utilization rate of 3 tests per day, breakeven on a unit purchase price of $150,000 is under 12 months.\r\nThe cost of healthcare has risen dramatically during the past several decades, it is anticipated to consume 19% of domestic GDP in several years.  The opportunities presented by becoming an Diagnostic Partner under the BIOGENIC model enables individuals to participate directly in this expanding industry.\r\n\r\n \r\n\r\n\r\n\r\nDescription of Business\r\nBiogenic provides prospective Diagnostic Partners with a unique opportunity to own and operate their own business by participating in the $3.4 trillion U.S. healthcare sector, representing approximately 19% of Gross Domestic Product.  By providing Diagnostic Partners with a turnkey business that is positioned to take advantage of macro factors driving the healthcare industry, each Diagnostic Partner can experience significant cash-on-cash returns.  \r\nBiogenic provides the equipment, the location assistance, the training for the physician and her staff, and ongoing servicing if the Diagnostic Partner elects.  We can identify attractive physician locations and arrange for fee-for-service agreements which will provide the Diagnostic Partner with positive monthly income and cash flow in as few as two months from installation.  Depending upon circumstances we may also be able to assist with financing alternatives.  \r\nEach month you (or us) will bill the physician for the number of tests which are performed by your equipment (usually $250 per test).  We will be able to tell you independently (without compromising ANY PHI) the number of such tests which were performed.  If the unit needs to be moved, we will (on a best effort basis) assist you in identifying another such location and negotiating another fee-for-service agreement.\r\nCompany Ownership/Legal Entity\r\nYou do not have to be licensed as a physician or have a company in the medical field to take advantage of this opportunity.  You may elect to maintain your ownership as a personal asset, or to establish an LLC to maintain ownership, or hold it thru an existing corporate entity which does NOT need to be involved in the healthcare sector in any way.\r\nLocation\r\nOur Location Assistance Program will work with you to obtain a suitable location with a physician who has elected to participate in our program.  We work with our network of referral partners and other outside marketing reps to identify a location which will optimize the utilization rate of your unit.  Many factors are considered in identifying an appropriate location for your unit, including: \r\nâ€¢	Geographic Location.  Some Diagnostic Partners have a preference to have the unit close to their place of residence; however, that is certainly not necessary if you elect to have remote monitoring.\r\nâ€¢	Size of Practice.  The practice should see at least 50-60 patients per day.\r\nâ€¢	Specialty.  Our experience has shown that certain specialties are best able to maximize your unitâ€™s utilization rate, including:\r\no	Cardiologists\r\no	Pulmonologists\r\no	Endocrinologists\r\no	Pain Medicine\r\no	General Practitioners/Family Medicine\r\n\r\nâ€¢	Patient Mix\r\no	Average New Patients\r\no	Average Number of Patients\r\no	Number of Diabetic Patients\r\no	Number of Medicare Patients\r\nProducts and Services\r\nThe following sets forth a description of the Biogenic Equipment:\r\nâ€¢	The Biogenic device is a microprocessor based, monitor biomedical system which identifies, classifies, and collects signals from the human body. The analog signals are converted into digital data points and transferred to the computer via isolated USB connections. \r\nâ€¢	This isolation separates the human body from the main power system to ensure patient safety. \r\nâ€¢	The patient data that is collected from the unit is used to perform the assessments from HRV, Blood Flow, Overall Health Risk, and several assessments of the ANS. \r\nâ€¢	All materials used have gone through the same identical performance testing as the legally marketed predicate device and is marketed under the FDA (510k). \r\nâ€¢	All devices are identical in all areas of design, materials used, software, function, and application to ensure the highest quality and most accurate performance. \r\nâ€¢	The Biogenic has met the requirements for the QRS Detection and Heart Rate Variability and Algorithm Verification (ANSI/AAMI EC57:2012). The equipment has the General Requirements for Safety and Collateral Standard Safety Requirements for Medical Electronic Systems (IEC 60601-1 (1998) with Am. 1 (1991), Am 2 (1995) and complies with the Electromagnetic Compatibility Test (UL 60601-1 (2003). \r\nThe Biogenic device is intended for non-invasive measurements of pulse waveforms by photoelectric plethysmography and heart rate electrocardiographs. The system is intended for use on patients in medical clinics, healthcare practices and in out-patient departments within hospitals. \r\nThe unit is used to detect the following health risks and performs the following tests:\r\nHealth Risks:\r\nâ€¢	Sudden Death \r\nâ€¢	Silent Heart Attack \r\nâ€¢	Syncope \r\nâ€¢	Hypertension \r\nâ€¢	Cardiac Autonomic Neuropathy (CAN) \r\nâ€¢	Diabetic Autonomic Neuropathy (DAN) \r\nâ€¢	Vascular Abnormalities \r\nâ€¢	Orthostatic Hypotension \r\nâ€¢	Small Fiber Neuropathy When Nerve Conduction Test Results Are Normal \r\nâ€¢	Complex Pain Disorders \r\nâ€¢	Diabetic Neuropathies \r\nâ€¢	Enzyme Disorders \r\nâ€¢	RSD (Reflex Sympathetic Dystrophy, Complex Regional Pain Syndrome) \r\nâ€¢	Dysautonomia \r\nâ€¢	Multiple System Atrophy (Shy-Drager Syndrome) \r\nTests Performed\r\n\r\nâ€¢	Arterial Vascular Assessment \r\nâ€¢	Ankle-Brachial Index (ABI) \r\nâ€¢	Comprehensive Autonomic Balance Analysis (VS) \r\nâ€¢	Cardiovascular Fitness \r\nâ€¢	Galvanic Skin Response (GSR)\r\nâ€¢	Cumulative Mental and Physical Stress \r\nServices\r\nIn addition to providing the equipment and training to the physician and his staff in the use and billing of the equipment, each unit comes equipped with a three-year warranty.  Remote software updates are the most common servicing required.  Thru normal use, each unit has an estimated useful life of seven to ten years.\r\nBiogenic can provide the Diagnostic Partner with additional services and support for a small monthly fee of $225.  The standard Servicing Agreement provides the following:\r\ni.	Establishing a separate checking account into which the unit(s) revenues shall be deposited each month, copies of which shall be provided to the Diagnostic Partner;\r\nii.	Tracking the number of tests performed each month;\r\niii.	Billing the medical facility for the appropriate number of tests;\r\niv.	Collecting the amount due by the medical facility under the FFS Agreement;\r\nv.	Disabling the unit for failure to pay timely, subject to agreed-upon cure periods\r\nvi.	If necessary, and on a best efforts basis, identifying new unit locations\r\nvii.	Preparing a monthly Servicer Report setting forth data points such as:\r\na.	Billings\r\nb.	Number of tests\r\nc.	Collections\r\nd.	Account reconciliations\r\n\r\nAll the above activities (excepting v.) can be performed by the Diagnostic Partner at their discretion, Biogenic provides this option for those who want â€œpure passiveâ€ income.\r\n\r\n\r\nManagement\r\nBiogenic strives to provide each Diagnostic Partner with a turnkey business opportunity.  By providing the Diagnostic Partner with high quality diagnostic equipment, a suitable location, and the option for ongoing Servicing Support the Diagnostic Partner can be as involved as she wants.  If you so desire, we can provide you with the monthly utilization rate, and you can handle the billing and collections for each of your units.  If necessary, we can disable the unit if it becomes necessary due to non-payment from the physician.  In short, becoming an Diagnostic Partner does not require any high-level management, quantitative, or accounting skills, and it certainly does not require any particular expertise in healthcare, other than the ability to recognize the opportunity presented by becoming a Biogenic Diagnostic Partner.\r\nStart-Up/Acquisition Summary\r\nOnce the Diagnostic Partner has determined to proceed, we will provide them with an invoice and ask them to sign a Purchase Order.  When the Diagnostic Partner puts one-third down we will begin to fulfill the order and, if necessary, begin the process of identifying an appropriate location.  Once such location has been identified and the Fee-for-Service Agreement executed we will deliver the Unit to the physician location and train the physician and his staff.  This process should take three to five weeks.\r\nOnce the physician begins to perform the tests and depending upon his billing practices, unit reimbursement begins generally two to four weeks after billing, varying by the Payor.  Commercial Payors usually take the longest.  Consequently, we recommend providing the physician with net 30 payment terms and so your first reimbursements should begin 60 days following unit installation.  \r\nâ€ƒ\r\nMarketing\r\nThere are no ongoing marketing requirements for this opportunity.  Once the unit is placed in a carefully selected location, the physician is highly incented to utilize the diagnostic capabilities to identify hidden health risks in his patients.  This unit and the reimbursement for the tests which it conducts is a rare win/win/win for the patient, the physician, and the third-party payers who want to avoid costly hospital admissions and late stage interventions.  Biogenic handles your marketing effort up-front by helping you to identify and contract with a physician who desires to utilize the Biogenic device to diagnose and treat his patients.  The diagnostics performed by the unit help the physician identify potential health risks at an early stage and help avoid potentially life-threatening risks.\r\nThe unit also helps to keep the physicianâ€™s practice healthy.  Third-party payors recognize the value of these tests and the reimbursement rates provide sufficient returns for the Diagnostic Partner and the physician.  For many practices, a $150,000 diagnostic device represents a very significant investment.  Our Diagnostic Partner program recognizes this and enables the physician to obtain such a valuable diagnostic tool at no up-front cost other than the training time required (a half day).\r\nMarket Analysis\r\nQuality and performance improvement initiatives are driving significant changes in the domestic healthcare system. In anticipation of the full implementation of national health reform over the next several years (in whatever form it takes), the pace of these changes has been increasing. The goals of these quality initiatives mirror the National Quality Strategy\'s three aims, which include Better Care, Healthy People/Healthy Communities, and Affordable Care.  \r\nAs physicians move into the evolving reimbursement landscape of value and risk-based delivery, they will need to focus more on preventative care.  Quantifying this value is critical to the success of any such program.  The Biogenic program is designed to assist physicians to successfully adapt to this changing regulatory and reimbursement landscape.\r\nAccording to the Deloitte 2015 Health Care Providers Outlook, increasing pressure to contain health care costs and demonstrate value is coming from all sides:\r\nâ€¢	Medicare fee-for-service (FFS) payments may be replaced. the U.S. will see much more emphasis on pay for quality and alternative payment methods.\r\nâ€¢	Even without Medicare reform, physicians will likely see more patients because of an aging population and greater access of the newly insured. And increasing numbers of patients will likely be covered through managed care plans, which are emphasizing narrow networks and more value-based payment approaches.\r\nâ€¢	Advances in diagnostics and therapeutics continue to help drive costs higher. Unraveling the human genome, targeted therapies and new medical devices are exciting but also costly. How to prioritize and pay for these advances is an ongoing challenge.\r\nâ€¢	Patient coverage is changing. More patients will likely have coverage from Medicaid and Medicare (which typically pays less than commercial payors) and through exchanges\r\nOther macro demographic factors will impact demand for the tests which the unit performs, most notably the rise in cardiovascular disease and diabetes.  \r\nAccording to the American Diabetes Association:\r\nâ€¢	Prevalence: In 2015, 30.3 million Americans, or 9.4% of the population, had diabetes.\r\nâ€¢	Undiagnosed: Of the 30.3 million adults with diabetes, 23.1 million were diagnosed, and 7.2 million were undiagnosed.\r\nâ€¢	Prevalence in Seniors: The percentage of Americans age 65 and older remains high, at 25.2%, or 12.0 million seniors (diagnosed and undiagnosed).\r\nâ€¢	New Cases: 1.5 million Americans are diagnosed with diabetes every year.\r\nâ€¢	Prediabetes: In 2015, 84.1 million Americans age 18 and older had prediabetes.\r\nâ€¢	Deaths: Diabetes remains the 7th leading cause of death in the United States in 2015, with 79,535 death certificates listing it as the underlying cause of death, and a total of 252,806 death certificates listing diabetes as an underlying or contributing cause of death.\r\nAccording to the American Heart Association:\r\nâ€¢	Cardiovascular disease, listed as the underlying cause of death, accounts for nearly 801,000 deaths in the US. Thatâ€™s about 1 of every 3 deaths in the US.\r\nâ€¢	About 2,200 Americans die of cardiovascular disease each day, an average of 1 death every 40 seconds. \r\nâ€¢	Cardiovascular diseases claim more lives each year than all forms of cancer and Chronic Lower Respiratory Disease combined. \r\nâ€¢	About 92.1 million American adult s are living with some form of cardiovascular disease or the after-effects of stroke. Direct and indirect costs of cardiovascular diseases and stroke are estimated to total more than $316 billion; that includes both health expenditures and lost productivity. \r\nTo manage these epidemics, early intervention is crucial.  The non-invasive tests which the Biogenic unit can perform are a valuable tool for physicians to identify and treat these health risks and save lives. \r\nâ€ƒ\r\nMarket Segmentation\r\nAs we previously stated, the following specialties provide the Diagnostic Partner with the opportunity for the highest utilization rate:\r\nâ€¢	Cardiologists\r\nâ€¢	Pulmonologists\r\nâ€¢	Endocrinologists\r\nâ€¢	Pain Medicine\r\nâ€¢	General Practitioners/Family Medicine\r\nWe believe that this subset represents approximately 20-25% of the physicians in the United States.  For example, the following table sets forth the numbers of such physicians in each of three states:\r\nState	Target Specialists	Total Physicians	%age\r\nCalifornia	37,914	153,663	24.7\r\nMinnesota	6,857	35,706	19.2\r\nNorth Carolina	9,529	48,252	19.7\r\n\r\nPredicated on the total number of active physicians of 923,308 (Kaiser Family Foundation) Biogenic estimates that the number of physicians in the target specialties ranges from 184 to 231 thousand.\r\nReimbursement\r\nThe reimbursement rates for the tests performed by the Biogenic unit have been remarkably stable.  Depending upon many factors, average reimbursement by Medicare is $450-$525 for the standard battery of tests.  These tests are always run together, they are never run separately.  Any variation in reimbursement is largely driven by location considerations (i.e. NYC will have a higher reimbursement rate than Topeka, KS).  Commercial reimbursement generally runs 20%-25% higher.\r\nâ€ƒ\r\nFinancial Information\r\n\r\nThe following table sets forth the anticipated returns to an Diagnostic Partner assuming a utilization rate of 5 tests per day, 4 days per week.\r\n \r\nThe following table sets forth a sensitivity analysis assuming 1.5, 3, 5, and 7 tests per day, 4 days per week:\r\nUtilization Rate per Day	Diagnostic Partner Monthly Net\r\n1.5	  $6,942\r\n3.0	$13,884\r\n5.0	$23,140\r\n7.0	$32,396\r\n\r\n\r\nSeeking collaboration & ideas including helping us sell our Non-franchise, Franchise like Business Opportunity with Physicians. About 7,500 systems in the next 48 months secured in a Medical Clinic.\r\n', ''),
(229, 'Ronald Ens', '732 946-4300  ext 259', 'ronaldens@lawndoctor.com', 'Acquiring Lawn Care Businesses', 'Hello,\r\n\r\nI represent Lawn Doctor\'s Corporate Acquisition Team.  We have a franchisee looking to acquire a lawn care business in the Denver and/or Colorado Springs area.  Should you know of any businesses looking to sell that fit that criteria, please contact me at your earliest convenience.\r\n\r\nRegards,\r\n\r\nRonald Ens\r\n', ''),
(230, '', '', '', '', '', ''),
(231, '', '', '', '', '', ''),
(232, '', '', '', '', '', ''),
(233, 'Tom Lutes', '(720) 255-2206', 'sweetcelebfb@gmail.com', 'Business sale', 'Hi- We own a company that is located in downtown Castle Rock. We own a number of websites and we personalize items thru embroidery, laser and heat press. We are doing 35K to 40K per month and growing. My wife and I are near retirement age and have had a few health scares. We would like to sell the business. If you have potential buyers and can assist, please give me a call. \r\n\r\nTom Lutes\r\nA Sweet Celebration, LLC\r\n720-255-2206', ''),
(234, 'Travis Cole', '347-809-5956', 'studio@30secondexplainervideos.com', 'Partnership', 'I came across your website after searching for startups on yellowpages.com\r\n\r\nAnd I was wondering if you would like to partner up? \r\n\r\nBasically what we do is make animated videos that are designed to promote your services online and increase your website conversion rate.\r\n\r\nSo I wanted to offer you a 30 second animated whiteboard video for your so product for just $197. (including script/voiceover)\r\n\r\nAll I ask in return is a quick testimonial if you like the video!\r\n\r\nIf you are interested in this offer, you can find out more and get started at www.30secondexplainervideos.com/whiteboard-promo\r\n\r\nOr can you shoot me a quick email for a brief discussion!\r\n\r\nCheers, Travis \r\nwww.30secondexplainervideos.com/whiteboard-promo\r\n', ''),
(235, '', '', '', '', '', ''),
(236, '', '', '', '', '', ''),
(237, 'John McHugh', '3128411021', 'jmchugh4@gmail.com', 'Golf Course Event Center', 'Hi Matthew,\r\n\r\nI just came across your listing for the property specified above and took a look at the brochure.  Do you have any other information handy to share on the business itself?\r\n\r\nAdditionally, what is the nature of the relationship with the owners of the golf course?  Are they simply tenants during golf season?\r\n\r\nThe best way to get a hold of me is at the email above.\r\n\r\nThanks,\r\nJohn', 'Event center/ Restaurant Bar in a Golf Course'),
(238, 'Halid Omar', '9652342426', 'h.omarpag@gmail.com', 'WE OFFER LOANS FOR PROJECTS', 'Dear Sir,\r\nMy name is Halid Omar. We humbly introduce our organization Platinum\r\nFunding Group ( PFG) with its loan funding program. PFG is an\r\nOrganization set up to consolidate the business interest of its\r\nconstituent members by investing and re-investing large funds on very\r\nviable projects in Real Estate Development such as Senior Living,\r\nMulti Family Residential,Commercial Properties and so on. We also\r\nprovide loan financing for the development of projects such as Golf\r\nCourses,Resorts,Tourism,Hospitality Concerns and just recently we have\r\ncommenced funding the development of technologies that promote\r\nSustainable Energy including Renewable Energy sources, such as\r\nHydroelectricity, Solar Energy, Wind Energy, Ocean Wave Power,\r\nGeothermal Energy, Bio-energy, Tidal Power and also other technologies\r\ndesigned to improve energy efficiency. We provide loan financing for\r\nthe development of all of these.\r\nThe PFG has top chiefs in the Kuwaiti Emirate and Oil Sheiks within\r\nthe Gulf and Middle East as its Directors.We source for very viable\r\nprojects that need funding in our areas of interest as listed above.We\r\noffer between 5.5% and 6 % as interests with a good Moratorium Policy.\r\nIf you are convinced on the viability of your project, please contact\r\nus for further details. Do have a good day.\r\nKind Regards\r\nHalid Omar', ''),
(239, '', '', '', '', '', ''),
(240, 'Kunio Takahashi', '7693750163', 'jescocolimited@gmail.com', 'purchase transactions', 'Dear Counsel,\r\n\r\nI want to inquire if your firm handle sales and purchases of businesses or if you can assist us in drafting purchase agreement.\r\n\r\nWe would like to retain your firm to review proposed transactions for acquisitions or purchase of businesses and creation of contracts for acquisition (merger), if you are interested, Please advice us on your initial retainer fee and we shall forward you the company information and letter of intent. We look forward to your prompt response.\r\n  \r\nYours Sincerely,\r\n\r\nMr. Kunio Takahashi\r\nJesco Co., Ltd \r\n2-19-8 Kanda Suida-cho, \r\nChiyoda-\r\nku, Tokyo 2F \r\nSakai Building 101-0041 Japan\r\nFax 03-3258-4007\r\nTel 03-3258-4006\r\njescocolimited@gmail.com\r\nhttp://www.jesco-l.co.jp.', ''),
(241, '', '', '', '', '', ''),
(242, '', '', '', '', '', ''),
(243, 'Sunmi', '7209994004', 'stowolawi@live.com', 'Colorado Business', 'I am looking to purchase a business and need a broker. ', ''),
(244, '', '', '', '', '', ''),
(245, 'David Ross ', '303-324-2222', 'David.l.ross@hotmail.com', 'Interest in the high volume Longmont store ', 'I am interested in this store. I live in Parker Colorado so the first piece of information I would be interested in is itâ€™s exact location in Longmont and what hours the current owner currently works. \r\n\r\nTahnsk', 'High volume Liquor store in Longmont'),
(246, '', '', '', '', '', ''),
(247, 'Carol Cruver', '3039278378', 'gentleheartspet@gmail.com', 'Interested in selling my business', 'Hi Eagle Business Brokers,\r\n\r\nI am interested in selling my small business. I do not know what my options are, I don\'t know where to start or even what to say in this email. Please contact me at your convenience.\r\n\r\nThank you so much and I look forward to speaking with you.\r\nCarol', ''),
(248, '', '', '', '', '', ''),
(249, 'J Clark', '6202714798', 'mojamabo@gmail.com', 'Motel for sale', 'Greetings,\r\nI have a motel for sale in Casper, WY. It\'s a thriving, independent that still has some room for improvement. Great investment opportunity for someone looking to go into the hotel business. If you have an interested client or would like to know more, please feel free to call me at 6202714798 or email me back at mojamabo@gmail.com.\r\n\r\nThanks!\r\nJ Clark', ''),
(250, '', '', '', '', '', ''),
(251, '', '', '', '', '', ''),
(252, '', '', '', '', '', ''),
(253, 'Max Williams', '7077060205', 'seo4@weboptimization.co.in', 'Top Ranking On Google', 'Hello and Good Day\r\n\r\nI am Max, Marketing Manager with a reputable online marketing company based in India.\r\n\r\nWe can fairly quickly promote your website to the top of the search rankings with no long term contracts!\r\n\r\nWe can place your website on top of the Natural Listings on Google, Yahoo and MSN. Our Search Engine Optimization team delivers more top rankings than anyone else and we can prove it. We do not use \"link farms\" or \"black hat\" methods that Google and the other search engines frown upon and can use to de-list or ban your site. The techniques are proprietary, involving some valuable closely held trade secrets. Our prices are less than half of what other companies charge.\r\n\r\nWe would be happy to send you a proposal using the top search phrases for your area of expertise. Please contact me at your convenience so we can start saving you some money.\r\n\r\nIn order for us to respond to your request for information, please include your companyâ€™s website address (mandatory) and or phone number.\r\n\r\nSo let me know if you would like me to mail you more details or schedule a call. We\'ll be pleased to serve you.\r\nI look forward to your mail.\r\n\r\nThanks and Regards\r\n', ''),
(254, 'Kevin Carlson', '7207391020', 'kcarlson@playtga.com', 'Selling My Business', 'Hello,\r\n\r\nI have an existing franchise that I am basically looking to give away.  I would just like to cover the costs of your fees and the franchise transfer fees of about $14,000, if there is additional revenue, great.  It is a great business model and would cost about $100,000 to start without any clients.  Please let me know via email if this is something you would be interested in.', ''),
(255, '', '', '', '', '', ''),
(256, 'Joe Root', '2369857485', 'rootjoe301@gmail.com', 'seo', '\"Hello,\r\n\r\nMy name is Joe and I am a Digital Marketing Specialists for a Creative Agency.\r\nI was doing some industry benchmarking for a client of mine when I came across your website.\r\nI noticed a few technical errors which correspond to a drop of website traffic over the last 6-8 months which I thought I would bring to your attention.\r\nAfter closer inspection, it appears your site is lacking in 4 key criteria.\r\n\r\n1- Website Speed\r\n2- Link Diversity\r\n3- Domain Authority\r\n4- Competition Comparison\r\n\r\nWe would be happy to send you a proposal using the top search phrases for your area of expertise. Please contact me at your convenience so we can start saving you some money.\r\n\r\nIn order for us to respond to your request for information, please include your Name, companyâ€™s website address (mandatory) and /or phone number.\r\n\r\nRegards,\r\nJoe Root\r\nrootjoe301@gmail.com\r\n\r\n', ''),
(257, 'Matthew Whitaker', '205-585-0415', 'mwhitaker@gkhouses.com', 'Property management business', 'I\'m interested in purchasing a Colorado single-family property management business. I\'m curious if you have one listed or know of one available?\r\n\r\nThank you,\r\n\r\nmw ', ''),
(258, '', '', '', '', '', ''),
(259, '', '', '', '', '', ''),
(260, '', '', '', '', '', ''),
(261, 'Rachel Southern', '7196481819', 'rachelcederberg@gmail.com', 'selling a business', 'Hey - I\'m thinking of selling my business and wanted to know if/how you could help. I\'m located in Colorado Springs and am in pet supply retail. I didn\'t know if you worked with C-springs locations.', ''),
(262, '', '', '', '', '', ''),
(263, 'Jennifer Bauer', '7204360436', 'ejjbauer13@gmail.com', 'Looking for a commercial property ', 'hello, my husband and I are wanting to look for an auto body shop to buy or land zoned for an auto body shop. Was hoping someone could give us information.\r\nThanks Jennifer ', ''),
(264, 'Jennifer L Piccolo', '7203831813', 'jpiccolo@dart-mania.com', 'Selling a business', 'My partner and I are interested in selling our indoor Nerf battleone, www.dart-mania.com.  We think it\'s a viable long-term business, we are just out of working capital a year after we started.  Would love to chat about options.', ''),
(265, '', '', '', '', '', ''),
(266, 'Mike Botha', '829907711', 'bothamike23@gmail.com', 'Business Opportunties', 'I am interested in buying an existing Fast Food Franchise in the Denver district / area.', ''),
(267, '', '', '', '', '', ''),
(268, 'Jay Carey', '7209354286', 'jaycarey32@gmail.com', 'Interested In Discussing Selling A Business', 'Interested in a discussing selling a dispensary with 4 grows in Denver, Colorado. Partial Real Estate Available. $3.8m/revenue/year. In the process of receiving recreational licenses. 7209354286', ''),
(269, 'Lisa Kent', '+1-646-5532170', 'LisaKent@explainmybusiness.com', 'Promoting Your Business', 'I was just checking out your website, and was very impressed with the quality, look and feel.\r\n\r\nIâ€™m sure you have seen a lot of companies are starting to add animated videos to their websites, social media and YouTube pages to help explain their services in a fun, clear and engaging way. I think a 60-90 second animated video would be a perfect way for you to get your companies message across to more potential clients.\r\n\r\nMy team, located in Israel, helps businesses create quality customized Character Animation, Motion Graphics & Whiteboard videos at affordable rates.\r\n\r\nI would be happy to set up a call for a consultation and price quote.\r\n\r\nWe are eager to hear back from you!\r\n\r\n\r\nGreetings from Jerusalem\r\nLisa Kent\r\n\r\nwww.explainmybusiness.com', ''),
(270, 'Raj Rai', '3036683431', 'raazfor2@gmail.com', 'Planning to see', '', 'Washington Street'),
(271, '', '', '', '', '', ''),
(272, '', '', '', '', '', ''),
(273, '', '', '', '', '', ''),
(274, '', '', '', '', '', ''),
(275, 'Maria Hill', '9891231226', 'info@ranks.co.in', 'Google Ranking @ $99', 'Hi,\r\n \r\nDo you look forward for some out of the box web design? \r\n\r\nWe can help you with our amazing web design service under very economic price. \r\n\r\nGet in touch with us to explore more about our web design services.\r\n\r\nThanks\r\nMaria | Whatsapp: +91 9212464161', ''),
(276, 'Maria Hill', '9891231226', 'info@ranks.co.in', 'Google Ranking @ $99', 'Hi,\r\n \r\nDo you look forward for some out of the box web design? \r\n\r\nWe can help you with our amazing web design service under very economic price. \r\n\r\nGet in touch with us to explore more about our web design services.\r\n\r\nThanks\r\nMaria | Whatsapp: +91 9212464161', ''),
(277, 'Maria Hill', '9891231226', 'info@ranks.co.in', 'Google Ranking @ $99', 'Hi,\r\n \r\nDo you look forward for some out of the box web design? \r\n\r\nWe can help you with our amazing web design service under very economic price. \r\n\r\nGet in touch with us to explore more about our web design services.\r\n\r\nThanks\r\nMaria | Whatsapp: +91 9212464161', ''),
(278, 'Maria Hill', '9891231226', 'info@ranks.co.in', 'Google Ranking @ $99', 'Hi,\r\n \r\nDo you look forward for some out of the box web design? \r\n\r\nWe can help you with our amazing web design service under very economic price. \r\n\r\nGet in touch with us to explore more about our web design services.\r\n\r\nThanks\r\nMaria | Whatsapp: +91 9212464161', ''),
(279, 'Maria Hill', '9891231226', 'info@ranks.co.in', 'Google Ranking @ $99', 'Hi,\r\n \r\nDo you look forward for some out of the box web design? \r\n\r\nWe can help you with our amazing web design service under very economic price. \r\n\r\nGet in touch with us to explore more about our web design services.\r\n\r\nThanks\r\nMaria | Whatsapp: +91 9212464161', ''),
(280, 'Ashley McGaughey', '720-515-6107', 'Denverdogtraining@gmail.com', 'Selling my small dog training business', 'Hi, I am interested in selling my four year old dog training business that services Denver and surrounding counties. Feel free to reach me via email or phone. We have P&L comparisons ready to view if this is something you are interested in.\r\n\r\nThank you,\r\n\r\nAshley McGaughey', ''),
(281, 'Sanjeev Yadav', '7077060205', 'seo1@googlemybusiness.co', 'Website Promotion On Google ', 'Hi\r\nI am Sanjeev Â from a leading Search Engine Optimization (SEO) Company based in India.\r\nAs per the trends in your industry - over 80% of people search for your products/services online and buy the same.Â Â Â Â Â Â \r\n1. Would you like to increase the leads / sales generated from your website?\r\n2. Do you want Google promotion Service in Affordable price?Â \r\n3. Would you like to be listed at the top of every major search engine such as Google, Yahoo! & Bing for multiple search phrases (keywords) relevant to your products / services?\r\nIt would be recommended if you go for search engine optimization (SEO) for your website which would increase your web visibility and generate better prospect traffic to your website.\r\nThere is a simple equation that is applicable to the online world.\r\nEthical SEO = Better Traffic ï€«ï€ Higher Sales\r\nDo let me know if you are interested and it shall be our pleasure to give you Details about our services, Price list and Offers.\r\nI look forward for your reply.Â \r\n\r\n----------------------\r\nKind Regards,\r\nSanjeev Yadav', ''),
(282, 'Margaryta ', '9704880508', 'Margarytaschwery@yahoo.com', 'Selling salon', 'Hi.\r\nIâ€™m interested in selling my salon business. Itâ€™s only two years old, complete turnkey with all the furniture, fixtures and so on. Being only two years old, Iâ€™m only now starting to profit. So I want to know whether or not itâ€™s possible to sell at this point. Thank you ', ''),
(283, 'Paras Gheewala', '7192166234', 'pgheewal@hotmail.com', 'commercial real estate', 'Hi, I am interested in buying Commercial real estate in Denver and Colorado Springs area. Let me know if there is something that is prime location and listed at good price. Thanks, Paras', ''),
(284, '', '', '', '', '', ''),
(285, '', '', '', '', '', ''),
(286, '', '', '', '', '', ''),
(287, 'Arlan Visser', '800-228-0008', 'arlan.visser@jetter.com', 'Senior Health Market', 'Hi Mathew,\r\n\r\nAs a full service brokerage agency, Art Jetter & Companyâ€™s training, marketing and lead generating programs help agents sell Medicare Supplements nationwide. WE are proud to offer service in many different areas including life, annuities, long term care, CI & DI, and more. The attached document â€œWhy Brokers Do Businessâ€ provides more information about our company. \r\n\r\nWe provide all our agents with complimentary customized calling lists when they become appointed with any of our carriers (100 names for each carrier), full access to our on-demand sales and marketing presentations and access to our Medicare Supplement quote tool that allows you to provide customized quotes for your clients. \r\n\r\nPlease call me at 800-228-0008 ext. 1052 to discuss great opportunity to grow your business.\r\n\r\n\r\n\r\nVery truly yours,\r\n\r\nArlan\r\n\r\n', ''),
(288, '', '', '', '', '', ''),
(289, '', '', '', '', '', ''),
(290, '', '', '', '', '', ''),
(291, '', '', '', '', '', ''),
(292, '', '', '', '', '', ''),
(293, 'Gary Joseph', '9497938782', 'gary@biogeniccorp.com', 'Offering Exclusive & Increase to $25,000 per Partnered System', 'Dear Mathew,  \r\nThe couple handfuls of Business Brokers and Consultants who represent us are earning $20,000-$120,000 per month. If you choose to speak to them you will hear about the easy Passive income saleâ€¦that keeps getting easier. Our Opportunity sells itself and saves lives! We use the attachments to sell the opportunityâ€¦financial info is on last page of the Business Plan. We have a Network of 1,476 Systems all generating $8,000.00 + monthly passive income for the Investors. 7,500 new locations will be established in the next 84 months=$150,000,000 in commissions. (One hundred and fifty million dollars)\r\n\r\nWe are the Gold Standard for Non-Invasive Preventive Care and creating Business Opportunities teaming Diagnostic Partners AKA Investors and Business Opportunity seekers with Physicians, Clinics, and Hospitals and we\'re looking for additional capable representation. This is the ultimate in Passive income. No Health experience.\r\n\r\nWe would love for you to add us to your Portfolio of robust Business Opportunities & suggest us when you deem appropriate and a fit to your Investment/Opportunity seekers and be rewarded with a commission of $20,000=13.3%!  Full Training in 90 minutes on the Business Opportunity and System.\r\n\r\nOur Chief Scientific Medical Officer/Medical Director is in Newport Beach, CA â€¦interesting statistic is so far 100% of the visitors buy a System after meeting all of the awesome team, get tested, meet our wonderful Medical Director and experience the opportunity.\r\n\r\nThe device is FDA approved and performs a myriad of tests designed to identify numerous risk factors such as: Silent Heart Attack, Hypertension, Cardiac Autonomic Neuropathy, Diabetic Neuropathy, Vascular Abnormalities, and others.  It has been designated as a Standard of Care by such prestigious organizations as The American Diabetes Association and The American Heart Association. \r\n\r\nWe estimate that 70% of people 70 or older are eligible for an annual test and 45% of those 45 or older with any cardiovascular risk factors. This represents over 40 million individuals. For those with diabetes the recommendation is generally two tests per year, and unfortunately diabetes is the fastest growing chronic care condition in the United States. According to the CDC, there are 29.1 million diabetics in the United States (1 out of 11) and another 86 million pre-diabetics, an astounding 1 out of 3! Per the American Journal of Cardiology, â€œAs many as 90,000 American lives could be saved each year if all men ages 45-75 and women 55-75 received cardiovascular wellness testing.â€  \r\n \r\nWe have elected to pursue two different sales channels: i) Direct Sales to Physicians, and ii) Sales to Owner/Operators who place a unit in a physicianâ€™s office and enter a Fee for Service Agreement with the doctor. The cost of the unit is $150,000. Itâ€™s state-of the-art diagnostics and design, its small footprint, and ability to be integrated with other revenue generating tests make it the Gold Standard in this sector. \r\n \r\nThis Investor business model is unique and it has been successful for a number of Owner/Operators. Usually the Owner/Operator will purchase a unit for $150,000 and BioGenic will secure the physician who will offer these tests to their patient base in-house, based upon medical necessity. Our Location Assistance Program will find the location, place the system and train the staff on how to operate the equipment! Depending upon regional reimbursement rates, each test is reimbursed at between $500-$515 by Medicare and private pay is about 11% higher. \r\n\r\nThe Fee for Service Agreements provide for a fee of $250 per test to the Owner/Operator. Depending upon the physicianâ€™s patient base and mix, 5-7 tests per day is a good approximation. Obviously, these numbers add up to an outstanding return over time. The physician will be generating a new, residual revenue stream for their business, and this is before any additional testing from the Clinical Triggers and follow-up visit revenue based on the results of the tests. We may also remotely audit the number of tests that are performed and we have the ability to disable the unit if the doctors are not remitting the required payments. This feature helps us to monitor the status of the System each month.\r\n \r\nFor more information, I invite you to visit our web site at www.biogeniccorp.com   Please contact me after digesting the informationâ€¦ \r\n\r\nIf this is of interest to you please contact me. If not, please I would respectfully ask you to forward to a suitable Business Opportunity Consultant Candidate and I will reward you with an abundant Bounty of a reward.\r\n\r\nBest Regards, Happy Holidays, & Happy New Year!\r\n\r\nGary Joseph\r\nPresident\r\nBioGenic Corp\r\n359 San Miguel Drive\r\nNewport Beach, CA 92660\r\n949-793-8782 DIRECT CELL\r\n(800) 674-3161 TOLL FREE\r\n(800) 674-3161 FAX\r\nwww.biogeniccorp.com\r\n \r\nTodayâ€™s The Day!\r\n\r\n\"Whether you think you can or you think you can\'t, you\'re right.\"\r\n-- Henry Ford\r\n\r\n\r\nP.S. We have a Network of 1,476 Systems all generating $8,000.00 + monthly revenue. The plan is for 7,500 new Systems teamed with Physicians and Clinics in the next 84 months!\r\n\r\n\r\n', ''),
(294, '  ÐÐ°Ð´ÐºÐ°} ', '9999999999', 'egorn769kuz@yandex.ru', 'Ð”Ð¾Ð±Ñ€Ñ‹Ð¹ Ð´ÐµÐ½ÑŒ!', ' http://ui72kbasneeof36aymuipwdpdpnyxs7jfmdkwnayzgoc7adyep.com  ui72kbasneeof36aymuipwdpdpnyxs7jfmdkwnayzgoc7adyep \r\n \r\nMtiNjoJU0\r\n', ''),
(295, '  ÐÐ°Ð´ÐºÐ°} ', '9999999999', 'egorn769kuz@yandex.ru', 'Ð”Ð¾Ð±Ñ€Ñ‹Ð¹ Ð´ÐµÐ½ÑŒ!', ' http://ui72kbasneeof36aymuipwdpdpnyxs7jfmdkwnayzgoc7adyep.com  ui72kbasneeof36aymuipwdpdpnyxs7jfmdkwnayzgoc7adyep \r\n \r\nMtiNjoJU0\r\n', ''),
(296, 'Patricia Hope', '653113777', 'pathope@protonmail.com', 'Can you enhance your blog pages?', 'Hello,\r\n\r\nI\'ve been a reader of your blog for around 4 months and I would like first of all to say that I really enjoy it.\r\n\r\nI\'ve got recently some problems with my eyes which effects my reading ability.\r\n\r\nThereby I\'ve a favor to ask. Is it possible for you to add Podcast audio version of your articles?\r\n\r\nIt would be very useful for people like me or others who like to listen to your content.\r\n\r\nI\'ve researched on that a bit and I found few free services that can help.\r\n\r\nHere are some websites that I found that can add podcast to your site for free.\r\n\r\nhttps://websitevoice.com\r\n\r\nhttps://www.text2speech.org\r\n\r\nThanks!\r\n\r\nPatricia Hope', ''),
(297, '', '', '', '', '', ''),
(298, '', '', '', '', '', ''),
(299, 'Gwen Scherer', '3038075953', 'gwenscherer@gmail.com', 'Inquiry re: selling our business', 'We are interested in exploring the possibility of selling our local 4-store Denver area business. Thank you, Gwen', ''),
(300, 'Pamela Cooper', '303 332 2662', 'aqualady12@msn.com', 'service business', 'Hi,\r\n\r\nI have owned and operated a freshwater aquarium maintenance serves business since 1992 in the Denver Co. area. I am getting up there in years and am wondering if I can sell my business. It brings in about 60,000. a year and I have no debt and very little overhead. I don\'t have any employees. I don\'t have any experience regarding managing other people. I have always  done everything myself. There is lots of room for growth as I have not advertised in years. I get occasional new accounts from word of mouth and people visiting my web site.  I have had most of my clients for years. I do both homes and businesses such as nursing homes, doctors offices, office lobby\'s.  I am willing to train the buyer. Is selling an option, or would I be better off hiring people to  train and do the work? I don\'t want to just let it go. Can you help me or refer me to someone who can?\r\n\r\nThank you, Pam Cooper/Tidy Tank aquarium services 303 332 2662', ''),
(301, 'Jason Berner', '518-441-0538', 'Jason.Berner1@gmail.com', 'commercial lease', 'Hi,\r\n\r\nI will be in town between 2/11-17 and would like to talk with an agent about my business needs and possibly look at some spaces.  Please contact me at the listed number.\r\n\r\nThank you,\r\nJason', ''),
(302, '', '', '', '', '', ''),
(303, '', '', '', '', '', ''),
(304, '', '', '', '', '', ''),
(305, 'Jay Piper', '4782310789', 'piper0789@gmail.com', 'Design', 'Hello,\r\n\r\nIâ€™m Jay Piper and I would like to be a designer for your company. I am currently looking for new clients to work with. I have vast experience in the design world and offer a unique skill set. Iâ€™m confident that my my repertoire will make me a great asset to your team.\r\n\r\nI have years of experience in print design, web design, branding, vinyl graphics, illustration and much more. I build wireframes, design websites, build prototypes and develop sites. I have worked with a large, diverse list of clients that have allowed me to explore and master many different styles of design.\r\n\r\nI create unique and personal designs and am a true outside the box thinker. Building companies from the ground up is what I enjoy most. I design for both print and web so my skill set is pretty diverse. I have excellent communication skills and am extremely organized. I would love an opportunity to be your designer.\r\n\r\nPlease see my portfolio at jaypiperdesigns.com. Thank you for your time & consideration. I look forward to speaking with you.\r\n\r\nRespectfully,\r\nJay Piper', ''),
(306, 'Lisa Weik', '303-586-5560', 'franchise@resrents.com', 'Selling Franchises', 'Good morning,\r\n\r\nDoes your firm handle franchises?  We\'re trying to locate a broker who can assist us in selling our property management franchise system. \r\n\r\nBest Regards,\r\n\r\nLisa Weik', '');

-- --------------------------------------------------------

--
-- Table structure for table `resources`
--

CREATE TABLE `resources` (
  `resourceId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED DEFAULT NULL,
  `documentName` varchar(150) DEFAULT NULL,
  `description` varchar(1000) DEFAULT NULL,
  `contentType` varchar(5) NOT NULL DEFAULT 'pdf'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `resources`
--

INSERT INTO `resources` (`resourceId`, `companyId`, `documentName`, `description`, `contentType`) VALUES
(2, 1, 'Small Business Administration ', 'Docs needed\r\nApplication ', 'pdf'),
(3, 1, 'Lease File', 'Financial Statement\r\nLease Application ', 'pdf'),
(4, 1, 'Selling', 'Documents ', 'pdf'),
(5, 1, 'Buying ', 'Docs', 'pdf'),
(6, 1, 'Due Deligence', 'Docs Needed', 'pdf'),
(7, 1, 'Entity Forming', 'Doc Needed', 'pdf'),
(8, 1, 'Equipment List', 'Conveyed Equipment List', 'pdf'),
(9, 1, 'Inventory', 'Docs', 'pdf'),
(10, 1, 'Non Disclosure Agreement', 'NDA', 'pdf'),
(12, 1, 'Insurance ', 'Docs for Insurance', 'pdf'),
(13, 1, 'Denver Liquor Licencing', 'Items', 'pdf'),
(14, 1, 'Colo Retail Application ', 'Retail Application', 'pdf');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `settingsId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `messageEmail` varchar(100) DEFAULT NULL,
  `linkedIn` varchar(100) DEFAULT NULL,
  `facebook` varchar(100) DEFAULT NULL,
  `twitter` varchar(100) DEFAULT NULL,
  `googlePlus` varchar(100) DEFAULT NULL,
  `skype` varchar(100) DEFAULT NULL,
  `pinterest` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`settingsId`, `companyId`, `messageEmail`, `linkedIn`, `facebook`, `twitter`, `googlePlus`, `skype`, `pinterest`) VALUES
(1, 1, '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `testimonialId` int(10) UNSIGNED NOT NULL,
  `companyId` int(10) UNSIGNED NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `testimonial` varchar(500) DEFAULT NULL,
  `author` varchar(100) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`testimonialId`, `companyId`, `title`, `testimonial`, `author`, `status`) VALUES
(1, 1, 'Sed quia consequuntur magni dolores eos qui', 'Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam, eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo. Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione voluptatem sequi nesciunt', ' IPSUM B. LOREM', 0),
(2, 1, 'When they reached the farmyard', 'When they reached the farmyard, there was a wretched riot going on; two families were fighting for an eel\'s head, which, after all, was carried off by the cat. \"See, children, that is the way of the world,\" said the mother duck, whetting her beak, for she would have liked the eel\'s head herself. \"Come, now, use your legs, and let me see how well you can behave. You must bow your heads prettily to that old duck yonder; she is the highest born of them all and has Spanish blood; therefore she is we', 'Tester One', 0),
(3, 1, ' Everywhere it was like a blooming meadow or a lovely garden. ', 'The summit of this tree spread itself for miles like an entire forest, each of its smaller branches forming a complete tree. Palms, beech-trees, pines, plane-trees, and various other kinds, which are found in all parts of the world, were here like small branches, shooting forth from the great tree; while the larger boughs, with their knots and curves, formed valleys and hills, clothed with velvety green and covered with flowers. Everywhere it was like a blooming meadow or a lovely garden. ', 'Tester Two', 0),
(4, 1, 'Yes, it was beautiful, it was delightful in the country.', 'It was so beautiful in the country. It was the summer time. The wheat fields were golden, the oats were green, and the hay stood in great stacks in the green meadows. The stork paraded about among them on his long red legs, chattering away in Egyptian, the language he had learned from his lady mother.\r\n\r\nAll around the meadows and cornfields grew thick woods, and in the midst of the forest was a deep lake. Yes, it was beautiful, it was delightful in the country.\r\n\r\nIn a sunny spot stood a pleasa', 'Website Tester', 0),
(5, 1, 'Yes, it was beautiful, it was delightful in the country.', 'It was so beautiful in the country. It was the summer time. The wheat fields were golden, the oats were green, and the hay stood in great stacks in the green meadows. The stork paraded about among them on his long red legs, chattering away in Egyptian, the language he had learned from his lady mother.\r\n\r\nAll around the meadows and cornfields grew thick woods, and in the midst of the forest was a deep lake. Yes, it was beautiful, it was delightful in the country.\r\n\r\nIn a sunny spot stood a pleasa', 'Website Tester', 0),
(6, 1, 'Very Good Service', 'The summit of the tree was a wide-spreading garden, and in the midst of it, where the green boughs formed a kind of hill, stood a castle of crystal, with a view from it towards every quarter of heaven. Each tower was erected in the form of a lily, and within the stern was a winding staircase, through which one could ascend to the top and step out upon the leaves as upon balconies. The calyx of the flower itself formed a most beautiful, glittering, circular hall, above which no other roof arose t', 'Another Tester', 0),
(7, 1, '9th Ave Liquor ', 'Mathew Abraham sold our liquor store in record time and in some of the most challenging circumstances one can imagine; we didn\'t think it could be done. \r\n\r\nHe always got back to us instantly, no matter what the time and whether it was a weekend or holiday. \r\n\r\nThrough every hurdle, he was steadfast in his skill to get us over them and he led us to a successful closing. \r\n\r\nIt would be our pleasure to recommend him to anyone who is considering to buy or sell a real estate transaction. ', 'Frank Maitre', 1),
(8, 1, 'Covenant Church', 'I was pastor of a church in Denver that was in the process of closing down and selling its building.  I was referred to Mathew Abraham to assist as realtor in the transaction.  He did a very professional job in getting the word out about the availability of the building, helping us find a client who could afford the building and grounds, and he brought it to a happy conclusion. He had a very keen understanding of the needs of churches in this particular transaction, and both sides ended up very ', 'Rev. Gary Copeland', 1),
(9, 1, 'Lease', 'Mathew Abraham helped our company to negotiate 2 long term leases. His knowledge and skills were helpful. I would recommend him to anybody who is in pursuit of lease negotiations.', 'Raman Sandhu- President of Rocky Mountain Franchise Association', 1),
(10, 1, 'Buyer Representation ', 'Eagle Business Brokers LLC is the best brokerage company when buying or selling a business.  We contacted several broker for liquor store but Mathew Abraham is the best among all of them. He is very honest and detail oriented when it come to buying a business. I was very comfortable with him personally as well as financially. I would recommend Brittany Real Estate (Mathew Abraham) to anyone who is looking to buy or sell a business. The time from finding the buyer to the closing was super fast. ', 'Jitender Singh Owner (9th Ave liquor warehouse)', 1),
(11, 1, 'Past Managing broker of  Keller Williams', 'I first met Mathew about 8 years ago when one of my agents was looking for a business broker to refer the sale of a junk yard to. Mathew had done business with another agent in our Keller Williams office and that agent made the recommendation to me. \r\n\r\nI found Mathew to be unlike most of the other business brokers that I had talked to. He was genuine in his desire to make sure that both the client and the referring agent were happy with the transaction and the way that it was being handled. \r\n\r', 'Ray Sherman', 1),
(12, 1, 'Owner of Shopping Center', 'We are thankful for having the opportunity to meet and work with Mathew Abraham. Mathew helped us purchase two strip centers. In both of those deals he walked us through every single step of the process including acquiring the mortgages with satisfactory for us conditions. \r\nThanks to his experience and expertise the whole process went very smooth for us, even though there were many nuances and complications.  \r\nMathew proved to be very honest, trustworthy, and competent at what he does. ', 'Erna A', 1),
(13, 1, 'Chock Cherry Liquor ', 'I am so grateful to Mathew Abraham in assisting us in acquiring our current business. This is my 6th business I bought and sold. I must say among all my buying and selling experience, this was very difficult. But Mathew helped me to consummate it with great ease. \r\nI would recommend to anybody who is trying to buy or sell a business. He is the best. ', 'Anthony Smorgner', 1),
(14, 1, 'Arrow Liquor ', 'With great pleasure I write this testimonial. He helped us through each step of the process. The lease negotiation was particularly challenging considering the size of the store.\r\n \r\nHe negotiated a long term lease with a very favorable terms for us. The business has been thriving and we hare very happy about the acquisition.\r\n \r\nI can recommend Mathew to anybody who is considering to buy a commercial or residential property.', 'Vaneet Malhotra', 0),
(15, 1, 'South West Liquor ', 'With great pleasure I can recommend Mathew Abraham to anybody who  is considering to sell their business or real estate. \r\nI was faced with a very difficult decision about our business due to a career change. \r\nMathew marketed our business and sold it for a price more than what we anticipated.  \r\nWe are very happy for the help Mathew and his team extended to us', 'K Patel ', 1),
(16, 1, 'House Purchase', 'My wife Tammy met one of Mathew\'s associate in a social gathering and through that association he heled up to buy our dream home. \r\n\r\nHe helped us through each of the step and it has been a great positive experience.', 'Alex Andropov', 1),
(17, 1, 'Loft in Down Town', 'I am so appreciative of the help and expertise I received from Mathew in assisting me to buy my current investment in 2009. It was a lengthy and tedious search but I am happy to find a unit that will fit my need. \r\nI would gladly recommend the services of Mathew Abraham and his team to anybody who is looking to buy a commercial or residential property. They know what they are doing.', 'Dr. Anil Idiculla DMD', 0),
(18, 1, 'Gas Station and Convenient Store', 'Mathew Abraham helped me to buy my first gas station and convenience store in Denver once we moved to Colorado.\r\n\r\nHe was well versed in all the aspect of the business as well as the regulations which governs the business. \r\n\r\nHis service was invaluable to me, it is my pleasure to recommend him to anybody who is trying buy or sell a real estate either residential or commercial. ', 'Thomas Testa', 1),
(19, 1, 'Auto Recycling', 'My family owned a auto recycling business at the same location for 30 years.Mathew Abraham found a buyer for us and got a price very much in the range of what we were asking.\r\n\r\nHe helped us in every step of the way to the closing. I am so satisfied with his service and will be glad to recommend to anybody who need assistance in the area of Buying, Selling or leasing.', 'Vasily Lobanov ', 1),
(20, 1, 'Europa Liquor ', 'Mathew Abraham helped us with the purchase of Europa Wine and Liquor. His market knowledge helped ensure we got a fair price and saved us thousands of dollars. \r\nHis industry connections assisted in every step of the process and were invaluable. \r\nI would never use anybody other than Mathew Abraham and the Eagle Business Brokers LLC team. ', 'Stacey Robinson', 1),
(21, 1, 'Investment Properties', 'Matthew Abraham of Brittany Real Estate LL C was the broker I used to successfully purchase 3 rental properties. \r\nHe spent an inordinate amount of time with me.  \r\nWe looked at 60 properties.  \r\nHis knowledge and input from the beginning to the closing was very beneficial. \r\nI highly recommend him.  ', 'Robert McAllister', 1),
(22, 1, 'This company is amazing', 'Brad Binkley from Binkley IT Consulting highly recommends Eagle Business Brokers...', 'Brad Binkley', 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uId` int(10) UNSIGNED NOT NULL,
  `companyId` int(11) NOT NULL,
  `userName` varchar(50) DEFAULT NULL,
  `alias` varchar(50) DEFAULT NULL,
  `password` varchar(250) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`uId`, `companyId`, `userName`, `alias`, `password`, `email`, `status`) VALUES
(1, 1, 'Adminstrator', NULL, 'e10adc3949ba59abbe56e057f20f883e', 'balu.m.v@gmail.com', 0),
(2, 1, 'George', NULL, 'aa65ddc8387a1a1f7bd9cf52712ef51b', 'gfalcon55@gmail.com', 1),
(3, 1, 'Mathew', NULL, '9fee3456c0c553feb25a41e14c6cd884', 'meabraham@msn.com', 1),
(4, 1, 'Taylor', NULL, '53338f5791e1ae57d419a1e471ef381e', 'borentaylor05@gmail.com', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blogs`
--
ALTER TABLE `blogs`
  ADD PRIMARY KEY (`blogId`);

--
-- Indexes for table `brokers`
--
ALTER TABLE `brokers`
  ADD PRIMARY KEY (`brokerId`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`companyId`);

--
-- Indexes for table `listings`
--
ALTER TABLE `listings`
  ADD PRIMARY KEY (`listingId`);

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`newsId`);

--
-- Indexes for table `offices`
--
ALTER TABLE `offices`
  ADD PRIMARY KEY (`officeId`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resources`
--
ALTER TABLE `resources`
  ADD PRIMARY KEY (`resourceId`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`settingsId`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`testimonialId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uId`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blogs`
--
ALTER TABLE `blogs`
  MODIFY `blogId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `brokers`
--
ALTER TABLE `brokers`
  MODIFY `brokerId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `companyId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `listings`
--
ALTER TABLE `listings`
  MODIFY `listingId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=114;

--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `newsId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `offices`
--
ALTER TABLE `offices`
  MODIFY `officeId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=307;

--
-- AUTO_INCREMENT for table `resources`
--
ALTER TABLE `resources`
  MODIFY `resourceId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `settingsId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `testimonialId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
