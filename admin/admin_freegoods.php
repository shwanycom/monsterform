<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
if(isset($_SESSION['username'])){
  if($_SESSION['username']!=='admin'){
    echo "<script> alert('no permission'); history.go(-1); </script>";
  }
}else if(!isset($_SESSION['username'])){
  echo "<script> alert('no permission'); history.go(-1); </script>";
}

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>

<?php
$result_sen1="";
$result_sen2="";
if(isset($_GET['mode'])){
  if(isset($_GET['freegoods_search_value']) && isset($_GET['freegoods_search_kind'])){
    $freegoods_search_value = $_GET['freegoods_search_value'];
    $freegoods_search_kind = $_GET['freegoods_search_kind'];
  }
}



if(isset($_GET['freegoods_sort_partner'])){
  $freegoods_sort_partner_check="checked";
}else{
  $freegoods_sort_partner_check="";
}
if(isset($_GET['freegoods_sort_allow'])){
  $freegoods_sort_allow_check="checked";
}else{
  $freegoods_sort_allow_check="";
}
$selected_all="";
$selected_fonts="";
$selected_photos="";
$selected_graphics="";
if(isset($_GET['freegoods_search_kind'])){
  $freegoods_search_kind_check=$_GET['freegoods_search_kind'];
  if($freegoods_search_kind_check=="photos"){
    $selected_photos="selected";
    $selected_graphics="";
    $selected_fonts="";
    $selected_all="";
  }else if($freegoods_search_kind_check=="graphics"){
    $selected_graphics="selected";
    $selected_photos="";
    $selected_fonts="";
    $selected_all="";
  }else if($freegoods_search_kind_check=="fonts"){
    $selected_fonts="selected";
    $selected_photos="";
    $selected_graphics="";
    $selected_all="";
  }else{
    $selected_all="selected";
    $selected_fonts="";
    $selected_photos="";
    $selected_graphics="";
  }
}
if(isset($_GET['freegoods_search_value'])){
  $freegoods_search_value_check=$_GET['freegoods_search_value'];
}else{
  $freegoods_search_value_check="";
}




if(isset($_GET['freegoods_search_kind']) && $_GET['freegoods_search_kind']=="photos"){
  $sort_kind="photos";
  $sort_kind_sql= "and p.big_data='$freegoods_search_kind'";
}else if(isset($_GET['freegoods_search_kind']) && $_GET['freegoods_search_kind']=="graphics"){
  $sort_kind="graphics";
  $sort_kind_sql= "and p.big_data='$freegoods_search_kind'";
}else if(isset($_GET['freegoods_search_kind']) && $_GET['freegoods_search_kind']=="fonts"){
  $sort_kind="fonts";
  $sort_kind_sql= "and p.big_data='$freegoods_search_kind'";
}else if(isset($_GET['freegoods_search_kind']) && $_GET['freegoods_search_kind']=="All"){
  $sort_kind="all";
  $sort_kind_sql= "";
}


