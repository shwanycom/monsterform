<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
if(isset($_GET["mode"]) && $_GET["mode"]=='go_hand'){
  $post_num=$_POST["num"];
  $q_post_num = mysqli_real_escape_string($conn, $post_num);
  $sql="SELECT * from `products` where num='$q_post_num'";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $handpicked=$row["handpicked"];
  if($handpicked=='y'){
    $sql_y="UPDATE products set `handpicked`='n' where num='$q_post_num'";
    $result_y = mysqli_query($conn, $sql_y);
    if (!$result_y) {
      die('Error: UPDATE(FREE GOODS y) ERROR' . mysqli_error($conn));
    }
  }else if($handpicked=='n'){
    $sql_n="UPDATE products set `handpicked`='y' where num='$q_post_num'";
    $result_n = mysqli_query($conn, $sql_n);
    if (!$result_n) {
      die('Error: UPDATE(FREE GOODS n) ERROR' . mysqli_error($conn));
    }
  }
  mysqli_close($conn);
}

?>
