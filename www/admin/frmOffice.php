<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Offices';
	include_once('officeDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtOffice = GetOfficeDetails();		
			break;
		case 'Delete':
			DeleteOffice();
			header('Location: offices.php');
			break;	
	}
}
?>
<!DOCTYPE html>
<html lang="en"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta charset="utf-8">
<title>CMS - Businesszone Trading</title>
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

<link rel="shortcut icon" href="../images/favicon.ico">
<script src="../js/jquery-1.7.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-alerts.js"></script>
<script type="text/javascript" src="../js/bootstrap-buttons.js"></script>
<script type="text/javascript" src="../js/bootstrap-dropdown.js"></script>
<script type="text/javascript" src="../js/bootstrap-modal.js"></script>
<script type="text/javascript" src="../js/bootstrap-twipsy.js"></script>
<script type="text/javascript" src="../js/bootstrap-popover.js"></script>
<script type="text/javascript" src="../js/bootstrap-scrollspy.js"></script>
<script type="text/javascript" src="../js/bootstrap-tabs.js"></script>

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
					<script type="text/javascript" src="../js/officeForm.js"></script>
					<form name="officeForm" method="post" action="offices.php">
						<input  name="officeId" value="<?php echo $dtOffice[0]->officeId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Office Details</legend>
							<div class="clearfix"><label for="Company Name">Company Name</label>
								<div class="input"><input class="xlarge" id="xlInput" name="officeName" size="30" type="text" value="<?php echo $dtOffice[0]->officeName; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Location">Location</label>
								<div class="input"><input class="xlarge" id="xlInput" name="location" size="30" type="text" value="<?php echo $dtOffice[0]->location; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Address">Address</label>
								<div class="input"><textarea style="width:273px; height:100px;" id="message" name="address" ><?php echo $dtOffice[0]->address; ?></textarea></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Phone Number">Phone</label>
								<div class="input"><input class="xlarge" id="xlInput" name="phone" size="30" type="text" value="<?php echo $dtOffice[0]->phone; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Fax Number">Fax</label>
								<div class="input"><input class="xlarge" id="xlInput" name="fax" size="30" type="text" value="<?php echo $dtOffice[0]->fax; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Email Address">Email</label>
								<div class="input"><input class="xlarge" id="xlInput" name="email" size="30" type="text" value="<?php echo $dtOffice[0]->email; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkform();">&nbsp;<a href="offices.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	