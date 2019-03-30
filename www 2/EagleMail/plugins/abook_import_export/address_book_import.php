<?PHP

  /**
   **  address_book_import.php
   **    
   **  Copyright (c) 1999-2000 The SquirrelMail development team
   **  Licensed under the GNU GPL. For full terms see the file COPYING.
   **            
   **    Import csv files for address book
   **      This takes a comma delimited file uploaded from addressbook.php
   **      and allows the user to rearrange the field order to better
   **      fit the address book. A subset of data is manipulated to save time.
   **
   **   This was a part of the Squirrelmail source tree and is being ported
   **   to a plugin.
   **/

   define( 'SM_PATH' , '../../');

   require_once(SM_PATH . 'include/validate.php');
   include_once(SM_PATH . 'functions/page_header.php');
   include_once(SM_PATH . 'functions/addressbook.php');
   include_once(SM_PATH . 'include/load_prefs.php');


   // Local Variables
   $errorstring = '';
   $finish = '';
   $csvmax = 0;
   $key = 0;
   $x = 0;
   $row = 0;
   $cols = 0;
   $colspan = 0;
   $c = 0;
   $error = 0;
   $reorg = array();
   $selrow = '';

   global $color;
   
    // Grab the needed variable
   $finish = (isset($_POST['finish'])?$_POST['finish']:'');

