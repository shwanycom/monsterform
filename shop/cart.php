<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";


if(!isset($_SESSION['email'])){
echo "<script> alert('회원만 이용 가능 합니다.'); history.go(-1); </script>";
exit;
}
$mode="";
$no=$_SESSION['no'];
var_dump($no);

	$sql="select * from cart where no='$no';";
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
    <div class="shop_main">
      <div class="center_shop_div">
      <div class="Shopping_cart">
        <span>Your Cart</span>
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
                    $price = $row["price"];
                    $cart_img_name = $row["cart_img_name"];



                    // 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
                    if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
                        $main_img = $img_copy_name0;

                    }
                    ?>
          <div class="list_set">
            <div class="cart_list1">
              <img src="./data/<?=$cart_img_name?>" alt="" id="cart_img">
            </div>
            <div class="cart_list2">
              <div class="">
              <span>Mogan Font + Extras </span>
              </div>
              <div class="">
              <span>by</span>
              </div>
            </div>
            <div class="cart_list3">
              <div class=""style="background-color:#eef0ef  ">
                <span>ddd</span>
              </div>
            </div>
            <div class="cart_list4">
              <div class="">
                <input type="text" name="" value="1" style="width:30px; text-align:center;"><span> seats</span>
              </div>
              <div class="">
                <a href="#">remove</a>
              </div>
            </div>
            <div class="cart_list5">
                \<?=$price?>
            </div>
          </div>
          <?php
             $number --;

         }
         ?>

      </div>
      <div class="payment_list">
        <div class="total_amount">
          total: sdf
        </div>
        아이디/
        날짜/
        <div class="purchase_kakao">
            <input type="submit" id="cart_payment" value="결제" onclick="check_input1()" >
        </div>
      </div>
        </div>
        </div>
    </div>
     <?php
    include "../lib/footer_in_folder.php";
    ?>
  </body>
</html>
