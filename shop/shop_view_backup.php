<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
create_table($conn, "discussion"); //가입인사 게시판 테이블 생성
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/shop_view.css">
  <link rel="stylesheet" href="../css/footer.css">

  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">

  <script type="text/javascript" src="../js/monsterform.js"></script>
  <script type="text/javascript">
   var value="";
   function select(value){
   var text = ""+value;
   document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
   }
   function mouse_over(){
     document.getElementById('change_img').src="../img/up.png";
   }
   function mouse_out(){
     document.getElementById('change_img').src="../img/down.png";
   }
   </script>
  <title></title>
</head>
<body>
  <?php
  include "../lib/header_in_folder.php";
  ?>
  <!--============================================================================== -->
  <!-- <div class="relative"> -->
  <div class="outter">
    <div class="category">
      <a href="#">Fonts</a> > <a href="#">Script</a>
    </div>
    <div class="content" id="div1">
      <!-- <img class="image" src="./product_img/fonts/red1.png" lazy="loaded"> -->
      <div class="w3-content" style="max-width:1200px">
        <img class="mySlides" src="product_img\fonts\red1.png" style="width:100%;">
        <img class="mySlides" src="product_img\fonts\red2.png" style="width:100%;display:none">
        <img class="mySlides" src="product_img\fonts\red3.png" style="width:100%;display:none">
        <img class="mySlides" src="product_img\fonts\red4.png" style="width:100%;display:none">

        <div class="w3-row-padding w3-section" style="padding:0px">
          <div class="w3-col s4" style="padding:0px">
            <img class="demo w3-opacity w3-hover-opacity-off" src="product_img\fonts\red1.png" style="width:100%;cursor:pointer" onclick="currentDiv(1)">
          </div>
          <div class="w3-col s4" style="padding:0px">
            <img class="demo w3-opacity w3-hover-opacity-off" src="product_img\fonts\red2.png" style="width:100%;cursor:pointer" onclick="currentDiv(2)">
          </div>
          <div class="w3-col s4" style="padding:0px">
            <img class="demo w3-opacity w3-hover-opacity-off" src="product_img\fonts\red3.png" style="width:100%;cursor:pointer" onclick="currentDiv(3)">
          </div>
          <div class="w3-col s4" style="padding:0px">
            <img class="demo w3-opacity w3-hover-opacity-off" src="product_img\fonts\red4.png" style="width:100%;cursor:pointer" onclick="currentDiv(3)">
          </div>
        </div>
        </div>

      <script>
      function currentDiv(n) {
        showDivs(slideIndex = n);
      }

      function showDivs(n) {
        var i;
        var x = document.getElementsByClassName("mySlides");
        var dots = document.getElementsByClassName("demo");
        if (n > x.length) {slideIndex = 1}
        if (n < 1) {slideIndex = x.length}
        for (i = 0; i < x.length; i++) {
          x[i].style.display = "none";
        }
        for (i = 0; i < dots.length; i++) {
          dots[i].className = dots[i].className.replace(" w3-opacity-off", "");
        }
        x[slideIndex-1].style.display = "block";
        dots[slideIndex-1].className += " w3-opacity-off";
      }
      </script>
    </div>

    <div class="content" id="div2">

    </div>

    <div class="content" id="div3">
    </div>

    <div class="content" id="div4">
    </div>

    <div class="content" id="div5">
    </div>

    <div class="content" id="div6">
    </div>
    </div><!-- end of narrow -->

  <div class="purchase">
    <table style="width:100%">
      <tr>
        <td>Pstoletto Regular</td>
      </tr>
      <tr>
        <td>By <a href="#">Joon</a> </td>
      </tr>
      <tr>
        <td>MAY 22, 2019</td>
      </tr>
      <tr>
        <td><a href="#"> 13 Revies</a></td>
      </tr>
      <hr>
      <tr>
        <td>price : 30MON</td>
      </tr>
      <tr>
        <td><button type="button" name="button" style="width:80%">Free Download</button> </td>
      </tr>
    </table>
  </div>
  </div>
  </div><!-- end of outter -->
  <!--============================================================================== -->
  <?php
  include "../lib/footer_in_folder.php";
  include "../khy_modal/login_modal_in_folder.php";
  ?>
</body>
</html>
