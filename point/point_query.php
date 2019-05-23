<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$email = $_SESSION['email'];
$point1 = $_SESSION['mon'];

$mon=(int)$_GET['price'];
if($mon==5000){
  $mon=50;
}else if($mon==20000){
  $mon=200;
}else if($mon==50000){
  $mon=500;
}else if($mon==100000){
  $mon=1100;
}else if($mon==200000){
  $mon=2200;
}else if($mon==500000){
  $mon=5500;
}
var_dump($mon);

if (isset($_GET["mode"])&& $_GET["mode"]=='update') {
      $email = test_input($email);
      $mon=test_input($mon);


      $sql = "update member set point_mon=point_mon+$mon where email = '$email';";

      $result = mysqli_query($conn,$sql);

      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

  echo "<script> location.href='./point_main.php';</script>";

}

?>
