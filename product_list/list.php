<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

create_table($conn, "products");

define('SCALE', 12);

$partner_default = 'n';
$handpicked_default = 'n';
$popular_default = 'n';
$partner_checked = '';
$handpicked_checked = '';
$popular_checked = '';
$q_search = '';
$small_data='';

if(isset($_GET["big_data"])){
  $big_data=$_GET["big_data"];
}

if(isset($_GET["small_data"])){
  $small_data=$_GET["small_data"];
}

if(isset($_GET["partner"])){
  $partner=$_GET["partner"];
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
}

if(isset($_GET["popular"])){
  $popular=$_GET["popular"];
}

if(isset($_GET["mode"]) && $_GET["mode"] == "search" && $small_data==''){
  if(isset($_GET["search_text"])){
    $search = test_input($_GET["search_text"]);
  }else{
    $search = '';
  }
    $q_search = mysqli_real_escape_string($conn, $search);

    if($partner=='n' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` where big_data = '$big_data' and subject like '%$q_search%' order by num desc;";
      $title = $big_data;
    }else if($partner=='n' && $handpicked=='y' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.handpicked='y' and p.subject like '%$q_search%' order by p.num desc;";
      $title = $big_data." - HandPicked";
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'n';
    }else if($partner=='n' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular";
      $popular_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'n';
      $popular_default = 'y';
    }else if($partner=='n' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular Handpicked";
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner = 'y' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular Handpicked of Partner's";
      $partner_checked = 'checked';
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='y' and p.subject like '%$q_search%' order by p.num desc";
      $title = "Result - Partner's";
      $partner_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'n';
      $popular_default = 'n';
    }else if($partner=='y' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Popular of Partner's";
      $partner_checked = 'checked';
      $popular_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'n';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='y' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='y' and p.handpicked='y' and p.subject like '%$q_search%' order by p.num desc;";
      $title = "Result - Partner's HandPicked";
      $partner_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'y';
      $popular_default = 'n';
    }else{
      $sql = "SELECT * from `products` where big_data = '$big_data' and subject like '%$q_search%' order by num desc;";
      $title = "Result";
    }
    $result = mysqli_query($conn, $sql);
    $total_record = mysqli_num_rows($result);

    $total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

    if(empty($_GET["page"])){
      $page = 1;
    }else{
      $page = $_GET["page"];
    }

    $start = ($page-1) * SCALE;

    $number = $total_record - $start;

}else if(isset($_GET["mode"]) && $_GET["mode"] == "search" && $small_data!=''){

  if(isset($_GET["search_text"])){
    $search = test_input($_GET["search_text"]);
  }else{
    $search = '';
  }
    $q_search = mysqli_real_escape_string($conn, $search);

    if($partner=='n' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` where big_data = '$big_data' and small_data = '$small_data' and subject like '%$q_search%' order by num desc;";
      $title = $big_data;
    }else if($partner=='n' && $handpicked=='y' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and p.handpicked='y' and p.subject like '%$q_search%' order by p.num desc;";
      $title = $big_data." - HandPicked";
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'n';
    }else if($partner=='n' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular";
      $popular_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'n';
      $popular_default = 'y';
    }else if($partner=='n' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular Handpicked";
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and m.partner = 'y' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = $big_data." - Popular Handpicked of Partner's";
      $partner_checked = 'checked';
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and m.partner='y' and p.subject like '%$q_search%' order by p.num desc";
      $title = "Result - Partner's";
      $partner_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'n';
      $popular_default = 'n';
    }else if($partner=='y' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and m.partner='y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Popular of Partner's";
      $partner_checked = 'checked';
      $popular_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'n';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='y' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and p.small_data = '$small_data' and m.partner='y' and p.handpicked='y' and p.subject like '%$q_search%' order by p.num desc;";
      $title = "Result - Partner's HandPicked";
      $partner_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'y';
      $popular_default = 'n';
    }else{
      $sql = "SELECT * from `products` where big_data = '$big_data' and small_data = '$small_data' and subject like '%$q_search%' order by num desc;";
      $title = "Result";
    }
    $result = mysqli_query($conn, $sql);
    $total_record = mysqli_num_rows($result);

    $total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

    if(empty($_GET["page"])){
      $page = 1;
    }else{
      $page = $_GET["page"];
    }

    $start = ($page-1) * SCALE;

    $number = $total_record - $start;

}else{

  $sql = "SELECT * from `products` where big_data = '$big_data'";
  $title = 'Total';

  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  $total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

  if(empty($_GET["page"])){
    $page = 1;
  }else{
    $page = $_GET["page"];
  }

  $start = ($page-1) * SCALE;

  $number = $total_record - $start;
}

