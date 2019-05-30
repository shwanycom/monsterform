<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
}else{
  $email="";
}


$num = $_GET['num'];
$send_email1 = $_GET['email'];


// $sql = "select * from message where num = '$num'";
// $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
//  $row=mysqli_fetch_array($result);
// $send_email=$row["send_email"];
// $rece_email=$row["rece_email"];
// $send_del=$row["send_del"];
// $rece_del=$row["rece_del"];
//
//
// if($email==$rece_email){
//   $sql="update message SET rece_del='y' where rece_email='$rece_email' and num=$num;";
//   if($rece_email=='y' && $send_email=='y'){
//     $sql = "delete from message where num = '$num' and rece_del='y' and send_del='y'";
//   }
// }else if($email==$send_email){
//   $sql="update message SET send_del='y' where send_email='$send_email' and num=$num;";
//   if($rece_email=='y' && $send_email=='y'){
//     $sql = "delete from message where num = '$num' and rece_del='y' and send_del='y'";
//   }
// }

 $sql = "delete from message where num = '$num' ";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "<script> alert('삭제 되었습니다.'); window.close();
       window.opener.location.reload(true);
      </script>";
header('Location: ./message.php');

?>
