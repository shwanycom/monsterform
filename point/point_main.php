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

	<link rel="stylesheet" href="../css/photo.css?">
<style media="screen">
  .point_main{
    width: 100%;
    height: 800px;
    border:1px solid black;
  }
  .center_div{
    width: 1200px;
    padding: 0 10px;
    margin: 0 auto;
    position: relative;
    height: auto;
    border:1px solid black;
  }
  .point_1{
    width: 190px;
    height:200px;
    border: 1px solid black;
    float: left;
    margin-left: 8px;
    cursor: pointer;
  }
  .point_div{

  }
</style>

<script type="text/javascript">


var value="";
function select(value){
  var text = ""+value;
  var money=document.getElementById("money_span").innerHTML = text;

  document.getElementById('money_kaka').value = money;

}


function check_input(){
    document.buy.action="./kakaopay.php";
    alert(document.buy.action);
    // var url = document.getElementById("id_board_form").action;
    // var result = encodeURI(decodeURI(url));
    // document.getElementById("id_board_form").action = result;
    document.buy.submit();
}



</script>

<div class="point_main">
  <div class="center_div">

    <div class="main_title">
      <h1>Stock up on Credits</h1>
      <p>save money and get free bonus credits when you buy in bulk</p>
    </div>
    <div class="point_div">

      <div class="point_1"onclick="select('2000')" value="2000">
        2000
      </div>
      <div class="point_1"onclick="select('20000')" value="20000">
        20000
      </div>
      <div class="point_1"onclick="select('50000')" value="50000">
        50000
      </div>
      <div class="point_1"onclick="select('100000')" value="110000">
        100000
        +10000
      </div>
      <div class="point_1"onclick="select('200000')" value="200000">
        200000
        +20000
      </div>
      <div class="point_1"onclick="select('500000')" value="500000">
        500000
        +50000
      </div>
<hr>

      <form method="post" name="buy">
          <div class="point_1">
              <span id="money_span">100000</span>
        금액  <input type="text" name="totalPrice" id="money_kaka" value=""> <br>
              <input type="button" name="" onclick="check_input()" value="결제하기">
            </div>
      </form>

    </div>
  </div>
</div>
