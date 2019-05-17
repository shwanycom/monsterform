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
}else{
  $sql = "SELECT * from `discussion` order by num desc";
}
$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result);

$total_page = ($total_record%SCALE==0)?(floor($total_record/SCALE)):(ceil($total_record/SCALE));

if(empty($_GET["page"])){
  $page = 1;
}else{
  $page = $_GET["page"];
}

$start = ($page-1) * SCALE;

$number = $total_record - $start;
 ?>

 <!DOCTYPE html>
 <html lang="ko" dir="ltr">
   <head>
     <meta charset="utf-8">
     <link rel="stylesheet" href="../css/common.css">
     <link rel="stylesheet" href="../css/discussion.css">
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

     <div id="discussion_div">
          <div id="discussion_title_div1">
            Discussions
          </div> <!--end of title-->
          <div id="discussion_search_div1">
            <form name="discussion_search_form" action="./list.php?mode=search" method="post">
              <label id="discussion_search_label"><img src="../img/zoom.png" id="discussion_search_img" style="width:15px; height:15px; padding-top:2px; padding:0;"> <input type="text" name="search" placeholder="Search all Discussions"></label>
              <button type="submit" name="button">제출</button>
            </form>
          </div>
          <div class="clear"></div>
          <div id="list_top_title">
            <ul>
              <li id=list_title1>일반</li>
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
                <ul id="general_ul">
                  <li id="list_item1"><?=$number?></li>
                  <li id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>"><?=$subject?></a></li>
                  <li id="list_item3"><?=$id?></li>
                  <li id="list_item4"><?=$email?></li>
                  <li id="list_item5"><?=$date?></li>

                </ul>
              </div> <!-- end of list_item -->
              <?php
                $number--;
                }//end of for
                mysqli_close($conn);
               ?>

            </div> <!-- end of list_content -->
            <div class="clear"></div>
        </div><!-- end of discussion_col_div1 -->

   </body>
 </html>
