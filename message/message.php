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
    $sql = "select * from message where send_email='$id' or rece_email='$id' order by regist_day desc;";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $total_record = mysqli_num_rows($result); //전체 레코드 수
}else{
    $sql = "select * from message where rece_email='$id' and rece_status='n' order by regist_day desc;";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $total_record = mysqli_num_rows($result); //전체 레코드 수
}


$rows_scale=5;
$pages_scale=3;

$total_pages= ceil($total_record/$rows_scale);

if(empty($_GET['page'])){
    $page=1;
}else{
    $page = $_GET['page'];
}

$start_row= $rows_scale * ($page -1) ;

$pre_page= $page>1 ? $page-1 : NULL;

$next_page= $page < $total_pages ? $page+1 : NULL;

$start_page= (ceil($page / $pages_scale ) -1 ) * $pages_scale +1 ;

$end_page= ($total_pages >= ($start_page + $pages_scale)) ? $start_page + $pages_scale-1 : $total_pages;

$number=$total_record- $start_row;

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">

<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/message.css?ver=2">
  <link rel="stylesheet" href="../css/common.css?ver=1">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/footer_2.css">
  <link rel="stylesheet" href="../css/admin.css">

  <title></title>

  <style media="screen">



  </style>
  <script type="text/javascript">
    // function message_form() {
    //   var popupX = (window.screen.width / 2) - (600 / 2);
    //   var popupY = (window.screen.height / 2) - (350 / 2);
    //   window.open('./send_message_form.php', '', 'left=' + popupX + ',top=' + popupY + ', width=500, height=400, status=no, scrollbars=no');
    // }
  </script>
</head>

<body>
  <?php
    include "../lib/header_in_folder.php";
  ?>
  <!-- The Modal -->
  <div id="myModal_1" class="modal">
    <!-- Modal content -->
    <div class="modal-content_1">
      <span class="close_1">&times;</span>
      <form class="" action="./check_message.php" method="post">
        <div class="form_div">
          <div id="head">
            <h1 id="title_h1">Send a Private Message</h1>
          </div>
          <div class="email_div">
            <input type="text" id="write_id" value="" name="receive_id" placeholder="Name">
          </div>
          <div class="message_div">
            <textarea rows="8" cols="50" id="write_message" name="message" placeholder="Message"></textarea>
          </div>
          <button type="submit" name="button" id="send_button"><span> Send Message </span></button>
        </div>
      </form>
    </div>
  </div>

  <section id="section_write">
    <div id="message_div">
      <h1 id="message_h1">Message</h1>
    </div>
    <div class="select_div">
      <a href="./message.php?mode=allmessage" class="select_a"> All Message |</a>
      <a href="./message.php?mode=unread" class="select_a"> Unread Messages</a>
      <div class="send_div">
        <button id="myBtn_1">New Message</button>
      </div>
    </div>
    <div id="list_content">
      <?php
         for ($i = $start_row; $i <$start_row+$rows_scale && $i< $total_record; $i++){
           mysqli_data_seek($result,$i);
           $row=mysqli_fetch_array($result);
           $send_email=$row["send_email"];
           $rece_email=$row["rece_email"];
           $message=$row["msg"];
           $num=$row["num"];
           $recv_read=$row["rece_status"];
           $date=$row["regist_day"];
           $date=substr($date,0,10);

       ?>
      <div id="list_message">
        <!-- <a href="#"><img src="./data/<?=$pro_img_copied?>" class="message_pro"></a> -->
        <a href="#">
          <div id="list_message2"><?=$send_email?></div>
        </a>
        <a href="view.php?num=<?=$num?>">
          <div id="list_message3"><?=$message?></div>
        </a>
        <div id="list_message4"><?=$date?></div>
        <div id="list_message5"><a href="./delete_message.php?num=<?=$num?>"><span id="cancel_span">X</span> </a> </div>
      </div>
      <!--end of list_item -->
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
                     echo( "&nbsp;<b id='present_page'>&nbsp;&nbsp;$dest_page&nbsp;&nbsp;</b>&nbsp" );
                 }else{
                     echo "<a id='move_page' href='message.php?mode=$mode&page=$dest_page'>&nbsp;&nbsp;$dest_page&nbsp;&nbsp;</a>";
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
    </div>
    <!--end of list_content -->
    </div>
  </section>
  <?php include "../lib/footer_in_folder.php"; ?>

  <script type="text/javascript">
    var modal = document.getElementById('myModal_1');

    var btn = document.getElementById("myBtn_1");

    var span = document.getElementsByClassName("close_1")[0];

    btn.onclick = function() {
      modal.style.display = "block";
    }

    span.onclick = function() {
      modal.style.display = "none";
    }

    window.onclick = function(event) {
      if (event.target == modal) {
        modal.style.display = "none";
      }
    }
  </script>

</body>

</html>
