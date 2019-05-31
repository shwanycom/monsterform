<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
if(isset($_SESSION['no'])){
  $member_no = $_SESSION['no'];
  $member_email = $_SESSION['email'];
  $member_username = $_SESSION['username'];
  $member_mon = $_SESSION['mon'];
  $member_partner = $_SESSION['partner'];
}
create_table($conn, 'member');
create_table($conn, 'cart');
create_table($conn, 'discussion');
create_table($conn, 'discussion_ripple');
create_table($conn, 'follow');
create_table($conn, 'likes');
create_table($conn, 'products');
create_table($conn, 'freegoods_date');
create_table($conn, 'report');
create_table($conn, 'sales');
create_table($conn, 'message');
create_table($conn, 'message_ripple');
create_table($conn, 'collections');

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/footer_2.css">
    <link rel="stylesheet" href="./css/admin.css">
    <link rel="stylesheet" href="./css/index_point.css?">
    <link rel="stylesheet" href="./css/common.css?ver=1">
    <title></title>
    <style media="screen">

    </style>
  </head>
  <body>
    <?php
    include "./lib/header.php";
    if(isset($_SESSION['email'])){
      include "./lib/section_text_category.php";
      include "./point/index_point.php";
    }else{
      include "./lib/section_text_category.php";
    }


    include "./lib/section_categories_section.php";
    include "./index_list/index_list.php";
    include './lib/footer_2.php';
    if(isset($_SESSION['email']) && $_SESSION['email']=='admin@gmail.com'){
      include "./admin/admin_main.php";
    }
    include "./lib/footer.php";
    ?>
    <?php
    include "./khy_modal/index_login_modal.php";
    ?>
  </body>
</html>
