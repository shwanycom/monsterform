<!DOCTYPE html>
<html>
<head>
  <!-- google api -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://apis.google.com/js/platform.js" async defer></script>

<!-- kakao api -->
<script src="//developers.kakao.com/sdk/js/kakao.min.js"></script>

<!-- init -->
<script>
window.gauth ="";
function init(){
  console.log('init');
  gapi.load('auth2', function() {
    console.log('auth2');
    //window로 사용하면서 전역변수로 선언
    window.gauth = gapi.auth2.init({
      client_id:'1080320778777-ek18ne6sdkqhvl39fj5vas0oicf7pc6j.apps.googleusercontent.com'
    });
    gauth.then(function(){
      console.log('googleAuth success');
    }, function(){
      console.log('googleAuth fail');
    });
  });
  Kakao.init('691e275903af0fd875572a4f90438fc1');
}
</script><!-- end of init -->

<!-- google login script -->
<script >
function google_login(){
  gauth.signIn().then(function(){
    console.log('gauth.signIn()');
    sendToDml("google");
  });
}
</script><!-- end of google login script -->

<!-- kakao login script -->
<script>
function kakao_login() {
  Kakao.Auth.loginForm({
    success: function(authObj) {
      sendToDml("kakao");
    },
    fail: function(err) {
      alert(JSON.stringify(err));
    }
  });
}
</script>
<!-- end of kakao login script -->

<script>
function sendToDml(type){
  if(type=="google"){
    console.log("보내자");
    if(gauth.isSignedIn.get()){
      profile = gauth.currentUser.get().getBasicProfile(); //프로필 정보를 가져온다.
      document.getElementById("email").value=profile.getEmail();
      document.getElementById("username").value=profile.getName();
      document.getElementById("gklogin_form").submit();
      gauth.disconnect();
    }
  }
  if (type=="kakao") {
    Kakao.API.request({
       url: '/v1/user/me',
       success: function(res) {
         document.getElementById("email").value=res.kaccount_email;
         document.getElementById("username").value=res.properties.nickname;
         document.getElementById("gklogin_form").submit();
       },
       fail: function(error) {
          console.log(error);
       }
    });
  }
}
</script>

</head>

<body>

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="">
      <div class="div_float">
        <img id="left_img" width="100%" height="100%" src="../img/signin.png" alt="">
      </div>
      <div class="div_float" id="div_mem">
        <table>
          <tr>
            <td colspan="3">Creat Your Free Account <span class="close">&times;</span>
            <hr size="1" width="320"></td>
          </tr>
          <tr class="gklogin_btn">
              <td colspan="3">
                <form id="gklogin_form" action="../khy_modal/khy_modal_dml.php" method="post">
                  <input type="hidden" id="email" name="email" >
                  <input type="hidden" id="username" name="username">
                <button type="button" id="gloginBtn" class="modal_text" onclick="google_login();"></button><br><br>
                <button type="button" id="kloginBtn" class="modal_text" onclick="kakao_login();"/></button>
              </form>
              </td>
          </tr>
          <tr>
            <td colspan="3">
              <hr size="1" width="150"> OR <hr size="1" width="150">

              <!-- <img width="100%" src="./img/or.png" alt=""> -->
            </td>
          </tr>
          <tr>
            <td colspan="3">
              <form class="member_info" id="member_info" action="../khy_modal/not_social.php?mode=join" method="post">
                <input type="hidden" class="modal_text" name="member_email_address"  placeholder="Email Address" id="email_address">
                <input type="hidden" class="modal_text" name="member_username"  placeholder="Username" id="member_username" >
                <input type="hidden" class="modal_text" name="member_password"  placeholder="Password" id="member_password" >
                <input type="hidden" class="modal_text" name="member_password_confirm"  placeholder="Password Confirm" id="member_password_confirm" >
                <input type="hidden" class="modal_btn" id="signup_btn" value="Sign up">
              </form>

              <form class="login_info" id="login_info" name="login_info" action="../khy_modal/not_social.php?mode=login" method="post">
                <input type="hidden" class="modal_text" name="login_email" placeholder="Email Address" id="username2" >
                <input type="hidden" class="modal_text" name="login_password" placeholder="Password" id="password2" >
                <input type="hidden" class="modal_btn" id="login" value="Log in!">
                <input type="hidden" class="modal_text" id="forget_pw" value="forgot?">
              </form>
              <input type="button" class="modal_btn" name="button" id="email_btn" value="Continue with E-mail" onclick="memform()" >
              <br>
              <span id="by_span">By creating an account, you agree to our terms and privacy policy.<span>
            </td>
          </tr>
          <tr id="last_tr">
            <td colspan="2" id="last_td">Already have an account?</td><td><input type="button" id="sign" value="Sign in!" onclick="sign_man()"></td>
          </tr>
        </table>
    </div>
    <!-- <p>Some text in the Modal..</p> -->
  </div>
