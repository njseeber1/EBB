<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Listings';
	include_once('listingDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtListing = GetListingDetails();	
			break;
		case 'Delete':
			DeleteListing();
			header('Location: listings.php');
			break;	
	}
	include_once('brokerDelegate.php');
	$dtBrokers = GetBrokers();
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>CMS - Eagle Business Brokers</title>
<meta name="description" content="">
<meta name="author" content="">

<!-- Le HTML5 shim, for IE6-8 support of HTML elements -->
<!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

<link href="../css/bootstrap.css" rel="stylesheet">
<style type="text/css">
body {
	padding-top: 60px;
}
</style>
<script language="JavaScript" type="text/JavaScript">
(function (global) {
    var imagesPerRow = 3,
        chooseFiles,
        columns,
        previews;

    function PreviewImages() {
        var row;

        Array.prototype.forEach.call(chooseFiles.files, function (file, index) {
            var cindex = index % imagesPerRow,
                oFReader = new FileReader(),
                cell,
                image;

            if (cindex === 0) {		
				if(previews.rows.length > 0) previews.deleteRow();
                row = previews.insertRow(Math.ceil(index / imagesPerRow));
            }

            image = document.createElement("img");
            image.id = "img_" + index;
            image.style.width = "100%";
            image.style.height = "auto";
            cell = row.insertCell(cindex);
            cell.appendChild(image);

            oFReader.addEventListener("load", function assignImageSrc(evt) {
                image.src = evt.target.result;
                this.removeEventListener("load", assignImageSrc);
            }, false);

            oFReader.readAsDataURL(file);
        });
    }

    global.addEventListener("load", function windowLoadHandler() {
        global.removeEventListener("load", windowLoadHandler);
        chooseFiles = document.getElementById("chooseFiles");
		chooseFiles.style.padding = "5px";
        columns = document.getElementById("columns");
        previews = document.getElementById("previews");

        var row = columns.insertRow(-1),
            header,
            i;

        for (i = 0; i < imagesPerRow; i += 1) {
            header = row.insertCell(-1);
            header.style.width = (100 / imagesPerRow) + "%";
        }

        chooseFiles.addEventListener("change", PreviewImages, true);
    }, false);
}(window));
</script>
<link rel="shortcut icon" href="../images/favicon.ico">
<script type="text/javascript" src="../js/jquery.js"></script>
<script src="../js/jquery-1.9.1.min.js"></script>

<script type="text/javascript" src="../js/bootstrap.js"></script>
<script type="text/javascript" src="../js/bootstrap-datepicker.js"></script>
<script type="text/javascript" src="../js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="../js/bootstrap-tabs.js"></script>
<script type="text/javascript" src="../js/bootstrap-scrollspy.js"></script>

<script type="text/javascript" src="../js/bootstrap-buttons.js"></script>
<script type="text/javascript" src="../ckeditor/ckeditor.js"></script>
<link rel="stylesheet" type="text/css" href="../css/datepicker.css">
<script>
	$(function(){
   $('#listingDate').datepicker({
      format: 'yyyy-mm-dd'
    });
});
</script>
</head>

