<?php
session_start();

include '../lib/db_connector.php';

$content = $q_content = $q_userid = $sql = $result = "";
$username = $_SESSION['username'];
$email = $_SESSION['email'];

if(empty($username)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}

if(isset($_GET["mode"]) && $_GET["mode"] == "insert"){
  $username = test_input($_POST["username"]);
  $email = test_input($_POST['email']);
  $content = trim($_POST['content']);
  $subject = trim($_POST['subject']);
  if(empty($content) || empty($subject)){
    echo '<script>
    alert("내용과 제목을 입력하세요."); history.go(-1); </script>';
    exit;
  }
    $sql = "SELECT * from `member` where email='$email';";

    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($result);
    $no = $row['no'];
    $topic = $_POST['topic'];
    $content = test_input($_POST["content"]);
    $subject = test_input($_POST['subject']);
    $q_content = mysqli_real_escape_string($conn, $content);
    $q_subject = mysqli_real_escape_string($conn, $subject);
    $regist_day = date("Y-m-d(H:i)");

    $sql = "INSERT INTO `discussion` VALUES ($no, null, '$username', '$email', '$topic', '$q_subject', '$q_content', '$regist_day');";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql = "SELECT num from `discussion` where no = '$no' order by num desc;";
    $result = mysqli_query($conn, $sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $row = mysqli_fetch_array($result);
    $num = $row['num'];

    mysqli_close($conn);

    echo '<script>location.href="./view.php?num='.$num.'";</script>';
}else if(isset($_GET["mode"]) && $_GET["mode"] == "delete"){

}

 ?>