?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../css/product_list.css">
	<link rel="stylesheet" href="../css/photo.css">
	<link rel="stylesheet" href="../css/keyframe.css">
	<link rel="stylesheet" href="../css/common.css">
	<link rel="stylesheet" href="../css/footer.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		var value = "";
		// 첫번째 선택지
		function Categorie(value) {
			var text = "" + value;
			document.getElementById("filter_form_div2_3_span").innerHTML = text;
		}

		function mouse_over() {
			document.getElementById('change1_img').src = "../img/up.png";
		}

		function mouse_out() {
			document.getElementById('change1_img').src = "../img/down.png";
		}
		// 두번째 선택지
		function select(value) {
			var text = "" + value;
			document.getElementById("filter_form_div2_3_span_1").innerHTML = text;
		}

		function mouse_over1() {
			document.getElementById('change_img').src = "../img/up.png";
		}

		function mouse_out1() {
			document.getElementById('change_img').src = "../img/down.png";
		}

		function changeimage() {
	    var image = document.getElementById('like');
	    if (image.src.match("cart")) {
	        image.src = "../img/logo.png";
	    } else {
	        image.src = "../img/cart.png";
	    }
		}

    function check_partner(){
      var partner = document.getElementById('partner').value;
      var handpicked = document.getElementById('handpicked').value;
      var popular = document.getElementById('popular').value;
      var search_text = document.getElementById('products_search_text').value;
      var big_data = document.getElementById('big_data').value;
      var small_data = document.getElementById('small_data').value;

      if(partner=='n'){
        partner='y';
      }else{
        partner='n';
      }

      if(small_data==''){
        var location = "./list.php?big_data="+big_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }else{
        var location = "./list.php?big_data="+big_data+"&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }
      window.location.href = location;
    }

    function check_handpicked(){
      var partner = document.getElementById('partner').value;
      var handpicked = document.getElementById('handpicked').value;
      var popular = document.getElementById('popular').value;
      var search_text = document.getElementById('products_search_text').value;
      var big_data = document.getElementById('big_data').value;
      var small_data = document.getElementById('small_data').value;

      if(handpicked=='n'){
        handpicked='y';
      }else{
        handpicked='n';
      }

      if(small_data==''){
        var location = "./list.php?big_data="+big_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }else{
        var location = "./list.php?big_data="+big_data+"&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }

      window.location.href = location;
    }

    function check_popular(){
      var partner = document.getElementById('partner').value;
      var handpicked = document.getElementById('handpicked').value;
      var popular = document.getElementById('popular').value;
      var search_text = document.getElementById('products_search_text').value;
      var big_data = document.getElementById('big_data').value;
      var small_data = document.getElementById('small_data').value;

      if(popular=='n'){
        popular='y';
      }else{
        popular='n';
      }

      if(small_data==''){
        var location = "./list.php?big_data="+big_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }else{
        var location = "./list.php?big_data="+big_data+"&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }

      window.location.href = location;
    }

    function products_search_text(){
      var partner = document.getElementById('partner').value;
      var handpicked = document.getElementById('handpicked').value;
      var popular = document.getElementById('popular').value;
      var search_text = document.getElementById('products_search_text').value;
      var big_data = document.getElementById('big_data').value;
      var small_data = document.getElementById('small_data').value;

      if(small_data==''){
        var location = "./list.php?big_data="+big_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }else{
        var location = "./list.php?big_data="+big_data+"&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      }

      window.location.href = location;
    }


    $(document).ready(function() {
      $(".likes_img_class").click(function(event) {
        var n = $(".likes_img_class").index(this);
        var num_num = $(".hidden_num:eq("+n+")").val();
        var likes_img_value = $(".likes_img_value:eq("+n+")").val();
        console.log(n);
        console.log(num_num);
        console.log(likes_img_value);
         $.ajax({
           url: '../lib/like_dml.php?mode=go_like', // 데이터 보내서 작업되어질 url
           type: 'POST', // get 또는 post로 data를 보냄
           data: {num: num_num, liv : likes_img_value}
         })
         .done(function(result_ajax) {
           console.log("success");
           console.log(result_ajax);
           console.log($(".likes_img_class:eq("+n+")").attr("src"));
           if(result_ajax=='fail'){
             alert("로그인 후 이용하세요.");
           }else{
             if($(".likes_img_class:eq("+n+")").attr("src")!="../img/hover_like.png"){
               $(".likes_img_class:eq("+n+")").attr("src", "../img/hover_like.png");
             }else{
               $(".likes_img_class:eq("+n+")").attr("src", "../img/like.png");
            }
              console.log($(".likes_img_class:eq("+n+")").attr("src"));
            if($(".likes_img_value:eq("+n+")").val()=='y'){
              $(".likes_img_value:eq("+n+")").val('n');
            }else{
              $(".likes_img_value:eq("+n+")").val('y');
            }
           }

         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
      });

      $("#small_data_select").change(function(event) {
        var small_data = $("#small_data_select").val();
        var big_data = $("#big_data").val();
        var partner = $("#partner").val();
        var handpicked = $("#handpicked").val();
        var popular = $("#popular").val();

        if(big_data=='none'){
          var location = "./list.php?big_data=none&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular;
        }else{
          var location = "./list.php?big_data="+big_data+"&small_data="+small_data+"&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular;
        }
        window.location.href = location;
      });
    });

	</script>
</head>
<body>
	<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/header_in_folder.php";
  if($big_data=='photos'){
    include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/section_photos_category.php";
  }else if($big_data=='graphics'){
      include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/section_graphics_category.php";
  }else if($big_data=='fonts'){
    include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/section_fonts_category.php";
  }
   ?>
   <br><br>
   <div id="filter_div">
     <input type="hidden" id="big_data" value="<?=$big_data?>">
     <input type="hidden" id="small_data" value="<?=$small_data?>">
     <div class="filter_container">
       <div class="switch_div">
         <label id="certified_label">
           <input class="switch_check" type="checkbox" id="partner" value="<?=$partner_default?>" name="partner" onclick="check_partner()" <?=$partner_checked?>>
           <span class="certified_span">Certified</span>
         </label>
       </div>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <div class="filter_container_div_3">
         <a href="#" id="filter_form_div2_3_a">
           <span id="filter_form_div2_3_span">Filter</span>
           <img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
         </a>
          <ul id="filter_form_div2_3_ul_3">
            <li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="handpicked" onclick="check_handpicked()" name="checkgroup" value="<?=$handpicked_default?>" <?=$handpicked_checked?>/> handpicked</label></li>
            <li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="popular" class="checkbox" onclick="check_popular()" name="checkgroup" value="<?=$popular_default?>" <?=$popular_checked?>/> popular</label></li>
          </ul>
        </div>
        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="text" name="" value="" id="products_search_text">
        <button type="button" id="search_button" onclick="products_search_text()">search</button>
        <div id="product_write_button">
          <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
          if(isset($_SESSION['username'])){
            echo '<a href="./list.php?big_data='.$big_data.'"><button type="button" name="button">Reset List</button></a>&nbsp';
            echo '<a href="../shop/shop_write_form.php"><button type="button" name="button">Open My Shop</button></a>';
          }else{
            echo '<a href="./list.php?big_data='.$big_data.'"><button type="button" name="button">Reset List</button></a>&nbsp;';
          }
          ?>
        </div> <!-- end of button -->
      </div>
    </div>

	<div class="list_container">
	  <div id="load_product">
      <h1 style="display: inline-block;"><a href="./list.php?big_data=<?=$big_data?>"> <?=$big_data?></a>
      <?php
      if(isset($small_data) && $small_data != 'none'){
        echo ' > '.$small_data;
      }
      ?> (<?=$total_record?>)
        </h1>
      <div class="" style="text-align:right; margin-right:25px;">
        <?php
        switch ($big_data) {
          case 'photos':
            echo '<select class="" name="" id="small_data_select">
              <option value="none">'.$big_data.'</option>
              <option value="arts">Arts</option>
              <option value="nature">Nature</option>
              <option value="animals">Animals</option>
              <option value="beauty_fashion">Beauty & Fashion</option>
              <option value="food_drink">Food & Drink</option>
              <option value="sports">Sports</option>
              <option value="business">Business</option>
              <option value="technology">Technology</option>
            </select>';
            break;
          case 'graphics':
            echo '<select class="" name="" id="small_data_select">
                    <option value="none">'.$big_data.'</option>
                    <option value="icons">Icons</option>
                    <option value="objects">Objects</option>
                    <option value="illustrations">Illustrations</option>
                    <option value="patterns">Patterns</option>
                    <option value="web_elements">Web Elements</option>
                    <option value="textures">Textures</option>
                  </select>';
            break;
          case 'fonts':
            echo '<select class="" name="" id="small_data_select">
                    <option value="none">'.$big_data.'</option>
                    <option value="blackletter">Blackletter</option>
                    <option value="sans_serif">Sans Serif</option>
                    <option value="slab_serif">Slab Serif</option>
                    <option value="display">Display</option>
                    <option value="script">Script</option>
                    <option value="symbols">Symbols</option>
                    <option value="non_western">Non Western</option>
                    <option value="serif">Serif</option>
                  </select>';
            break;
          default:
            break;
        }
         ?>
      </div>
		<?php
		// 모든 레코드를 가져오는 로직
		for ($i=$start; ($i<$start+SCALE) && ($i< $total_record); $i++){
      // 가져올 레코드 위치 이동
   			mysqli_data_seek($result, $i);

   	 // 하나 레코드 가져오기
   			 $row = mysqli_fetch_array($result);
         $item_no = $row["no"];
   			 $item_num = $row["num"];
   			 $item_name = $row["username"];
   			 $item_price = $row["price"];
         $item_big_data = $row["big_data"];
         $item_email = $row["email"];
   			 $img_copy_name1 = $row["img_file_copied1"];
         $img_copy_name1 = "../data/img/".$img_copy_name1;
   			 $item_hit = $row["hit"];
   			 $item_date = $row["regist_day"];
   			 $item_date = substr($item_date, 0, 10);
   			 $item_subject = str_replace(" ", "&nbsp;", $row["subject"]);
         $item_freegoods=$row["freegoods"];

         $sql_partner = "SELECT partner from member where no = '$item_no';";
         $result_partner = mysqli_query($conn, $sql_partner);
         $row_partner = mysqli_fetch_array($result_partner);
         $partner = $row_partner['partner'];

         if($partner=='n' && $item_freegoods=='n'){
           $freegoods_img="../img/hover_logo.png";
         }else{
           $freegoods_img="../img/free_partner_logo.png";
         }

         if(!isset($member_no)){
           $likes_img = '';
         }else{
           $sql_likes = "SELECT product_num from likes where no = '$member_no';";
           $result_likes = mysqli_query($conn, $sql_likes);
           $total_record_likes = mysqli_num_rows($result_likes);

           $likes_img = "../img/hover_like.png";
           $likes_img_value = "n";

           for($j=0;$j<$total_record_likes;$j++){
             mysqli_data_seek($result_likes, $j);
             $row_likes = mysqli_fetch_array($result_likes);
             $likes = $row_likes['product_num'];
             if($likes == $item_num){
               $likes_img = "../img/like.png";
               $likes_img_value = "y";
               break;
             }
           }
         }

   			// 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
   			if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
   					$main_img = $img_copy_name0;
   			}
			?>
      <div class="img_div">
        <figure class="snip1368">
          <a href="../shop/shop_view.php?num=<?=$item_num?>">
            <img id="main_img" src="<?=$img_copy_name1?>" alt="sample30" />
          </a>
          <div class="hover_img">
            <img src="<?=$freegoods_img?>" alt="" style="width:25px; height:25px;"><!--가져다 댔을때-->
          </div>
          <div class="list_title_div">
            <div class="">
              <a href="#" class="">
                <span class="list_title_div_span_bold"><?=$item_subject?></span>
              </a>
              <a href="#" class="list_title_div_a_float_right">
                M&nbsp; <?=$item_price?>
              </a>
            </div>
            <div class="">
                by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email=<?=$item_email?>" class=""><?=$item_email?></a>
                in&nbsp;<a href="../product_list/list.php?big_data=<?=$item_big_data?>" class=""><?=$item_big_data?></a>
            </div>
          </div>
          <figcaption>
            <div class="icons">
              <input type="hidden" class="hidden_num" value="<?=$item_num?>">
              <img class="likes_img_class" src="<?=$likes_img?>" alt="" style="width:25px; height:25px;"><br>
              <input type="hidden" class="likes_img_value" value="<?=$likes_img_value?>">
            </div>
          </figcaption>
        </figure>
      </div>
      <?php
        $number --;
      }//end of for
       ?>
		</div>
    <div class="product_page_num">
      <?php
      if(!($page-1==0)){
        $go_page = $page-1;
        echo "<a href='./list.php?big_data=$big_data&mode=search&partner=$partner_default&handpicked=$handpicked_default&popular=$popular_default&search_text=$q_search&page=$go_page'><span class='page_button2'>&nbsp;PREV </span>&nbsp;</a>";
      }else{
        echo "";
      }
        for($i=1;$i<=$total_page;$i++){
          if($page==$i){
            echo "<b id='page_num1'>&nbsp; $i &nbsp;</b>";
          }else{
            echo "<a href='./list.php?big_data=$big_data&mode=search&partner=$partner_default&handpicked=$handpicked_default&popular=$popular_default&search_text=$q_search&page=$i'>&nbsp;$i&nbsp;</a>";
          }
        }

        if($total_record!=0){
          if($page==$total_page){
            echo "";
          }else{
            $go_page = $page+1;
            echo "<a href='./list.php?big_data=$big_data&mode=search&partner=$partner_default&handpicked=$handpicked_default&popular=$popular_default&search_text=$q_search&page=$go_page'>&nbsp;<span class='page_button2'> NEXT </span></a>";
          }
        }else{
          echo "";
        }
         ?>
         <br><br>
      </div> <!-- end of page_num -->

</div>
<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/footer_in_folder.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/khy_modal/login_modal_in_folder.php";
 ?>

</body>
</html>
