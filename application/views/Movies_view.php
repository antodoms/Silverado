<?php include_once("header.php") ?>

<!-- This outer div is needed for blur effect -->
<div class="blurrable">

	<!-- Entire Movie Container that shows all Movie Panels -->
	<div id="allmovies" ng-app="SilveradoApp" ng-controller="moviesController">

		<!-- Individual clickable Movie Panel -->
		<div class="moviepanel noselect shadow" ng-repeat="(code, movie) in movies">
			<div id="movie-code" hidden>{{code}}</div>
			<img ng-src={{movie.poster}}>
		</div>

	</div>

	<!-- The 'slide down' extra information panel when a Movie Panel is clicked. -->
	<!-- This div gets dynamically moved around and values updated within JS. -->
	<div id="extrapanel" class="moviepanelextra noselect">

		<section1>
			<div id="title"></div>
			<div id="summary"></div>
			<div id="description"></div>
			<div id="showmore" hidden>
				<video id="trailer" controls></video>
			</div>
			<button class="toggleshowmore" onclick="toggleShowMore()">Show More</button>
		</section1>

		<section2>
			<div id="rating"></div>
			<div id="sessions">
			</div>
		</section2>

		<?php include_once("ticketdialog.php") ?>

	</div>

</div>

<?php include_once("footer.php") ?>

<!-- This is kept outside blurrable so it doesn't get blurred (duh) -->
<?php include_once("theatredialog.php") ?>
