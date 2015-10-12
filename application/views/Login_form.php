<?php include_once("header.php") ?>

<article>
	<h1>LOG IN</h1>
	<container>
		<section>
                <?php include_once("flash.php") ?>
			<form method="post" action="<?php echo site_url('user/login_check')?>" name="myForm" onsubmit="return(Validate());">
				<label>Phone: </label>
				<input type="text" name="phone">
				<br>
				<label>Email: </label>
				<input type="text" name="email" required/>
				<br>
				<container>
				<input class="myButton" type="submit" value="Submit"/>
				</container>
			</form>

			<container>
				<hr class="horizontalline">
				<h1>NOT A USER?</h1>
			</container>

			<container>
				<a href="<?php echo site_url('User/register/')?>"><button class="myButton">Register</button></a>
			</container>
		</section>
	</container>
</article>
<?php include_once("footer.php") ?>
