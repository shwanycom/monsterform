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

if(isset($_GET["big_data"])){
  $big_data=$_GET["big_data"];
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


if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
    $search = test_input($_GET["search_text"]);
    $q_search = mysqli_real_escape_string($conn, $search);

    if($partner=='n' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` where big_data = '$big_data' and subject like '%$q_search%' order by num desc;";
      $title = "Result";
    }else if($partner=='n' && $handpicked=='y' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='n' and p.handpicked='y' and p.subject like '%$q_search%' order by p.num desc;";
      $title = "Result - HandPicked";
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'n';
    }else if($partner=='n' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='n' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Popular";
      $popular_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'n';
      $popular_default = 'y';
    }else if($partner=='n' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner = 'n' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Popular";
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'n';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='y' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner = 'y' and p.handpicked = 'y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Popular";
      $partner_checked = 'checked';
      $popular_checked = 'checked';
      $handpicked_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'y';
      $popular_default = 'y';
    }else if($partner=='y' && $handpicked=='n' && $popular=='n'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='y' and p.subject like '%$q_search%' order by p.num desc";
      $title = "Result - Partner's Popular";
      $partner_checked = 'checked';
      $partner_default = 'y';
      $handpicked_default = 'n';
      $popular_default = 'n';
    }else if($partner=='y' && $handpicked=='n' && $popular=='y'){
      $sql = "SELECT * from `products` p inner join `member` m on p.email=m.email where p.big_data = '$big_data' and m.partner='y' and p.subject like '%$q_search%' order by p.hit desc;";
      $title = "Result - Partner's Popular";
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
}else{

  $sql = "SELECT * from `products` where big_data = '$big_data'";
  $title = $big_data;

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

      if(partner=='n'){
        partner='y';
        var location = "./list.php?big_data=photos&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text=";
      }else{
        partner='n';
        var location = "./list.php?big_data=photos&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text=";
      }
      window.location.href = location;
    }

    function products_search_text(){
      var partner = document.getElementById('partner').value;
      var handpicked = document.getElementById('handpicked').value;
      var popular = document.getElementById('popular').value;
      var search_text = document.getElementById('products_search_text').value;
      var location = "./list.php?big_data=photos&mode=search&partner="+partner+"&handpicked="+handpicked+"&popular="+popular+"&search_text="+search_text;
      window.location.href = location;
    }


	</script>
</head>
<body>
	<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/header_in_folder.php";
   ?>
   <div id="filter_div">
     <div class="filter_container">
       <div class="switch_div">
         <input class="switch_check" type="checkbox" id="partner" value="<?=$partner_default?>" name="partner" onclick="check_partner()" <?=$partner_checked?>>
         <span class="certified_span">Certified</span>
       </div>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
         <div class="filter_container_div_3">
           <a href="#" id="filter_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
             <span id="filter_form_div2_3_span">Filter</span>
             <img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
           </a>
           <ul id="filter_form_div2_3_ul_3">
             <li class="filter_form_div2_3_ul_li_2" name="find">
         </li>
         <li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="handpicked" onclick="checkfilter()" name="checkgroup" value="<?=$handpicked_default?>" <?=$handpicked_checked?>/> handpicked</label></li>
         <li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="popular" class="checkbox" onclick="checkpopular()" name="checkgroup" value="<?=$popular_default?>" <?=$popular_checked?>/> popular</label></li>
         </ul>
       </div>
      <input type="text" name="" value="" id="products_search_text">
      <button type="button" id="search_button" onclick="products_search_text()">search</button>
   </div>
 </div>



		<div class="list_container">
	     <div id="load_product">
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
                        <span class="list_title_div_span_bold">게시물번호(순서)</span>
                        <span class="list_title_div_span_bold">게시물이름</span>
                      </a>
                      <a href="#" class="list_title_div_a_float_right">
                        M&nbsp; 5,000(가격)
                      </a>
                    </div>
                    <div class="">
                        by&nbsp;<a href="#" class="">shwanycom@gmail.com</a>
                        in&nbsp;<a href="#" class="">게시물 대분류</a>
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

	}
	?>
	<div class="move_page">
					<?php
					if($start_page >= $pages_scale){
						$go_page= $start_page - $pages_scale;
						if(isset($_GET["handpicked"])){
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&handpicked=$handpicked'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}else if(isset($_GET["partner"])){
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&partner=$check_partner'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}else if(isset($_GET["popular"])){
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&partner=$popular'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}else{
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}
					}
					if($pre_page){
						if(isset($_GET["handpicked"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&handpicked=$handpicked'> PREV   </a>";
						}else if(isset($_GET["partner"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&partner=$check_partner'> PREV  </a>";
						}else if(isset($_GET["popular"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&partner=$popular'> PREV  </a>";
						}else{
							echo  "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page'> PREV  </a>";
						}
					}
					for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
						if($dest_page == $page){
							echo "&nbsp;<b id='present_page'>$dest_page</b>&nbsp";
						}else{
							if(isset($_GET["handpicked"])){
								echo "<a id='move_page'  href='main_list.php?mode=$mode&page=$dest_page&handpicked=$handpicked'> $dest_page  </a>";
							}else if(isset($_GET["partner"])){
								echo "<a id='move_page' href='main_list.php?mode=$mode&page=$dest_page&partner=$check_partner'> $dest_page  </a>";
							}else if(isset($_GET["popular"])){
								echo "<a class='page_button' href='main_list.php?mode=$mode&page=$dest_page&partner=$popular'> $dest_page  </a>";
							}else{
								echo "<a id='move_page'  href='main_list.php?mode=$mode&page=$dest_page'> $dest_page </a>";
							}
						}
					}

					if($next_page){
						if(isset($_GET["handpicked"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&handpicked=$handpicked'> NEXT</a>";
						}else if(isset($_GET["partner"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&partner=$check_partner'> NEXT  </a>";
						}else if(isset($_GET["popular"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&partner=$popular'> NEXT  </a>";
						}else{
							echo  "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page'> NEXT</a>";
						}
					}

					if($total_pages >= $start_page+ $pages_scale){
						$go_page= $start_page+ $pages_scale;
						if(isset($_GET["handpicked"])){
							echo "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&handpicked=$handpicked'> &nbsp&nbsp....&nbsp&nbsp </a>";
						}else if(isset($_GET["partner"])){
							echo "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&partner=$check_partner'>&nbsp&nbsp....&nbsp&nbsp  </a>";
						}else if(isset($_GET["popular"])){
							echo "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&partner=$popular'>&nbsp&nbsp....&nbsp&nbsp  </a>";
						}else{
							echo  "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp </a>";
						}
					}
					?>
				</div>
		</div>

</div>
<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/footer_in_folder.php";
 ?>

</body>
</html>
