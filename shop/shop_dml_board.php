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
    $price = $_POST["setted_mon"];
    $big_data=$_POST["big_data"];
    $small_data=$_POST["small_data"];
    $hash_tag = $_POST["hash_tag"];
    if(isset($_POST["freegoods_agree"])){
      $freegoods_agree = $_POST["freegoods_agree"];
    }else{
      $freegoods_agree = 'n';
    }
    $file_type = $_POST["file_type"];

    // $is_html=(isset($_POST["is_html"]))?('y'):('n');

    //include 파일업로드기능
    include "./lib/shop_file_upload.php";
    // var_export($q_memeber_no); echo "<br>";
    // var_export($q_memeber_username); echo "<br>";
    // var_export($q_member_email); echo "<br>";
    // var_export($subject); echo "<br>";
    // var_export($content); echo "<br>";
    // var_export($regist_day); echo "<br>";
    // var_export($price); echo "<br>";
    // var_export($big_data); echo "<br>";
    // var_export($small_data); echo "<br>";
    // var_export($hash_tag); echo "<br>";
    // var_export($freegoods_agree); echo "<br>";
    // var_export($file_type); echo "<br>";
    //
    // var_export("zip : ".$zip_file_name); echo "<br>";
    // var_export($copied_zip_file_name); echo "<br>";
    // var_export($type[0]); echo "<br>";
    //
    // var_export("img1 : ".$img_file_name[0]); echo "<br>";
    // var_export($copied_img_file_name[0]); echo "<br>";
    // var_export($img_type[0][0]); echo "<br>";
    // var_export("img2 : ".$img_file_name[1]); echo "<br>";
    // var_export($copied_img_file_name[1]); echo "<br>";
    // var_export($img_type[1][0]); echo "<br>";
    // var_export("img3 : ".$img_file_name[2]); echo "<br>";
    // var_export($copied_img_file_name[2]); echo "<br>";
    // var_export($img_type[2][0]); echo "<br>";
    // var_export("img4 : ".$img_file_name[3]); echo "<br>";
    // var_export($copied_img_file_name[3]); echo "<br>";
    // var_export($img_type[3][0]); echo "<br>";
    // var_export("font : ".$font_file_name); echo "<br>";
    // var_export($copied_font_file_name); echo "<br>";
    // var_export($font_type[0]); echo "<br>";

$sql="INSERT INTO `products` VALUES
($q_memeber_no,null,'$q_memeber_username','$q_member_email','$subject','$content','$regist_day',$price,'n','n',0,0,'$big_data','$small_data','$hash_tag','$img_file_name[0]','$img_file_name[1]','$img_file_name[2]','$img_file_name[3]',
'$copied_img_file_name[0]','$copied_img_file_name[1]','$copied_img_file_name[2]','$copied_img_file_name[3]','$zip_file_name','$copied_zip_file_name','$type[0]','$font_file_name','$copied_font_file_name','$font_type[0]','$freegoods_agree','$file_type');";
    //var_dump($sql);
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

    //등록된사용자가 최근 입력한 이미지게시판을 보여주기 위하여 num를 찾아서 전달
    $sql="SELECT num from `products` where email ='$q_member_email' order by num desc limit 1;";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    $row=mysqli_fetch_array($result);
    $num=$row['num'];

    mysqli_close($conn);
    echo '<script>location.href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'";</script>';
}else if(isset($_GET["mode"])&&$_GET["mode"]=="delete"){
  if(!empty($_GET["num"])){
    $num = mysqli_real_escape_string($conn, $_GET["num"]);
    $sql="SELECT * from `products` where `num`='$num' && `no`='$member_no';";
    $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    $row = mysqli_fetch_array($result);
    if($row){
      $num = $row['num'];
      $img_file_copied1 = $row['img_file_copied1'];
      $img_file_copied2 = $row['img_file_copied2'];
      $img_file_copied3 = $row['img_file_copied3'];
      $img_file_copied4 = $row['img_file_copied4'];
      $zip_file_copied = $row['zip_file_copied'];
      $ttf_file_copied = $row['ttf_file_copied'];

      $sql ="DELETE FROM `products` WHERE num='$num'";
      $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));

      if(!empty($zip_file_copied)) { unlink("../data/zip".$zip_file_copied); }
      else if (!empty($img_file_copied1)) { unlink("../data/img".$img_file_copied1); }
      else if (!empty($img_file_copied2)) { unlink("../data/img".$img_file_copied2); }
      else if (!empty($img_file_copied3)) { unlink("../data/img".$img_file_copied3); }
      else if (!empty($img_file_copied4)) { unlink("../data/img".$img_file_copied4); }
      else if (!empty($ttf_file_copied)) { unlink("../data/font".$ttf_file_copied); }

      $sql ="DELETE FROM `cart` WHERE num='$num'";
      $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
      $sql ="DELETE FROM `likes` WHERE `product_num`='$num'";
      $result = mysqli_query($conn,$sql) or die('Error: ' . mysqli_error($conn));
    }
    mysqli_close($conn);
    echo '<script>
          location.href="../member_profile/profile_view.php?mode=shop&email='.$member_email.'";
          </script>';
  }
}
?>
