<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
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
  $mode="insert";
  ?>

  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/shop_write_form.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
   integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
   crossorigin="anonymous">
  <script type="text/javascript" src="../js/monsterform.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>


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
  <!-- <script>
    $("mon_selector").on("keydown", function(e){
      if(!((e.keyCode > 95 && e.keyCode < 106)
        || (e.keyCode > 47 && e.keyCode < 58)
        || (e.keyCode == 8))) {
          return false;
      }
    });
  </script> -->

  <script>
  var val="";
  $(document).ready(function(){
    $("#free_check").click(function(){
        var chk = $(this).is(":checked");//.attr('checked');
        if(chk) {
          console.log("췤");
          // $("#mon_selector").val(0);
          // $("#mon_selector").attr("disabled",true);
          $("#free_check").val("y");
        }else{
          console.log("언췤");
          // $("#mon_selector").val(10);
          // $("#mon_selector").attr("disabled",false);
          $("#free_check").val("n");
        }
        console.log($("#free_check").val());
    });
    $("#shop_write_input_tag").keyup(function(e){
      if (e.keyCode == 13) {
        var value = "#" + $(this).val();
        console.log(value);
        $("#shop_write_tags").append('<span class="s_v_tags">' + value + '</span>');
        $(this).val("");
      }
    });
    $(document).on('click','.s_v_tags',function(){
      console.log("해쉬태그 클릭됨");
      $(this).remove();
    });
  });
  </script>

  <script>
    function save_product(){
      var hidden="";
      var i;
      // console.log("제출버튼 클릭됨");
      var tags = document.getElementsByClassName("s_v_tags");

      // console.log("getElementsByClassName=" + tags[0].innerHTML);
      // console.log("tags=" + tags);

      for (i in tags) {
        if(tags[i].innerHTML){
          hidden += tags[i].innerHTML;
        }
      }
      document.getElementById("hash_tag").value=hidden;
      // console.log("hidden=" + hidden);
      // console.log(document.getElementById("hash_tag").value);
      //=========================해쉬태크문자열완성============================

      var big_data=$("#shop_write_select option:selected").val();
      $("#big_data").val(big_data);

      // document.getElementById("shop_write_form").submit();
    }
  </script>

</head>
<body>
  <?php
  include "../lib/header_in_folder.php";
  ?>
  <!--============================================================================== -->
  <div class="shop_write_wrap">
    <form name="shop_write_form" action="shop_dml_board.php?mode=<?=$mode?>" method="post" enctype="multipart/form-data">
    <div class="shop_write_category">
      <input class="shop_write_text" type="text" name="subject" placeholder="Add Title..." id="shop_write_title"><br>
      <span><i>by </i></span><span style="font-size:1.2em"><b>Kaka Laws </b></span><span> in
      <select class="shop_write_select" name="shop_write_select" id="shop_write_select">
        <option value="" disabled selected>Choose Category</option>
        <option value="Photos">Photos</option>
        <option value="Graphics">Graphics</option>
        <option value="Fonts">Fonts</option>
      </select>
      <input type="hidden" name="big_data" id="big_data">
    </div>

    <div class="shop_write_container">
      <div id="shop_write_div1">
        <div class="shop_write_gal">
          <img class="shop_write_mySlides" id="shop_write_gal1" src="./data/add_img.png" style="width:100%; ">
          <img class="shop_write_mySlides" id="shop_write_gal2" src="./data/add_img.png" style="width:100%; display:none">
          <img class="shop_write_mySlides" id="shop_write_gal3" src="./data/add_img.png" style="width:100%; display:none">
          <img class="shop_write_mySlides" id="shop_write_gal4" src="./data/add_img.png" style="width:100%; display:none">
        </div>

        <div class="shop_write_minigal_set">
          <div class="shop_write_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./data/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(1)" id="shop_write_mini1">
            <input type="file" name="upfile" accept="image/*" onchange="loadFile1(event)">
          </div>
          <div class="shop_write_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./data/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(2)" id="shop_write_mini2">
            <input type="file" name="upfile" accept="image/*" onchange="loadFile2(event)" >
          </div>
          <div class="shop_write_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./data/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(3)" id="shop_write_mini3">
            <input type="file" name="upfile" accept="image/*" onchange="loadFile3(event)">
          </div>
          <div class="shop_write_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="./data/add_img.png"
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
          type="text" placeholder="Make sure your file type!"name="file_type">
      </div><!-- end of shop_write_div2 -->

      <!-- end of div3 -->

      <!-- end of div4 -->
      <div id="shop_write_detail">
        <h2 style="color: #7d7b78; margin-top:30px; text-align:left">Details</h2>
        <input class="shop_write_text" style="width: 90%; font-size:35px; color: #7d7b78; text-indent:5px;"
          type="text" placeholder="Add descriptions.."name="content">
      </div><!-- end of div5 -->

    </div><!-- end of container -->

    <div class="shop_write_narrow">
      <div class="shop_write_upload">
        <input type="file" name="upfile" placeholder="upload" value="">
      </div>
      <div class="shop_write_sticky">
        <div class="shop_write_sticky_outter" id="shop_write_sticky_product_info">
          <button type="button" onclick="save_product();"
          style="background-color:#70a330; color:white; outline:none; font-size:25px;">
            <b>Save as For Sale</b></button>
        </div><!-- end of shop_write_sticky_product_info -->
          <div class="shop_write_sticky_inner" style="height: 100px; color: #7d7b78; padding-top:7%; border-bottom: 1px solid #c1bebe;">
            <div style="text-align:left; width:100%; display:inline-block ">
              <p><b>Set the Mon of your product</b></p><br>
            </div>
            <div style="text-align:left; width:48%; display:inline-block ">
              <input type="checkbox" name="freegoods_agree" value="y" id="free_check">Agree for <b>Free</b> <br>
            </div>
            <div style="text-align:right; width:48%; display:inline-block ">
              <span><b>Mon </b></span> <input type="number" min="0" name="setted_mon" id="mon_selector"
                style="width:50px; text-align:center;">
              <!-- <i class="fab fa-optin-monster" style="font-size:25px; color:#2f8f94;"></i> -->
            </div>
          </div>
          <div class="shop_write_sticky_inner" style="height: 50px; color: #7d7b78; padding-top:7%; border-bottom: 1px solid #c1bebe;">
            <div style="text-align:left; width:48%; display:inline-block ">
              <i class="far fa-calendar-alt"></i> <span><b>Date </b></span>
            </div>
            <div style="text-align:right; width:48%; display:inline-block ">
              <span><?=date("d F, Y")?></span>
              <!-- <i class="fab fa-optin-monster" style="font-size:25px; color:#2f8f94;"></i> -->
            </div>
          </div>
          <div class="shop_write_sticky_inner" style="height: 50px; color: #7d7b78; padding-top:7%; border-bottom: 1px solid #c1bebe;">
            <div style="text-align:left; width:100%; display:inline-block ">
              <input class="shop_write_text" type="text" name="" value="" style="width:100%; font-size:20px; text-indent:5px;"
                placeholder="Type a tag and press enter!" id="shop_write_input_tag">
            </div>
          </div>
          <div class="shop_write_sticky_inner" id="shop_write_tags" >
            <input type="hidden" name="hash_tag" id="hash_tag">
          </div>

      </div><!-- end of shop_write_sticky -->
    </div><!-- end of shop_write_narrow -->
    </form>
  </div><!-- end of wrap -->

  <!--============================================================================== -->
  <?php

  include "../khy_modal/login_modal_in_folder.php";
  ?>
</body>
</html>
