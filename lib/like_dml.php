<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

if($member_no == ''){
  echo 'fail';
  exit;
}else{
  if(isset($_GET["mode"]) && $_GET["mode"]=='go_like'){
    $post_num=$_POST["num"];
    $post_liv=$_POST["liv"];
    var_dump($post_num);
    var_dump($post_liv);
    date_default_timezone_set("Asia/Seoul");
    $now = date("Y-m-d(H:i)");

    if($post_liv=='n'){
      $sql="INSERT into `likes` VALUES ($member_no, $post_num, '$now');";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        die('Error: INSERT(LIKES y) ERROR' . mysqli_error($conn));
      }
    }else{
      $sql="DELETE from `likes` where no='$member_no' and product_num='$post_num';";
      $result = mysqli_query($conn, $sql);
      if (!$result) {
        die('Error: DELETE(LIKES y) ERROR' . mysqli_error($conn));
      }
    }

    mysqli_close($conn);
  }
}

?>
