<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

if(isset($_POST['shop_no']) && isset($_POST['status'])){
  $shop_no = $_POST['shop_no'];
  $status = $_POST['status'];
  if($status=='n'){
    $sql = "INSERT into `follow` VALUES ($member_no, $shop_no);";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    echo "insert";
  }else{
    $sql = "DELETE from `follow` where following=$member_no and follower=$shop_no;";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    echo "delete";
  }
}else{
  echo "fail";
}

 ?>
