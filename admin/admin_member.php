<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
if(isset($_SESSION['username'])){
  if($_SESSION['username']!=='admin'){
    echo "<script> alert('no permission'); history.go(-1); </script>";
  }
}else if(!isset($_SESSION['username'])){
  echo "<script> alert('no permission'); history.go(-1); </script>";
}

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
define('SCALE', 10);
?>
<?php
$checked_sort_partner="";
$checked_sort_exchange="";

if(isset($_GET['mode'])){
  $search_value = $_GET['search_value'];
  $search_kind = $_GET['search_kind'];
}
if(isset($_GET['search_kind']) && $_GET['search_kind']=="username"){
  $sort_kind="username";
}else if(isset($_GET['search_kind']) && $_GET['search_kind']=="email"){
  $sort_kind="email";
}
if(isset($_GET['sort_partner']) && $_GET['sort_partner']=='sort_partner'){
  $sort_partner="and `partner`='y'";
  $checked_sort_partner="checked";
  $get_sort="sort_partner";
}else{
  $sort_partner="";
  $checked_sort_partner="";
  $get_sort="";
}
if(isset($_GET['sort_exchange']) && $_GET['sort_exchange']=='sort_exchange'){
  $sort_exchange="and `hwan_mon`!=0";
  $checked_sort_exchange="checked";
  $get_exc="sort_exchange";
}else{
  $sort_exchange="";
  $checked_sort_exchange="";
  $get_exc="";
}
if(!isset($_GET['mode'])){
$sql="select * from `member`";
$url="./admin_member.php?";
}else{
$sql="select * from `member` where $sort_kind like '%$search_value%' $sort_partner $sort_exchange";
$url="./admin_member.php?mode=search&search_kind=$sort_kind&search_value=$search_value&sort_partner=$get_sort&sort_exchange=$get_exc";
}

