<?php
session_start();
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
$memeber_no = $_SESSION['no'];
$memeber_email = $_SESSION['email'];
$memeber_username = $_SESSION['username'];
$member_mon = $_SESSION['mon'];
$member_partner = $_SESSION['partner'];
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/common.css?ver=1">
    <link rel="stylesheet" href="./css/footer.css">
    <link rel="stylesheet" href="./css/footer_2.css">
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
    body{
      margin: 0; padding: 0;
    }
    </style>
  </head>
  <body>
    <?php
    include "./lib/header.php";
    include "./lib/section_text_category.php";
    include "./lib/section_categories_section.php";
    include './lib/footer_2.php';
    include "./lib/footer.php";
    ?>
    <?php
    include "./khy_modal/khy_modal_modaltest.php";
    ?>
  </body>
</html>
