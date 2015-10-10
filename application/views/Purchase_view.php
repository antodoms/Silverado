<?php include_once("header.php") ?>

<article>

	<container>
		<h1>YOUR PURCHASE HISTORY</h1>
		<h2>Click on link for more details.</h2>
		<hr class="horizontalline">

		<?php

			$json_file = file_get_contents("https://titan.csit.rmit.edu.au/~e54061/wp/moviesJSON.php");
			$JSONmovies = json_decode($json_file);

			$seatType = [
				"SA" => "Standard Adult",
				"SP" => "Standard Concession",
				"SC" => "Standard Child",
				"FA" => "First Class Adult",
				"FC" => "First Class Child",
				"B1" => "Beanbag (1 person)",
				"B2" => "Beanbag (2 persons)",
				"B3" => "Beanbag (3 children)"
			];

			if(!empty($data)) {

				for ($i = 0 ; $i < count($data) ; $i++) {

					$bookings = $data[$i];
					$tokentemp = $token[$i];
					$emailtemp = $email[$i];

					if ($i % 2 == 0) {
						echo '<a class="historylink" href=' . base_url() .
						'index.php/booking/ticket/?email=' . $emailtemp . '&token=' . $tokentemp . '>';
					}
					else {
						echo '<a class="historylinkalt" href=' . base_url() .
						'index.php/booking/ticket/?email=' . $emailtemp . '&token=' . $tokentemp . '>';
					}

					foreach ($bookings as $booking) {

						echo '<container>';

						echo '<section class="fixed100">';
							echo '<h2>' . $tokentemp . '</h2>';
						echo '</section>';

						/* Basic Booking Information */
						echo '<section class="fixed300">';
							echo '<h2>' . $JSONmovies->$booking['movie']->title . '</h2>';
						echo '</section>';

						/* Selected Seats Information */
						echo '<section class="fixed200">';
							echo '<h2>' . $booking['day'] . ' ' . $booking['time'] . '</h2>';
						echo '</section>';

						echo '</container>';
					}

					echo '</a>';
				}

			}
			else{
			   echo ' <section><p>There\'s nothing here!</p></section>';
			}


			if(empty($data)) {

				for ($i = 0 ; $i < count($data) ; $i++) {

					$bookings = $data[$i];
					$tokentemp = $token[$i];
					$emailtemp = $email[$i];

					foreach ($bookings as $booking) {
						echo '<container>';
						echo '<section>';
						echo $tokentemp.'  '. $emailtemp .'<img src=' . $JSONmovies->$booking['movie']->poster . '>';
						echo '</section>';


						/* Basic Booking Information */
						echo '<section class="fixed300">';
						echo '<h1>' . $JSONmovies->$booking['movie']->title . '</h1>';
						echo '<br><br>';
						echo '<p> <b>Day:</b> ' . $booking['day'] . '</p>';
						echo '<p> <b>Time:</b> ' . $booking['time'] . '</p>';
						echo '</section>';

						/* Selected Seats Information */
						echo '<section class="fixed250">';
						foreach ($booking['seats'] as $seat) {
							echo '<p> <b>Seat Type: </b> ' . $seatType[$seat['type']] . '</p>';

							echo '<p> <b>Selected: </b> ';
							foreach ($seat['seats'] as $number){
								echo $number . ' ';
							}
							echo '<br><br>';
							echo '</p>';

						}
						echo '</section>';
						echo '<a href="'.base_url().'index.php/booking/ticket/?email='.$emailtemp.'&token='.$tokentemp.'">View ticket</a>';

						echo '</container>';
					}

					echo '<hr class="horizontalline">';
				}


			}

			?>

			<hr class="horizontalline">

	</container>

</article>


<?php include_once("footer.php") ?>
