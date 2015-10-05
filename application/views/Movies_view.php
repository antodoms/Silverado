<div class="blurrable">
<?php include_once("header.php") ?>



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
				<button>read more</button>
				<div class="more">
					<video id="trailer" width="480" height="320" controls></video>
				</div>
			</section1>
			<section2>
				<div id="rating"></div>
				<div id="sessions">
				</div>
			</section2>
			<?php include_once("ticketdialog.php") ?>
		</div>
	
	
<?php include_once("footer.php") ?>
	
</div>

<?php include_once("theatredialog.php") ?>