<?php


include("../include/common.php");

loginCheckVisitor('User');

include("$config[template_path]/user_top.html");

if ($searchID == "")
{
  echo "<a href=\"../index.php\">$lang[perhaps_you_were_looking_something_else]</a>";
}	


elseif ($searchID != "")
{
  make_db_safe($userID);
  make_db_safe($searchID);
  
  $sql = "DELETE FROM " . $config[table_prefix] . "userSavedSearches WHERE ID = $searchID";
  $recordSet = $conn->Execute($sql);
  if ($recordSet === false) log_error($sql);
  echo "<br>$lang[search_deleted_from_favorites]";  
}

include("$config[template_path]/user_bottom.html");

?>