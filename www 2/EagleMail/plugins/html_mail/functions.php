<?php


   // include compatibility plugin
   //
   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/compatibility/functions.php');
   else if (file_exists('../plugins/compatibility/functions.php'))
      include_once('../plugins/compatibility/functions.php');
   else if (file_exists('./plugins/compatibility/functions.php'))
      include_once('./plugins/compatibility/functions.php');




function html_mail_header_do()
{

   // get global variable for versions of PHP < 4.1
   //
   if (!compatibility_check_php_version(4,1)) {
      global $HTTP_SERVER_VARS;
      $_SERVER = $HTTP_SERVER_VARS;
   }

   if (stristr($_SERVER['SCRIPT_NAME'], 'compose.php'))
      html_mail_turn_on_htmlarea();

}


function html_mail_turn_on_htmlarea() 
{

   global $languageFile, $customStyle, $use_spell_checker;

   if (compatibility_check_sm_version(1, 3))
      include_once (SM_PATH . 'plugins/html_mail/config.php');
   else
      include_once ('../plugins/html_mail/config.php');


   // turn it on if supported/turned on
   //
   if (html_area_is_on_and_is_supported_by_users_browser())
   {

      if (compatibility_check_sm_version(1, 3))
      {
         echo '<script language="javascript" type="text/javascript" src="' . SM_PATH . 'plugins/html_mail/htmlarea/htmlarea.js"></script>'
            . '<script language="javascript" type="text/javascript" src="' . SM_PATH . 'plugins/html_mail/htmlarea/dialog.js"></script>';

         if ($use_spell_checker)
         {
            echo '<script language="javascript" type="text/javascript" src="' . SM_PATH . 'plugins/html_mail/htmlarea/plugins/SpellChecker/spell-checker.js"></script>'
               . '<script language="javascript" type="text/javascript" src="' . SM_PATH . 'plugins/html_mail/htmlarea/plugins/SpellChecker/lang/en.js"></script>';
         }

         echo '<script language="javascript" type="text/javascript" src="' . SM_PATH . 'plugins/html_mail/htmlarea/lang/' . $languageFile . '"></script>'
            . '<style type="text/css">@import url("' . SM_PATH . 'plugins/html_mail/htmlarea/htmlarea.css");</style>'
            . '<script language="javascript" type="text/javascript">' . "\n"
            . '<!--' . "\n"
            . 'var _editor_url = "' . SM_PATH . 'plugins/html_mail/htmlarea/"';
      }
      else
      {
         echo '<script language="javascript" type="text/javascript" src="../plugins/html_mail/htmlarea/htmlarea.js"></script>'
            . '<script language="javascript" type="text/javascript" src="../plugins/html_mail/htmlarea/dialog.js"></script>';

         if ($use_spell_checker)
         {
            echo '<script language="javascript" type="text/javascript" src="../plugins/html_mail/htmlarea/plugins/SpellChecker/spell-checker.js"></script>'
               . '<script language="javascript" type="text/javascript" src="../plugins/html_mail/htmlarea/plugins/SpellChecker/lang/en.js"></script>';
         }

         echo '<script language="javascript" type="text/javascript" src="../plugins/html_mail/htmlarea/htmlarea/lang/"' . $languageFile . '"></script>'
            . '<style type="text/css">@import url("../plugins/html_mail/htmlarea/htmlarea.css");</style>'
            . '<script language="javascript" type="text/javascript">' . "\n"
            . '<!--' . "\n"
            . 'var _editor_url = "../plugins/html_mail/htmlarea/"';
      }

      ?>

         var editor = null;
         function initEditor() 
         {

            var config = new HTMLArea.Config();

            //=================================================
            // any other editor customizations here...
            //=================================================
            <?php 
               if (!empty($customStyle)) 
                  echo 'config.pageStyle = "' . $customStyle . '";';
            ?>



// TODO: ideally, this requires change to src/compose.php --> textarea needs an "id" 
//       attribute called "body", but this will work in most cases without it
            editor = new HTMLArea("body", config);


      <?php if ($use_spell_checker) { ?>

            // register the SpellChecker plugin
            //
            editor.registerPlugin("SpellChecker");

      <?php } ?>

            editor.generate();

         }
         //-->
         </script>

      <?php

   }  // End Added For htmlarea

}


