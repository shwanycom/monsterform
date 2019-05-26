<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
if(isset($_GET["mode"]) && $_GET["mode"]=='go_free'){
  $post_num=$_POST["num"];
  $q_post_num = mysqli_real_escape_string($conn, $post_num);
  $sql="SELECT * from `products` where num='$q_post_num'";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $freegoods=$row["freegoods"];
  if($freegoods=='y'){
    $sql_y="UPDATE products set `freegoods`='n' where num='$q_post_num'";
    $result_y = mysqli_query($conn, $sql_y);
    if (!$result_y) {
      die('Error: UPDATE(FREE GOODS y) ERROR' . mysqli_error($conn));
    }
  }else if($freegoods=='n'){
    $sql_n="UPDATE products set `freegoods`='y' where num='$q_post_num'";
    $result_n = mysqli_query($conn, $sql_n);
    if (!$result_n) {
      die('Error: UPDATE(FREE GOODS n) ERROR' . mysqli_error($conn));
    }
  }
  mysqli_close($conn);
}
if(isset($_GET["mode"]) && $_GET["mode"]=='date'){
  var_dump($_POST['pick_date']);
  $pick_date=$_POST['pick_date'];
  $q_pick_date = mysqli_real_escape_string($conn, $pick_date);
  $sql="UPDATE freegoods_date set `freegoods_date`='$q_pick_date'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: UPDATE(FREE GOODS y) ERROR' . mysqli_error($conn));
  }
  echo "<script> location.href='./admin_freegoods.php';</script>";
}
?>
