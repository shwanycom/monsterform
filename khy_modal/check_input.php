<script>
//========================================== email ajax =================================================
$("#email_address").blur(function(event){
  var emailPattern = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if(email_address.value.length===0){
    $("#email_address").css("border","2px solid #ff948a");
    $("#email_address").attr("title","이메일을 입력하십시오");
    return false;
  }else if(!emailPattern.test(email_address.value)){
   $("#email_address").css("border","2px solid #ff948a");
   $("#email_address").attr("title","이메일 형식이 잘못되었습니다");
   return false;
  }else{
    $.ajax({
      url: './khy_modal/not_social.php?mode=email_ajax',
      type: 'POST',
      data: {email: $("#email_address").val()}
    })
    .done(function(result) {
      console.log("success");
      var json = $.parseJSON(result);
      console.log(json[0].ok);
      console.log(json[1].sign);
      if(parseInt(json[1].sign)){
        $("#email_address").css("border","2px solid #ff948a");
        $("#email_address").attr("title","중복된 이메일입니다");
        return false;
      }else{
        $("#email_address").css("border","2px solid #cfcfcf");
        $("#email_address").attr("title","사용 가능한 이메일 입니다");

      }
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  }
});

function check_input(){
  var emailPattern_pattern = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
  if(email_address.value.length===0){
    $("#email_address").css("border","2px solid #ff948a");
    $("#email_address").attr("title","이메일을 입력하십시오");
    return false;
  }else if(!emailPattern_pattern.test(email_address.value)){
    $("#email_address").css("border","2px solid #ff948a");
    $("#email_address").attr("title","이메일 형식이 잘못되었습니다");
    return false;
  }else{
    $("#email_address").css("border","2px solid #cfcfcf");
    $("#email_address").attr("title","사용 가능한 이메일 입니다");
  }

  var username_pattern = /^[a-zA-Z0-9가-힣]{2,12}$/;
  if(username.value.length===0){
    $("#member_username").css("border","2px solid #ff948a");
    $("#member_username").attr("title","닉네임이 비어있네요");
    return false;
  }else if(!username_pattern.test(username.value)){
    $("#member_username").css("border","2px solid #ff948a");
    $("#member_username").attr("title","사용할 수 없는 닉네임 입니다");
    return false;
  }else{
    $("#member_username").css("border","2px solid #cfcfcf");
    $("#member_username").attr("title","사용 가능한 닉네임 입니다");
  }
  var password_pattern = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,14}$/;
  if(password.value.length===0){
    $("#member_password").css("border","2px solid #ff948a");
    $("#member_password").attr("title","비밀번호를 입력해주세요");
    return false;
  }else if(!password_pattern.test(password.value)){
    $("#member_password").css("border","2px solid #ff948a");
    $("#member_password").attr("title","비밀번호는 영문+숫자+특수문자조합 6~14자입니다.");
    return false;
  }else{
    $("#member_password").css("border","2px solid #cfcfcf");
    $("#member_password").attr("title","사용 가능한 비밀번호 입니다");
  }

  if(password_confirm.value.length===0){
    $("#member_password_confirm").css("border","2px solid #ff948a");
    $("#member_password_confirm").attr("title","비밀번호를 확인해주세요");
    return false;
  }else if(password_confirm.value!==password.value){
    $("#member_password_confirm").css("border","2px solid #ff948a");
    $("#member_password_confirm").attr("title","비밀번호가 맞지 않습니다");
    return false;
  }else{
    $("#member_password_confirm").css("border","2px solid #cfcfcf");
    $("#member_password_confirm").attr("title","비밀번호가 확인되었습니다");
  }

  $("#member_info").submit();
}

function reset_member_form(){
  $("#email_address").css("border","2px solid #cfcfcf");
  $("#email_address").val("");
  $("#member_username").css("border","2px solid #cfcfcf");
  $("#member_username").val("");
  $("#member_password").css("border","2px solid #cfcfcf");
  $("#member_password").val("");
  $("#member_password_confirm").css("border","2px solid #cfcfcf");
  $("#member_password_confirm").val("");
}

function check_login(){
  //========================================== login ajax =================================================
    if(username2.value.length===0){
      $("#username2").css("border","2px solid #ff948a");
      $("#username2").attr("title","이메일을 입력하십시오");
      return false;
    }else{
      $.ajax({
        url: './khy_modal/not_social.php?mode=email_ajax',
        type: 'POST',
        data: {email: $("#username2").val()}
      })
      .done(function(result) {
        console.log("success");
        var json = $.parseJSON(result);
        console.log(json[0].ok);
        console.log(json[1].sign);
        if(parseInt(json[1].sign)){
          $("#username2").css("border","2px solid #cfcfcf");
          $("#username2").attr("title","가입된 이메일 입니다");
        }else{
          $("#username2").css("border","2px solid #ff948a");
          $("#username2").attr("title","가입되지 않은 이메일 입니다");
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
  //========================================== password2 ajax =================================================
    if(password2.value.length===0){
      $("#password2").css("border","2px solid #ff948a");
      $("#password2").attr("title","비밀번호를 입력하십시오");
      return false;
    }else{
      $.ajax({
        url: './khy_modal/not_social.php?mode=pw_ajax',
        type: 'POST',
        data: {email: $("#username2").val(),password: $("#password2").val()}
      })
      .done(function(result) {
        console.log("success");
        var json = $.parseJSON(result);
        console.log(json[0].ok);
        console.log(json[1].sign);
        if(parseInt(json[1].sign)){
          $("#password2").css("border","2px solid #cfcfcf");
          $("#password2").attr("title","아이디와 비밀번호가 일치합니다");
          $("#login_info").submit();
        }else{
          $("#password2").css("border","2px solid #ff948a");
          $("#password2").attr("title","아이디와 비밀번호가 일치하지 않습니다");
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }
}

function reset_login_form(){
  $("#username2").css("border","2px solid #cfcfcf");
  $("#username2").val("");
  $("#password2").css("border","2px solid #cfcfcf");
  $("#password2").val("");
}

</script>
