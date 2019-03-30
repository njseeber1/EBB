<?php

  // Global Variables, don't touch these unless you want to break the plugin  
  //
  global $notPartOfDomainName, $numberOfDotSections, $useSessionBased,
         $putHostNameOnFrontOfUsername, $checkByExcludeList,
         $at, $dot, $dontUseHostName, $perUserSettingsFile,
         $smHostIsDomainThatUserLoggedInWith, $virtualDomains,
         $sendmailVirtualUserTable, $virtualDomainDataDir,
         $allVirtualDomainsAreUnderOneSSLHost, $debug, $removeFromFront,
         $chopOffDotSectionsFromRight, $chopOffDotSectionsFromLeft,
         $translateHostnameTable, $pathToQmail, $atConversion,
         $removeDomainIfGiven, $alwaysAddHostName, $reverseDotSectionOrder,
         $replacements;



  // list of domain-specific attributes (note that each domain is 
  // specified in this array by any string that is unique to the 
  // virtual host name (not necessarily the whole host name -- 
  // "mydomain" is probably enough to represent "mydomain.com")
  //
  $virtualDomains = array(


//      'domain2' => array(
//          'org_name'   => 'My Domain 2',
//          'org_logo'   => '../images/domain2_image.gif',
//          'org_title'  => '(isset($_SESSION["username"]) ? $_SESSION["username"] . " - Mail" : "Mail")',
//  //  NOTE: The above line is an example of 
//  //        how you can place the user's
//  //        email address in the SquirrelMail
//  //        title bar.
//      ),


  );


  // turn this on to test your configuration settings - the final
  // IMAP login value will be presented after all processing has
  // been completed
  //
  $debug = 0;


?>
