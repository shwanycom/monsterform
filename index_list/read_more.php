<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

define('SCALE', 27);

$plus = intval($_POST["scale"]);

if(isset($_GET["freegoods"])){
  $freegoods=$_GET["freegoods"];
  if($freegoods=='y'){
    $freegoods_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
  if($handpicked=='y'){
    $handpicked_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["popular"])){
  $popular=$_GET["popular"];
  if($popular=='y'){
    $popular_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["big_data"])){
  $big_data=$_GET["big_data"];
}

if(isset($_GET["big_data"]) && $_GET["big_data"]!='none'){

  if($freegoods=='n' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' order by num desc;";
  }else if($freegoods=='n' && $handpicked=='y' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' and handpicked='y' order by num desc;";
  }else if($freegoods=='n' && $handpicked=='n' && $popular=='y'){
    $sql = "SELECT * from `products` where big_data = '$big_data' order by hit desc;";
  }else if($freegoods=='y' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' and freegoods='y' order by num desc";
  }else{
    $sql = "SELECT * from `products` where big_data = '$big_data' order by num desc;";
  }

}else{

  if($freegoods=='n' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` order by num desc;";
  }else if($freegoods=='n' && $handpicked=='y' && $popular=='n'){
    $sql = "SELECT * from `products` where handpicked='y' order by num desc;";
  }else if($freegoods=='n' && $handpicked=='n' && $popular=='y'){
    $sql = "SELECT * from `products` order by hit desc;";
  }else if($freegoods=='y' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where freegoods='y' order by num desc";
  }else{
    $sql = "SELECT * from `products` order by num desc;";
  }
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

for($i=$plus;($i<$plus+SCALE) && $i<$total_record ; $i++){
  mysqli_data_seek($result, $i);
// 하나 레코드 가져오기
  $row = mysqli_fetch_array($result);
  $item_num = $row["num"];
  $item_name = $row["username"];
  $price = $row["price"];
  $item_price = $price/100;
  $item_email = $row["email"];

  $img_copy_name0 = $row["img_file_copied1"];

  $item_hit = $row["hit"];
  $item_date = $row["regist_day"];
  $item_date = substr($item_date, 0, 10);
  $item_subject = str_replace(" ", "&nbsp;", $row["subject"]);

  // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
  if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
      $main_img = $img_copy_name0;

  }

  echo '<div class="img_div">
    <figure class="snip1368">
      <a href="#">
        <img id="main_img" src="../img/openmarket.png" alt="sample30" />
      </a>
      <div class="hover_img">
        <img src="../img/logo.png" alt="" style="width:25px; height:25px;">
      </div>
      <div class="list_title_div">
        <div class="">
          <a href="#" class="">
            <span class="list_title_div_span_bold">'.$item_subject.'</span>
          </a>
          <a href="#" class="list_title_div_a_float_right">
            M&nbsp; '.$item_price.'
          </a>
        </div>
        <div class="">
            by&nbsp;<a href="#" class="">'.$item_email.'</a>
            in&nbsp;<a href="#" class="">'.$big_data.'</a>
        </div>
      </div>
      <figcaption>
        <div class="icons">
          <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Like</span> <br>
          <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Save</span>
        </div>
      </figcaption>
    </figure>
  </div>';
  $number --;
}

 ?>
