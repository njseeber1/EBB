<?php
$lang = array();
v("../");

function v($a = "", $sp = "") {
   global $lang;
   $d = @dir($a);
   while (false !== ($entry = $d->read())) {
      if (@is_file($a . $entry)) {
         print $sp . "File - $a$entry<br>\n";
         $file = fopen ($a . $entry, 'r');
         $l = 0;
         $x = 0;
         while (!feof($file)) {
            $l++;
            $f = fgets($file, 90000);
            preg_match_all ("/\_\(\"+[0-9a-zA-Z\s\.\,\'\(\)\_]+\"\)/", $f, $matches);
            if (isset($matches[0][0])) {
               for ($c = 0; $c < count($matches[0]); $c++) {
                  preg_match_all ("/[0-9a-zA-Z\s\.\,\'\(\)\_]+/", $matches[0][$c], $match);

                  $found = false;
                  for ($b = 0; $b < count($lang); $b++) {
                     if ($lang[$b]['text'] == $match[0][1]) {
                        $found = true;
                        $lang[$b]['file'] = $a . $entry . ':' . "$l\r\n#: " . $lang[$b]['file'];
                        $x++; 
                     }
                  }
                  if ($found == false) {
                     $lang[] = array('file' => $a . $entry, 'line' => $l, 'text' => $match[0][1]);
                     $x++;
                  }
               }
            }
         }
         fclose($file);
         print $sp . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--- $x Found<br>\r\n";
      }
      if (@is_dir($a . $entry)) {
         if ($entry != '.' && $entry != '..' && $entry != 'locale') {
            print $sp . "Dir - $a$entry<br>\n";
            v($a . $entry . "/", $sp . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;");
         }
      }
   }
}


$file = fopen('virus_scan.po','wb');
fwrite($file, "# SOME DESCRIPTIVE TITLE.
# Copyright (C) YEAR THE PACKAGE'S COPYRIGHT HOLDER
# This file is distributed under the same license as the PACKAGE package.
# FIRST AUTHOR <EMAIL@ADDRESS>, YEAR.
#
#, fuzzy
msgid \"\"
msgstr \"\"
\"Project-Id-Version: PACKAGE VERSION\\n\"
\"POT-Creation-Date: 2003-3-1 22:19-0700\\n\"
\"PO-Revision-Date: YEAR-MO-DA HO:MI+ZONE\\n\"
\"Last-Translator: FULL NAME <EMAIL@ADDRESS>\\n\"
\"Language-Team: LANGUAGE <LL@li.org>\\n\"
\"MIME-Version: 1.0\\n\"
\"Content-Type: text/plain; charset=REMEMBER-TO-SET-CHARSET\\n\"
\"Content-Transfer-Encoding: 8bit\\n\"");

for ($a = 0; $a < count($lang); $a++) {
   fwrite($file, "\r\n\r\n#: " . $lang[$a]['file'] . ':' . $lang[$a]['line'] . "\r\n");
   fwrite($file, 'msgid "' . $lang[$a]['text'] . "\"\r\n");
   fwrite($file, 'msgstr ""');
}
fwrite($file, "\r\n\r\n");
fclose($file);

?>