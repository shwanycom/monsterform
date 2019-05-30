<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
}else{
  $email="";
}


$num = $_GET['num'];
$send_email = $_GET['email'];
$rece_email= $_GET['email1'];


if($email==$rece_email){
  $sql="update message SET rece_del='y' where rece_email='$rece_email' and num=$num;";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $sql3 = "select * from message where num = '$num'";
  $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
  $row3=mysqli_fetch_array($result3);
  $send_del3=$row3["send_del"];
  $rece_del3=$row3["rece_del"];
  if($rece_del3=='y' && $send_del3=='y'){
    $sql1 = "delete from message where num = '$num' and rece_del='y' and send_del='y'";
    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
    $sql2 ="DELETE FROM `message_ripple` WHERE parent=$num";
    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
  }
}else if($email==$send_email){
  $sql="update message SET send_del='y' where send_email='$send_email' and num=$num;";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $sql3 = "select * from message where num = '$num'";
  $result3 = mysqli_query($conn, $sql3) or die(mysqli_error($conn));
  $row3=mysqli_fetch_array($result3);
  $send_del3=$row3["send_del"];
  $rece_del3=$row3["rece_del"];
  if($rece_del3=='y' && $send_del3=='y'){
    $sql1 = "delete from message where num = '$num' and rece_del='y' and send_del='y'";
    $result1 = mysqli_query($conn, $sql1) or die(mysqli_error($conn));
    $sql2 ="DELETE FROM `message_ripple` WHERE parent=$num";
    $result2 = mysqli_query($conn, $sql2) or die(mysqli_error($conn));
  }
}

 // $sql = "delete from message where num = '$num' ";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "<script> alert('삭제 되었습니다.'); window.close();
       window.opener.location.reload(true);
      </script>";
header('Location: ./message.php');

?>
