<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

  if($_POST["big_data"]=='photos'){
    $big_data = 'photos';
    echo '[{"ok":"'.$big_data.'"}]';
  }else if($_POST["big_data"]=='graphics'){
    $big_data = 'graphics';
    echo '[{"ok":"'.$big_data.'"}]';
  }else if($_POST["big_data"]=='fonts'){
    $big_data = 'fonts';
    echo '[{"ok":"'.$big_data.'"}]';
  }else if($_POST["big_data"]=='none'){
    $big_data = 'none';
    echo '[{"ok":"'.$big_data.'"}]';
  }
//
//
// (isset($_GET["mode"]) && $_GET["mode"] == "id_ajax"){
//   $id = test_input($_POST["id"]);
//   if (!preg_match("/^[a-zA-Z0-9]{4,12}$/",$id)) {
//     echo '[{"ok":"아이디 형식이 올바르지 않습니다."},{"sign":"1"}]';
//     exit;
//   }
//   $sql = "SELECT * FROM run_member where id = '$id';";
//   $result = mysqli_query($conn, $sql);
//   $row = mysqli_num_rows($result);
//   if($row){
//     echo '[{"ok":"아이디 중복됨"},{"sign":"'.$row.'"}]';
//   }else{
//     echo '[{"ok":"사용가능함"},{"sign":"'.$row.'"}]';
//   }
// }else if(isset($_GET["mode"]) && $_GET["mode"] == "nick_ajax"){
//   $nick = test_input($_POST["nick"]);
//   if (!preg_match("/^[가-힣a-zA-Z0-9]{2,8}$/u",$nick)) {
//     echo '[{"ok":"닉네임 형식이 올바르지 않습니다."},{"sign":"1"}]';
//     exit;
//   }
//   $sql = "SELECT * FROM run_member where nick = '$nick';";
//   $result = mysqli_query($conn, $sql);
//   $row = mysqli_num_rows($result);
//   if($row){
//     echo '[{"ok":"닉네임 중복됨"},{"sign":"'.$row.'"}]';
//   }else{
//     echo '[{"ok":"사용가능함"},{"sign":"'.$row.'"}]';
//   }
// }
//

mysqli_close($conn);
 ?>
