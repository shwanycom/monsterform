<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
create_table($conn, 'cart');
create_table($conn, 'report');
create_table($conn, 'collections');

// $member_no = $_SESSION['no'];
// $member_email = $_SESSION['email'];
// $member_username = $_SESSION['username'];
// $member_mon = $_SESSION['mon'];
// $member_partner = $_SESSION['partner'];

if( isset($_GET['mode']) ) {
  if($_GET['mode']=="delete") {
    $product_num = $_GET['p_num'];
    $sql="DELETE from `cart` where `no`=$member_no && `product_num`=$product_num;";
    $result = mysqli_query($conn,$sql);
    if(!$result) {
      alert_back('5.Error: '.mysqli_error($conn));
    }
    echo "<script>location.href='../shop/cart.php';</script>";
  }else{
    $product_num_set = $_POST['product_num_set'];
    $product_num_array = explode("/", $product_num_set);
    $repeat_purchase = sizeof($product_num_array);
    $mon = $_POST['mon'];
    if($_GET['mode']=="add_cart"){
      $cart_img_name = $_POST['cart_img_name'];
    }
    $regist_day = date("Y-m-d");

    var_export("product_num_set : ".$product_num_set); echo "<br>";
    var_export("product_num_array : ".$product_num_array); echo "<br>";
    var_export("repeat_purchase : ".$repeat_purchase); echo "<br>";
    var_export("mon : ".$mon); echo "<br>";
    var_export("cart_img_name : ".$cart_img_name); echo "<br>";
    var_export("regist_day : ".$regist_day); echo "<br>";
    var_export("member_no : ".$member_no); echo "<br><br>";

    if($_GET['mode']=="add_cart"){
      $product_num=$product_num_array[1];
      $sql="INSERT INTO `cart` VALUES ($member_no,null,$product_num,$mon,'$cart_img_name');";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        alert_back('5.Error: '.mysqli_error($conn));
      }
      echo "<script>location.href='../shop/cart.php';</script>";
    }else if ($_GET['mode']=="purchase") {
      for($i=1 ; $i<$repeat_purchase; $i++){
        $product_num=$product_num_array[$i];
        $sql = "SELECT `products`.`price`,`member`.`point_mon` from `products` inner join `member` where `num`=$product_num && `member`.`no`=$member_no;";
        $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
        $row = mysqli_fetch_array($result);
        $price = $row['price'];
        $user_mon = $row['point_mon'];
        if($user_mon<$price){
          echo "<script>alert('Mon이 부족합니다!');</script>";
          echo "<script>location.href='../point/point_main.php';</script>";
        }else{
          //var_export("product_num : ".$product_num); echo "<br>";
          //===========================================1.구매내역등록=============================================
          $sql="INSERT INTO `report` VALUES ($product_num,$mon,'$regist_day',$member_no);";
          $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

          //========================================== 1-1.collection등록 ===========================================
          $sql="SELECT * from `products` where `num`=$product_num;";
          $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
          $row = mysqli_fetch_array($result);
          $buy_no = $member_no;
          $pro_no = $row['no'];
          $pro_num = $product_num;
          $pro_email = $row['email'];
          $pro_subject = $row['subject'];
          $date = date_create($regist_day);
          $buy_regist_day = date_format($date,"Y-m-d");
          $pro_price = $row['price'];
          $pro_handpicked = $row['handpicked'];
          $pro_freegoods = $row['freegoods'];
          $pro_hit = $row['hit'];
          $pro_big_data = $row['big_data'];
          $pro_img_file_copied = $row['img_file_copied1'];

$sql="INSERT INTO `collections` VALUES (
$buy_no,$pro_no,$pro_num,'$pro_email','$pro_subject','$buy_regist_day',$pro_price,'$pro_handpicked','$pro_freegoods',
$pro_hit,'$pro_big_data','$pro_img_file_copied');";
          $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

          //===========================================2.Mon 차감================================================
          $sql = "UPDATE `member` set `point_mon`=`point_mon`-$mon where `no` = $member_no;";
          $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

          //===========================================3.장바구니에서 제품번호검색=============================================
          $sql="SELECT * from `cart` where `no`=$member_no && `product_num`=$product_num;";
          $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
          $row=mysqli_fetch_array($result);
          //===========================================4.장바구니에 제품번호 있으면 삭제========================================
          if($row){
            $sql="DELETE from `cart` where `no`=$member_no && `product_num`=$product_num;";
            $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
          }
        }
      }//end of repeat for

      //=======================================구매모드를 눌렀던 곳으로 리다이렉션=============================================
      if($_GET['from']=="view"){
        echo "<script>location.href='../shop/shop_view.php?num=".$product_num."';</script>";
      }else if($_GET['from']=="cart"){
        echo "<script>location.href='../member_profile/profile_view.php?mode=collections&email=".$member_email."';</script>";
      }
    }
  }
}else{
  alert_back("mode를 주세요");
}

?>
