<?php include_once("header.php") ?>





<div id="allmovies">
</div>

<!-- Ticket Buying Dialog -->
<dialog id="ticketmenu">
	<form method="post" action="http://titan.csit.rmit.edu.au/~e54061/wp/testbooking.php">
		<h1>Ticket Booking</h1>

		<!-- Movie name -->
		<fieldset id="moviefield">
			<label for="titleRO">Movie: </label>
				<input type="text" name="titleRO" id="titleRO" disabled readonly>
			<select name="movie" class="movieselect" hidden>
				<option value="RC">Trainwreck</option>
				<option value="AC">Fantastic Four</option>
				<option value="CH">Inside Out</option>
				<option value="AF">Assassination</option>
			</select>
			<br>
		</fieldset>

		<!-- Session day -->
		<fieldset id="dayfield">
			<label for="day">Session Day: </label>
			<select name="day" class="dayselect">
				<!-- Dynamically updated -->
			</select>
			<br>
		</fieldset>

		<!-- Session time -->
		<fieldset id="timefield" hidden>
				<!-- Dynamically updated -->
		</fieldset>

		<!-- Ticket selection table -->
<!--		<fieldset id="ticketfield" hidden>-->
		<fieldset class="darktable">
			<table>
				<tr>
					<th>Ticket Type</th>
					<th>Price</th>
					<th>Quantity</th>
					<th>Subtotal Price</th>
				</tr>
				<tr>
					<td>Adult</td>
					<td class="priceREG" hidden>$18.00</td>
					<td class="priceDIS" hidden>$12.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="SA" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Concession</td>
					<td class="priceREG" hidden>$15.00</td>
					<td class="priceDIS" hidden>$10.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="SP" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Child</td>
					<td class="priceREG" hidden>$12.00</td>
					<td class="priceDIS" hidden>$8.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="SC" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>First Class Adult</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$25.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="FA" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>First Class Child</td>
					<td class="priceREG" hidden>$25.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="FC" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 1 Person</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="B1" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 2 Persons</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="B2" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 3 Children</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
					<td><input type="number" class="qty" name="B3" min="0" max="10" step="1" value="0"</input></td>
					<td class="subtotal">$0.00</td>
				</tr>
			</table>
		</fieldset>

		<!-- Total price -->
		<fieldset id="pricefield" hidden>
			<label for="price">Total Price</label>
			<input type="text" name="price" id="price" value="$0.00" readonly>
			<br>
		</fieldset>

		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" class="esc">
		<input type="submit" value="Submit">
		<button type="button" class="close">Cancel</button>
	</form>
</dialog>









<?php include_once("footer.php") ?>
