<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";
if(empty($username)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}

  $img_name = "../img/none.gif";

  if(isset($_GET['img_name'])){
    $img_name = $_GET['img_name'];
  }

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/member_profile.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script type="text/javascript" src="../js/monsterform.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      var value="";
      function select(value){
      var text = ""+value;
      document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
      }
      function mouse_over(){
        document.getElementById('change_img').src="../img/up.png";
      }
      function mouse_out(){
        document.getElementById('change_img').src="../img/down.png";
      }
      </script>
    <title></title>
  </head>
  <body>
    <?php
    include "../lib/header_in_folder.php";
     ?>
    <!--============================================================================== -->
    <div id="member_profile">

      <div id="member_profile_menu">
        <ul>
          <li id="title">&nbsp;&nbsp;&nbsp;Edit profile</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=likes">Profile Info</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=collections">Change Password</a></li>
        </ul>
      </div>  <!--end of member_profile_menu -->
      <br><br>
      <div id="member_profile_info">
        <ul>
          <li id="">Profile Info</li>
        </ul>
        <span>Avator:</span>
        <br>
        <div id="profile_image_div">
          <div id="profile_image_div_left">
            <img src="<?=$img_name?>" alt="" width="80px" height="80px">
          </div>
          <div id="profile_image_div_right">
            <label for="profile_image_div_right_file">Update Image</label>
            <input type="file" name="pro_img" id="profile_image_div_right_file" value=""><br><br>
            <span>JPG, GIF, or PNG < 5MB</span>
          </div>
        </div>


      </div> <!--end of member_profile_info -->


    </div> <!--end of member_profile -->
    <div class="clear"></div>


<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
