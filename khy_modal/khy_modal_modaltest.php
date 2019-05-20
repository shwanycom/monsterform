<!DOCTYPE html>
<html>
<head>
  <!-- google api -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
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
  gauth.disconnect();
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
        <img id="left_img" width="100%" height="100%" src="./img/signin.png" alt="">
      </div>
      <div class="div_float" id="div_mem">
        <table>
          <tr>
            <td colspan="3">Creat Your Free Account <span class="close">&times;</span>
            <hr size="1" width="320"></td>
          </tr>
          <tr class="gklogin_btn">
              <td colspan="3">
                <form id="gklogin_form" action="./khy_modal/khy_modal_dml.php" method="post">
                  <input type="hidden" id="email" name="email" >
                  <input type="hidden" id="username" name="username">
                <button type="button" id="gloginBtn" onclick="google_login();">Google로 로그인</button><br><br>
                <button type="button" id="kloginBtn" onclick="kakao_login();"/>카카오로 로그인</button>
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
              <form class="member_info" action="./khy_modal/not_social.php?mode=join" method="post">
                <!-- <input type="hidden" name="member_firstname" value="" placeholder="First name" id="first_name" size="20">
                <input type="hidden" name="member_lastname" value="" placeholder="Last name" id="last_name" size="20"> -->
                <input type="hidden" name="member_email_address" value="" placeholder="Email Address" id="email_address" size="46">
                <input type="hidden" name="member_username" value="" placeholder="Username" id="member_username" size="46">
                <input type="hidden" name="member_password" value="" placeholder="Password" id="member_password" size="46">
                <input type="hidden" name="member_password_confirm" value="" placeholder="Password Confirm" id="member_password_confirm" size="46">
                <input type="hidden" id="signup_btn" value="Sign up" style="float : right">
              </form>

              <form class="login_info" name="login_info" action="./khy_modal/not_social.php?mode=login" method="post">
                <input type="hidden" name="login_email" value="" placeholder="Email Address" id="username2" size="46">
                <input type="hidden" name="login_password" value="" placeholder="Password" id="password2" size="46">
                <input type="hidden" id="login" value="Log in!" style="float : right">
              </form>
              <input type="button" name="button" id="email_btn" value="Continue with E-mail" onclick="memform()">
              <br><br>
              <span id="by_span">By creating an account, you agree to our terms and privacy policy.<span>
            </td>
          </tr>
          <tr>
            <td colspan="2" id="last_td">Already have an account?</td><td><input type="button" id="sign" value="Sign in!" onclick="sign_man()"></td>
          </tr>
        </table>
    </div>
    <!-- <p>Some text in the Modal..</p> -->
  </div>

</div>


<script>

var flag = true;

// var first_name = document.getElementById("first_name");
// var last_name = document.getElementById("last_name");
var email_address = document.getElementById("email_address");
var username = document.getElementById("member_username");
var username2 = document.getElementById("username2");
var password = document.getElementById("member_password");
var password_confirm = document.getElementById("member_password_confirm");
var password2 = document.getElementById("password2");
var login = document.getElementById("login");

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

// When the user clicks the button, open the modal
btn.onclick = function() {
  modal.style.display = "block";
  flag = false;
  sign_man();
  init();
  memberCheck();
}

btn2.onclick = function(){
  modal.style.display = "block";
  flag = true;
  sign_man();
  init();
  memberCheck();
}

// btn3.onclick = function(){
//   google_logout();
//   kakao_logout();
// }

function memform(){
  // first_name.setAttribute("type","text");
  // last_name.setAttribute("type","text");
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
  signup_btn.setAttribute("type","submit");
  signup_btn.style.display = "block";
  signup_btn.style.margin = "10px 15px";
  mem_btn.setAttribute("type","hidden");
}

function sign_man(){
  var sign = document.getElementById("sign");
  var left_img = document.getElementById("left_img");
  if(flag){
    sign.value = "Sign up!";
    left_img.src = "./img/signup.png";
    // first_name.setAttribute("type","hidden");
    // last_name.setAttribute("type","hidden");
    email_address.setAttribute("type","hidden");
    username.setAttribute("type","hidden");
    password.setAttribute("type","hidden");
    password_confirm.setAttribute("type","hidden");
    username2.setAttribute("type","text");
    password2.setAttribute("type","password");
    password2.style.display = "block";
    password2.style.margin = "10px 15px";
    login.setAttribute("type","submit");
    login.style.display = "block";
    login.style.margin = "10px 15px";
    last_td.innerText = "New to Monster Form?";
    by_span.innerText = "";
    mem_btn.setAttribute("type","hidden");
    signup_btn.setAttribute("type","hidden");
    flag=false;
  }else{
    sign.value="Sign in!";
    left_img.src = "./img/signin.png";
    username2.setAttribute("type","hidden");
    password2.setAttribute("type","hidden");
    // first_name.setAttribute("type","hidden");
    // last_name.setAttribute("type","hidden");
    email_address.setAttribute("type","hidden");
    username.setAttribute("type","hidden");
    password.setAttribute("type","hidden");
    password_confirm.setAttribute("type","hidden");
    login.setAttribute("type","hidden");
    last_td.innerText = "Already have an account?";
    by_span.innerText = "By creating an account, you agree to our terms and privacy policy.";
    mem_btn.setAttribute("type","button");
    signup_btn.setAttribute("type","hidden");
    flag=true;
  }
  modal.style.display = "block";
}

function memberCheck(){
  $("#email_address").blur(function(event){
    // var id = document.getElementById("id");
    var emailPattern = /([\w-\.]+)@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.)|(([\w-]+\.)+))([a-zA-Z]{2,4}|[0-9]{1,3})(\]?)$/;
    if(email_address.value.length===0){
      console.log("이메일이 비어있음");
      $("#email_address").css("border","2px solid #ff948a");
      return false;
    }
    if(!emailPattern.test(email_address.value)){
      console.log("이메일 형식이 잘못되었습니다.");
      $("#email_address").css("border","2px solid #ff948a");
      return false;
    }
    $.ajax({
      url: './not_social.php?mode=email_ajax',
      type: 'POST',
      data: {id: $("#email_address").val()}
    })
    .done(function(result) {
      console.log("success");
      var json = $.parseJSON(result);
      var output = json[0].ok;

      if(parseInt(json[1].sign)){
        $("#email_address").css("border","2px solid #ff948a");
      }else{
        $("#email_address").css("border","2px solid #ff948a");
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

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>

</body>
</html>
