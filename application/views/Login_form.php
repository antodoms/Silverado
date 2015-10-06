<?php include_once("header.php") ?>

<article>
			<h1>WELCOME BACK</h1>
			<container>
                            <section>
<form action="<?php echo site_url('User/login_check')?>" name="myForm" onsubmit="return(Validate());">

    <label>Phone: </label>
    <input type = "text" name = "email">
    <br>
    <label>Email: </label>
    <input type= "text" name= "phone" required/>
    <br>
    <input type = "submit" value = "submit"/>
</form>
</section>
                        </container>
</article>
<?php include_once("footer.php") ?>