<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

// if(!isset($_SESSION['email'])){
//   echo "<script> alert('회원만 이용 가능 합니다.'); history.go(-1); </script>";
//   exit;
// }


if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $point1 = $_SESSION['mon'];
  $username = $_SESSION['username'];
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/gift.css?">

    <script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript">
    function fnRadioName(){
        var mon = $('input[name="mon"]:checked').val();
        document.getElementById('money_kaka').value = mon;
        document.getElementById("select_price").innerHTML = mon;
    }

    // function check_input1(){
    //     document.buy.action="./payment.php";
    //     document.buy.submit();
    // }

    function input(){
        var input = document.getElementById("email_name").value;
        document.getElementById('gift_name').value = input;
    }

    function message(){
        var input = document.getElementById("send_message").value;
        document.getElementById('gift_message').value = input;
    }

    $(function(){
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

    function showHide(){
      var rec_name=document.getElementById("name_input");
      var rec_email1= document.getElementById("email_name");
      var rec_email2=document.getElementById("email_name2");
      var rec_message=document.getElementById("send_message");
      var emailPattern = /^\w+@[a-zA-Z_]+?\.[a-zA-Z]{2,3}$/;
      if(rec_name.value.length===0){
          alert("받는분의 성함을 적어주세요"); rec_name.focus(); rec_name.value="";
          return false;
      }
      if(rec_email1.value.length===0){
          alert("받는분의 이메일을 작성해주세요"); rec_email1.focus(); rec_email1.value="";
          return false;
      }else if (!emailPattern.test(rec_email1.value)){
          alert("이메일 형식이 잘못 되었습니다.");
          rec_email1.focus();
          rec_email1.value = "";
          return false;
      }

      if(rec_email2.value.length===0){
          alert(" 받는분의 이메일을 작성해주세요"); emailPattern.focus(); emailPattern.value="";
           return false;
      }
      if(document.getElementById("payment_list").style.display =="block"){
          document.getElementById("showHide").style.display ='block';
          document.getElementById("payment_list").style.display ='none';
      }
    }

    function showd(){
        if(document.getElementById("showHide").style.display =="block"){
          document.getElementById("showHide").style.display ='none';
          document.getElementById("payment_list").style.display ='block';
        }

    }

    </script>
  </head>
  <body>
    <?php include "../lib/header_in_folder.php";?>
    <div class="gift_main">
      <div class="gift_center_div">
        <div class="main_title">
          <p id="sub_p">Send a MonsterForm Gift Card</p>
        </div>
        <div class="payment_list"  id="payment_list" style="display:block">
          <b>Gift Card Amount</b>
          <div class="check_money">
            <input type="radio" name="mon" id="mon" value="20000" onclick="fnRadioName();" ><span class="amount_span"> ￦20000 </span>
            <input type="radio" name="mon" id="mon" value="50000" onclick="fnRadioName();" checked><span class="amount_span"> ￦50000 </span>
            <input type="radio" name="mon" id="mon" value="100000" onclick="fnRadioName();" ><span class="amount_span"> ￦100000 </span>
          </div>
          <div class="input_size_div">
            <div class="input_field">
              <input type="text" class="text_input" name="rece_id" id="name_input" value="" placeholder="Recipient’s Name"  novalidate required>
            </div>
            <div class="input_field">
                <input class="text_input" type="text" name="send_id" id="email_name" onkeyup="input();" placeholder="Recipient’s Email Address"required>
            </div>
            <div class="input_field">
                <input class="text_input" type="text" id="email_name2" name="send_id2" placeholder="Confirm Recipient’s Email Address" required>
            </div>
            <div class="input_field">
                <textarea name="send_message" id="send_message"rows="6" cols="40" onkeyup="message();" placeholder="Add a note..." required></textarea>
            </div>
            <button type="submit" name="button" onclick="showHide()" id="btn_amount">continue →</button>
          </div>
        </div>
        <div class="gift_point" id="showHide" style="display:none">
          <div class="btn_div">
            <button type="button" name="button" id="btn_back"onclick=showd()>←Back</button>
            <b style="font-size:12px;">Amount : ￦</b><span id="select_price" style="font-size:12px;">50000</span>
          </div>
            <form method="post" name="buy" action="./email_check.php">
              <div class="send_payment">
                <input type="text" id="send_username" class="text_input" value="<?=$username?>">
              </div>
              <div class="send_payment">
                <input type="text" name="" id="send_email" class="text_input" value="<?=$email?>">
              </div>
                <input type="hidden" name="totalPrice" id="money_kaka" value="50000">
                <input type="hidden" name="name" id="gift_name" value="">
                <input type="hidden" name="message" id="gift_message" value="">
                <input type="submit" id="btn_amount" value="결제"onclick="check_input1()">
                <!--   -->
            </form>
        </div>
      </div>
    </div><br><br>
    <?php
    include "../lib/footer_in_folder.php";
    include "../khy_modal/login_modal_in_folder.php";
    if(!isset($_SESSION['no'])) {
      ?>
      <script>
        auto_modal();
      </script>
      <?php
    }
    ?>
  </body>
</html>
