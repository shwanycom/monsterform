<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

create_table($conn, "message");


if(!isset($_SESSION['email'])){
echo "<script> alert('no permission'); history.go(-1); </script>";
exit;
}
?>
<style media="screen">
#section_write{
  width: 960px;
  height: auto;

}
#message_div{
    border-bottom: 1px solid black;
}

.send_div{
  float: right;
  border-radius: 4px;
  background-color: #d9d9d7;
  border: 1px solid #d9d9d7;
  color: #7d7b78;
}
.list_div{
    font-size: 16px;
    border: 1px solid black;
    /* padding: 22px 20px 21px; */
    width: 100%;
    height: 50px;
    background: #d9d9d7;
    border-radius: 3px;
    margin-top: 20px;

}
</style>

<section id="section_write">
  <div id="message_div">
      <h1>Message</h1>
  </div>
  <div class="">
      <a href="#"> All Message</a>
      |
      <a href="#"> Unread Messages</a>
      <div class="send_div">
        <a href="#">New Message</a>
      </div>
  </div>
  <div class="list_div">

  </div>

</section>
