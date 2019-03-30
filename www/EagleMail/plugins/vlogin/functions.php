<?php

/**
  * SquirrelMail Virtual Host Login Plugin
  * Copyright (C) 2003, 2004 Paul Lesneiwski <pdontthink@angrynerds.com>
  * This program is licensed under GPL. See COPYING for details
  *
  */


// include compatibility plugin
//
if (defined('SM_PATH'))
   include_once(SM_PATH . 'plugins/compatibility/functions.php');
else if (file_exists('../plugins/compatibility/functions.php'))
   include_once('../plugins/compatibility/functions.php');
else if (file_exists('./plugins/compatibility/functions.php'))
   include_once('./plugins/compatibility/functions.php');


/**
  * Override Default Config Values
  *
  * This function looks up new configuration settins for the current
  * user and replaces the default settings with those.  The new values
  * might be retrieved from the virtual domain table (based on the
  * hostname portion of the current URL), a per user file, etc.
  *
  */
function overrideSmConfig() {

   global $allVirtualDomainsAreUnderOneSSLHost, 
          $smHostIsDomainThatUserLoggedInWith, $virtualDomainDataDir, 
          $data_dir, $domain, $virtualDomains, $plugins,  
          $squirrelmail_plugin_hooks, $useSessionBased;
      
  
  // get global variable for versions of PHP < 4.1 
  //
  if (!compatibility_check_php_version(4,1)) {
    global $HTTP_SERVER_VARS, $HTTP_SESSION_VARS, $HTTP_POST_VARS;
    $_SERVER = $HTTP_SERVER_VARS;
    $_SESSION = $HTTP_SESSION_VARS;
    $_POST = $HTTP_POST_VARS;
  }


  // make sure the session has started
  //
  compatibility_sqsession_is_active();


  // try to find username
  //
  $user = '';
  if (isset($_SESSION['username']))
     $user = $_SESSION['username'];
  elseif (isset($_POST['login_username']))
     $user = $_POST['login_username'];


  include_once (SM_PATH . 'plugins/vlogin/data/config.php');


  if ($useSessionBased)
  {
     global $config_override;
     compatibility_sqsession_unregister('config_override');
     // If we don't initialize this, it will work 
     // together with the multilogin plugin
     // $config_override = array();
  }


  // grab hostname into local var
  //
  if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST']))
     $hostname = $_SERVER['HTTP_X_FORWARDED_HOST'];
  else
     $hostname = $_SERVER['HTTP_HOST'];
  $hostname_stripped = deconstructDomainName($hostname);


  // for sites where virtual host is pegged on the end of the main
  // site's URL (usually for single-certificate SSL hosting), get 
  // the actual host name out of the PHP_SELF portion of the URL
  //
  if ($allVirtualDomainsAreUnderOneSSLHost) {

     preg_match('/[\/]*(.*?)(\/|$)/', $_SERVER['PHP_SELF'], $matches);
     $hostname = $matches[1];

  }


  // set domain if the $smHostIsDomainThatUserLoggedInWith
  // flag is on...
  //
  if ($smHostIsDomainThatUserLoggedInWith)
  {
     if ($useSessionBased)
        $config_override['domain'] = $hostname_stripped;
     else
        $domain = $hostname_stripped; 
  }
      

  // override data_dir if the $virtualDomainDataDir variable 
  // has been specified
  //
  if (!empty($virtualDomainDataDir)) 
  {
     $the_data_dir = $virtualDomainDataDir;
     $the_data_dir = str_replace('###VIRTUAL_DOMAIN###', 
                             $hostname_stripped, 
                             $the_data_dir);
     if (!empty($user))
        $the_data_dir = str_replace('###USERNAME###', 
                                $user, 
                                $the_data_dir);
     if ($useSessionBased)
        $config_override['data_dir'] = $the_data_dir;
     else
        $data_dir = $the_data_dir;
  }


  $firstTime = 1;


  // allow inclusion of external configuration files for each domain
  //
  if (file_exists(SM_PATH . 'plugins/vlogin/data/domains/' . $hostname_stripped . '.vlogin.config.php'))
    include_once(SM_PATH . 'plugins/vlogin/data/domains/' . $hostname_stripped . '.vlogin.config.php');


  // override the org_logo and other stuff if we find a match
  //
// NOTE: the following line will solve PHP 4.3 problems when using
//       the session_recall patch, however it will also unfortunately
//       mask errors in the config file.  removing this line could
//       possibly help debug non-functional vlogin installations
  if (is_array($virtualDomains))
  foreach (array_keys($virtualDomains) as $virtualDomain) {

    if (stristr($hostname, $virtualDomain) || $virtualDomain == '*') {


      // limit usage of global domain to first entry only
      //
      if ($virtualDomain == '*' && !$firstTime)
      {
         echo '<html><body><font color="red" size="12pt">';
         echo 'Sorry, please contact your administrator and ';
         echo 'ask them to reconfigure the SquirrelMail Virtual Host Login ';
         echo 'plugin such that the global virtual domain is listed first';
         echo '</font></body></html>';
         exit(1);
      }


      foreach ($virtualDomains[$virtualDomain] as $setting => $value)
      {

        // go ahead and replace the strings ###VIRTUAL_DOMAIN### and ###USERNAME###
        //
        if (!is_array($value))
        {
           if (strpos($value, '###VIRTUAL_DOMAIN###') !== FALSE)
              $value = str_replace('###VIRTUAL_DOMAIN###',
                                   $hostname_stripped,
                                   $value);

           if (strpos($value, '###USERNAME###') !== FALSE && !empty($user))
              $value = str_replace('###USERNAME###', 
                               $user, 
                               $the_data_dir);
        }
         
        // Go ahead and replace the string ###USERNAME###
        //
        if (!is_array($value))
           if (strpos($value, '###VIRTUAL_DOMAIN###') !== FALSE)
              $value = str_replace('###VIRTUAL_DOMAIN###',
                                   $hostname_stripped,
                                   $value);
         
        // enable additional plugins
        //
        if (stristr($setting, 'enable_plugins'))
        {
           if ($useSessionBased)
           {
              $config_override[$setting] = $value;
           }
           else
           {
              foreach ($value as $pluginName)
              {
                 $plugins[] = $pluginName;
                 use_plugin($pluginName);
              }
           }
           continue;
        }


        // disable plugins
        //
        if (stristr($setting, 'disable_plugins'))
        {
           if ($useSessionBased)
           {
              $config_override[$setting] = $value;
           }
           else
           {
              foreach ($value as $pluginName)
              {
                 $pluginKey = array_search($pluginName, $plugins);
                 if (!is_null($pluginKey) && $pluginKey !== FALSE)
                 {
                    unset($plugins[$pluginKey]);
                    foreach (array_keys($squirrelmail_plugin_hooks) as $hookName)
                    {
                       unset($squirrelmail_plugin_hooks[$hookName][$pluginName]);
                    }
                 }
              }
           }
           continue;
        }


        // replace SquirrelMail config values
        //
        if ($useSessionBased)
        {

           // in order to set the org_title, in the browser
           // title bar, have to do it now (using an eval
           // otherwise things like $_SESSION will never be
           // found when the variable is first defined)
           //
           if ($setting == 'org_title')
           {
              global $$setting;
              eval('$$setting = ' . $value . ';');
           }
           else
              $config_override[$setting] = $value;

        }
        else
        {

           // in order to set the org_title, in the browser
           // title bar, have to do it now using and eval,
           // otherwise things like $_SESSION will never be
           // found when the variable is first defined)
           //
           if ($setting == 'org_title')
           {
              global $$setting;
              eval('$$setting = ' . $value . ';');
           }
           else
           {
              global $$setting;
              $$setting = $value;
           }

        }

      }


      if ($smHostIsDomainThatUserLoggedInWith)
      {
         if ($useSessionBased)
            $config_override['domain'] = $hostname_stripped;
         else
            $domain = $hostname_stripped; 
      }

      
      // exit this loop, unless this is the global default
      // 
      if( $virtualDomain != '*' ) break;

    }


    $firstTime = 0;


  }


  if ($useSessionBased)
  {

     compatibility_sqsession_register($config_override, 'config_override');

     include_once (SM_PATH . 'plugins/multilogin/functions.php');

     multilogin_sqoverride_config_do();

  }


  // override settings on a per-user basis
// TODO: not clear if this will work with password_forget and/or login_alias...
  //
  perUserOverride($user);


}



