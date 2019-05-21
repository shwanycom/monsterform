<?php
session_start();
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
define('SCALE', 10);
?>
<?php
if(isset($_GET['mode'])){
  $search_value = $_POST['search_value'];
  $search_kind = $_POST['search_kind'];
}
if(empty($search_value)){
    $sql = "select * from `member` where `username` != 'admin'";
}else if($search_kind=="username"){
    $sql="select * from `member` where `username` like '%$search_value%' ";
}else if($search_kind=="email"){
    $sql="select * from `member` where `email` like '%$search_value%' ";
}
$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result); //전체 레코드 수
// 페이지 당 글수, 블럭당 페이지 수
$rows_scale=15;
$pages_scale=5;
// 전체 페이지 수 ($total_page) 계산
$total_pages= ceil($total_record/$rows_scale);
if(empty($_GET['page'])){
    $page=1;
}else{
    $page = $_GET['page'];
}

// 현재 페이지 시작 위치
$start_row= $rows_scale * ($page -1) ;
// 이전 페이지 = 현재 페이지가 1일 경우. null값.
$pre_page= $page>1 ? $page-1 : NULL;
// 다음 페이지 = 현재페이지가 전체페이지 수와 같을 때  null값.
$next_page= $page < $total_pages ? $page+1 : NULL;
// 현재 블럭의 시작 페이지 = (ceil(현재페이지/블럭당 페이지 제한 수)-1) * 블럭당 페이지 제한 수 +1  [[  EX) 현재 페이지 5일 때 => ceil(5/3)-1 * 3  +1 =  (2-1)*3 +1 = 4 ]]
$start_page= (ceil($page / $pages_scale ) -1 ) * $pages_scale +1 ;
// 현재 블럭 마지막 페이지
$end_page= ($total_pages >= ($start_page + $pages_scale)) ? $start_page + $pages_scale-1 : $total_pages;
$number=$total_record- $start_row;
?>
<style media="screen">
*{
  /* border:1px solid red; */
}
#admin_member_section{
  margin-left: 10%;
  margin-right: 10%;
  background-color: rgb(245,245,244,230);
}
#search_form{
  height:40px;
  margin:0;
  padding:0;
}
#search_form_div1{
  display: inline-block;
  height:35px;
  width:40%;
  vertical-align: middle;
}
#search_form_div2{
  display: inline-block;
  float: right;
  position: right;
  height:35px;
  vertical-align: middle;
}
#search_form_div2 *{
  display: inline-block;
}
#search_kind{
  height:30px;
  border:2px solid lightgray;
  outline: none;
  margin-left:5px;
}
#search_text{
  height:30px;
  width:300px;
  border:2px solid lightgray;
  outline: none;
}
#serch_text:focus{
  height:30px;
  width:300px;
  outline: none;
  background-color: #bbbbbb;
}
#search_submit{
  height:30px;
  width:120px;
  outline: none;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
#search_submit:hover{
  height:30px;
  width:120px;
  outline: none;
  background-color: #bbbbbb;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
#button_delete, #button_update{
  outline: none;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
#button_delete:hover, #button_update:hover{
  outline: none;
  background-color: #bbbbbb;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
input.switch_check {
  position: relative;
  top:6px;
  width:30px;
  height:15px;
  -webkit-appearance:none;
  background: #c6c6c6;
  outline: none;
  border-radius: 20px;
  box-shadow: inset 0 0 5px rgba(0,0,0,.2);
  transition: .1s;
}
input.switch_check:after {
 content: "";
 position: absolute;
 top: 1px;
 left: 1px;
 width: 12px;
 height: 12px;
 background-color: #fff;
 border-radius: 50%;
 box-shadow: 2px 4px 6px rgba(0,0,0,0.2);
}
input.switch_check:checked {
 border-color: rgb(6, 95, 187);
 box-shadow: inset 20px 0 0 0 #4ED164;
}
input.switch_check:checked:after {
 left: 20px;
 box-shadow: -2px 4px 3px rgba(0,0,0,0.05);
}
#admin_member_table td{
  text-align: center;
  height:55px;
}
#div_send_message{
  width:0;
  height:0;
  overflow: hidden;
  position: absolute;
}
#td_send_message:hover #div_send_message{
  width:180px;
  height:45px;
  overflow: hidden;
  position: absolute;
}
#button_send_message{
  outline: none;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
