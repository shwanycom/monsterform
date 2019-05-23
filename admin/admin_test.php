<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
if($_SESSION['username']!=='admin'){
  echo "<script> alert('no permission'); history.go(-1); </script>";
  exit;
}
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>

<?php
if(isset($_GET['mode'])){
  $freegoods_search_value = $_POST['freegoods_search_value'];
  $freegoods_search_kind = $_POST['freegoods_search_kind'];
}

if(isset($_POST['freegoods_sort_partner'])){
  $freegoods_sort_partner_check="checked";
}else{
  $freegoods_sort_partner_check="";
}
if(isset($_POST['freegoods_sort_allow'])){
  $freegoods_sort_allow_check="checked";
}else{
  $freegoods_sort_allow_check="";
}

if(isset($_POST['freegoods_search_kind'])){
  $freegoods_search_kind_check=$_POST['freegoods_search_kind'];
}else{
  $freegoods_search_kind_check="photos";
}
if(isset($_POST['freegoods_search_value'])){
  $freegoods_search_value_check=$_POST['freegoods_search_value'];
}else{
  $freegoods_search_value_check="";
}




if(isset($_POST['search_kind']) && $_POST['search_kind']=="photos"){
  $sort_kind="photos";
  $sort_kind_sql= "and p.big_data=".$freegoods_search_kind;
}else if(isset($_POST['search_kind']) && $_POST['search_kind']=="graphics"){
  $sort_kind="graphics";
  $sort_kind_sql= "and p.big_data=".$freegoods_search_kind;
}else if(isset($_POST['search_kind']) && $_POST['search_kind']=="fonts"){
  $sort_kind="fonts";
  $sort_kind_sql= "and p.big_data=".$freegoods_search_kind;
}else if(isset($_POST['search_kind']) && $_POST['search_kind']=="All"){
  $sort_kind="all";
  $sort_kind_sql= "";
}


