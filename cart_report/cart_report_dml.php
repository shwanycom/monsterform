<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
create_table($conn, 'cart');
create_table($conn, 'report');

$member_no = $_SESSION['no'];
// $member_email = $_SESSION['email'];
// $member_username = $_SESSION['username'];
// $member_mon = $_SESSION['mon'];
// $member_partner = $_SESSION['partner'];

if( isset($_GET['mode']) ) {
  if($_GET['mode']=="add_cart"){
    var_dump("add_cart 모드 진입"); echo"<br>";

    $product_num = $_POST['product_num'];
    $mon = $_POST['mon'];
    $cart_img_name = $_POST['cart_img_name'];
    var_dump("POST3개 완료"); echo"<br>";

    $sql="INSERT INTO `cart` VALUES ($member_no,null,$product_num,$mon,'$cart_img_name');";
    var_dump("SQL문 이상 없음"); echo"<br>";

    $result = mysqli_query($conn,$sql);
    var_dump("result 실행 됨"); echo"<br>";

    if (!$result) {
      var_dump("result 에러"); echo"<br>";
      alert_back('5.Error: '.mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    var_dump("result 에러없음"); echo"<br>";
    echo "<script>location.href='../shop/cart.php';</script>";
    var_dump("location작동안됨"); echo"<br>";
  }
}else{
  alert_back("mode를 주세요");
}

?>