if(!isset($_GET['mode'])){
$sql="select * from `products`";
$url="./admin_freegoods.php?";
}
else if(isset($_GET['mode']) && $_GET['mode']=="view_freegoods"){
$sql="select * from `products` where freegoods='y'";

$url="./admin_freegoods.php?mode=view_freegoods";
}
else if(!empty($_GET['freegoods_search_value']) && isset($_GET['freegoods_sort_partner']) && isset($_GET['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y'
 and p.freegoods_agree='y' $sort_kind_sql and p.subject like '%$freegoods_search_value%'";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_partner=freegoods_sort_partner&freegoods_sort_allow=freegoods_sort_allow";
}
else if(empty($_GET['freegoods_search_value']) && isset($_GET['freegoods_sort_partner']) && isset($_GET['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y' and p.freegoods_agree='y' $sort_kind_sql";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_partner=freegoods_sort_partner&freegoods_sort_allow=freegoods_sort_allow";
}
else if(!empty($_GET['freegoods_search_value']) && !isset($_GET['freegoods_sort_partner']) && isset($_GET['freegoods_sort_allow'])){
$sql="select * from products where freegoods_agree='y' $sort_kind_sql and subject like '%$freegoods_search_value%'";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_partner=freegoods_sort_partner&freegoods_sort_allow=freegoods_sort_allow";
}
else if(!empty($_GET['freegoods_search_value']) && isset($_GET['freegoods_sort_partner']) && !isset($_GET['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y'
 $sort_kind_sql and p.subject like '%$freegoods_search_value%'";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_partner=freegoods_sort_partner";
}
else if(empty($_GET['freegoods_search_value']) && !isset($_GET['freegoods_sort_partner']) && isset($_GET['freegoods_sort_allow'])){
$sql="select * from products where freegoods_agree='y' $sort_kind_sql";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_allow=freegoods_sort_allow";
}
else if(!empty($_GET['freegoods_search_value']) && !isset($_GET['freegoods_sort_partner']) && !isset($_GET['freegoods_sort_allow'])){
$sql="select * from `products` as p where subject like '%$freegoods_search_value%' $sort_kind_sql";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value";
}
else if(empty($_GET['freegoods_search_value']) && isset($_GET['freegoods_sort_partner']) && !isset($_GET['freegoods_sort_allow'])){
  $sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y' $sort_kind_sql";

$url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=$freegoods_search_value&freegoods_sort_partner=freegoods_sort_partner";
}
else if(empty($_GET['freegoods_search_value']) && !isset($_GET['freegoods_sort_partner']) && !isset($_GET['freegoods_sort_allow'])){
  if($sort_kind=="all"){
    $sql="select * from `products`";
    $url="./admin_freegoods.php?";
  }else{
    $sql="select * from products as p where p.big_data='$sort_kind'";

    $url="./admin_freegoods.php?mode=y&freegoods_search_kind=$sort_kind&freegoods_search_value=";
  }
}


$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result); //전체 레코드 수
// 페이지 당 글수, 블럭당 페이지 수
$rows_scale=15;
$pages_scale=5;
// 전체 페이지 수 ($total_page) 계산
$total_pages= ceil($total_record/$rows_scale);
if(empty($_GET['page'])){
    $page=1;
}else{
    $page = $_GET['page'];
}

// 현재 페이지 시작 위치
$start_row= $rows_scale * ($page -1) ;
// 이전 페이지 = 현재 페이지가 1일 경우. null값.
$pre_page= $page>1 ? $page-1 : NULL;
// 다음 페이지 = 현재페이지가 전체페이지 수와 같을 때  null값.
$next_page= $page < $total_pages ? $page+1 : NULL;
// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1  [[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($page / $pages_scale ) -1 ) * $pages_scale +1 ;
// 현재 블럭 마지막 페이지
$end_page= ($total_pages >= ($start_page + $pages_scale)) ? $start_page + $pages_scale-1 : $total_pages;
$number=$total_record- $start_row;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <meta charset="utf-8">
    <title></title>
    <script>
    $(document).ready(function() {
      $('.go_free_goods_img_class').click(function(){
        var n = $('.go_free_goods_img_class').index(this);
        var num_num = $(".hidden_num:eq("+n+")").val();
        var result = confirm("Pick Freegoods?");
        if(result){
         $.ajax({
           url: './admin_freegoods_dml.php?mode=go_free', // 데이터 보내서 작업되어질 url
           type: 'POST', // get 또는 post로 data를 보냄
           data: {num: num_num}
         })
         .done(function(result_ajax) {
           console.log("success");
           if($(".go_free_goods_img_class:eq("+n+")").attr("src")!="../img/hover_logo.png"){
             $(".go_free_goods_img_class:eq("+n+")").attr("src", "../img/hover_logo.png");
           }else{
             $(".go_free_goods_img_class:eq("+n+")").attr("src", "../img/free_partner_logo.png");
           }
         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
        }
      });
    });
    function page_trans(){
      document.freegoods_search_form.submit;
    }
    </script>
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/footer_2.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/admin_freegoods.css">
  </head>
  <body>
    <?php
      include "../lib/header_in_folder.php";
    ?>
    <section id="admin_freegoods_section">
      <div id="admin_member_section_search_div">
        <h1>Select Free Goods / TOTAL : <?=$total_record?></h1>
            <form action="./admin_freegoods.php" method="get" id="freegoods_search_form" name="freegoods_search_form">
              <input type="hidden" name="mode" value="y">
              <div id="freegoods_search_form_div1">
                <select id="freegoods_search_kind" name="freegoods_search_kind">
                <option value="All" <?=$selected_all?>>All</option>
                <option value="photos" <?=$selected_photos?>>photos</option>
                <option value="graphics" <?=$selected_graphics?>>graphics</option>
                <option value="fonts" <?=$selected_fonts?>>fonts</option>
                </select>
                <input type="text" id="admin_freegoods_search_text" name="freegoods_search_value" value=<?=$freegoods_search_value_check?>>
              </div>
              <div id="freegoods_search_form_div2">
                <label for="">PARTNER</label>
                <input class="switch_check" type="checkbox" value="freegoods_sort_partner" name="freegoods_sort_partner" <?=$freegoods_sort_partner_check?>>
                <label for="">ALLOW</label>
                <input class="switch_check" type="checkbox" value="freegoods_sort_allow" name="freegoods_sort_allow" <?=$freegoods_sort_allow_check?>>
                <input type="submit" value="Search" id="search_submit">
              </div>
            </form>
          </div>
      <!-- <hr style="border: 1px solid black;"> -->
    <div class="gesipan_div">

    <?php

    for($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
      mysqli_data_seek($result, $i);
      //하나 레코드 가져오기
      $row=mysqli_fetch_array($result);
      $no=$row["no"];
      $num=$row["num"];
      $username=$row["username"];
      $email=$row["email"];
      $subject=$row["subject"];
      $content=$row["content"];
      $regist_day=$row["regist_day"];
      $price=$row["price"];
      $big_data=$row["big_data"];
      $small_data=$row["small_data"];
      $img_file_copied1=$row["img_file_copied1"];
      $freegoods=$row["freegoods"];
      if($freegoods=='y'){
        $freegoods_img="../img/free_partner_logo.png";
      }else{
        $freegoods_img="../img/hover_logo.png";
      }
    echo '<div class="img_div">
        <input type="hidden" class="hidden_num" value="'.$num.'">
        <figure class="snip1368">
          <a href="../shop/shop_view.php?num='.$num.'">
            <img id="main_img" src="../data/img/'.$img_file_copied1.'" alt="sample30" />
          </a>
          <div class="hover_img" id="hover_img_id">
            <img src="'.$freegoods_img.'" class="go_free_goods_img_class" name="go_free_goods_img"  style="width:25px; height:25px;"><!--가져다 댔을때-->
          </div>
          <div class="list_title_div">
            <div class="">
              <a href="../shop/shop_view.php?num='.$num.'" class="">
                <span class="list_title_div_span_bold">'.$subject.'</span>
              </a>
              <a href="#" class="list_title_div_a_float_right">
                M&nbsp; '.$price.'
              </a>
            </div>
            <div class="">
                by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email='.$email.'" class="">'.$email.'</a>
                in&nbsp;<a href="../product_list/list.php?big_data='.$big_data.'" class="">'.$big_data.'</a>
            </div>
          </div>
        </figure>
        </div>
      ';
      if($i%3==2){
        echo '<br>';
      }
    }
    ?>
    </div>
    <br><br>
    <hr>
    <div id="admin_member_list_div">
      <a href='admin_freegoods.php'>
        <button id="admin_freegoods_button_list" type="button" name="button">LIST</button>
      </a>
      <a href='admin_freegoods.php?mode=view_freegoods'>
        <button id="admin_freegoods_button_list" type="button" name="button">VIEW FREE</button>
      </a>
    </div>
    <div id="admin_member_next_prev_div">

    <?PHP
      #----------------이전블럭 존재시 링크------------------#
      if($start_page > $pages_scale){
         $go_page= $start_page - $pages_scale;
         echo "<a id='before_block' href='$url&page=$go_page'> << </a>";
      }
      #----------------이전페이지 존재시 링크------------------#
      if($pre_page){
          echo "<a id='before_page' href='$url&page=$pre_page'> < </a>";
      }
       #--------------바로이동하는 페이지를 나열---------------#
      for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
         if($dest_page == $page){
              echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
          }else{
              echo "<a id='move_page' href='$url&page=$dest_page'>$dest_page</a>";
          }
       }
       #----------------이전페이지 존재시 링크------------------#
       if($next_page){
           echo "<a id='next_page' href='$url&page=$next_page'> > </a>";
       }
       #---------------다음페이지를 링크------------------#
      if($total_pages >= $start_page+ $pages_scale){
        $go_page= $start_page+ $pages_scale;
        echo "<a id='next_block' href='$url&page=$go_page'> >> </a>";
      }
     ?>
    </div>
    <br><br>
    <div class="form_pick_date_div">
      <form class="" action="admin_freegoods_dml.php?mode=date" method="post">
      <label id="pick_date_label" for="">EXPIRATION DATE</label>
      <input id="pick_date" type="datetime-local" name="pick_date" value="">
        <input id="pick_date_submit" type="submit" name="" value="CONFIRM">
      </form>
    </div>
    <br><br>
    </section>
    <?php
      include "./admin_main_in_folder.php";
      include "../lib/footer_in_folder.php";
      include "../khy_modal/login_modal_in_folder.php";
    ?>
  </body>
</html>
