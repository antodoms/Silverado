<?php include_once("header.php") ?>

<article>
	<h1>REGISTER</h1>
	<container>
		<section>
                    <?php include_once("flash.php") ?>
			<form method="post" action="<?php echo site_url('User/registration_check')?>" name="myForm" onsubmit="return(Validate());">
				<label>Name: </label>
				<input type="text" name="name" required/>
				<br>
				<label>Phone: </label>
				<input type="text" name="phone" required/>
				<br>
				<label>Email: </label>
				<input type="text" name="email" required/>
				<br>
				<container>
					<input class="myButton" type="submit" value="Submit"/>
				</container>
			</form>
			<!-- <a href="<?php echo site_url('User/login/')?>"><button>Login</button></a> -->
		</section>
</container>
</article>

<?php include_once("footer.php") ?>