if(!isset($_GET['mode'])){
$sql="select * from `products`";
}
else if(isset($_GET['mode']) && $_GET['mode']=="view_freegoods"){
$sql="select * from `products` where freegoods='y'";
}
else if(!empty($_POST['freegoods_search_value']) && isset($_POST['freegoods_sort_partner']) && isset($_POST['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y'
 and p.freegoods_agree='y' $sort_kind_sql and p.subject like '%$freegoods_search_value%'";
}
else if(empty($_POST['freegoods_search_value']) && isset($_POST['freegoods_sort_partner']) && isset($_POST['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y' and p.freegoods_agree='y'";
}
else if(!empty($_POST['freegoods_search_value']) && !isset($_POST['freegoods_sort_partner']) && isset($_POST['freegoods_sort_allow'])){
$sql="select * from products where freegoods_agree='y' $sort_kind_sql and subject like '%$freegoods_search_value%'";
}
else if(!empty($_POST['freegoods_search_value']) && isset($_POST['freegoods_sort_partner']) && !isset($_POST['freegoods_sort_allow'])){
$sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y'
 $sort_kind_sql and p.subject like '%$freegoods_search_value%'";
}
else if(empty($_POST['freegoods_search_value']) && !isset($_POST['freegoods_sort_partner']) && isset($_POST['freegoods_sort_allow'])){
$sql="select * from products where freegoods_agree='y'";
}
else if(!empty($_POST['freegoods_search_value']) && !isset($_POST['freegoods_sort_partner']) && !isset($_POST['freegoods_sort_allow'])){
$sql="select * from `products` where subject like '%$freegoods_search_value%' $sort_kind_sql";
}
else if(empty($_POST['freegoods_search_value']) && isset($_POST['freegoods_sort_partner']) && !isset($_POST['freegoods_sort_allow'])){
  $sql="select * from products as p inner join member as m on p.no=m.no where m.partner='y'";
}
else if(empty($_POST['freegoods_search_value']) && !isset($_POST['freegoods_sort_partner']) && !isset($_POST['freegoods_sort_allow'])){
  $sql="select * from products";
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
<script>
function go_free_goods_func(num){
  var result = confirm("freegoods할래여??");
  if(result){
    var num_num=num;
   $.ajax({
     url: './admin_freegoods_dml.php?mode=go_free', // 데이터 보내서 작업되어질 url
     type: 'POST', // get 또는 post로 data를 보냄
     data: {num: num_num}
   })
   .done(function(result_ajax) {
     console.log("success");
   })
   .fail(function() {
     console.log("error");
   })
   .always(function() {
     console.log("complete");
   });
  }
}
</script>

<link rel="stylesheet" href="../css/common.css?ver=1">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/footer_2.css">
<link rel="stylesheet" href="../css/admin.css">
<link rel="stylesheet" href="../css/admin_freegoods.css">
<?php
  include "../lib/header_in_folder.php";
?>

<section id="admin_freegoods_section">
  <div id="admin_member_section_search_div">
    <h1>Select Freegoods / TOTAL : <?=$total_record?></h1>
        <form action="./admin_test.php?mode=search" method="post" id="freegoods_search_form" name="freegoods_search_form">
          <div id="freegoods_search_form_div1">
            <select id="freegoods_search_kind" name="freegoods_search_kind">
            <option value="All">All</option>
            <option value="photos">photos</option>
            <option value="graphics">graphics</option>
            <option value="fonts">fonts</option>
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
    $freegoods_img="../img/hover_logo.png";
  }else{
    $freegoods_img="../img/logo.png";
  }
echo '<div class="img_div">
    <figure class="snip1368">
      <a href="#">
        <img id="main_img" src="../img/'.$img_file_copied1.'" alt="sample30" />
      </a>
      <div class="hover_img" id="hover_img_id">
        <img src="'.$freegoods_img.'" class="go_free_goods_img_class" value="" name="go_free_goods_img" onclick="go_free_goods_func(\''.$num.'\')" style="width:25px; height:25px;"><!--가져다 댔을때-->
      </div>
      <div class="list_title_div">
        <div class="">
          <a href="#" class="">
            <span class="list_title_div_span_bold">'.$subject.'</span>
          </a>
          <a href="#" class="list_title_div_a_float_right">
            M&nbsp; '.$price.'
          </a>
        </div>
        <div class="">
            by&nbsp;<a href="#" class="">'.$email.'</a>
            in&nbsp;<a href="#" class="">'.$big_data.'</a>
        </div>
      </div>
      <figcaption>
        <div class="icons">
          <a href="#">
          <img src="../img/hover_like.png" alt="" style="width:20px; height:20px;" class="checkimg">
          </a><span>&nbsp;&nbsp;Like</span><br>
          <a href="#"><img src="../img/hover_collection.png" alt="" style="width:20px; height:20px;" class="checkimg">
          </a><span>&nbsp;Save</span>
        </div>
      </figcaption>
    </figure>
    </div>
  ';
}
?>
</div>
<br><br>
<hr>
<div id="admin_member_list_div">
  <a href='admin_freegoods.php'>
    <button id="admin_freegoods_button_list" type="button" name="button">LIST</button>
  </a>
  <a href='admin_member.php?mode=view_freegoods'>
    <button id="admin_freegoods_button_list" type="button" name="button">VIEW FREE</button>
  </a>
</div>
<div id="admin_member_next_prev_div">
<?PHP
          #----------------이전블럭 존재시 링크------------------#
          if($start_page > $pages_scale){
             $go_page= $start_page - $pages_scale;
             echo "<a id='before_block' href='message.php?mode=$mode&page=$go_page'> << </a>";
          }
          #----------------이전페이지 존재시 링크------------------#
          if($pre_page){
              echo "<a id='before_page' href='message.php?mode=$mode&page=$pre_page'> < </a>";
          }
           #--------------바로이동하는 페이지를 나열---------------#
          for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
             if($dest_page == $page){
                  echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
              }else{
                  echo "<a id='move_page' href='message.php?mode=$mode&page=$dest_page'>$dest_page</a>";
              }
           }
           #----------------이전페이지 존재시 링크------------------#
           if($next_page){
               echo "<a id='next_page' href='message.php?mode=$mode&page=$next_page'> > </a>";
           }
           #---------------다음페이지를 링크------------------#
          if($total_pages >= $start_page+ $pages_scale){
            $go_page= $start_page+ $pages_scale;
            echo "<a id='next_block' href='message.php?mode=$mode&page=$go_page'> >> </a>";
          }
 ?>
</div>
<br><br>
</section>
<?php
  include "./admin_main_in_folder.php";
  include "../lib/footer_in_folder.php";
  include "../khy_modal/login_modal_in_folder.php";
?>
