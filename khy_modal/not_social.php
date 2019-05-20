<?php
session_start();
include $_SERVER['DOCUMENT_ROOT']."/monsterform/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."/monsterform/lib/create_table.php";
create_table($conn, 'member');

if($_GET["mode"]=="login"){
  if(!(isset($_POST["login_email"])&&isset($_POST["login_password"]))
     ||empty($_POST["login_email"])||empty($_POST["login_password"])){
       echo "<script>alert('다 입력해 주세요'); history.go(-1); </script>";
  }else{
    $email = $_POST["login_email"];
    $password= $_POST["login_password"];
  }

  $sql="SELECT * from `member` where `email` = '$email'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $rowcount=mysqli_num_rows($result);
  if(!$rowcount){
    mysqli_close($conn);
    echo "<script>alert('디비에 없는 메일'); history.go(-1);</script>";
  }else{
    $row=mysqli_fetch_array($result);
    if($password==$row['password']){
      $_SESSION['no'] = $row['no'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['mon'] = $row['point_mon'];
      $_SESSION['partner'] = $row['partner'];
      //echo "<script>alert('세션값 부여완료');</script>";
    }
  }
  mysqli_close($conn);
  Header("Location: ../index.php");
}elseif ($_GET["mode"]=="join") {
  if(!(isset($_POST["member_email_address"])&&isset($_POST["member_username"])&&isset($_POST["member_password"]))
     ||empty($_POST["member_email_address"])||empty($_POST["member_username"])||empty($_POST["member_password"])){
       echo "<script>alert('다 입력해 주세요'); history.go(-1); </script>";
  }else{
    $email = $_POST["member_email_address"];
    $username = $_POST["member_username"];
    $password = $_POST["member_password"];

    $sql="INSERT INTO `member` (`no`,`email`,`username`,`password`,`point_mon`.`partner`)";
    $sql.=" VALUES (null,'$email','$username','$password',0,null)";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
  }
  mysqli_close($conn);
  Header("Location: ../index.php");
}
?>
