<!--
freegoods 지정 페이지
회원관리 페이지
매출페이지
핸드픽드 페이지
section -->
<style>
/* *{
  border:0.1px solid red;
} */
#section_admin_main{
  height:250px;
  text-align: center;
  background-color: rgb(245,245,244,230);
}
.admin_div img{
  width:130px;
  border-radius: 5px;
}
.admin_div img:hover{
  box-shadow: 8px 13px 20px rgba(192, 192, 191, 180);
  border-radius: 5px;
  width:130px;
}
.admin_div a:link{
  text-decoration: none;
  color:rgb(127,127,127,120);
}
.admin_div a:visited{
  text-decoration: none;
  color:rgb(127,127,127,120);
}
.admin_div a{
  height:300px;
  margin-top:30px;
  text-decoration: none;
  color:rgb(127,127,127,120);
}
.admin_div a:hover{
  text-decoration: none;
  color:rgb(180,180,180,120);
}
.admin_div{
  display: inline-block;
  width:200px;
}


</style>
<section id="section_admin_main">
<div id="admin_freegoods_div" class="admin_div">
<a href="#"><img src="../img/font_symbol.png" alt=""><p>Select Freegoods</p></a>

</div>
<div id="admin_member_div" class="admin_div">
<a href="#"><img src="../img/font_symbol.png" alt=""><p>Members</p></a>

</div>
<div id="admin_chart_div" class="admin_div">
<a href="#"><img src="../img/font_symbol.png" alt=""><p>Revenue Chart</p></a>

</div>
<div id="admin_handpicked_div" class="admin_div">
<a href="#"><img src="../img/font_symbol.png" alt=""><p>Handpicked</p></a>

</div>
</section>
