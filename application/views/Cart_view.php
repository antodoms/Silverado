<?php include_once("header.php") ?>

<article>
    <h1>WELCOME BACK</h1>
    <container>
        <section>
            <?php 
           
            if(!empty($data['cart'])){
                
           
            for ($i=0; $i< count($data['cart']); $i++) {
                echo '<h1> Movie Type'.$data['cart'][$i]['movie'].'</h1><br><p>Day: '.$data['cart'][$i]['day'].' & Time: '.$data['cart'][$i]['time'].'</p>';
                echo '<p>';
                foreach ($data['cart'][$i]['seats'] as $value) {
                    echo 'Type:'.$value['type'].'--> ';
                    
                    foreach ($value['seats'] as $s){
                        echo ' '.$s;
                    }
                    
                    echo '</p>';
                }
                
              echo '<a href="'.site_url('Booking/delete/').'/'.($i+1).'"><button>Remove From Cart</button></a><br><br>';  
            }
            
            }
            
            else{
               echo ' <p> Your cart is empty ! please add some movies to purchase';
            }
            ?>
            <br><br>
           <a href="<?php echo site_url('/movies')?>"><button>Add More Movies</button></a>
           <a href="<?php echo site_url('/booking/confirm')?>"><button>Confirm Booking Ticket</button></a>
        </section>
    </container>
</article>


<?php include_once("footer.php") ?>