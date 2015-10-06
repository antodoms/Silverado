<!-- This is the table that slides down after the user has selected a movie time.
	This table is where the user can select the different ticket types. -->

<div id="ticketmenu">
	<form method="post" action="<?php echo site_url('index.php/booking/add'); ?>">
		<h1>Ticket Booking</h1>

		<!-- Ticket selection table -->
		<fieldset class="darktable">
			<table>
				<tr>
					<th>Ticket Type</th>
					<th>Price</th>
					<th>Add Seats</th>
					<th>Quantity</th>
					<th>Subtotal Price</th>
				</tr>
				<tr>
					<td>Adult</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('SA')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SA" value="">
				</tr>
				<tr>
					<td>Concession</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('SP')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SP" value="">
				</tr>
				<tr>
					<td>Child</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('SC')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SC" value="">
				</tr>
				<tr>
					<td>First Class Adult</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('FA')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="FA" value="">
				</tr>
				<tr>
					<td>First Class Child</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('FC')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="FC" value="">
				</tr>
				<tr>
					<td>Beanbag - 1 Person</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('B1')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B1" value="">
				</tr>
				<tr>
					<td>Beanbag - 2 Persons</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('B2')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B2" value="">
				</tr>
				<tr>
					<td>Beanbag - 3 Children</td>
					<td class="price"></td>
					<td><button class="plusBtn" type="button" onclick="setTheatre('B3')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B3" value="">
				</tr>
				
				<!-- Other useful values that will be passed in the form -->
				<input type="hidden" name="movie" value="">
				<input type="hidden" name="day" value="">
				<input type="hidden" name="time" value="">
			</table>
		</fieldset>

		<!-- Total price -->
		<fieldset id="pricefield" hidden>
			<label for="price">Total Price</label>
			<input type="text" name="price" id="price" value="$0.00" readonly>
			<br>
		</fieldset>

		<!-- Submit and cancel button (also allow ESC to be pressed) -->
		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" class="esc">
		<input type="submit" value="Submit">
		<button type="button" class="close">Cancel</button>
	</form>
	
</div>




