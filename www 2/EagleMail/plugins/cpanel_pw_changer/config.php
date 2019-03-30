<?php 
//What are your CPanel "login" values?
//They are needed for authentication when calling CPanel files directly.
//Don't worry, nothing will be displayed to the user!

$cpanel_un = "pgpbox";	// Your Cpanel username.
$cpanel_pw = "pgpbox";	// Your CPanel password.


//Where is the CPanel pop password change file located?
//This will be different for every CPanel theme. You can find the file
//location by going into the CPanel POP Email Accounts area and then 
//right-clicking on the "Change Password" link.  Choose the 
//"Copy shortcut" option and then cut/paste it here.
//NOTE: Do NOT include the domain/port info or anything after the filename.

$cpanel_file_location = "/frontend/x2/mail/passwdpop.html";


//This is the text string that will be used to determine if the password
//change was successful or not.  Since this string may be different for
//every theme, you should perform a password change using CPanel and then
//find some text that is *displayed* (visable) ONLY when the change was 
//successful. In other words, if this string is found in the CPanel results 
//then the//pw change is considered successful.  If this string is NOT found 
//then the pw change is considered NOT successful.

$cpanel_success_string = "was successfully modified";


//If you want see the raw output of the CPanel command, set this to true.
//The default is true. (You should set this to false before allowing
//general users to use this plugin.)

$show_cpanel_output = true;


//Should the user be automatically logged out from SM after password change?
//If set to true, then the $show_cpanel_response setting is ignored.
//The default is false.

$disconnect = false;


//Do you want to change the password of a "web protected" (htaccess) file, too?
//This is useful if the SAME username/password combination is beingused to 
//protect a folder. It will keep things in synch for you.
//NOTE: The folder must already be protected using the CPanel "web protect" 
//tool using the same username used for the email account.
//The default is false.

$do_htaccess_change = false;

//If you have set $do_htaccess_change to true, then you MUST also set the 
//following values:

$protect_file_path = "/home/candev/public_html/contractors";	// Full path to protected folder
$cpanel_protect_file_location = "/frontend/iconic/htaccess/newuser.html";	// Location of CPanel file.
$cpanel_protect_success_string = "now has the password";	//Text to look for to determine success.


//Include the languages file of your preference. They are listed 
//inside of the language folder. If you make a new file in your 
//language, please send it to the plugin developers to it can be 
//included in this package.
//The default is the English language file.

$language_file = 'english.php';

?>