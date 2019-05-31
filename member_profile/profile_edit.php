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
  $requests_bold = '';

  if(isset($_GET['mode']) && $_GET['mode']=='profile_info'){
    $sql = "SELECT * from `member` where no = $member_no;";
    $profile_info_bold = 'style = "font-size:25px"';
    $mode = 'profile_info';
  }else if(isset($_GET['mode']) && $_GET['mode']=='change_password'){
    $sql = "SELECT * from `member` where no = $member_no;";
    $change_password_bold = 'style = "font-size:25px"';
    $mode = 'change_password';
  }else if(isset($_GET['mode']) && $_GET['mode']=='requests'){
    $sql = "SELECT * from `member` where no = $member_no;";
    $requests_bold = 'style = "font-size:25px"';
    $mode = 'requests';
  }

    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result);
    $img_name = $row['pro_img_copied'];
    $shop_img_name = $row['shop_img_copied'];
    $user_no = $row['no'];
    $user_email = $row['email'];
    $user_username = $row['username'];
    $user_password = $row['password'];
    $user_location = $row['location'];
    $user_profession = $row['profession'];
    $user_present_mon = $row['point_mon'];
    $user_present_hwan_mon = $row['hwan_mon'];

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
      $img_name = "../data/img/no_profile.png";
    }else{
      $img_name = "../data/img/".$img_name;
    }

    if($shop_img_name==''){
      $shop_img_name = "../data/img/no_shop.png";
    }else{
      $shop_img_name = "../data/img/".$shop_img_name;
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

      function readURL_shop(input){
        if (input.files && input.files[0]){
          var reader = new FileReader();
          reader.onload = function(e){
            $('#shop_main_img').attr('src', e.target.result);
          }
          reader.readAsDataURL(input.files[0]);
        }
      }

      $(document).ready(function() {
        $("#profile_image_div_right_file").change(function(){
          readURL(this);
        });

        $("#shop_img_file").change(function(){
          readURL_shop(this);
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
    include "../khy_modal/login_modal_in_folder.php";
    include "../lib/header_in_folder.php";
     ?>
    <!--============================================================================== -->
    <div id="member_profile">
      <div id="member_profile_menu">
        <ul>
          <li id="title">&nbsp;&nbsp;&nbsp;Edit profile</li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_edit.php?mode=profile_info" <?=$profile_info_bold?>>Profile Info</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_edit.php?mode=change_password" <?=$change_password_bold?>>Change Password</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_edit.php?mode=requests" <?=$requests_bold?>>Requests</a></li>
        </ul>
      </div>  <!--end of member_profile_menu -->
      <?php
      if(isset($_GET['mode']) && $_GET['mode']=='profile_info'){
        ?>
      <form name="profile_update_form" action="../khy_modal/not_social.php?mode=update" method="post" enctype="multipart/form-data">
      <div id="shop_img">
        <img src="<?=$shop_img_name?>" alt="" width="1140px;" height="250px;" id="shop_main_img"><br>
        <label for="shop_img_file">Update Shop Image</label>
        <input type="file" name="shop_img_file" id="shop_img_file" value="">
      </div>
      <div class="clear"></div>
      <div id="member_profile_info">
        <ul>
          <li id=""><h2>Profile Info</h2></li>
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
            <input type="text" name="username"  id="username" class="input_text" value="<?=$user_username?>">
            <br><br>
            <span class="user_info_span">Email Address</span>
            <br>
            <input type="text" name="email" id="email" class="input_text" value="<?=$user_email?>" readonly>
            <br><br>
            <span class="user_info_span">Location</span>
            <br>
            <input type="text" name="location" id="location" class="input_text" value="<?=$user_location?>" placeholder="City, State/Region, Country">
            <br><br>
            <span class="user_info_span">Profession</span>
            <br>
            <select class="input_text" id="profession" name="profession" style="width:220px">
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
            <?php
            if($selected11=='selected'){
              echo '<input type="text" name="profession_other" value="'.$user_profession.'" placeholder="Other" id="profession_other">';
            }else{
              echo '<input type="hidden" name="profession_other" value="'.$user_profession.'" placeholder="Other" id="profession_other">';
            }
             ?>
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
            <input type="button" name="button" value="Update Settings" onclick="check_update_setting()" id="update_btn">
            <br><br>
          </form>
        </div> <!-- end of user_info_div -->
      </div> <!--end of member_profile_info -->
      <?php
    }else if(isset($_GET['mode']) && $_GET['mode']=='change_password'){
      if($user_password=='12345'){
        echo '<script>
        alert("소셜로그인시 비밀번호 변경은 불가합니다."); history.go(-1); </script>';
        exit;
      }
      ?>
      <div id="change_password_div"  style="padding-left: 33%;">
        <form name="password_change_form" action="../khy_modal/not_social.php?mode=update_password" method="post">
        <table id="pass_table">
          <tr id="pass_title_tr">
            <td colspan="2"><h2 class="title_h2">Change Password</h2></td>
          </tr>
          <tr>
            <td colspan="2"> <span class="pw_title_span"> Old Password  </span></td>
          </tr>
          <tr>
            <td colspan="2"><input type="password" name="old_password" id="old_password" class="change_pw_text" value="" ></td>
            <input type="hidden" name="old_password_con" id="old_password_con" value="<?=$user_password?>">
          </tr>
          <tr>
            <td colspan="2"> <span class="pw_title_span"> New Password  </span></td>
          </tr>
          <tr>
            <td colspan="2"><input type="password" name="new_password" id="new_password" value="" class="change_pw_text" placeholder="6 ~ 14 letters(numbers + alphas + specials)"></td>
          </tr>
          <tr>
            <td colspan="2"><span class="pw_title_span">Verify Password  </span></td>
          </tr>
          <tr>
            <td colspan="2"><input type="password" name="veri_password" id="veri_password" value="" class="change_pw_text" placeholder="6 ~ 14 letters(numbers + alphas + specials)"></td>
          </tr>
          <tr><td></td></tr>
          <tr>
            <td colspan="2"><input type="button" name="" value="Change Password" id="chang_pw_btn" onclick="change_pass_check();"></td>
          </tr>
        </table>
        </form>
      </div>
      <br>

    <?php
  }else if(isset($_GET['mode']) && $_GET['mode']=='requests'){
     ?>
     <div class="request_div" style="padding-left: 33%;">
       <form name="hwan_mon_form" action="../khy_modal/not_social.php?mode=hwan_mon" method="post">
       <table id="pass_table">
         <tr id="pass_title_tr">
           <td colspan="2"><h2 class="title_h2" >Request Mon</h2></td>
         </tr>
         <tr>
           <td colspan="2"><span class="pw_title_span"> Present Mon  </span></td>
         </tr>
         <tr>
           <td colspan="2"><input type="number" name="present_mon" id="present_mon" class="change_pw_text" value="<?=$user_present_mon?>" readonly></td>
         </tr>
         <tr>
           <td colspan="2"><span class="pw_title_span">Hope Mon  </span></td>
         </tr>
         <tr>
           <td colspan="2"><input type="number" name="hope_mon" id="hope_mon" value="" class="change_pw_text" placeholder="Can 10Mon++"></td>
         </tr>
         <tr><td></td></tr>
         <tr>
           <td colspan="2">
             <?php
             if($user_present_hwan_mon == 0){
               echo '<input type="button" name="" value="Request Mon" id="chang_pw_btn" onclick="hwan_mon_check();">';
             }else{
               echo '<div id="request_status"> Present Request : '.$user_present_hwan_mon.' Mon </div>';
             }
              ?>
           </td>
         </tr>
       </table>
       </form>
     </div>
     <br>
  <?php
  }
   ?>
    </div> <!--end of member_profile -->
    <div class="clear"></div><br><br><br>

<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