/** 
  * Remap Username When Logging In
  * 
  * Here is the meat of the vlogin magic.  It is used to figure
  * out what the username should really be, possibly based on
  * the hostname portion of the current URL, a sendmail style
  * virtual users table, any number of different combinations
  * of stripping parts of the hostname, etc.
  *
  */
function vlogin_domain_do() 
{

  global $plugins, $login_username, $$login_username, $debug, $data_dir, 
         $foundLoginAlias, $at, $dot, $dontUseHostName, $atConversion,
         $sendmailVirtualUserTable, $putHostNameOnFrontOfUsername,
         $allVirtualDomainsAreUnderOneSSLHost, $prefs_dsn, $useSessionBased,
         $virtualDomains, $removeDomainIfGiven, $alwaysAddHostName;


  // figure out where prefs are stored
  //
  if (isset($prefs_dsn) && !empty($prefs_dsn))
      $prefsInDB = true;
  else
      $prefsInDB = false;


  // get global variable for versions of PHP < 4.1
  //
  if (!compatibility_check_php_version(4,1)) {
    global $HTTP_SERVER_VARS;
    $_SERVER = $HTTP_SERVER_VARS;
  }


  // grab hostname into local var
  //
  if (isset($_SERVER['HTTP_X_FORWARDED_HOST']) && !empty($_SERVER['HTTP_X_FORWARDED_HOST']))
     $hostname = $_SERVER['HTTP_X_FORWARDED_HOST'];
  else
     $hostname = $_SERVER['HTTP_HOST'];


  // for sites where virtual host is pegged on the end of the main
  // site's URL (usually for single-certificate SSL hosting), get 
  // the actual host name out of the PHP_SELF portion of the URL
  //
  if ($allVirtualDomainsAreUnderOneSSLHost) {

     preg_match('/[\/]*(.*?)(\/|$)/', $_SERVER['PHP_SELF'], $matches);
     $hostname = $matches[1];

  }


  // get vlogin config settings
  //
  include_once (SM_PATH . 'plugins/vlogin/data/config.php');



  // what username did the user submit to us?
  //
  $user = $login_username;
  

  // if password_forget is loaded, use the obfuscated name
  //
  if (in_array('password_forget', $plugins)) {
    if (!isset($$login_username)) compatibility_sqextractGlobalVar($login_username);
    if ($$login_username != '')
      $user = $$login_username;
  }


  // if user logged in with full email address, 
  // chop off domain info if needed
  //
  if ( $removeDomainIfGiven && strpos($user, $at) !== FALSE ) 
  {
     $user = substr($user, 0, strpos($user, $at));
  }


  // check for login_alias plugin
  //
  if (in_array('login_alias',$plugins)) 
  {


    // check if login alias was already processed
    if (isset($foundLoginAlias)) {

      if ($foundLoginAlias) return;

    }
    else 
    {

      // check for login alias here and return if found
      // (but only if it is in the domain being used
      // to log in when dontUseHostName is off)
      //
      $filename = $data_dir.'login_alias.pref';
      if ((!$prefsInDB && file_exists($filename)) || $prefsInDB) 
      {
        $loginAlias=getPref($data_dir,'login_alias',$user);

        if (!empty($loginAlias))
        {
          if (!$dontUseHostName)
          {
            if (strpos($loginAlias, deconstructDomainName($hostname)) !== FALSE)
              return;
          }
          else
          {
            return;
          }

        }

      }

    }

  }



  // convert "at" sign...
  //
  foreach ($atConversion as $otherAt)
     $user = str_replace($otherAt, $at, $user);



/* what was I thinking... 

  // for those sysadmins who like to torture their 
  // users and require a domain as part of the login...
  //
  if( $forceDomainInUsername )
  {

    if ( strpos($user, $at) === FALSE 
      || substr($user, strpos($user, $at) + strlen($at)) != deconstructDomainName($hostname))
    {
      logout_error(_("Username must include domain name") . ' ' . deconstructDomainName($hostname));
      exit;
    }

  }



  // rare cases where we want to strip off domain from
  // username after everything has been done above
  //
  if ( $removeDomainAfterDomainCheck && strpos($user, $at) !== FALSE ) 
  {
     $user = substr($user, 0, strpos($user, $at));
  }

   $forceDomainInUsername
   ----------------------
   can be used to require the user to input the domain portion of
   their username (which MUST match the hostname as reconstructed
   using the settings you have made here).  This is not the best
   way to require that the user's domain matches the URL and is a 
   big hassle for users most of the time, so it is not a recommended 
   option.  If you are looking for a way to ensure the domain on the 
   username matches the URL, use $removeDomainIfGiven and make sure 
   $dontUseHostName is turned off.  This option is mostly useful if 
   you have a combination of usernames both WITH and WITHOUT (in 
   combination with $removeDomainAfterDomainCheck) hostname portions 
   and are thus using $dontUseHostName, but you still want to make 
   sure the username's domain portion matches the URL.

   $removeDomainAfterDomainCheck
   -----------------------------
   will remove the domain portion of the username if given.  This 
   option should not be used in favor of $removeDomainIfGiven if at
   all possible.  This setting is usually only used when 
   $forceDomainInUsername is turned on so usernames that shouldn't
   have domain portions on them...............

DUH.  Took me this long to figure out that I was spinnin my wheels for
a user who was asking the impossible.  This just here for posterity...
*/



  // check and see if they decided to insert the host anyway
  // or we don't want to use the host name...
  //
  if( $alwaysAddHostName || (!$dontUseHostName && strpos($user, $at) === FALSE) ) {


    $hostname = deconstructDomainName($hostname);


    // assign realname using parsed hostname
    //
    if ($putHostNameOnFrontOfUsername)
       $realname = $hostname . $at . $user;
    else
       $realname = $user . $at . $hostname;


  } else {
    $realname = $user;
  }

  
  // remap to correct user account when using sendmail virtual logins...
  //
  if (!empty($sendmailVirtualUserTable))
  {
     $realname = getSendmailVirtualUser($realname, $sendmailVirtualUserTable);
  }


  if ($useSessionBased)
     overrideSmConfig();


  // override settings on a per-user basis
  //
  perUserOverride($realname);


  // if password_forget is loaded, use the obfuscated name
  if (in_array('password_forget',$plugins) && $$login_username != '')
     $$login_username=$realname;
  else
     $login_username=$realname;


  // when in debug mode, just dump out final login name and quit
  //
  if ($debug)
  {

     echo '';
     echo '';
     echo '<html><body><hr><br>';
     echo '<h4>Your IMAP login was resolved to:<br><br>';
     echo $realname;
     echo '</h4><br><hr>';
     // was confusing to people using $dontUseHostName 
     if (!$dontUseHostName) echo '<br>$hostname is ' . $hostname . '<br>';
     echo '<br>PHP_SELF is ' . $_SERVER['PHP_SELF'] . '<br>';
global        $imapServerAddress;
echo '<hr>' . $imapServerAddress . '<hr>';
     echo '<br><hr></body></html>';
     exit;

  }

}



