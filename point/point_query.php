<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$email = $_SESSION['email'];
$point1 = $_SESSION['mon'];
$no = $_SESSION['no'];
$regist_day = date("Y-m-d (H:i)");
$price_won=(int)$_GET['price'];

if($price_won==5000){
  $bonus_won=0;
}else if($price_won==20000){
  $bonus_won=0;
}else if($price_won==50000){
  $bonus_won=0;
}else if($price_won==100000){
  $bonus_won=100;
}else if($price_won==200000){
  $bonus_won=200;
}else if($price_won==500000){
  $bonus_won=500;
}



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



var_dump($price_won);
var_dump($bonus_won);
var_dump($mon);
var_dump($no);
var_dump($regist_day);

if (isset($_GET["mode"])&& $_GET["mode"]=='update') {
      $email = test_input($email);
      $mon=test_input($mon);


      $sql = "update member set point_mon=point_mon+$mon where email = '$email';";
      $result = mysqli_query($conn,$sql);
      $sql="INSERT INTO `sales` VALUES($price_won,$bonus_won,$mon,$no,'$regist_day');";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

  echo "<script> location.href='../index.php';</script>";

}

?>
