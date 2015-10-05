
<form action="<?php echo site_url('User/user_reg_check')?>" name="myForm" onsubmit="return(Validate());">
    <lable>Name: </lable>
    <input type = "text" name = "name" />
    <br>
    <lable>Phone: </lable
    <input type = "text" name = "email">
    <br>
    <lable>Email: </lable>
    <input type= "text" name= "phone" required/>
    <br>
    <input type = "submit" value = "submit"/>
</form>