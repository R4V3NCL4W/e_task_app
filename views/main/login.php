<!doctype html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Login Page</title>
	<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		
	<!-- bootstrap framework -->
	<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<!-- google webfonts -->
	<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400&amp;subset=latin-ext,latin' rel='stylesheet' type='text/css'>
		
	<link href="<?php echo base_url(); ?>assets/css/login.css" rel="stylesheet">
	
</head>
<body>
	<div class="login_container">
		<form id="login_form" action="<?php echo base_url();?>index.php/home/dologin" method="post">
			<h1 class="login_heading">Login E-TASK</h1>
			<div class="form-group">
				<label for="login_username">Username</label>
				<input type="text" class="form-control input-lg" placeholder="User" name="username">
			</div>
			<div class="form-group">
				<label for="login_password">Password</label>
				<input type="password" class="form-control input-lg" value="password" name="password">
			</div>
			<div class="submit_section">
				<button class="btn btn-lg btn-success btn-block">Login</button>
			</div>
		</form>
	</div>
	

	
	<!-- jQuery -->
	<script src="<?php echo base_url(); ?>assets/js/jquery.min.js"></script>
	<!-- bootstrap js plugins -->
	<script src="<?php echo base_url(); ?>assets/bootstrap/js/bootstrap.min.js"></script>

</body>
</html>