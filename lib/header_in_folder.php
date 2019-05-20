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

<header id="header">
  <div id="header_logout_form_div1">
      <div id="header_logout_form_div1_1">
        <ul id="header_logout_form_div1_1_ul">
          <li class="header_logout_form_div1_1_ul_li"><a href="#">Get Free Goods&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="#">Become a Partner&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="#">Discussions&nbsp;&nbsp;</a></li>
          <?php
            if(){
              echo '<li class="header_logout_form_div1_1_ul_li"><a href="#">Free Bonus Credits&nbsp;&nbsp;</a></li>';
            }
          ?>
        </ul>
      </div>
        <div id="header_logout_form_div1_2">
          <?php
            if(isset($memeber_email)){

            }
            if(!isset($memeber_email)){
              echo '
              <ul id="header_logout_form_div1_2_ul">
                <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button2" id="myBtn2">Sign in</button></li>
                <li class="header_logout_form_div1_2_ul_li">&nbsp;or&nbsp;</li>
                <li class="header_logout_form_div1_2_ul_li"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn">Join Now</button></li>
                <li class="header_logout_form_div1_2_ul_li"><a href="../lib/logout.php"><button type="button" name="header_logout_form_div1_ul1_li2_button1" id="myBtn3">Sign out</button></a> </li>
              </ul>
              ';
            }
          ?>
        </div>
      </div>
      <div id="header_logout_form_div2">
        <div id="header_logout_form_div2_1">
          <a href="#"><img id="logo" src="../img/logo.png" alt=""></a>
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
            <label id="search_label"><img src="../img/zoom.png" id="search_img" style="width:17px; height:17px; padding-top:2px; padding:0;"> <input type="text" id="search_text" placeholder="Search"> </label>
          <div id="header_logout_form_div2_3">
              <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
                <span id="header_logout_form_div2_3_span">All</span>
                <img id="change_img" src="../img/down.png" style="width:15px; height:15px;"/>&nbsp;&nbsp;&nbsp;
              </a>
            <ul id="header_logout_form_div2_3_ul">
              <li class="header_logout_form_div2_3_ul_li" id="All" onclick="select('All')" value="allcategories"><a href="#">All&nbsp;categories</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="photos" onclick="select('Photos')" value="Photos"><a href="#">Photos</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="Graphics" onclick="select('Graphics')" value="Graphics"><a href="#">Graphics</a></li>
              <li class="header_logout_form_div2_3_ul_li" id="Fonts" onclick="select('Fonts')" value="Fonts"><a href="#">Fonts</a></li>
            </ul>
          </div>
        </div>
      </div>
</header>
