<?php include_once("header.php") ?>
<?php include_once("flash.php") ?>

<article>
<container>
<h4> User Details </h4>

<?php
 if($dataSet){
     foreach ($dataSet as $dataItem){
         echo $dataItem->id."  ".$dataItem->name."  ".$dataItem->phone."   ".$dataItem->email."<br>";
     }
 }
?>
</container>
</article>
<?php include_once("footer.php") ?>

