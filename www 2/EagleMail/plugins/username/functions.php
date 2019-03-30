<?php
   /*
    *  Username display
    *
    */

   global $usernameMotdWelcomeMessage, $add_domain_to_username, $username_replaces_motd;


   // include compatibility plugin
   //
   if (defined('SM_PATH'))
      include_once(SM_PATH . 'plugins/compatibility/functions.php');
   else if (file_exists('../plugins/compatibility/functions.php'))
      include_once('../plugins/compatibility/functions.php');
   else if (file_exists('./plugins/compatibility/functions.php'))
      include_once('./plugins/compatibility/functions.php');



   if (compatibility_check_sm_version(1, 3))
      include_once (SM_PATH . 'plugins/username/config.php');
   else
      include_once ('../plugins/username/config.php');



   function username_show_LMB_do() {
      global $show_username, $show_username_pos;
      
      if ($show_username && ($show_username_pos == 'top' || 
                             $show_username_pos == ''))
         username_show();
   }


   function username_show_LMA_do() {
      global $show_username, $show_username_pos;
      
      if ($show_username && $show_username_pos == 'bottom')
         username_show();
   }


   function username_show() {
      global $color, $username, $show_username, $domain, $add_domain_to_username;
      
      if (! $show_username)
         return;
	 
      ?>
<table align="center" cellpadding="0" cellspacing="0" border="0" bgcolor="<?php echo $color[10] ?>"><tr><td>
<table width="100%" cellpadding="2" cellspacing="1" border="0" bgcolor="<?php echo $color[5] ?>"><tr><td align="center">
<small><?php
      
      if ($show_username == 1)
          echo $username;
      if ($show_username == 2)
          echo _("Logged in as:") . ' ' . $username;
      if ($add_domain_to_username)
          echo '@' . $domain;
       
?></small>
</td></tr></table>
</td></tr></table>
<br>
<?php
   }


   function username_show_motd_do() {

      global $motd, $username, $username_motd, $domain, 
             $username_replaces_motd, $add_domain_to_username, 
             $usernameMotdWelcomeMessage;

      if ($username_motd && $username_replaces_motd)
         $motd = str_replace('###USERNAME###', 
                             ($add_domain_to_username ? 
                                 $username . '@' . $domain : 
                                 $username), 
                             $usernameMotdWelcomeMessage);

      else if ($username_motd)
         $motd = str_replace('###USERNAME###', 
                             ($add_domain_to_username ? 
                                 $username . '@' . $domain : 
                                 $username), 
                             $usernameMotdWelcomeMessage)
         . (!empty($motd) ? '<hr />' . $motd : '');
         //. (!empty($motd) ? '<br /><br />' . $motd : '');
   }


   function username_show_options_do() {
      global $show_username, $show_username_pos, $username_motd, 
             $username, $data_dir, $domain, $add_domain_to_username;
      ?>
         <tr>
            <td align=right>Show Username:</td>
            <td>
               <select name="username_in">
               <?php
	          if ($show_username == 0 || $show_username == '')
		     $sel = ' selected';
		  echo "<option value=0$sel>" . _("Don't show") . "\n";
		  $sel = '';

	          if ($show_username == 1)
		     $sel = ' selected';
		  echo "<option value=1$sel>$username";
                  if ($add_domain_to_username)
                      echo '@' . $domain;
                  echo "\n";
		  $sel = '';

	          if ($show_username == 2)
		     $sel = ' selected';
		  echo "<option value=2$sel>" . _("Logged in as:") . "  $username";
                  if ($add_domain_to_username)
                      echo '@' . $domain;
                  echo "\n";
		  $sel = '';
               ?>
               </select>
            </td>
         </tr>
         <tr>
            <td align=right>Show Username Position:</td>
            <td>
               <select name="username_pos">
               <?php
	          if ($show_username_pos == 'top' || $show_username_pos == '')
		     $sel = ' selected';
		  echo "<option value=top$sel>" . _("Above folder list") . "\n";
		  $sel = '';
		  
	          if ($show_username_pos == 'bottom')
		     $sel = ' selected';
		  echo "<option value=bottom$sel>" . _("Below folder list") . "\n";
		  $sel = '';
               ?>   
               </select>
            </td>
         </tr>
         <tr>
            <td align=right nowrap> 
               <?php echo _("Show Username in Message Of The Day:") ?>
           </td>
           <td>
              <input type="radio" name="username_motd" value="1"
<?php
   if ($username_motd == 1) {
      echo 'CHECKED';
   }
   echo '>&nbsp;' . _("Yes") . '&nbsp;&nbsp;&nbsp;&nbsp;<input type="radio" name="username_motd" value="0"';
   if ($username_motd == 0)  {
      echo 'CHECKED';
   }
?>
           >&nbsp;<?php echo _("No") ?>
        </td>
      </tr>
      <?php
   }

   function username_save_options_do() {
      global $data_dir, $username, $username_in, $username_pos, $username_motd;
      compatibility_sqextractGlobalVar('username_in');
      compatibility_sqextractGlobalVar('username_pos');
      compatibility_sqextractGlobalVar('username_motd');

      setPref($data_dir, $username, 'show_username', $username_in);
      setPref($data_dir, $username, 'show_username_pos', $username_pos);
      setPref($data_dir, $username, 'username_motd', $username_motd);
   }

   function username_load_options_do() {
      global $username_motd, $show_username, $show_username_pos, 
             $username, $data_dir, $add_domain_to_username;

      $show_username = getPref($data_dir, $username, 'show_username');
      $show_username_pos = getPref($data_dir, $username, 'show_username_pos');
      $username_motd = getPref($data_dir, $username, 'username_motd', 0);
      //$add_domain_to_username = getPref($data_dir, $username, 'add_domain_to_username', 0);
   }


?>
