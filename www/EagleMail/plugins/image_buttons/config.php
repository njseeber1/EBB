<?php
global $image_buttons_select, $image_buttons_img, $image_buttons_size,
       $image_buttons_sitetype, $image_buttons_sitesize, $image_buttons_sitecache;

// Set image_buttons_select to 1 to allow users to turn the buttons
// on and off via the display preferences. Set it to 0 to force
// the site wide settings.

$image_buttons_select = 1;

// NOTE: If you want to force a certain type of menu bar be default
// then you can populate modify the default_pref file in the data
// directory by adding the lines relevant for this plugin, such as:

// image_buttons_type=texticons
// image_buttons_size=small
// image_buttons_cache=no

// Valid values for "image_buttons_type" are: plain, icons, texticons
// and textbuttons.
// Valid values for "image_buttons_size" are: theme, small, medium and large.
// Valid values for "image_buttons_cache" are: yes and no.

if ($image_buttons_select == '0') {
    // If you wish to force site wide prefs rather than user chosen
    // prefs then the following are the prefs that will be used.
    $image_buttons_sitetype = 'texticons';
    $image_buttons_sitesize = 'theme';
    $image_buttons_sitecache = 'yes';
}

// In some circumstances the option to cache the buttons is irrelivant.
// If that is the case with your installation, then set this to 0.
$image_buttons_cacheoption = 1;

// The following settings are locations of the images you wish to use
// for each button. If they are empty, then this plugin will generate
// an image for you. The vars should be set to be the filename of the
// image in the images directory that you wish to use for that button.

$image_buttons_img['compose.php']     = "new.gif";
$image_buttons_img['addressbook.php'] = "abook.gif";
$image_buttons_img['folders.php']     = "folders.gif";
$image_buttons_img['options.php']     = "options.gif";
$image_buttons_img['search.php']      = "search.gif";
$image_buttons_img['help.php']        = "help.gif";
$image_buttons_img['signout.php']     = "signout.gif";

// add more here for each plugin that is registered for the menu
$image_buttons_img['calendar_check.php'] = "cal.gif";
$image_buttons_img['year.php']           = "year.gif";
$image_buttons_img['calendar.php']       = "month.gif";
$image_buttons_img['day.php']            = "day2.gif";
$image_buttons_img['fetch.php']          = "fetch.gif";
$image_buttons_img['utils.php']          = "utilities.gif";
$image_buttons_img['bug_report.php']     = "bugs.gif";
$image_buttons_img['table.php']          = "Coffeefilter.gif";
$image_buttons_img['right_main.php']     = "readmail.gif";
?>