/** 
  * Get Per-User Config Overrides
  *
  * Looks up a user in the per-user config file and, if found,
  * grabs and uses the user's custom settings.
  *
  * @param string $user The username for which to look for custom settings.
  *
  */
function perUserOverride($user) 
{

   global $at, $atConversion, $perUserSettingsFile, $useSessionBased,
          $plugins, $squirrelmail_plugin_hooks;


   // convert "at" sign...
   //
   foreach ($atConversion as $otherAt)
      $user = str_replace($otherAt, $at, $user);


   // override per-user settings
   //
   if (!empty($perUserSettingsFile) && !empty($user)) {


      // find settings for user
      //
      $userSettings = array();
      if ($USERSETTINGS = @fopen ($perUserSettingsFile, "r"))
      {

         while (!feof($USERSETTINGS))
         {

            $line = fgets($USERSETTINGS, 4096);
            $line = trim($line);


            // skip blank lines and comment lines
            //
            if (strpos($line, '#') === 0 || strlen($line) < 3)
               continue;


            // parse fields out
            //
            if (substr($line, strlen($line) - 1) != ',') $line .= ',';
            preg_match_all('/(.+?),\s*/', $line, $configSettings, PREG_PATTERN_ORDER);


            // stop when we have the right username (case insensitive)
            //
            if (strtoupper($user) == strtoupper($configSettings[1][0]))
            {
               $userSettings = $configSettings[1];
               break;
            }


            // if wildcard match for user is found, 
            // grab settings, but don't stop looking 
            // for exact match
            //
            if (strpos($configSettings[1][0], '*') !== FALSE
             || strpos($configSettings[1][0], '?') !== FALSE)
            {
               if (preg_match('/^' . str_replace(array('?', '*'), array('\w{1}', '.*?'), 
                           strtoupper($configSettings[1][0])) . '$/', strtoupper($user)))
                  $userSettings = $configSettings[1];
            }

         }

         fclose($USERSETTINGS);

      }

      if (sizeof($userSettings) > 0)
      {


        // put arrays of values back together
        //
        for ($x = 0; $x < sizeof($userSettings); $x++)
        {
           if (substr($userSettings[$x], 0, 1) == ',')
           {
              $userSettings[$x - 1] .= $userSettings[$x];
              array_splice($userSettings, $x, 1);
              $x--;
           }
        }


        if ($useSessionBased)
        {
           global $config_override;
           compatibility_sqsession_unregister('config_override');
           // If we don't initialize this, it will work
           // together with the multilogin plugin and 
           // any settings already made for the domain
           // $config_override = array();
        }


        // loop through user's settings 
        //
        foreach ($userSettings as $setting)
        {

           if (!strpos($setting, '='))
              continue;

           $matches = explode('=', $setting);


           // convert strings "true" and "false" to real boolean values
           //
           if (strtoupper($matches[1]) === 'TRUE') $matches[1] = TRUE;
           else if (strtoupper($matches[1]) === 'FALSE') $matches[1] = FALSE;


           if ($useSessionBased)
           {
              if (stristr($matches[0], 'enable_plugins') || stristr($setting, 'disable_plugins'))
                 $config_override[$matches[0]] = explode(',', $matches[1]);
              else
                 $config_override[$matches[0]] = $matches[1];
           }
           else
           {

              // in order to set the org_title, in the browser
              // title bar, have to do it now (using an eval
              // otherwise things like $_SESSION will never be
              // found when the variable is first defined)
              //
              if ($matches[0] == 'org_title')
              {
                 global $$matches[0];
                 eval('$$matches[0] = ' . $matches[1] . ';');
              }


              // enable additional plugins
              //
              else if (stristr($matches[0], 'enable_plugins'))
              {
                 $values = explode(',', $matches[1]);
                 foreach ($values as $pluginName)
                 {
                    $plugins[] = $pluginName;
                    use_plugin($pluginName);
                 }
              }


              // disable plugins
              //
              else if (stristr($setting, 'disable_plugins'))
              {
                 $values = explode(',', $matches[1]);
                 foreach ($values as $pluginName)
                 {
                    $pluginKey = array_search($pluginName, $plugins);
                    if (!is_null($pluginKey) && $pluginKey !== FALSE)
                    {
                       unset($plugins[$pluginKey]);
                       foreach (array_keys($squirrelmail_plugin_hooks) as $hookName)
                       {
                          unset($squirrelmail_plugin_hooks[$hookName][$pluginName]);
                       }
                    }
                 }
              }


              // regular config setting...
              //
              else
              {
                 global $$matches[0];
                 $$matches[0] = $matches[1];
              }

           }

        }


        if ($useSessionBased)
        {
      
           compatibility_sqsession_register($config_override, 'config_override');
      
           include_once (SM_PATH . 'plugins/multilogin/functions.php');

           multilogin_sqoverride_config_do();

        }

     }

  }

}



