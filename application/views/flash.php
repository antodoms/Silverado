<?php
    if(!empty($this->session->flashdata('flash'))) {
        $message = $this->session->flashdata('flash');
    
        echo '<div id="flash" class="'.$message['class'].'">'.$message['message'];
        echo '<button class="closex" onclick="removeflash()" >X</button></div>';
    }
?>