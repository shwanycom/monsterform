<?php

session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
// include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

$email = $_SESSION['email'];
$point1 = $_SESSION['mon'];
if(empty($_GET['selected'])){
  $selected = 100000;
}else{
  $selected = $_GET['selected'];
}

var_dump($selected);
var_dump($email);
var_dump($point1);



create_table($conn, "member");



?>
<link rel="stylesheet" href="../css/point.css?">

<script type="text/javascript">
  var value="";
  var money="";
  var color="";



function select(value){
  var text = ""+value;
  money=document.getElementById("money_span").innerHTML = text;
  document.getElementById('money_kaka').value = money;
}




  function check_input(){
      document.buy.action="./kakaopay.php";
      document.buy.submit();
  }





</script>

<div class="point_main">
  <div class="center_div">
    <div class="main_title">
      <h1 id="title_h1">Stock up on Credits</h1>
      <p id="sub_p">save money and get free bonus credits when you buy in bulk</p>
    </div>
    <div class="point_div">
      <div class="point_2000">
          <div class="point_1"onclick="select('5000')" value="5000">
            <div id="a" onclick="bodercolor('this')" >
            <h3 class="mon_h3">\5000 <p class="mon_p" >(50mon)</p></h3>
            <p class="bonus_p">No Bonus</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p>Individual</p>
            </div>
          </div>
        </div>
      </div>
      <div class="point_2000">
        <div class="point_1"onclick="select('20000')" value="20000">
            <div id="b" onclick="bodercolor(b)">
            <h3 class="mon_h3">\20000 <p class="mon_p" >(200mon)</p></h3>
            <p class="bonus_p">No Bonus</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p>Professional</p>
            </div>
          </div>
        </div>
      </div>
      <div class="point_2000">
        <div class="point_1"onclick="select('50000')" value="50000">
          <div id="c" onclick="bodercolor(c)">
            <h3 class="mon_h3">\50000 <p class="mon_p" >(500mon)</p></h3>
            <p class="bonus_p">No Bonus</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p>Professional</p>
            </div>
          </div>
        </div>
      </div>
      <div class="point_2000">
        <div class="point_1"onclick="select('100000')" value="110000">
          <div id="d" onclick="bodercolor(d)">
            <h3 class="mon_h3">\100000 <p class="mon_p" >(1000mon)</p></h3>
            <p class="bonus_p_y">Bonus +100mon</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p style="font-weight:bold;">Most Popular</p>
            </div>
          </div>
        </div>
      </div>
      <div class="point_2000">
        <div class="point_1"onclick="select('200000')" value="200000">
          <div id="e" onclick="bodercolor(e)">
            <h3 class="mon_h3">\200000 <p class="mon_p" >(2000mon)</p> </h3>
            <p class="bonus_p_y">Bonus +200mon</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p>Big Bonus</p>
            </div>
          </div>
        </div>
      </div>
      <div class="point_2000">
        <div class="point_1"onclick="select('500000')" value="500000">
          <div id="f" onclick="bodercolor(f)">
            <h3 class="mon_h3">\500000<p class="mon_p" >(5000mon)</p></h3>
            <p class="bonus_p_y">Bonus +500mon</p>
            <div class="" style="border-top: 0.4px solid #444444; ">
              <p>Best Value</p>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="point_result_div">
      <h4 id="sub_h4">Complete Purchase</h4>
      <hr>
      <form method="post" name="buy">
          <div class="point_result">
            <input type="hidden" name="totalPrice" id="money_kaka" value="<?=$selected?>">
            <span class="credit_span">Buy Credit :</span>

            <span id="money_span"><?=$selected?></span>
            <span class="credit_span">won</span> <br>
            <input type="image" onclick="check_input()" value="결제하기" src="../img/kakaopay.png" style="padding-top:9px; width: 60px;">
            <!-- <input type="button" name="" onclick="check_input()" value="결제하기" src="../img/logo.png"> -->
          </div>
      </form>
    </div>
  </div>
</div>
