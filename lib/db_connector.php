<?php
date_default_timezone_set("Asia/Seoul");

// $servername = "192.168.0.174";
// $username = "monsterform";
// $password = "monster1!";

$servername = "localhost";
$username = "root";
$password = "123456";


$dbflag = "NO";
$conn = mysqli_connect($servername, $username, $password);
if (!$conn){ die("Connection failed: " . mysqli_connect_error());}
$sql = "show databases";
$result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
while ($row = mysqli_fetch_row($result)) {
  if($row[0]==="monsterform_db"){
    $dbflag="OK";
  }
}
//$name=$sub1=$sub2=$sub3=$sub4=$sub5=$sum=$avg="";
//$mode=$result="";
if ($dbflag==="NO") {
  $sql = "CREATE database monsterform_db";
  if(mysqli_query($conn,$sql)){
      echo '<script >
        alert("monsterform_db 테이블 생성되었습니다.");
      </script>';
  }else{
    echo "실패원인 : 이미존재".mysqli_error($conn);
  }
}
$dbconn = mysqli_select_db($conn,"monsterform_db") or die('Error:' . mysqli_error($conn));

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  //<script>alert("zz");</script> --> &lt;script&gt;
  return $data;
}

function alert_back($str) {
  echo "<script> alert('$str'); history.go(-1); </script>";
  exit;
}
?>
