<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<meta charset="utf-8">
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
  $("#find_btn_passwd").click(function(event) {
    var email = document.getElementById("email").value;
    var find_span = document.getElementById("find_span");
    if (email.length === 0) {
      find_span.innerHTML="이메일을 입력해주세요";
      return false;
    }
    $.ajax({
      url: '../PHPmailer/email.php',
      type: 'POST',
      data: {'email':email}
    })
    .done(function(result) {
      console.log(result);
      var json_obj = $.parseJSON(result);
      if(json_obj[0].passwd=="실패1"){
        find_span.style.color="red";
        find_span.innerHTML="<p>비밀번호 조회 결과<br><br>가입 되지 않은 이메일 입니다.<br></p>";
      }else if(json_obj[0].passwd=="실패2") {
        find_span.style.color="red";
        find_span.innerHTML="<p>비밀번호 조회 결과<br><br>소셜로그인으로 시도하세요!</p>";
      }else{
      find_span.style.color="rgb(4, 21, 101)";
      find_span.innerHTML="<p>비밀번호 조회 결과<br><br>임시비밀번호를 이메일로 발송했습니다.<br><br>로그인후 비밀번호 수정하세요.</p>";
      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });
});
</script>
</head>
  <body>
    <div style="text-align : center; vertical-align: middle;  margin-top:10%;">
      <input type="text" name="" value="" id="email">
      <button type="button" name="button" id="find_btn_passwd">send to email</button>
      <span id="find_span"></span>
    </div>

  </body>
</html>
