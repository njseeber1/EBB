<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Offices';
	include_once('officeDelegate.php');
	switch($_POST['mode']){
		case 'Save':
			SaveOffice();
			break;
		case 'Update':
			UpdateOffice();
			break;
		case 'Delete':
			DeleteOffice();
			header('Location: offices.php');
			break;
	}
	$query = 'Get all active offices';
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
	<?php 
		include('topbar.php');
		include('optionsPanel.php');
		include('dataPanel.php');
	?>
</body>
</html>