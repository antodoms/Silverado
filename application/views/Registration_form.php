
<form action="<?php echo site_url('User/login_check')?>" name="myForm" onsubmit="return(Validate());">
    <lable>Name: </lable>
    <input type = "text" name = "Name" />
    <br>
    <lable>Phone: </lable
    <input type = "text" name = "Phone">
    <br>
    <lable>Email: </lable>
    <input type= "text" name= "email" required/>
    <br>
    <input type = "submit" value = "submit"/>
</form>