<?php


// include compatibility plugin
//
if (defined('SM_PATH'))
   include_once(SM_PATH . 'plugins/compatibility/functions.php');
else if (file_exists('../plugins/compatibility/functions.php'))
   include_once('../plugins/compatibility/functions.php');
else if (file_exists('./plugins/compatibility/functions.php'))
   include_once('./plugins/compatibility/functions.php');



function plugin_autocomplete_compose_bottom_do()
{
   global $autocomplete_enabled;
   global $autocomplete_insensitive;


   if ($autocomplete_enabled == "None")
      return;

   if (compatibility_check_sm_version(1, 3))
      include_once (SM_PATH . 'functions/addressbook.php');
   else
      include_once ('../functions/addressbook.php');

   // Open addressbook without error messages and without LDAP
   $abook = addressbook_init(false, true);
   if ($abook->localbackend == 0)
      // No personal address book is defined
      return;

   $alist = $abook->list_addr();
   if (! is_array($alist))
      // Some sort of error
      return;

   $addrs = array();

   // Nicknames
   if ($autocomplete_enabled == 'Both' || $autocomplete_enabled == 'Alias') {
      foreach ($alist as $val) {
         $addrs[] = addcslashes($val['nickname'].' <'.trim($val['email']).'>', '"');
      }
   }

   // Emails
   if ($autocomplete_enabled == 'Both' || $autocomplete_enabled == 'Email') {
      foreach ($alist as $val) {
         $addrs[] = addcslashes($val['name'].' <'.trim($val['email']).'>', '"');
      }
   }

   // If we don't have a list, do not spit out the javascript
   // (saves download time)
   if (count($addrs) == 0)
      return;

   // Now we have a big list of things we want to autocomplete.
   sort($addrs);

   // Spit out javascript
   echo '<script language="Javascript">
var autocompleteArray = new Array("' . join("\",\n\"", $addrs) . '");

function autocomplete_find (str) {
   var l = autocompleteArray.length;
   var strl = str.length;
   var sValue = "";
   var lastMatch = "";
   var matched = 0;
   for (var i = 0; i < l; i ++) {
      sValue = autocompleteArray[i];
';
if ($autocomplete_insensitive)
   echo '      // Case insensitive compare
      if (sValue.substring(0, strl).toLowerCase() == str.toLowerCase()) {
';
else
   echo '      // Case sensitive compare
      if (sValue.substring(0, strl) == str) {
';
   echo '         if (matched++ == document.acOffset) {
            return sValue;
         } else {
            lastMatch = sValue;
         }
      } else if (lastMatch != "") {
         // We have gone past the last matching string
         --document.acOffset;
         return lastMatch;
      }
   }
   return "";
}

function autocomplete_core (src) {
   // kinda support multiple addresses
   var r1 = src.createTextRange();
   var Str = r1.text;
   var StartPos = 0;
   var newSP = Str.lastIndexOf(", ");
   if (newSP >= StartPos) {
      StartPos = newSP + 2;
   }

   // do not search for nothing
   if (Str.length - StartPos <= 0)
      return;

   // If we can find something in our lookup list
   newValue = autocomplete_find(Str.substr(StartPos, Str.length));
   if (newValue == "" || newValue == Str.substr(StartPos, Str.length))
      return;

   newValue = Str.substr(0, StartPos) + newValue;
   var pos = Str.length;
   src.value = newValue;
   var rNew = src.createTextRange();
   rNew.moveStart("character", pos);
   rNew.select();
   src._value = src.value;
   document.acMatch = Str;
}

function autocomplete_work (src) {
   if (! src.createTextRange)
      return;

   // Ignore cursor keys, shift, alt, etc
   // look only for A-Z, 0-9, etc.
   if (event.keyCode < 48 || (event.keyCode > 57 && event.keyCode < 65) ||
       (event.keyCode > 90 && event.keyCode < 96) || event.keyCode == 108 ||
       (event.keyCode > 111 && event.keyCode < 186) ||
       (event.keyCode > 192 && event.keyCode < 219) || event.keyCode > 222)
      return;

   // If there is no change in the field, ignore
   if (src.value == src._value)
      return;
   autocomplete_core(src);
}

function autocomplete_scroll(src) {
   if (isNaN(document.acOffset))
      document.acOffset = 0;
   if (event.keyCode == 38 || event.keyCode == 40) {
      if (document.acMatch != "") {
         if (event.keyCode == 40) {
            ++document.acOffset;
         } else if (document.acOffset > 0) {
            --document.acOffset;
         }
         src.value = document.acMatch;
         autocomplete_core(src);
      } else {
         document.acOffset = 0;
      }
      event.returnValue = false;
   } else {
      document.acOffset = 0;
      document.acMatch = "";
   }
}
</script>
<script FOR=send_to EVENT=onkeydown>
autocomplete_scroll(this);
</script>
<script FOR=send_to EVENT=onkeyup>
autocomplete_work(this)
</script>
<script FOR=send_to_cc EVENT=onkeydown>
autocomplete_scroll(this);
</script>
<script FOR=send_to_cc EVENT=onkeyup>
autocomplete_work(this)
</script>
<script FOR=send_to_bcc EVENT=onkeydown>
autocomplete_scroll(this);
</script>
<script FOR=send_to_bcc EVENT=onkeyup>
autocomplete_work(this)
</script>
';
}

