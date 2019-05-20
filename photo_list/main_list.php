<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/create_table.php";

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";

create_table($conn, "products"); //가입인사 게시판 테이블 생성


//**************************************************************
$mode=$num="";
$row = "";
$dis_id=$dis_num=$dis_date=$dis_nick=$dis_content = "";
$dis_ripple_result = "";
$sql=$result=$total_record=$total_page=$start="";
//**************************************************************
if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
$find = test_input($_POST["find"]); //subject, content, id
$search = test_input($_POST["search"]);
$q_search = mysqli_real_escape_string($conn, $search);
$sql = "SELECT * from `products` where $find like '%$q_search%';";
}else{
$sql = "SELECT * from `products` order by num desc";

}
$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result);
// 한 페이지에 보여지는 게시글수

$rows_scale=12;

// 블럭의 갯수
$pages_scale=3;

// 전체 페이지 수 ($total_page) 계산
$total_pages= ceil($total_record/$rows_scale);


if(empty($_GET['page'])){
		$page=1;  // 첫째 페이지를 1페이지로 초기화
}else{
		$page = $_GET['page'];
}


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



$sql2= "SELECT count(num) from `products`";
$result1 = mysqli_query($conn, $sql2);
$row= mysqli_fetch_array($result1); //전체 게시글의 수

$total_count=$row[0];




if(isset($_POST['price_range'])){

//set conditions for filter by price range
$whereSQL = $orderSQL = '';
$priceRange = $_POST['price_range'];
if(!empty($priceRange)){
$priceRangeArr = explode(',', $priceRange);
$whereSQL = "WHERE price BETWEEN '".$priceRangeArr[0]."' AND '".$priceRangeArr[1]."'";
$orderSQL = " ORDER BY price ASC ";
}else{
$orderSQL = " ORDER BY created DESC ";
}

}



?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
  <meta charset="utf-8">
  <title></title>
  <link rel="stylesheet" href="../css/photo.css">

  <link rel="stylesheet" href="https://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css" />
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

  <script type="text/javascript">
    var value = "";
		// 첫번째 선택지
    function select(value) {
      var text = "" + value;
      document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
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
			document.getElementById("header_logout_form_div2_3_span_1").innerHTML = text;
		}
		function mouse_over1() {
      document.getElementById('change_img').src = "../img/up.png";
    }

    function mouse_out1() {
      document.getElementById('change_img').src = "../img/down.png";
    }
		//


  </script>
</head>

