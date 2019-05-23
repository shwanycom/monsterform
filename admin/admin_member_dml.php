<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
// admin_member_dml.php?mode=delete&no='.$no.'
// admin_member_dml.php?mode=update&no='.$no.'&partner='.$button_index.'
// admin_member_dml.php?mode=exchange_accept&no='.$no.'
// admin_member_dml.php?mode=exchange_reject&no='.$no.'
$mode = $get_no = $get_partner = "";
if(isset($_GET["mode"])){
  $mode=$_GET["mode"];
}
if(isset($_GET["no"])){
  $get_no = $_GET["no"];
}
if(isset($_GET["partner"])){
  $get_partner=$_GET["partner"];
}
if(isset($_GET["mon"])){
  $get_mon=$_GET["mon"];
}
if(isset($_GET["hwan_mon"])){
  $get_hwan_mon=$_GET["hwan_mon"];
}


if(isset($_GET["mode"]) && $_GET["mode"]=='delete'){
  $q_no = mysqli_real_escape_string($conn, $get_no);
  $sql="DELETE FROM `member` WHERE no='$q_no'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: DELETE ERROR' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./admin_member.php';</script>";
}

else if(isset($_GET["mode"]) && $_GET["mode"]=='update'){
  $q_no = mysqli_real_escape_string($conn, $get_no);
  $q_get_partner = mysqli_real_escape_string($conn, $get_partner);
  if($q_get_partner=='TERMINATE'){
    $sql="UPDATE `member` set `partner`='n' WHERE no='$q_no'";
  }else if($q_get_partner=='PARTNER'){
    $sql="UPDATE `member` set `partner`='y' WHERE no='$q_no'";
  }
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: UPDATE PARTNER ERROR' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./admin_member.php';</script>";
}

else if(isset($_GET["mode"]) && $_GET["mode"]=='exchange_accept'){
  $q_no = mysqli_real_escape_string($conn, $get_no);
  $sql="UPDATE `member` set `hwan_mon`='0' WHERE no='$q_no'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: EXCHANGE ACCEPT ERROR' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./admin_member.php';</script>";
}
else if(isset($_GET["mode"]) && $_GET["mode"]=='exchange_reject'){
  $q_no = mysqli_real_escape_string($conn, $get_no);
  $q_get_mon = mysqli_real_escape_string($conn, $get_mon);
  $q_get_hwan_mon = mysqli_real_escape_string($conn, $get_hwan_mon);
  $sql="UPDATE `member` set `hwan_mon`='0', `point_mon`=$get_hwan_mon+$q_get_mon WHERE no='$q_no'";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: EXCHANGE REJECT ERROR' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./admin_member.php';</script>";
}

?>