/** 
  * Host Name Deconstruction
  *
  * Takes a host name (usually from URL, but can be
  * anything) and reconstructs it based on vlogin
  * configuration settings.
  *
  * @param string $hostname The hostname to re/deconstruct.
  *
  * @return string The rebuilt hostname.
  *
  */
function deconstructDomainName($hostname) 
{

  global $notPartOfDomainName, $chopOffDotSectionsFromRight, 
         $chopOffDotSectionsFromLeft, $numberOfDotSections, 
         $checkByExcludeList, $at, $dot, $replacements,
         $removeFromFront, $translateHostnameTable, $pathToQmail,
         $reverseDotSectionOrder;


  include_once (SM_PATH . 'plugins/vlogin/data/config.php');



  // if a port number is in the URL, remove it before proceeding
  //
  $hostname = preg_replace('/:\d+/', '', $hostname);



  // replace any characters as necessary
  //
  if (is_array($replacements))
    foreach ($replacements as $chars => $repl)
      $hostname = str_replace($chars, $repl, $hostname);


  // reverse dot section order if necessary
  //
  if ($reverseDotSectionOrder)
    $hostname = implode('.', array_reverse(explode('.', $hostname))); 


  // if enabled, remove "dot sections" until desired size of hostname is reached
  //
  if ($numberOfDotSections > 0) {

     // lop off pieces of hostname until 
     // number of dot sections is same as desired
     //
     while (sizeof(explode('.', $hostname)) > $numberOfDotSections) {

        if ($removeFromFront)
           $hostname = substr($hostname, strpos($hostname, '.') + 1);
        else
           $hostname = substr($hostname, 0, strrpos($hostname, '.'));
        
     }

  }


  // if enabled, remove "dot sections" from the left side...
  //
  for ($i = 0; $i < $chopOffDotSectionsFromLeft; $i++) {

    $hostname = substr($hostname, strpos($hostname, '.') + 1);
     
  }


  // if enabled, remove "dot sections" from the right side...
  //
  for ($i = 0; $i < $chopOffDotSectionsFromRight; $i++) {

    $hostname = substr($hostname, 0, strrpos($hostname, '.'));
     
  }


// TODO: I think it makes more sense to do this BEFORE 
// doing the $numberOfDotSections functionality.  I would
// move it now, but I don't know if I'll break things for
// people out there.... ;>
   // if enabled, extract any of the undesired host name pieces
   //
   if ($checkByExcludeList) {
    
      foreach ($notPartOfDomainName as $dotSection)
      {

         $hostname = preg_replace('/(^|\.)' . $dotSection . '($|\.)/', 
                                  "\$1", $hostname);

      }

   }


   // if resulting hostname begins or ends with a dot, remove it
   //
   $hostname = preg_replace('/^\./', '', $hostname);
   $hostname = preg_replace('/\.$/', '', $hostname);


  // just in case they need a different '.' seperator
  $hostname = str_replace( ".", $dot, $hostname );


  // if domain name needs to be remapped, do so here
  //
  if (!empty($translateHostnameTable))
     $hostname = translateHostname($hostname, $translateHostnameTable);


  // if qmail/vpopmail domain aliasing is used and we
  // need to translate this domain (if it is an alias),
  // do so here
  //
  if (!empty($pathToQmail))
     $hostname = unaliasQmailDomainAlias($hostname, $pathToQmail);


  return $hostname;

}



