
<form action="<?php echo site_url('User/user_reg_check')?>" name="myForm" onsubmit="return(Validate());">
    <label>Name: </label>
    <input type = "text" name = "name" />
    <br>
    <label>Phone: </label>
    <input type = "text" name = "email">
    <br>
    <label>Email: </label>
    <input type= "text" name= "phone" required/>
    <br>
    <input type = "submit" value = "submit"/>
</form>