<?php
session_start();


$email = $_SESSION['email'];
$point1 = $_SESSION['mon'];



var_dump($email);
var_dump($totalPrice);
var_dump($point1);




if (isset($_GET["mode"])&&$_GET["mode"]=='update') {

     $email = test_input($email);


  $sql = "update member set point_mon=돈이들어가야된다~ where email = $email;";
  $result = mysqli_query($conn,$sql);
  //var_dump($result);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  echo "<script> location.href='./point_main.php';</script>"; //script 이용 방법
  // Header("Location:../index.php"); Header 이용 방법
}

 ?>
