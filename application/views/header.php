<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Imported stuff -->
		<link rel='shortcut icon' href="<?php echo asset_url(); ?>images/logohorse.png">
		<link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/layout.css">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Quicksand">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Poiret+One">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Josefin+Sans">
		<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">

		<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1, maximum-scale=1">

		<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.3.15/angular.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.2.7/angular-resource.min.js"></script>

		<script src="<?php echo asset_url(); ?>js/cookie.js"></script>
		<script src="<?php echo asset_url(); ?>js/scripts.js"></script>

		<title> Silverado | People's Own Theatre</title>
	</head>

	<!------------------------------------------------------------------------------------>

	<body>
		<div class="backgroundimage"></div>

		<img class="usericon" title="Profile actions" onclick="toggleUserDropdown()" src="<?php echo asset_url(); ?>images/user.png">

		<a href="<?php echo base_url(); ?>index.php/booking/cart">
			<img class="carticon" title="View your shopping cart" src="<?php echo asset_url(); ?>images/cart.png">
		</a>

		<div id="userDropdown" hidden>
			<a href="<?php echo base_url(); ?>index.php/user"><p>My Profile</p></a>
			<a href="<?php echo base_url(); ?>index.php/booking/purchase"><p>Purchase History</p></a>
			<a href="<?php echo base_url(); ?>index.php/user/logout"><p>Logout</p></a>
		</div>

		<!-- Masthead -->
		<header>
			<img src="<?php echo asset_url(); ?>images/logohorse.png">
			<h1 class="noselect">SILVERADO CINEMAS</h1>
			<br>
			<h2>404 HTML Street, Hypotheticaland 3001, CSS</h2>
			<hr class="horizontalline"></hr>
		</header>

		<nav>
			<a href="<?php echo base_url(); ?>index.php/"
			   class=<?php if($this->router->fetch_method() == "index") echo "current" ?>>HOME</a>

			<a href="<?php echo base_url(); ?>index.php/movies/"
			   class=<?php if($this->router->fetch_method() == "movies") echo "current" ?>>NOW&nbsp;SHOWING</a>

			<a href="<?php echo base_url(); ?>index.php/price/"
			   class=<?php if($this->router->fetch_method() == "price") echo "current" ?>>SCHEDULE&nbsp;&&nbsp;PRICES</a>

			<a href="<?php echo base_url(); ?>index.php/contact/"
			   class=<?php if($this->router->fetch_method() == "contact") echo "current" ?>>CONTACT</a>
		</nav>
