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

function check_ripple_discussion(){
  var ripple_content = document.getElementById("ripple_content");

  if(ripple_content.value.length===0){
    alert("댓글에 내용이 없네요"); ripple_content.focus(); ripple_content.value="";
    return false;
  }

  document.ripple_form.submit();
}

function big_data_check(){
  $("#big_data").change(function(event){
    $.ajax({
      url: './change_select.php',
      type: 'POST',
      data: {big_data: $("#big_data").val()}
    })
    .done(function(result) {
      console.log("success");
      var json = $.parseJSON(result);
      var output = json[0];
      if(output.ok=='photos'){
        var text = '<select class="" name="small_data"><option value="none">Photos</option><option value="abstract">Abstract</option><option value="animals">Animals</option><option value="arts&entertainment">Arts & Entertainment</option><option value="beauty&fashion">Beauty & Fashion</option><option value="business">Business</option><option value="food&drink">Food & Drink</option><option value="health">Health</option>          <option value="holidays">Holidays</option>          <optionvalue="industrial">Industrial</option>          <option value="nature">Nature</option>          <option value="people">People</option>          <option value="sports">Sports</option>          <option value="technology">Technology</option>          <option value="transportation">Transportation</option>        </select>';
      }else if(output.ok=='graphics'){
        var text = '<select class="" name="small_data">          <option value="none">Graphics</option>          <option value="icons">Icons</option>          <option value="illustrations">Illustrations</option>          <option value="webelements">Web Elements</option>          <option value="objects">Objects</option>          <option value="patterns">Patterns</option>          <option value="textures">Textures</option>        </select>';
      }else if(output.ok=='fonts'){
        var text = '<select class="" name="small_data">            <option value="none">Fonts</option>            <option value="blackletter">Blackletter</option>            <option value="nonwestern">Non Western</option>            <option value="sansserif">Sans Serif</option>            <option value="serif">Serif</option>            <option value="slabserif">Slab Serif</option>            <option value="symbols">Symbols</option>          </select>';
      }else if(output.ok=='none'){
        var text = '<select class="" name="small_data" id="small_data">          <option value="none">kind</option>       </select>';
      }
      $("#small_data_td").html(text);
    })
    .fail(function() {
      console.log("error");
    })
    .always(function() {
      console.log("complete");
    });
  });
}

function check_update_setting() {
  if($("#profession").val() == 'none'){
    alert("Profession을 선택해주세요"); $("#profession_other").focus();
    return false;
  }

  if($("#profession").val() == 'other'){
    if($("#profession_other").val()==''){
      alert("Profession을 입력해주세요"); $("#profession_other").focus();
      return false;
    }
  }

  var result = '';
  if($("#full_time_job").is(":checked")){
    result = result + $("#full_time_job").val() + '/';
  }
  if($("#freelance_work").is(":checked")){
    result = result + $("#freelance_work").val() + '/';
  }
  if($("#part_time_side").is(":checked")){
    result = result + $("#part_time_side").val() + '/';
  }
  if($("#non_profit").is(":checked")){
    result = result + $("#non_profit").val() + '/';
  }
  if($("#school").is(":checked")){
    result = result + $("#school").val() + '/';
  }
  if($("#personal_projects").is(":checked")){
    result = result + $("#personal_projects").val() + '/';
  }

  $("#use_mf").val(result);

  document.profile_update_form.submit();
}

function change_pass_check(){
  if($("#old_password").val()=='' || $("#new_password").val()=='' || $("#veri_password").val()==''){
    alert("빈 곳이 있네요. 확인하세요~");
    return false;
  }

  if($("#old_password").val()!=$("#old_password_con").val()){
    alert("이전 비밀번호가 일치하지 않습니다. 확인하세요~");
    return false;
  }
  if($("#new_password").val()!=$("#veri_password").val()){
    alert("현재 비밀번호가 서로 일치하지 않습니다. 확인하세요~");
    return false;
  }
  var pass = $("#new_password");
  var passPattern = /^(?=.*[a-zA-Z])(?=.*[!@#$%^*+=-])(?=.*[0-9]).{6,14}$/;

  if(!passPattern.test(pass.val())){
    alert("비밀번호 형식이 잘못되었습니다. (숫자+영문+특수문자조합 6~14자)"); pass.focus(); pass.val("");
    return false;
  }

  document.password_change_form.submit();
}

function hwan_mon_check(){
  if(parseInt($("#present_mon").val()) < parseInt($("#hope_mon").val())){
    alert("현재 보유 Mon 보다 적은 Mon만 신청 가능합니다^^");
    return false;
  }

  if(parseInt($("#hope_mon").val())%10 != 0){
    alert("환전신청은 10Mon 단위로만 가능합니다^^");
    return false;
  }

  document.hwan_mon_form.submit();
}
