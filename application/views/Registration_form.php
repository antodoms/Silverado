<?php include_once("header.php") ?>

<article>
    <h1>WELCOME BACK</h1>
    <container>
        <section>
        <form method="post" action="<?php echo site_url('User/registration_check')?>" name="myForm" onsubmit="return(Validate());">
            <label>Name: </label>
            <input type = "text" name = "name" required/>
            <br>
            <label>Phone: </label>
            <input type = "text" name = "phone" required/>
            <br>
            <label>Email: </label>
            <input type= "text" name= "email" required/>
            <br>
            <input type = "submit" value = "submit"/>
        </form>
            </section>
</container>
</article>
<?php include_once("footer.php") ?>