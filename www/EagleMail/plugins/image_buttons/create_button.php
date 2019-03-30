<?php

/*
   WOT: Menu Buttons plugin
   WEN: Mon Sep  1 21:58:59 MDT 2003
   WHY: To display image links rather than text links on the top menu bar
   WHO: Brad Donison <bucovina@users.sourceforge.net>
*/


    // Path for SquirrelMail required files.
    define('SM_PATH','../../');

    // include compatibility plugin
    include_once(SM_PATH . 'plugins/compatibility/functions.php');
    if (file_exists(SM_PATH . 'include/validate.php')) {
        include_once(SM_PATH . 'include/validate.php');
    } else {
        include_once(SM_PATH . 'src/validate.php');
    }
    include_once(SM_PATH . 'plugins/image_buttons/config.php');

    global $color, $image_buttons_size, $image_buttons_cache, $image_buttons_select,
           $image_buttons_sitesize, $image_buttons_sitecache;

    if ($image_buttons_select > 0) {
        $image_buttons_size = getPref($data_dir, $username, 'image_buttons_size');
        $image_buttons_cache = getPref($data_dir, $username, 'image_buttons_cache');
    } else {
        $image_buttons_size = $image_buttons_sitesize;
        $image_buttons_cache = $image_buttons_sitecache;
    }

    // grab colours from pref and text string from GET
    $background_color_get = $color[3];
    $text_color_get       = $color[6];
    $string               = $_GET['button_text'];

    header("Content-Type: image/png");
    header("Content-Disposition: filename=$string.png"); 

    // send headers to browser - allow caching
    if (($image_buttons_cache == 'yes') || ($image_buttons_cache == '')) {
        header("Last-Modified: " . gmdate("D, d M Y H:i:s", mktime (0, 0, 0, 9, 1, 2003)) . " GMT");   
        header("Expires: Mon, 29 Jun 2021 07:35:00 GMT");
        header("Cache-Control: max-age=10000000, s-maxage=1000000, proxy-revalidate, must-revalidate");
    }

    // figure out dimensions of the button
    if ($image_buttons_size == 'small') {
        $image_buttons_size = 3;
    } elseif ($image_buttons_size == 'medium') {
        $image_buttons_size = 4;
    } elseif ($image_buttons_size == 'large') {
        $image_buttons_size = 5;
    } else {
        $image_buttons_size = 4;
    }

    $chars = strlen($string);
    $strwidth = ImageFontWidth($image_buttons_size) * $chars;
    $strheight = ImageFontHeight($image_buttons_size);
    $img_width = $strwidth + 8;
    $img_height = $strheight + 2;
    $img_center_x = $img_width /2;
    $img_center_y = $img_height /2;

    // create the image
    $id = ImageCreate($img_width, $img_height);

    // parse colours into RGB values
    list($red, $green, $blue) = ConvertColor($background_color_get);
    $yellow = ImageColorAllocate($id, $red, $green, $blue);
    list($red, $green, $blue) = ConvertColor($text_color_get);
    $text_color = ImageColorAllocate($id, $red, $green, $blue);

    $black = ImageColorAllocate($id, 0, 0, 0);
    $white = ImageColorAllocate($id, 255, 255, 255);
    $trans = ImageColorTransparent($id, $white);

    ImageFill($id, 0, 0, $white);

    // left end corner
    ImageArc($id, 10, $img_center_y, 20, $strheight + 5, 90, 270, $black);

    // right end corner
    ImageArc($id, $img_width - 9.5, $img_center_y, 20, $strheight + 5, 270, 90, $black);

    // top edge
    ImageLine($id, 7, 0, ($img_width - 7), 0, $black);

    // bottom edge
    ImageLine($id, 7, $img_height - 1, ($img_width - 7), $img_height - 1, $black);

    // fill the inside of the button
    ImageFillToBorder($id, $img_center_x, $img_center_y, $black, $yellow);

    // write the text in the button
    ImageString($id, $image_buttons_size, ($img_center_x - ($strwidth / 2) + 1),
                ($img_center_y - ($strheight / 2) - 1), $string, $text_color);

    // send out the image
    ImagePng($id);


function ConvertColor($hexVal){

    $ColorVal = array(3);

    for ($i = 0; $i < 3; $i++) {
        $ColorVal[$i] = HexDec(substr($hexVal, $i * 2, 2));
    }
    return $ColorVal;
}
?>