</div>
</div>
<script>
var flag = true;
var gloginBtn = document.getElementById("gloginBtn");
var email_address = document.getElementById("email_address");
var username = document.getElementById("member_username");
var username2 = document.getElementById("username2");
var password = document.getElementById("member_password");
var password_confirm = document.getElementById("member_password_confirm");
var password2 = document.getElementById("password2");
var login = document.getElementById("login");
var forget_pw = document.getElementById("forget_pw");

var last_td = document.getElementById("last_td")
var by_span = document.getElementById("by_span")

var mem_btn = document.getElementById("email_btn");
var signup_btn = document.getElementById("signup_btn");


var div_mem = document.getElementById("div_mem");
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");
var btn2 = document.getElementById("myBtn2");
var btn3 = document.getElementById("myBtn3");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];
</script>

<?php  include $_SERVER["DOCUMENT_ROOT"]."./monsterform/khy_modal/check_input_in_folder.php"; ?>

<script>
// When the user clicks the button, open the modal
if(btn){
  btn.onclick = function() {
    modal.style.display = "block";
    flag = false;
    sign_man();
    init();
  }
  btn2.onclick = function(){
    modal.style.display = "block";
    flag = true;
    sign_man();
    init();
  }
  signup_btn.onclick = function(){
    check_input();
  }
  login.onclick = function(){
    check_login();
  }
  forget_pw.onclick = function(){
    window.open("../khy_modal/find_pw.php", "_blank", "toolbar=no,menubar=no,location=no,status=no,scrollbars=yes,resizable=no,channelmode=yes,top=200,left=200,width=700,height=300");
  }
}


function memform(){
  email_address.setAttribute("type","email");
  email_address.style.display = "block";
  email_address.style.margin = "10px 15px";
  username.setAttribute("type","text");
  username.style.display = "block";
  username.style.margin = "10px 15px";
  password.setAttribute("type","password");
  password.style.display = "block";
  password.style.margin = "10px 15px";
  password_confirm.setAttribute("type","password");
  password_confirm.style.display = "block";
  password_confirm.style.margin = "10px 15px";
  signup_btn.setAttribute("type","button");
  signup_btn.style.display = "block";
  signup_btn.style.margin = "10px 15px";
  mem_btn.setAttribute("type","hidden");
}

function sign_man(){
  var sign = document.getElementById("sign");
  var left_img = document.getElementById("left_img");
  if(flag){
    //로그인모드
    $("#gloginBtn").html("Sign in using Google");
    $("#kloginBtn").html("Sign in using Kakao");
    sign.value = "Sign up!";
    left_img.src = "../img/signup.png";
    email_address.setAttribute("type","hidden");
    username.setAttribute("type","hidden");
    password.setAttribute("type","hidden");
    password_confirm.setAttribute("type","hidden");
    username2.setAttribute("type","text");
    password2.setAttribute("type","password");
    password2.style.display = "block";
    password2.style.margin = "10px 15px";
    login.setAttribute("type","button");
    login.style.display = "block";
    login.style.margin = "10px 15px";
    forget_pw.setAttribute("type","button");
    forget_pw.style.display = "block";
    forget_pw.style.margin = "10px 15px";
    last_td.innerText = "New to Monster Form?";
    by_span.innerText = "";
    mem_btn.setAttribute("type","hidden");
    signup_btn.setAttribute("type","hidden");
    reset_member_form();
    flag=false;
  }else{
    //회원가입모드
    $("#gloginBtn").html("Sign up using Google");
    $("#kloginBtn").html("Sign up using Kakao");
    sign.value="Sign in!";
    left_img.src = "../img/signin.png";
    username2.setAttribute("type","hidden");
    password2.setAttribute("type","hidden");
    email_address.setAttribute("type","hidden");
    username.setAttribute("type","hidden");
    password.setAttribute("type","hidden");
    password_confirm.setAttribute("type","hidden");
    login.setAttribute("type","hidden");
    forget_pw.setAttribute("type","hidden");
    last_td.innerText = "Already have an account?";
    by_span.innerText = "By creating an account, you agree to our terms and privacy policy.";
    mem_btn.setAttribute("type","button");
    signup_btn.setAttribute("type","hidden");
    reset_member_form();
    flag=true;
  }
  modal.style.display = "block";
}

function auto_modal(){
  modal.style.display = "block";
  sign_man();
  init();
  span.onclick = function() {
    document.location.href="../index.php";
  }
  window.onclick = function(event) {
    if (event.target == modal) {
      reset_member_form();
      reset_login_form();
      modal.style.display = "block";
    }
  }
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  reset_member_form();
  reset_login_form();
  modal.style.display = "none";
}
// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    reset_member_form();
    reset_login_form();
    modal.style.display = "none";
  }
}

</script>
</body>
</html>
