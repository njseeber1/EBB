<?php
/************************************************
* English language translation file             *
* By Henri Straforelli (henri@etwebhosting.com) *
************************************************/

$optionTitle = "Change Password";
$optionDescription = "Change your account password.";

$status[1] = "You forgot the user name.";
$status[2] = "You must enter the new password in both boxes.";
$status[3] = "The new password must be at least six characters long.";
$status[4] = "The new password must be less then 15 characters long.";
$status[5] = "You entered a different new password in both boxes.";

$statusEmailChangeSUCCESS = "Your password was changed successfully";
$statusEmailChangeFAILURE = "A problem occurred and your email password was NOT changed.";
$statusWebProtectChangeSUCCESS = "";	//Leave blank unless you want a different success message.
$statusWebProtectChangeFAILURE = "A problem occurred and your 'Contractor Only Area' password was NOT changed.";

$formTitle = "Change your account password";
$formInstructions = "&nbsp;&nbsp;Please read the following instructions before changing your password:"
		."<ul>"
		."<li>You may use letters, numbers, and other special characters on your keyboard.<br>"
		."<li>The new password is letter-case sensitive, meaning an 'A' is not the same as an 'a'.<br>"
		."<li>The new password must be six (6) to fifteen (15) characters long.<br>"
		."<li>The new password should contain at least three (3) letters (a-z) and two (2) digits (0-9).<br>"
		//."<li>After the password change is completed, you will be automatically logged out. You must then login again with your new password."
		."</ul>";

$formUsername = "Your account name:";
$formNewPw1 = "New password:";
$formNewPw2 = "Confirm the new password:";
$formSubmitButton = "Change Password";

?>