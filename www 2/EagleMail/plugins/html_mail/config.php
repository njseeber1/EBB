<?php

   global $languageFile, $customStyle, $allowEmoticons, $use_spell_checker;


   // to change the language for the HTML editor, please look in
   // the html_mail/htmlarea/lang directory for a language file
   // that matches your desired language and enter that file name
   // here EXACTLY as you see it
   // 
   $languageFile = 'en.js';



   // if you'd like to customize the HTML editor, you may define
   // its CSS style here... leave as an empty string for default
   // behavior
   //
   // note that a font-size of about 16 seems to be more
   // appropriate than the default size
   //
   //
//   $customStyle = '';
//   $customStyle = 'body { background-color: yellow; color: black; font-family: verdana,sans-serif; font-size:12 }   p { font-width: bold; }';
   $customStyle = 'body { font-size:16 }';



   // if you have patched the SquirrelMail source to allow the
   // use of emoticons functionality and want to allow users
   // to make use of them, set this value to 1.  set to zero
   // to disable
   //
   $allowEmoticons = 0;



   // set this to 1 if you'd like to use the integrated spell 
   // checker (make sure you've got your web server and Perl
   // interpreter set up correctly, for more info, see the 
   // README file)...  set to zero to disable
   //
   $use_spell_checker = 0;


?>
