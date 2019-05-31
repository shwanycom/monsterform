<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Insert title here</title>
<script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js" ></script>
<script type="text/javascript" src="https://cdn.iamport.kr/js/iamport.payment-1.1.5.js"></script>

</head>
<body>

<?php
if(isset($_GET['price'])){
    $totalPrice=$_GET['price'];
}

if(isset($_GET['payname'])){
    $name=$_GET['payname'];
}
if(isset($_GET['paymessage'])){
    $message=$_GET['paymessage'];
}
 ?>

  <script type="text/javascript">
  	IMP.init('imp80551079'); //아이디 만들었음
    IMP.request_pay({
    pg : 'kakaopay',
    pay_method : 'card',
    merchant_uid : 'merchant_' + new Date().getTime(),
    name : 'Monsterform:결제',
    amount : <?=$totalPrice?>,
    buyer_email : 'iamport@siot.do',
    buyer_name : '이동현',
    buyer_tel : '12515',
    buyer_addr : '서울특별시 강남구 삼성동',
    buyer_postcode : '123-456'
}, function(rsp) {
    if ( rsp.success ) {
    	$.ajax({

    	}).done(function(data) {

    		if ( everythings_fine ) {
    			var msg = '결제가 완료되었습니다.';
    			msg += '\n고유ID : ' + rsp.imp_uid;
    			msg += '\n상점 거래ID : ' + rsp.merchant_uid;
    			msg += '\결제 금액 : ' + rsp.paid_amount;
    			msg += '카드 승인번호 : ' + rsp.apply_num;
    			alert(msg);
          alert(rsp.paid_amount);
    		} else {
    			//[3] 아직 제대로 결제가 되지 않았습니다.
    			//[4] 결제된 금액이 요청한 금액과 달라 결제를 자동취소처리하였습니다.
    		}
    	});
      location.href="gift_query.php?mode=update&price=<?=$totalPrice?>&reemail=<?=$name?>&message=<?=$message?>";

    } else {
        var msg = '결제에 실패하였습니다.';
        msg += '에러내용 : ' + rsp.error_msg;
        location.href="gift_view.php";

        alert(msg);

    }
       // location.href="point_query.php?mode=update&price=";
});
  </script>

</body>
</html>
