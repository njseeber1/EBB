<?php

/*
   WOT: Image Buttons plugin (GPL v2)
   WEN: Mon Sep  1 21:58:59 MDT 2003
   WHY: To display image links rather than text links on the top menu bar
   WHO: Brad Donison <bucovina@users.sourceforge.net>
*/

// include compatibility plugin
if (defined('SM_PATH')) {
    include_once(SM_PATH . 'plugins/compatibility/functions.php');
    include_once(SM_PATH . 'functions/options.php');
    include_once(SM_PATH . 'plugins/image_buttons/config.php');
} else {
    if (file_exists('../plugins/compatibility/functions.php'))
        include_once('../plugins/compatibility/functions.php');
    else if (file_exists('./plugins/compatibility/functions.php'))
        include_once('./plugins/compatibility/functions.php');
    include_once('../functions/options.php');
    include_once('../plugins/image_buttons/config.php');
}

function image_buttons_do ($args) {
    global $username, $data_dir, $image_buttons_type, $image_buttons_select,
           $image_buttons_img, $image_buttons_size, $image_buttons_cache,
           $image_buttons_sitetype, $image_buttons_sitesize,
           $image_buttons_sitecache, $REQUEST_URI;

    if ($image_buttons_select > 0) {
        $image_buttons_type = getPref($data_dir, $username, 'image_buttons_type');
        $image_buttons_size = getPref($data_dir, $username, 'image_buttons_size');
        $image_buttons_cache = getPref($data_dir, $username, 'image_buttons_cache');
    } else {
        $image_buttons_type = $image_buttons_sitetype;
        $image_buttons_size = $image_buttons_sitesize;
        $image_buttons_cache = $image_buttons_sitecache;
    }

    if ((!isset($GLOBALS['image_buttons_type'])) ||
        ($GLOBALS['image_buttons_type'] == '') ||
        ($GLOBALS['image_buttons_type'] == 'plain')) {
        if (is_array($args)) {
            return $args[0];
        } else {
            return $args;
        }
    }

    if (is_array($args)) {
        $mypath = $args[1];
    } else {
        $mypath = $REQUEST_URI;
    }
    $linktext = 0;
    if (!stristr($mypath, 'passed_id=')) {
        if (stristr($mypath, 'compose.php')) {
            if (stristr($mypath, 'compose.php?mailbox=')) {
                $linktext = 1;
            }
        } else {
            $linktext = 1;
        }
    }

    if ($linktext > 0) {
        sqgetGlobalVar('base_uri', $base_uri, SQ_SESSION);
        if (is_array($args)) {
            $text = $args[0];
            $path = preg_replace("/\?.*$/", '', $args[1]);
        } else {
            $text = $args;
            $path = '';
        }

        $iconfile = '';
        if (($GLOBALS['image_buttons_type'] == 'icons') ||
            ($GLOBALS['image_buttons_type'] == 'texticons')) {
            $iconslot = preg_replace("/^.*\//", '', $path);
            if (isset($image_buttons_img["$iconslot"])) {
               $img_filename = $image_buttons_img["$iconslot"];
               if ($img_filename != '') {
                   $iconfile = $img_filename;
               }
            }
        }

        if (($iconfile != '') &&
            (!file_exists(SM_PATH . 'plugins/image_buttons/images/' . $iconfile))) {
            $iconfile = '';
        }
        if ($iconfile != '') {
            $iburl = $base_uri . 'plugins/image_buttons/images/' . $iconfile;
            $button = '<img src="' . $iburl . '" border="0" alt="' . $text .
                      '" title="' . $text . '">';
        } else {
            $iburl = $base_uri . 'plugins/image_buttons/create_button.php';
            $button = '<img src="' . $iburl . '?button_text=' . $text .
                      '" border="0" alt="' . $text . '">';
        }
        if (($GLOBALS['image_buttons_type'] == 'texticons') &&
            ($iconfile != '')) {
            if ($GLOBALS['image_buttons_size'] == 'small') {
                $newtext = "<font size=2>$text</font>";
            } elseif ($GLOBALS['image_buttons_size'] == 'medium') {
                $newtext = "<font size=3>$text</font>";
            } elseif ($GLOBALS['image_buttons_size'] == 'large') {
                $newtext = "<font size=4>$text</font>";
            } else {
                $newtext = $text;
            }
            if ($GLOBALS['languages']['DIR'] == 'rtl') {
                return "$newtext$button";
            }
            return "$button$newtext";
        } else {
            return $button;
        }
    } else {
        return $text;
    }
}

