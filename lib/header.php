<script type="text/javascript">
  var value="";
  function index_select(value){
  var text = ""+value;
  document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
  }
  function mouse_over(){
    document.getElementById('change_img').src="./img/up.png";
  }
  function mouse_out(){
    document.getElementById('change_img').src="./img/down.png";
  }
  </script><style media="screen">
  @font-face{
    font-family:"1Abraham"; /*폰트 패밀리 이름 추가*/
    src:url("./font/1 Abraham.OTF"); /*폰트 파일 주소*/
  }
  @font-face{
    font-family:"Hansief"; /*폰트 패밀리 이름 추가*/
    src:url("./font/Hansief.OTF"); /*폰트 파일 주소*/
  }
  #header *{
      font-family: "Hansief";
  }
  </style>
<header id="header">
  <div id="header_logout_form_div1">
      <div id="header_logout_form_div1_1">
        <ul id="header_logout_form_div1_1_ul">
          <li class="header_logout_form_div1_1_ul_li"><a href="#">Get Free Goods&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="./earn/becomeapartner.php">Become a Partner&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="./discussion/list.php">Discussions&nbsp;&nbsp;</a></li>
          <?php
            if(isset($member_email)){
              echo '<li class="header_logout_form_div1_1_ul_li"><a href="./point/point_main.php">Free Bonus Credits&nbsp;&nbsp;</a></li>';
            }
          ?>
        </ul>
      </div>
        <div id="header_logout_form_div1_2">
          <?php
            if(isset($member_email)){
              echo '<ul id="header_logout_form_div1_2_ul">
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="#">
                    <div id="header_logout_form_div1_2_ul_li_div1">
                      <div id="header_logout_form_div1_2_ul_li_div1_div">
                        <button id="header_logout_form_div1_2_ul_li_div1_div_button" type="button" name="button">
                        Like
                        </button>
                      </div>
                    <img src="./img/like.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="#">
                    <div id="header_logout_form_div1_2_ul_li_div2">
                      <div id="header_logout_form_div1_2_ul_li_div2_div">
                        <button id="header_logout_form_div1_2_ul_li_div2_div_button" type="button" name="button">
                        Shop
                        </button>
                      </div>
                      <img src="./img/shop.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="#">
                    <div id="header_logout_form_div1_2_ul_li_div3">
                      <div id="header_logout_form_div1_2_ul_li_div3_div">
                        <button id="header_logout_form_div1_2_ul_li_div3_div_button" type="button" name="button">
                        Message
                        </button>
                      </div>
                      <img src="./img/message.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="#">
                    <div id="header_logout_form_div1_2_ul_li_div4">
                    <div id="header_logout_form_div1_2_ul_li_div4_div">
                      <button id="header_logout_form_div1_2_ul_li_div4_div_button" type="button" name="button">
                      Cart
                      </button>
                    </div>
                      <img src="./img/cart.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="#">
                    <div id="header_logout_form_div1_2_ul_li_div6">
                    <div id="header_logout_form_div1_2_ul_li_div6_div">
                      <button id="header_logout_form_div1_2_ul_li_div6_div_button" type="button" name="button">
                      Chart
                      </button>
                    </div>
                      <img src="./img/chart_top.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                <a href="#">
                <div id="header_logout_form_div1_2_ul_li_div5">&nbsp;
                <span style="font-weight:bold;">'.$member_email.'&nbsp;&nbsp;'.$member_mon.'&nbsp;MON</span>
                <div id="header_logout_form_div1_2_ul_li_div5_div">
                  <div><a href="#">&nbsp;Profile</a></div>
                  <div><a href="#">&nbsp;Shop</a></div>
                  <div><a href="#">&nbsp;Like</a></div>
                  <div><a href="#">&nbsp;Chart</a></div>
                  <div><a href="#">&nbsp;Cart</a></div>
                  <div><a href="#">&nbsp;Message</a></div>
                  <div><a href="#">&nbsp;Setting</a></div>
                  <div id="header_logout_form_div1_2_ul_li_div5_div_border_bottom"><a href="./lib/logout.php">&nbsp;Sign Out</a></div>
                </div>
                </div>
                </a>
                </li>
              </ul>';
            }
            if(!isset($member_email)){
              echo '
              <ul id="header_logout_form_div1_2_ul">
                <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button2" id="myBtn2">Sign in</button></li>
                <li class="header_logout_form_div1_2_ul_li">&nbsp;or&nbsp;</li>
                <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn">Join Now</button></li>
                <li class="header_logout_form_div1_2_ul_li"><a href="./lib/logout.php"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn3">Sign out</button></a> </li>
              </ul>
              ';
            }
          ?>

        </div>
      </div>
      <div id="header_logout_form_div2">
        <div id="header_logout_form_div2_1">
          <a href="./index.php"><img id="logo" src="./img/logo.png" alt=""></a>
        </div>
        <div id="header_logout_form_div2_2">
          <ul>
            <li class="header_logout_form_div2_ul1_li">
              <a class="header_logout_form_div2_ul1_li_a" href="./product_list/list.php?big_data=photos">Photos</a>
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

            <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="./product_list/list.php?big_data=graphics">Graphics</a>
              <ul class="submenu">
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Icons</a></li>
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Illustrations</a></li>
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Web Elements</a></li>
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Objects</a></li>
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Patterns</a></li>
                <li><a href="#" class="subheader_logout_form_div2_ul1_li_a">Textures</a></li>
              </ul>
            </li>
            <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="./product_list/list.php?big_data=fonts">Fonts</a>
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
          <div id="search_div">
            <img src="./img/zoom.png" id="search_img" style="width:17px; height:17px; padding-top:2px; padding:0;"> <input type="text" id="search_text" placeholder="Search">
          </div>
          <div id="header_logout_form_div2_3">
              <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
                <span id="header_logout_form_div2_3_span">All</span>
                <img id="change_img" src="./img/down.png" style="width:15px; height:15px;"/>&nbsp;&nbsp;&nbsp;
              </a>
            <ul id="header_logout_form_div2_3_ul">
              <li class="header_logout_form_div2_3_ul_li" id="All" onclick="index_select('All')" value="allcategories"><a href="#">All&nbsp;categories</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="photos" onclick="index_select('Photos')" value="Photos"><a href="#">Photos</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="Graphics" onclick="index_select('Graphics')" value="Graphics"><a href="#">Graphics</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="Fonts" onclick="index_select('Fonts')" value="Fonts"><a href="#">Fonts</a></li>
            </ul>
          </div>
        </div>
      </div>
</header>
