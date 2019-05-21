<?php


include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/db_connector.php";
$num="";
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
		$query = "SELECT * from `products` order by num desc";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);

	}else if($check_partner=="y"){
		$query = "select * from products p inner join member m on p.username=m.username where m.partner='n'and price BETWEEN '$minimum_range' AND '$maximum_range' ORDER BY price desc;";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);
	}
}else{
$query = "SELECT * FROM `products` WHERE price BETWEEN '$minimum_range' AND '$maximum_range' ORDER BY price desc";
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);
}

if(isset($_GET["mode"]) && $_GET["mode"] == "animallist"){
	if($handpicked=="total"){
		$query = "SELECT * from `products` order by num desc";
		$result = mysqli_query($conn, $query);
		$row = mysqli_num_rows($result);

	}else if($handpicked=="animal"){
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


$number=$total_record- $start_row;
$output = '
<h4 align="center">Total Item - '.$total_record.'</h4>
<div class="row">
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

}else{
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}

$output .= '
</div>
';

echo $output;

?>