function html_mail_footer() 
{

   // insert javascript that actually replaces the text area, but only if supported/turned on
   //
   if (html_area_is_on_and_is_supported_by_users_browser())
   {

      // replace newlines with <br>'s in body
      //
      echo '<script language="javascript" type="text/javascript">' . "\n<!--\n"
         . 'newBody=""; oldBody = document.compose.body.value; for (i=0; i<oldBody.length; i++) { if (oldBody.charAt(i) == "\n") newBody+="<br>"; else newBody+=oldBody.charAt(i); document.compose.body.value=newBody; }'
         . "\n// -->\n</script>";


      // actually replace the regular text area 
      //
      echo '<script DEFER language="javascript" type="text/javascript">initEditor();</script>' . "\n";
// the following replaces all textareas on the page w/out needing to know any IDs
//      echo '<script DEFER language="javascript" type="text/javascript">HTMLArea.replaceAll();</script>' . "\n";
// alternative way to replace just one known textarea, but our way is better cuz we get a 
// local variable with a reference to it
// i think this is wrong, isn't the function called replace() in this case?
//      echo '<script DEFER language="javascript" type="text/javascript">HTMLArea.replaceAll("body");</script>' . "\n";

   }

}


function html_mail_emoticons_do()
{

   global $username, $data_dir, $allowEmoticons, $use_emoticons;

   if (compatibility_check_sm_version(1, 3))
      include_once (SM_PATH . 'plugins/html_mail/config.php');
   else
      include_once ('../plugins/html_mail/config.php');

   if ($allowEmoticons && html_area_is_on_and_is_supported_by_users_browser())
   {

      $use_emoticons = getPref($data_dir, $username, 'compose_window_use_emoticons', '');

      if ($use_emoticons)
         insert_emoticons();

   }

}


// turn off squirrelspell when the user is composing 
// HTML-formatted email, since squirrelspell will
// choke on the HTML
//
function html_mail_disable_squirrelspell_do()
{

   global $squirrelmail_plugin_hooks;

   if (html_area_is_on_and_is_supported_by_users_browser() 
      && !empty($squirrelmail_plugin_hooks['compose_button_row']['squirrelspell']))
   {
      unset($squirrelmail_plugin_hooks['compose_button_row']['squirrelspell']);
   }

}


function html_area_is_on_and_is_supported_by_users_browser()
{

   global $username, $data_dir;

   $type = getPref($data_dir, $username, 'compose_window_type');

   list($browser, $browserVersion) = getBrowserType();

   // NOTE: htmlarea 3 supports mozilla 1.4 and up... we'll 
   //       assume they meant gecko and not just mozilla
   //
   //       and also note that although "rv:1.4" is in the
   //       user agent string, the gecko engine 20030624
   //       should correspond to the correct version
   //
   return ($type == 'html' && (($browser == 'Explorer' && $browserVersion >= 5.5)
     || ($browser == 'Gecko' && $browserVersion >= 20030624)
   ));

}


// this function can figure things out on its own
// or use the "Browser_Info" plugin if it is coded
// up to SM standards...
//
function getBrowserType()
{

   // get global variable for versions of PHP < 4.1
   //
   if (!compatibility_check_php_version(4,1)) {
      global $HTTP_SERVER_VARS;
      $_SERVER = $HTTP_SERVER_VARS;
   }

   $userAgent = strtolower($_SERVER['HTTP_USER_AGENT']);


   if (preg_match('/opera[\s\/](\d+\.\d+)/', $userAgent, $version))
      $browser = 'Opera';
   else if (preg_match('/msie (\d+\.\d+)/', $userAgent, $version))
      $browser = 'Explorer';
   else if (preg_match('/gecko\/(\d+)/', $userAgent, $version))
      $browser = 'Gecko';

// Mozilla should be identified as Gecko above, and never get to this
// part... that's OK for our purposes, but if this causes problems,
// can push this else if above the Gecko lines above
   else if (preg_match('/mozilla\/(\d+\.\d+)/', $userAgent, $version))
      $browser = 'Mozilla';
   

//echo "$userAgent<hr><hr>$browser<br>" . $version[1];
   return array($browser, $version[1]);


// Example User Agent strings:
//
// MSIE 6 in Avant shell
// mozilla/4.0 (compatible; msie 6.0; windows nt 5.1; avant browser [avantbrowser.com]; .net clr 1.1.4322)
//
// Netscape 7
// mozilla/5.0 (windows; u; windows nt 5.1; en-us; rv:1.0.2) gecko/20030208 netscape/7.02
//
// Mozilla 1.1 (htmlarea doesn't work)
// mozilla/5.0 (windows; u; windows nt 5.1; en-us; rv:1.1) gecko/20020826
//
// Mozilla 1.4 (htmlarea does work!) 
// Mozilla/5.0 (X11; U; Linux i686; en-US; rv:1.4) Gecko/20030624             (on linux)
// Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624     (on win2k)
// mozilla/5.0 (windows; u; windows nt 5.1; en-us; rv:1.4) gecko/20030624     (on winxp)
//
}


