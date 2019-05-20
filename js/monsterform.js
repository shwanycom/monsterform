function check_id() {
  window.open("check_id.php?mode=id_check&id=" + document.member_form.id.value,
    "IDcheck",
    "left=10,top=10,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_nick() {
  window.open("check_id.php?mode=nick_check&nick=" + document.member_form.nick.value,
    "NICKcheck",
    "left=10,top=10,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_nick_modify() {
  window.open("modify.php?mode=nick_check&nick=" + document.member_form.nick.value,
    "NICKcheck",
    "left=10,top=10,width=200,height=60,scrollbars=no,resizable=yes");
}

function check_input() {
  var id = document.getElementById("id");
  var idPattern = /^[a-zA-Z0-9]{4,12}$/;
  var name = document.getElementById("name");
  var namePattern = /^[가-힣]{2,6}$/;
  var passwd = document.getElementById("pass");
  var passwdPattern = /^[a-zA-Z0-9]{4,15}$/;
  var passwd_confirm = document.getElementById("pass_confirm");
  var passwd_confirmPattern = /^[a-zA-Z0-9]{4,15}$/;
  var phone1 = document.getElementById("hp1");
  var phone2 = document.getElementById("hp2");
  var phone2Pattern = /^[0-9]{3,4}$/;
  var phone3 = document.getElementById("hp3");
  var phone3Pattern = /^[0-9]{3,4}$/;
  var nick = document.getElementById("nick");
  var nickPattern = /^[가-힣a-zA-Z0-9]{2,8}$/;

  //아이디 검증(공백, 패턴)
  if(id.value.length===0){
    alert("아이디가 비어있네요"); id.focus(); id.value="";
    return false;
  }
  if(!idPattern.test(id.value)){
    alert("아이디 형식이 잘못되었습니다."); id.focus(); id.value="";
    return false;
  }
  //비밀번호 검증(공백, 패턴)
  if(passwd.value.length===0){
    alert("비밀번호가 비어있네요"); passwd.focus(); passwd.value="";
    return false;
  }
  if(!passwdPattern.test(passwd.value)){
    alert("비밀번호 형식이 잘못되었습니다."); passwd.focus(); passwd.value="";
    return false;
  }
  //비밀번호 확인 검증(공백, 패턴)
  if(passwd_confirm.value.length===0){
    alert("비밀번호 확인란이 비어있네요"); passwd_confirm.focus(); passwd_confirm.value="";
    return false;
  }
  if(!passwd_confirmPattern.test(passwd_confirm.value)){
    alert("비밀번호 확인 형식이 잘못되었습니다."); passwd_confirm.focus(); passwd_confirm.value="";
    return false;
  }
  if(!(passwd.value == passwd_confirm.value)){
    alert("비밀번호가 서로 일치하지 않습니다."); passwd.focus(); passwd.value=""; passwd_confirm.value="";
    return false;
  }
  //이름 검증(공백, 패턴)
  if(name.value.length===0){
    alert("이름이 비어있네요"); name.focus(); name.value="";
    return false;
  }
  if(!namePattern.test(name.value)){
    alert("이름 형식이 잘못되었습니다."); name.focus(); name.value="";
    return false;
  }
  //닉네임 검증(공백, 패턴)
  if(nick.value.length===0){
    alert("닉네임이 비어있네요"); nick.focus(); nick.value="";
    return false;
  }
  if(!nickPattern.test(nick.value)){
    alert("닉네임 형식이 잘못되었습니다."); nick.focus(); nick.value="";
    return false;
  }
  //휴대전화1 확인 검증(미선택)
  if(phone1.value.length < 3){
    alert("휴대전화 앞자리를 선택하세요."); phone1.focus();
    return false;
  }
  //휴대전화2 검증(공백, 패턴)
  if(phone2.value.length===0){
    alert("휴대전화 중간자리가 비어있네요"); phone2.focus(); phone2.value="";
    return false;
  }
  if(!phone2Pattern.test(phone2.value)){
    alert("휴대전화 형식이 잘못되었습니다."); phone2.focus(); phone2.value="";
    return false;
  }
  //휴대전화3 검증(공백, 패턴)
  if(phone3.value.length===0){
    alert("휴대전화 중간자리가 비어있네요"); phone3.focus(); phone3.value="";
    return false;
  }
  if(!phone3Pattern.test(phone3.value)){
    alert("휴대전화 형식이 잘못되었습니다."); phone3.focus(); phone3.value="";
    return false;
  }
  document.member_form.submit();
}


function reset_form() {
  document.member_form.id.value = "";
  document.member_form.pass.value = "";
  document.member_form.pass_confirm.value = "";
  document.member_form.name.value = "";
  document.member_form.nick.value = "";
  document.member_form.hp1.value = "010";
  document.member_form.hp2.value = "";
  document.member_form.hp3.value = "";
  document.member_form.email1.value = "";
  document.member_form.email2.value = "";

  document.member_form.id.focus();

  return;
}

function check_delete(num){
  var result = confirm("삭제하시겠습니까?\n Either OK or Cancel.");
  if(result){
    window.location.href="./dml_board.php?mode=delete&num="+num;
  }
}

function memberCheck(){
  $("#id").keyup(function(event){
    var id = document.getElementById("id");
    var idPattern = /^[a-zA-Z0-9]{4,12}$/;
    //아이디 검증(공백, 패턴)
    if(id.value.length===0){
      $("#id_span").html("아이디가 비어있네요.");
      $("#id_span").css("color","red");
      return false;
    }
    if(!idPattern.test(id.value)){
      $("#id_span").html("아이디 형식이 잘못되었습니다.");
      $("#id_span").css("color","red");
      return false;
    }
    $.ajax({
      url: './check_id.php?mode=id_ajax',
      type: 'POST',
      data: {id: $("#id").val()}
    })
    .done(function(result) {
      console.log("success");
      var json = $.parseJSON(result);
      var output = json[0].ok;

      if(parseInt(json[1].sign)){
        $("#id_span").html(output);
        $("#id_span").css("color","red");
      }else{
        $("#id_span").html(output);
        $("#id_span").css("color","blue");
      }

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });

  $("#nick").keyup(function(event){
    var nick = document.getElementById("nick");
    var nickPattern = /^[가-힣a-zA-Z0-9]{2,8}$/;
    //닉네임 검증(공백, 패턴)
    if(nick.value.length===0){
      $("#id_span").html("닉네임이 비어있네요.");
      $("#id_span").css("color","red");
      return false;
    }
    if(!nickPattern.test(nick.value)){
      $("#id_span").html("닉네임 형식이 잘못되었습니다.");
      $("#id_span").css("color","red");
      return false;
    }

    $.ajax({
      url: './check_id.php?mode=nick_ajax',
      type: 'POST',
      data: {nick: $("#nick").val()}
    })
    .done(function(result) {
      console.log("success");
      var json = $.parseJSON(result);
      var output = json[0].ok;

      if(parseInt(json[1].sign)){
        $("#nick_span").html(output);
        $("#nick_span").css("color","red");
      }else{
        $("#nick_span").html(output);
        $("#nick_span").css("color","blue");
      }

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });
}

function modifyCheck(){
  $("#nick").keyup(function(event){
    var nick = document.getElementById("nick");
    var nickPattern = /^[가-힣a-zA-Z0-9]{2,8}$/;
    //닉네임 검증(공백, 패턴)
    if(nick.value.length===0){
      $("#id_span").html("닉네임이 비어있네요.");
      $("#id_span").css("color","red");
      return false;
    }
    if(!nickPattern.test(nick.value)){
      $("#id_span").html("닉네임 형식이 잘못되었습니다.");
      $("#id_span").css("color","red");
      return false;
    }

    $.ajax({
      url: './modify.php?mode=nick_ajax',
      type: 'POST',
      data: {nick: $("#nick").val()}
    })
    .done(function(result) {
      console.log("success");
      console.log(result);

      var json = $.parseJSON(result);
      var output = json[0].ok;

      if(parseInt(json[1].sign)){
        $("#nick_span").html(output);
        $("#nick_span").css("color","red");
      }else{
        $("#nick_span").html(output);
        $("#nick_span").css("color","blue");
      }

    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });
}

function check_write_discussion(){
  var cate = document.getElementById("write_topic");
  var write_subject = document.getElementById("write_subject");
  var write_content = document.getElementById("write_content");

  if(cate.value == 'none'){
    alert("카테고리를 선택하세요."); cate.focus();
    return false;
  }

  if(write_subject.value.length===0){
    alert("제목이 비어있네요"); write_subject.focus(); write_subject.value="";
    return false;
  }

  if(write_content.value.length===0){
    alert("본문이 비어있네요"); write_content.focus(); write_content.value="";
    return false;
  }

  document.discussion_write_form.submit();
}
