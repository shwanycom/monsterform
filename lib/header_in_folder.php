<?php
if(isset($_SESSION['email'])){
  $member_email = $_SESSION['email'];
  $sql_mon = "select `point_mon` from `member` where email='$member_email'";
  $result_mon = mysqli_query($conn, $sql_mon);
  $row_mon=mysqli_fetch_array($result_mon);
  $mem_mon=$row_mon['point_mon'];

  $sql_nmessage = "select * from `message` where rece_email='$member_email' and rece_status='n'";
  $result_nmessage = mysqli_query($conn, $sql_nmessage);
  $total_nmessage_record = mysqli_num_rows($result_nmessage);
  if($total_nmessage_record>0){
    $flag_nm="../img/new_message.png";
  }else{
    $flag_nm="../img/message.png";
  }

}
?>
<script type="text/javascript">
  var value="";
  function index_select(value){
    var text = value;
    document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
    document.getElementById("big_data").value= text;
  }
  function mouse_over(){
    document.getElementById('change_img').src="../img/up.png";
  }
  function mouse_out(){
    document.getElementById('change_img').src="../img/down.png";
  }
  function chart_show(){
    window.open("../member_profile/member_chart.php", "_blank", "toolbar=no,scrollbars=yes,resizable=yes,top=200,left=200,width=1000,height=500");
  }
  </script>
  <style media="screen">

  </style>
