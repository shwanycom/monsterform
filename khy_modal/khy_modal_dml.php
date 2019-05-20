<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/monsterform/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/monsterform/lib/create_table.php";
create_table($conn, 'member');

$email=trim($_POST["email"]);
// $email=preg_replace("/s+/",".",$email);
$username=trim($_POST["username"]);
// var_dump($email);
// var_dump($username);

$sql="SELECT * from `member` where `email` = '$email'";
$result = mysqli_query($conn,$sql);
if (!$result) {
  die('Error: ' . mysqli_error($conn));
}
$rowcount=mysqli_num_rows($result);

if($rowcount){
  $row=mysqli_fetch_array($result);
  if($row){
    $_SESSION['no'] = $row['no'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['mon'] = $row['point_mon'];
    $_SESSION['partner'] = $row['partner'];
  }
  // history.go(-1);
  // exit;
}else{
  $sql="INSERT INTO `member` (`no`,`email`,`username`,`password`,`point_mon`,`partner`)";
  $sql.=" VALUES (null,'$email','$username','ekguddldi',0,'n')";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
}
mysqli_close($conn);
Header("Location: ../index.php");

?>
