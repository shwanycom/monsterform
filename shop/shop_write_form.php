<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
// session_start();
// if(isset($_SESSION['no'])){
// $memeber_no = $_SESSION['no'];
// $member_email = $_SESSION['email'];
// $memeber_username = $_SESSION['username'];
// $member_mon = $_SESSION['mon'];
// $member_partner = $_SESSION['partner'];
// }
create_table($conn, "products"); //가입인사 게시판 테이블 생성
?>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/common.css">
<link rel="stylesheet" href="../css/shop_write_form.css">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
 integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
 crossorigin="anonymous">
<script type="text/javascript" src="../js/monsterform.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="jquery-3.4.0.min.js"></script>

<script>
  function currentDiv(n) {
    showDivs(slideIndex = n);
  }
  function showDivs(n) {
    var i;
    var x = document.getElementsByClassName("shop_write_mySlides");
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

<script>
  var loadFile1 = function(event) {
    var mini = document.getElementById('shop_write_mini1');
    var gal = document.getElementById('shop_write_gal1');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFile2 = function(event) {
    var mini = document.getElementById('shop_write_mini2');
    var gal = document.getElementById('shop_write_gal2');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFile3 = function(event) {
    var mini = document.getElementById('shop_write_mini3');
    var gal = document.getElementById('shop_write_gal3');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
  };
  var loadFile4 = function(event) {
    var output = document.getElementById('shop_write_mini4');
    var gal = document.getElementById('shop_write_gal4');
    output.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
  };
</script>
<?php
include "../lib/header_in_folder.php";
?>
<!--============================================================================== -->
<div class="shop_write_wrap">
  <form name="board_form" action="dml_board.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
  <div class="shop_write_category">
    <input class="shop_write_text" type="text" name="" placeholder="Add Title..." id="shop_write_title"><br>
    <span><i>by </i></span><span style="font-size:1.2em"><b>Kaka Laws </b></span><span> in
    <select class="shop_write_select" name="" id="shop_write_select">
      <option value="" disabled selected>Choose Category</option>
      <option value="volvo">Photos</option>
      <option value="saab">Graphics</option>
      <option value="mercedes">Fonts</option>
    </select>
  </div>

  <div class="shop_write_container">
    <div id="shop_write_div1">
      <div class="shop_write_gal">
        <img class="shop_write_mySlides" id="shop_write_gal1" src="./data/red1.png" style="width:100%; ">
        <img class="shop_write_mySlides" id="shop_write_gal2" src="./data/red2.png" style="width:100%; display:none">
        <img class="shop_write_mySlides" id="shop_write_gal3" src="./data/red3.png" style="width:100%; display:none">
        <img class="shop_write_mySlides" id="shop_write_gal4" src="./data/red4.png" style="width:100%; display:none">
      </div>

      <div class="shop_write_minigal_set">
        <div class="shop_write_minigal">
          <img class="demo w3-opacity w3-hover-opacity-off" src="./data/red1.png"
          style="width:100%;cursor:pointer" onclick="currentDiv(1)" id="shop_write_mini1">
          <input type="file" name="upfile" accept="image/*" onchange="loadFile1(event)">
        </div>
        <div class="shop_write_minigal">
          <img class="demo w3-opacity w3-hover-opacity-off" src="./data/red2.png"
          style="width:100%;cursor:pointer" onclick="currentDiv(2)" id="shop_write_mini2">
          <input type="file" name="upfile" accept="image/*" onchange="loadFile2(event)" >
        </div>
        <div class="shop_write_minigal">
          <img class="demo w3-opacity w3-hover-opacity-off" src="./data/red3.png"
          style="width:100%;cursor:pointer" onclick="currentDiv(3)" id="shop_write_mini3">
          <input type="file" name="upfile" accept="image/*" onchange="loadFile3(event)">
        </div>
        <div class="shop_write_minigal">
          <img class="demo w3-opacity w3-hover-opacity-off" src="./data/red4.png"
          style="width:100%;cursor:pointer" onclick="currentDiv(4)" id="shop_write_mini4">
          <input type="file" name="upfile" accept="image/*" onchange="loadFile4(event)">
        </div>
      </div>
    </div><!-- end of div1 -->
    <div id="shop_write_div2" style="padding-bottom:35px;">
      <h2 style="font-size:20px; color:#afaeae; text-align:left">File Type</h2>
      <i class="far fa-file" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
      <!-- <input class="shop_write_text" type="text" name="" style="font-size:20px; color:#797979"> -->
      <input class="shop_write_text" style="font-size:45px; color: #7d7b78; text-indent:5px;"
        type="text" placeholder="Make sure your file type!"name="" value="">
    </div><!-- end of shop_write_div2 -->

    <!-- end of div3 -->

    <!-- end of div4 -->
    <div id="shop_write_detail">
      <h2 style="color: #7d7b78; margin-top:30px; text-align:left">Details</h2>
      <input class="shop_write_text" style="width: 90%; font-size:35px; color: #7d7b78; text-indent:5px;"
        type="text" placeholder="Add descriptions.."name="" value="">
    </div><!-- end of div5 -->

  </div><!-- end of container -->

  <div class="shop_write_narrow">
    <div class="shop_write_upload">
      <input type="file" name="" placeholder="upload" value="">
    </div>
    <div class="shop_write_sticky">
      <div class="shop_write_sticky_outter" id="shop_write_sticky_product_info">

      </div><!-- end of shop_write_sticky_product_info -->

      <div class="shop_write_sticky_outter" id="shop_write_sticky_purchase">
        
      </div><!-- end of shop_write_sticky_purchase -->

    </div><!-- end of shop_write_sticky -->
  </div><!-- end of shop_write_narrow -->
  </form>
</div><!-- end of wrap -->

<!--============================================================================== -->
<?php

include "../khy_modal/login_modal_in_folder.php";
?>
