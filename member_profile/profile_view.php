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

$following_sql = "SELECT * from `follow` where following='$member_no';";
$following_result = mysqli_query($conn, $following_sql);
if (!$following_result) {
  die('Error: ' . mysqli_error($conn));
}
$following_num = mysqli_num_rows($following_result);

$follower_sql = "SELECT * from `follow` where follower='$member_no';";
$follower_result = mysqli_query($conn, $follower_sql);
if (!$follower_result) {
  die('Error: ' . mysqli_error($conn));
}
$follower_num = mysqli_num_rows($follower_result);


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
      <div id="member_profile_left">
        <ul>
          <li id="title">&nbsp;&nbsp;&nbsp;<?=$username?></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=likes">Likes</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=collections">Collections</a></li>
        </ul>
        <?php
        if(isset($_GET['mode']) && $_GET['mode'] == 'likes'){
          $sql = "SELECT * from `likes` where no=$memeber_no;";
          $result = mysqli_query($conn, $sql);
          if (!$result) {
            die('Error: ' . mysqli_error($conn));
          }
          $total_record = mysqli_num_rows($result);

          $total_page = ($total_record%12==0)?(floor($total_record/12)):(ceil($total_record/12));

          if(empty($_GET["page"])){
            $page = 1;
          }else{
            $page = $_GET["page"];
          }

          $start = ($page-1) * 10;

          $number = $total_record - $start;


         ?>
        <!--이동현꺼 불러오기할거임ㅇㅇ-->
        <div id="member_likes_div">


        </div>

         <?php
       }else if(isset($_GET['mode']) && $_GET['mode'] == 'collections'){
         $sql = "SELECT * from `collections` where no=$memeber_no;";
         $result = mysqli_query($conn, $sql);
         if (!$result) {
           die('Error: ' . mysqli_error($conn));
         }
         $total_record = mysqli_num_rows($result);

         $total_page = ($total_record%12==0)?(floor($total_record/12)):(ceil($total_record/12));

         if(empty($_GET["page"])){
           $page = 1;
         }else{
           $page = $_GET["page"];
         }

         $start = ($page-1) * 10;

         $number = $total_record - $start;

          ?>
        <!--여기도 이동현꺼 활용해야됨 ㅇㅇ-->
        <div id="member_collections_div">


        </div>
        <?php
      }
         ?>



      </div>  <!--end of member_profile_left -->
      <div id="member_profile_right">
        <table>
          <tr>
            <td id="username"><?=$username?></td>
            <td id="spe_td1">&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr>
            <td><a href="./profile_edit.php"><button type="button" name="button">Edit Profile</button></a></td>
            <td>&nbsp;&nbsp;&nbsp;</td>
          </tr>
          <tr id="spe_tr1">
            <td>Followers <?=$follower_num?></td>
            <td>Following <?=$following_num?></td>
          </tr>
        </table>
      </div> <!--end of member_profile_right -->

    </div> <!--end of member_profile -->
    <div class="clear"></div>


<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
