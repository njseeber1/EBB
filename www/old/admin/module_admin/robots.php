<?php
//error_reporting(E_ALL);
/* ***************************************************** */
/*  ROBOTS MOD FOR OPEN REALTY 1.1.0+ VERSION 241003  */
/*              RealtyOne www.outbackweb.net             */
/* ***************************************************** */
include("../../include/common.php");

loginCheck('Admin');

include("$config[template_path]/admin_top.html");
//$dir = $config[baseurl];



?>


<H3><?php echo $lang['robot_header'] ?></H3>
<p><?php echo $lang['robot_instructions'] ?></p>
<?php

if($deletefile)
{
  if(unlink("robots.txt"))
    print "<font color=green>$lang[robot_delete_success]</font><br>";
  else
    print "<font color=red>$lang[robot_delete_failed]</font><br>";
}

if (!isset($dir) || (!$dir))
  $dir =".";
if (is_dir($dir))
{
  chdir($dir);
  $dir = getcwd();
}
if ($dir[strlen($dir)-1] != "/")
  $dir.="/";

if (!file_exists("index.html") && !file_exists("index.php") && !file_exists(".htaccess") && !file_exists(".htpasswd"))
  print "<font color=red>$lang[robot_warn_insecure]</font><br>";
else
{
  print "<font color=green>$lang[robot_sercured_by]: ";
  if (file_exists("index.html")) print "index.html, ";
  if (file_exists("index.php"))  print "index.php, ";
  if (file_exists(".htaccess")) print ".htaccess, ";
  if (file_exists("index.html")) print ".htpasswd, ";
  print "</font><br>";
}

if($update)
{
	$today = getdate();
	$month = $today["month"];
	$mday = $today["mday"];
	$year = $today["year"];
	$theDate = "$mday $month $year";
    $file = fopen ("robots.txt", "w");
	fputs($file,"# $comment\n");
	fputs($file,"# $config[site_title] robots.txt\n");
    fputs($file,"# Updated @ $theDate  By $username\n\n");
	fputs($file,"User-agent: *\n");

    $i = 1;
    $d = GetDirArray($dir);
    while(list($key,$entry)=each($d))
    {
      if (is_dir($dir.$entry) && ($entry != ".") && ($entry != ".."))
      {
        if(!$id[$i]=="on")
          fputs($file,"Disallow: /".$entry."/\n");
        $i++;
      }
    }
    fclose($file);
    print "<font color=blue>$lang[robot_update_success]</font><br>";
}

if (!file_exists("robots.txt"))
{
    print "<font color=red>$lang[robot_not_found]</font>";
}
else
{
    $file = fopen ("robots.txt", "r");
    print "<font color=green>$lang[robot_found_and_read]</font>";
    $comment = fgets ($file, 1024);
    $comment = substr($comment, 2);
    //overread 2 lines
    $dummy = fgets ($file, 1024);
    $dummy = fgets ($file, 1024);
    while (!feof ($file))
    {
        $line = fgets ($file, 1024);
        $line = substr($line, 11, strlen($line) - 13);
        $disallowed[$line] = true;
    }
    fclose($file);
}

print "<form action='$PHP_SELF'>";
print "<input type='hidden' value=1 name=changedir>";
print "<input type='text' size=70 name=dir value='$config[basepath]'>";
print "<input type='submit' value='$lang[robot_change_dir]'>";
print "</form>";
print "<form action='$PHP_SELF'>";
print "<input type=hidden name=dir value='$dir'>";

echo "<table border=\"1\" align=\"center\" width=\"90%\"><tr>";
echo "<tr><th width=\"50%\">$lang[robot_Directory_Structure]</th><th width=\"50%\">$lang[robot_Current_Robot_File]</th></tr>";
echo "<td align=\"center\">";
echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='$PHP_SELF?changedir=1&dir=/'>/</a><br>\n";
$d = GetDirArray($dir);
$i = 0;

while(list($key,$entry)=each($d))
{
  if (is_dir($dir.$entry) && ($entry != "."))
  {
    if($i)
    {
      if($disallowed[$entry])
        echo "<input type='checkbox' name='id[$i]'>&nbsp;<a href='$PHP_SELF?changedir=1&dir=$dir$entry'>".$entry."</a><br>\n";
      else
        echo "<input type='checkbox' name='id[$i]' checked=true>&nbsp;<a href='$PHP_SELF?changedir=1&dir=$dir$entry'>".$entry."</a><br>\n";
    }
    else
      echo "&nbsp;&nbsp;&nbsp;&nbsp;<a href='$PHP_SELF?changedir=1&dir=$dir$entry'>".$entry."</a><br>\n";
    $i++;
  }
}
echo "</td><td align=\"center\">";
$file="$config[basepath]/robots.txt";
@chmod ($file, 0777);
	$fp=fopen($file, "a+");
	echo "<textarea readonly style=\"width:100%; height:100%;border:0px;\">";
	while (!feof($fp))
	{
		$data=fgets($fp, 900);
		echo $data;
	}
	echo "</textarea>";
	fclose($fp);
echo "</td></tr></table>";
print "<br>$lang[robot_comment]:<br><input type=text size=70 name=comment value='$comment'><br>";
print "<br><input type=submit value='$lang[robot_update]' style=\"color:green\">";
print "<input type='hidden' value=1 name=update>";
print "</form>";

print "<form action='$PHP_SELF'>";
print "<input type='hidden' value=1 name=deletefile>";
print "<input type=submit value='$lang[robot_delete]' style=\"color:red\">";
print "</form>";


function GetDirArray($sPath)
{
//Load Directory Into Array
$handle=opendir($config['basepath']);
while ($file = readdir($handle))
$retVal[count($retVal)] = $file;

//Clean up and sort
closedir($handle);
natcasesort($retVal);
return $retVal;
}

include("$config[template_path]/admin_bottom.html");
?>

