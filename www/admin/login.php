<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>


	<!-- General meta information -->
	<title>Sign in to Eagle Brokers CMS</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	<meta charset="utf-8" />
	<!-- // General meta information -->
	
	
	<!-- Load Javascript -->
	<script type="text/javascript" src="../js/jquery.js"></script>
	<!--<script type="text/javascript" src="../js/jquery.query-2.1.7.js"></script>
	<script type="text/javascript" src="../js/rainbows.js"></script>
	<!-- // Load Javascipt -->

	<!-- Load stylesheets -->
	<link type="text/css" rel="stylesheet" href="../css/style.css" media="screen" />
	<!-- // Load stylesheets -->
	
<script>


	$(document).ready(function(){
 
	$("#submit1").hover(
	function() {
	$(this).animate({"opacity": "0"}, "slow");
	},
	function() {
	$(this).animate({"opacity": "1"}, "slow");
	});
 	});


</script>
	
</head>
<body>

	<div id="wrapper">
		<div id="wrappertop"></div>
		<form id="loginForm" name="loginForm" autocomplete="on" method="post" action="loginDelegate.php">
			<div id="wrappermiddle">

				<h2>Login</h2>
				<div style="display: none;">
					<input type="hidden" value="admin" name="mode" id = "mode">
				</div>
				<div id="username_input">

					<div id="username_inputleft"></div>

					<div id="username_inputmiddle">
					
						<input type="text" name="email" id="url" value="E-mail Address" onclick="this.value = ''">
						<img id="url_user" src="../images/mailicon.png" alt="">
					</div>

					<div id="username_inputright"></div>

				</div>

				<div id="password_input">

					<div id="password_inputleft"></div>

					<div id="password_inputmiddle">
						<input type="password" name="password" id="url" value="Password" onclick="this.value = ''">
						<img id="url_password" src="../images/passicon.png" alt="">
					</div>

					<div id="password_inputright"></div>

				</div>

				<div id="submit">
					<input type="image" src="../images/submit_hover.png" id="submit1" value="Sign In">
					<input type="image" src="../images/submit.png" id="submit2" value="Sign In">
					
				</div>


				<div id="links_left">

				<a href="password-reset.php">Forgot your Password?</a>

				</div>
			</div>
		</form>
		<div id="wrapperbottom"></div>
		
		<div id="powered">
		</div>
	</div>

</body>
</html>