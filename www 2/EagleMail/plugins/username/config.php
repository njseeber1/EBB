<?php

   global $usernameMotdWelcomeMessage, $add_domain_to_username, $username_replaces_motd;



   // Set format of welcome message here
   //
   // Use the constant "###USERNAME###" (without the quotes)
   // to indicate where the username should be placed in the
   // message.  Most HTML tags are OK.
   //
   $usernameMotdWelcomeMessage = 'Welcome, <font color="red">###USERNAME###</font>!';


   // When users choose to see the username in the MOTD,
   // should it replace the MOTD or be used together with
   // the MOTD?  (username comes first in such case,
   // above the MOTD)
   //
   $username_replaces_motd = 0;


   // Do you want to display "@domain.com" after the username?
   // If so, set this to 1, otherwise, set it to zero.
   //
   $add_domain_to_username = 1;



?>
