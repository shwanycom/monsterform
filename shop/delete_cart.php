<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

$product_num = $_GET['product_num'];

$sql = "delete from cart where product_num = '$product_num'";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "<script> alert('삭제 되었습니다.'); window.close();
       window.opener.location.reload(true);
      </script>";

Header("Location: ./cart.php");
?>
