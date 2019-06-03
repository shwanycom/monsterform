<?php
include $_SERVER['DOCUMENT_ROOT']."./monsterform/lib/db_connector.php";
include $_SERVER['DOCUMENT_ROOT']."./monsterform/lib/create_table.php";
include $_SERVER['DOCUMENT_ROOT']."./monsterform/lib/session_call.php";

create_table($conn, 'member');

if($_GET["mode"]=="login"){
  if(!(isset($_POST["login_email"])&&isset($_POST["login_password"]))
     ||empty($_POST["login_email"])||empty($_POST["login_password"])){
       echo "<script>alert('다 입력해 주세요'); history.go(-1); </script>";
  }else{
    $email = $_POST["login_email"];
    $password= $_POST["login_password"];
  }

  $sql="SELECT * from `member` where `email` = '$email'";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  $rowcount=mysqli_num_rows($result);
  if(!$rowcount){
    mysqli_close($conn);
    echo "<script>alert('디비에 없는 메일'); history.go(-1);</script>";
  }else{
    $row=mysqli_fetch_array($result);
    if($password==$row['password']){
      $location = $row['location'];
      if($location=='hell'){
        echo "<script>alert('현재 Block상태인 계정입니다.'); history.go(-1);</script>";
      }else{
        $_SESSION['no'] = $row['no'];
        $_SESSION['email'] = $row['email'];
        $_SESSION['username'] = $row['username'];
        $_SESSION['mon'] = $row['point_mon'];
        $_SESSION['partner'] = $row['partner'];
        $username = $row['username'];
        echo "<script>alert('$username 님 반갑습니다~');</script>";
      }
    }else{
       echo "<script>alert('패스워드가 일치하지 않습니다'); history.go(-1);</script>";
    }
  }
  mysqli_close($conn);
  ?>
  <script>document.location.href="../index.php";</script>

  <?php
}elseif ($_GET["mode"]=="join") {
  if(!(isset($_POST["member_email_address"])&&isset($_POST["member_username"])&&isset($_POST["member_password"]))
     ||empty($_POST["member_email_address"])||empty($_POST["member_username"])||empty($_POST["member_password"])){
       echo "<script>alert('다 입력해 주세요'); history.go(-1); </script>";
  }else{
    $email = $_POST["member_email_address"];
    $username = $_POST["member_username"];
    $password = $_POST["member_password"];
    $sql="INSERT INTO `member` (`no`,`email`,`username`,`password`,`point_mon`,`partner`)";
    $sql.=" VALUES (null,'$email','$username','$password',0,'n')";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

    $sql="SELECT * from `member` where `email` = '$email'";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    $row=mysqli_fetch_array($result);
    $_SESSION['no'] = $row['no'];
    $_SESSION['email'] = $row['email'];
    $_SESSION['username'] = $row['username'];
    $_SESSION['mon'] = $row['point_mon'];
    $_SESSION['partner'] = $row['partner'];
  }
  mysqli_close($conn);
  echo "<script>
          alert('Thankyou for join us!');
          document.location.href='../index.php';
        </script>";
}else if(isset($_GET["mode"]) && $_GET["mode"]=="email_ajax") {
  $email=$_POST["email"];
  $sql = "SELECT * FROM `member` where `email` = '$email';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);
  if($row){
    echo '[{"ok":"디비에 있는 메일"},{"sign":"'.$row.'"}]';
  }else{
    echo '[{"ok":"디비에 없는 메일"},{"sign":"'.$row.'"}]';
  }
}else if(isset($_GET["mode"]) && $_GET["mode"]=="pw_ajax") {
  $email=$_POST["email"];
  $password=$_POST["password"];
  $sql = "SELECT password FROM `member` where `email` = '$email';";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_num_rows($result);
  if($password == $row['password']){
    echo '[{"ok":"아이디와 비밀번호 일치"},{"sign":"'.$row.'"}]';
  }else{
    echo '[{"ok":"아이디와 비밀번호 불일치"},{"sign":"'.$row.'"}]';
  }
}else if(isset($_GET["mode"]) && $_GET["mode"]=="update"){
  $update_username = $_POST['username'];
  $update_email = $_POST['email'];
  $update_location = $_POST['location'];
  $update_profession = $_POST['profession'];
  $update_profession_other = $_POST['profession_other'];
  $update_use_mf = $_POST['use_mf'];

  include "../lib/file_upload.php";

  if(!$_FILES['profile_image_div_right_file']['error']==4 && !$_FILES['shop_img_file']['error']==4){
    if($update_profession!='other'){
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession', `use_mf`='$update_use_mf', `pro_img_named`='$upfile_name', `pro_img_copied`='$copied_file_name', `shop_img_named`='$shop_upfile_name', `shop_img_copied`='$shop_copied_file_name' where `no`=$member_no;";
    }else{
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession_other', `use_mf`='$update_use_mf', `pro_img_named`='$upfile_name', `pro_img_copied`='$copied_file_name', `shop_img_named`='$shop_upfile_name', `shop_img_copied`='$shop_copied_file_name' where `no`=$member_no;";
    }
  }else if(!$_FILES['shop_img_file']['error']==4 && $_FILES['profile_image_div_right_file']['error']==4){
    if($update_profession!='other'){
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession', `use_mf`='$update_use_mf', `shop_img_named`='$shop_upfile_name', `shop_img_copied`='$shop_copied_file_name' where `no`=$member_no;";
    }else{
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession_other', `use_mf`='$update_use_mf', `shop_img_named`='$shop_upfile_name', `shop_img_copied`='$shop_copied_file_name' where `no`=$member_no;";
    }
  }else if($_FILES['shop_img_file']['error']==4 && !$_FILES['profile_image_div_right_file']['error']==4){
    if($update_profession!='other'){
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession', `use_mf`='$update_use_mf', `pro_img_named`='$upfile_name', `pro_img_copied`='$copied_file_name' where `no`=$member_no;";
    }else{
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession_other', `use_mf`='$update_use_mf', `pro_img_named`='$upfile_name', `pro_img_copied`='$copied_file_name' where `no`=$member_no;";
    }
  }else if($_FILES['shop_img_file']['error']==4 && $_FILES['profile_image_div_right_file']['error']==4){
    if($update_profession!='other'){
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession', `use_mf`='$update_use_mf' where `no`=$member_no;";
    }else{
      $sql = "UPDATE `member` set `username`='$update_username', `location`='$update_location', `profession`='$update_profession_other', `use_mf`='$update_use_mf' where `no`=$member_no;";
    }
  }
  $result = mysqli_query($conn, $sql);

  echo "<script> alert('Update Setting Success!!');
          document.location.href='../member_profile/profile_edit.php?mode=profile_info';
        </script>";
}else if(isset($_GET["mode"]) && $_GET["mode"]=="update_password"){
  $update_password = $_POST['new_password'];
  $email = $_SESSION['email'];

  $sql = "UPDATE `member` set `password`='$update_password' where email='$email';";
  $result = mysqli_query($conn, $sql);

  echo "<script> alert('Change Password Success!!');
          document.location.href='../member_profile/profile_edit.php?mode=profile_info';
        </script>";

}else if(isset($_GET["mode"]) && $_GET["mode"]=="hwan_mon"){
  $update_hwan_mon = intval($_POST['hope_mon']);
  $update_point_mon = intval($_POST['present_mon']);
  $update_result = intval($update_point_mon) - intval($update_hwan_mon);
  $regist_day = date("Y-m-d (H:i)");

  $sql = "UPDATE `member` set `hwan_mon`=$update_hwan_mon, `point_mon`= point_mon - $update_hwan_mon where no=$member_no;";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: 111111' . mysqli_error($conn));
    exit;
  }

  $send_email = $_SESSION['email'];

  $sql = "INSERT into `message` (`num`,`send_email`,`rece_email`,`msg`,`regist_day`)VALUES(null,'$send_email', 'admin@gmail.com', '[환전 신청] $send_email 님께서 $update_hwan_mon Mon을 환전신청 하셨습니다.', '$regist_day');";
  $result = mysqli_query($conn, $sql);
  if (!$result) {
    die('Error: 222222' . mysqli_error($conn));
    exit;
  }

  echo "<script> alert('환전 신청 완료!!');
          document.location.href='../member_profile/profile_edit.php?mode=requests';
        </script>";
}
?>