/**
  * Unalias any Qmail/Vpopmail Domain Aliases
  *
  * @param string $host Host name to be dealiased.
  * @param string $pathToQmail System path to Qmail install directory.
  *
  * @return string Corrected host name.
  *
  */
function unaliasQmailDomainAlias($host, $pathToQmail)
{
    $tmp = '+'.$host.'-:' ;
    $tlen = strlen($tmp) ;
    $file = fopen($pathToQmail.'/users/assign','r') ;
    while(!feof($file)) {
      $line = fgets($file,256) ;
      if(substr($line,0,$tlen) == $tmp)	{
        $host = substr($line,$tlen) ;
        $tmp = strpos($host,':') ;
        if ($tmp !== FALSE) $host = substr($host,0,$tmp) ;
        break ;
      }
    }
    fclose($file) ;
    return $host;
}



// remap a host name to the one specified in the translate host 
// name table (path given by the $translateHostnameTable)
//
/**
  * Remap Host Name
  *
  * Takes a host name, looks it up in the given lookup table,
  * and, if found therein, returns the lookup value (otherwise,
  * returns the host as is).
  *
  * @param string $host The host name to be looked up.
  * @param string $translateHostnameTable The path to the lookup table.
  *
  * @return string The remapped host name.
  *
  */
function translateHostname($host, $translateHostnameTable)
{

   if ($HOSTTABLE = @fopen ($translateHostnameTable, 'r'))
   {

      while (!feof($HOSTTABLE))
      {

         $line = fgets($HOSTTABLE, 4096);
         $line = trim($line);


         // skip blank lines and comment lines
         //
         if (strpos($line, '#') === 0 || strlen($line) < 3)
            continue;


         // parse fields out
         //
         preg_match('/^(\S+)\s+(\S+)/', $line, $matches);


         // if host is found, get remapped hostname and return
         //
         if (preg_match('/^' . str_replace(array('?', '*'), 
                                           array('\w{1}', '.*?'),
                                           strtoupper($matches[1])) 
                             . '$/', strtoupper($host)))
         {
            fclose($HOSTTABLE);
            return $matches[2];
         }

      }


      fclose($HOSTTABLE);
      return $host;


   }


   // otherwise, unaltered hostname is returned
   //
   return $host;

}



