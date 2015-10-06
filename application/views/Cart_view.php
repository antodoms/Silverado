<?php include_once("header.php") ?>

<article>
    <h1>WELCOME BACK</h1>
    <container>
        <section>
            <?php 
            
            foreach ($data['cart'] as $item){
                echo '<h1> Movie Type'.$item['movie'].'</h1><br><p>Day & Time '.$item['day'].' '.$item['time'].'</p><br>';
                
                foreach ($item['seats'] as $value) {
                    echo '<br><p> Type:'.$value['type'].'--> ';
                    
                    foreach ($value['seats'] as $s){
                        echo ' '.$s;
                    }
                    
                    echo '</p>';
                }
            }
            
            ?>
        </section>
    </container>
</article>


<?php include_once("footer.php") ?>