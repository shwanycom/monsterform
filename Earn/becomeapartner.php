<?php
  include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
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
  </head>
  <body>
    <?php include "../lib/header_in_folder.php"; ?>
    <div id="become_section">
      <div id="become_section1">
        <img src="../img/become_section1.png" alt="">
        <p id="apply_text">  Apply to become an affilate partner</p>
        <p>Earn up to 10% every purchase for an entire tear from all new customers you refer.</p>
        <button type="button" name="button">Become a Partner</button>
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
        <button type="button" name="button">Become a Partner</button>
      </div>
    </div>

    <?php include "../lib/footer_in_folder.php"; ?>
    <?php include "../khy_modal/login_modal_in_folder.php"; ?>
  </body>
</html>
