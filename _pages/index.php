<?php

include_once('_inc/global.php');

?>

<!doctype html>
<html>
<head>
	<meta charset="utf8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
	<meta name="apple-mobile-web-app-capable" content="yes" />
	<meta names="apple-mobile-web-app-status-bar-style" content="black" />
	<title>Deejay - Login</title>
	

	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<!-- Bootstrap responsive -->
	<link rel="stylesheet" href="css/bootstrap-responsive.min.css">
	<!-- Theme CSS -->
	<!--[if !IE]> -->
	<link rel="stylesheet" href="css/style.css">
	<!-- <![endif]-->
	<!--[if IE]>
	<link rel="stylesheet" href="css/style_ie.css">
	<![endif]-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>

	<!-- Just for demonstration -->
	<script src="js/demonstration.min.js"></script>
	<!-- Theme scripts -->
	<script src="js/application.min.js"></script>
	<link rel="shortcut icon" href="favicon.ico" />
	<link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png" />

</head>
<body class='login-body'>
	<div class="login-wrap">
		<div class="login">
			<form action="" method="POST">
				<div class="sep"></div>
				<div class="email"><input type="text" name="login_username" placeholder="Username" class='input-block-level'></div>
				<div class="pw">
					<input type="password" name="login_password" placeholder="Password" class='input-block-level'>
				</div>
				<button type="submit" value="Sign In" class='button button-basic-darkblue btn-block'>Sign In</button>
			</form>
		</div>
	</div>
	
</body>
</html>