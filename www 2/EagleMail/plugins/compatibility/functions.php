<?php


   // change this to TRUE to disable plugin config test functionality
   // which will increase performance (minimally)
   //
   $disable_config_check = FALSE;




   global $compatibility_sm_path, $compatibility_disable_config_check;
   $compatibility_disable_config_check = $disable_config_check;


   // Some uses of this plugin (such as vlogin) were somehow calling the
   // functions here before having included the functions in global.php,
   // resulting in fatal errors when called below.  Thus, the need for
   // this include
   //

   if (defined('SM_PATH'))
   {

      // in SM 1.4, we need to include the validate file first
      // thing so we don't lose the ability to display themes,
      // but we cannot include this file unless we are being
      // called from a plugin request, thus this if statement
      //
      if ( strpos(getcwd(), 'plugins') ) 
      {
         if (file_exists(SM_PATH . 'include/validate.php'))
            include_once(SM_PATH . 'include/validate.php');
         else if (file_exists(SM_PATH . 'src/validate.php'))
            include_once(SM_PATH . 'src/validate.php');
      }


      include_once(SM_PATH . 'functions/strings.php');


      if (file_exists(SM_PATH . 'functions/global.php'))
         include_once(SM_PATH . 'functions/global.php');
      else if (file_exists(SM_PATH . 'src/global.php'))
         include_once(SM_PATH . 'src/global.php');


      $compatibility_sm_path = SM_PATH;

   }
   else
   {
      include_once('../functions/strings.php');

      if (file_exists('../src/global.php'))
         include_once('../src/global.php');

      $compatibility_sm_path = '../';
   }



   //
   // copied from global.php to accomodate older SM versions
   //


   // returns true if current SquirrelMail version is at mimimum a.b.c
   //
   function compatibility_check_sm_version ($a = '0', $b = '0', $c = '0')
   {
      global $SQM_INTERNAL_VERSION;

      if (isset($SQM_INTERNAL_VERSION))
         return check_sm_version($a, $b, $c);

      global $version;
      list($aa, $bb, $cc) = preg_split('/\./', $version, 3);

      if(!is_numeric($cc))
         list($cc, $info) = explode(' ', $cc, 2);

      return ($aa > $a)
          || (($aa == $a) && ($bb > $b))
          || (($aa == $a) && ($bb == $b) && ($cc >= $c));
   }



   /* returns true if current php version is at mimimum a.b.c */
   function compatibility_check_php_version ($a = '0', $b = '0', $c = '0')
   {

       if (compatibility_check_sm_version(1, 2, 10))
          return check_php_version($a, $b, $c);

       global $SQ_PHP_VERSION;

       if(!isset($SQ_PHP_VERSION))
           $SQ_PHP_VERSION = substr( str_pad( preg_replace('/\D/','', PHP_VERSION), 3, '0'), 0, 3);

       return $SQ_PHP_VERSION >= ($a.$b.$c);
   }


   function compatibility_sqsession_register ($var, $name) {

       if (compatibility_check_sm_version(1, 2, 11))
       {
          sqsession_register ($var, $name);
          return;
       }

       compatibility_sqsession_is_active();
       compatibility_sqsession_unregister($name);

       if ( !compatibility_check_php_version(4,1) ) {
           global $HTTP_SESSION_VARS;
           $HTTP_SESSION_VARS["$name"] = $var;
       }
       else {
          $_SESSION["$name"] = $var;
       }
           session_register("$name");
   }



   function compatibility_sqsession_unregister ($name) {

       if (compatibility_check_sm_version(1, 2, 11))
       {
          sqsession_unregister($name);
          return;
       }

       compatibility_sqsession_is_active();

       if ( !compatibility_check_php_version(4,1) ) {
           global $HTTP_SESSION_VARS;
           unset($HTTP_SESSION_VARS["$name"]);
       }
       else {
           unset($_SESSION["$name"]);
       }
           session_unregister("$name");
   }



   /*
    * Function to verify a session has been started.  If it hasn't
    * start a session up.  php.net doesn't tell you that $_SESSION
    * (even though autoglobal), is not created unless a session is
    * started, unlike $_POST, $_GET and such
    */

   function compatibility_sqsession_is_active() {

       if (compatibility_check_sm_version(1, 2, 11))
       {
          sqsession_is_active();
          return;
       }

       $sessid = session_id();
       if ( empty( $sessid ) ) {
           session_start();
       }
   }



   function compatibility_sqsession_is_registered ($name) {


       if (compatibility_check_sm_version(1, 3))
       {
          return sqsession_is_registered($name);
       }


       $test_name = &$name;
       $result = false;
       if ( !compatibility_check_php_version(4,1) ) {
           global $HTTP_SESSION_VARS;
           if (isset($HTTP_SESSION_VARS[$test_name])) {
               $result = true;
           }
       }
       else {
           if (isset($_SESSION[$test_name])) {
               $result = true;
           }
       }
       return $result;
   }



   /**
    *  Search for the var $name in $_SESSION, $_POST, $_GET
    *  (in that order) and register it as a global var.
    */
   function compatibility_sqextractGlobalVar ($name) {

       if (compatibility_check_sm_version(1, 3))
       {
          global $$name;
          sqgetGlobalVar($name, $$name);
          return;
       }

       if (compatibility_check_sm_version(1, 2, 8))
       {
          sqextractGlobalVar($name);
          return;
       }

       if ( !compatibility_check_php_version(4,1) ) {
           global $_SESSION, $_GET, $_POST;
       }
       global  $$name;
       if( isset($_SESSION[$name]) ) {
           $$name = $_SESSION[$name];
       }
       if( isset($_POST[$name]) ) {
           $$name = $_POST[$name];
       }
       else if ( isset($_GET[$name]) ) {
           $$name =  $_GET[$name];
       }
   }


   // checks a plugin to see if the user has installed it 
   // correctly by checking for the existence of the given
   // files (all relative from the plugin's directory)
   //
   // $pluginName should be the name of the plugin as it is
   // known to SquirrelMail, that is, it is the name of the
   // plugin directory
   //
   // $configFiles should be an array of any files that the
   // user should have set up for this plugin, for example:
   // array('config.php') or array('data/config.php', 'data/admins.php')
   // where all files will be referenced from the plugin's
   // main directory
   //
   function compatibility_check_plugin_setup($pluginName, $configFiles)
   {

      global $compatibility_disable_config_check;
      if ($compatibility_disable_config_check) return;


      global $compatibility_sm_path;


      // check one at a time...
      //
      foreach ($configFiles as $configFile)
      {

         if (!file_exists($compatibility_sm_path . 'plugins/' . $pluginName . '/' . $configFile))
         {

            global $color;
            plain_error_message(_("Administrative error:") . '<br />' 
               . _("The plugin") . ' "<b>' . $pluginName 
               . '</b>" ' . _("has not been set up correctly.") . '<br />' 
               . _("Missing ") . '<b>' . $configFile . '</b><br />' 
               . _("Please read the README or INSTALL files that came with the plugin."), $color);
            exit;

         }

      }

   }

?>
