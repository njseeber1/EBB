<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'News';
	include_once('newsDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtNews = GetNewsDetails();	
			break;
		case 'Delete':
			DeleteNews();
			header('Location: news.php');
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
   $('#newsDate').datepicker({
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
					<form name="dataForm" method="post" enctype="multipart/form-data"  action="news.php">
						<input  name="newsId" value="<?php echo $dtNews[0]->newsId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>News Details</legend>
							<div class="clearfix"><label for="News Date"><span style="color:#FF0000; ">*</span>News Date</label>
								<div class="input"><input  class="large" style="width:140px;" id="newsDate" name="newsDate" type="text" value="<?php echo $dtNews[0]->newsDate; ?>"></div>
							</div>
							<div class="clearfix"><label for="Author">Author</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="author" size="100" type="text" value="<?php echo $dtNews[0]->author; ?>"></div>
							</div>
							<div class="clearfix"><label for="Heading">Heading</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="heading" size="100" type="text" value="<?php echo $dtNews[0]->heading; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Content">Content</label>
								<div class="input"><textarea  id="content" name="content" ><?php echo $dtNews[0]->content; ?></textarea></div>
							</div>
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkNewsForm();">&nbsp;<a href="news.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript">
	CKEDITOR.replace('content'); 
</script>
</html>	