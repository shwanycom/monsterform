<script type="text/javascript">
$(document).ready(function() {
  $(".likes_img_class").click(function(event) {
    var n = $(".likes_img_class").index(this);
    var num_num = $(".hidden_num:eq("+n+")").val();
    var likes_img_value = $(".likes_img_value:eq("+n+")").val();
    console.log(n);
    console.log(num_num);
    console.log(likes_img_value);
     $.ajax({
       url: './lib/like_dml.php?mode=go_like', // 데이터 보내서 작업되어질 url
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
         if($(".likes_img_class:eq("+n+")").attr("src")!="./img/hover_like.png"){
           $(".likes_img_class:eq("+n+")").attr("src", "./img/hover_like.png");
         }else{
           $(".likes_img_class:eq("+n+")").attr("src", "./img/like.png");
          }
          console.log($(".likes_img_class:eq("+n+")").attr("src"));
        if($(".likes_img_value:eq("+n+")").val()=='y'){
          $(".likes_img_value:eq("+n+")").val('n');
        }else{
          $(".likes_img_value:eq("+n+")").val('y');
        }
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
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

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
  // 가져올 레코드 위치 이동
     mysqli_data_seek($result, $i);

  // 하나 레코드 가져오기
     $row = mysqli_fetch_array($result);
     $item_no = $row["no"];
     $item_num = $row["num"];
     $item_name = $row["username"];
     $item_price = $row["price"];
     $item_email = $row["email"];
     $img_copy_name1 = $row["img_file_copied1"];
     $img_copy_name1 = "./data/img/".$img_copy_name1;
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
       $freegoods_img="./img/hover_logo.png";
     }else{
       $freegoods_img="./img/free_partner_logo.png";
     }

     if(isset($member_no)){
       $sql_likes = "SELECT product_num from likes where no = '$member_no';";
       $result_likes = mysqli_query($conn, $sql_likes);
       $total_record_likes = mysqli_num_rows($result_likes);

       $likes_img = "./img/hover_like.png";
       $likes_img_value = "n";

       for($j=0;$j<$total_record_likes;$j++){
         mysqli_data_seek($result_likes, $j);
         $row_likes = mysqli_fetch_array($result_likes);
         $likes = $row_likes['product_num'];
         if($likes == $item_num){
           $likes_img = "./img/like.png";
           $likes_img_value = "y";
           break;
         }
       }
     }else{
       $likes_img = "";
       $likes_img_value = '';
     }

     // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
     if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
         $main_img = $img_copy_name0;
     }

  echo '<div class="img_div">
    <figure class="snip1368">
      <a href="./shop/shop_view.php?num='.$item_num.'">
        <img id="main_img" src="'.$img_copy_name1.'" alt="sample30" />
      </a>
      <div class="hover_img">
        <img src="'.$freegoods_img.'" alt="" style="width:25px; height:25px;">
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
            by&nbsp;<a href="./member_profile/profile_view.php?mode=shop&email='.$item_email.'" class="">'.$item_email.'</a>
            in&nbsp;<a href="./product_list/list.php?big_data='.$item_big_data.'" class="">'.$item_big_data.'</a>
        </div>
      </div>
      <figcaption>
        <div class="icons">
        <input type="hidden" class="hidden_num" value="'.$item_num.'">
        <img class="likes_img_class" src="'.$likes_img.'" alt="" style="width:25px; height:25px;"><br>
        <input type="hidden" class="likes_img_value" value="'.$likes_img_value.'">
        </div>
      </figcaption>
    </figure>
  </div>';
  $number --;
}

 ?>
