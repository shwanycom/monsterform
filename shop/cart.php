<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";


if(!isset($_SESSION['email'])){
echo "<script> alert('회원만 이용 가능 합니다.'); history.go(-1); </script>";
exit;
}

if(isset($_SESSION['email'])){
  $email = $_SESSION['email'];
  $point1 = $_SESSION['mon'];
	$no=$_SESSION['no'];
	$member_username = $_SESSION['username'];
}
	$regist_day = date("F d, Y");
	$total_price=$mode="";


	$sql="select * from cart c inner join products p on c.product_num=p.num where c.no=$no;";
  $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
  $total_record = mysqli_num_rows($result); //전체 레코드 수


  $rows_scale=50;
  $pages_scale=3;

  $total_pages= ceil($total_record/$rows_scale);

  if(empty($_GET['page'])){
      $page=1;
  }else{
      $page = $_GET['page'];
  }

  $start_row= $rows_scale * ($page -1) ;

  $pre_page= $page>1 ? $page-1 : NULL;

  $next_page= $page < $total_pages ? $page+1 : NULL;

  $start_page= (ceil($page / $pages_scale ) -1 ) * $pages_scale +1 ;

  $end_page= ($total_pages >= ($start_page + $pages_scale)) ? $start_page + $pages_scale-1 : $total_pages;

  $number=$total_record- $start_row;

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/cart.css">

  </head>
  <body>
      <?php include "../lib/header_in_folder.php";?>
    <section class="shop_main">
      <div class="center_shop_div">
      <div class="Shopping_cart">
        <span style="font-size:20pt;">Your Cart</span>
      </div>
      <div class="cart_total">

      <div class="list_cart">

        <?php

    			// 모든 레코드를 가져오는 로직
    			for ($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
                 // 가져올 레코드 위치 이동
                    mysqli_data_seek($result, $i);

                 // 하나 레코드 가져오기
                    $row = mysqli_fetch_array($result);
                    $num = $row["num"];
                    $product_num = $row["product_num"];
                    $username = $row["username"];
                    $subject = $row["subject"];
                    $price = $row["price"];
                    $cart_img_name = $row["cart_img_name"];
                    $regist_day = date("F d, Y");
                    $total_price+=$price;

                    ?>
          <div class="list_set">
            <div class="cart_list1">
              <img src="../data/img/<?=$cart_img_name?>" alt="" id="cart_img">
            </div>
            <div class="cart_list2">
              <div class="">
              <a href="#"><span id="subject_span"><?=$subject?></span></a>
              </div>

            </div>
            <div class="cart_list3">
              <div class="">
                <span id="span_by">by</span> <a href="#"> <span id="span_name"> <?=$username?></span></a>
              </div>
            </div>
            <div class="cart_list4">
              <div class="">
                <a href="./delete_cart.php?product_num=<?=$product_num?>"><span>x</span></a>
              </div>
            </div>
            <div class="cart_list5">
            <span><?=$price?>  Mon</span>
            </div>
          </div>
          <?php
             $number --;
         }

         ?>
      </div>
      <div class="payment_list">
        <div class="total_amount">
        <span id="total_price_span">Total  Mon <br> <?=$total_price?> </span>
        </div>
        <div class="id_regist_div">
          <span class="id_regist_span"> <?=$member_username?></span>
        </div>
        <div class="id_regist_div">
          <span class="id_regist_span">Date : <?=$regist_day?></span>
        </div>
        <div class="purchase_kakao">
            <input type="submit" id="cart_payment" value="Finish Purchase" onclick="check_input1()" >
        </div>
      </div>
    <!--페이지 박스 넣고싶으면 여기다 넣어야 된다.-->
        </div>
        </div>
    </section>
    <?php
    include "../lib/footer_in_folder.php";
    include "../khy_modal/login_modal_in_folder.php";
    if(!isset($_SESSION['no'])) {
      ?>
      <script>
        auto_modal();
      </script>
      <?php
    }
    ?>
  </body>
</html>
