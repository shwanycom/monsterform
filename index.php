<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
if(isset($_SESSION['no'])){
  $memeber_no = $_SESSION['no'];
  $member_email = $_SESSION['email'];
  $member_username = $_SESSION['username'];
  $member_mon = $_SESSION['mon'];
  $member_partner = $_SESSION['partner'];
}

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
    @font-face{
    	font-family:"ninab"; /*폰트 패밀리 이름 추가*/
    	src:url("./font/ninab.TTF"); /*폰트 파일 주소*/
    }
    @font-face{
    	font-family:"nina"; /*폰트 패밀리 이름 추가*/
    	src:url("./font/nina.TTF"); /*폰트 파일 주소*/
    }
    </style>
  </head>
  <body>
    <?php
    include "./lib/header.php";
    if(isset($_SESSION['username'])){
      include "./point/index_point.php";
    }else{
      include "./lib/section_text_category.php";
    }

    include "./lib/section_categories_section.php";
    include './lib/footer_2.php';
    if(isset($_SESSION['username']) && $_SESSION['username']=='admin'){
      include "./admin/admin_main.php";
    }
    include "./lib/footer.php";
    ?>
    <?php
    include "./khy_modal/index_login_modal.php";
    ?>
  </body>
</html>
