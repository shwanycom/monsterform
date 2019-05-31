<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

create_table($conn, "follow");

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";
if(empty($member_email)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}

if(isset($_GET['email'])){
  $shop_email = $_GET['email'];
  $sql = "SELECT no from `member` where email = '$shop_email';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $shop_no = intval($row['no']);
}

  $sql = "SELECT * from `member` where no = $shop_no;";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_array($result);
  $img_name = $row['pro_img_copied'];
  $shop_img_name = $row['shop_img_copied'];

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

$follow_status_sql = "SELECT * from `follow` where following=$member_no and follower=$shop_no;";
$follow_status_result = mysqli_query($conn, $follow_status_sql);
if (!$follow_status_result) {
  die('Error: ' . mysqli_error($conn));
}
if($follow_status_num = mysqli_num_rows($follow_status_result)==1){
  $follow_status = 'y';
  $follow_style = 'style = "background-color:rgba(151, 177, 98, 129); color:#fff;"';
}else{
  $follow_status = 'n';
  $follow_style = 'style = "background-color:#e5e5e4"';
}

define('SCALE', 6);

$likes_bold = '';
$collections_bold = '';
$shop_bold = '';

$following_sql = "SELECT * from `follow` where following='$shop_no';";
$following_result = mysqli_query($conn, $following_sql);
if (!$following_result) {
  die('Error: ' . mysqli_error($conn));
}
$following_num = mysqli_num_rows($following_result);

$follower_sql = "SELECT * from `follow` where follower='$shop_no';";
$follower_result = mysqli_query($conn, $follower_sql);
if (!$follower_result) {
  die('Error: ' . mysqli_error($conn));
}
$follower_num = mysqli_num_rows($follower_result);


