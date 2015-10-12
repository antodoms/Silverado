<?php
    
    if(method_exists($this->session->flashdata('flash'),'read')) {
        $message = $this->session->flashdata('flash');
        echo '<div id="flash" class="'.$message['class'].'">'.$message['message'];
        echo '<button class="closex" onclick="removeflash()" >X</button></div>';
    }
?>