<body>
	<?php include('topbar.php');?>
	<div class="container-fluid">
		 <?php include('optionsPanel.php');?>
		<div class="content">
			<div class="row">
				<div class="span12, offset0">
					<h2><?php echo $mode.' '.$menu;?></h2>
					<hr>
					<script type="text/javascript" src="../js/dataForm.js"></script>
					<form name="dataForm" method="post" enctype="multipart/form-data"  action="listings.php">
						<input  name="listingId" value="<?php echo $dtListing[0]->listingId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset>	
							<div class = "listing-section">
								<span >! Fields marked "<span style="color:#FF0000; ">*</span>" are for office use only<br>
								! Listings will be ranked based upon Priority Setting and Listing Date. Click on "High" for listing to appear on top of the list.<br>
								! Image for the listing will be resized to 630 x 350 pixels </span>
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<div class="clearfix"><label for="Listing Date"><span style="color:#FF0000; ">*</span>Listing Date</label>
								<div class="input"><input  class="large" style="width:140px;" id="listingDate" name="listingDate" type="text" value="<?php echo $dtListing[0]->listingDate; ?>"></div>
							</div>
							<div class="clearfix"><label for="Listing Status"><span style="color:#FF0000; ">*</span>Status</label>
								<div class="input">
									<select class="large" style="width:150px;" title="Select a Status" size="1" id="status" name="status">
										<option selected="selected" value = "0">Select a Status</option>
										<option <?php if($dtListing[0]->status == 1) echo 'selected="selected"'; ?>  value = "1">Open</option>
										<option <?php if($dtListing[0]->status == 2) echo 'selected="selected"'; ?>  value = "2">Under Contract</option>
										<option <?php if($dtListing[0]->status == 3) echo 'selected="selected"'; ?>  value = "3">Sold</option>
									</select>
									
								</div>
							</div>
							<div class="clearfix"><label for="Listing Priority"><span style="color:#FF0000; ">*</span>Priority</label>
								<div class="input">
									<select class="large" style="width:150px;" title="Select Priority" size="1" id="priority" name="priority">
										<option selected="selected" value = "0">Select Priority</option>
										<option <?php if($dtListing[0]->priority == 1) echo 'selected="selected"'; ?> value = "1">Low</option>
										<option <?php if($dtListing[0]->priority == 2) echo 'selected="selected"'; ?> value = "2">Normal</option>
										<option <?php if($dtListing[0]->priority == 3) echo 'selected="selected"'; ?> value = "3">High</option>
									</select>
									
								</div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Remarks"><span style="color:#FF0000; ">*</span>Broker Remarks</label>
								<div class="input"><input class="xlarge" id="xlInput" name="remarks" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->remarks; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Title"><span style="color:#FF0000; ">*</span>Listing Title</label>
								<div class="input"><input class="xlarge" id="xlInput" name="title" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->title; ?>"></div>
							</div>
							
							<div class = "listing-section"></div>
							<!-- /clearfix --><div class="clearfix"></div>
							<h2>Listing Options</h2>
							<!-- /clearfix --><div class="clearfix"></div>
							<div class="clearfix"><label for="Listing Terms">Terms</label>
								<div class="input">
									<select class="large" style="width:200px;" title="Select Terms" size="1" id="category" name="category">
										<option selected="selected" value = "0">Select Terms</option>
										<option <?php if($dtListing[0]->category == 1) echo 'selected="selected"'; ?> value = "1">Sale</option>
										<option <?php if($dtListing[0]->category == 2) echo 'selected="selected"'; ?> value = "2">Lease</option>
										<option <?php if($dtListing[0]->category == 3) echo 'selected="selected"'; ?> value = "3">Both</option>
									</select>
									
								</div>
							</div>
							<div class="clearfix"><label for="Listing ClassfiClassificationcation">Classification</label>
								<div class="input">
									<select class="large" style="width:200px;" title="Select Classification" size="1" id="classification" name="classification">
										<option selected="selected" value = "0">Select Classification</option>
										<option  <?php if($dtListing[0]->classification == 1) echo 'selected="selected"'; ?> value = "1">Business Opportunity</option>
										<option  <?php if($dtListing[0]->classification == 2) echo 'selected="selected"'; ?> value = "2">Commercial Real Estate</option>
										<option  <?php if($dtListing[0]->classification == 3) echo 'selected="selected"'; ?> value = "3">Residential Real Estate</option>
										<option  <?php if($dtListing[0]->classification == 4) echo 'selected="selected"'; ?> value = "4">Other</option>
									</select>
									
								</div>
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<h2>Listing Details</h2>
							<!-- /clearfix --><div class="clearfix"></div>
							<div class="clearfix"><label for="Location">Location</label>
								<div class="input"><input class="xlarge" id="xlInput" name="location" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->location; ?>"></div>
							</div>
							<div class="clearfix"><label for="City/State">City/State</label>
								<div class="input"><input class="xlarge" id="xlInput" name="city" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->city; ?>"></div>
							</div>
							<div class="clearfix"><label for="Square Feet">Square Feet</label>
								<div class="input"><input class="xlarge" id="xlInput" name="area" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->area; ?>"></div>
							</div>
							<div class="clearfix"><label for="Rent">Rent</label>
								<div class="input"><input class="xlarge" id="xlInput" name="rent" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->rent; ?>"></div>
							</div>
							<div class="clearfix"><label for="List Price">List Price</label>
								<div class="input"><input class="xlarge" id="xlInput" name="listPrice" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->listPrice; ?>"></div>
							</div>
							<div class="clearfix"><label for="Annual Sales">Annual Sales</label>
								<div class="input"><input class="xlarge" id="xlInput" name="annualSales" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->annualSales; ?>"></div>
							</div>
							<div class="clearfix"><label for="Inventory">Inventory</label>
								<div class="input"><input class="xlarge" id="xlInput" name="inventory" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->inventory; ?>"></div>
							</div>
							<div class="clearfix"><label for="Gross Income">Gross Income</label>
								<div class="input"><input class="xlarge" id="xlInput" name="grossIncome" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->grossIncome; ?>"></div>
							</div>
							<div class="clearfix"><label for="Year Estd.">Year Estd.</label>
								<div class="input"><input class="xlarge" id="xlInput" name="yearEstablished" style="width:500px;" size="30" type="text" value="<?php echo $dtListing[0]->yearEstablished; ?>"></div>
							</div>
							<div class="clearfix"><label for="Broker ID">Broker ID</label>
								<div class="input">
									<select class="large" style="width:200px;" title="Select Broker" size="1" id="brokerId" name="brokerId">
										<option selected="selected" value = "0">Select a Broker</option>
										<?php 
											for($cnt =0; $cnt < count($dtBrokers); $cnt++){
												if($dtBrokers[$cnt]->brokerId == $dtListing[0]->brokerId )$selection = 'selected="selected"';
												else $selection = '';
												echo '<option '.$selection.' value = "'.$dtBrokers[$cnt]->brokerId.'">'.$dtBrokers[$cnt]->brokerName.'</option>';
											}											
										?>
									</select>
								</div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Description">Description</label>
								<div class="input"><textarea  id="description" name="description" ><?php echo $dtListing[0]->description; ?></textarea></div>
							</div>
							<div class="clearfix"><label for="Location Map">Location Map Link (Copy & Paste)</label>
								<div class="input"><textarea style="width:900px;" name="locationLink" ><?php echo $dtListing[0]->locationLink; ?></textarea></div>
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<h2>Attachments</h2>
							<!-- /clearfix --><div class="clearfix"></div>
							<div id="imagesDiv" class="rounded">
								<div class="clearfix"><label for="chooseFiles"><?php echo $mode?> Attach Image</label>
								<input type="file" name="listingImage" id="chooseFiles" accept="image/jpeg,image/jpg" />
								<table class="preview-table" id="previewTable">
									<thead id="columns"></thead>
									<tbody  id="previews"></tbody>
								</table>
								</div>
							</div>
							<div class="clearfix">
								 <?php
									if($mode == 'Update') echo '<img src="../uploads/listings/listing_'.$dtListing[0]->listingId.'.jpg" alt="'.$dtListing[0]->title.'" width="310" height="95" />';
								 ?>
							</div>
							<div class="clearfix"><label for="Attach Brochure">Attach Brochure</label>
								<div class="input"><input type='file' name='brochure' accept="application/pdf"></div>
								
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<a <?php echo 'href="../uploads/downloads/brochure_'.$dtListing[0]->listingId.'.pdf"'; ?> target="_blank"><button class="input" type="button">View Brochure</button></a>
							<!-- /clearfix --><div class="clearfix"></div>
							<div class="actions"><input  type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkListingForm();">&nbsp;<a href="listings.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	CKEDITOR.replace('description'); 
</script>
</html>	