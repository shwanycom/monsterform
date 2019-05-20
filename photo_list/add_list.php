<?php

//fetch.php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterpro/lib/db_connector.php";

$mode=$num="";
$row = "";

$query = "SELECT * FROM `products` WHERE price BETWEEN '".$_POST["minimum_range"]."' AND '".$_POST["maximum_range"]."' ORDER BY price ASC";
$result = mysqli_query($conn, $query);
$row = mysqli_num_rows($result);


$total_record = $row;
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
$output = '

';
// '.$total_record.' 는 총 수가 나온다.


if($total_record > 0){

	for ($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
			 // 가져올 레코드 위치 이동
			 mysqli_data_seek($result, $i);

			 // 하나 레코드 가져오기
					$row = mysqli_fetch_array($result);

					// 첨부파일의 1번 2번 3번 순서에 따라서 썸네일을 만들어주는 로직
					if(!empty($img_copy_name0)){ // 첫번째 이미지 파일이 있으면 1번 이미지를 보여줌
							$main_img = $img_copy_name0;

					}else if(empty($img_copy_name0) && !empty($img_copy_name1)){ // 첫번째 이미지 파일이 없고 두번째 이미지 파일이 있으면 2번 이미지 보여줌
							$main_img = $img_copy_name1;

					}else if(empty($img_copy_name0) && empty($img_copy_name1) && !empty($img_copy_name2)){ // 첫번째, 두번째 없고 세번째 있으면  3번 이미지 보여줌
							$main_img = $img_copy_name2;

					}

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
		  $number --;
	}

}else{
	$output .= '
		<h3 align="center">No Product Found</h3>
	';
}

$output .= '

';

echo $output;

?>
