<?php
/* left_css -- Version 0.2
 * By Robin Rainton <robin@rainton.com>
 * http://rainton.com/fun/freeware
 *
 */

function squirrelmail_plugin_init_left_css() {
  global $squirrelmail_plugin_hooks;
  $squirrelmail_plugin_hooks['loading_prefs']['left_css'] =
    'left_css_set_style';
  $squirrelmail_plugin_hooks['options_display_inside']['left_css'] =
    'left_css_options';
  $squirrelmail_plugin_hooks['options_display_save']['left_css'] =
    'left_css_save';
}

/*
 * Function to add an override stylesheet if the user pref is set.
 */

function left_css_set_style()
{
  global $username, $data_dir, $custom_css;

  if (substr($_SERVER["PHP_SELF"], -14) == "/left_main.php" &&
      ($override_css = getPref($data_dir, $username, 'left_css')) &&
      $override_css != "")
  {
    $custom_css = $override_css;
  }
}

/*
 * Here come the few functions for preference handling.
 */

function left_css_options()
{
  global $username, $data_dir;
  $override_css = getPref($data_dir, $username, 'left_css');

  echo '<tr><td align=right nowrap valign="top">' .
       _("Custom Stylesheet") . ' (' . _("Left Frame") . '):</td><td>' .
       '<select name="left_css_css"><option value="">' .
       _("As Right Frame") . '</option>';

  $dh = opendir('../themes/css/');
  while ($file = readdir($dh))
  {
    if (substr($file, -4 ) == '.css' )
    {
      echo '<option value="' . $file . '"';
      if ($override_css == $file)
      {
        echo ' SELECTED';
      }
      echo '>' . substr($file, 0, strlen($file) - 4) . '</option>' . "\n";
    }
  }
  closedir($dh);

  echo '</select></td></tr>';
}

function left_css_save()
{
  global $username, $data_dir;

  if (isset($_POST['left_css_css']))
    setPref($data_dir, $username, "left_css",
            $_POST['left_css_css']);
}

?>
