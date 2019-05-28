<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

if(!isset($_POST['shop_no'])){
  echo "fail";
  exit;
}else{
  if(isset($_POST['status']) && isset($_POST['status']) == 'n'){
    $shop_no = $_POST['shop_no'];
    $sql = "INSERT into `follow` VALUES ($member_no, $shop_no);";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }else{
    $shop_no = $_POST['shop_no'];
    $sql = "DELETE from `follow` where ";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }


  echo "success";
}

 ?>
