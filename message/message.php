
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";


create_table($conn, "message");

if(isset($_SESSION['email'])){
  $id = $_SESSION['email'];
}else{
  $id="";
}

$mode = "allmessage";
if(isset($_GET['mode'])){
    $mode = $_GET['mode'];
}


$sql1 = "delete from message where rece_del='y' and send_del='y'";



if($mode == "allmessage"){
    $sql = "select * from message where send_email='$id'and send_del='n' or rece_email='$id'and rece_del='n' order by num desc;";
    $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
    $total_record = mysqli_num_rows($result); //전체 레코드 수
}else{
    $sql = "select * from message where rece_email='$id' and rece_status='n' order by num desc;";
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

</head>
<body>
  <?php
    include "../lib/header_in_folder.php";

  ?>
  <!-- The Modal -->
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
        <!-- <a href="#"><img src="./data/$pro_img_copied" class="message_pro"></a> -->
        <!-- <a href="../member_profile/profile_view.php?$send_email"> -->
           <?php
          if($id==$send_email){
            ?>
            <a href="../member_profile/profile_view.php?mode=shop&email=<?=$rece_email?>">  <div id="list_message2"><?=$rece_email?></div></a>
            <?php
          }else{
            ?>
            <a href="../member_profile/profile_view.php?mode=shop&email=<?=$send_email?>"> <div id="list_message2"><?=$send_email?></div></a>
            <?php
          }
           ?>
        </a>
        <a href="view.php?num=<?=$num?>">
          <div id="list_message3"><?=$message?></div>
        </a>
        <div id="list_message4"><?=$date?></div>
        <?php
          if($mode!="allmessage"){
            ?>
              <div id="list_message5"></div>
            <?php
          }else{
            ?>
            <div id="list_message5"><a href="./delete_message.php?num=<?=$num?>&email=<?=$send_email?>&email1=<?=$rece_email?>" onclick="del_chek(<?=$num?>,<?=$id?>)"><span id="cancel_span">X</span> </a> </div>
        <?php
          }
         ?>
      </div><!--end of list_message -->

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
      </div><!--end of page_box -->
    </div><!--end of list_content -->
  </section>

  <?php
    include "../lib/footer_in_folder.php";
    include "./send_message_modal.php";
  ?>
  <?php
  include "../khy_modal/login_modal_in_folder.php";
  if(!isset($_SESSION['no'])) {
    ?>
    <script>
      auto_modal();
    </script>
    <?php
  }
  ?>
</body>

</html>
