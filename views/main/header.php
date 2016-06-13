<!DOCTYPE html>
<html>
    <head>
		<meta charset="UTF-8">
		<title>Tisa Admin Template v1.1 (dashboard)</title>
		<meta name="viewport" content="initial-scale=1.0,maximum-scale=1.0,user-scalable=no">
		
		<link rel="shortcut icon" href="favicon.ico" />
		
		<!-- bootstrap framework -->
		<link href="<?php echo base_url(); ?>assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
		
		<!-- custom icons -->
			<!-- font awesome icons -->
			<link href="<?php echo base_url(); ?>assets/icons/font-awesome/css/font-awesome.min.css" rel="stylesheet" media="screen">
			<!-- ionicons -->	
			<link href="<?php echo base_url(); ?>assets/icons/ionicons/css/ionicons.min.css" rel="stylesheet" media="screen">
			<!-- flags -->
			<link rel="stylesheet" href="<?php echo base_url(); ?>assets/icons/flags/flags.css">
				
	
	<!-- page specific stylesheets -->

		<!-- nvd3 charts -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/novus-nvd3/nv.d3.min.css">
		<!-- owl carousel -->
		<link rel="stylesheet" href="<?php echo base_url(); ?>assets/lib/owl-carousel/owl.carousel.css">
				
		<!-- main stylesheet -->
		<link href="<?php echo base_url(); ?>assets/css/style.css" rel="stylesheet" media="screen">
		
		<!-- google webfonts -->
		<link href='http://fonts.googleapis.com/css?family=Source+Sans+Pro:400&amp;subset=latin-ext,latin' rel='stylesheet' type='text/css'>
		
		<!-- moment.js (date library) -->
		<script src="<?php echo base_url(); ?>assets/lib/moment-js/moment.min.js"></script>
		
    </head>
    <body>
		<!-- top bar -->
		<header class="navbar navbar-fixed-top" role="banner">
			<div class="container-fluid">
				<div class="navbar-header">
					<a href="dashboard.html" class="navbar-brand"><img src="<?php echo base_url(); ?>assets/img/blank.gif" alt="Logo"></a>
				</div>
				<ul class="nav navbar-nav navbar-right">
					<li class="user_menu">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown">
							<span class="navbar_el_icon ion-person"></span> <span class="caret"></span>
						</a>
						<ul class="dropdown-menu dropdown-menu-right">
							<li><a href="#">Profile</a></li>
							<li><a href="#">My messages</a></li>
							<li><a href="#">My tasks</a></li>
							<li class="divider"></li>
							<li><a href="<?php echo base_url();?>index.php/home/logout">Log Out</a></li>
						</ul>
					</li>
					<li><a href="javascript:void(0)" class="slidebar-toggle"><span class="navbar_el_icon ion-navicon-round"></span></a></li>
				</ul>
			</div>
		</header>