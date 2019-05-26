<?php
$zip_file=$_FILES["zip_file"];

$img_files=$_FILES["img_file"];
$count=count($img_files["name"]);

$font_file=$_FILES["font_file"];


$img_dir='../data/img/';
$font_dir='../data/font/';

//1. $_FILES['upfile']로부터 5가지 배열명을 가져와서 저장한다.
$zip_file = $_FILES['zip_file'];//한개파일업로드정보(5가지정보가배열로들어있음)
$zip_file_name=$_FILES['zip_file']['name'];//f03.jpg
$zip_file_type=$_FILES['zip_file']['type'];
$zip_file_tmp_name=$_FILES['zip_file']['tmp_name'];
$zip_file_error=$_FILES['zip_file']['error'];
$zip_file_size=$_FILES['zip_file']['size'];
var_dump($_FILES['zip_file']); echo "<br>";
var_dump($zip_file_error); echo "<br>";
switch($_FILES['zip_file']['error']) {
  case 1: echo 'File exceeded upload_max_filesize'; //업로드한 파일 사이즈가 php.ini에 설정한 값보다 클때
   break;
  case 2: echo 'File exceeded max_file_size'; //업로드한 파일 사이즈가 html에서 명시한 MAX_FILE_SIZE보다 클때
   break;
  case 3: echo 'File only partially uploaded'; //부분 업로드만 되었을  때
   break;
  case 4: echo 'Cannot upload file: No temp directory specified'; //파일이 업로드 되지 않았을 때
   break;
  case 6: echo 'Cannot upload file: No temp directory specified'; //php.ini에 임시 디렉터리가 지정되지 않았다(php 5.0.3부터 도입)
   break;
  case 7: echo 'Upload failed: Cannot write to disk';
   break;
 }


//2. 파일명과 확장자를 구분해서 저장한다.
$file_zip = explode(".",$zip_file_name);//파일명과 확장자를 구분해서 배열로저장
$zip_file_name = $file_zip[0];            //파일명
$zip_file_extension = $file_zip[1];       //확장자

//3. 업로드될 폴더를 지정한다.
$zip_dir='../data/zip/'; //업로드된파일을 저장하는장소지정

//4. 파일업로드가 성공되었는지 점검한다. 성공:0 실패:1
//파일명이 중복되지 않도록 임의의 파일명을 정한다.
if(!$zip_file_error){
  $new_zip_file_name=date("Y_m_d_H_i_s");
  $copied_zip_file_name = $new_zip_file_name.".".$file_extension;
  $uploaded_zip_file=$zip_dir.$copied_file_name;
  // $new_file_name="2019_04_22_15_09_30";
  // $copied_file_name = "2019_04_22_15_09_30_0.zip;
  // $uploaded_file= "./data/2019_04_22_15_09_30_0.zip";
}

//6. 업로드된 파일확장자를 체크한다.
$type = explode("/", $zip_file_type);

if (($type[0]=='zip')) {
  if($zip_file_size>5000000){
    alert_back('2.zip파일사이즈가 5MB이상입니다.');
  }
}else {
  echo "<script> alert('type:'+'$type');</script>";
  var_dump($zip_file_type);
  var_dump($type);
  var_export($type);
  exit;
  //alert_back('zip 파일이 아닙니다');
}

//7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동시킨다.
if(!move_uploaded_file($zip_file_tmp_name, $uploaded_zip_file)){
  //alert_back('4.서버 전송에러');
}

// for($i=0; $i<$count; $i++){
//   $upfile_name[$i]=$files["name"][$i];
//   $upfile_tmp_name[$i]=$files["tmp_name"][$i];
//   $upfile_type[$i]=$files["type"][$i];
//   $upfile_size[$i]=$files["size"][$i];
//   $upfile_error[$i]=$files["error"][$i];
//   $file=explode(".", $upfile_name[$i]);
//   $file_name=$file[0];
//   $file_ext=$file[1];
//
//   if(!$upfile_error[$i]) {
//     $new_file_name=date("Y_m_d_H_i_s");
//     $new_file_name=$new_file_name."_".$i;
//     $copied_file_name[$i]=$new_file_name.".".$file_ext;
//     $uploaded_file[$i]=$upload_dir.$copied_file_name[$i];
//
//     if($upfile_size[$i]>500000) {
//      echo("
//        <script>
//          alert('업로드 파일 크기가 지정된 용량(500KB)을 초과합니다!<br>파일 크기를 체크해주세요! ');
//          history.go(-1)
//        </script>
//        ");
//      exit;
//    }
//
//    if(($upfile_type[$i]!="image/gif") && ($upfile_type[$i]!="image/jpeg")
//           && ($upfile_type[$i]!="image/pjpeg")) {
//       echo("
//        <script>
//          alert('JPG와 GIF 이미지 파일만 업로드 가능합니다!');
//          history.go(-1)
//        </script>
//       ");
//       exit;
//    }
//    if(!move_uploaded_file($upfile_tmp_name[$i], $uploaded_file[$i])) {
//      echo("
//        <script>
//          alert('파일을 지정한 디렉토리에 복사하는데 실패했습니다.');
//          history.go(-1)
//        </script>
//      ");
//      exit;
//    }
//  }
// }  // for문 종료(32행)

 ?>
