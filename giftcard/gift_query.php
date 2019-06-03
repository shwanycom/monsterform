<?php
session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$email = $_SESSION['email'];
$no=$_SESSION['no'];
$regist_day = date("Y-m-d (H:i)");
$message=$_GET['message'];
$rece_email=$_GET['reemail'];
$won=(int)$_GET['price'];

// 지불한 가격에 대한 보너스 포인트
if($won==5000){
  $bonus=0;
}else if($won==20000){
  $bonus=0;
}else if($won==50000){
  $bonus=0;
}else if($won==100000){
  $bonus=100;
}else if($won==200000){
  $bonus=200;
}else if($won==500000){
  $bonus=500;
}

// 지불한 가격을 point_mon으로 바꿔서 저장
$mon=(int)$_GET['price'];
if($mon==5000){
  $mon=50;
}else if($mon==20000){
  $mon=200;
}else if($mon==50000){
  $mon=500;
}else if($mon==100000){
  $mon=1000;
}else if($mon==200000){
  $mon=2000;
}else if($mon==500000){
  $mon=5000;
}

$total_mon=$mon+$bonus;


if($message==null){
  $message= $email."님께서 ".$mon."mon을 선물 하였습니다.";
}

if (isset($_GET["mode"])&& $_GET["mode"]=='update') {
      $email = test_input($email);
      $mon=test_input($mon);
      $sql = "update member set point_mon=point_mon+$total_mon where email = '$rece_email';";
      $result = mysqli_query($conn,$sql);

      $sql="insert into `sales` values($won,$bonus,$mon,$no,'$regist_day');";
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