if(isset($_GET['mode']) && $_GET['mode'] == 'likes'){
  $sql = "SELECT product_num from `likes` where no = $shop_no;";
  $likes_bold = 'style = "font-size:25px"';
  $mode = 'likes';

}else if(isset($_GET['mode']) && $_GET['mode'] == 'collections'){
  $sql = "SELECT * from `report` where no=$shop_no;";
  $collections_bold = 'style = "font-size:25px"';
  $mode = 'collections';

}else if(isset($_GET['mode']) && $_GET['mode'] == 'shop'){
  $sql = "SELECT * from `products` where no=$shop_no;";
  $mode = 'shop';
  $shop_bold = 'style = "font-size:25px"';
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
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/photo.css">
    <link rel="stylesheet" href="../css/product_list.css">
    <link rel="stylesheet" href="../css/keyframe.css">
    <link rel="stylesheet" href="../css/index_list.css">
    <link rel="stylesheet" href="../css/message.css">
    <link rel="stylesheet" href="../css/member_profile.css">

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
        var followers = parseInt($("#hid_follower").val());
        $(".likes_img_class").click(function(event) {
          var shop_email = $("#write_id_shop_email").val();
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
               if($(".likes_img_class:eq("+n+")").attr("src")!="../img/hover_like.png"){
                 $(".likes_img_class:eq("+n+")").attr("src", "../img/hover_like.png");
               }else{
                 $(".likes_img_class:eq("+n+")").attr("src", "../img/like.png");
                }
                console.log($(".likes_img_class:eq("+n+")").attr("src"));
              if($(".likes_img_value:eq("+n+")").val()=='y'){
                $(".likes_img_value:eq("+n+")").val('n');
              }else{
                $(".likes_img_value:eq("+n+")").val('y');
              }
              location.reload();
             }

           })
           .fail(function() {
             console.log("error");
           })
           .always(function() {
             console.log("complete");
           });
        });


        $("#follow_button").click(function(event) {
          var shop_no = $("#shop_no_follow").val();
          var status = $("#status_follow").val();
          var shop_email = $("#write_id_shop_email").val();
          $.ajax({
            url: './follow_dml.php',
            type: 'POST',
            data: {"shop_no": ""+shop_no+"", "status": ""+status+"", "shop_email": ""+shop_email+""}
          })
          .done(function(result) {
            console.log("success");
            if(result=='fail'){
              alert("fail!!!!!!!!!!!!!!!!");
            }else if(result=='insert'){
              $("#follow_button").attr('style', 'background-color:rgba(151, 177, 98, 129); color:#fff');
              $("#status_follow").val('y');
              $("#follow_button").val(' ✔ Following ');
              followers += 1;
              $("#followers_num").html(followers);
            }else if(result=='delete'){
              $("#follow_button").attr('style', 'background-color:#e5e5e4;');
              $("#status_follow").val('n');
              $("#follow_button").val(' ✚ Follow ');
              followers -= 1;
              $("#followers_num").html(followers);
            }
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });

        });

        $("#follower_view").click(function(event) {
          var shop_no = $("#shop_no_follow").val();
          $.ajax({
            url: './follow_ajax.php',
            type: 'POST',
            data: {"shop_no": ""+shop_no+""}
          })
          .done(function(result) {
            console.log("success");
            console.log(result);
            $("#follow_list").html(result);
          })
          .fail(function() {
            console.log("error");
          })
          .always(function() {
            console.log("complete");
          });
        });

        $("#following_view").click(function(event) {
          var shop_no = $("#shop_no_follow").val();
          $.ajax({
            url: './follow_ajax.php',
            type: 'POST',
            data: {"shop_no1": ""+shop_no+""}
          })
          .done(function(result) {
            console.log("success");
            $("#follow_list").html(result);
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
    <img src="<?=$shop_img_name?>" alt="" width="100%;" height="400vh;" id="shop_main_img"><br>
    <div id="member_profile">
      <div class="clear"></div>

      <div id="member_profile_left">
        <ul>
          <li id="title"><img src="<?=$img_name?>" alt="" width="80px" height="80px" id="img_view">&nbsp;&nbsp;&nbsp;<?=$shop_email?></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=shop&email=<?=$shop_email?>" <?=$shop_bold?>>Shop</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=likes&email=<?=$shop_email?>" <?=$likes_bold?>>Likes</a></li>
          &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="./profile_view.php?mode=collections&email=<?=$shop_email?>" <?=$collections_bold?>>Collections</a></li>
        </ul>

        <div id="member_likes_div">
          <br><br>
          <?php
          if(isset($_GET['mode']) && $_GET['mode'] == 'likes'){

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
                $item_big_data = $row_likes_product["big_data"];
                $item_price = $row_likes_product["price"];
                $item_email = $row_likes_product["email"];
                $img_copy_name1 = $row_likes_product["img_file_copied1"];
                $img_copy_name1 = "../data/img/".$img_copy_name1;
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

                if(!isset($member_no)){
                  $likes_img = '';
                }else{
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
                }

                // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
                if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
                    $main_img = $img_copy_name0;
                }

              ?>
              <div class="img_div">
                <figure class="snip1368">
                  <a href="../shop/shop_view.php?num=<?=$item_num?>">
                    <img id="main_img_likes" src="<?=$img_copy_name1?>" alt="sample30" />
                  </a>
                  <div class="hover_img">
                    <img src="<?=$freegoods_img?>" alt="" style="width:25px; height:25px; margin-left: 6px;  margin-top: 3px;"><!--가져다 댔을때-->
                  </div>
                  <div class="list_title_div">
                    <div class="">
                      <a href="#" class="">
                        <span class="list_title_div_span_bold" style="text-align:left;"><?=$item_subject?></span>
                      </a>
                      <a href="#" class="list_title_div_a_float_right" style="text-align:left;">
                         <?=$item_price?>&nbsp;M
                      </a>
                    </div>
                    <div class="">
                        by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email=<?=$item_email?>" class=""><?=$item_email?></a>
                        in&nbsp;<a href="../product_list/list.php?big_data=<?=$item_big_data?>" class=""><?=$item_big_data?></a>
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
             <br><br>
             <div class="product_page_num">
               <?php
               if(!($page-1==0)){
                 $go_page = $page-1;
                 echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'><span class='page_button2'>&nbsp;PREV </span>&nbsp;</a>";
               }else{
                 echo "";
               }
               for($i=1;$i<=$total_page;$i++){
                 if($page==$i){
                   echo "<b id='page_num'>&nbsp;  $i  &nbsp;</b>";
                 }else{
                   echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$i'>&nbsp;$i&nbsp;</a>";
                 }
               }

                 if($total_record!=0){
                   if($page==$total_page){
                     echo "";
                   }else{
                     $go_page = $page+1;
                     echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'>&nbsp;<span class='page_button2' style='margin-left:10px;'> NEXT </span></a>";
                   }
                 }else{
                   echo "";
                 }

                  ?>
                  <br><br>
               </div> <!-- end of page_num -->
          <?php
        }else if(isset($_GET['mode']) && $_GET['mode'] == 'collections'){

          for($i=$start;$i<($start+SCALE) && $i < $total_record; $i++){
            mysqli_data_seek($result, $i);
            $row = mysqli_fetch_array($result);
            $pnum = $row['product_num'];

            $sql_collections = "SELECT * from `collections` where pro_num = $pnum;";
            $result_collections = mysqli_query($conn, $sql_collections);

            $total_record_collections = mysqli_num_rows($result_collections);

            for($k=0;$k<$total_record_collections;$k++){
              mysqli_data_seek($result, $k);
              $row = mysqli_fetch_array($result_collections);
              $item_no = $row["pro_no"];
              $item_num = $row["pro_num"];
              $item_price = $row["pro_price"];
              $item_email = $row["pro_email"];
              $img_copy_name1 = $row["pro_img_file_copied"];
              $img_copy_name1 = "../data/img/".$img_copy_name1;
              $item_hit = $row["pro_hit"];
              $item_date = $row["buy_regist_day"];
              $item_date = substr($item_date, 0, 10);
              $item_big_data = $row["pro_big_data"];
              $item_subject = str_replace(" ", "&nbsp;", $row["pro_subject"]);
              $item_freegoods=$row["pro_freegoods"];

              $sql_partner = "SELECT partner from member where no = '$item_no';";
              $result_partner = mysqli_query($conn, $sql_partner);
              $row_partner = mysqli_fetch_array($result_partner);
              $partner = $row_partner['partner'];

              if($partner=='n' && $item_freegoods=='n'){
                $freegoods_img="../img/hover_logo.png";
              }else{
                $freegoods_img="../img/free_partner_logo.png";
              }

              if(!isset($member_no)){
                $likes_img = '';
              }else{
                $sql_likes = "SELECT product_num from likes where no = '$member_no';";
                $result_likes = mysqli_query($conn, $sql_likes);
                $total_record_likes = mysqli_num_rows($result_likes);

                $likes_img = "../img/hover_like.png";
                $likes_img_value = "n";

                for($j=0;$j<$total_record_likes;$j++){
                  mysqli_data_seek($result_likes, $j);
                  $row_likes = mysqli_fetch_array($result_likes);
                  $likes = $row_likes['product_num'];
                  if($likes == $item_num){
                    $likes_img = "../img/like.png";
                    $likes_img_value = "y";
                    break;
                  }
                }
              }
            }

            // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
            if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
                $main_img = $img_copy_name0;
            }
            ?>
            <div class="img_div">
              <figure class="snip1368">
                <a href="../shop/shop_view.php?num=<?=$item_num?>">
                  <img id="main_img_likes" src="<?=$img_copy_name1?>" alt="sample30" />
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
                       <?=$item_price?>&nbsp;M
                    </a>
                  </div>
                  <div class="">
                      by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email=<?=$item_email?>" class=""><?=$item_email?></a>
                      in&nbsp;<a href="../product_list/list.php?big_data=<?=$item_big_data?>" class=""><?=$item_big_data?></a>
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

          $number --;
          }
           ?>
           <br><br>
           <div class="product_page_num">
             <?php
             if(!($page-1==0)){
               $go_page = $page-1;
               echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'><span class='page_button'>&nbsp;PREV </span>&nbsp;</a>";
             }else{
               echo "";
             }
             for($i=1;$i<=$total_page;$i++){
               if($page==$i){
                 echo "<b id='page_num'>&nbsp;&nbsp; $i &nbsp;&nbsp;</b>";
               }else{
                 echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$i'>&nbsp;$i&nbsp;</a>";
               }
             }
             if($total_record!=0){
               if($page==$total_page){
                 echo "";
               }else{
                 $go_page = $page+1;
                 echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'>&nbsp;<span class='page_button'> NEXT </span></a>";
               }
             }else{
               echo "";
             }
                ?>
                <br><br>
             </div> <!-- end of page_num -->
           <?php
         }else if(isset($_GET['mode']) && $_GET['mode'] == 'shop'){

           for($i=$start;$i<($start+SCALE) && $i < $total_record; $i++){
             mysqli_data_seek($result, $i);
             $row = mysqli_fetch_array($result);
             $item_no = $row["no"];
             $item_num = $row["num"];
             $item_name = $row["username"];
             $item_price = $row["price"];
             $item_email = $row["email"];
             $img_copy_name1 = $row["img_file_copied1"];
             $img_copy_name1 = "../data/img/".$img_copy_name1;
             $item_hit = $row["hit"];
             $item_date = $row["regist_day"];
             $item_date = substr($item_date, 0, 10);
             $item_big_data = $row["big_data"];
             $item_subject = str_replace(" ", "&nbsp;", $row["subject"]);
             $item_freegoods=$row["freegoods"];

             $sql_partner = "SELECT partner from member where no = '$item_no';";
             $result_partner = mysqli_query($conn, $sql_partner);
             $row_partner = mysqli_fetch_array($result_partner);
             $partner = $row_partner['partner'];

             if($partner=='n' && $item_freegoods=='n'){
               $freegoods_img="../img/hover_logo.png";
             }else{
               $freegoods_img="../img/free_partner_logo.png";
             }

             if(!isset($member_no)){
               $likes_img = '';
             }else{
               $sql_likes = "SELECT product_num from likes where no = '$member_no';";
               $result_likes = mysqli_query($conn, $sql_likes);
               $total_record_likes = mysqli_num_rows($result_likes);

               $likes_img = "../img/hover_like.png";
               $likes_img_value = "n";

               for($j=0;$j<$total_record_likes;$j++){
                 mysqli_data_seek($result_likes, $j);
                 $row_likes = mysqli_fetch_array($result_likes);
                 $likes = $row_likes['product_num'];
                 if($likes == $item_num){
                   $likes_img = "../img/like.png";
                   $likes_img_value = "y";
                   break;
                 }
               }
             }

             // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
             if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
                 $main_img = $img_copy_name0;
             }

             ?>
             <div class="img_div">
               <figure class="snip1368">
                 <a href="../shop/shop_view.php?num=<?=$item_num?>">
                   <img id="main_img_likes" src="<?=$img_copy_name1?>" alt="sample30" />
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
                        <?=$item_price?>&nbsp;M
                     </a>
                   </div>
                   <div class="">
                       by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email=<?=$item_email?>" class=""><?=$item_email?></a>
                       in&nbsp;<a href="../product_list/list.php?big_data=<?=$item_big_data?>" class=""><?=$item_big_data?></a>
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
           $number --;
           }
            ?>
            <br><br>
            <div class="product_page_num">
              <?php
              if(!($page-1==0)){
                $go_page = $page-1;
                echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'><span class='page_button'>&nbsp;PREV </span>&nbsp;</a>";
              }else{
                echo "";
              }
              for($i=1;$i<=$total_page;$i++){
                if($page==$i){
                  echo "<b id='page_num'>&nbsp;&nbsp; $i &nbsp;&nbsp;</b>";
                }else{
                  echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$i'>&nbsp;$i&nbsp;</a>";
                }
              }
              if($total_record!=0){
                if($page==$total_page){
                  echo "";
                }else{
                  $go_page = $page+1;
                  echo "<a href='./profile_view.php?mode=$mode&email=$shop_email&page=$go_page'>&nbsp;<span class='page_button'> NEXT </span></a>";
                }
              }else{
                echo "";
              }
                 ?>
                 <br><br>
              </div> <!-- end of page_num -->
          <?php
         } // end if else if
           ?>
        </div> <!-- end of member_likes_div -->
      </div>  <!--end of member_profile_left -->
      <div id="member_profile_right">
        <table>
          <tr>
            <div class=""id="username" style="border-bottom:1px solid #dddddd; padding-bottom:70px;">
            </div>
          </tr>
          <tr>
            <?php
            if($member_email == $shop_email){
              echo '<td><a href="./profile_edit.php?mode=profile_info"><button type="button" name="button" id="edit_btn">Edit Profile</button></a></td>
                    <td><a href="./profile_edit.php?mode=requests"><button type="button" name="button" id="reque_btn">Requests</button></a></td>
                    ';
            }else{
              if($follow_status=='n'){
                echo '<td><input type="button" id="follow_button" value=" ✚ Follow " '.$follow_style.'></td>';
              }else{
                echo '<td><input type="button" id="follow_button" value=" ✔ Following " '.$follow_style.'></td>';
              }
              echo '<td><button type="button" id="myBtn_1"
              style="cursor: pointer;
              background-color: #e5e5e4;
              color:black;
              outline: none;
              border: none;
              font-weight: bold;
              width: 90px;
              height: 30px;
              border-radius: 3px;
              "> ✉ Message</button></td>';
            }
             ?>
             <input type="hidden" name="" value="<?=$shop_email?>" id="write_id_shop_email">
             <input type="hidden" name="" value="<?=$shop_no?>" id="shop_no_follow">
             <input type="hidden" name="" value="<?=$follow_status?>" id="status_follow">
          </tr>
          <tr id="spe_tr1">
            <td id="follower_view" style="cursor:pointer;"> Followers <br> <span id="followers_num"><?=$follower_num?></span></td>
            <td id="following_view" style="cursor:pointer;">Following <br>
              <?=$following_num?></td>
            <input type="hidden" name="" value="<?=$follower_num?>" id="hid_follower">

          </tr>
        </table>
        <div id="follow_list">

        </div>
      </div> <!--end of member_profile_right -->

    </div> <!--end of member_profile -->
    <div class="clear"></div>

<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
  include "./profile_message_modal.php";
  include "../khy_modal/login_modal_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
