<!DOCTYPE html>
<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>

<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/company_about.css">
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/footer.css">


  </head>
  <body>
    <?php include "../lib/header_in_folder.php";  ?>
    <div id="about">
      <div>
        <h1>We're changing the<br>way people create</h1>
        <div id="about_detail">
          <p id="about_p_margin_bottom">Monster Form empowers creators around the world to make their ideas a reality. Everything we do is to help them turn passion into opportunity.</p>
        </div>
      </div>
    </div>
    <div id="leadership-section">
      <h1>Meet our leadership team</h1>
        <ul>
          <li>
            <div class="flip-box">
              <div class="flip-box-inner">
                <div class="flip-box-front">
                  <img src="../img/zo.png">
                </div>
                <div class="flip-box-back">
                  <p style="font-size:15pt; font-weight:bold">조건희</p>
                    <br>
                    zogunhee@naver.com
                </div>
                </div>
              </div>
          </li>
          <li>
            <div class="flip-box">
              <div class="flip-box-inner">
                <div class="flip-box-front">
                <img src="../img/kim.png">
                </div>
                <div class="flip-box-back">
                <p style="font-size:15pt; font-weight:bold">김하영</p>
                <br>
                  likeny@naver.com
                  <br>
                </div>
                </div>
              </div>
          </li>
          <li>
            <div class="flip-box">
              <div class="flip-box-inner">
                <div class="flip-box-front">
                  <img src="../img/lee.png">
                </div>
                <div class="flip-box-back">
                  <p style="font-size:15pt; font-weight:bold">이동현</p>
                    <br>
                    merong2969@gmail.com
                </div>
                </div>
              </div>
          </li>
          <li>
            <div class="flip-box">
              <div class="flip-box-inner">
                <div class="flip-box-front">
                  <img src="../img/jung.png">
                </div>
                <div class="flip-box-back">
                  <p style="font-size:15pt; font-weight:bold">정승환</p>
                  <br>
                    shwanycom@gmail.com
                    <br>
                </div>
                </div>
              </div>
          </li>
          <li>
            <div class="flip-box">
              <div class="flip-box-inner">
                <div class="flip-box-front">
                  <img src="../img/huh.png">
                </div>
                <div class="flip-box-back">
                  <p>허정준</p>
                    <br>
                    huhjungjun@gmail.com
                </div>
                </div>
              </div>
          </li>
        </ul>
      </div>
      <div class="" style="text-align:center; margin-top:50px;">

      <h1>Company Location</h1>
      <div id="map" style="width:500px;height:400px; margin: 0 auto; margin-bottom:30px;"></div>
      <!--카카오 지도 api-->
        <script type="text/javascript" src="//dapi.kakao.com/v2/maps/sdk.js?appkey=4f11de79bc968943ee6954324e432e0b"></script>
        <script>
        //div id=map 부분에 지도를 표시
          var container = document.getElementById('map');

          var options = {
            center: new daum.maps.LatLng(37.5623607,127.03486), //지도에 보일 좌표
            level: 4 //줌기능
          };
          //화면에 해당 위치 생성
           map = new daum.maps.Map(container, options);


          var markerPosition  = new daum.maps.LatLng(37.5622700, 127.035176); //표시될 위치

          // 마커 생성
          var marker = new daum.maps.Marker({
              position: markerPosition
          });

          // 마커가 지도 위에 표시되도록 설정합니다
          marker.setMap(map);
        </script>
      </div>
    </div>
    <?php
    include "../lib/footer_in_folder.php";
    include "../khy_modal/login_modal_in_folder.php";
    ?>
  </body>
</html>
