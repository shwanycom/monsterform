<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";


if(!isset($member_no)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}else{
  $profile_info_bold = '';
  $change_password_bold = '';

  if(isset($_GET['mode']) && $_GET['mode']=='profile_info'){
    $sql = "SELECT * from `member` where no = $member_no;";
    $profile_info_bold = 'style = "font-size:25px"';
    $mode = 'profile_info';
  }else if(isset($_GET['mode']) && $_GET['mode']=='change_password'){
    $sql = "SELECT * from `member` where no = $member_no;";
    $change_password_bold = 'style = "font-size:25px"';
    $mode = 'change_password';
  }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $img_name = $row['pro_img_copied'];
    $user_no = $row['no'];
    $user_email = $row['email'];
    $user_username = $row['username'];
    $user_password = $row['password'];
    if($user_password==null){
      echo '<script>
      alert("소셜로그인시 비밀번호 변경은 불가합니다."); history.go(-1); </script>';
      exit;
    }
    $user_location = $row['location'];
    $user_profession = $row['profession'];

    $user_use_mf = $row['use_mf'];
    $user_use_mf_ex = explode('/', $user_use_mf);

    $checked1 = '';
    $checked2 = '';
    $checked3 = '';
    $checked4 = '';
    $checked5 = '';
    $checked6 = '';

    for($i=0;$i<6;$i++){
      if(isset($user_use_mf_ex[$i])){
        switch ($user_use_mf_ex[$i]) {
          case 'full_time_job':
            $checked1 = 'checked';
          break;
          case 'freelance_work':
            $checked2 = 'checked';
          break;
          case 'part_time_side':
            $checked3 = 'checked';
          break;
          case 'non_profit':
            $checked4 = 'checked';
          break;
          case 'school':
            $checked5 = 'checked';
          break;
          case 'personal_projects':
            $checked6 = 'checked';
          break;
          default:
          break;
        }
      }
    }

    $selected = '';

    if($user_profession!=''){
      switch ($user_profession) {
        case 'freelancer/owner':
          $selected1 = 'selected';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'graphic/branddesigner':
          $selected1 = '';
          $selected2 = 'selected';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'illustrator':
          $selected1 = '';
          $selected2 = '';
          $selected3 = 'selected';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'manager':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = 'selected';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'marketing/socailmedia':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = 'selected';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'photographer':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = 'selected';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'uxdesigner/researcher':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = 'selected';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'videoproduction':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = 'selected';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'visual/uidesigner':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = 'selected';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'webdeveloper':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = 'selected';
          $selected11 = '';
          break;
        case 'freelancer/owner':
          $selected1 = 'selected';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = '';
          break;
        case 'other':
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = 'selected';
          break;
        default:
          $selected1 = '';
          $selected2 = '';
          $selected3 = '';
          $selected4 = '';
          $selected5 = '';
          $selected6 = '';
          $selected7 = '';
          $selected8 = '';
          $selected9 = '';
          $selected10 = '';
          $selected11 = 'selected';
          break;
      }
    }else{
      $selected = 'selected';
      $selected1 = '';
      $selected2 = '';
      $selected3 = '';
      $selected4 = '';
      $selected5 = '';
      $selected6 = '';
      $selected7 = '';
      $selected8 = '';
      $selected9 = '';
      $selected10 = '';
      $selected11 = '';
    }

    if($img_name==''){
      $img_name = "../data/img/none.gif";
    }else{
      $img_name = "../data/img/".$img_name;
    }

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

      function readURL(input){
        if (input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#img_view').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $(document).ready(function() {
        $("#profile_image_div_right_file").change(function(){
          readURL(this);
        });

        $("#profession").change(function(event) {
          if($("#profession").val()=='other'){
            $("#profession_other").attr('type', 'text');
          }else{
            $("#profession_other").attr('type', 'hidden');
          }
        });

      });


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
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_edit.php?mode=profile_info" <?=$profile_info_bold?>>Profile Info</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_edit.php?mode=change_password" <?=$change_password_bold?>>Change Password</a></li>
        </ul>
      </div>  <!--end of member_profile_menu -->
      <br><br>
      <?php
      if(isset($_GET['mode']) && $_GET['mode']=='profile_info'){
      ?>
      <div id="member_profile_info">
        <form name="profile_update_form" action="../khy_modal/not_social.php?mode=update" method="post" enctype="multipart/form-data">
        <ul>
          <li id="">Profile Info</li>
        </ul>
        <span>Avator:</span>
        <br>
        <div id="profile_image_div">
          <div id="profile_image_div_left">
            <img src="<?=$img_name?>" alt="" width="80px" height="80px" id="img_view">
          </div>
          <div id="profile_image_div_right">
            <label for="profile_image_div_right_file">Update Image</label>
            <input type="file" name="profile_image_div_right_file" id="profile_image_div_right_file" value="">
            <br><br>
            <span>JPG, GIF, or PNG < 5MB</span>
          </div>
        </div>
        <div class="clear"></div>
        <div class="user_info_div">
            <span class="user_info_span">Username</span>
            <br>
            <input type="text" name="username"  id="username" value="<?=$user_username?>">
            <br><br>
            <span class="user_info_span">Email Address</span>
            <br>
            <input type="text" name="email" id="email" value="<?=$user_email?>" readonly>
            <br><br>
            <span class="user_info_span">Location</span>
            <br>
            <input type="text" name="location" id="location" value="<?=$user_location?>" placeholder="City, State/Region, Country">
            <br><br>
            <span class="user_info_span">Profession</span>
            <br>
            <select class="" id="profession" name="profession">
              <option value="none" <?=$selected?>>Please Select</option>
              <option value="freelancer/owner" <?=$selected1?>>Freelancer/Owner</option>
              <option value="graphic/branddesigner" <?=$selected2?>>Graphic/Brand Designer</option>
              <option value="illustrator" <?=$selected3?>>Illustrator</option>
              <option value="manager" <?=$selected4?>>Manager</option>
              <option value="marketing/socailmedia" <?=$selected5?>>Marketing/Socail Media</option>
              <option value="photographer" <?=$selected6?>>Photographer</option>
              <option value="uxdesigner/researcher" <?=$selected7?>>UX Designer/Researcher</option>
              <option value="videoproduction" <?=$selected8?>>Video Production</option>
              <option value="visual/uidesigner" <?=$selected9?>>Visual/UI Designer</option>
              <option value="webdeveloper" <?=$selected10?>>Web Developer</option>
              <option value="other" <?=$selected11?>>Other</option>
            </select>
            <input type="hidden" name="profession_other" value="<?=$user_profession?>" placeholder="Other" id="profession_other">
            <br><br>
            <span class="user_info_span">I use MonsterForm for</span>
            <br>
            <table id="usemf_table">
              <tr>
                <td><input type="checkbox" name="full_time_job" id="full_time_job" value="full_time_job" <?=$checked1?>>My full-time job</td>
                <td><input type="checkbox" name="freelance_work" id="freelance_work" value="freelance_work" <?=$checked2?>>My freelance work</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="part_time_side" id="part_time_side" value="part_time_side" <?=$checked3?>>My part-time side business</td>
                <td><input type="checkbox" name="non_profit" id="non_profit" value="non_profit" <?=$checked4?>>A non-profit or charity</td>
              </tr>
              <tr>
                <td><input type="checkbox" name="school" id="school" value="school" <?=$checked5?>>School</td>
                <td><input type="checkbox" name="personal_projects" id="personal_projects" value="personal_projects" <?=$checked6?>>Personal Projects</td>
              </tr>
            </table>
            <input type="hidden" name="use_mf" id="use_mf" value="<?=$user_use_mf?>">
            <br>
            <input type="button" name="button" value="Update Settings" onclick="check_update_setting()">
            <br><br>
          </form>
        </div> <!-- end of user_info_div -->
      </div> <!--end of member_profile_info -->
    </div> <!--end of member_profile -->
    <div class="clear"></div>

      <?php
    }else if(isset($_GET['mode']) && $_GET['mode']=='change_password'){
      ?>
      <div id="change_password_info">

      </div>



    <?php
    }
     ?>



<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
