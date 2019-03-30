<?php

/* setup file for the IMAP mini mail plugin
 * Copyright (c) 1999-2002 The SquirrelMail Project Team
 * Licensed under the GNU GPL. For full terms see the file COPYING.
 *   
 * by: Jason Munro jason@stdbev.com
 *
 */


/* setup plugin hooks */
function squirrelmail_plugin_init_mini() {
    global $squirrelmail_plugin_hooks;
    $squirrelmail_plugin_hooks['left_main_before']['mini'] = 'mini_link';
    $squirrelmail_plugin_hooks['options_display_inside']['mini'] = 'mini_options';
    $squirrelmail_plugin_hooks['loading_prefs']['mini'] = 'load_mini_settings';
    $squirrelmail_plugin_hooks['options_display_save']['mini'] = 'save_mini_settings';
}

/* load settings from pref file */
function load_mini_settings () {
    global $username, $data_dir, $mini_width, $mini_height, $mini_refresh, $mini_text_size;
    $mini_width = getPref($data_dir, $username, 'mini_width', '380');
    $mini_height = getPref($data_dir, $username, 'mini_height', '240');
    $mini_refresh = getPref($data_dir, $username, 'mini_refresh', '0');
    $mini_text_size = getPref($data_dir, $username, 'mini_text_size', '1');
}

/* save settings to pref file */
function save_mini_settings() {
    global $username, $data_dir;
    if ( (float)substr(PHP_VERSION,0,3) < 4.1 ) {
        global $_POST;
    }
    if (isset($_POST['mini_width'])) {
        setPref($data_dir, $username, 'mini_width', $_POST['mini_width']);
    }
    else {
        setPref($data_dir, $username, 'mini_width', '380');
    }
    if (isset($_POST['mini_height'])) {
        setPref($data_dir, $username, 'mini_height', $_POST['mini_height']);
    }
    else {
        setPref($data_dir, $username, 'mini_height', '240');
    }
    if (isset($_POST['mini_refresh'])) {
        setPref($data_dir, $username, 'mini_refresh', $_POST['mini_refresh']);
    }
    else {
        setPref($data_dir, $username, 'mini_refresh', '0');
    }
    if (isset($_POST['mini_text_size'])) {
        setPref($data_dir, $username, 'mini_text_size', $_POST['mini_text_size']);
    }
    else {
        setPref($data_dir, $username, 'mini_text_size', '1');
    }
    
}

/* options located in Options->Display Preferences */
function mini_options() {
    global $username, $data_dir, $mini_width, $mini_height, $mini_refresh, $mini_text_size;
    echo "<tr><td align=right valign=top>\n".
         "Mini SquirrelMail window width (pixels)</td><td><input type=text size=\"4\" ".
         "name=\"mini_width\" value=\"";
        if ($mini_width > 1024) {
           echo '1024';
        }
        elseif (empty($mini_width)) {
            echo '380';
        }
        else {
            echo $mini_width;
        } 
        echo "\"></td></tr>";
    echo "<tr><td align=right valign=top>\n".
         "Mini SquirrelMail window height (pixels)</td><td><input type=text size=\"4\" ".
         "name=\"mini_height\" value=\"";
        if ($mini_height > 768) {
           echo '768';
        }
        elseif (empty($mini_height)) {
            echo '240';
        }
        else {
            echo $mini_height;
        } 
        echo "\"></td></tr>";
    echo "<tr><td align=right valign=top>\n".
         "Mini SquirrelMail window refresh</td><td><select name=\"mini_refresh\">";
         $refresh_options = array('30' => '30 seconds',
                                  '60' => '1 minute', '90' => '1.5 minutes',
                                  '120' => '2 minutes', '180' => '2.5 minutes',
                                  '210' => '3 minutes', '240' => '3.5 minutes',
                                  '270' => '4 minutes', '300' => '4.5 minutes',
                                  '330' => '5 minutes', '0' => 'never');

    foreach($refresh_options as $index=>$value) {
        echo "<option value=\"$index\" ";
        if ($index == $mini_refresh) {
            echo 'SELECTED ';
        }
        echo ">$value</option>\n";
    }
    echo "</select></td></tr>\n";
    echo "<tr><td align=right valign=top>Mini SquirrelMail text size</td>".
         "<td><select name=\"mini_text_size\">\n".
         "<option value=\"2\"";
    if ($mini_text_size == '2') {
        echo ' SELECTED ';
    }
    echo ">Normal</option>\n".
         "<option value=\"1\"";
    if ($mini_text_size == '1') {
        echo ' SELECTED ';
    }
    echo ">Small</option>\n".
         "<option value=\"0\"";
    if ($mini_text_size == '0') {
        echo ' SELECTED ';
    }
    echo ">Very Small</option>\n".
          "</select></td></tr>\n";
}

/* link on the left frame for mini window */
function mini_link () {
    global $mini_width, $mini_height;
    echo "<script><!--\n";
    echo "function javapop(){\n";
    echo "newwin=window.open('../".
         "plugins/mini/mini.php','javabox','width=";
    if ($mini_width > 0 && $mini_width < 1024) {
        echo "$mini_width";
    }
    else {
        echo '380';
    }
    echo ",height=";
    if ($mini_height > 0 && $mini_height < 768) {
        echo "$mini_height";
    }
    else {
        echo '240';
    }
    echo ",scrollbars=yes,resizable=yes')}\n";
    echo "//--></script>\n";
    echo "<center><small><a href=\"javascript:void(0)\" ".
          "Onclick=\"javapop()\" ".
          ">mini window</a></small></center><br>\n";
}

?>
