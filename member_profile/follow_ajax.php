<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

define('SCALE', 5);
if(isset($_POST['shop_no'])){
  $shop_no = intval($_POST['shop_no']);
  $sql = "SELECT * from `follow` where follower = $shop_no";
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  for($i=0 ;$i < SCALE && $i < $total_record ; $i++){
    mysqli_data_seek($result, $i);

    $row = mysqli_fetch_array($result);
    $follower = $row['following'];

    $sql_mem = "SELECT * from `member` where no = '$follower';";
    $result_mem = mysqli_query($conn, $sql_mem);
    $total_record_mem = mysqli_num_rows($result_mem);

    for($j=0;$j<$total_record_mem;$j++){
      mysqli_data_seek($result_mem, $j);
      $row_mem = mysqli_fetch_array($result_mem);
      $mem_email = $row_mem['email'];
      $mem_username = $row_mem['username'];
      $mem_copy_name = $row_mem['pro_img_copied'];
      if($mem_copy_name==null){
        $mem_copy_name= "../data/img/no_profile.png";
      }else{
        $mem_copy_name = "../data/img/".$mem_copy_name;
      }

      echo '<div id="follow_list_div">
         <table border="1">
           <tr>
             <td rowspan="2" width="25%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'"><img src="'.$mem_copy_name.'" alt="" width="50px;" height="50px;"></a></td>
             <td id="follow_username" width="70%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'">'.$mem_username.'</a></td>
           </tr>
           <tr>
             <td id="follow_email" width="70%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'">'.$mem_email.'</a></td>
           </tr>
         </table>
       </div>';

    } // end of inner for
  } // end of outer for
}else if(isset($_POST['shop_no1'])){
  $shop_no = intval($_POST['shop_no1']);
  $sql = "SELECT * from `follow` where following = $shop_no";
  $result = mysqli_query($conn, $sql);
  $total_record = mysqli_num_rows($result);

  for($i=0 ;$i < SCALE && $i < $total_record ; $i++){
    mysqli_data_seek($result, $i);

    $row = mysqli_fetch_array($result);
    $follower = $row['follower'];

    $sql_mem = "SELECT * from `member` where no = '$follower';";
    $result_mem = mysqli_query($conn, $sql_mem);
    $total_record_mem = mysqli_num_rows($result_mem);

    for($j=0;$j<$total_record_mem;$j++){
      mysqli_data_seek($result_mem, $j);
      $row_mem = mysqli_fetch_array($result_mem);
      $mem_email = $row_mem['email'];
      $mem_username = $row_mem['username'];
      $mem_copy_name = $row_mem['pro_img_copied'];
      if($mem_copy_name==null){
        $mem_copy_name= "../data/img/no_profile.png";
      }else{
        $mem_copy_name = "../data/img/".$mem_copy_name;
      }

      echo '<div id="follow_list_div">
         <table border="1">
           <tr>
             <td rowspan="2" width="25%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'"><img src="'.$mem_copy_name.'" alt="" width="50px;" height="50px;"></a></td>
             <td id="follow_username" width="70%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'">'.$mem_username.'</a></td>
           </tr>
           <tr>
             <td id="follow_email" width="70%;"><a href="./profile_view.php?mode=shop&email='.$mem_email.'">'.$mem_email.'</a></td>
           </tr>
         </table>
       </div>';
     }
   }
 }

 ?>
