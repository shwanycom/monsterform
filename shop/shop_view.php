<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
create_table($conn, "discussion"); //가입인사 게시판 테이블 생성
?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/shop_view.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
  integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay" crossorigin="anonymous">

  <!-- <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css"> -->

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
  <title></title>
</head>
<body>
  <?php
  include "../lib/header_in_folder.php";
  ?>
  <!--============================================================================== -->

  <div class="wrap">
    <div class="category">
      <a href="#">Fonts</a> > <a href="#">Script</a>
    </div>

    <div class="container_joon">
      <div id="div1">
        <div class="gal">
          <img class="mySlides" src="./product_img/fonts/red1.png" style="width:100%; ">
          <img class="mySlides" src="./product_img/fonts/red2.png" style="width:100%; display:none">
          <img class="mySlides" src="./product_img/fonts/red3.png" style="width:100%; display:none">
          <img class="mySlides" src="./product_img/fonts/red4.png" style="width:100%; display:none">
        </div>

        <div class="minigal_set">
          <div class="minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red1.png" style="width:100%;cursor:pointer" onclick="currentDiv(1)">
          </div>
          <div class="minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red2.png" style="width:100%;cursor:pointer" onclick="currentDiv(2)">
          </div>
          <div class="minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red3.png" style="width:100%;cursor:pointer" onclick="currentDiv(3)">
          </div>
          <div class="minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red4.png" style="width:100%;cursor:pointer" onclick="currentDiv(4)">
          </div>
        </div>
      </div><!-- end of div1 -->
      <div id="div2">
        <div class="file_info" id="file_type">
          <h2 style="font-size:20px; color:#afaeae;">File Type</h2>
          <div class="show_info" >
            <i class="far fa-file" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;">OTF, TTF</span>
          </div>
        </div>
        <div class="file_info" id="file_size">
          <h2 style="font-size:20px; color:#afaeae;" >File Size</h2>
          <div class="show_info">
            <i class="fas fa-dumbbell" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;">251.9MB</span>
          </div>
        </div>
      </div><!-- end of div2 -->

      <!-- end of div3 -->

      <!-- end of div4 -->
      <div id="div5">
        <h2 style="color: #7d7b78; margin-top:30px">Detail</h2>
      </div><!-- end of div5 -->

      <div id="div6">
        <h2 style="color: #7d7b78; margin-top:30px">Frequency Question</h2>        
      </div><!-- end of div6 -->
    </div><!-- end of container -->


    <div class="narrow">

    <div class="purchase">

    </div><!-- end of purcahse -->
  </div><!-- end of narrow -->


  </div><!-- end of wrap -->
  <!--============================================================================== -->
  <?php
  include "../lib/footer_in_folder.php";
  include "../khy_modal/login_modal_in_folder.php";
  ?>
</body>
</html>
