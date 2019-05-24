<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

create_table($conn, "products");

define('SCALE', 27);

$freegoods_default = 'n';
$handpicked_default = 'n';
$popular_default = 'n';

$freegoods_bold = '';
$handpicked_bold = '';
$popular_bold = '';

$selected1 = 'selected';
$selected2 = '';
$selected3 = '';
$selected4 = '';


if(isset($_GET["big_data"])){
  $big_data=$_GET["big_data"];
  switch($big_data){
    case 'none':
    $selected1 = 'selected';
    $selected2 = '';
    $selected3 = '';
    $selected4 = '';
    break;
    case 'photos':
    $selected1 = '';
    $selected2 = 'selected';
    $selected3 = '';
    $selected4 = '';
    break;
    case 'graphics':
    $selected1 = '';
    $selected2 = '';
    $selected3 = 'selected';
    $selected4 = '';
    break;
    case 'fonts':
    $selected1 = '';
    $selected2 = '';
    $selected3 = '';
    $selected4 = 'selected';
    break;
    default:
    break;
  }
}

if(isset($_GET["freegoods"])){
  $freegoods=$_GET["freegoods"];
  if($freegoods=='y'){
    $freegoods_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
  if($handpicked=='y'){
    $handpicked_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["popular"])){
  $popular=$_GET["popular"];
  if($popular=='y'){
    $popular_bold = 'style = "font-weight:bold"';
  }
}

if(isset($_GET["big_data"]) && $_GET["big_data"]!='none'){
  if($freegoods=='n' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' order by num desc;";
    $title = "Total";
  }else if($freegoods=='n' && $handpicked=='y' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' and handpicked='y' order by num desc;";
    $title = "Result - HandPicked";
    $freegoods_default = 'n';
    $handpicked_default = 'y';
    $popular_default = 'n';
  }else if($freegoods=='n' && $handpicked=='n' && $popular=='y'){
    $sql = "SELECT * from `products` where big_data = '$big_data' order by hit desc;";
    $title = "Result - Popular";
    $freegoods_default = 'n';
    $handpicked_default = 'n';
    $popular_default = 'y';
  }else if($freegoods=='y' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where big_data = '$big_data' and freegoods='y' order by num desc";
    $title = "Result - Partner's";
    $freegoods_default = 'y';
    $handpicked_default = 'n';
    $popular_default = 'n';
  }else{
    $sql = "SELECT * from `products` where big_data = '$big_data' order by num desc;";
    $title = "Result";
  }

}else{

  if($freegoods=='n' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` order by num desc;";
    $title = "Total";
  }else if($freegoods=='n' && $handpicked=='y' && $popular=='n'){
    $sql = "SELECT * from `products` where handpicked='y' order by num desc;";
    $title = "Result - HandPicked";
    $freegoods_default = 'n';
    $handpicked_default = 'y';
    $popular_default = 'n';
  }else if($freegoods=='n' && $handpicked=='n' && $popular=='y'){
    $sql = "SELECT * from `products` order by hit desc;";
    $title = "Result - Popular";
    $freegoods_default = 'n';
    $handpicked_default = 'n';
    $popular_default = 'y';
  }else if($freegoods=='y' && $handpicked=='n' && $popular=='n'){
    $sql = "SELECT * from `products` where freegoods='y' order by num desc";
    $title = "Result - Partner's";
    $freegoods_default = 'y';
    $handpicked_default = 'n';
    $popular_default = 'n';
  }else{
    $sql = "SELECT * from `products` order by num desc;";
    $title = "Result";
  }
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
  <link rel="stylesheet" href="../css/index_list.css">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
	<script src="//code.jquery.com/jquery-1.10.2.js"></script>
	<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
	<script type="text/javascript">
		var value = "";
    var scale = 27;

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

    function check_freegoods(){
      var freegoods = 'y';
      var handpicked = 'n';
      var popular = 'n';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index_list.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }else{
        var location = "./index_list.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }

      // console.log(jQuery(window).scrollTop());
      window.location.href = location;
    }

    function check_handpicked(){
      var freegoods = 'n';
      var handpicked = 'y';
      var popular = 'n';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index_list.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }else{
        var location = "./index_list.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }
      window.location.href = location;
    }

    function check_popular(){
      var freegoods = 'n';
      var handpicked = 'n';
      var popular = 'y';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index_list.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }else{
        var location = "./index_list.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }
      window.location.href = location;
    }


    $(document).ready(function() {
      $("#big_data_select").change(function(event) {
        var big_data = $("#big_data_select").val();
        var freegoods = 'n';
        var handpicked = 'n';
        var popular = 'n';
        if(big_data=='none'){
          var location = "./index_list.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
        }else{
          var location = "./index_list.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
        }
        window.location.href = location;
      });
    });


    function read_more(){
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location1 = "./read_more.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }else{
        var location1 = "./read_more.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }
      $.ajax({
        url: location1,
        type: 'POST',
        data: {scale : scale}
      })
      .done(function(result) {
        console.log("success");
        if(result==''){
          $("#read_more_button").hide();
        }else{
          $("#load_product").append(result);
          scale += 27;
        }
      })
      .fail(function() {
        console.log("error");
      })
      .always(function() {
        console.log("complete");
      });
    }

    // $(document).ready(function() {
    //
    //   $("#read_more_button").click(function(event) {
    //
    //   });
    // });

	</script>
</head>
<body>
   <div id="filter_div">
     <ul id="title_ul">
       <li id="title">&nbsp;&nbsp;&nbsp;Products</li>
     </ul>
     <ul id="select_ul">
       <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="#" onclick="check_popular()" value="" id="popular" <?=$popular_bold?>>Popular</a></li>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a href="#" onclick="check_handpicked()" value="" id="handpicked" <?=$handpicked_bold?>>Handpicked</a></li>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li><a  href="#" onclick="check_freegoods()" value="" id="freegoods" <?=$freegoods_bold?>>FreeGoods</a></li>
     </ul>
     <div class="">
       <select class="" id="big_data_select">
         <option value="none" <?=$selected1?>>All Categories</option>
         <option value="photos" <?=$selected2?>>Photos</option>
         <option value="graphics" <?=$selected3?>>Graphics</option>
         <option value="fonts" <?=$selected4?>>Fonts</option>
       </select>
     </div>
    </div>

	<div class="list_container">
	  <div id="load_product">
      <br><br>
		<?php
		// 모든 레코드를 가져오는 로직
		for ($i=$start; ($i<$start+SCALE) && ($i< $total_record); $i++){
	 // 가져올 레코드 위치 이동
			mysqli_data_seek($result, $i);

	 // 하나 레코드 가져오기
			$row = mysqli_fetch_array($result);
			$item_num = $row["num"];
			$item_name = $row["username"];
			$price = $row["price"];
      $item_price = $price/100;
      $item_email = $row["email"];

			$img_copy_name0 = $row["img_file_copied1"];

			$item_hit = $row["hit"];
			$item_date = $row["regist_day"];
			$item_date = substr($item_date, 0, 10);
			$item_subject = str_replace(" ", "&nbsp;", $row["subject"]);

			// 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
			if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
					$main_img = $img_copy_name0;

			}
			?>
      <div class="img_div">
        <figure class="snip1368">
          <a href="#">
            <img id="main_img" src="../img/openmarket.png" alt="sample30" />
          </a>
          <div class="hover_img">
            <img src="../img/logo.png" alt="" style="width:25px; height:25px;"><!--가져다 댔을때-->
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
                by&nbsp;<a href="#" class=""><?=$item_email?></a>
                in&nbsp;<a href="#" class=""><?=$big_data?></a>
            </div>
          </div>
          <figcaption>
            <div class="icons">
              <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Like</span> <br>
              <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Save</span>
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
      if($number!=0){
      ?>
      <button type="button" id="read_more_button" onclick="read_more()">...Read More...</button>
      <?php
      }
       ?>
      <br><br>
      </div> <!-- end of page_num -->

</div>

</body>
</html>
