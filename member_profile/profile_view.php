<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

create_table($conn, "follow");

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";
if(empty($member_username)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}

define('SCALE', 4);

$likes_bold = '';
$collections_bold = '';

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

if(isset($_GET['mode']) && $_GET['mode'] == 'likes'){
  $sql = "SELECT product_num from `likes` where no = $member_no;";
  $likes_bold = 'style = "font-size:25px"';
  $collections_bold = '';
}else if(isset($_GET['mode']) && $_GET['mode'] == 'collections'){
  $sql = "SELECT * from `collections` where no=$member_no;";
  $collections_bold = 'style = "font-size:25px"';
  $likes_bold = '';
}

$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result);

$total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

if(empty($_GET["page"])){
  $page = 1;
}else{
  $page = $_GET["page"];
}

$start = ($page-1) * SCALE;

$number = $total_record - $start;

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/member_profile.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/product_list.css">
    <link rel="stylesheet" href="../css/photo.css">
    <link rel="stylesheet" href="../css/keyframe.css">
    <link rel="stylesheet" href="../css/index_list.css">
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

      $(document).ready(function() {
        $(".likes_img_class").click(function(event) {
          var n = $(".likes_img_class").index(this);
          var num_num = $(".hidden_num:eq("+n+")").val();
          var likes_img_value = $(".likes_img_value:eq("+n+")").val();
          console.log(n);
          console.log(num_num);
          console.log(likes_img_value);
           $.ajax({
             url: '../lib/like_dml.php?mode=go_like', // 데이터 보내서 작업되어질 url
             type: 'POST', // get 또는 post로 data를 보냄
             data: {num: num_num, liv : likes_img_value}
           })
           .done(function(result_ajax) {
             console.log("success");
             console.log(result_ajax);
             console.log($(".likes_img_class:eq("+n+")").attr("src"));
             if(result_ajax=='fail'){
               alert("로그인 후 이용하세요.");
             }else{
              window.location.href = "./profile_view.php?mode=likes";
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
          <li id="title">&nbsp;&nbsp;&nbsp;<?=$member_username?></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=likes" <?=$likes_bold?>>Likes</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=collections" <?=$collections_bold?>>Collections</a></li>
        </ul>

        <!--이동현꺼 불러오기할거임ㅇㅇ-->
        <div id="member_likes_div">
          <?php
          for($i=$start;$i<($start+SCALE) && $i < $total_record; $i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $pnum = $row['product_num'];

            $sql_likes_product = "SELECT * from `products` where num = $pnum;";
            $result_likes_product = mysqli_query($conn, $sql_likes_product);
            $total_record_likes_product = mysqli_num_rows($result_likes_product);

            for($j=0;$j< $total_record_likes_product ; $j++){
              mysqli_data_seek($result_likes_product, $j);
              $row_likes_product = mysqli_fetch_array($result_likes_product);
              $item_no = $row_likes_product['no'];
              $item_num = $row_likes_product["num"];
         			$item_name = $row_likes_product["username"];
         			$price = $row_likes_product["price"];
              $item_price = $price/100;
              $item_email = $row_likes_product["email"];
         			$img_copy_name0 = $row_likes_product["img_file_copied1"];
         			$item_hit = $row_likes_product["hit"];
         			$item_date = $row_likes_product["regist_day"];
         			$item_date = substr($item_date, 0, 10);
         			$item_subject = str_replace(" ", "&nbsp;", $row_likes_product["subject"]);
              $item_freegoods=$row_likes_product["freegoods"];

              $sql_partner = "SELECT partner from member where no = $item_no;";
              $result_partner = mysqli_query($conn, $sql_partner);
              $row_partner = mysqli_fetch_array($result_partner);
              $partner = $row_partner['partner'];

              if($partner=='n' && $item_freegoods=='n'){
                $freegoods_img="../img/hover_logo.png";
              }else{
                $freegoods_img="../img/free_partner_logo.png";
              }

              $sql_likes = "SELECT product_num from likes where no = '$member_no';";
              $result_likes = mysqli_query($conn, $sql_likes);
              $total_record_likes = mysqli_num_rows($result_likes);

              $likes_img = "../img/hover_like.png";
              $likes_img_value = "n";

              for($k=0;$k<$total_record_likes;$k++){
                mysqli_data_seek($result_likes, $k);
                $row_likes = mysqli_fetch_array($result_likes);
                $likes = $row_likes['product_num'];
                if($likes == $item_num){
                  $likes_img = "../img/like.png";
                  $likes_img_value = "y";
                  break;
                }
              }

              // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
              if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
                  $main_img = $img_copy_name0;
              }


            ?>
            <div class="img_div">
              <figure class="snip1368">
                <a href="#">
                  <img id="main_img" src="../img/openmarket.png" alt="sample30" />
                </a>
                <div class="hover_img">
                  <img src="<?=$freegoods_img?>" alt="" style="width:25px; height:25px;"><!--가져다 댔을때-->
                </div>
                <div class="list_title_div">
                  <div class="">
                    <a href="#" class="">
                      <span class="list_title_div_span_bold"><?=$item_subject?></span>
                    </a>
                    <a href="#" class="list_title_div_a_float_right">
                      M&nbsp; <?=$item_price?>
                    </a>
                  </div>
                  <div class="">
                      by&nbsp;<a href="#" class=""><?=$item_email?></a>
                      in&nbsp;<a href="#" class=""><?=$big_data?></a>
                  </div>
                </div>
                <figcaption>
                  <div class="icons">
                    <input type="hidden" class="hidden_num" value="<?=$item_num?>">
                    <img class="likes_img_class" src="<?=$likes_img?>" alt="" style="width:25px; height:25px;"><br>
                    <input type="hidden" class="likes_img_value" value="<?=$likes_img_value?>">
                  </div>
                </figcaption>
              </figure>
            </div>

          <?php
          }
          $number --;
        }
           ?>

        </div>

      </div>  <!--end of member_profile_left -->
      <div id="member_profile_right">
        <table>
          <tr>
            <td id="username"><?=$member_username?></td>
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