function plugin_autocomplete_display_inside_do()
{
   global $username,$data_dir, $version;
   global $autocomplete_enabled, $autocomplete_insensitive;

   echo "<tr><td align=right valign=top>\n";
   echo _("Autocomplete") . ":</td>\n";
   echo "<td><select name=autocomplete_enabled_i>";
   echo "<option value=None";
   if ($autocomplete_enabled == "None")
      echo " SELECTED";
   echo ">" . _("Do not use autocomplete") . "</option>\n";
   if (substr($version, 0, 4) != '1.0.' || substr($version, 0, 2) == '0.') {
      echo "<option value=Alias";
      if ($autocomplete_enabled == "Alias")
         echo " SELECTED";
      echo ">" . _("Address book nicknames") . "</option>\n";
   }
   echo "<option value=Email";
   if ($autocomplete_enabled == "Email")
      echo " SELECTED";
   echo ">" . _("Address book full names") . "</option>\n";
   if (substr($version, 0, 4) != '1.0.' || substr($version, 0, 2) == '0.') {
      echo "<option value=Both";
      if ($autocomplete_enabled == "Both")
         echo " SELECTED";
      echo ">" . _("Both nicknames and full names") . "</option>\n";
   }
   echo "</select> (" . _("IE only") . ")<br>\n";
   echo "<input type=checkbox name=autocomplete_insensitive_i";
   if ($autocomplete_insensitive)
      echo " CHECKED";
   echo "> " . _("Use case-insensitive searches");
   echo "</td></tr>\n";
}

function plugin_autocomplete_display_save_do()
{
   global $username,$data_dir;
   global $autocomplete_enabled_i, $autocomplete_insensitive_i;

   compatibility_sqextractGlobalVar('autocomplete_enabled_i');
   compatibility_sqextractGlobalVar('autocomplete_insensitive_i');

   if (isset($autocomplete_enabled_i)) {
      setPref($data_dir, $username, 'autocomplete_enabled',
         $autocomplete_enabled_i);
   } else {
      setPref($data_dir, $username, 'autocomplete_enabled', '');
   }
   if (isset($autocomplete_insensitive_i)) {
      setPref($data_dir, $username, 'autocomplete_insensitive', 1);
   } else {
      setPref($data_dir, $username, 'autocomplete_insensitive', 0);
   }
}


function plugin_autocomplete_loading_prefs_do()
{
   global $username,$data_dir, $version;
   global $autocomplete_enabled, $autocomplete_insensitive;

   $autocomplete_enabled = getPref($data_dir, $username,
      'autocomplete_enabled');

   $autocomplete_insensitive = getPref($data_dir, $username,
      'autocomplete_insensitive');


   if ($autocomplete_enabled == '')
      $autocomplete_enabled = 'Alias';

   if ((substr($version, 0, 4) == "1.0." || substr($version, 0, 2) == '0.') &&
       ($autocomplete_enabled == 'Alias' || $autocomplete_enabled == 'Both'))
      $autocomplete_enabled = 'Email';


   if ($autocomplete_insensitive == '')
      $autocomplete_insensitive = 0;
}


?>
