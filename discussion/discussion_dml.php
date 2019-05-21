<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

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
  $num = test_input($_GET["num"]);

  $sql = "DELETE from `discussion` where num=$num;";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  mysqli_close($conn);

  echo '<script>location.href="./list.php";</script>';

}else if(isset($_GET["mode"]) && $_GET["mode"] == "update"){
  $num = test_input($_GET["num"]);
  $content = trim($_POST['content']);
  $subject = trim($_POST['subject']);
  if(empty($content) || empty($subject)){
    echo '<script>
    alert("내용과 제목을 입력하세요."); history.go(-1); </script>';
    exit;
  }
  $topic = $_POST['topic'];
  $content = test_input($_POST["content"]);
  $subject = test_input($_POST['subject']);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_subject = mysqli_real_escape_string($conn, $subject);

  $sql = "UPDATE `discussion` set subject='$q_subject', content='$q_content', topic='$topic' where num=$num;";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  mysqli_close($conn);

  echo '<script>location.href="./view.php?num='.$num.'";</script>';
}else if(isset($_GET["mode"]) && $_GET["mode"] == "insert_ripple"){
  $parent = test_input($_POST["parent"]);
  $ripple_content = test_input($_POST["ripple_content"]);
  $now = test_input($_POST["now"]);
  $username = test_input($_POST["username"]);
  $email = test_input($_POST["email"]);

  $sql = "INSERT INTO `discussion_ripple` VALUES(null, $parent, '$username', '$email', '$ripple_content','$now');";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  mysqli_close($conn);

  echo '<script>location.href="./view.php?num='.$parent.'";</script>';
}else if(isset($_GET["mode"]) && $_GET["mode"] == "ripple_delete"){
  $num = test_input($_POST["num"]);
  $parent = test_input($_POST["parent"]);

  $sql = "DELETE from `discussion_ripple` where num=$num;";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  mysqli_close($conn);

  echo '<script>location.href="./view.php?num='.$parent.'";</script>';
}

 ?>