// Here we will split the script into finished and not finished parts 
if (!$finish) {

   displayPageHeader($color, "None");

   // Check to make sure the user actually put a file in the upload file box. 
   $smusercsv = $_FILES['smusercsv'];
 
   if ($smusercsv['tmp_name'] == '' || $smusercsv['size'] == 0) {
      echo '
      <br><br>
      <table align="center">
      <tr>
      <td>' . _("Please select a file for uploading.  You can do this by clicking on the browse button on the ") . '<a href="' . SM_PATH .  'src/addressbook.php">' . _("Address Book") . '</a> ' . _("page.") . '</td>
      </tr>
      </table>
      </body>
      </html>
      ';

      exit;
   }

   /**
    ** Use file() to get the data from the php temp file into an array so 
    ** that we don't have to save files on the server. 
    **/

   // These shouldn't be set at all at this point. 
   $_SESSION['csvdata'] = array(); 
   $_SESSION['csvorder'] = array();

   $csvfile = @fopen($smusercsv['tmp_name'],"r");

   if (!$csvfile) {
     echo '
     <br><br>
     <table align="center">
        <tr>
           <td>' . _("Error, could not open address file.") . '</td>
        </tr>
     </table>
     ';

     exit;
   }
   
   while ($csvarray = fgetcsv($csvfile,$smusercsv['size'])) { 
      // Let fgetcsv deal with splitting the line into it's parts. (I.E. it deals with quoted commas right. 
      $temp = CSVProcess($csvarray);
      
      if (count($temp) >2) {
         $_SESSION['csvdata'][$key] = $temp;
         $key++;
      }
      elseif (isset($temp[0])) { 
         //This means it returned an error
         $errorstring .= $temp[0] . '<p>';
      } 

      // After this, the function was just doing some calculations, and returned without a problem.
      if(count($csvarray) > $csvmax) {
         $csvmax = count($csvarray);
      }
   }

   unset($_SESSION['csvorder']);

   echo '
   <FORM METHOD="post" action="' . $PHP_SELF . '">
   <INPUT TYPE="submit" NAME="finish" VALUE="Finish" TABINDEX="4">';
    echo "<br>\n";
    echo _("Add to addressbook:")." ";
    $abook = addressbook_init(true, true);
    if ( $abook->numbackends > 1 ) {
	echo "<select name=backend>";
	$backends = $abook->get_backend_list();
	while (list($undef,$v) = each($backends)) {
	    if ($v->writeable) {
		echo '<OPTION VALUE=' . $v->bnum;
		echo '>' . $v->sname . "\n";
	    }
	}
	echo "</select>";
    } else {
	echo '<input type=hidden name=backend value=1>';
    }
   echo '<CENTER><TABLE WIDTH="95%" FRAME="void" CELLSPACING="1">';    // user's data table

   // Here I will create the headers that I want.
   echo '
   <TR BGCOLOR="' . $color[9] . '" ALIGN="center">
   <TD WIDTH="1">' .  _("Omit") . '</TD>
   '; // The Omit column

   for($x = 0; $x < $csvmax; $x++) { // The Drop down boxes to select what each column is
      echo '<TD>';
      create_Select($csvmax,$x); 
      echo '</TD>
      ';
   }

   echo '</TR>
   ';

   do {
      if (count($_SESSION['csvdata'][$row]) >= 5) {    // This if ensures the minimum number of columns
         $cols = count($_SESSION['csvdata'][$row]);    // so importing can function for all 5 fields
      } else {
         $cols = 5;
      }        

      $colspan = $cols + 1;
      if ($row % 2) {                   // Set up the alternating colored rows
         echo '<TR BGCOLOR="' . $color[0] . '">
         ';
      } else {
         echo '<TR>
         ';
      }

      echo '<TD WIDTH="1"><INPUT TYPE="checkbox" NAME="sel' . $row . '">
      '; // Print the omit checkbox, to be checked before write

      for($c = 0; $c < $cols; $c++) { // For each column in the current row
         if ($_SESSION['csvdata'][$row][$c] != "") {                                // if not empty, put data in cell.
            echo '<TD NOWRAP>' . $_SESSION['csvdata'][$row][$c] . '</TD>
            ';
         } else {                                          // if empty, put space in cell keeping colors correct.
            echo '<TD>&nbsp;</TD>
            ';
         }
      }
      echo '</TR>
      ';
      $row++;
   } while ($row < count($_SESSION['csvdata']));
   
   echo '
   </TABLE>
   </CENTER>
   ';

   if(strlen($errorstring)) {   
      echo _("The following rows have errors") . ': <p>
      ' . $errorstring;
   }
   
} else {
   /** 
    **   $abook ---->Setup the addressbook functions for Pallo's Addressbook.
    **/
   $abook = addressbook_init(true, true); // We only need to do this here because we will only access the address book in this section

   do {
      if (count($_SESSION['csvdata'][$row]) >= 5) {    // This if ensures the minimum number of columns
         $cols = count($_SESSION['csvdata'][$row]);    // so importing can function for all 5 fields
      } else {
         $cols = 5;
      }  
            
      $reorg = array('', '', '', '', '');
      
      for ($c=0; $c < $cols; $c++) {
         // Reorganize the data to fit the header cells that the user chose
         // concatenate fields based on user input into text boxes.
         $column = "COL$c";
         
         if($_POST[$column] != 5)  {
            if ($_POST[$column] == 4) {
               $reorg[4] .= $_SESSION['csvdata'][$row][$c] . ";";
            } else {
               $reorg[$_POST[$column]] = $_SESSION['csvdata'][$row][$c];
               $reorg[$c] = trim($reorg[$c],"\r\n \"");
            }
         }
      }
      
      $reorg[4] = trim($reorg[4],";");
      $_SESSION['csvdata'][$row] = $reorg;
      unset($reorg); // So that we don't get any weird information from a previous rows

      // If finished, do the import. This uses Pallo's excellent class and object stuff 
      $selrow = 'sel' . $row;
      
      if (!isset($_POST[$selrow])) {
         if (eregi('[ \\:\\|\\#\\"\\!]', $_SESSION['csvdata'][$row][0])) {
            $_SESSION['csvdata'][$row][0] = '';
         }

         //Here we should create the right data to input 
         if (count($_SESSION['csvdata'][$row]) < 5) {
            array_pad($_SESSION['csvdata'][$row],5,'');
         }

         $addaddr['nickname'] 	= $_SESSION['csvdata'][$row][0];
         $addaddr['firstname'] 	= $_SESSION['csvdata'][$row][1];
         $addaddr['lastname'] 	= $_SESSION['csvdata'][$row][2];
         $addaddr['email'] 	= $_SESSION['csvdata'][$row][3];
         $addaddr['label'] 	= $_SESSION['csvdata'][$row][4];

        if (isset($_POST['backend'])) {                                                                                                                            
         if (false == $abook->add($addaddr,$_POST['backend'])) {
            $errorstring .= $abook->error . "<br>\n";
            $error++;
         }
        } else {                                                                                                                                          
         if (false == $abook->add($addaddr,$abook->localbackend)) {
            $errorstring .= $abook->error . "<br>\n";
            $error++;
         }
        }


         unset($addaddr); // Also so we don't get any weird information from previous rows
      }
      
      $row++;
      
   } while($row < count($_SESSION['csvdata']));

   unset($_SESSION['csvdata']); // Now that we've uploaded this information, we dont' need this variable anymore, aka cleanup

   // Print out that we've completed this operation
   if ($error) {
      // Since we will print something to the page at this point
      displayPageHeader($color, "None");

      echo '<BR>' . _("There were errors uploading the data, as listed below. Entries not listed here were uploaded.") . '<br> ' . $errorstring . '<BR> ';
   } else {
      // Since we will print something to the page at this point
      displayPageHeader($color, "None");

      echo '<BR><BR><H1><STRONG><CENTER>' . _("Upload Completed!") . '</STRONG></H1>' . _("Click on the link below to verify your work.") . '</CENTER>';
   }

   echo '<BR><BR><CENTER><A HREF="' . SM_PATH . 'src/addressbook.php">' . _("Addresses") . '</A></CENTER>
   ';
}

   // Send the field numbers entered in the text boxes by the user back to this script for more processing
   // email is handled differently, not being an array