<body>
	<?php
	// include "../lib/header_logout_form_in_folder.php";
	 ?>
  <div class="main_div">

    <div id="filter_div">
      <div class="filter_container">
        <div class="filter_container_div_1">
          <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
            <span id="header_logout_form_div2_3_span">All</span>
            <img id="change1_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
          </a>
          <ul id="header_logout_form_div2_3_ul_1">
            <li class="header_logout_form_div2_3_ul_li_1" id="3D" onclick="select('3D')" value="3D"><a href="#">3D</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Add-One" onclick="select('Add-One')" value="Add-One"><a href="#">Add-One</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Fonts" onclick="select('Fonts')" value="Fonts"><a href="#">Fonts</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Graphics" onclick="select('Graphics')" value="Graphics"><a href="#">Graphics</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Photos" onclick="select('Photos')" value="Photos"><a href="#">Photos</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Templates" onclick="select('Templates')" value="Templates"><a href="#">Templates</a></li>
            <li class="header_logout_form_div2_3_ul_li_1" id="Web Thems" onclick="select('Web Thems')" value="Web Thems"><a href="#">Web Thems</a></li>
          </ul>
        </div>
        <div class="filter_container_div_2">
          <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over1()" onmouseout="mouse_out1()">
            <span id="header_logout_form_div2_3_span_1">All</span>
            <img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
          </a>
          <ul id="header_logout_form_div2_3_ul_2">
            <li class="header_logout_form_div2_3_ul_li_2" id="Abstract" onclick="select('Abstract')" value="Abstract"><a href="#">Abstract</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Animals" onclick="select('Animals')" value="Animals"><a href="#">Animals</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Architecture" onclick="select('Architecture')" value="Architecture"><a href="#">Architecture</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Arts &Entertainment" onclick="select('Arts &Entertainment')" value="Arts &Entertainment"><a href="#">Arts &Entertainment</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Beauty & Fashion" onclick="select('Beauty & Fashion')" value="Beauty & Fashion"><a href="#">Beauty & Fashion</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Business" onclick="select('Business')" value="Business"><a href="#">Business</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Education" onclick="select('Education')" value="Education"><a href="#">Education</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Food & Drink" onclick="select('Food & Drink')" value="Food & Drink"><a href="#">Food & Drink</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Holidays" onclick="select('Holidays')" value="Holidays"><a href="#">Holidays</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Animals" onclick="select('Animals')" value="Animals"><a href="#">Animals</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Industrial" onclick="select('Industrial')" value="Industrial"><a href="#">Industrial</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Nature" onclick="select('Nature')" value="Nature"><a href="#">Nature</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="People" onclick="select('People')" value="People"><a href="#">People</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Sports" onclick="select('Sports')" value="Sports"><a href="#">Sports</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Technology" onclick="select('Technology')" value="Technology"><a href="#">Technology</a></li>
            <li class="header_logout_form_div2_3_ul_li_2" id="Transportation" onclick="select('Transportation')" value="Transportation"><a href="#">Transportation</a></li>

          </ul>
        </div>
        <div class="switch_div">
						<input class="apple-switch" type="checkbox">
          <span class="certified_span">Certified(<?=$total_count?>)</span>
        </div>

        <div class="filter_container_div_3">
          <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
            <span id="header_logout_form_div2_3_span">Filter</span>
            <img id="change_img" src="../img/down.png" style="width:15px; height:15px;" />&nbsp;&nbsp;&nbsp;
          </a>
          <ul id="header_logout_form_div2_3_ul_3">
            <li class="header_logout_form_div2_3_ul_li_2" name="find">
              <form name="board_form" action="main_list.php?mode=search" method="post">
                <div class="container">

                  <?php
                      $minimum_range = 1000;
                      $maximum_range = 5000;
                      ?>

                  <div class="range_slider" style="width:400px ">
                    <div class="col-md-1">
                      <input type="text" style="width:40px;" name="minimum_range" id="minimum_range" class="form-control" value="<?php echo $minimum_range; ?>" />
                    </div>
                    <div class="col-md-8" style="">
                      <div id="price_range"></div>
                    </div>
                    <div class="col-md-2">
                      <input type="text" style="width:40px;" name="maximum_range" id="maximum_range" class="form-control" value="<?php echo $maximum_range; ?>" />
                    </div>
                  </div>
                  <br />

              </form>
            </div>
          </li>
          <hr>
            <li class="header_logout_form_div2_3_ul_li_2"><label><input type="checkbox" /> check1</label></li>
            <li class="header_logout_form_div2_3_ul_li_2"><label><input type="checkbox" /> check1</label> </li>
            <li class="header_logout_form_div2_3_ul_li_2"><label><input type="checkbox" /> check1</label></li>
          </ul>
          <input type="text" name="search" value="">
        </div>
    </div>
  </div>

  <div class="list_container">
    <div class="info_div">
      asdasdf
    </div>
      <div id="load_product">
        <script>
          $(document).ready(function() {

            $("#price_range").slider({
              range: true,
              min: 1000,
              max: 5000,
              values: [<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>],
              slide: function(event, ui) {
                $("#minimum_range").val(ui.values[0]);
                $("#maximum_range").val(ui.values[1]);
                load_product(ui.values[0], ui.values[1]);
              }
            });

            load_product(<?php echo $minimum_range; ?>, <?php echo $maximum_range; ?>);

            function load_product(minimum_range, maximum_range) {
              $.ajax({
                url: "add_list.php",
                method: "POST",
                data: {
                  minimum_range: minimum_range,
                  maximum_range: maximum_range
                },
                success: function(data) {
                  $('#load_product').fadeIn('slow').html(data);
                }
              });
            }

          });
        </script>
            </div>
    <div class="clear"></div>
    <div class="move_page">

      <?php
        #----------------이전블럭 존재시 링크------------------#
        // 4>3 $pages_scale은 3인데 3보다 시작 페이지가
        if($start_page >= $pages_scale){
        $go_page= $start_page - $pages_scale;
        echo "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp  </a>";
        }
        #----------------이전페이지 존재시 링크------------------#
        if($pre_page){
        echo "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page'> PREV  </a>";
        }
        #--------------바로이동하는 페이지를 나열---------------#
        for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
        if($dest_page == $page){
        echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
        }else{
        echo "<a id='move_page' href='main_list.php?mode=$mode&page=$dest_page'> $dest_page </a>";
        }
        }
        #----------------이전페이지 존재시 링크------------------#
        if($next_page){
        echo "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page'> NEXT</a>";
        }
        #---------------다음페이지를 링크------------------#
        if($total_pages >= $start_page+ $pages_scale){
        $go_page= $start_page+ $pages_scale;
        echo "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp </a>";
        }
      ?>
    </div>
  </div>
    <div class="list_categories">
      <h4 class="img_h4">Shop Photo Categories</h4>
      <hr>
      <div class="img_list">
          <a href="#"><div class="img_anima"></div>
          <h4 class="img_title"> Abstract</h4></a>
      </div>
      <div class="img_list">
          <a href="#"><div class="img_anima"></div>
          <h4 class="img_title"> Abstract</h4></a>
      </div>
      <div class="img_list">
          <a href="#"><div class="img_anima"></div>
          <h4 class="img_title"> Abstract</h4></a>
      </div>
      <div class="img_list">
          <a href="#"><div class="img_anima"></div>
          <h4 class="img_title"> Abstract</h4></a>
      </div>
    </div>

  </div>
</body>

</html>