/**
  * Remap User Login ala Sendmail Style Virtual User Table
  *
  * Looks up the given username in the given virtual user table
  * and, if found therein, returns the corresponding lookup value
  * (otherwise, returns the username as is).
  *
  * @param string $user The username to be looked up.
  * @param string $sendmailVirtualUserTable The system path to the lookup table.
  *
  * @return string The remapped user name.
  *
  */
function getSendmailVirtualUser($user, $sendmailVirtualUserTable)
{

   global $at;

   $catchallLogin = '';


   if ($VIRTTABLE = @fopen ($sendmailVirtualUserTable, 'r'))
   {

      // be ready to use catchall address - prepare domain name
      //
      $domainName = '';
      if (strpos($user, $at) !== FALSE)
         $domainName = substr($user, strpos($user, $at));


      while (!feof($VIRTTABLE))
      {

         $line = fgets($VIRTTABLE, 4096);
         $line = trim($line);


         // skip blank lines and comment lines
         //
         if (strpos($line, '#') === 0 || strlen($line) < 3)
            continue;


         // parse fields out
         //
         preg_match('/^(\S+)\s+(\S+)/', $line, $matches);


         // grab catchall login
         //
         if ($domainName === $matches[1]) 
            $catchallLogin = $matches[2];


         // if user is found, get remapped login and return
         //
         if ($user === $matches[1]) 
         {
            fclose($VIRTTABLE);
            return $matches[2];
         }

      }


      fclose($VIRTTABLE);


   }


   // if we got here and a catchall login is available, use it
   //
   if (!empty($catchallLogin))
   {

      // remove extraneous stuff we don't need off end (begins with plus sign)
      //
      $catchallLogin = preg_replace('/\+%\S+\s*$/', '', $catchallLogin);

      return $catchallLogin;

   }


   // otherwise, unaltered username is returned
   //
   return $user;

}



