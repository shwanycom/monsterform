<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
create_table($conn, "discussion"); //가입인사 게시판 테이블 생성
?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/shop_view.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
   integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
   crossorigin="anonymous">

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
      var x = document.getElementsByClassName("shop_view_mySlides");
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

  <?php
  include "../lib/header_in_folder.php";
  ?>
  <!--============================================================================== -->
  <div class="shop_view_wrap">
    <div class="shop_view_category">
      <a href="#">Fonts</a> > <a href="#">Script</a>
    </div>

    <div class="shop_view_container">
      <div id="shop_view_div1">
        <div class="shop_view_gal">
          <img class="shop_view_mySlides" src="./product_img/fonts/red1.png" style="width:100%; ">
          <img class="shop_view_mySlides" src="./product_img/fonts/red2.png" style="width:100%; display:none">
          <img class="shop_view_mySlides" src="./product_img/fonts/red3.png" style="width:100%; display:none">
          <img class="shop_view_mySlides" src="./product_img/fonts/red4.png" style="width:100%; display:none">
        </div>

        <div class="shop_view_minigal_set">
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red1.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(1)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red2.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(2)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red3.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(3)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./product_img/fonts/red4.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(4)">
          </div>
        </div>
      </div><!-- end of div1 -->
      <div id="shop_view_div2">
        <div class="shop_view_file_info" id="file_type">
          <h2 style="font-size:20px; color:#afaeae;">File Type</h2>
          <div class="shop_view_show_info" >
            <i class="far fa-file" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;">OTF, TTF</span>
          </div>
        </div>
        <div class="shop_view_file_info" id="file_size">
          <h2 style="font-size:20px; color:#afaeae;" >File Size</h2>
          <div class="shop_view_show_info">
            <i class="fas fa-dumbbell" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;">251.9MB</span>
          </div>
        </div>
      </div><!-- end of div2 -->

      <!-- end of div3 -->

      <!-- end of div4 -->
      <div id="shop_view_detail">
        <h2 style="color: #7d7b78; margin-top:30px; text-align:left">Details</h2>
        <p><b>Pistoletto Free </b> </p>
        <p>1 style Pistoletto regular latin <br>
            TTF OTF WOFF WOFF2 EOT <br>
            Check out full Pistoletto Family <br>
            https://crmrkt.com/avpyGN with Extended latin,  <br>
            Ligatures and Swashes More of all it has all styles included into family.<br>
      </div><!-- end of div5 -->

      <div id="shop_view_qna">
        <h2 style="color: #7d7b78; margin-top:30px; text-align:left" >Frequency Question</h2>
        <p><b>How do I contact support? </b> </p>
        <p>If you need help with the product, please contact <br>
          the shop owner by visiting their shop profile and <br>
          sending them a message. For anything else (licensing,<br>
           billing, etc), please visit our Help Center.<br></p><br><br>
        <p><b>How can I unzip product files? </b> </p>
        <p>PC: To extract a single file or folder, double-click the compressed folder to open it.<br>
           Then, drag the file or folder from the compressed folder to a new location. <br>
           To extract the entire contents of the compressed folder, right-click the folder,<br>
            click Extract All, and then follow the instructions.<br>
<br><br>
Mac: Double click the .zip file, then search for the product folder or product file.<br>
<br><br>
If you continue to have trouble, check out this help file for more tips.<br></p><br>
        <p><b>How do I install a font? </b> </p>
        <p> After you unzip your font product files, you will see .OTF or .TTF files. <br>
          To install a font, just double click on the OTF or TTF file. For more information, check out our Font FAQ.<br>
<br><br>
If you’re still having trouble installing the font,<br>
 please contact the Shop Owner or Creative Market Support.<br></p>
      </div><!-- end of div6 -->
    </div><!-- end of container -->

    <div class="shop_view_narrow">
      <div class="shop_view_sticky">

        <div class="shop_view_sticky_outter" id="shop_view_sticky_product_info">
          <div class="shop_view_sticky_inner" style="border-bottom:1px solid #c1bebe; padding-bottom:4%; height: 100%;">
            <h2 style="text-align:left;">Pistoletto Regular</h2>
            <p style="text-align:right;"><span style="color: #7d7b78;"><i>By</i> </span> <span>Etewut</span></p>
            <p style="text-align:right; color: #7d7b78;"><i>MAY 23, 2019</i></p>
          </div>
        </div><!-- end of shop_view_sticky_product_info -->

        <div class="shop_view_sticky_outter" id="shop_view_sticky_purchase">
          <div class="shop_view_sticky_inner" style="height: 30%; color: #7d7b78;">
            <span style="text-align:left;"></span>price<span style="text-align:right;">20 MON</span> 
          </div>
          <div class="shop_view_sticky_inner" style="height: 65%;">          </div>
        </div><!-- end of shop_view_sticky_purchase -->

      </div><!-- end of shop_view_sticky -->
    </div><!-- end of shop_view_narrow -->
  </div><!-- end of wrap -->

  <!--============================================================================== -->
  <?php
  include "../lib/footer_in_folder.php";
  include "../khy_modal/login_modal_in_folder.php";
  ?>
