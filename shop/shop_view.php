<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
  <?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
  create_table($conn, "products");
  ?>
  <?php
  $row = "";
  if(!isset($_GET['num']) || empty($_GET['num'])){
    echo "<script>alert('제품번호(num)을 주세용');
          history.go(-1);</script>";
    exit;
  }else{
    $num=test_input($_GET["num"]);
    $i_num = (int)mysqli_real_escape_string($conn, $num);
    $sql = "SELECT * from `products` where `num` = $i_num;";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    $row=mysqli_fetch_array($result);
    $hit=(int)$row['hit']; $hit+=1;
    $sql = "UPDATE `products` SET `hit` = $hit WHERE `num` = $i_num";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    // ===========================조회수 업데이트 끝===============================

    $sql="SELECT `products`.*,`pro_img_named`,`pro_img_copied` from `products` inner join `member` ON `products`.`no`=`member`.`no` WHERE `num` = $i_num;";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    $user_no = $row['no'];
    $username = $row['username'];
    $email = $row['email'];
    $subject = $row['subject'];
    $content = $row['content'];
    $content = str_replace("\n","<br>", $content);
    $regist_day = $row['regist_day'];
    $date = date_create($regist_day);
    $regist_day = date_format($date,"F d, Y");
    $mon = $row['price']/100;
    $handpicked = $row['handpicked'];
    $freegoods = $row['freegoods'];
    $hit = $row['hit'];
    $sell_count = $row['sell_count'];
    $big_data = $row['big_data'];
    $small_data = $row['small_data'];
    $hash_tag = $row['hash_tag'];
    // $img_file_name1 = $row['img_file_cop1'];
    // $img_file_name2 = $row['img_file_name2'];
    // $img_file_name3 = $row['img_file_name3'];
    // $img_file_name4 = $row['img_file_name4'];
    $img_file_copied1 = $row['img_file_copied1'];
    $img_file_copied2 = $row['img_file_copied2'];
    $img_file_copied3 = $row['img_file_copied3'];
    $img_file_copied4 = $row['img_file_copied4'];
    // $zip_file_name = $row['zip_file_name'];
    $zip_file_copied = $row['zip_file_copied'];
    $file_size=round(filesize("../data/zip/$zip_file_copied")/1000000,2);
    $file_type = $row['file_type'];

    // $subject=htmlspecialchars($row['subject']);
    // $content=htmlspecialchars($row['content']);
    // $subject=str_replace(" ", "&nbsp;",$subject);
    // $subject=str_replace("\n", "<br>",$subject);
    // $content=str_replace(" ", "&nbsp;",$content);
    // $content=str_replace("\n", "<br>",$content);
    mysqli_close($conn);
  }
  ?>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../css/common.css">
  <link rel="stylesheet" href="../css/shop_view.css">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.2/css/all.css"
   integrity="sha384-oS3vJWv+0UjzBfQzYUhtDYW+Pj2yciDJxpsK1OYPAYjqT085Qq/1cq5FLXAZQ7Ay"
   crossorigin="anonymous">

  <script type="text/javascript" src="../js/monsterform.js"></script>
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
</head>
<body>
  <?php
  include "../lib/header_in_folder.php";
  ?>
  <!--============================================================================== -->
  <form class="" action="../shop/cart_dml.php" method="post">
  <div class="shop_view_wrap">
    <div class="shop_view_category">
      <a href="#"><?=$big_data?></a> > <a href="#"><?=$small_data?></a>
    </div>

    <div class="shop_view_container">
      <div id="shop_view_div1">
        <div class="shop_view_gal">
          <img class="shop_view_mySlides" src="../data/img/<?=$img_file_copied1?>" style="width:100%; ">
          <img class="shop_view_mySlides" src="../data/img/<?=$img_file_copied2?>" style="width:100%; display:none">
          <img class="shop_view_mySlides" src="../data/img/<?=$img_file_copied3?>" style="width:100%; display:none">
          <img class="shop_view_mySlides" src="../data/img/<?=$img_file_copied4?>" style="width:100%; display:none">
        </div>

        <div class="shop_view_minigal_set">
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="../data/img/<?=$img_file_copied1?>"
            style="width:100%;cursor:pointer" onclick="currentDiv(1)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="../data/img/<?=$img_file_copied2?>"
            style="width:100%;cursor:pointer" onclick="currentDiv(2)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="../data/img/<?=$img_file_copied3?>"
            style="width:100%;cursor:pointer" onclick="currentDiv(3)">
          </div>
          <div class="shop_view_minigal">
            <img class="demo w3-opacity w3-hover-opacity-off" src="../data/img/<?=$img_file_copied4?>"
            style="width:100%;cursor:pointer" onclick="currentDiv(4)">
          </div>
        </div>
      </div><!-- end of div1 -->
      <div id="shop_view_div2">
        <div class="shop_view_file_info" id="file_type">
          <h2 style="font-size:20px; color:#afaeae;">File Type</h2>
          <div class="shop_view_show_info" >
            <i class="far fa-file" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;"><?=$file_type?></span>
          </div>
        </div>
        <div class="shop_view_file_info" id="file_size">
          <h2 style="font-size:20px; color:#afaeae;">File Size</h2>
          <div class="shop_view_show_info">
            <i class="fas fa-dumbbell" style="font-size:50px; color:gray;"></i>&nbsp;&nbsp;
            <span style="font-size:40px; color:#797979;"><?=$file_size?>MB</span>
          </div>
        </div>
      </div><!-- end of div2 -->

      <!-- end of div3 -->

      <!-- end of div4 -->
      <div id="shop_view_detail">
        <h2 style="color: #7d7b78; margin-top:30px; text-align:left">Details</h2>
        <p><b><?=$subject?></b> </p>
        <p id="content"><?=$content?></p>
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
            <h2 style="text-align:left; font-size:1.9em"><?=$subject?> </h2>
            <p style="text-align:right;"><span style="color: #7d7b78;"><i>By</i> </span> <span><?=$username?></span></p>
            <p style="text-align:right; color: #7d7b78;"><i><?=$regist_day?></i></p>
          </div>
        </div><!-- end of shop_view_sticky_product_info -->

        <div class="shop_view_sticky_outter" id="shop_view_sticky_purchase">
          <div class="shop_view_sticky_inner" style="height: auto; color: #7d7b78; padding-top:7%;">
            <div style="text-align:left; width:48%; display:inline-block ">
              <span></span>
            </div>
            <div style="text-align:right; width:48%; display:inline-block">
              <span style="font-size:20px;"><b><?=$mon?></b></span> <span>Mon</span>
              <!-- <i class="fab fa-optin-monster" style="font-size:25px; color:#2f8f94;"></i> -->
            </div>
          </div>
          <div class="shop_view_sticky_inner" style="height: 70%; padding-top:1%;">
            <div class="shop_view_sticky_inner_btn" style="height:30%;">
              <button type="button" style="background-color:#70a330; color:white;" ><b>Finish Purchase <span><?=$mon?></span> Mon</b></button>
            </div>
            <div class="shop_view_sticky_inner_btn" style="height:30%; line-height:48px; font-size:15px; color: #7d7b78;">
              OR
            </div>
            <div class="shop_view_sticky_inner_btn" style="height:30%;">
              <button type="button" style="background-color:white; color:#70a330;"><b> Add to Cart</b></button>
            </div>
          </div>
        </div><!-- end of shop_view_sticky_purchase -->
      </div><!-- end of shop_view_sticky -->
    </div><!-- end of shop_view_narrow -->
    </form>
  </div><!-- end of wrap -->

  <!--============================================================================== -->
  <?php
  include "../lib/footer_in_folder.php";
  include "../khy_modal/login_modal_in_folder.php";
  ?>
</body>
</html>