<header id="header">
  <div id="header_logout_form_div1">
      <div id="header_logout_form_div1_1">
        <ul id="header_logout_form_div1_1_ul">
          <li class="header_logout_form_div1_1_ul_li"><a href="../goods/freegoods.php">Get Free Goods&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="../earn/becomeapartner.php">Become a Partner&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <li class="header_logout_form_div1_1_ul_li"><a href="../discussion/list.php">Discussions&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
          <?php
            if(isset($member_email)){
              echo '<li class="header_logout_form_div1_1_ul_li"><a href="../point/point_main.php">Free Bonus Credits&nbsp;&nbsp;</a></li>';
            }
          ?>
        </ul>
      </div>
        <div id="header_logout_form_div1_2">
          <?php
            if(isset($member_email)){
              echo '<ul id="header_logout_form_div1_2_ul">
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="../member_profile/profile_view.php?mode=likes&email='.$member_email.'">
                    <div id="header_logout_form_div1_2_ul_li_div1">
                      <div id="header_logout_form_div1_2_ul_li_div1_div">
                        <button id="header_logout_form_div1_2_ul_li_div1_div_button" type="button" name="button">
                        Like
                        </button>
                      </div>
                    <img src="../img/like.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'">
                    <div id="header_logout_form_div1_2_ul_li_div2">
                      <div id="header_logout_form_div1_2_ul_li_div2_div">
                        <button id="header_logout_form_div1_2_ul_li_div2_div_button" type="button" name="button">
                        Shop
                        </button>
                      </div>
                      <img src="../img/shop.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="../message/message.php">
                    <div id="header_logout_form_div1_2_ul_li_div3">
                      <div id="header_logout_form_div1_2_ul_li_div3_div">
                        <button id="header_logout_form_div1_2_ul_li_div3_div_button" type="button" name="button">
                        Message
                        </button>
                      </div>
                      <img src="'.$flag_nm.'" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="../shop/cart.php">
                    <div id="header_logout_form_div1_2_ul_li_div4">
                    <div id="header_logout_form_div1_2_ul_li_div4_div">
                      <button id="header_logout_form_div1_2_ul_li_div4_div_button" type="button" name="button">
                      Cart
                      </button>
                    </div>
                      <img src="../img/cart.png" alt="">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                  <a href="">
                    <div id="header_logout_form_div1_2_ul_li_div6" >
                    <div id="header_logout_form_div1_2_ul_li_div6_div">
                      <button id="header_logout_form_div1_2_ul_li_div6_div_button" type="button" name="button" onclick="chart_show()">
                      Chart
                      </button>
                    </div>
                      <img src="../img/chart_top.png" alt="" onclick="chart_show()">
                    </div>
                  </a>
                </li>
                <li class="header_logout_form_div1_2_ul_li">
                <a href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'">
                <div id="header_logout_form_div1_2_ul_li_div5">&nbsp;
                <span style="font-weight:bold;">'.$member_email.'&nbsp;&nbsp;'.$mem_mon.'&nbsp;MON</span>
                <div id="header_logout_form_div1_2_ul_li_div5_div">
                  <div><a href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'">&nbsp;Profile</a></div>
                  <div><a href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'">&nbsp;Shop</a></div>
                  <div><a href="../member_profile/profile_view.php?mode=likes&email='.$member_email.'">&nbsp;Like</a></div>
                  <div><a href="../member_profile/profile_view.php?mode=collections&email='.$member_email.'">&nbsp;Collections</a></div>
                  <div><a href="../shop/cart.php">&nbsp;Cart</a></div>
                  <div><a href="../message/message.php">&nbsp;Message</a></div>
                  <div><a href="../member_profile/profile_edit.php?mode=profile_info">&nbsp;Setting</a></div>
                  <div id="header_logout_form_div1_2_ul_li_div5_div_border_bottom"><a href="../lib/logout.php">&nbsp;Sign Out</a></div>
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
              </ul>
              ';
            }
          ?>

        </div>
      </div>
      <div id="header_logout_form_div2">
        <div id="header_logout_form_div2_1">
          <a href="../index.php"><img id="logo" src="../img/logo.png" alt=""></a>
        </div>
        <div id="header_logout_form_div2_2">
          <ul>
            <li class="header_logout_form_div2_ul1_li">
              <a class="header_logout_form_div2_ul1_li_a" href="../product_list/list.php?big_data=photos">Photos</a>
              <ul class="submenu">
                <li><a href="../product_list/list.php?big_data=photos&small_data=animals&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Animals</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=arts&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Arts</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=beauty_fashion&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Beauty & Fashion</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=business&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Business</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=food_drink&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Food & Drink</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=nature&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Nature</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=sports&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Sports</a></li>
                <li><a href="../product_list/list.php?big_data=photos&small_data=technology&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Technology</a></li>
              </ul>
            </li>

            <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="../product_list/list.php?big_data=graphics">Graphics</a>
              <ul class="submenu">
                <li><a href="../product_list/list.php?big_data=graphics&small_data=icons&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Icons</a></li>
                <li><a href="../product_list/list.php?big_data=graphics&small_data=illustrations&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Illustrations</a></li>
                <li><a href="../product_list/list.php?big_data=graphics&small_data=web_elements&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Web Elements</a></li>
                <li><a href="../product_list/list.php?big_data=graphics&small_data=objects&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Objects</a></li>
                <li><a href="../product_list/list.php?big_data=graphics&small_data=patterns&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Patterns</a></li>
                <li><a href="../product_list/list.php?big_data=graphics&small_data=textures&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Textures</a></li>
              </ul>
            </li>
            <li class="header_logout_form_div2_ul1_li"> <a class="header_logout_form_div2_ul1_li_a" href="../product_list/list.php?big_data=fonts">Fonts</a>
              <ul class="submenu">
                <li><a href="../product_list/list.php?big_data=fonts&small_data=blackletter&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Blackletter</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=display&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Display</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=non_western&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Non Western</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=sans_serif&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Sans Serif</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=script&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Script</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=serif&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Serif</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=slab_serif&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Slab Serif</a></li>
                <li><a href="../product_list/list.php?big_data=fonts&small_data=symbols&mode=search&partner=n&handpicked=n&popular=n" class="subheader_logout_form_div2_ul1_li_a">Symbols</a></li>
              </ul>
            </li>
          </ul>
        </div>
        <div class="header_logout_form_div5">
          <form class="" action="./list.php?" method="GET">
          <div id="search_div">
            <input type="hidden" name="big_data1" id="big_data1" value="">
            <input type="hidden" name="mode1" value="search">
            <input type="hidden" name="partner1" value="n">
            <input type="hidden" name="handpicked1" value="n">
            <input type="hidden" name="popular1" value="n">
            <input type="text" id="search_text" name="search_text" placeholder="Search">
            <button type="submit"  style="width:30px; height:30px;  outline:none; border:none;"><img src="../img/zoom.png" id="search_img" style="width:17px; height:17px; padding:0;"></button>
          </div>
          <div id="header_logout_form_div2_3">
              <a href="#" id="header_logout_form_div2_3_a" onmouseover="mouse_over()" onmouseout="mouse_out()">
                <span id="header_logout_form_div2_3_span">Select</span>
                <img id="change_img" src="../img/down.png" style="width:15px; height:15px;"/>&nbsp;&nbsp;&nbsp;
              </a>
            <ul id="header_logout_form_div2_3_ul">
              <li class="header_logout_form_div2_3_ul_li" name="big_data" id="photos" onclick="index_select('photos')" value="Photos"><a href="#">Photos</a></li>
              <li class="header_logout_form_div2_3_ul_li" name="big_data" id="Graphics" onclick="index_select('graphics')" value="Graphics"><a href="#">Graphics</a></li>
              <li class="header_logout_form_div2_3_ul_li" name="big_data" id="Fonts" onclick="index_select('fonts')" value="Fonts"><a href="#">Fonts</a></li>
            </ul>
          </div>
        </form>
        </div>
      </div>
</header>
