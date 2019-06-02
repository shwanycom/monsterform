<?php
session_start();

$email="";

  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
  $email = $_POST['email'];

  $sql="SELECT `email`,`password` FROM `member` where email='$email'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $row = mysqli_fetch_array($result);
  $rowcount=mysqli_num_rows($result);
  if(!$rowcount){
    echo '[{"passwd":"실패1"}]';
    exit;
  }
  if($row['password']=="123456"){
    echo '[{"passwd":"실패2"}]';
    exit;
  }
  include './Sendmail.php';

  srand((double)microtime()*1000000); //난수값 초기화
  $passwd=rand(10000000,99999999);

  $sql="UPDATE `member` SET password='$passwd' where email='$email'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }

  $to=$email;
  $from="관리자";
  $subject="고객님의 임시 비밀번호 입니다.";
  $body="고객님의 임시 비밀번호 입니다.\n임시비밀번호 : ".$passwd."\n로그인 후 수정하세요.";
  $cc_mail="";
  $bcc_mail=""; /* 메일 보내기*/
  $sendmail->send_mail($to, $from, $subject, $body,$cc_mail,$bcc_mail);

  echo '[{"passwd":"'.$passwd.'"}]';


?>