function create_Select($csvmax,$column) {
   // $column is the one that should be selected out of the bunch
   echo "<SELECT NAME=\"COL$column\">\n";

   if($column > 5)
    $column = 5; // So we have only our normal choices. 
    
   for($temp = 0; $temp <= 5; $temp++) {
      echo "<OPTION value=$temp ";
      if ($column==$temp)
        echo "SELECTED";
      if ($temp == 0)
        echo ">Nickname</option>\n";
      if ($temp == 1)
        echo ">First Name</option>\n";
      if ($temp == 2)
        echo ">Last Name</option>\n";
      if ($temp == 3)
        echo ">Email</option>\n";
      if ($temp == 4)
        echo ">Additional Info</option>\n";
      if ($temp == 5)
        echo ">Do Not Include</option>\n";
   }
   echo "</select>\n";
}

function CSVProcess($row) {
   if (preg_grep("/((?:\/ou\=)|(?:\/cn\=)|(?:\/o\=))/",$row)) {
      $temprow = join(",",$row);
      $return[] = "$temprow <br> - ". _("contains LDIF email address. This is not currently supported.")."\n";
      return $return;
   }
   
   if (preg_grep("/((?:First Name)|(?:Last Name)|(?:E-mail Address))/",$row)) {
      foreach($row as $key => $value) {
         if ($value == "First Name" ) { 
            if(isset($_SESSION['csvorder'][$key])) { 
               $_SESSION['csvorder'][1] = $_SESSION['csvorder'][$key]; 
            }
            else { 
               $_SESSION['csvorder'][1]= $key; 
            }
         }
         if ($value == "Last Name" ) { 
            if(isset($_SESSION['csvorder'][$key])) { 
               $_SESSION['csvorder'][2] = $_SESSION['csvorder'][$key]; 
            }
            else { 
               $_SESSION['csvorder'][2]= $key; 
            }
         }
         if ($value == "E-mail Address" ) { 
            if(isset($_SESSION['csvorder'][$key])) { 
               $_SESSION['csvorder'][3] = $_SESSION['csvorder'][$key]; 
            }
            else { 
               $_SESSION['csvorder'][3]= $key; 
            }
         }
      }
      return array();
   }
   
   if (count($_SESSION['csvorder']) > 0) { // This is swapping elements to make firstname, last name, and email be in the 1,2,3 spot, respectively
      foreach($_SESSION['csvorder'] as $key => $value) {
         $temp = $row[$key];
         $row[$key] = $row[$value];
         $row[$value] = $temp;
      }
      return $row;
   }
   
   return $row;
}
  
?>
</FORM>
</BODY>
</HTML>
