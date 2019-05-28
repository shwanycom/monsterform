<?php
  $str = "/14/24/34/44";
  $product_num=explode("/",$str);
  var_dump($product_num); echo "<br>";
  for($i=1 ; $i<sizeof($product_num) ;$i++){
    var_export($product_num[$i]); echo "<br>";
  }
  var_export("end of for"); echo "<br>";
  // var_dump($product_num[1]); echo "<br>";
  // var_dump($product_num[4]); echo "<br>";
?>
