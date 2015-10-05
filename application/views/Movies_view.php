<?php include_once("header.php") ?>





<div id="allmovies">
</div>

<!-- Ticket Buying Dialog -->

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
<!--					<td><input type="number" class="qty" name="SA" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('SA');">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Concession</td>
					<td class="priceREG" hidden>$15.00</td>
					<td class="priceDIS" hidden>$10.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="SP" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('SP');">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Child</td>
					<td class="priceREG" hidden>$12.00</td>
					<td class="priceDIS" hidden>$8.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="SC" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('SC');">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>First Class Adult</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$25.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="FA" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('FA')">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>First Class Child</td>
					<td class="priceREG" hidden>$25.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="FC" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('FC')">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 1 Person</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B1" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('B1')">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 2 Persons</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B2" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('B2')">add seats</div></td>
					<td class="subtotal">$0.00</td>
				</tr>
				<tr>
					<td>Beanbag - 3 Children</td>
					<td class="priceREG" hidden>$30.00</td>
					<td class="priceDIS" hidden>$20.00</td>
					<td class="price"></td>
<!--					<td><input type="number" class="qty" name="B3" min="0" max="10" step="1" value="0"</input></td>-->
					<td><div onclick="settheatre('B3')">add seats</div></td>
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
	<div id="theatre" class="white_content">
		<div class="NT1">
		<button id="B1">B1</button>
		<button id="B2">B2</button>
		<button id="B3">B3</button>
		<button id="B4">B4</button>
		<button id="B5">B5</button>
		<br>
		<button id="B11">B11</button>
		<button id="B12">B12</button>
		<button id="B13">B13</button>
		<button id="B14">B14</button>
		<button id="B15">B15</button>
		<br>
		<button id="B21">B21</button>
		<button id="B22">B22</button>
		<button id="B23">B23</button>
		<button id="B24">B24</button>
		<button id="B25">B25</button>
		<br>
		<button id="B31">B31</button>
		<button id="B32">B32</button>
		<button id="B33">B33</button>
		<button id="B34">B34</button>
		<button id="B35">B35</button>
		<br>
	  </div>
	  <div class="FT">
		<button id="A1">A1</button>
		<button id="A2">A2</button>
		<button id="A3">A3</button>
		<button id="A4">A4</button>
		<br>
		<button id="A5">A5</button>
		<button id="A6">A6</button>
		<button id="A7">A7</button>
		<button id="A8">A8</button>
		<br>
		<button id="A9">A9</button>
		<button id="A10">A10</button>
		<button id="A11">A11</button>
		<button id="A12">A12</button>
		<br>
	  </div>
	  <div class="NT2">
		<button id="B6">B6</button>
		<button id="B7">B7</button>
		<button id="B8">B8</button>
		<button id="B9">B9</button>
		<button id="B10">B10</button>
		<br>
		<button id="B16">B16</button>
		<button id="B17">B17</button>
		<button id="B18">B18</button>
		<button id="B19">B19</button>
		<button id="B20">B20</button>
		<br>
		<button id="B26">B26</button>
		<button id="B27">B27</button>
		<button id="B28">B28</button>
		<button id="B29">B29</button>
		<button id="B30">B30</button>
		<br>
		<button id="B36">B36</button>
		<button id="B37">B37</button>
		<button id="B38">B38</button>
		<button id="B39">B39</button>
		<button id="B40">B40</button>
		<br>
	  </div>
	  <div class="BT">
		<button id="C1">C1</button>
		<button id="C2">C2</button>
		<button id="C3">C3</button>
		<button id="C4">C4</button>
		<button id="C5">C5</button>
		<button id="C6">C6</button>
		<br>
		<button id="C7">C7</button>
		<button id="C8">C8</button>
		<button id="C9">C9</button>
		<button id="C10">C10</button>
		<button id="C11">C11</button>
		<button id="C12">C12</button>
		<br>
	  </div>
		  <div style="margin-left: 40%; margin-right: 40%;  background-color: white;color: black;font-weight: bolder;text-align: -webkit-center;padding: 20px;" onclick="document.getElementById('theatre').style.display='none'">OK</div>
	</div>
</dialog>





<?php include_once("footer.php") ?>