$result = mysqli_query($conn, $sql);
$total_record = mysqli_num_rows($result); //전체 레코드 수
// 페이지 당 글수, 블럭당 페이지 수
$rows_scale=10;
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
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script>
    function check_delete(num, loc) {
      var decision_delete= confirm("update this member? \n Either OK or Cancel");
      if(decision_delete){
        window.location.href='admin_member_dml.php?mode=delete&no='+num+'&location='+loc;
      }
    }
    function check_partner(num, pt) {
      if(pt=="PARTNER"){
        var decision_partner= confirm("update this member?(partner) \n Either OK or Cancel");
        if(decision_partner){
          window.location.href='admin_member_dml.php?mode=update&no='+num+'&partner='+pt;
        }
      }
      if(pt=="TERMINATE"){
        var decision_partner= confirm("update this member?(terminate) \n Either OK or Cancel");
        if(decision_partner){
          window.location.href='admin_member_dml.php?mode=update&no='+num+'&partner='+pt;
        }
      }
    }
    function check_accept(num ,rid) {
      var decision_accept= confirm("accept exchange? \n Either OK or Cancel");
      if(decision_accept){
        window.location.href='admin_member_dml.php?mode=exchange_accept&no='+num+'&remail='+rid;
      }
    }
    function check_reject(num, mon, hwan_mon, rid) {
      var decision_reject= confirm("reject exchange? \n Either OK or Cancel");
      if(decision_reject){
        window.location.href='admin_member_dml.php?mode=exchange_reject&no='+num+'&mon='+mon+'&hwan_mon='+hwan_mon+'&remail='+rid;
      }
    }

    </script>
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/footer_2.css">
    <link rel="stylesheet" href="../css/admin.css">
    <link rel="stylesheet" href="../css/message.css">
  </head>
  <body>
    <?php
      include "../lib/header_in_folder.php";
    ?>
    <section id="admin_member_section">
      <div id="admin_member_section_search_div">
        <h1>Member List / TOTAL : <?=$total_record?></h1>
            <form action="./admin_member.php" method="get" id="search_form" name="search_form">
              <input type="hidden" name="mode" value="search">
              <div id="search_form_div1">
                <select id="search_kind" name="search_kind">
                <option value="username">USERNAME</option>
                <option value="email">E-MAIL</option>
                </select>
                <input type="text" id="admin_member_search_text" name="search_value">
              </div>
              <div id="search_form_div2">
                <label for="">PARTNER</label>
                <input class="switch_check" type="checkbox" value="sort_partner" name="sort_partner" <?=$checked_sort_partner;?>>
                <label for="">EXCHANGE</label>
                <input class="switch_check" type="checkbox" value="sort_exchange" name="sort_exchange" <?=$checked_sort_exchange;?>>
                <input type="submit" value="Search" id="search_submit">
              </div>
            </form>
          </div>
      </div>
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
                  <td width='150'>PROFESSION</td>
                  <td width='181.2'>PURPOSE</td>
                  <td width='90'>BLOCK</td>
                  <td width='115'>PARTNER</td>
                  <td width='250'>EXCHANGE MON</td>
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
      $hwan_mon=$row["hwan_mon"];
      $partner=$row["partner"];
      if($partner=='y'){
        $check='checked';
        $button_index="TERMINATE";
      }else{
        $check='';
        $button_index="PARTNER";
      }
      $location=$row["location"];
      if($location=='hell'){
        $button_block="blocked";
      }else{
        $button_block="block";
      }
      $profession=$row["profession"];
      $use_mf=$row["use_mf"];
      echo '<tr class="">
                  <td>'.$no.'</td>
                  <td id="td_send_message"><a href="../member_profile/profile_view.php?mode=shop&email='.$email.'">'.$email.'</a><div id="div_send_message">
                  <button id="button_send_message" type="button" name="button" onclick="send_to_member(\''.$email.'\')">
                  Send Message to '.$email.'
                  </button></div></td>
                  <td>'.$username.'</td>
                  <td>'.$mon.'</td>
                  <td><input id="on_partner" type="checkbox" name="on_partner" value="y" '.$check.' disabled></td>
                  <td>'.$location.'</td>
                  <td>'.$profession.'</td>
                  <td>'.$use_mf.'</td>
                  <td>
                  <button type="button" class="button" id="button_delete" onclick="check_delete(\''.$no.'\',\''.$location.'\')">'.$button_block.'</button>
                  </td>
                  <td>
                  <button type="button" class="button" id="button_update" onclick="check_partner(\''.$no.'\',\''.$button_index.'\')">'.$button_index.'</button>
                  </td>
                  <td>'.$hwan_mon.'<br>
                  <button type="button" class="button" id="button_accept" onclick="check_accept(\''.$no.'\',\''.$email.'\')">ACCEPT</button>
                  <button type="button" class="button" id="button_reject" onclick="check_reject(\''.$no.'\',\''.$mon.'\',\''.$hwan_mon.'\',\''.$email.'\')">REJECT</button></td>
                  </tr>';
      echo"  <tr></td></tr>";
    }
      ?>
    </table>
    <br><br><br>
    <div id="admin_member_list_div"><a href='admin_member.php'><button id="admin_member_button_list"type="button" name="button">LIST</button></a></div>
    <div id="admin_member_next_prev_div">
    <?PHP
              #----------------이전블럭 존재시 링크------------------#
              if($start_page > $pages_scale){
                 $go_page= $start_page - $pages_scale;
                 echo "<a id='before_block' href='$url&page=$go_page'> << </a>";
              }
              #----------------이전페이지 존재시 링크------------------#
              if($pre_page){
                  echo "<a id='before_page' href='$url&page=$pre_page'> < </a>";
              }
               #--------------바로이동하는 페이지를 나열---------------#
              for($dest_page=$start_page;$dest_page <= $end_page;$dest_page++){
                 if($dest_page == $page){
                      echo( "&nbsp;<b id='present_page'>$dest_page</b>&nbsp" );
                  }else{
                      echo "<a id='move_page' href='$url&page=$dest_page'>$dest_page</a>";
                  }
               }
               #----------------이전페이지 존재시 링크------------------#
               if($next_page){
                   echo "<a id='next_page' href='$url&page=$next_page'> > </a>";
               }
               #---------------다음페이지를 링크------------------#
              if($total_pages >= $start_page+ $pages_scale){
                $go_page= $start_page+ $pages_scale;
                echo "<a id='next_block' href='$url&page=$go_page'> >> </a>";
              }
     ?>
    </div>
    <br><br>
    </section>
  </body>
</html>


<?php
  include "./admin_main_in_folder.php";
  include "../lib/footer_in_folder.php";
  include "./send_message_modal_in_admin.php";
?>
