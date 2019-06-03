<?php
// switch($_FILES['zip_file']['error']) {
//   case 1: echo 'File exceeded upload_max_filesize'; //업로드한 파일 사이즈가 php.ini에 설정한 값보다 클때
//    break;
//   case 2: echo 'File exceeded max_file_size'; //업로드한 파일 사이즈가 html에서 명시한 MAX_FILE_SIZE보다 클때
//    break;
//   case 3: echo 'File only partially uploaded'; //부분 업로드만 되었을  때
//    break;
//   case 4: echo 'Cannot upload file: No temp directory specified'; //파일이 업로드 되지 않았을 때
//    break;
//   case 6: echo 'Cannot upload file: No temp directory specified'; //php.ini에 임시 디렉터리가 지정되지 않았다(php 5.0.3부터 도입)
//    break;
//   case 7: echo 'Upload failed: Cannot write to disk';
//    break;
//  }

//=================================zip_file========================================
//1. $_FILES['upfile']로부터 5가지 배열명을 가져와서 저장한다.
$zip_file = $_FILES['zip_file'];//한개파일업로드정보(5가지정보가배열로들어있음)
$zip_file_name=$_FILES['zip_file']['name'];//f03.jpg
$zip_file_type=$_FILES['zip_file']['type'];
$zip_file_tmp_name=$_FILES['zip_file']['tmp_name'];
$zip_file_error=$_FILES['zip_file']['error'];
$zip_file_size=$_FILES['zip_file']['size'];

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
  $copied_zip_file_name = $new_zip_file_name.".".$zip_file_extension;
  $uploaded_zip_file=$zip_dir.$copied_zip_file_name;
  // $new_file_name="2019_04_22_15_09_30";
  // $copied_file_name = "2019_04_22_15_09_30_0.zip;
  // $uploaded_file= "./data/2019_04_22_15_09_30_0.zip";
}

//6. 업로드된 파일확장자를 체크한다.
$type = explode("/", $zip_file_type);
// application/x-rar-compressed, application/octet-stream
// application/zip, application/octet-stream

if ($type[0]=='application'){
  if($zip_file_size>1000000000){
    alert_back('2.zip파일사이즈가 10MB이상입니다.');
  }
}else {
  // var_dump($type[0]); exit;
  alert_back('zip파일이 아닙니다');
}

//7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동시킨다.
if(!move_uploaded_file($zip_file_tmp_name, $uploaded_zip_file)){
  alert_back('4.서버 전송에러 zip');
}
//=================================img_file========================================
$img_files=$_FILES["img_file"];
$count=count($img_files['name']);
$img_dir='../data/img/';

for($i=0; $i<$count; $i++){
  $img_file_name[$i]=$img_files['name'][$i];  //f03.jpg
  $img_file_type[$i]=$img_files['type'][$i];
  $img_file_tmp_name[$i]=$img_files['tmp_name'][$i];
  $img_file_error[$i]=$img_files['error'][$i];
  $img_file_size[$i]=$img_files['size'][$i];

  //2. 파일명과 확장자를 구분해서 저장한다.
  $file_img[$i] = explode(".",$img_file_name[$i]);//파일명과 확장자를 구분해서 배열로저장
  $img_file_name[$i] = $file_img[$i][0];            //파일명
  $img_file_extension[$i] = $file_img[$i][1];       //확장자

  //3. 업로드될 폴더를 지정한다.
  $img_dir='../data/img/'; //업로드된파일을 저장하는장소지정

  //4. 파일업로드가 성공되었는지 점검한다. 성공:0 실패:1
  //파일명이 중복되지 않도록 임의의 파일명을 정한다.
  if(!$img_file_error[$i]){
    $new_img_file_name[$i]=date("Y_m_d_H_i_s")."_".$i;
    $copied_img_file_name[$i] = $new_img_file_name[$i].".".$img_file_extension[$i];
    $uploaded_img_file[$i] = $img_dir.$copied_img_file_name[$i];
    // $new_file_name="2019_04_22_15_09_30";
    // $copied_file_name = "2019_04_22_15_09_30_0.zip;
    // $uploaded_file= "./data/2019_04_22_15_09_30_0.zip";
  }

  //6. 업로드된 파일확장자를 체크한다.
  $img_type[$i] = explode("/", $img_file_type[$i]);
  // application/x-rar-compressed, application/octet-stream
  // application/zip, application/octet-stream
  if ($img_type[$i][0]=='image'){
    if($img_file_size[$i]>1000000000){
      alert_back('2.이미지 파일사이즈가 10MB이상입니다.');
    }
  }else {
    // var_dump($img_type[$i][0]);
    exit;
    alert_back('이미지파일이 아닙니다!');
  }

  //7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동시킨다.
  if(!move_uploaded_file($img_file_tmp_name[$i], $uploaded_img_file[$i])){
    alert_back('4.서버 전송에러 img');
  }
}//end of for

//=================================font_file========================================
if($big_data=="Fonts"){
  //1. $_FILES['upfile']로부터 5가지 배열명을 가져와서 저장한다.
  $font_file = $_FILES['font_file'];//한개파일업로드정보(5가지정보가배열로들어있음)
  $font_file_name=$_FILES['font_file']['name'];//f03.jpg
  $font_file_type=$_FILES['font_file']['type'];
  $font_file_tmp_name=$_FILES['font_file']['tmp_name'];
  $font_file_error=$_FILES['font_file']['error'];
  $font_file_size=$_FILES['font_file']['size'];

  //2. 파일명과 확장자를 구분해서 저장한다.
  $file_font = explode(".",$font_file_name);//파일명과 확장자를 구분해서 배열로저장
  $font_file_name = $file_font[0];            //파일명
  $font_file_extension = $file_font[1];       //확장자

  //3. 업로드될 폴더를 지정한다.
  $font_dir='../data/font/'; //업로드된파일을 저장하는장소지정

  //4. 파일업로드가 성공되었는지 점검한다. 성공:0 실패:1
  //파일명이 중복되지 않도록 임의의 파일명을 정한다.
  if(!$font_file_error){
    $new_font_file_name=date("Y_m_d_H_i_s");
    $copied_font_file_name = $new_font_file_name.".".$font_file_extension;
    $uploaded_font_file=$font_dir.$copied_font_file_name;
    // $new_file_name="2019_04_22_15_09_30";
    // $copied_file_name = "2019_04_22_15_09_30_0.zip;
    // $uploaded_file= "./data/2019_04_22_15_09_30_0.zip";
  }

  //6. 업로드된 파일확장자를 체크한다.
  $font_type = explode("/", $font_file_type);
  if ($font_type[0]=='application'){
    if(!($font_type[1]=="x-font-ttf"||$font_type[1]=="octet-stream")){
      alert_back('폰트 파일이 아닙니다! TTF or OTF');
    }
  }else{
    alert_back('폰트 파일이 아닙니다');
  }

  //7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동시킨다.
  if(!move_uploaded_file($font_file_tmp_name, $uploaded_font_file)){
    alert_back('4.서버 전송에러 font');
  }
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
