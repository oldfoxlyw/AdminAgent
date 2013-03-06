<!DOCTYPE html>
<html>
	<head>
		<!-- Meta -->
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
		<!-- End of Meta -->
		
		<!-- Page title -->
		<title>Wide Admin - Login</title>
		<!-- End of Page title -->
		
		<!-- Libraries -->
		<link type="text/css" href="<?php echo $root_path; ?>resources/css/login.css" rel="stylesheet" />	
		<link type="text/css" href="<?php echo $root_path; ?>resources/css/smoothness/jquery-ui-1.7.2.custom.css" rel="stylesheet" />	
		
		<script type="text/javascript" src="<?php echo $root_path; ?>resources/js/jquery-1.3.2.min.js"></script>
		<script type="text/javascript" src="<?php echo $root_path; ?>resources/js/easyTooltip.js"></script>
		<script type="text/javascript" src="<?php echo $root_path; ?>resources/js/jquery-ui-1.7.2.custom.min.js"></script>
		<!-- End of Libraries -->	
	</head>
	<body>
	<div id="container">
		<div class="logo">
			<a href=""><img src="<?php echo $root_path; ?>resources/assets/logo.png" alt="" /></a>
		</div>
		<div id="box">
			<form action="<?php echo $root_path; ?>partner/login/validate" method="POST">
			<p class="main">
				<label>Username: </label>
				<input type="text" id="userName" name="userName" value="" /> 
				<label>Password: </label>
				<input type="password" id="userPass" name="userPass" value="">	
			</p>
			<p class="space">
				<span><input type="checkbox"  id="isRemember" name="isRemember" value="1" />Remember me</span>
				<input type="submit" value="Login" class="login" />
			</p>
			</form>
		</div>
	</div>

	</body>
</html>