function html_mail_display() 
{

   global $username, $data_dir, $email_type, $allowEmoticons, $use_emoticons;

   if (compatibility_check_sm_version(1, 3))
      include_once (SM_PATH . 'plugins/html_mail/config.php');
   else
      include_once ('../plugins/html_mail/config.php');

   $email_type = getPref($data_dir, $username, 'compose_window_type', '');

   echo '<tr><td align=right valign=top>'
      . _("Email Composition Format:") . "</td>\n"
      . '<td><input type="radio" value="plain" name="email_type" ';

   if ($email_type == 'plain' || $email_type == '') echo 'CHECKED';

   echo '>&nbsp;' . _("Plain Text") . "\n"
      . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="html" name="email_type" ';

   if ($email_type == 'html') echo 'CHECKED';

   echo '>&nbsp;' . _("HTML") . "\n".
      '</td></tr>' . "\n";


   if ($allowEmoticons)
   {

      $use_emoticons = getPref($data_dir, $username, 'compose_window_use_emoticons', '');

      echo '<tr><td align=right valign=top>'
         . _("Use Emoticons:") . "</td>\n"
         . '<td><input type="radio" value="1" name="use_emoticons" ';

      if ($use_emoticons) echo 'CHECKED';

      echo '>&nbsp;' . _("Yes") . "\n"
         . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" value="0" name="use_emoticons" ';

      if (!$use_emoticons) echo 'CHECKED';

      echo '>&nbsp;' . _("No") . "\n".
         '</td></tr>' . "\n";

   }

}


function html_mail_save() 
{

   global $username, $data_dir, $email_type, $use_emoticons;

   compatibility_sqextractGlobalVar('email_type');
   compatibility_sqextractGlobalVar('use_emoticons');

   setPref($data_dir, $username, 'compose_window_type', $email_type);
   if (strlen($use_emoticons) > 0) 
      setPref($data_dir, $username, 'compose_window_use_emoticons', $use_emoticons);

}


function html_mail_prefs_load() 
{

   global $username, $data_dir, $email_type, $use_emoticons;

   $email_type = getPref($data_dir, $username, 'compose_window_type');
   //$use_emoticons = getPref($data_dir, $username, 'compose_window_use_emoticons');

}


function html_mail_alter_type_do(&$argv)
{

   // change outgoing encoding if supported/turned on
   //
   if (html_area_is_on_and_is_supported_by_users_browser())
   {

      $message = &$argv[1];
//echo "<hr>";sm_print_r($message);echo "<hr>";exit;
      if (is_array($message->entities) && sizeof($message->entities) > 0)
         $message->entities[0]->mime_header->type1 = 'html';
      else
         $message->rfc822_header->content_type->type1 = 'html';

      return $message;

//
// ALSO, focus goes to text area and not TO field when composing new messsage in HTML format... WHY?!?!
// blah... seems not worth the effort to parse through the 
// htmlarea code for this (i tried briefly)... tough luck/not 
// a big deal
//

   }

}


