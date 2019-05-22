<?php


include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/db_connector.php";
$num="";
$mode="";
$row = "";
if(!isset($_POST["minimum_range"])){
	$minimum_range=0;
}
if(!isset($_POST["maximum_range"])){
	$maximum_range=4000;
}
if(isset($_POST["minimum_range"])){
  $minimum_range=$_POST["minimum_range"];
}
if(isset($_POST["maximum_range"])){
  $maximum_range=$_POST["maximum_range"];
}

if(isset($_GET["partner"])){
  $check_partner=$_GET["partner"];
}

if(isset($_GET["handpicked"])){
  $handpicked=$_GET["handpicked"];
	var_dump($handpicked);
}

//파트너만 클릭했을때
//금액만 조정했을때
//animal만 클릭했을때
//spoarts만 클릭했을때
//people만 클릭했을때


if(isset($_GET["mode"]) && $_GET["mode"] == "imglist"){
	if($check_partner=="n" ){
		$mode = $_GET["mode"];
		$query = "SELECT * from `products` order by num asc";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);

	}else if($check_partner=="y"){
		$mode = $_GET["mode"];
		$query = "select * from products p inner join member m on p.username=m.username where m.partner='n'and price BETWEEN '$minimum_range' AND '$maximum_range' ORDER BY price asc;";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);
	}
	}else{

	$query = "SELECT * FROM `products` WHERE price BETWEEN '$minimum_range' AND '$maximum_range' ORDER BY price asc";
	$result = mysqli_query($conn, $query);
	$row = mysqli_num_rows($result);
	}

if(isset($_GET["mode"]) && $_GET["mode"] == "animallist"){
	$mode = $_GET["mode"];
	if($handpicked=="total"){
		$query = "SELECT * from `products` order by num asc";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);

	}else if($handpicked=="animal"){
		$mode = $_GET["mode"];
		$query = "select* from products where handpicked ='n';";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);
	}

}

$total_record = mysqli_num_rows($result);

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

$output = '
<h4 align="center">Total Item - '.$total_record.'</h4>

';
if($total_record >= 0){

	// 모든 레코드를 가져오는 로직

for ($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
					 // 가져올 레코드 위치 이동
							mysqli_data_seek($result, $i);

					 // 하나 레코드 가져오기
							$row = mysqli_fetch_array($result);
		$output .= '
		<div class="img_div">
            <figure class="snip1368">
              <a href="#">
                <img id="main_img" src="./data/'.$row["img_file_copied1"].'" alt="sample30" />
              </a>
              <div class="hover_img">
                <img src="../img/logo.png" alt="" style="width:50px; height:20px;">
              </div>
              <div class="meta">
                <a href="#" class="free_download">
                  '.$row["price"].'
                </a>
                <strong class="title">
                  <a href="#" class="title_a">
                    <span class="title_a_span"> '.$row["subject"].'</span> <!-- 제목 들어가는 부분 Bulb Layered Font -->
                  </a>
                </strong>
              </div>
              <span class="subtitle">
                by <a href="#" class="shop_name">'.$row["username"].'</a>
                <!--user id가 들어가는 부분-->
                in <a href="#" class="shop_name">Fonts</a>
              </span>
              <figcaption>
                <div class="icons">
                  <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Like</span> <br>
                  <a href="#"><img src="../img/logo.png" alt="" style="width:50px; height:20px;" class="checkimg"></a><span>Save</span>
                </div>
              </figcaption>
            </figure>
          </div>
		';
 }

$output .='
			<div class="move_page">
			';
					if($start_page >= $pages_scale){
						$go_page= $start_page - $pages_scale;
						if(isset($_GET["handpicked"])){
							$output.= "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&handpicked=$handpicked'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}else if(isset($_GET["partner"])){
							$output.= "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page&partner=$check_partner'> &nbsp&nbsp....&nbsp&nbsp  </a>";
						}
						$output.= "<a id='before_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp  </a>";
					}

					if($pre_page){
						if(isset($_GET["handpicked"])){
							$output.= "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&handpicked=$handpicked'> PREV   </a>";
						}else if(isset($_GET["partner"])){
							$output.= "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page&partner=$check_partner'> PREV  </a>";
						}
						$output.=  "<a class='page_button' href='main_list.php?mode=$mode&page=$pre_page'> PREV  </a>";
					}

					for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
						if($dest_page == $page){
							$output.= "&nbsp;<b id='present_page'>$dest_page</b>&nbsp";
						}else{
							if(isset($_GET["handpicked"])){
								$output.= "<a id='move_page'  href='main_list.php?mode=$mode&page=$dest_page&handpicked=$handpicked'> $dest_page  </a>";
							}else if(isset($_GET["partner"])){
								$output.= "<a id='move_page' href='main_list.php?mode=$mode&page=$dest_page&partner=$check_partner'> $dest_page  </a>";
							}else{
								$output.= "<a id='move_page'  href='main_list.php?mode=$mode&page=$dest_page'> $dest_page </a>";
							}
						}
					}

					if($next_page){
						if(isset($_GET["handpicked"])){
							$output.= "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&handpicked=$handpicked'> NEXT</a>";
						}else if(isset($_GET["partner"])){
							$output.= "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page&partner=$check_partner'> NEXT  </a>";
						}else{
							$output.=  "<a class='page_button' href='main_list.php?mode=$mode&page=$next_page'> NEXT</a>";
						}
					}

					if($total_pages >= $start_page+ $pages_scale){
						$go_page= $start_page+ $pages_scale;
						if(isset($_GET["handpicked"])){
							$output.= "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&handpicked=$handpicked'> &nbsp&nbsp....&nbsp&nbsp </a>";
						}else if(isset($_GET["partner"])){
							$output.= "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page&partner=$check_partner'>&nbsp&nbsp....&nbsp&nbsp  </a>";
						}else{
							$output.=  "<a id='next_block' href='main_list.php?mode=$mode&page=$go_page'> &nbsp&nbsp....&nbsp&nbsp </a>";
						}
					}
$output .='
			</div>
	';


}else{
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}

// $output .= '
// </div>
// ';

echo $output;

?>
