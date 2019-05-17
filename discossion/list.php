<?php
session_start();

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform//lib/create_table.php";

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";



create_table($conn, "discossion"); //가입인사 게시판 테이블 생성

define('SCALE', 5);
//**************************************************************
$row = "";
$dis_id=$dis_num=$dis_date=$dis_nick=$dis_content = "";
$dis_ripple_result = "";
$sql=$result=$total_record=$total_page=$start="";
//**************************************************************
if(isset($_GET["mode"]) && $_GET["mode"] == "search"){
  $find = test_input($_POST["find"]); //subject, content, id
  $search = test_input($_POST["search"]);
  $q_search = mysqli_real_escape_string($conn, $search);
  $sql = "SELECT * from `discossion` where $find like '%$q_search%';";
}else{
  $sql = "SELECT * from `discossion` order by num desc";
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
     <link rel="stylesheet" href="../css/greet.css">
     <script type="text/javascript" src="../js/member_form.js"></script>
     <script type="text/javascript">
       var value="";
       function select(value){
       var text = ""+value;
       document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
       }


       function mouse_over(){
         document.getElementById('change_img').src="./img/up.png";
       }
       function mouse_out(){
         document.getElementById('change_img').src="./img/down.png";
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
               <img id="logo" src="./img/logo.png" alt="">
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
                 <label id="search_label"><img src="./img/zoom.png" id="search_img" style="width:15px; height:15px; padding-top:2px; padding:0;"> <input type="text" id="search_text" placeholder="Search"> </label>
               <div id="header_logout_form_div2_3">
                   <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
                     <span id="header_logout_form_div2_3_span">All</span>
                     <img id="change_img" src="./img/down.png" style="width:15px; height:15px;"/>&nbsp;&nbsp;&nbsp;
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

     <section id="text_category">
     <div id="text_category_text_div">
     <span id="text_category_text_div_span1">Ready-to-use design assets<br>from many independent creators<br></span>
     <span id="text_category_text_div_span2">Graphics, fonts, themes, photos and more, starting at 50MON!<br><br></span>
     <span id="text_category_text_div_span3">Get 6 free products and 10% off!</span><button type="button" name="button" id="continue">Continue</button>
     </div>
     </section>

     <!--템플릿 추가-->
         <section id="categories_section">
           <h2><span class="featured_title">FEATURED CATEGORIES</span></h2>
           <div class="container">
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/photo_animal.png" alt="Branding Mockups">
               </a>
             </div>
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/photo_food.png" alt="Branding Mockups">
               </a>
             </div>
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/font_symbol.png" alt="Branding Mockups">
               </a>
             </div>
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/font_brush.png" alt="Branding Mockups">
               </a>
             </div>
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/graphic_texture.png" alt="Branding Mockups">
               </a>
             </div>
           <!--각각 템플릿-->
             <div class="category">
               <a href="#" data-tracking="Branding Mockups">
                   <img class="retina" src="./img/graphic_pattern.png" alt="Branding Mockups">
               </a>
             </div>
           </div>
         </section>







     <!--============================================================================== -->






     <div id="wrap">
       <div id="header">
         <?php include "../lib/top_login2.php"; ?>
       </div> <!--end of header(div)  -->
       <div id="menu">
         <?php include "../lib/top_menu2.php"; ?>
       </div><!--end of menu(div)  -->
       <div id="content">
         <div id="col1">
          <div id="left_menu">
            <?php include "../lib/left_menu.php"; ?>
          </div><!--end of left_menu-->
        </div> <!--end of col1-->
        <div id="col2">
          <div id="title">
            <img src="../img/title_greet.gif" alt="">
          </div> <!--end of title-->
          <form name="board_form" action="list.php?mode=search" method="post">
            <div id="list_search">
              <div id="list_search1">▷ 총 <?=$total_record?>개의 게시물이 있습니다.</div>
              <div id="list_search2"><img src="../img/select_search.gif"></div>
              <div id="list_search3">
                <select name="find">
                  <option value="subject">제목</option>
                  <option value="content">내용</option>
                  <option value="id">아이디</option>
                </select></div> <!-- end of list_search3 -->
                <div id="list_search4"><input type="text" name="search"></div>
                <div id="list_search5"><input type="image" src="../img/list_search_button.gif">
                </div>
            </div> <!-- end of list_search -->
          </form>
            <div class="clear"></div>
            <div id="list_top_title">
              <ul>
                <li id=list_title1><img src="../img/list_title1.gif"></li>
                <li id=list_title2><img src="../img/list_title2.gif"></li>
                <li id=list_title3><img src="../img/list_title3.gif"></li>
                <li id=list_title4><img src="../img/list_title4.gif"></li>
                <li id=list_title5><img src="../img/list_title5.gif"></li>
              </ul>
            </div> <!-- end of list_top_title -->

            <div id="list_content">
              <?php
                for($i=$start;$i<$start+SCALE && $i<$total_record;$i++){
                  mysqli_data_seek($result, $i);
                  $row = mysqli_fetch_array($result);
                  $num=$row['num'];
                  $id=$row['id'];
                  $subject=$row['subject'];
                  $subject = str_replace("\n", "<br>", $subject);
                  $subject = str_replace(" ", "&nbsp;", $subject);
                  $date = substr($row['regist_day'], 0, 10);
                  $hit=$row['hit'];

                ?>
              <div id="list_item">
                <div id="list_item1"><?=$number?></div>
                <div id="list_item2"><a href="./view.php?num=<?=$num?>&page=<?=$page?>&hit=<?=$hit+1?>"><?=$subject?></a></div>
                <div id="list_item3"><?=$id?></div>
                <div id="list_item4"><?=$date?></div>
                <div id="list_item5"><?=$hit?></div>
              </div> <!-- end of list_item -->
              <?php
                $number--;
                }//end of for
                mysqli_close($conn);
               ?>
              <div id="page_button">
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
                <div id="button">
                  <a href="./list.php?page=<?=$page?>"><img src="../img/list.png"></a>&nbsp;
                  <?php //세션 아이디가 있으면 글쓰기 버튼을 보여줌.
                    if(isset($_SESSION['userid'])){
                      echo '<a href="write_edit_form.php"><img src="../img/write.png"></a>';
                    }
                     ?>
                </div> <!-- end of button -->
              </div> <!-- end of page_button -->
            </div> <!-- end of list_content -->
            <div class="clear"></div>
        </div> <!-- end of col2-->
       </div><!--end of content(div)  -->
     </div> <!--end of wrap(div)  -->
   </body>
 </html>
