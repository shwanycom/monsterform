<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

$email = $_SESSION['email'];
$receive_id = $_POST['name'];


$sql ="select * from member where email = '$receive_id'";
$result = mysqli_query($conn, $sql);
$row=mysqli_fetch_array($result);

if(mysqli_num_rows($result) == 0){
    echo "<script>
            alert('해당 아이디가 없습니다.');
          </script>";
          echo "<script> location.href='./gift_view.php?';</script>";
}else{

    $totalPrice=$_POST['totalPrice'];
    $pay_name=$_POST['name'];
    $pay_message=$_POST['message'];
    echo "<script> location.href='./payment.php?price=$totalPrice&payname=$pay_name&paymessage=$pay_message';</script>";
}

?>
