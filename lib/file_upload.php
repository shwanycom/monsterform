<?php

if(!$_FILES['profile_image_div_right_file']['error']==4){
  //1 업로드 파일의 5가지 정보를 갖고 와서 저장
  $upfile = $_FILES['profile_image_div_right_file'];
  $upfile_name = $_FILES['profile_image_div_right_file']['name'];
  $upfile_type = $_FILES['profile_image_div_right_file']['type'];
  $upfile_tmp_name = $_FILES['profile_image_div_right_file']['tmp_name'];
  $upfile_error = $_FILES['profile_image_div_right_file']['error'];
  $upfile_size = $_FILES['profile_image_div_right_file']['size'];
  //2
  $file = explode(".", $upfile_name); // 파일명과 확장자를 구분
  $file_name = $file[0];              // 파일명
  $file_extension = $file[1];         // 확장자
  //3
  $upload_dir = "../data/img/"; // 업로드된 파일을 저장하는 장소 지정

  //4. 파일 업로드가 성공되었는지 점검
  //파일명이 중복되지 않도록 임의의 파일명 정의
  if(!$upfile_error){
    $new_file_name = date("Y_m_d_H_i_s"); //"2019_04_22_15_09_30"
    $new_file_name = $new_file_name."_"."0"; //"2019_04_22_15_09_30_0"
    $copied_file_name = $new_file_name.".".$file_extension; //"2019_04_22_15_09_30_0.jpg"
    $uploaded_file=$upload_dir.$copied_file_name; // "./data/2019_04_22_15_09_30_0.jpg"
  }
  //5. 업로드된 파일사이즈를(500KB) 체크해서 넘어버리면 돌려보낸다.
  if($upfile_size>5000000){
    alert_back('파일사이즈는 5MB를 초과할 수 없습니다.!');
  }
  //6. 업로드된 파일 확장자를 체크한다.  "image/jpg"
  $type = explode("/",$upfile_type);
  $file_type = $type[0];
  // var_dump($type[0]);
  // var_dump($type[1]);
  // exit;
  // switch ($type[1]) {
  //   case 'gif':
  //   break;
  //   case 'jpg':
  //   break;
  //   case 'png':
  //   break;
  //   case 'jpeg':
  //   break;
  //   default:
  //     alert_back('gif, jpg, png, jpeg 확장자만 가능합니다!');
  //     break;
  // }
  //7. 임시 저장소에 있는 파일을 서버에 지정한 위치로 이동한다.
  if(!move_uploaded_file($upfile_tmp_name, $uploaded_file)){
    echo '<script>alert("11111111"); exit;</script>';
    // alert_back('서버 전송 에러!');
  }
}

if(!$_FILES['shop_img_file']['error']==4){
  $shop_upfile = $_FILES['shop_img_file'];
  $shop_upfile_name = $_FILES['shop_img_file']['name'];
  $shop_upfile_type = $_FILES['shop_img_file']['type'];
  $shop_upfile_tmp_name = $_FILES['shop_img_file']['tmp_name'];
  $shop_upfile_error = $_FILES['shop_img_file']['error'];
  $shop_upfile_size = $_FILES['shop_img_file']['size'];
  //2
  $shop_file = explode(".", $shop_upfile_name); // 파일명과 확장자를 구분
  $shop_file_name = $shop_file[0];              // 파일명
  $shop_file_extension = $shop_file[1];         // 확장자
  //3
  $shop_upload_dir = "../data/img/"; // 업로드된 파일을 저장하는 장소 지정

  //4. 파일 업로드가 성공되었는지 점검
  //파일명이 중복되지 않도록 임의의 파일명 정의
  if(!$shop_upfile_error){
    $shop_new_file_name = date("Y_m_d_H_i_s"); //"2019_04_22_15_09_30"
    $shop_new_file_name = $shop_new_file_name."_"."2"; //"2019_04_22_15_09_30_0"
    $shop_copied_file_name = $shop_new_file_name.".".$shop_file_extension; //"2019_04_22_15_09_30_0.jpg"
    $shop_uploaded_file=$shop_upload_dir.$shop_copied_file_name; // "./data/2019_04_22_15_09_30_0.jpg"
  }
  //5. 업로드된 파일사이즈를(500KB) 체크해서 넘어버리면 돌려보낸다.
  if($shop_upfile_size>5000000){
    alert_back('파일사이즈는 5MB를 초과할 수 없습니다.!');
  }
  //6. 업로드된 파일 확장자를 체크한다.  "image/jpg"
  $shop_type = explode("/",$shop_upfile_type);
  $shop_file_type = $shop_type[0];
  // var_dump($type[0]);
  // var_dump($type[1]);
  // exit;
  // switch ($shop_type[1]) {
  //   case 'gif':
  //   break;
  //   case 'jpg':
  //   break;
  //   case 'png':
  //   break;
  //   case 'jpeg':
  //   break;
  //   default:
  //     alert_back('gif, jpg, png, jpeg 확장자만 가능합니다!');
  //     break;
  // }
  //7. 임시 저장소에 있는 파일을 서버에 지정한 위치로 이동한다.
  if(!move_uploaded_file($shop_upfile_tmp_name, $shop_uploaded_file)){
    echo '<script>alert("22222222"); exit;</script>';
    // alert_back('서버 전송 에러!');
  }
}

 ?>
