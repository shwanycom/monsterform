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
}else if($kind=="username"){
    $sql="select * from `member` where `username` like '%$search_value%' ";
}else if($kind=="email"){
    $sql="select * from `member` where `email` like '%$search_value%' ";
}
    $result = mysqli_query($con, $sql) or die(mysqli_error($con));
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

// 현재 페이지 시작 위치 = (페이지 당 글 수 * (현재페이지 -1))  [[ EX) 현재 페이지 2일 때 => 3*(2-1) = 3 ]]
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
  </head>
  <body>
    <div id="head">
      <h1 style="">Member List</h1>
        <div>
          <form action="./admin_member.php?mode=search" method="post" id="serch_form">
            <select name="search_kind">
            <option value="usename">username</option>
            <option value="eamil">e-mail</option>
            </select>
            <input type="text" name="search_value">
            <input type="submit" value="Search" id="serch_form">
          </form>
        </div>
    </div>
    <hr style="border: 1px solid black;">
   <table id="admin_member_table">
  <?php
  echo "<tr class='admin_member_table_tr1'>
                <td width='128'>NO</td>
                <td width='124'>E-MAIL</td>
                <td width='179.2'>USERNAME</td>
                <td width='181.2'>MON</td>
                </tr>";
  for($i=$start_row; ($i<$start_row+$rows_scale) && ($i< $total_record); $i++){
    //가져올 레코드 위치 이동
    mysqli_data_seek($result, $i);
    //하나 레코드 가져오기
    $row=mysqli_fetch_array($result);
    $no=$row["no"];
    $email=$row["email"];
    $username=$row["username"];
    $mon=$row["mon"];

    echo "<tr class='admin_member_table_tr2' style='text-align:center;'>
                <td>$no</td>
                <td>$email</td>
                <td>$username</td>
                <td>$mon</td>
                <td style='text-align:center;'>
                <a href='delete_memberlist.php?no=$no'>
                <button type='button' class='button'>DELETE</button>
                </a>
                </td>
                </tr>";
    echo"  <tr class='admin_member_table_tr3' bgcolor='#cccccc'><td colspan='7'></td></tr>";
  }
    ?>
</table>
<hr>
<div style="text-align: right;"><a href='admin_memeber.php'><input type='button' value='LIST'></a></div>
  <div id='page_box' style="text-align: center;">
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
  </body>
</html>
