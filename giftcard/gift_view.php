<?php

session_start();

include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
// include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $point1 = $_SESSION['mon'];
}
$username = $_SESSION['username'];
var_dump($email);
var_dump($point1);

create_table($conn, "member");


?>

<style media="screen">


/*메인 타이틀*/
  #sub_p{
    font-size: 20px;
  }
.gift_center_div{
  border: 1px solid green;

}
  .payment_list{
    border: 1px solid red;
    width: 500px;
    margin: 0 auto;
  }
.check_money{
  border: 1px solid black;

}

.input_field{
  border: 1px solid black;
}
.gift_point{
  border: 1px solid black;
  width: 500px;
  margin: 0 auto;
}
</style>

<!-- <link rel="stylesheet" href="../css/gift.css?"> -->
<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript">


function fnRadioName(){
      var radioId = $('input[name="mon"]:checked').val();
        document.getElementById('money_kaka').value = radioId;
      // var rasioNm = $("label[for='"+radioId+"']").text(); // 라벨값을 불러온다.
      alert(radioId);
  }

  function check_input(){
      document.buy.action="./payment.php";
      document.buy.submit();
}

function input(){
    var input = document.getElementById("email_name").value;
    document.getElementById('gift_name').value = input;


}

function message(){
    var input = document.getElementById("send_message").value;
    document.getElementById('gift_message').value = input;
}


$(function(){

//비밀번호 확인
	$('#email_name2').blur(function(){
	   if($('#email_name').val() != $('#email_name2').val()){
	    	if($('#email_name2').val()!=''){
		    alert("이메일이 일치하지 않습니다.");
	    	    $('#email_name2').val('');
	          $('#email_name2').focus();
	       }
	    }
	})
});
//
function showHide(){
  if(document.getElementById("payment_list").style.display =="block"){
      document.getElementById("showHide").style.display ='block';
      document.getElementById("payment_list").style.display ='none';

  }

}

function d(){
    if(document.getElementById("showHide").style.display =="block"){
      document.getElementById("showHide").style.display ='none';
      document.getElementById("payment_list").style.display ='block';
    }

}
// function check_id() {
//   window.open("email_check.php?mode=id_check&send_id=" + document.getElementById("email_name").value,
//   "IDcheck",
//   "left=10,top=10,width=200,height=60,scrollbars=no,resizable=yes");
// }
</script>

<div class="gift_main">
  <div class="gift_center_div">
    <div class="main_title">
      <p id="sub_p">Send a Creative Market Gift Card</p>
    </div>
    <div class="payment_list"  id="payment_list" style="display:block">
      <div class="check_money">
        <input type="radio" name="mon" id="mon" value="5000" onclick="fnRadioName();" > 5mon
        <input type="radio" name="mon" id="mon" value="20000" onclick="fnRadioName();" >20mon
        <input type="radio" name="mon" id="mon" value="50000" onclick="fnRadioName();" >50mon
        <input type="radio" name="mon" id="mon" value="100000" onclick="fnRadioName();" >100mon
        <input type="radio" name="mon" id="mon" value="200000" onclick="fnRadioName();" >200mon
        <input type="radio" name="mon" id="mon" value="500000" onclick="fnRadioName();" >500mon
      </div>
      <div class="input_field">
        <input type="text" name="send_id" id="" value="">
        <!--   <input type="button"  onclick="check_id()"name="" value="회원정보 확인"> -->
      </div>
      <div class="input_field">
          <input class="w3-input" type="text" name="send_id" id="email_name" onkeyup="input();"value="" required>
      </div>
      <div class="input_field">
          <input class="w3-input" type="text" id="email_name2" required>
      </div>
      <div class="input_field">
          <textarea name="name" id="send_message"rows="6" cols="40" onkeyup="message();"></textarea>
      </div>
      <button type="button" name="button" onclick=showHide()>asdfsadf</button>
    </div>








<div class="gift_point" id="showHide" style="display:none">
    <button type="button" name="button" onclick=d()>asdfsadf</button>
    <form method="post" name="buy">
        <div class="send_payment">
          <input type="text" name="" value="<?=$username?>">
        </div>
        <div class="send_payment">
          <input type="text" name="" value="<?=$email?>">
        </div>
          <input type="hidden" name="totalPrice" id="money_kaka" value="">
          <input type="hidden" name="name" id="gift_name" value="">
          <input type="hidden" name="message" id="gift_message" value="">
          <input type="submit" name="" value="결제" onclick="check_input()" >
    </form>
</div>
</div>
</div>
