<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";


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
}else{
  $freegoods='n';
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
  if($handpicked=='y'){
    $handpicked_bold = 'style = "font-weight:bold"';
  }
}else{
  $handpicked='n';
}

if(isset($_GET["popular"])){
  $popular=$_GET["popular"];
  if($popular=='y'){
    $popular_bold = 'style = "font-weight:bold"';
  }
}else{
  $popular='n';
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
	<link rel="stylesheet" href="./css/product_list.css">
	<link rel="stylesheet" href="./css/photo.css">
	<link rel="stylesheet" href="./css/keyframe.css">
  <link rel="stylesheet" href="./css/index_list.css">
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
			document.getElementById('change1_img').src = "./img/up.png";
		}

		function mouse_out() {
			document.getElementById('change1_img').src = "./img/down.png";
		}
		// 두번째 선택지
		function select(value) {
			var text = "" + value;
			document.getElementById("filter_form_div2_3_span_1").innerHTML = text;
		}

		function mouse_over1() {
			document.getElementById('change_img').src = "./img/up.png";
		}

		function mouse_out1() {
			document.getElementById('change_img').src = "./img/down.png";
		}

		function changeimage() {
	    var image = document.getElementById('like');
	    if (image.src.match("cart")) {
	        image.src = "./img/logo.png";
	    } else {
	        image.src = "./img/cart.png";
	    }
		}

    function check_freegoods(){
      var freegoods = 'y';
      var handpicked = 'n';
      var popular = 'n';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
      }else{
        var location = "./index.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
      }
      window.location.href = location;
    }


    function check_handpicked(){
      var freegoods = 'n';
      var handpicked = 'y';
      var popular = 'n';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
      }else{
        var location = "./index.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
      }
      window.location.href = location;

    }

    function check_popular(){
      var freegoods = 'n';
      var handpicked = 'n';
      var popular = 'y';
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location = "./index.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
      }else{
        var location = "./index.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
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
          var location = "./index.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
        }else{
          var location = "./index.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular+"#title";
        }
        window.location.href = location;
        $('.window').animate( { scrollTop : $($("#filter_div")).offset().top }, 500 );
      });
    });

    function read_more(){
      var big_data = $("#big_data_select").val();
      if(big_data!='none'){
        var location1 = "./index_list/read_more.php?big_data="+big_data+"&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
      }else{
        var location1 = "./index_list/read_more.php?big_data=none&freegoods="+freegoods+"&handpicked="+handpicked+"&popular="+popular;
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

    $(document).ready(function() {
      $(".likes_img_class").click(function(event) {
        var n = $(".likes_img_class").index(this);
        var num_num = $(".hidden_num:eq("+n+")").val();
        var likes_img_value = $(".likes_img_value:eq("+n+")").val();
        console.log(n);
        console.log(num_num);
        console.log(likes_img_value);
         $.ajax({
           url: './lib/like_dml.php?mode=go_like', // 데이터 보내서 작업되어질 url
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
             if($(".likes_img_class:eq("+n+")").attr("src")!="./img/hover_like.png"){
               $(".likes_img_class:eq("+n+")").attr("src", "./img/hover_like.png");
             }else{
               $(".likes_img_class:eq("+n+")").attr("src", "./img/like.png");
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
    });

	</script>
</head>
<body>
  <br><br>
   <div id="filter_div">
     <ul id="title_ul">
       <li id="title">&nbsp;&nbsp;&nbsp;Products</li>
     </ul>
     <br>
     <ul id="select_ul">
       <li onclick="check_popular()" value="" id="popular" <?=$popular_bold?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Popular</li>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li onclick="check_handpicked()" value="" id="handpicked" <?=$handpicked_bold?>>Handpicked</li>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<li onclick="check_freegoods()" value="" id="freegoods" <?=$freegoods_bold?>>FreeGoods</li>
       <li id="select_ul_li_float_right">
         <select class="" id="big_data_select">
          <option value="none" <?=$selected1?>>All Categories</option>
          <option value="photos" <?=$selected2?>>Photos</option>
          <option value="graphics" <?=$selected3?>>Graphics</option>
          <option value="fonts" <?=$selected4?>>Fonts</option>
        </select>
        </li>
     </ul>
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
      $item_no = $row["no"];
			$item_num = $row["num"];
			$item_name = $row["username"];
			$item_price = $row["price"];
      $item_email = $row["email"];
			$img_copy_name1 = $row["img_file_copied1"];
      $img_copy_name1 = "./data/img/".$img_copy_name1;
			$item_hit = $row["hit"];
			$item_date = $row["regist_day"];
			$item_date = substr($item_date, 0, 10);
      $item_big_data = $row["big_data"];
			$item_subject = str_replace(" ", "&nbsp;", $row["subject"]);
      $item_freegoods=$row["freegoods"];

      $sql_partner = "SELECT partner from member where no = '$item_no';";
      $result_partner = mysqli_query($conn, $sql_partner);
      $row_partner = mysqli_fetch_array($result_partner);
      $partner = $row_partner['partner'];

      if($partner=='n' && $item_freegoods=='n'){
        $freegoods_img="./img/hover_logo.png";
      }else{
        $freegoods_img="./img/free_partner_logo.png";
      }
      if(isset($member_no)){
        $sql_likes = "SELECT product_num from likes where no = '$member_no';";
        $result_likes = mysqli_query($conn, $sql_likes);
        $total_record_likes = mysqli_num_rows($result_likes);

        $likes_img = "./img/hover_like.png";
        $likes_img_value = "n";

        for($j=0;$j<$total_record_likes;$j++){
          mysqli_data_seek($result_likes, $j);
          $row_likes = mysqli_fetch_array($result_likes);
          $likes = $row_likes['product_num'];
          if($likes == $item_num){
            $likes_img = "./img/like.png";
            $likes_img_value = "y";
            break;
          }
        }
      }else{
        $likes_img = '';
        $likes_img_value = '';
      }

			// 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
			if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
					$main_img = $img_copy_name0;
			}
			?>
      <div class="img_div">
        <figure class="snip1368">
          <a href="./shop/shop_view.php?num=<?=$item_num?>">
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
                by&nbsp;<a href="./member_profile/profile_view.php?mode=shop&email=<?=$item_email?>" class=""><?=$item_email?></a>
                in&nbsp;<a href="./product_list/list.php?big_data=<?=$item_big_data?>" class=""><?=$item_big_data?></a>
            </div>
          </div>
          <?php
            if(isset($_SESSION['no'])){
              echo '
              <figcaption>
                <div class="icons">
                  <input type="hidden" class="hidden_num" value="'.$item_num.'"">
                      <img class="likes_img_class" src="'.$likes_img.'" alt="" style="width:25px; height:25px;" ><br>
                  <input type="hidden" class="likes_img_value" value="'.$likes_img_value.'">
                </div>
              </figcaption>
              ';
            }
          ?>
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
      <button type="button" id="read_more_button" onclick="read_more()">Load More Products</button>
      <?php
      }
       ?>
      <br><br>
      </div> <!-- end of page_num -->

</div>

</body>
</html>
