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

  $rows_scale=4;
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
                    $username = $row["username"];
                    $subject = $row["subject"];
                    $price = $row["price"];
                    $cart_img_name = $row["cart_img_name"];
                    $regist_day = date("F d, Y");
										$total_price=$total_price+$price;
                    ?>
          <div class="list_set">
            <div class="cart_list1">
              <a href="./shop_view.php?num=<?=$num?>"><img src="../data/img/<?=$cart_img_name?>" alt="" id="cart_img"></a>
            </div>
            <div class="cart_list2">
              <div class="">
              <span><?=$subject?></span>
              </div>
              <div class="">
              <span>by <?=$username?></span>
              </div>
            </div>
            <div class="cart_list3">
              <div class=""style="background-color:#eef0ef  ">
                <span>ddd</span>
              </div>
            </div>
            <div class="cart_list4">
              <div class="">
                <a href="../cart_report/cart_report_dml.php?mode=delete&p_num=<?=$num?>"><span>x</span></a>
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
      <div id='page_box' style="text-align: center;">
        <?PHP
        #----------------이전블럭 존재시 링크------------------#
        if($start_page > $pages_scale){
          $go_page= $start_page - $pages_scale;
          echo "<a id='before_block' href='cart.php?mode=$mode&page=$go_page'> << </a>";
        }
        #----------------이전페이지 존재시 링크------------------#
        if($pre_page){
          echo "<a id='before_page' href='cart.php?mode=$mode&page=$pre_page'> < </a>";
        }
        #--------------바로이동하는 페이지를 나열---------------#
        for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
          if($dest_page == $page){
            echo( "&nbsp;<b id='present_page'>&nbsp;&nbsp;$dest_page&nbsp;&nbsp;</b>&nbsp" );
          }else{
            echo "<a id='move_page' href='cart.php?mode=$mode&page=$dest_page'>&nbsp;&nbsp;$dest_page&nbsp;&nbsp;</a>";
          }
        }
        #----------------이전페이지 존재시 링크------------------#
        if($next_page){
          echo "<a id='next_page' href='cart.php?mode=$mode&page=$next_page'> > </a>";
        }
        #---------------다음페이지를 링크------------------#
        if($total_pages >= $start_page+ $pages_scale){
          $go_page= $start_page+ $pages_scale;
          echo "<a id='next_block' href='cart.php?mode=$mode&page=$go_page'> >> </a>";
        }
        ?>
      </div>
        </div>
        </div>
    </div>
    <?php
   include "../lib/footer_in_folder.php";
   ?>
  </body>
</html>
