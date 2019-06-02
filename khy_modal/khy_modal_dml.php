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
    $location = $row['location'];
  if($location=='hell'){
    echo "<script>alert('현재 Block상태인 계정입니다.'); history.go(-1);</script>";
  }else{
    if($row){
      $_SESSION['no'] = $row['no'];
      $_SESSION['email'] = $row['email'];
      $_SESSION['username'] = $row['username'];
      $_SESSION['mon'] = $row['point_mon'];
      $_SESSION['partner'] = $row['partner'];
    }
    $username=$_SESSION['username'];
    echo '<script>
    alert("Hello! '.$username.' ");
    document.location.href="../index.php";
    </script>';
  }
}else{
  $sql="INSERT INTO `member` (`no`,`email`,`username`,`password`,`point_mon`,`partner`)";
  $sql.=" VALUES (null,'$email','$username','12345',0,'n')";
  $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

  $sql="SELECT * from `member` where `email` = '$email'";
  $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
  $row=mysqli_fetch_array($result);
  $_SESSION['no'] = $row['no'];
  $_SESSION['email'] = $row['email'];
  $_SESSION['username'] = $row['username'];
  $_SESSION['mon'] = $row['point_mon'];
  $_SESSION['partner'] = $row['partner'];
  echo "<script>
          alert('Thankyou for join us!');
          document.location.href='../index.php';
        </script>";
}
mysqli_close($conn);
?>
