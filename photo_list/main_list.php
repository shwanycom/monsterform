

<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/create_table.php";


// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";

if(isset($_GET["partner"])){
  $check_partner=$_GET["partner"];
}else{
	$check_partner="n";
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
}else{
	$handpicked='animal';
}

if(isset($_GET["populer"])){
  $populer=$_GET["populer"];
}else{
	$populer='y';
}


create_table($conn, "products"); //가입인사 게시판 테이블 생성
//**************************************************************
$mode=$num="";
$row = "";
$sql=$result=$total_record=$total_page=$start=$page="";
//**************************************************************

if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
		$search = test_input($_POST["search"]);
			$q_search = mysqli_real_escape_string($conn, $search);
		$sql="select * from products where subject like '%$q_search%';";
	}else{
		$sql = "select * from `products` order by num asc";
}

if(empty($_GET['page'])){
	$page=1;  // 첫째 페이지를 1페이지로 초기화
}else{
	$page = $_GET['page'];
}

$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result);
// 한 페이지에 보여지는 게시글수

$rows_scale=12;

// 블럭의 갯수
$pages_scale=3;

// 전체 페이지 수 ($total_page) 계산
$total_pages= ceil($total_record/$rows_scale);


// 현재 페이지 시작 위치 = (페이지 당 글 수 * (현재페이지 -1))  [[ EX) 현재 페이지 2일 때 => 3*(2-1) = 3 ]]
$start_row= $rows_scale * ($page -1) ;

// 이전 페이지 = 현재 페이지가 1일 경우. null값.
$pre_page= $page>1 ? $page-1 : NULL;

// 다음 페이지 = 현재페이지가 전체페이지 수와 같을 때  null값.
$next_page= $page < $total_pages ? $page+1 : NULL;

// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1  [[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($page / $pages_scale ) -1 ) * $pages_scale +1 ;

// 현재 블럭 마지막 페이지
$end_page= ($total_pages >= ($start_page + $pages_scale)) ? $start_page + $pages_scale-1 : $total_pages;

// number는 테이블에서 레코드를 삭제했을때 빈 공백이 생기는걸 방지하기 위하여 사용
$number=$total_record- $start_row;


