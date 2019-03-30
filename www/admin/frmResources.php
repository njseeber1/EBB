<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Resources';
	include_once('resourceDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtResource = GetResourceDetails();	
			break;
		case 'Delete':
			DeleteResource();
			header('Location: resources.php');
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
					<form name="dataForm" method="post" enctype="multipart/form-data"  action="resources.php">
						<input  name="resourceId" value="<?php echo $dtResource[0]->resourceId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Resource Details</legend>
							<div class="clearfix"><label for="Document Name">Document Name</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="documentName" size="100" type="text" value="<?php echo $dtResource[0]->documentName; ?>"></div>
							</div>
							<div class="clearfix"><label for="Description">Description</label>
								<div class="input"><textarea style="width:400px; height:200px;"  name="description" ><?php echo $dtResource[0]->description; ?></textarea></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Attach Document">Attach Document</label>
								<div class="input"><input type='file' name='document' accept="application/pdf"></div>
								
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<a <?php echo 'href="../uploads/resources/'.$dtResource[0]->documentName.'.'.$dtResource[0]->contentType.'"'; ?> target="_blank"><button class="input" type="button">View Document</button></a>
							<!-- /clearfix --><div class="clearfix"></div>
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkResourceForm();">&nbsp;<a href="resources.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	