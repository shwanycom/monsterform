<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>
<meta charset="utf-8">
<?php
$content= $q_content = $sql= $result = $userid="";
$font_file_name=$copied_font_file_name=$font_type[0]="";
// $member_no = $_SESSION['no'];
// $member_email = $_SESSION['email'];
// $memeber_username = $_SESSION['username'];
// $member_mon = $_SESSION['mon'];
// $member_partner = $_SESSION['partner'];

if(isset($_GET["mode"])&&$_GET["mode"]=="insert"){
    $q_memeber_no = mysqli_real_escape_string($conn, $member_no);
    $q_memeber_username = mysqli_real_escape_string($conn, $member_username);
    $q_member_email = mysqli_real_escape_string($conn, $member_email);
    $subject = trim($_POST["subject"]);
    $content = trim($_POST["content"]);
    $regist_day=date("Y-m-d");
    $price = $_POST["setted_mon"]*100;
    $big_data=$_POST["big_data"];


    $hash_tag = $_POST["hash_tag"];

    $freegoods_agree = $_POST["freegoods_agree"];
    $file_type = $_POST["file_type"];

    // $is_html=(isset($_POST["is_html"]))?('y'):('n');

    //include 파일업로드기능
    include "./lib/shop_file_upload.php";
    var_export($q_memeber_no); echo "<br>";
    var_export($q_memeber_username); echo "<br>";
    var_export($q_member_email); echo "<br>";
    var_export($subject); echo "<br>";
    var_export($content); echo "<br>";
    var_export($regist_day); echo "<br>";
    var_export($price); echo "<br>";
    var_export($big_data); echo "<br>";
    var_export($hash_tag); echo "<br>";
    var_export($freegoods_agree); echo "<br>";
    var_export($file_type); echo "<br>";

    var_export("zip : ".$zip_file_name); echo "<br>";
    var_export($copied_zip_file_name); echo "<br>";
    var_export($type[0]); echo "<br>";

    var_export("img1 : ".$img_file_name[0]); echo "<br>";
    var_export($copied_img_file_name[0]); echo "<br>";
    var_export($img_type[0][0]); echo "<br>";
    var_export("img2 : ".$img_file_name[1]); echo "<br>";
    var_export($copied_img_file_name[1]); echo "<br>";
    var_export($img_type[1][0]); echo "<br>";
    var_export("img3 : ".$img_file_name[2]); echo "<br>";
    var_export($copied_img_file_name[2]); echo "<br>";
    var_export($img_type[2][0]); echo "<br>";
    var_export("img4 : ".$img_file_name[3]); echo "<br>";
    var_export($copied_img_file_name[3]); echo "<br>";
    var_export($img_type[3][0]); echo "<br>";
    var_export("font : ".$font_file_name); echo "<br>";
    var_export($copied_font_file_name); echo "<br>";
    var_export($font_type[0]); echo "<br>";



    //파일에 실제명과
    $sql="INSERT INTO `products` VALUES
 ($q_memeber_no,null,'$q_memeber_username','$q_member_email','$subject','$content','$regist_day',$price,'n','n',0,0,'$big_data','$big_data','$hash_tag','$img_file_name[0]','$img_file_name[1]','$img_file_name[2]','$img_file_name[3]',
 '$copied_img_file_name[0]','$copied_img_file_name[1]','$copied_img_file_name[2]','$copied_img_file_name[3]','$zip_file_name','$copied_zip_file_name','$type[0]','$font_file_name','$copied_font_file_name','$font_type[0]','$freegoods_agree','$file_type');";
  var_dump($sql);
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('5.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }

    //등록된사용자가 최근 입력한 이미지게시판을 보여주기 위하여 num를 찾아서 전달
    $sql="SELECT num from `products` where email ='$q_member_email' order by num desc limit 1;";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $num=$row['num'];


    mysqli_close($conn);
    echo "<script>location.href='./shop_view.php?num=$num';</script>";
}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
    $num = test_input($_GET["num"]);
    $q_num = mysqli_real_escape_string($conn, $num);
    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];

    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
    }

    $sql ="DELETE FROM `free` WHERE num=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    $sql ="DELETE FROM `free_ripple` WHERE parent=$q_num";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      die('Error: ' . mysqli_error($conn));
    }

    mysqli_close($conn);
    echo "<script>location.href='./list.php?page=1';</script>";

}else if(isset($_GET["mode"]) && $_GET["mode"] == "update"){
  $content = trim($_POST["content"]);
  $subject = trim($_POST["subject"]);
  if(empty($content)||empty($subject)){
    echo "<script>alert('내용이나제목입력요망!');history.go(-1);</script>";
    exit;
  }
  $subject = test_input($_POST["subject"]);
  $content = test_input($_POST["content"]);
  $num = test_input($_POST["num"]);
  $hit = test_input($_POST["hit"]);
  $userid = test_input($userid);
  $is_html=(isset($_POST["is_html"]))?('y'):('n');
  $q_subject = mysqli_real_escape_string($conn, $subject);
  $q_content = mysqli_real_escape_string($conn, $content);
  $q_userid = mysqli_real_escape_string($conn, $userid);
  $q_num = mysqli_real_escape_string($conn, $num);
  $regist_day=date("Y-m-d (H:i)");

  //파일 삭제만 체크
  if (isset($_POST['del_file'])&&$_POST['del_file'] =='1') {
    //삭제할 게시물의 이미지파일명을 가져와서 삭제한다.
    $sql="SELECT `file_copied_0` from `free` where num ='$q_num';";
    $result = mysqli_query($conn,$sql);
    if (!$result) {
      alert_back('6.Error: ' . mysqli_error($conn));
      //die('Error: ' . mysqli_error($conn));
    }
    $row=mysqli_fetch_array($result);
    $file_copied_0=$row['file_copied_0'];
    if(!empty($file_copied_0)){
      unlink("./data/".$file_copied_0);
  }


  $sql="UPDATE `free` SET `file_name_0`= '', `file_copied_0` = '',`file_type_0` = '' WHERE `num` = $q_num;";
  $result = mysqli_query($conn,$sql);
  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
}

    //내용 수정 하든 안하든 파일첨부하면 업데이트 한다.
    if (!empty($_FILES['upfile']['name'])) {
      //include 파일업로드기능
      include "./lib/file_upload.php";
      $sql="UPDATE `free` SET `file_name_0`= '$upfile_name', `file_copied_0` = '$copied_file_name', `file_type_0` = '$type[0]' WHERE `num` = $q_num;";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }
    }else{
      //파일과 상관없이 무조건 내용중심으로 업데이트 한다.
      $sql="UPDATE `free` SET `subject` = '$q_subject', `content` = '$q_content', `regist_day` = '$regist_day', `is_html`= '$is_html' WHERE `num` = $q_num;";
      $result = mysqli_query($conn,$sql);
      if (!$result) {
        die('Error: ' . mysqli_error($conn));
      }

    }
    echo "<script>location.href='./view.php?num=$num&page=1&hit=$hit';</script>";

}else if(isset($_GET["mode"])&&$_GET["mode"]=='insert_ripple'){
  if(empty($_POST["ripple_content"])){
    echo "<script> alert('내용을 입력하세요'); history.go(-1); </script>";
    exit;
  }
  //덧글을 다는 사람은 로그인을 해야한다 는 것을 말하는 것이다.
   $userid=$_SESSION['userid'];  //로그인 했는지 확인
   $q_userid = mysqli_real_escape_string($conn, $userid);
   $sql = "SELECT * from member where id = '$q_userid'";
   $result = mysqli_query($conn,$sql);
   if (!$result) {
     die('Error: ' . mysqli_error($conn));
   }
   $rowcount = mysqli_num_rows($result);
   if (!$rowcount) {
     echo "<script> alert('없는 아이디'); history.go(-1); </script>";
     exit;
   }else{
     $ripple_content = test_input($_POST["ripple_content"]);
     $parent = test_input($_POST["parent"]);
     $page = test_input($_POST["page"]);
     $hit = test_input($_POST["hit"]);
     $q_usernick = mysqli_real_escape_string($conn,$_SESSION['usernick']);
     $q_username = mysqli_real_escape_string($conn,$_SESSION['username']);
     $q_content = mysqli_real_escape_string($conn, $content);
     $q_parent = mysqli_real_escape_string($conn, $parent);
     $regist_day=date("Y-m-d(H:i)");


   $sql="INSERT INTO `free_ripple` VALUES(null,'$q_parent','$q_userid','$q_username','$q_usernick','$ripple_content','$regist_day')";
   $result = mysqli_query($conn,$sql);

   if (!$result) {
     die('Error: ' . mysqli_error($conn));
   }
   mysqli_close($conn);
   echo "<script> location.href='./view.php?num=$q_parent&page=$page&hit=$hit';</script>"; //script 이용 방법
   // Header("Location:../index.php"); Header 이용 방법
 }
}else if (isset($_GET["mode"])&&$_GET["mode"]=='delete_ripple'){
  $page=  test_input($_GET["page"]);
  $hit=  test_input($_GET["hit"]);
  $num = test_input($_POST["num"]);
  $parent = test_input($_POST["parent"]);
  $q_num = mysqli_real_escape_string($conn,$num);

  $sql="DELETE FROM `free_ripple` WHERE num=$q_num";
  $result = mysqli_query($conn,$sql);

  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";
}else if (isset($_GET["mode"])&&$_GET["mode"]=='delete_ripple'){
  $page=  test_input($_GET["page"]);
  $hit=  test_input($_GET["hit"]);
  $num = test_input($_POST["num"]);
  $parent = test_input($_POST["parent"]);
  $q_num = mysqli_real_escape_string($conn,$num);

  $sql="DELETE FROM `free_ripple` WHERE num=$q_num";
  $result = mysqli_query($conn,$sql);

  if (!$result) {
    die('Error: ' . mysqli_error($conn));
  }
  mysqli_close($conn);
  echo "<script> location.href='./view.php?num=$parent&page=$page&hit=$hit';</script>";
}

?>
