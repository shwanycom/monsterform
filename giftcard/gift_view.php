<?php

session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
// include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

$email = $_SESSION['email'];
$point1 = $_SESSION['mon'];

var_dump($email);
var_dump($point1);

create_table($conn, "member");

?>

<style media="screen">


/*메인 타이틀*/
  #sub_p{
    font-size: 2px;
  }
</style>

<link rel="stylesheet" href="../css/gift.css?">

<script type="text/javascript">



</script>

<div class="point_main">
  <div class="center_div">
    <div class="main_title">
      <p id="sub_p">Send a Creative Market Gift Card</p>
    </div>


  </div>
</div>
