<?php

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

$email=$_GET["send_id"];



if(isset($_GET["mode"]) && $_GET["mode"]=='id_check'){
  if (empty($_GET["send_id"])) {
    echo "아이디 값이 없습니다.";
  } else {
    $id = test_input($_GET["send_id"]);
    $q_id = mysqli_real_escape_string($conn, $id);

    $sql = "SELECT * from member where email = '$q_id'";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }
    $rowcount = mysqli_num_rows($result);
    if ($rowcount) {
      echo "입력하신 회원의 정보가 있습니다.";

    }else{
      echo "입력하신 회원의 정보가 없습니다.";
    }
  }

}




 ?>
