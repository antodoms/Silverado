<?php
	session_start();
	$page = "nowshowing.php";
?>

<!DOCTYPE html>
<html ng-app="SilveradoApp">
	<head>
		<?php include_once("includes/links.php") ?>

		<title> Silverado | Now Showing </title>

	</head>
	<!------------------------------------------------------------------------------------>
	<body>
		<?php include_once("includes/header.php") ?>

		<?php include_once("includes/nav.php") ?>

		<!-- Entire Movie Panel -->
		<div id="allmovies" ng-controller="moviesController">
			<div class="moviepanel noselect shadow" ng-repeat="(code, movie) in movies">
				<div id="movie-code" hidden>{{code}}</div>
				<img ng-src={{movie.poster}}>
			</div>
		</div>

		<!-- The 'slide down' extra information panel. This div gets moved around -->
		<!-- The divs are empty because they are dynamically updated with JS -->
		<div id="extrapanel" class="moviepanelextra noselect">
			<section1>
				<div id="title"></div>
				<div id="summary"></div>
				<div id="description"></div>
				<video id="trailer" width="480" height="320" controls></video>
			</section1>
			<section2>
				<div id="rating"></div>
				<div id="sessions"></div>
			</section2>
		</div>

		<?php include_once("includes/footer.php") ?>

	</body>
</html>
