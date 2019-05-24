
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";


create_table($conn, "message");

if(!isset($_SESSION['email'])){
echo "<script> alert('회원만 이용 가능 합니다.'); history.go(-1); </script>";
exit;
}

$id = $_SESSION['email'];

$mode = "allmessage";

if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}




if($mode == "allmessage"){
    $sql = "select * from message where rece_no order by regist_day desc";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $total_record = mysqli_num_rows($result); //전체 레코드 수
}else{
    $sql = "select * from message where rece_status='n'";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $total_record = mysqli_num_rows($result); //전체 레코드 수
}
// define('SCALE', 10);
// 페이지 당 글수, 블럭당 페이지 수
$rows_scale=5;
$pages_scale=3;

// 전체 페이지 수 ($total_page) 계산
$total_pages= ceil($total_record/$rows_scale);

if(empty($_GET['page'])){
    $page=1;
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

$number=$total_record- $start_row;


?>

<link rel="stylesheet" href="../css/message.css?ver=2">
<link rel="stylesheet" href="../css/common.css?ver=1">
<link rel="stylesheet" href="../css/footer.css">
<link rel="stylesheet" href="../css/footer_2.css">
<link rel="stylesheet" href="../css/admin.css">

<?php
include "../lib/header.php";

 ?>

<script type="text/javascript">
function message_form(){
     var popupX = (window.screen.width/2)-(600/2);
     var popupY = (window.screen.height/2)-(350/2);
     window.open('./send_message_form.php','','left='+popupX+',top='+popupY+', width=500, height=400, status=no, scrollbars=no');
   }
</script>







<section id="section_write">
  <div id="message_div">
      <h1 id="message_h1">Message</h1>
  </div>
  <div class="select_div">
      <a href="./message.php?mode=allmessage" class="select_a"> All Message |</a>
      <a href="./message.php?mode=unread" class="select_a"> Unread Messages</a>
      <div class="send_div">
        <a href="#"  onclick="message_form()">New Message</a>
      </div>
  </div>
  <div id="list_content">

  <?php
    for ($i = $start_row; $i <$start_row+$rows_scale && $i< $total_record; $i++){
      mysqli_data_seek($result,$i);
      $row=mysqli_fetch_array($result);
      $recv_no=$row["send_no"];
      $send_no=$row["rece_no"];
      $message_cont=$row["msg"];
      $recv_read=$row["rece_status"];
      $item_date=$row["regist_day"];
      $item_date=substr($item_date,0,10);

  ?>
    <div id="list_message">
      <div id="list_message1"><?=$recv_no?></div>
      <div id="list_message2"><?=$send_no?></div>
      <a href="view.php?rece_no=<?=$recv_no ?>"> <div id="list_message3"><?=$message_cont?></div></a>
      <div id="list_message4"><?=$item_date?></div>
      <div id="list_message5"><a href="./message_delete.php?item_num=<?=$num ?>"><span>X</span> </a> </div>
  </div><!--end of list_item -->
  <?php
      $number--;
    }//end of for
  ?>
  <div id='page_box' style="text-align: center;">
<?PHP
            #----------------이전블럭 존재시 링크------------------#
            if($start_page > $pages_scale){
               $go_page= $start_page - $pages_scale;
               echo "<a id='before_block' href='message.php?mode=$mode&page=$go_page'> << </a>";
            }
            #----------------이전페이지 존재시 링크------------------#
            if($pre_page){
                echo "<a id='before_page' href='message.php?mode=$mode&page=$pre_page'> < </a>";
            }
             #--------------바로이동하는 페이지를 나열---------------#
            for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
               if($dest_page == $page){
                    echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
                }else{
                    echo "<a id='move_page' href='message.php?mode=$mode&page=$dest_page'>$dest_page</a>";
                }
             }
             #----------------이전페이지 존재시 링크------------------#
             if($next_page){
                 echo "<a id='next_page' href='message.php?mode=$mode&page=$next_page'> > </a>";
             }
             #---------------다음페이지를 링크------------------#
            if($total_pages >= $start_page+ $pages_scale){
              $go_page= $start_page+ $pages_scale;
              echo "<a id='next_block' href='message.php?mode=$mode&page=$go_page'> >> </a>";
             }
   ?>
</div>
</div><!--end of page_button -->
</div><!--end of list_content -->
  </div>
</section>
<?php     include "../lib/footer.php"; ?>
