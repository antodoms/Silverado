
<!-- Ticket Buying Dialog -->
<div id="ticketmenu">
	<form method="post" action="<?php echo site_url('booking/add'); ?>">
		<h1>Ticket Booking</h1>

	
		<!-- Ticket selection table -->
<!--		<fieldset id="ticketfield" hidden>-->
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
<!--					<td><input type="number" class="qty" name="SA" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('SA')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SA" value="">
				</tr>
				<tr>
					<td>Concession</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="SP" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('SP')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SP" value="">
				</tr>
				<tr>
					<td>Child</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="SC" min="0" max="10" step="1" value="0"</input></td>-->
<!--					<td><div onclick="setTheatre('SC');">add seats</div></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('SC')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="SC" value="">
				</tr>
				<tr>
					<td>First Class Adult</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="FA" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('FA')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="FA" value="">
				</tr>
				<tr>
					<td>First Class Child</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="FC" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('FC')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="FC" value="">
				</tr>
				<tr>
					<td>Beanbag - 1 Person</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B1" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('B1')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B1" value="">
				</tr>
				<tr>
					<td>Beanbag - 2 Persons</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B2" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('B2')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B2" value="">
				</tr>
				<tr>
					<td>Beanbag - 3 Children</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B3" min="0" max="10" step="1" value="0"</input></td>-->
					<td><button class="plusBtn" type="button" onclick="setTheatre('B3')">+</button></td>
					<td class="qty">0</td>
					<td class="subtotal">$0.00</td>
					<input type="hidden" name="B3" value="">
				</tr>
				
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

		<input type="submit" tabindex="-1" style="position:absolute; top:-1000px" class="esc">
		<input type="submit" value="Submit">
		<button type="button" class="close">Cancel</button>
	</form>
	
</div>




