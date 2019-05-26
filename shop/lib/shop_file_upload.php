<?php

//1. $_FILES['upfile']로부터 5가지 배열명을 가져와서 저장한다.
$upfile = $_FILES['upfile'];//한개파일업로드정보(5가지정보가배열로들어있음)
$upfile_name=$_FILES['upfile']['name'];//f03.jpg
$upfile_type=$_FILES['upfile']['type'];
$upfile_tmp_name=$_FILES['upfile']['tmp_name'];
$upfile_error=$_FILES['upfile']['error'];
$upfile_size=$_FILES['upfile']['size'];
//var_dump($_FILES['upfile']);

//2. 파일명과 확장자를 구분해서 저장한다.
$file = explode(".",$upfile_name);//파일명과 확장자를 구분해서 배열로저장
$file_name = $file[0];            //파일명
$file_extension = $file[1];       //확장자

//3. 업로드될 폴더를 지정한다.
$upload_dir = "./data/"; //업로드된파일을 저장하는장소지정

//4. 파일업로드가 성공되었는지 점검한다. 성공:0 실패:1
//파일명이 중복되지 않도록 임의의 파일명을 정한다.
if(!$upfile_error){
  $new_file_name=date("Y_m_d_H_i_s");
  $new_file_name = $new_file_name."_"."0";
  $copied_file_name = $new_file_name.".".$file_extension;
  $uploaded_file=$upload_dir.$copied_file_name;
  // $new_file_name="2019_04_22_15_09_30";
  // $new_file_name = "2019_04_22_15_09_30_0";
  // $copied_file_name = "2019_04_22_15_09_30_0.jpg;
  // $uploaded_file= "./data/2019_04_22_15_09_30_0.jpg";
}


//6. 업로드된 파일확장자를 체크한다.
$type = explode("/", $upfile_type);
if ($type[0]=='image') {
  switch ($type[1]) {
    case 'gif': case 'jpg': case 'png': case 'jpeg':
      case 'pjpeg': break;
      default: alert_back('3.gif, jpg, png, jpeg, pjpeg 확장자가 아닙니다.');
    }
    //5. 업로드된 파일사이즈(2mb)를 체크해서 넘어버리면 돌려보낸다.
    if($upfile_size>2000000){
      alert_back('2.이미지파일사이즈가 2MB이상입니다.');
    }
}else {
  //5. 업로드된 파일사이즈(500kb)를 체크해서 넘어버리면 돌려보낸다.
  if($upfile_size>500000){
    alert_back('2.파일사이즈가 500KB이상입니다.');
  }
}

//7. 임시저장소에 있는 파일을 서버에 지정한 위치로 이동시킨다.
if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
  alert_back('4.서버 전송에러');
}

 ?>
