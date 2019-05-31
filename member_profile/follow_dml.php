<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

if(isset($_POST['shop_no']) && isset($_POST['status'])){
  $shop_no = $_POST['shop_no'];
  $status = $_POST['status'];
  $shop_email = $_POST['shop_email'];
  $regist_day = date("Y-m-d (H:i)");

  if($status=='n'){
    $sql = "INSERT into `follow` VALUES ($member_no, $shop_no);";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql_mess = "INSERT into `message` (`num`,`send_email`,`rece_email`,`msg`,`regist_day`)VALUES(null,'$member_email', '$shop_email', '[Following♬] $member_email 님께서 $shop_email 님을 Following 하였습니다.', '$regist_day');";
    $result_mess = mysqli_query($conn, $sql_mess);
    if (!$result) {
      die('Error: 222222' . mysqli_error($conn));
    }

    echo "insert";
  }else{
    $sql = "DELETE from `follow` where following=$member_no and follower=$shop_no;";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql_mess_del = "DELETE from `message` where send_email='$member_email' and rece_email='$shop_email' and msg like '%[Following♬]%';";
    $result_mess_del = mysqli_query($conn, $sql_mess_del);
    if (!$result) {
      die('Error: 222222' . mysqli_error($conn));
    }

    echo "delete";
  }
}else{
  echo "fail";
}

 ?>