?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
	<meta charset="utf-8">
	<title></title>
	<link rel="stylesheet" href="../css/photo.css?">
	<link rel="stylesheet" href="../css/keyframe.css?ver=4">
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

		//파트너 클릭시
				function checklilst() {
					var checked = document.getElementById('switch_checkbox').checked;
					var total=document.getElementById('filter_checkbox').checked;
					var populer_check=document.getElementById('populer_checkbox').checked;
					if (checked == false) {
						if(total == true){
							var save_url= "fetch.php?mode=imglist&handpicked=animal&partner=n";
						}else if(total==false){
							var save_url= "fetch.php?mode=imglist&handpicked=total&partner=n";
						}else if(populer_check == true){
							var save_url= "fetch.php?mode=imglist&populer=y&partner=n";
						}else{
							var save_url= "fetch.php?mode=imglist&populer=n&partner=n";
						}
						$.ajax({

							type: "POST",
							url: save_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					} else {
						if(total == true){
							var save_url= "fetch.php?mode=imglist&partner=y&handpicked=animal";
						}else if(total == false){
							var save_url= "fetch.php?mode=imglist&handpicked=total&partner=y";
						}else if(populer_check == true){
							var save_url= "fetch.php?mode=imglist&populer=y&partner=y";
						}else{
							var save_url= "fetch.php?mode=imglist&populer=n&partner=y";
						}


						$.ajax({
							type: "POST",
								url: save_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					}
				}

							//animal클릭시
				function checkfilter() {
					var checked = document.getElementById('filter_checkbox').checked;
					var partner_check = document.getElementById('switch_checkbox').checked;

					if (checked == false) {

						if(partner_check == true){
							var saved_url= "fetch.php?mode=animallist&partner=y&handpicked=total";
						}else{
							var saved_url= "fetch.php?mode=animallist&partner=n&handpicked=total";
							}

							$.ajax({
							type: "POST",
							url: saved_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					} else {

						if(partner_check == true){

							var saved_url= "fetch.php?mode=animallist&partner=y&handpicked=animal";
						}else{
							var saved_url= "fetch.php?mode=animallist&partner=n&handpicked=animal";
						}

						$.ajax({
							type: "POST",
							url: saved_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					}
				}
// checkgroup : $(".filter_checkbox").val(), search : $("#search_text").val()
				//search function
				function search() {
					$("#search_button").click(function(event) {

						if(($("#switch_checkbox").is(":checked")==true) && ($("#filter_checkbox").is(":checked")==false) && ($("#populer_checkbox").is(":checked")==false)){
							var saved_url= "fetch.php?mode=search&partner=y&handpicked=total&populer=n";
						}else if(($("#switch_checkbox").is(":checked")==true) && ($("#filter_checkbox").is(":checked")==true) && ($("#populer_checkbox").is(":checked")==false)){
							var saved_url= "fetch.php?mode=search&partner=y&handpicked=animal&populer=n";
						}else if(($("#switch_checkbox").is(":checked")==true) && ($("#filter_checkbox").is(":checked")==false) && ($("#populer_checkbox").is(":checked")==true)){
							var saved_url= "fetch.php?mode=search&partner=y&handpicked=total&populer=y";
						}else if(($("#switch_checkbox").is(":checked")==false) && ($("#filter_checkbox").is(":checked")==false) && ($("#populer_checkbox").is(":checked")==false)){
							var saved_url= "fetch.php?mode=search&partner=n&handpicked=total&populer=n";
						}else if(($("#switch_checkbox").is(":checked")==false) && ($("#filter_checkbox").is(":checked")==true) && ($("#populer_checkbox").is(":checked")==false)){
							var saved_url= "fetch.php?mode=search&partner=n&handpicked=animal&populer=n";
						}else if(($("#switch_checkbox").is(":checked")==false) && ($("#filter_checkbox").is(":checked")==false) && ($("#populer_checkbox").is(":checked")==true)){
							var saved_url= "fetch.php?mode=search&partner=n&handpicked=total&populer=y";
						}else{
							var saved_url= "fetch.php?mode=search&partner=n&handpicked=total&populer=n";
						}

						var search_text = $("#search_text").val();
							$.ajax({
								type: "POST",
								url: saved_url,
								data : {"search": search_text},
								success: function(data) {
									$('#load_product').fadeIn('slow').html(data);
								},
								error: function() {
									alert('it broke');
								},
							});
					});
				}

				//populer check_box
				function checkpopuler() {
					var populer_check = document.getElementById('populer_checkbox').checked;
					var partner_check = document.getElementById('switch_checkbox').checked;

					if (populer_check == false) {

						if(partner_check == true){
							var saved_url= "fetch.php?mode=populer&populer=n&partner=y";
						}else{
							var saved_url= "fetch.php?mode=populer&populer=n&partner=n";
							}

							$.ajax({
							type: "POST",
							url: saved_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					} else{
						if(partner_check == true){

							var saved_url= "fetch.php?mode=populer&populer=y&partner=y";
						}else{
							var saved_url= "fetch.php?mode=populer&populer=y&partner=n";
						}

						$.ajax({
							type: "POST",
							url: saved_url,
							success: function(data) {
								$('#load_product').fadeIn('slow').html(data);
							},
							error: function() {
								alert('it broke');
							},
						});
					}
				}

				$(document).ready(function() {
    //라디오 요소처럼 동작시킬 체크박스 그룹 셀렉터
    			$('input[type="checkbox"][name="checkgroup"]').click(function(){
		        //클릭 이벤트 발생한 요소가 체크 상태인 경우
		        if ($(this).prop('checked')) {
		            //체크박스 그룹의 요소 전체를 체크 해제후 클릭한 요소 체크 상태지정
		            $('input[type="checkbox"][name="checkgroup"]').prop('checked', false);
		            $(this).prop('checked', true);
		        }
    			});
				});

				function changeimage() {
				    var image = document.getElementById('like');
				    if (image.src.match("cart")) {
				        image.src = "../img/logo.png";
				    } else {
				        image.src = "../img/cart.png";
				    }
				}
	</script>
</head>

<body onload="search()">
	<section>
		<article class="main">
			<div id="filter_div">
				<div class="filter_container">
					<div class="filter_container_div_1">
						<a href="#" id="filter_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
							<span id="filter_form_div2_3_span">All</span>
							<img id="change1_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
						</a>
						<ul id="filter_form_div2_3_ul_1">
							<li class="filter_form_div2_3_ul_li_1" id="3D" onclick="Categorie('3D')" value="3D"><a href="#">3D</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Add-One" onclick="Categorie('Add-One')" value="Add-One"><a href="#">Add-One</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Fonts" onclick="Categorie('Fonts')" value="Fonts"><a href="#">Fonts</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Graphics" onclick="Categorie('Graphics')" value="Graphics"><a href="#">Graphics</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Photos" onclick="Categorie('Photos')" value="Photos"><a href="#">Photos</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Templates" onclick="Categorie('Templates')" value="Templates"><a href="#">Templates</a></li>
							<li class="filter_form_div2_3_ul_li_1" id="Web Thems" onclick="Categorie('Web Thems')" value="Web Thems"><a href="#">Web Thems</a></li>
						</ul>
					</div>
					<div class="filter_container_div_2">
						<a href="#" id="filter_form_div2_3_a" onmouseover="mouse_over1()" onmouseout="mouse_out1()">
							<span id="filter_form_div2_3_span_1">All</span>
							<img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
						</a>
						<ul id="filter_form_div2_3_ul_2">
							<li class="filter_form_div2_3_ul_li_2" id="Abstract" onclick="select('Abstract')" value="Abstract"><a href="#">Abstract</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Animals" onclick="select('Animals')" value="Animals"><a href="#">Animals</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Architecture" onclick="select('Architecture')" value="Architecture"><a href="#">Architecture</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Arts &Entertainment" onclick="select('Arts &Entertainment')" value="Arts &Entertainment"><a href="#">Arts &Entertainment</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Beauty & Fashion" onclick="select('Beauty & Fashion')" value="Beauty & Fashion"><a href="#">Beauty & Fashion</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Business" onclick="select('Business')" value="Business"><a href="#">Business</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Education" onclick="select('Education')" value="Education"><a href="#">Education</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Food & Drink" onclick="select('Food & Drink')" value="Food & Drink"><a href="#">Food & Drink</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Holidays" onclick="select('Holidays')" value="Holidays"><a href="#">Holidays</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Animals" onclick="select('Animals')" value="Animals"><a href="#">Animals</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Industrial" onclick="select('Industrial')" value="Industrial"><a href="#">Industrial</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Nature" onclick="select('Nature')" value="Nature"><a href="#">Nature</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="People" onclick="select('People')" value="People"><a href="#">People</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Sports" onclick="select('Sports')" value="Sports"><a href="#">Sports</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Technology" onclick="select('Technology')" value="Technology"><a href="#">Technology</a></li>
							<li class="filter_form_div2_3_ul_li_2" id="Transportation" onclick="select('Transportation')" value="Transportation"><a href="#">Transportation</a></li>
						</ul>
					</div>
					<div class="switch_div">
						<input class="switch_check" type="checkbox" id="switch_checkbox" onclick="checklilst()" value="certified" name="certified_check">
						<span class="certified_span">Certified</span>
					</div>
						<div class="filter_container_div_3">
							<a href="#" id="filter_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
								<span id="filter_form_div2_3_span">Filter</span>
								<img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
							</a>
							<ul id="filter_form_div2_3_ul_3">
								<li class="filter_form_div2_3_ul_li_2" name="find">
						</li>
						<li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="filter_checkbox" onclick="checkfilter()" name="checkgroup" value="handpicked"/> handpicked</label></li>
						<li class="filter_form_div2_3_ul_li_2"><label><input type="checkbox" id="populer_checkbox" class="checkbox" onclick="checkpopuler()" name="checkgroup" value="populer"/> populer</label></li>
						</ul>
					</div>
					&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
					<input type="text" name="search" value="" id="search_text"><button type="button" id="search_button">search</button>
			</div>
		</div>
		<script type="text/javascript">

		</script>
		<div class="list_container">
	<div id="load_product">
		<?php
		// 모든 레코드를 가져오는 로직
		for ($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
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
										<img id="main_img" src="./data/<?=$main_img?>" alt="sample30" />
									</a>
									<div class="hover_img">
										<img src="../img/logo.png" alt="" style="width:30px; height:20px; margin-right: 30px">
									</div>
									<div class="meta">
										<a href="#" class="free_download">
											 $<?=$price?>
										</a>
										<strong class="title">
											<a href="#" class="title_a">
												<span class="title_a_span">  <?=$item_subject?></span> <!-- 제목 들어가는 부분 Bulb Layered Font -->
											</a>
										</strong>
									</div>
									<span class="subtitle">
										by <a href="#" class="shop_name"> <?=$item_name?></a>
										<!--user id가 들어가는 부분-->
										in <a href="#" class="shop_name">Fonts</a>
									</span>
									<figcaption>
										<div class="icons">
											<a href="#"><img src="../img/cart.png" alt="" style="width:50px; height:20px;" class="checkimg" id="like" onclick="changeimage()"></a> <br>
											<!-- <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Save</span> -->
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
						}else if(isset($_GET["populer"])){
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&partner=$populer'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}else{
							echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}
					}
					if($pre_page){
						if(isset($_GET["handpicked"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&handpicked=$handpicked'> PREV   </a>";
						}else if(isset($_GET["partner"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&partner=$check_partner'> PREV  </a>";
						}else if(isset($_GET["populer"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&partner=$populer'> PREV  </a>";
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
							}else if(isset($_GET["populer"])){
								echo "<a class='page_button' href='main_list.php?mode=$mode&page=$dest_page&partner=$populer'> $dest_page  </a>";
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
						}else if(isset($_GET["populer"])){
							echo "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&partner=$populer'> NEXT  </a>";
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
						}else if(isset($_GET["populer"])){
							echo "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&partner=$populer'>&nbsp&nbsp....&nbsp&nbsp  </a>";
						}else{
							echo  "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp </a>";
						}
					}
					?>
				</div>
		</div>

</div>
	</form>



	  <div style="clear: both;"></div>
		<div class="list_categories">
			<h4 class="img_h4">Shop Photo Categories</h4>
			<hr>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Abstract</h4>
				</a>
			</div>

			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> 	Animals</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> 	Architecture</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Arts &Entertainment</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Beauty & Fashion</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Business</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Education</h4>
				</a>
			</div>

			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> 	Food & Drink</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Holidays</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Animals</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> 	Industrial</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Nature</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> People</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Sports</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Technology</h4>
				</a>
			</div>
			<div class="img_list">
				<a href="#">
					<div class="img_anima"></div>
					<h4 class="img_title"> Transportation</h4>
				</a>
			</div>
		</div>
      </div>
		</article>
	</section>


</body>

</html>
