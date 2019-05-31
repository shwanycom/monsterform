<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>

  <link rel="stylesheet" href="../css/common.css?ver=1">
  <link rel="stylesheet" href="../css/footer.css">
  <link rel="stylesheet" href="../css/brand.css">
  <body>
    <?php include "../lib/header_in_folder.php";  ?>
    <div id="company_brand_logo">
      <div id="company_brand_title">
        <br>
        Logo & Branding Guidelines
      </div>
      <div id="details">

        Thanks for your interest in using the Creative Market logo and / or icon. These guidelines will help you use our identity. Please review the correct and incorrect usage examples below.
        <br><b>Need help?</b> If you have questions or concerns about using the Monster Form brand, or need file support, contact us.<br><br>
      </div>
      <div id="download">
        <br>
        <span id="company_brand_download_span">Logo</span>
        <div id="img_plate">
          <img id="download_img" src="../img/logo.png" alt="">
        </div>
      </div>
      <div id="color">
        <br>
        <span id="company_brand_download_span">Colors</span>
        <br><br>
        <div id="color_child">
          <p id="monstergreen"> </p>
          <p id="monstergreen">Monster Green</p>
          <p id="monstergreen"> </p>
          <p id="darkgray"> </p>
          <p id="darkgray">Dark Gray</p>
          <p id="darkgray"> </p>
          <p id="lightgray"> </p>
          <p id="lightgray">Light Gray</p>
          <p id="lightgray"> </p>
          <p id="livingcoral"> </p>
          <p id="livingcoral">Living Coral</p>
          <p id="livingcoral"> </p>
        </div>
      </div>
      <div id="font">
        <br>
        Fonts
        <div id="font_child">

          <p id="ninab">UniNeue-HeavyItalic</p>
          <p id="nina">UniNeue-Light</p>

        </div>
      </div>
    </div>
    <?php include "../lib/footer_in_folder.php"; ?>
    <?php include "../khy_modal/login_modal_in_folder.php"; ?>
  </body>
</html>
