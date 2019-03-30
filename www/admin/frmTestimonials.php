<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Testimonials';
	include_once('testimonialDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtTestimonial = GetTestimonialDetails();	
			echo $dtTestimonial;
			break;
		case 'Delete':
			DeleteTestimonial();
			header('Location: testimonials.php');
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
					<script type="text/javascript" src="../js/dataForm.js"></script>
					<form name="dataForm" method="post"  action="testimonials.php">
						<input  name="testimonialId" value="<?php echo $dtTestimonial[0]->testimonialId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Testimonial Details</legend>
							<div class="clearfix"><label for="Title">Title</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="title" size="100" type="text" value="<?php echo $dtTestimonial[0]->title; ?>"></div>
							</div>
							<div class="clearfix"><label for="Testimonial">Testimonial</label>
								<div class="input"><textarea style="width:400px; height:200px;" id="message" name="testimonial" ><?php echo $dtTestimonial[0]->testimonial; ?></textarea></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Author">Author</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="author" size="100" type="text" value="<?php echo $dtTestimonial[0]->author; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkTestimonialForm();">&nbsp;<a href="testimonials.php" class="btn">Cancel</a></div>

						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	