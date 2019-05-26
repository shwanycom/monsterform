<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$email = $_SESSION['email'];
$regist_day = date("Y-m-d (H:i)");
$message=$_GET['message'];
$rece_email=$_GET['reemail'];
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

if($message==null){
  $message= $email."님께서 ".$mon."mon을 선물 하였습니다.";
}

if (isset($_GET["mode"])&& $_GET["mode"]=='update') {
      $email = test_input($email);
      $mon=test_input($mon);
      $sql = "update member set point_mon=point_mon+$mon where email = '$rece_email';";
      $result = mysqli_query($conn,$sql);
      $sql = "insert into message (rece_email,send_email,msg,regist_day)";
      $sql .= "values('$rece_email', '$email', '$message', '$regist_day')";
      $result = mysqli_query($conn,$sql);

      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

  echo "<script> location.href='../index.php';</script>";

}

?>
