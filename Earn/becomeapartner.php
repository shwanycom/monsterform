<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";

  if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
  }else{
    $email=null;
  }

  $now = date("Y-m-d(H:i)");
  $sql="select partner_apply, partner from member where email='$email';";
  $result = mysqli_query($conn, $sql);
  $row=mysqli_fetch_array($result);
  $partner_apply=$row['partner_apply'];
  $partner=$row['partner'];

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/common.css?ver=1">
    <link rel="stylesheet" href="../css/becomeapartner.css">
    <link rel="stylesheet" href="../css/footer.css">
    <style media="screen">

    </style>
    <script type="text/javascript">
    function confirm_check(){
      var result=confirm("파트너를 신청하시겠습니까?");
      if(result){
        <?php
        if($partner=='n'){
          if($partner_apply=='n'){
            // 파트너 신청시 partner_apply=n인 아이디는 y로 수정
            $sql="update member set partner_apply='y' where email='$email'";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            //파트너 신청시  관리자에게 메시지 보내기
            $sql="insert into message (rece_email,send_email,msg,regist_day) values('admin@gmail.com','$email','[파트너 신청] $email 님께서 파트너를 신청하셨습니다.','$now');";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
          ?>
            alert("파트너 신청이 완료 되었습니다.");
            <?php
          }else{
            ?>
            alert("검토 중인 아이디 입니다.");
          <?php
          }
        }else{
        ?>
          alert("파트너 회원 입니다.");
        <?php
        }
        ?>
      }else{
          alert("파트너 신청이 취소 되었습니다.");
      }
    }
    </script>
  </head>
  <body>
    <?php include "../lib/header_in_folder.php"; ?>
    <div id="become_section">
      <div id="become_section1">
        <img src="../img/become_section1.png" alt="">
        <p id="apply_text">  Apply to become an affilate partner</p>
        <p>Reduce to 10%p every purchase for an entire tear from all new customers you refer.</p>
        <a href=""> <button type="button" name="button" onclick="confirm_check()">Become a Partner</button></a>
      </div>

      <div id="become_section2">
        <p id="section2_p">Spread The Word and Earn</p>
        <p>Earn 10% on all referred Monster Form customer purchases for a full year.</p>
      </div>

      <div id="become_section3">
        <p id="section3_p">Referrals Last Up to an Entire Year</p>
        <p>Earn money time a customer or subscriber you've refferred makes a purchase in their first year.</p>

      </div>

      <div id="become_section4">
        <p id="section4_p">Build Your Empire</p>
        <p>Each new customer you refer grows your partner empire, so you can earn money while you sleep, just for <b>telling about Monster Form</b> </p>
      </div>

      <div id="become_section5">
        <p id="section5_p">Support the Creators</p>
        <p>Promoting products on Monster Form enables independent designers and creators around the world to <b>spend more time doing what they love.</b></p>
      </div>

      <div id="become_section6">
         <p>Apply today and start spreading the word.</p>
        <button type="button" name="button" onclick="confirm_check()">Become a Partner</button>
      </div>
    </div>

    <?php include "../lib/footer_in_folder.php"; ?>
    <?php

    include "../khy_modal/login_modal_in_folder.php";
    if(!isset($_SESSION['no'])) {
      ?>
      <script>
        auto_modal();
      </script>
      <?php
    } ?>
  </body>
</html>
