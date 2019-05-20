<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

create_table($conn, "discussion_ripple"); //가입인사 게시판 테이블 생성

define('SCALE', 10);
//**************************************************************
$row = "";
$dis_id=$dis_num=$dis_date=$dis_nick=$dis_content = "";
$dis_ripple_result = "";
$sql=$result=$total_record=$total_page=$start="";
//**************************************************************
if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
  if(isset($_GET["total_search"])){
    $search = test_input($_GET["total_search"]);
  }else{
    $search = test_input($_POST["search"]);
  }
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql = "SELECT * from `discussion` where subject like '%$q_search%' or content like '%$q_search%';";
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  $total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

  if(empty($_GET["page"])){
    $page = 1;
  }else{
    $page = $_GET["page"];
  }

  $start = ($page-1) * 10;

  $number = $total_record - $start;

}else{

  $num = test_input($_GET['num']);

  $sql = "SELECT * from `discussion` where num=$num;";
  $result = mysqli_query($conn, $sql);

  $sql1 = "SELECT * from `discussion_ripple` where parent=$num order by num desc;";
  $result1 = mysqli_query($conn, $sql1);
  $total_record1 = mysqli_num_rows($result1);
}

?>

 <!DOCTYPE html>
 <html lang="ko" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/common.css">
     <link rel="stylesheet" href="../css/discussion.css">
     <link rel="stylesheet" href="../css/footer.css">
     <script type="text/javascript" src="../js/monsterform.js"></script>
     <script type="text/javascript">
       var value="";
       function select(value){
       var text = ""+value;
       document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
       }
       function mouse_over(){
         document.getElementById('change_img').src="../img/up.png";
       }
       function mouse_out(){
         document.getElementById('change_img').src="../img/down.png";
       }
       </script>
     <title></title>
   </head>
   <body>
     <?php
     include "../lib/header_in_folder.php";
      ?>

     <!--============================================================================== -->
     <br><br><br>
     <div id="discussion_div">
          <div id="discussion_title_div1">
            Discussions
          </div> <!--end of title-->
          <br><br><br>
          <div id="discussion_search_div1">
            <form name="discussion_search_form" action="./list.php?mode=search" method="post">
              <label id="discussion_search_label"><img src="../img/zoom.png" id="discussion_search_img" style="width:15px; height:15px; padding:1px;"><input type="text" name="search" placeholder="Search all Discussions"></label>
              <button type="submit" name="button">search</button>
            </form>
          </div>
          <br><br>
          <div class="clear"></div>
          <div id="discussion_total_div">
          <?php
          if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
           ?>
           <!--===============================검색결과================================= -->
          <div id="list_top_title">
            <ul>
              <li id=list_title1>검색결과</li>
            </ul>
          </div> <!-- end of list_top_title -->
            <div id="list_content">
              <?php
                for($i=$start;$i<$start+SCALE && $i<$total_record;$i++){
                  mysqli_data_seek($result, $i);
                  $row = mysqli_fetch_array($result);
                  $num=$row['num'];
                  $id=$row['username'];
                  $email=$row['email'];
                  $subject=$row['subject'];
                  $content=$row['content'];
                  $subject = str_replace("\n", "<br>", $subject);
                  $subject = str_replace(" ", "&nbsp;", $subject);
                  $content = str_replace("\n", "<br>", $content);
                  $content= str_replace(" ", "&nbsp;", $content);
                  $date = substr($row['regist_day'], 0, 10);
                ?>
              <div id="list_item">
                <div id="general_img_div">
                  제목<br>작성자
                </div>
                <ul id="general_ul">
                  <li id="list_item2"><a href="./view.php?num=<?=$num?>"><b><?=$subject?></b></a></li>
                  <br>
                  <li id="list_item3"><a href="../members/collections/<?=$email?>"><?=$id."($email)"?></a></li>
                  <li id="list_item5"><?=$date?></li>
                </ul>
              </div> <!-- end of list_item -->
              <div class="clear"></div>
              <?php
                $number--;
                }//end of for
                mysqli_close($conn);
               ?>
               <div class="clear"></div>
               <br><br>
                 <div id="page_num">
                   <?php
                   if(!($page-1==0)){
                     $go_page = $page-1;
                     echo "<a href='./list.php?mode=search&page=$go_page&total_search=$q_search'>◀ 이전</a> &nbsp;&nbsp;";
                   }else{
                     echo "◀ 이전&nbsp;&nbsp;";
                   }
                     for($i=1;$i<=$total_page;$i++){
                       if($page==$i){
                         echo "<b>&nbsp;&nbsp;$i&nbsp;&nbsp;</b>";
                       }else{
                         echo "<a href='./list.php?mode=search&page=$i&total_search=$q_search'>$i</a>";
                       }
                     }

                     if($page==$total_page){
                       echo "&nbsp;&nbsp;&nbsp;다음 ▶";
                     }else{
                       $go_page = $page+1;
                       echo "<a href='./list.php?mode=search&page=$go_page&total_search=$q_search'>&nbsp;&nbsp;&nbsp;다음 ▶</a>";
                     }
                      ?>

                <br><br><br>
                 </div> <!-- end of page_num -->
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="./list.php"><button type="button" name="button">목록</button></a>&nbsp;';
                   echo '<a href="./write_edit_form.php"><button type="button" name="button">글작성</button></a>';
                   ?>
                 </div> <!-- end of button -->
              </div> <!-- end of list_content -->
            <?php
          }else{
            // ===============================본문=================================
            $row = mysqli_fetch_array($result);
            $username=$row['username'];
            $email=$row['email'];
            $topic=$row['topic'];
            $subject=$row['subject'];
            $content=$row['content'];
            $subject = str_replace("\n", "<br>", $subject);
            $subject = str_replace(" ", "&nbsp;", $subject);
            $content = str_replace("\n", "<br>", $content);
            $content= str_replace(" ", "&nbsp;", $content);
            $date = substr($row['regist_day'], 0, 10);
             ?>
             <table id="view_main_table">
               <tr>
                 <th style="background-color: #8ba753"><?=$topic?></th>
                 <td><?=$date?></td>
               </tr>
               <tr>
                 <td colspan="2"><a href="#"><?=$username?>(<?=$email?>)</a></td>
               </tr>
               <tr>
                 <td><h2><?=$subject?></h2></td>
                 <td><?=$content?></td>
               </tr>
             </table>

            <!--===============================댓글================================= -->
            <div id="list_top_title">
              <ul>
                <li id=list_title1>Ripples</li>
              </ul>
            </div> <!-- end of list_top_title -->
              <div id="list_content">
                <?php
                for($i=0;$i<$total_record1;$i++){
                  mysqli_data_seek($result1, $i);
                  $row1 = mysqli_fetch_array($result1);
                  $username1=$row1['username'];
                  $email1=$row1['email'];
                  $content1=$row1['content'];
                  $content1 = str_replace("\n", "<br>", $content1);
                  $content1= str_replace(" ", "&nbsp;", $content1);
                  $date1 = substr($row1['regist_day'], 0, 10);
                  ?>
                  <table id="view_ripple_table">
                    <tr>
                      <td><a href="#"><?=$username1?>(<?=$email1?>)</a></td>
                      <td><?=$date1?></td>
                    </tr>
                    <tr>
                      <td colspan="2"><?=$content1?></td>
                    </tr>
                  </table>
                 <div class="clear"></div>
                <?php
                }
                mysqli_close($conn)
                 ?>
                 <br>
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                     echo '<a href="./list.php"><button type="button" name="button">목록</button></a>';
                   }else{
                     date_default_timezone_set("Asia/Seoul");
                     $now = date("Y-m-d(H:i)");
                     // date("y-m-d h:i:sa");
                    echo '<form name="ripple_form" action="dml_board.php?mode=insert_ripple" method="post">
                    <input type="hidden" name="now" value="'.$now.'">
                    <table id="view_ripple_table">
                      <tr>
                        <td><a href="#">'.$_SESSION['username'].'('.$_SESSION['email'].')</a></td>
                        <td>'.$now.'</td>
                      </tr>
                      <tr>
                        <td colspan="2"><textarea name="ripple_content" rows="8" cols="135"></textarea></td>
                      </tr>
                    </table>
                    <a href="./list.php"><button type="button" name="button">목록</button></a>
                    &nbsp;<button type="submit" name="">등록</button></a>
                    </form>';
                   }


                   ?>


                 </div> <!-- end of button -->
                 </div> <!-- end of list_content -->
              <br><br>
              <?php
            }
               ?>

              <!--============================================================================== -->

            </div> <!-- end of discussion_total_div -->
        </div><!-- end of discussion_col_div1 -->
        <div class="clear"></div>
        <br><br>
        <!--===============================섹션영역=================================== -->
        <?php
          include "../lib/footer_in_folder.php";
         ?>
   </body>
 </html>
