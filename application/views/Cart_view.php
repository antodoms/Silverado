<?php include_once("header.php") ?>

<article>
	<h1>YOUR CART</h1>
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

			function toDollars($amount) {
				return '$' . number_format($amount, 2, '.', ',');
			}

			if(!empty($data['cart'])) {

				for ($i = 0 ; $i < count($data['cart']) ; $i++) {

					$screening = $data['cart'][$i];

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

						echo '<p> <b>Subtotal Price: </b> $' . number_format($booking['price'] * $booking['quantity'], 2, '.', '') . '</p>';
						echo '</div>';

						if ($booking !== end($screening['seats']))
							echo '<br>';

					}
					echo '</section>';

					echo '</container>';

					echo '<container>';

					echo '<a href="' . site_url('Booking/delete/') . '/' . ($i + 1) . '" onclick="deleteAllCookies()">
						<button class="myButton">Remove From Cart</button></a><br><br>';

					echo '</container>';

					echo '<hr class="horizontalline">';
				}

				echo '<h1> <b> Total Price: </b> $' . number_format($data['total'], 2, '.', '') . '</h1>';

				echo '<hr class="horizontalline">';
			}
			else {
				echo '<container>';
				echo '<h1> Your cart is empty! </h1>';
				echo '</container>';
			}

			?>

	<container>
		<section>
		<a href="<?php echo base_url(); ?>index.php/movies/"
		   onclick="deleteAllCookies()"><button class="myButton">Add More Movies</button></a>
		</section>
		<section>
		<a href="<?php echo site_url('/booking/confirm')?>"
		   onclick="deleteAllCookies()"><button class="myButton">Checkout</button></a>
		</section>
	</container>

</article>


<?php include_once("footer.php") ?>
