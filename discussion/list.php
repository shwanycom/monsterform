<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";


create_table($conn, "discussion"); //가입인사 게시판 테이블 생성

define('SCALE', 5);
//**************************************************************
$row = "";
$dis_id=$dis_num=$dis_date=$dis_nick=$dis_content = "";
$dis_ripple_result = "";
$sql=$result=$total_record=$total_page=$start="";
//**************************************************************
if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql = "SELECT * from `discussion` where subject like '%$q_search%' or content like '%$q_search%';";
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  $total_page = ($total_record%10==0)?(floor($total_record/10)):(ceil($total_record/10));

  if(empty($_GET["page"])){
    $page = 1;
  }else{
    $page = $_GET["page"];
  }

  $start = ($page-1) * 10;

  $number = $total_record - $start;

}else{
  $sql1 = "SELECT * from `discussion` where topic='general' order by num desc";
  $result1 = mysqli_query($conn, $sql1);
  $total_record1 = mysqli_num_rows($result1);

  $sql2 = "SELECT * from `discussion` where topic='request' order by num desc";
  $result2 = mysqli_query($conn, $sql2);
  $total_record2 = mysqli_num_rows($result2);

  $sql3 = "SELECT * from `discussion` where topic='feedback' order by num desc";
  $result3 = mysqli_query($conn, $sql3);
  $total_record3 = mysqli_num_rows($result3);

  $sql4 = "SELECT * from `discussion` where topic='review' order by num desc";
  $result4 = mysqli_query($conn, $sql4);
  $total_record4 = mysqli_num_rows($result4);

  $total_page1 = ($total_record1%SCALE==0)?(floor($total_record1/SCALE)):(ceil($total_record1/SCALE));
  $total_page2 = ($total_record2%SCALE==0)?(floor($total_record2/SCALE)):(ceil($total_record2/SCALE));
  $total_page3 = ($total_record3%SCALE==0)?(floor($total_record3/SCALE)):(ceil($total_record3/SCALE));
  $total_page4 = ($total_record4%SCALE==0)?(floor($total_record4/SCALE)):(ceil($total_record4/SCALE));

  if(empty($_GET["page"])){
    $page = 1;
  }else{
    $page = $_GET["page"];
  }

  $start = ($page-1) * SCALE;

  $number1 = $total_record1 - $start;
  $number2 = $total_record2 - $start;
  $number3 = $total_record3 - $start;
  $number4 = $total_record4 - $start;

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
     include "../lib/header_logout_form_in_folder.php";
      ?>

     <!--============================================================================== -->
     <br><br><br><br><br>
     <div id="discussion_div">
          <div id="discussion_title_div1">
            Discussions
          </div> <!--end of title-->
          <br><br><br>
          <div id="discussion_search_div1">
            <form name="discussion_search_form" action="./list.php?mode=search" method="post">
              <label id="discussion_search_label"><img src="../img/zoom.png" id="discussion_search_img" style="width:15px; height:15px; padding:1px;"> <input type="text" name="search" placeholder="Search all Discussions"></label>
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
                for($i=$start;$i<$start+10 && $i<$total_record;$i++){
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
                  <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
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
                     echo "<a href='list.php?mode=search&page=$go_page'>◀ 이전</a> &nbsp;&nbsp;";
                   }else{
                     echo "◀ 이전&nbsp;&nbsp;";
                   }
                     for($i=1;$i<=$total_page;$i++){
                       if($page==$i){
                         echo "<b>&nbsp;&nbsp;$i&nbsp;&nbsp;</b>";
                       }else{
                         echo "<a href='./list.php?mode=search&page=$i'>$i</a>";
                       }
                     }

                     if($page==$total_page){
                       echo "&nbsp;&nbsp;&nbsp;다음 ▶";
                     }else{
                       $go_page = $page+1;
                       echo "<a href='./list.php?mode=search&page=$go_page'>&nbsp;&nbsp;&nbsp;다음 ▶</a>";
                     }
                      ?>
                <br><br><br>
                 </div> <!-- end of page_num -->
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="write_edit_form.php"><button type="button" name="button">글작성</button></a>';
                   ?>
                 </div> <!-- end of button -->
              </div> <!-- end of list_content -->
            <?php
          }else{
             ?>
            <!--===============================검색결과================================= -->
            <div id="list_top_title">
              <ul>
                <li id=list_title1>일반</li>
              </ul>
            </div> <!-- end of list_top_title -->
              <div id="list_content">
                <?php
                  for($i=$start;$i<$start+SCALE && $i<$total_record1;$i++){
                    mysqli_data_seek($result1, $i);
                    $row = mysqli_fetch_array($result1);
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
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><a href="../members/collections/<?=$email?>"><?=$id."($email)"?></a></li>
                    <li id="list_item5"><?=$date?></li>
                  </ul>
                </div> <!-- end of list_item -->
                <div class="clear"></div>
                <?php
                  $number1--;
                  }//end of for
                  mysqli_close($conn);
                 ?>
                 <div class="clear"></div>
                 <div id="list_item">
                   <br>
                   <a href="#">더 보기...</a>
                 </div>
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="write_edit_form.php"><button type="button" name="button">글작성</button></a>';
                   ?>
                 </div> <!-- end of button -->
                </div> <!-- end of list_content -->
              <br>
              <br>
            <!--===============================제품요청================================= -->
            <div id="list_top_title">
              <ul>
                <li id=list_title1>제품요청</li>
              </ul>
            </div> <!-- end of list_top_title -->
              <div id="list_content">
                <?php
                  for($i=$start;$i<$start+SCALE && $i<$total_record2;$i++){
                    mysqli_data_seek($result2, $i);
                    $row = mysqli_fetch_array($result2);
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
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><a href="../members/collections/<?=$email?>"><?=$id."($email)"?></a></li>
                    <li id="list_item5"><?=$date?></li>
                  </ul>
                </div> <!-- end of list_item -->
                <div class="clear"></div>
                <?php
                  $number2--;
                  }//end of for
                  mysqli_close($conn);
                 ?>
                 <div class="clear"></div>
                 <div id="list_item">
                   <br>
                   <a href="#">더 보기...</a>
                 </div>
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="write_edit_form.php"><button type="button" name="button">글작성</button></a>';
                   ?>
                 </div> <!-- end of button -->
               </div> <!-- end of list_content -->
              <br><br>
            <!--===============================피드백요청================================= -->
            <div id="list_top_title">
              <ul>
                <li id=list_title1>피드백요청</li>
              </ul>
            </div> <!-- end of list_top_title -->
              <div id="list_content">
                <?php
                  for($i=$start;$i<$start+SCALE && $i<$total_record3;$i++){
                    mysqli_data_seek($result3, $i);
                    $row = mysqli_fetch_array($result3);
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
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><a href="../members/collections/<?=$email?>"><?=$id."($email)"?></a></li>
                    <li id="list_item5"><?=$date?></li>
                  </ul>
                </div> <!-- end of list_item -->
                <div class="clear"></div>
                <?php
                  $number3--;
                  }//end of for
                  mysqli_close($conn);
                 ?>
                 <div class="clear"></div>
                 <div id="list_item">
                   <br>
                   <a href="#">더 보기...</a>
                 </div>
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="write_edit_form.php"><button type="button" name="button">글작성</button></a>';
                   ?>
                 </div> <!-- end of button -->
                 </div> <!-- end of list_content -->
              <br>
              <br>
            <!--===============================제품후기================================= -->
            <div id="list_top_title">
              <ul>
                <li id=list_title1>제품후기</li>
              </ul>
            </div> <!-- end of list_top_title -->
              <div id="list_content">
                <?php
                  for($i=$start;$i<$start+SCALE && $i<$total_record4;$i++){
                    mysqli_data_seek($result4, $i);
                    $row = mysqli_fetch_array($result4);
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
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><a href="../members/collections/<?=$email?>"><?=$id."($email)"?></a></li>
                    <li id="list_item5"><?=$date?></li>
                  </ul>
                </div> <!-- end of list_item -->
                <div class="clear"></div>
                <?php
                  $number4--;
                  }//end of for
                  mysqli_close($conn);
                 ?>
                 <div class="clear"></div>
                 <div id="list_item">
                   <br>
                   <a href="#">더 보기...</a>
                 </div>
                 <div id="discussion_write_button">
                   <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                   if(isset($_SESSION['username'])){
                   }
                   echo '<a href="write_edit_form.php"><button type="button" name="button">글작성</button></a>';
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
