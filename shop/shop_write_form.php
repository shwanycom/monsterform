<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
if (empty($member_no)) {
  echo "<script>alert('Login Please');
        history.go(-1);</script>";
  exit;
}
// session_start();
// if(isset($_SESSION['no'])){
// $member_no = $_SESSION['no'];
// $member_email = $_SESSION['email'];
// $member_username = $_SESSION['username'];
// $member_mon = $_SESSION['mon'];
// $member_partner = $_SESSION['partner'];
// }
create_table($conn, "products"); //가입인사 게시판 테이블 생성
  // $subject=htmlspecialchars($row['subject']);
  // $content=htmlspecialchars($row['content']);
  // $subject=str_replace(" ", "&nbsp;",$subject);
  // $subject=str_replace("\n", "<br>",$subject);
  // $content=str_replace(" ", "&nbsp;",$content);
  // $content=str_replace("\n", "<br>",$content);
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
    console.log(event.target.files[0]);
    var $changed_image=$(event.target);
    if(mini.src){
      $changed_image.prev().css("color", "green");
    }else{
      $changed_image.prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  };
  var loadFile2 = function(event) {
    var mini = document.getElementById('shop_write_mini2');
    var gal = document.getElementById('shop_write_gal2');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
    var $changed_image=$(event.target);
    if(mini.src){
      $changed_image.prev().css("color", "green");
    }else{
      $changed_image.prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  };
  var loadFile3 = function(event) {
    var mini = document.getElementById('shop_write_mini3');
    var gal = document.getElementById('shop_write_gal3');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
    var $changed_image=$(event.target);
    if(mini.src){
      $changed_image.prev().css("color", "green");
    }else{
      $changed_image.prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  };
  var loadFile4 = function(event) {
    var mini = document.getElementById('shop_write_mini4');
    var gal = document.getElementById('shop_write_gal4');
    mini.src = URL.createObjectURL(event.target.files[0]);
    gal.src = URL.createObjectURL(event.target.files[0]);
    var $changed_image=$(event.target);
    if(mini.src){
      $changed_image.prev().css("color", "green");
    }else{
      $changed_image.prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  };

  var loadzip = function(event) {
    console.log(event.target.files[0]);
    $("#shop_write_upload1 span.s_w_upload_span").html(event.target.files[0].name);
    $("#shop_write_upload1 p.s_w_zip_alt").html('<i class="fas fa-check" style="font-size:30px; color:#70a330;"></i>');
    console.log(event.target.files[0].name);
  };
  var loadfont = function(event) {
    $("#shop_write_upload2 span.s_w_upload_span").html(event.target.files[0].name);
    $("#shop_write_upload2 p.s_w_font_alt").html('<i class="fas fa-check" style="font-size:30px; color:#70a330;"></i>');
    console.log(event.target.files[0].name);
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
var input_change = function(event){
  var $changed_input=$(event.target);
  console.log(event.target.name);
  if($changed_input.val()){
    $changed_input.prev().css("color", "green");
  }else{
    $changed_input.prev().css("color", "#ff5e5e");
    alert("Make sure the "+event.target.name+" of your product!");
  }
};

$(document).ready(function(){
  var val="";
  var category="";
  var group="";

  var $check_icon = $('<i class="fas fa-check" style="font-size:20px; color:#ff5e5e;"></i>');
  $('.should_have_inputted').before($check_icon);

  $("#shop_write_select").change(function() {
    category = $("#shop_write_select option:selected").val();
    console.log("셀렉트 값 변경감지 : " + category);
    $("#big_data").val(category);
    var check = $("#big_data").val();
    console.log("히든 값 :" + check);

    switch (check) {
      case "Photos" :   console.log("포토선택케이스");
                        $("#shop_write_upload2").remove();
                        $('#shop_write_select2').html('<option value="" disabled selected>Choose Group</option><option value="animals">Animals</option><option value="arts">Arts</option><option value="beauty_fashion">Beauty&Fasshion</option><option value="business">Business</option><option value="food_drink">Food&Drink</option><option value="nature">Nature</option><option value="sports">Sports</option><option value="technology">Technology</option>');
                        break;

      case "Graphics" : console.log("그래픽선택케이스");
                        $("#shop_write_upload2").remove();
                        $('#shop_write_select2').html('<option value="" disabled selected>Choose_Group</option><option value="icons">Icons</option><option value="illustrations">Illustrations</option><option value="web_elements">Web_Elements</option><option value="objects">Objects</option><option value="patterns">Patterns</option><option value="textures">Textures</option>');
                        break;
      case "Fonts" : console.log("폰트선택케이스");
                      $("#shop_write_upload").append('<div id="shop_write_upload2"></div>');
                      $('#shop_write_select2').html('<option value="" disabled selected>Choose_Group</option><option value="blackletter">Blackletter</option><option value="display">Display</option><option value="non_western">Non_Western</option><option value="sans_serif">Sans_Serif</option><option value="script">Script</option><option value="serif">Serif</option><option value="slab_serif">Slab&Serif</option><option value="symbols">Symbols</option>');
                      $("#shop_write_upload2").html('<label for="ttf_file"><span class="s_w_upload_span"><b>Upload font file...</b></span></label><p class="s_w_font_alt" style="margin:0px;"><i class="fas fa-check" style="font-size:20px; color:#ff5e5e;"> TTF or OTF file! </i></p><input type="file" name="font_file" id="ttf_file" onchange="loadfont(event)">');
                      break;
      default: break;
    }
    if(check){
      $("#big_data").prev().css("color", "green");
    }else{
      $("#big_data").prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  });

  $("#shop_write_select2").change(function() {
    group = $("#shop_write_select2 option:selected").val();
    console.log("셀렉트 값 변경감지 : " + group);
    $("#small_data").val(group);
    var check2 = $("#small_data").val();
    console.log("히든 값 :" + check2);

    if(check2){
      $("#small_data").prev().css("color", "green");
    }else{
      $("#small_data").prev().css("color", "#ff5e5e");
      alert("Make sure the "+event.target.name+" of your product!");
    }
  });
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
      $("#shop_write_tags").append('<div class="s_v_tags">' + value + '</div>');
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
    //<i class="fas fa-check" style="font-size:20px; color:#ff5e5e;"></i>
    // console.log($('input.should_have_inputted'));
    var $s_h_input=$('input.should_have_inputted');
    // console.log($s_h_input);

    for(var i=0; i<10; i++){
      if(!$s_h_input[i].value){
        alert($s_h_input[i].name+"이 없습니다!");
        console.log($s_h_input[i]);
        return false;
      }
    }
    // console.log($('input#zip_file').val());
    if(!$('input#zip_file').val()){
      alert("zip 파일이 없습니다!");
      return false;
    }
    if(($("#big_data").val()=="Fonts")&&!($('input#ttf_file').val())){
      alert("폰트파일이 없습니다!");
      return false;
    }
    var hidden="";
    var i;
    //=========================해쉬태크문자열만들기============================
    // console.log("제출버튼 클릭됨");
    var tags = document.getElementsByClassName("s_v_tags");
    for (i in tags) {
      if(tags[i].innerHTML){
        hidden += tags[i].innerHTML;
      }
    }
    document.getElementById("hash_tag").value=hidden;
    document.getElementById("shop_write_form").submit();
  }
</script>

</head>
<body>
  <?php
  include "../lib/header_in_folder.php";
  ?><br><br>
  <!--============================================================================== -->
  <div class="shop_write_wrap">
    <form name="shop_write_form" id="shop_write_form" action="shop_dml_board.php?mode=insert"
      method="post" enctype="multipart/form-data">
    <div class="shop_write_category">
      <input class="should_have_inputted" type="text" name="subject" placeholder="Add Title..." id="shop_write_title" onchange="input_change(event)"><br>
      <span><i>&nbsp;by&nbsp;</i></span><span style="font-size:1.2em; color:black;"><b> <?=$member_username?> &nbsp;</b></span><span> in&nbsp;<span>
      <input class="should_have_inputted" type="hidden" name="big_data" id="big_data" onchange="input_change(event)">
      <select class="shop_write_select" name="shop_write_select" id="shop_write_select">
        <option value="" disabled selected>Choose Category</option>
        <option value="photos">Photos</option>
        <option value="graphics">Graphics</option>
        <option value="fonts">Fonts</option>
      </select>
      <input class="should_have_inputted" type="hidden" name="small_data" id="small_data" onchange="input_change(event)">
      <select class="shop_write_select" name="shop_write_select" id="shop_write_select2">
        <option value="" disabled selected>Choose Category</option>
      </select>
    </div>

    <div class="shop_write_container">
      <div id="shop_write_div1">
        <div class="shop_write_gal">
          <img class="shop_write_mySlides" id="shop_write_gal1" src="../img/add_img.png" style="width:100%; ">
          <img class="shop_write_mySlides" id="shop_write_gal2" src="../img/add_img.png" style="width:100%; display:none">
          <img class="shop_write_mySlides" id="shop_write_gal3" src="../img/add_img.png" style="width:100%; display:none">
          <img class="shop_write_mySlides" id="shop_write_gal4" src="../img/add_img.png" style="width:100%; display:none">
        </div>

        <div class="shop_write_minigal_set">
          <div class="shop_write_minigal">
            <input class="should_have_inputted" type="file" name="img_file[]" id="img_upfile1" accept="image/*" onchange="loadFile1(event)">
            <label for="img_upfile1"><img class="demo w3-opacity w3-hover-opacity-off" src="../img/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(1)" id="shop_write_mini1"></label>
          </div>
          <div class="shop_write_minigal">
            <input class="should_have_inputted" type="file" name="img_file[]" id="img_upfile2" accept="image/*" onchange="loadFile2(event)" >
            <label for="img_upfile2"><img class="demo w3-opacity w3-hover-opacity-off" src="../img/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(2)" id="shop_write_mini2"></label>
          </div>
          <div class="shop_write_minigal">
            <input class="should_have_inputted" type="file" name="img_file[]" id="img_upfile3" accept="image/*" onchange="loadFile3(event)">
            <label for="img_upfile3"><img class="demo w3-opacity w3-hover-opacity-off" src="../img/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(3)" id="shop_write_mini3"></label>
          </div>
          <div class="shop_write_minigal">
            <input class="should_have_inputted" type="file" name="img_file[]" id="img_upfile4" accept="image/*" onchange="loadFile4(event)">
            <label for="img_upfile4"><img class="demo w3-opacity w3-hover-opacity-off" src="../img/add_img.png"
            style="width:100%;cursor:pointer" onclick="currentDiv(4)" id="shop_write_mini4"></label>
          </div>
        </div>
      </div><!-- end of div1 -->
      <div id="shop_write_div2" style="padding-bottom:35px;">
        <h2 style="margin-top:30px; text-align:left">File Type</h2>
        <i class="far fa-file" style="font-size:50px; color:gray; text-indent:5px;"></i>&nbsp;&nbsp;
        <input class="should_have_inputted" style="font-size:45px; color: #7d7b78; text-indent:5px;"
          type="text" placeholder="Make sure your file type!"name="file_type" onchange="input_change(event)">
      </div><!-- end of shop_write_div2 -->

      <!-- end of div3 -->

      <!-- end of div4 -->
      <div id="shop_write_detail">
        <h2 style="margin-top:30px; text-align:left">Details</h2>
        <input class="should_have_inputted" style="width: 90%; font-size:35px; color: #7d7b78; text-indent:5px;"
          type="text" placeholder="Add descriptions.."name="content" onchange="input_change(event)">
      </div><!-- end of div5 -->

    </div><!-- end of container -->

    <div class="shop_write_narrow">
      <div class="shop_write_upload" id="shop_write_upload">
        <div id="shop_write_upload1">
          <label for="zip_file"><span class="s_w_upload_span"><b>Upload your product...</b></span></label>
          <p class="s_w_zip_alt" style="margin:0px;"><i class="fas fa-check" style="font-size:20px; color:#ff5e5e;"> Only for zip!</i></p>
          <input type="file" name="zip_file" id="zip_file" accept="application/x-zip-compressed" onchange="loadzip(event)">
        </div>
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
              <input type="checkbox" name="freegoods_agree" value="n" id="free_check">Agree for <b>Free</b> <br>
            </div>
            <div id="s_w_agree_mon_div" style="text-align:right; width:48%; display:inline-block ">
              <span style="color:black;"><b>Mon </b></span> <input class="should_have_inputted" type="number" min="0" name="setted_mon" id="mon_selector"
                style="width:50px; text-align:center;" onchange="input_change(event)">
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
              <input type="text" name="" value="" style="width:95%; font-size:20px; text-indent:5px;"
                placeholder="Type a tag and press enter!" id="shop_write_input_tag">
            </div>
          </div>
          <div class="shop_write_sticky_inner" id="shop_write_tags">
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
