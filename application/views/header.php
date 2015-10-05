<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<!DOCTYPE html>
<html>
    
   <head>
        <title>Silverado Movies</title>
        <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo asset_url(); ?>css/stylesheet.css" />
         <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="<?php echo asset_url(); ?>js/cookie.js"></script>
        
        
        <script src="<?php echo asset_url(); ?>js/<?php if($this->router->fetch_method() == 'movies'){ echo 'movies'; } else{ echo 'home'; } ?>.js"></script>
        
        
    </head>
    
    
    <body onload="setpage('<?php echo $this->router->fetch_method(); ?>');">
       <header>
            <nav>
              <img class="container" src="<?php echo asset_url(); ?>images/logo.png" alt="logo">
              <div class="container">   
                  <ul>
                      <li class="desktop"><b><a href="<?php echo base_url(); ?>">Home</a></b></li>
                      <li class="desktop"><b><a href="<?php echo base_url(); ?>index.php/movies/">Booking</a></b></li>
                      <li class="desktop"><b><a href="<?php echo base_url(); ?>index.php/price/">Price</a></b></li>
                      <li class="desktop"><b><a href="<?php echo base_url(); ?>index.php/contact/">Contact</a></b></li>
                      <li class="mobile" style="float: right; margin-right: 15px; margin-top: -20px;"><b>&#9776;</b></li>
                  </ul>
              </div>
            </nav>
            <nav class="mobile">
                    <b><a class="" href="./">Home</a></b>
                    <b><a href="<?php echo base_url(); ?>index.php/movies/">Book Tickets</a></b>
                    <b><a href="<?php echo base_url(); ?>index.php/price/">Price List</a></b>
                    <b><a href="<?php echo base_url(); ?>index.php/contact/">Contact</a></b>
            </nav>
     </header>
        
    