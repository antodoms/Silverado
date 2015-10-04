<h4> User Details </h4>

<?php
 if($dataSet){
     foreach ($dataSet as $dataItem){
         echo $dataItem->id."  ".$dataItem->name."  ".$dataItem->phone."   ".$dataItem->email."<br>";
     }
 }
?>

