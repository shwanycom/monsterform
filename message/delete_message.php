<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

$num = $_GET['num'];

$sql = "delete from message where num = '$num'";
mysqli_query($conn, $sql);

mysqli_close($conn);

echo "<script> alert('삭제 되었습니다.'); window.close();
       window.opener.location.reload(true);
      </script>";

Header("Location: ./message.php");
?>
