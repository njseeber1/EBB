<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Blogs';
	include_once('blogDelegate.php');
	if($_GET['mode'] == '') $mode = 'Save';
	else $mode = $_GET['mode'];
	switch($mode){
		case 'Update':
			$dtBlog = GetBlogDetails();	
			break;
		case 'Delete':
			DeleteBlog();
			header('Location: blogs.php');
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
   $('#blogDate').datepicker({
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
					<form name="dataForm" method="post" enctype="multipart/form-data"  action="blogs.php">
						<input  name="blogId" value="<?php echo $dtBlog[0]->blogId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Blog Details</legend>
							<div class="clearfix"><label for="Blog Date"><span style="color:#FF0000; ">*</span>Blog Date</label>
								<div class="input"><input  class="large" style="width:140px;" id="blogDate" name="blogDate" type="text" value="<?php echo $dtBlog[0]->blogDate; ?>"></div>
							</div>
							<div class="clearfix"><label for="Heading">Heading</label>
								<div class="input"><input class="xlarge" style="width:400px;" id="xlInput" name="heading" size="100" type="text" value="<?php echo $dtBlog[0]->heading; ?>"></div>
							</div>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Content">Content</label>
								<div class="input"><textarea  id="content" name="content" ><?php echo $dtBlog[0]->content; ?></textarea></div>
							</div>
							<!-- /clearfix --><div class="clearfix"></div>
							<div id="imagesDiv" class="rounded">
								<div class="clearfix"><label for="chooseFiles"><?php echo $mode?> Attach Image</label>
								<input type="file" name="blogImage" id="chooseFiles" accept="image/jpeg,image/jpg" />
								<table class="preview-table" id="previewTable">
									<thead id="columns"></thead>
									<tbody  id="previews"></tbody>
								</table>
								</div>
							</div>
							<div class="clearfix">
								 <?php
									if($mode == 'Update') echo '<img src="../uploads/blogs/blog_'.$dtBlog[0]->blogId.'.jpg" alt="'.$dtBlog[0]->heading.'" width="310" height="95" />';
								 ?>
							</div>
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkBlogForm();">&nbsp;<a href="blogs.php" class="btn">Cancel</a></div>

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