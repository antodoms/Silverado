<?php include_once("header.php") ?>

<article>
	<h1>CONTACT US</h1>
	<container>
		<section>
			<h2><b>Opening hours:</b></h2>
			<h2>Mon-Fri: 12:30pm - 11:00pm</h2>
			<h2>Sat-Sun: 11:30am - 11:00pm</h2>
			<br>

			<h2><b>Address:</b></h2>
			<h2>404 HTML Street</h2>
			<h2>Hypotheticaland 3001, CSS</h2>
			<br>

			<h2><b>Our number:</b></h2>
			<h2>(03) 4206 9322</h2>
			<br>


		</section>
		<section>
			<emptyspace></emptyspace>
		</section>
		<section>
			<h3>Or email us by filling out the following form.</h3>
			<br>
			<form method="post" action="http://titan.csit.rmit.edu.au/~e54061/wp/testcontact.php">
				<label for="email">Email: </label>
				<input type="email" name="email" id="email" required></input>
				<br>
				<label for="subject">Subject: </label>
				<select name="subject" id="subject" required>
					<option value="GE">General Enquiry</option>
					<option value="GCB">Group and Corporate Bookings</option>
					<option value="SC">Suggestions and Complaints</option>
				</select>
				<br>
				<textarea name="message" id="message" rows="6" cols="50" required></textarea>
				<centerer>
					<input type="submit" value="Submit" class="myButton">
				</centerer>
			</form>
		</section>
	</container>
</article>

<?php include_once("footer.php") ?>