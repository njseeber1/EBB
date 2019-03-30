<?php
session_start();
$user = $_SESSION['user'];
if($user->userName == ''){
	header('Location: login.php');
	break;
}else{
	$menu = 'Settings';
	include_once('settingsDelegate.php');	
	switch($_POST['mode']){
		case 'Save':
			SaveSettings();
			break;
		case 'Update':
			UpdateSettings();
			break;
	}
	$dtSettings = GetSettings();
	if(count($dtSettings) > 0) $mode = 'Update';
	else $mode = 'Save';
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

<script  language="JavaScript" type="text/JavaScript">
function showURLInput(val){
	var element=document.getElementById('url');
	if (val !='0') {
		element.style.display='none';
		//this.dataForm['url'].type ='hidden'
	}else{
		element.style.display='block';
		//this.dataForm['url'].type ='text'
	};
};
</script>

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
					<form name="dataForm" method="post" enctype="multipart/form-data" action="">
						<input  name="settingsId" value="<?php echo $dtSettings[0]->settingsId;?>" type="hidden">
						<input  name="mode" value="<?php echo $mode;?>" type="hidden">
						<fieldset><legend>Settings Details</legend>
							<!-- /clearfix -->
							<div class="clearfix"><label for="Email">Send Mails To</label>
								<div class="input"><input class="xlarge" id="xlInput" name="messageEmail" size="30" type="text" value="<?php echo $dtSettings[0]->messageEmail; ?>"></div>
							</div>
							<!-- /clearfix -->	
							<div id="imagesDiv" class="rounded">
								<div class="clearfix"><label for="chooseFiles"><?php echo $mode?> Logo</label>
								<input type="file" name="logo" id="chooseFiles" value="logo" accept="image/jpeg,image/jpg" />
								<table class="preview-table" id="previewTable">
									<thead id="columns"></thead>
									<tbody  id="previews"></tbody>
								</table>
								</div>
							</div>
							<div class="clearfix">
								 <?php
									if($mode == 'Update') echo '<img src="../uploads/logos/logo_1.jpg" alt="logo" width="310" height="95" />';
								 ?>
							</div>
							<div class="actions"><input type="submit" class="btn primary" value="<?php echo $mode; ?>" onclick="return checkSettingsForm();">&nbsp;<a href="dashboard.php" class="btn">Cancel</a></div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</body>
</html>	