/**
  * Allows control over which options are displayed on options pages
  *
  */
function vlogin_display_options_do()
{

   global $config_override, $optpage_data;

   $overrides = array();


   // try to get configuration settings from session, if they're there
   //
   if (!isset($config_override))
   {

      global $virtualDomains, $useSessionBased;
      include_once (SM_PATH . 'plugins/vlogin/data/config.php');

      if (!$useSessionBased)
      {

         // allow inclusion of external configuration files for each domain
         //
         if (file_exists(SM_PATH . 'plugins/vlogin/data/domains/' . $hostname_stripped . '.vlogin.config.php'))
            include_once(SM_PATH . 'plugins/vlogin/data/domains/' . $hostname_stripped . '.vlogin.config.php');

         if (is_array($virtualDomains))
            $overrides = $virtualDomains;

      }

   }
   else
      $overrides = $config_override;



   // remove any options from list of options as desired
   //
   if (isset($overrides['disable_options']) && is_array($overrides['disable_options']))
      foreach ($overrides['disable_options'] as $removeOptionName)
         foreach ($optpage_data['vals'] as $groupNumber => $optionGroup)
            foreach ($optionGroup as $optionNumber => $optionItem)
               if (isset($optionItem['name']) && $optionItem['name'] == $removeOptionName)
                  unset($optpage_data['vals'][$groupNumber][$optionNumber]);

}



?>
