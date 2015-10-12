<?php
    $message = $this->session->flashdata('flash');
    if(!empty($message)) {
    
        echo '<div id="flash" class="'.$message['class'].'">'.$message['message'];
        echo '<button class="closex" onclick="removeflash()" >X</button></div>';
    }
?>