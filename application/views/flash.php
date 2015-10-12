<?php
    
    if($this->session->flashdata('flash')) {
        $message = $this->session->flashdata('flash');
        echo '<div id="flash" class="'.$message['class'].'">'.$message['message'];
        echo '<button class="closex" onclick="removeflash()" >X</button></div>';
    }else{
        $this->session->set_flashdata('flash', array('message' => '','class' => ''));
                 
    }
?>