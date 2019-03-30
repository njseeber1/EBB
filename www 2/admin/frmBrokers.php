<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Brokers';
	include_once('brokerDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtBroker = GetBrokerDetails();	
			break;
		case 'Delete':
			DeleteBroker();
			header('Location: brokers.php');
			break;	
	}
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

<link rel="shortcut icon" href="../images/favicon.ico">
<script src="../js/jquery-1.9.1.min.js"></script>
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
					<script type="text/javascript" src="../js/dataForm.js"></script>
					<form name="dataForm" method="post"  action="brokers.php">
						<input  name="brokerId" value="<?php echo $dtBroker[0]->brokerId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Broker Details</legend>
							<div class="clearfix"><label for="Broker Name">Name</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="brokerName" size="100" type="text" value="<?php echo $dtBroker[0]->brokerName; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkBrokerForm();">&nbsp;<a href="brokers.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	