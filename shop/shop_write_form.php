<?php

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/create_table.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

// include "./lib/footer.php";
// include "./khy_modal/khy_modal_modaltest.php";
if(empty($username)){
  echo '<script>
  alert("로그인 후 이용하세요."); history.go(-1); </script>';
  exit;
}

create_table($conn, "products"); //가입인사 게시판 테이블 생성
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/discussion.css">
    <link rel="stylesheet" href="../css/footer.css">
    <script type="text/javascript" src="../js/monsterform.js"></script>
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script type="text/javascript">
      var value="";
      function select(value){
      var text = ""+value;
      document.getElementById("header_logout_form_div2_3_span").innerHTML = text;
      }
      function mouse_over(){
        document.getElementById('change_img').src="../img/up.png";
      }
      function mouse_out(){
        document.getElementById('change_img').src="../img/down.png";
      }
      </script>
    <title></title>
  </head>
  <body onload="big_data_check()">
    <?php
    include "../lib/header_in_folder.php";
     ?>
    <!--============================================================================== -->
    <div id="shop_write_div">
      <form class="" action="shop_dml.php?mode=" method="post">
        <table>
          <tr>
            <td>
              <select class="" name="big_data" id="big_data">
                <option value="none">Category</option>
                <option value="photos">Photos</option>
                <option value="graphics">Graphics</option>
                <option value="fonts">Fonts</option>
              </select>
            </td>
            <td id="small_data_td">
              <select class="" name="small_data" id="small_data">
                <option value="none">kind</option>
              </select>
            </td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>

            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>

            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

          <tr>
            <td>

            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>

            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td>

            </td>
            <td></td>
            <td></td>
            <td></td>
          </tr>

        </table>

      </form>



    </div>



<!--===============================섹션영역=================================== -->
<?php
  include "../lib/footer_in_folder.php";
 ?>
<!--============================================================================== -->
  </body>

</html>
