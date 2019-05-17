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
     <header id="header">
       <div id="header_logout_form_div1">
           <div id="header_logout_form_div1_1">
             <ul id="header_logout_form_div1_1_ul">
               <li class="header_logout_form_div1_1_ul_li"><a href="#">Get Free Goods</a></li>
               <li class="header_logout_form_div1_1_ul_li"><a href="#">Become a Partner</a></li>
               <li class="header_logout_form_div1_1_ul_li"><a href="#">Discussions</a></li>
             </ul>
           </div>
             <div id="header_logout_form_div1_2">
               <?php
               ?><ul id="header_logout_form_div1_2_ul">
                 <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button2" id="myBtn2">Sign in</button></li>
                 <li class="header_logout_form_div1_2_ul_li">&nbsp;or&nbsp;</li>
                 <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn">Join Now</button></li>
                 <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn3">Sign out</button></li>
               </ul>
             </div>
           </div>

           <div id="header_logout_form_div2">
             <div id="header_logout_form_div2_1">
               <img id="logo" src="../img/logo.png" alt="">
             </div>
             <div id="header_logout_form_div2_2">
               <ul>
                 <li class="header_logout_form_div2_ul1_li">
                   <a class="header_logout_form_div2_ul1_li_a" href="#">Photos</a>
                   <ul class="submenu">
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Abstract</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Animals</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Architecture</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Arts &Entertainment</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Beauty & Fashion</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Business</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Education</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Food & Drink</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Health</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Holidays</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Industrial</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Nature</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">People</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Sports</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Technology</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Transportation</a></li>
                   </ul>
                 </li>

                 <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="#">Graphics</a>
                   <ul class="submenu">
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Icons</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Illustrations</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Web Elements</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Objects</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Patterns</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Textures</a></li>
                   </ul>
                 </li>
                 <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="#">Font</a>
                   <ul class="submenu">
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Blackletter</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Display</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Non Western</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Sans Serif</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Script</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Serif</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Slab Serif</a></li>
                     <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Symbols</a></li>
                   </ul>
                 </li>
               </ul>
             </div>

             <div class="header_logout_form_div5">
                 <label id="search_label"><img src="../img/zoom.png" id="search_img" style="width:15px; height:15px; padding-top:2px; padding:0;"> <input type="text" id="search_text" placeholder="Search"> </label>
               <div id="header_logout_form_div2_3">
                   <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
                     <span id="header_logout_form_div2_3_span">All</span>
                     <img id="change_img" src="../img/down.png" style="width:15px; height:15px;"/>&nbsp;&nbsp;&nbsp;
                   </a>
                 <ul id="header_logout_form_div2_3_ul">
                   <li class="header_logout_form_div2_3_ul_li" id="All" onclick="select('All')" value="allcategories"><a href="#">All&nbspcategories</a></li>
                   <li class="header_logout_form_div2_3_ul_li" id="photos" onclick="select('Photos')" value="Photos"><a href="#">Photos</a></li>
                   <li class="header_logout_form_div2_3_ul_li" id="Graphics" onclick="select('Graphics')" value="Graphics"><a href="#">Graphics</a></li>
                   <li class="header_logout_form_div2_3_ul_li" id="Fonts" onclick="select('Fonts')" value="Fonts"><a href="#">Fonts</a></li>
                 </ul>
               </div>
             </div>
           </div>
     </header>

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
                  작성자<br>사진
                </div>
                <ul id="general_ul">
                  <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                  <br>
                  <li id="list_item3"><?=$id?></li>
                  <li id="list_item4">(<?=$email?>)</li>
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
                 <div id="page_num">
                   ◀ 이전 &nbsp;&nbsp;
                     <?php
                     for($i=1;$i<=$total_page;$i++){
                       if($page==$i){
                         echo "<b>&nbsp;&nbsp;$i&nbsp;&nbsp;</b>";
                       }else{
                         echo "<a href='list.php?page=$i'>$i</a>";
                       }
                     }
                      ?>
                &nbsp;&nbsp;&nbsp;다음 ▶
                <br><br><br><br><br>
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
                    작성자<br>사진
                  </div>
                  <ul id="general_ul">
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><?=$id?></li>
                    <li id="list_item4">(<?=$email?>)</li>
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
                    작성자<br>사진
                  </div>
                  <ul id="general_ul">
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><?=$id?></li>
                    <li id="list_item4">(<?=$email?>)</li>
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
                    작성자<br>사진
                  </div>
                  <ul id="general_ul">
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><?=$id?></li>
                    <li id="list_item4">(<?=$email?>)</li>
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
                    작성자<br>사진
                  </div>
                  <ul id="general_ul">
                    <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                    <br>
                    <li id="list_item3"><?=$id?></li>
                    <li id="list_item4">(<?=$email?>)</li>
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
        <footer class="footer_footer">
          <div id="footer_main">
            <div id="footer_main_margin_left_right">
              <div id="footer_div1">
                <div id="footer_div1_div1">
                  <a href="#"><img id="footer_logo"src="../img/logo.png"></a><br><br>
                    MonsterForm is the world’s marketplace for
                    <br>design. Bring your creative projects to life with
                    <br>ready-to-use design assets from independent
                    <br>creators around the world.
                </div>
                <div id="footer_div1_div2">
                  <div class="footer_div1_div2_div">
                    Earn<br><br><br>
                    <ul>
                      <li><a href="">Open a Shop</a></li>
                      <li><a href="">Become a Partner</a></li>
                    </ul>
                  </div>
                  <div class="footer_div1_div2_div">
                      Resources<br><br><br>
                      <ul>
                        <li><a href="">Discussions</a></li>
                        <li><a href="">Products</a></li>
                        <li><a href="">Collections</a></li>
                        <li><a href="">Help Center</a></li>
                      </ul>
                    </div>
                    <div class="footer_div1_div2_div">
                      The Goods<br><br><br>
                      <ul>
                        <li><a href="">Free Goods</a></li>
                        <li><a href="">Purchase Credits</a></li>
                        <li><a href="">Gift Cards</a></li>
                      </ul>
                    </div>
                    <div class="footer_div1_div2_div" id="footer_div1_div2_div5_id">
                      Company<br><br><br>
                      <ul>
                        <li><a href="">About</a></li>
                        <li><a href="">Brand</a></li>
                        <li><a href="">Terms</a></li>
                        <li><a href="">Cookie Policy</a></li>
                        <li><a href="">Privacy Policy</a></li>
                      </ul>
                    </div>
                </div>
              </div>
              <div id="footer_div2">
                <ul class="stats">
                  <li><?php echo "3,345,959"; ?>&nbsp;Products</li>
                  <li><?php echo "5,922,327"; ?>&nbsp;Members</li>
                  <li><?php echo "29,318"; ?>&nbsp;Shops</li>
                  <li>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&copy; 2019 Monster Form. All rights reserved.</li>
                </ul>
              </div>
            </div>
          </div>
        </footer>
   </body>
 </html>
