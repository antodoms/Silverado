<?php include_once("header.php") ?>

<article>
    <h1>WELCOME BACK</h1>
    <container>
        <section>
            <?php 
           
            if(!empty($data['cart'])){
                
           
            for ($i=0; $i< count($data['cart']); $i++) {
                echo '<h1> Movie Type'.$data['cart'][$i]['movie'].'</h1><br><p>Day: '.$data['cart'][$i]['day'].' & Time: '.$data['cart'][$i]['time'].'</p>';
                echo '<p>';
                foreach ($data['cart'][$i]['seats'] as $value) {
                    echo 'Type:'.$value['type'].'--> ';
                    
                    foreach ($value['seats'] as $s){
                        echo ' '.$s;
                    }
                    
                    echo '</p>';
                }
                
              echo '<a href="'.site_url('Booking/delete/').'/'.($i+1).'"><button>Remove From Cart</button></a><br><br>';  
            }
            
            }
            
            else{
               echo ' <p> Your cart is empty ! please add some movies to purchase';
            }
            ?>
            <br><br>
           <a href="<?php echo site_url('/movies')?>"><button>Add More Movies</button></a>
           <a href="<?php echo site_url('/booking/confirm')?>"><button>Confirm Booking Ticket</button></a>
        </section>
    </container>

	<h1>YOUR CART</h1>

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

			if(!empty($data['cart'])) {

				for ($i = 0 ; $i < count($data['cart']) ; $i++) {

					$booking = $data['cart'][$i];

					echo '<container>';
					echo '<section>';
					echo '<img src=' . $JSONmovies->$booking['movie']->poster . '>';
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

					echo '<section>';
					echo '<a href="' . site_url('Booking/delete/') . '/' . ($i + 1) . '"><button>Remove From Cart</button></a><br><br>';
					echo '</section>';

					echo '</container>';
					echo '<hr class="horizontalline">';
				}
                                

			}
                        else{
               echo ' <section><p> Your cart is empty ! please add some movies to purchase</p></section>';
            }

			?>

	<container>
		<a href="<?php echo site_url('/movies')?>"><button>Add More Movies</button></a>
		<a href="<?php echo site_url('/booking/confirm')?>"><button>Checkout</button></a>
	</container>

</article>


<?php include_once("footer.php") ?>
