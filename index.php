<?php
session_start();


?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <link rel="stylesheet" href="./css/common.css">
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
    include "./lib/header_logout_form.php";
    include "./lib/footer.php";
    ?>
    <?php
    include "./khy_modal/khy_modal_modaltest.php";
    ?>



  </body>
</html>
