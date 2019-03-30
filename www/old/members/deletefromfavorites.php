<?php


include("../include/common.php");

loginCheckVisitor('User');

include("$config[template_path]/user_top.html");

if ($listingID == "")
{
  echo "<a href=\"../index.php\">$lang[perhaps_you_were_looking_something_else]</a>";
}	


elseif ($listingID != "")
{
  make_db_safe($userID);
  make_db_safe($listingID);
  
  $sql = "DELETE FROM " . $config[table_prefix] . "userFavoriteListings WHERE user_ID = $userID AND listing_ID = $listingID";
  $recordSet = $conn->Execute($sql);
  if ($recordSet === false) log_error($sql);
  echo "<br>$lang[listing_deleted_from_favorites]";  
}

include("$config[template_path]/user_bottom.html");

?>