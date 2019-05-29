<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

$email = $_SESSION['email'];
$receive_id = $_POST['receive_id'];
$message =$_POST['message'];
$regist_day = date("Y-m-d (H:i)");


$sql ="select email from member where email = '$receive_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

if(mysqli_num_rows($result) == 0){
    echo "<script>
            alert('잘못된 아이디 입니다.');

          </script>";
}else if(empty($message)){
    echo "<script>
            alert('메세지를 입력해 주세요.');
            window.history.go(-1);
          </script>";
}else{
    $sql = "insert into message (rece_email,send_email,msg,regist_day)";
    $sql .= "values('$receive_id', '$email', '$message', '$regist_day')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));
    echo "<script>
            window.close();
            alert('전송됐습니다.');
          </script>";

}
echo "<script> location.href='./message.php?';</script>"; //script 이용 방법
?>