function insert_emoticons()
{

   echo '<TR><TD colspan="2"><BR />';


   echo '

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/regular_smile.gif>\');"><img src="../plugins/html_mail/images/regular_smile.gif" border="0" ALT="Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/teeth_smile.gif>\');"><img src="../plugins/html_mail/images/teeth_smile.gif" border="0" ALT="Open-Mouthed Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/wink_smile.gif>\');"><img src="../plugins/html_mail/images/wink_smile.gif" border="0" ALT="Winking Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/omg_smile.gif>\');"><img src="../plugins/html_mail/images/omg_smile.gif" border="0" ALT="Surprised Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/tounge_smile.gif>\');"><img src="../plugins/html_mail/images/tounge_smile.gif" border="0" ALT="Tounge-Out Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/shades_smile.gif>\');"><img src="../plugins/html_mail/images/shades_smile.gif" border="0" ALT="Cool Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/angry_smile.gif>\');"><img src="../plugins/html_mail/images/angry_smile.gif" border="0" ALT="Angry Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/confused_smile.gif>\');"><img src="../plugins/html_mail/images/confused_smile.gif" border="0" ALT="Confused Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/embaressed_smile.gif>\');"><img src="../plugins/html_mail/images/embaressed_smile.gif" border="0" ALT="Embarassed Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/sad_smile.gif>\');"><img src="../plugins/html_mail/images/sad_smile.gif" border="0" ALT="Sad Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/cry_smile.gif>\');"><img src="../plugins/html_mail/images/cry_smile.gif" border="0" ALT="Crying Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/whatchutalkingabout_smile.gif>\');"><img src="../plugins/html_mail/images/whatchutalkingabout_smile.gif" border="0" ALT="Disappointed Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/angel_smile.gif>\');"><img src="../plugins/html_mail/images/angel_smile.gif" border="0" ALT="Innocent Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/undecided.gif>\');"><img src="../plugins/html_mail/images/undecided.gif" border="0" ALT="Undecided Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/dude_hug.gif>\');"><img src="../plugins/html_mail/images/dude_hug.gif" border="0" ALT="Male Hug"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/girl_hug.gif>\');"><img src="../plugins/html_mail/images/girl_hug.gif" border="0" ALT="Female Hug"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/girl_handsacrossamerica.gif>\');"><img src="../plugins/html_mail/images/girl_handsacrossamerica.gif" border="0" ALT="Girl"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/guy_handsacrossamerica.gif>\');"><img src="../plugins/html_mail/images/guy_handsacrossamerica.gif" border="0" ALT="Boy"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/heart.gif>\');"><img src="../plugins/html_mail/images/heart.gif" border="0" ALT="Red Heart"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/broken_heart.gif>\');"><img src="../plugins/html_mail/images/broken_heart.gif" border="0" ALT="Broken Heart"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/rose.gif>\');"><img src="../plugins/html_mail/images/rose.gif" border="0" ALT="Red Rose"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/wilted_rose.gif>\');"><img src="../plugins/html_mail/images/wilted_rose.gif" border="0" ALT="Wilted Rose"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/kiss.gif>\');"><img src="../plugins/html_mail/images/kiss.gif" border="0" ALT="Kiss"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/beer_yum.gif>\');"><img src="../plugins/html_mail/images/beer_yum.gif" border="0" ALT="Beer"></a>

<BR>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/martini_shaken.gif>\');"><img src="../plugins/html_mail/images/martini_shaken.gif" border="0" ALT="Martini"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/coffee.gif>\');"><img src="../plugins/html_mail/images/coffee.gif" border="0" ALT="Coffee"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/bat.gif>\');"><img src="../plugins/html_mail/images/bat.gif" border="0" ALT="Bat"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/bowwow.gif>\');"><img src="../plugins/html_mail/images/bowwow.gif" border="0" ALT="Dog"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/kittykay.gif>\');"><img src="../plugins/html_mail/images/kittykay.gif" border="0" ALT="Cat"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/cake.gif>\');"><img src="../plugins/html_mail/images/cake.gif" border="0" ALT="Cake"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/present.gif>\');"><img src="../plugins/html_mail/images/present.gif" border="0" ALT="Gift"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/clock.gif>\');"><img src="../plugins/html_mail/images/clock.gif" border="0" ALT="Clock"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/devil_smile.gif>\');"><img src="../plugins/html_mail/images/devil_smile.gif" border="0" ALT="Devil Smiley"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/envelope.gif>\');"><img src="../plugins/html_mail/images/envelope.gif" border="0" ALT="Email"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/messenger.gif>\');"><img src="../plugins/html_mail/images/messenger.gif" border="0" ALT="MSN Messenger"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/phone.gif>\');"><img src="../plugins/html_mail/images/phone.gif" border="0" ALT="Phone Call"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/camera.gif>\');"><img src="../plugins/html_mail/images/camera.gif" border="0" ALT="Camera"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/film.gif>\');"><img src="../plugins/html_mail/images/film.gif" border="0" ALT="Movie"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/musical_note.gif>\');"><img src="../plugins/html_mail/images/musical_note.gif" border="0" ALT="Music"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/asl.gif>\');"><img src="../plugins/html_mail/images/asl.gif" border="0" ALT="Age/Sex/Location"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/handcuffs.gif>\');"><img src="../plugins/html_mail/images/handcuffs.gif" border="0" ALT="Handcuffs"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/sun.gif>\');"><img src="../plugins/html_mail/images/sun.gif" border="0" ALT="Sun"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/moon.gif>\');"><img src="../plugins/html_mail/images/moon.gif" border="0" ALT="Moon"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/lightbulb.gif>\');"><img src="../plugins/html_mail/images/lightbulb.gif" border="0" ALT="Light Bulb"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/star.gif>\');"><img src="../plugins/html_mail/images/star.gif" border="0" ALT="Star"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/thumbs_down.gif>\');"><img src="../plugins/html_mail/images/thumbs_down.gif" border="0" ALT="Thumbs Down"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/thumbs_up.gif>\');"><img src="../plugins/html_mail/images/thumbs_up.gif" border="0" ALT="Thumbs Up"></a>

<a href="javascript:editor.insertHTML(\'<img src=../plugins/html_mail/images/rainbow.gif>\');"><img src="../plugins/html_mail/images/rainbow.gif" border="0" ALT="Rainbow"></a>


   ';


   echo "</TD></TR>";

}


?>
