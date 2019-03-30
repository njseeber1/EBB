 <table width="130" border="0" cellspacing="0" cellpadding="2">
  <tr> 
    <td align="right" valign="middle"><table border="0" cellspacing="0" cellpadding="4">
        <tr> 
          <td align="center"> <form>
              <select name="choice" size="1" onChange="jump(this.form)" style="background-color: #CCCCCC">
                <option selected>Quick Search</option>
                <option value="<?php echo $config[baseurl]; ?>/listingsearch.php">Search 
                Listings</option>
                <option value="<?php echo $config[baseurl]; ?>/listing_browse.php">Browse 
                Listings</option>
                <option value="<?php echo $config[baseurl]; ?>/latest_listings.php">Latest 
                Listings</option>
                <option value="<?php echo $config[baseurl]; ?>/rentalsearch.php">Rentals</option>
                <option value="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Home">Residential</option>
                <option value="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Commercial">Commercial</option>
                <option value="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=Land">Vacant 
                Land</option>
                <option value="<?php echo $config[baseurl]; ?>/listing_browse.php?type%5B%5D=farms">Rural</option>
              </select>
            </form></td>
        </tr>
      </table></td>
  </tr>
  <tr> 
    <td class= "header">Listing Links</td>
  </tr>
  <tr>
    <td><div id="navcontainer"> 
        <ul id="navlist">
          <li><a href="javascript:open_window('calc.php?price=<? renderSingleListingItemRaw($listingID, "price") ?>')">Mortgage 
            Calculator</a></li>
          <li><a href="members/addtofavorites.php?listingID=<? echo $listingID; ?>">Add 
            To Favorites</a></li>
          <li><a href="appointment.php?listingID=<?php echo $listingID ?>">Make 
            Appointment</a></li>
          <li><a href="listingview.php?listingID=<?php echo $listingID ?>&amp;printer_friendly=yes">Print 
            Page</a></li>
          <li><a href="email_listing.php?listingID=<?php echo $listingID ?>">E-Mail 
            To Friend</a></li>
          <li> 
            <?php makeYahooMap($listingID, "address", "city", "zip") ?>
          </li>
        </ul>
      </div></td>
  </tr>
  <tr> 
    <td class= "header">Member Tools</td>
  </tr>
  <tr> 
    <td><div id="navcontainer"> 
        <ul id="navlist">
          <li><a href="<?php echo $config[baseurl]; ?>/modules/list_public.php">Join 
            Mail List</a></li>
          <li><a href="<?php echo $config[baseurl]; ?>/members/listfavorites.php">My 
            Favorites</a></li>
          <li><a href="<?php echo $config[baseurl]; ?>/members/listsavedsearches.php">Saved 
            Searches</a></li>
        </ul>
      </div></td>
  </tr>
  <tr> 
    <td class = "header">Resources</td>
  </tr>
  <tr> 
    <td><div id="navcontainer"> 
        <ul id="navlist">
          <li><a href="<?php echo $config[baseurl]; ?>/modules/calculators/simulator.php">Loan 
            Simulator</a></li>
          <li><a href="<?php echo $config[baseurl]; ?>/modules/glossary.php">Glossary</a></li>
          <li><a href="<?php echo $config[baseurl]; ?>/modules/calculators.php">Calculators</a></li>
        </ul>
      </div></td>
  </tr>
  <tr> 
    <td class = "header">Links</td>
  </tr>
  <tr> 
    <td><div id="navcontainer"> 
        <ul id="navlist">
          <li><a href="http://www.realestateclipart.com/" target="_blank">Real 
            Estate Clip Art</a></li>
        </ul>
      </div></td>
  </tr>
  <tr> 
    <td>&nbsp;</td>
  </tr>
</table>
