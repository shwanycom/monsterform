<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
if(!isset($_SESSION['email'])){
echo "<script> alert('no permission'); history.go(-1); </script>";
exit;
}
?>
<style media="screen">
#section_write{
  margin-left: 10%;
  margin-top:10%;
}
</style>

<section id="section_write">

</section>
