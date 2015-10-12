<?php include_once("header.php") ?>

<article>
<!--
	<h1>YOUR TICKET DETAILS</h1>

	<container>
		<hr class="horizontalline">
-->

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

		function toDollars($amount) {
			return '$' . number_format($amount, 2, '.', ',');
		}

		if(!empty($data)) {
			$total = 0;

			$tokentemp = substr($url, -5, 5);

			echo '<container>';
			echo '<img src=' . $url . '>';
			echo '</container>';
			echo '<h1>Past Transaction (' . $tokentemp . ')</h1>';
			echo '<container>';
			echo '<hr class="horizontalline">';

			for ($i = 0 ; $i < count($data) ; $i++) {

				$screening = $data[$i];

				echo '<container>';
				echo '<section>';
				echo '<img src=' . $JSONmovies->$screening['movie']->poster . '>';
				echo '</section>';

				/* Basic Booking Information */
				echo '<section class="fixed200">';
				echo '<h1>' . $JSONmovies->$screening['movie']->title . '</h1>';
				echo '<br><br>';
				echo '<p> <b>Day:</b> ' . $screening['day'] . '</p>';
				echo '<p> <b>Time:</b> ' . $screening['time'] . '</p>';
				echo '</section>';

				/* Selected Seats Information */
				echo '<section class="fixed300">';
				foreach ($screening['seats'] as $booking) {

					echo '<div class="cartticket">';
					echo '<p> <b>Ticket Type: </b>' . $seatType[$booking['type']] . ' (' . toDollars($booking['price']) .')</p>';
					echo '<p> <b>Quantity: </b>' . $booking['quantity'] . '</p>';

					echo '<p> <b>Seats: </b> ';
					echo implode(', ', $booking['seats']);
					echo '</p>';

					$total = $total + $booking['price'] * $booking['quantity'];

					echo '<p> <b>Subtotal Price: </b>' . toDollars($booking['price'] * $booking['quantity']) . '</p>';
					echo '</div>';

					if ($booking !== end($screening['seats']))
						echo '<br>';

				}
				echo '</section>';

				echo '</container>';

				echo '<hr class="horizontalline">';
			}

			echo '<container>';
			echo '<a href="' . base_url() . 'index.php/booking/purchase"><button class="myButton">Back to History</button></a>';
			echo '</container>';
		}
		else {
			echo '<h1> Your cart is empty! </h1>';

			echo '<hr class="horizontalline">';
		}

		?>

		<!-- [Add More Movies] and [Checkout] buttons -->


	</container>

</article>


<?php include_once("footer.php") ?>
