
<?php

	$json_file = file_get_contents("https://titan.csit.rmit.edu.au/~e54061/wp/moviesJSON.php");

	$movies = json_decode($json_file);

	//var_dump($jfo);

	/* Pretend this is a value passed in from Javascript maybe */
	$genre = "AF";

foreach ($movies as $movie) {
	if ( $movies->$genre == $movie) {
		/*
		echo "{$movie->title}<br>";
		echo "{$movie->summary}<br>";
		//echo '<a href="' + "{$movie->poster}" + '">asd</a><br>';
		echo "{$movie->trailer}<br>";
		echo "{$movie->rating}<br>";
		echo "<br>";
		*/
	}

	$title = $movie->title;
	$summary = $movie->summary;
	$trailer = $movie->trailer;
	$rating = $movie->rating;

	echo "class: " . get_class($movie) . "<br>";

	echo "Title: $title <br>";
	echo "Summary: $summary <br>";
	echo 'Trailer: <video width="480" height="320" controls><source src=' . $trailer . ' type="video/mp4"></video><br>';
	echo 'Rating: <img src=' . $rating . '><br>';
	echo "<br>";
}

/*
	$movies = [
		"AF" => $jfo->AF,
		"CH" => $jfo->CH,
		"RC" => $jfo->RC,
		"AC" => $jfo->AC,
	];
	//echo $movies["AF"]->title;

	foreach ($movies as $movie) {
		echo "title: {$movie->title}<br>";
	}
*/
	/*
	echo "<p>hello world</p>";

	if (isset($_POST['movie'])) {
		$movie = $_POST['movie'];
		echo "<p> movie is: $movie</p>";
	}
	else {
		echo "<p>you suck dick</p>";
	}

	$SA = $_POST['SA'];
	$SP = $_POST['SP'];
	$SC = $_POST['SC'];
	$FA = $_POST['FA'];
	$FC = $_POST['FC'];
	$B1 = $_POST['B1'];
	$B2 = $_POST['B2'];
	$B3 = $_POST['B3'];

	$booking = array(
		'movie' => $_POST['movie'],
		'day' 	=> $_POST['day'],
		'time' 	=> $_POST['time'],
		'price'	=> $_POST['price'],
	);

	echo "<p>";
	echo $booking['movie'];
	echo "</p>";
	*/
?>

