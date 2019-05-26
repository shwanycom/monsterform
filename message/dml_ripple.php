<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

if(isset($_GET["mode"])&&$_GET["mode"]=='insert_ripple'){
 if(empty($_POST["ripple_content"])){
   echo "<script> alert('내용을 입력하세요'); history.go(-1); </script>";
   exit;
 }
 //덧글을 다는 사람은 로그인을 해야한다 는 것을 말하는 것이다.
  $email=$_SESSION['email'];  //로그인 했는지 확인
  $q_email = mysqli_real_escape_string($conn, $email);
  $sql = "SELECT * from member where email = '$q_email'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $rowcount = mysqli_num_rows($result);
  if (!$rowcount) {
    echo "<script> alert('로그인 후 이용 바랍니다.'); history.go(-1); </script>";
    exit;
  }else{
    $ripple_content = test_input($_POST["ripple_content"]);
    $parent = test_input($_POST["parent"]);
    $q_email = mysqli_real_escape_string($conn,$_SESSION['email']);
    $q_content = mysqli_real_escape_string($conn, $ripple_content);
    $q_parent = mysqli_real_escape_string($conn, $parent);
    $regist_day=date("Y-m-d(H:i)");

    $sql="INSERT INTO `message_ripple` VALUES(null,'$q_parent','$q_email','$q_content','$regist_day')";
    $result = mysqli_query($conn,$sql);

    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    mysqli_close($conn);
    echo "<script> location.href='./view.php?num=$q_parent';</script>"; //script 이용 방법
  }
}
 ?>
