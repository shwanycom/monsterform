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