function image_buttons_display() {
    global $username, $data_dir, $image_buttons_type, $image_buttons_size,
           $image_buttons_cache, $optpage_blocks, $image_buttons_cacheoption;

    $optpage_blocks[] = array(
        'name' => _("Image Buttons"),
        'refresh' => SMOPT_REFRESH_ALL
    );

    $image_buttons_type = getPref($data_dir, $username, 'image_buttons_type', '');
    $image_buttons_size = getPref($data_dir, $username, 'image_buttons_size', '');
    $image_buttons_cache = getPref($data_dir, $username, 'image_buttons_cache', '');

    $dalign = 'valign="middle" align="right"';
    $oalign = 'valign="middle"';
    $ralign = '';
    echo '<tr><td colspan="2" align=center valign=middle><br><b>'
       . _("Graphical Menu Bar") . "</b></td></tr>\n\n";
    echo "<tr $ralign>" .
         html_tag('td', _("Type of Images:"), 'right', '', '') . "\n"

       . "<td $oalign>" . '<select name="new_image_buttons_type">'
       . '<option value="plain"';
    if ($image_buttons_type == 'plain' || $image_buttons_type == '') echo ' selected';
    echo '>' . _("Off") . '</option>'
       . '<option value="icons"';
    if ($image_buttons_type == 'icons') echo ' selected';
    echo '>' . _("Icons") . '</option>'
       . '<option value="texticons"';
    if ($image_buttons_type == 'texticons') echo ' selected';
    echo '>' . _("Icons with Text") . '</option>'
       . '<option value="textbuttons"';
    if ($image_buttons_type == 'textbuttons') echo ' selected';
    echo '>' . _("Buttons") . '</option>';
    echo '</select></td></tr>' . "\n\n";

    echo "<tr $ralign>" .
         html_tag('td', _("Text Size:"), 'right', '', '') . "\n"
       . "<td $oalign>" . '<select name="new_image_buttons_size">'
       . '<option value="theme"';
    if ($image_buttons_size == 'theme') echo ' selected';
    echo '>' . _("Default") . '</option>'
       . '<option value="small"';
    if ($image_buttons_size == 'small') echo ' selected';
    echo '>' . _("small") . '</option>'
       . '<option value="medium"';
    if ($image_buttons_size == 'medium') echo ' selected';
    echo '>' . _("medium") . '</option>'
       . '<option value="large"';
    if ($image_buttons_size == 'large') echo ' selected';
    echo '>' . _("large") . "</option>";

    if ($image_buttons_cacheoption > 0) {
      echo '</select></td></tr>' . "\n";

      echo "<tr $ralign>" .
           html_tag('td', _("Cache Buttons locally:"), 'right', '', '') . "\n"
         . "<td $oalign>" . '<input type="radio" value="yes" name="new_image_buttons_cache" ';
      if ($image_buttons_cache == 'yes' || $image_buttons_cache == '') echo 'CHECKED';
      echo '>&nbsp;' . _("Yes") . "\n"
         . '&nbsp;&nbsp;<input type="radio" value="no" name="new_image_buttons_cache" ';
      if ($image_buttons_cache == 'no') echo 'CHECKED';
      echo '>&nbsp;' . _("No") . "\n";
    }
    echo '</select></td></tr><tr><td><br></td></tr>' . "\n";
}

function image_buttons_save() {
    global $username, $data_dir, $image_buttons_type, $image_buttons_size,
           $image_buttons_cache, $new_image_buttons_type,
           $new_image_buttons_size, $new_image_buttons_cache;

    compatibility_sqextractGlobalVar('new_image_buttons_type');
    compatibility_sqextractGlobalVar('new_image_buttons_size');
    compatibility_sqextractGlobalVar('new_image_buttons_cache');

    setPref($data_dir, $username, 'image_buttons_type', $new_image_buttons_type);
    setPref($data_dir, $username, 'image_buttons_size', $new_image_buttons_size);
    setPref($data_dir, $username, 'image_buttons_cache', $new_image_buttons_cache);
}


function image_buttons_prefs() {
    global $username, $data_dir, $image_buttons_type, $image_buttons_size,
           $image_buttons_cache;

    $image_buttons_type = getPref($data_dir, $username, 'image_buttons_type');
    $image_buttons_size = getPref($data_dir, $username, 'image_buttons_size');
    $image_buttons_cache = getPref($data_dir, $username, 'image_buttons_cache');
}

?>