#button_send_message:hover{
  outline: none;
  background-color: #bbbbbb;
  border:2px solid lightgray;
  margin-right: 5px;
  border-radius:15px;
}
</style>
<script>
var partner_index1=0;
      // <a href='admin_member_update.php?no=$no&partner='>
      function check_partner(partner_index){
        partner_index1=partner_index;
          alert(partner_index1);
      }
</script>
<section id="admin_member_section">
  <div id="admin_member_section_search_div">
    <h1>Member List</h1>
        <form action="./admin_member.php?mode=search" method="post" id="search_form">
          <div id="search_form_div1">
            <select id="search_kind" name="search_kind">
            <option value="username">USERNAME</option>
            <option value="email">E-MAIL</option>
            </select>
            <input type="text" id="search_text" name="search_value">
          </div>
          <div id="search_form_div2">
            <label for="">PARTNER</label>
            <input class="switch_check" type="checkbox" id="switch_checkbox" onclick="check_partner()" value="partner" name="switch_checkbox">
            <input type="submit" value="Search" id="search_submit">
          </div>
        </form>
      </div>
  </div>
  <hr style="border: 1px solid black;">
 <table id="admin_member_table">
<?php
$check="";
$check_index="";
echo "<tr class='admin_member_table_tr1'>
              <td width='50'>NO</td>
              <td width='124'>E-MAIL</td>
              <td width='179.2'>USERNAME</td>
              <td width='50'>MON</td>
              <td width='50'>P</td>
              <td width='181.2'>LOCATION</td>
              <td width='181.2'>PROFESSION</td>
              <td width='181.2'>PURPOSE</td>
              </tr>";
for($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
  //가져올 레코드 위치 이동
  mysqli_data_seek($result, $i);
  //하나 레코드 가져오기
  $row=mysqli_fetch_array($result);
  $no=$row["no"];
  $email=$row["email"];
  $username=$row["username"];
  $mon=$row["point_mon"];
  $partner=$row["partner"];
  if($partner=='y'){
    $check='checked';
    $check_index=1;
  }else{
    $check='';
    $check_index=0;
  }
  $location=$row["location"];
  $profession=$row["profession"];
  $use_mf=$row["use_mf"];
  echo "<tr class=''>
              <td>$no</td>
              <td id='td_send_message'>$email<div id='div_send_message'><a href='#'>
              <button id='button_send_message' type='button' name='button'>
              Send Message to $email
              </button></a></div></td>
              <td>$username</td>
              <td>$mon</td>
              <td><input id='on_partner' type='checkbox' name='on_partner' value='y' onclick='check_partner($check_index)' $check></td>
              <td>$location</td>
              <td>$profession</td>
              <td>$use_mf</td>
              <td>
              <a href='admin_member_delete.php?no=$no'>
              <button type='button' class='button' id='button_delete'>DELETE</button>
              </a>
              </td>
              <td>
              <button type='button' class='button' id='button_update'>UPDATE</button>
              </td>
              </tr>";
  echo"  <tr></td></tr>";
}
  ?>
</table>
<hr>
<div><a href='admin_member.php'><input type='button' value='LIST'></a></div>
<div>
<?PHP
          #----------------이전블럭 존재시 링크------------------#
          if($start_page > $pages_scale){
             $go_page= $start_page - $pages_scale;
             echo "<a id='before_block' href='message.php?mode=$mode&page=$go_page'> << </a>";
          }
          #----------------이전페이지 존재시 링크------------------#
          if($pre_page){
              echo "<a id='before_page' href='message.php?mode=$mode&page=$pre_page'> < </a>";
          }
           #--------------바로이동하는 페이지를 나열---------------#
          for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
             if($dest_page == $page){
                  echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
              }else{
                  echo "<a id='move_page' href='message.php?mode=$mode&page=$dest_page'>$dest_page</a>";
              }
           }
           #----------------이전페이지 존재시 링크------------------#
           if($next_page){
               echo "<a id='next_page' href='message.php?mode=$mode&page=$next_page'> > </a>";
           }
           #---------------다음페이지를 링크------------------#
          if($total_pages >= $start_page+ $pages_scale){
            $go_page= $start_page+ $pages_scale;
            echo "<a id='next_block' href='message.php?mode=$mode&page=$go_page'> >> </a>";
          }
 ?>
</div>
</section>
