<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

 $send_no = 1;


$receive_no = $_POST['receive_id'];
$message =$_POST['message'];
$regist_day = date("Y-m-d (H:i)");


$sql ="select * from member where no = '$receive_no'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);
var_dump($result);
if(mysqli_num_rows($result) == 0){
    echo "<script>
            alert('잘못된 아이디 입니다.');
            window.history.go(-1);
          </script>";
}else if(empty($message)){
    echo "<script>
            alert('메세지를 입력해 주세요.');
            window.history.go(-1);
          </script>";
}else{
    $sql = "insert into message (rece_no,send_no,msg,regist_day)";
    $sql .= "values('$receive_no', '$send_no', '$message', '$regist_day')";
    mysqli_query($conn, $sql) or die(mysqli_error($conn));

    echo "<script>
            window.close();
            alert('전송됐습니다.');
          </script>";

}

?>
