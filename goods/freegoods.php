<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";

include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$sql="select * from `products` where `freegoods`='y'";
$result = mysqli_query($conn, $sql);
$total_record1 = mysqli_num_rows($result);
$sql2="select * from `freegoods_date`";
$result2 = mysqli_query($conn, $sql2);
$row2=mysqli_fetch_array($result2);
?>
<?php
    date_default_timezone_set("Asia/Seoul");
    $freegoods_date=$row2["freegoods_date"];
    $date_string =$freegoods_date; //end타임의 timestamp값(db입력값)
    $date1=strtotime($date_string);
    $date2=time();
    $total_secs=abs($date1 - $date2);
    $diff_in_days = floor($total_secs / 86400);
    $rest_hours = $total_secs % 86400;
    $diff_in_hours = floor($rest_hours / 3600);
    $rest_mins = $rest_hours % 3600;
    $diff_in_mins = floor($rest_mins / 60);
    $diff_in_secs = floor($rest_mins % 60);
    $time_diff = $diff_in_days ."일". $diff_in_hours ."시간".     $diff_in_mins ."분". $diff_in_secs ."초";
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/freegoods.css">
    <link rel="stylesheet" href="../css/common.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/message.css">
    <script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
    <script>
      var day;
      var hour;
      var min;
      var sec;
      function Timer(diff_in_secs, diff_in_mins, diff_in_hours, diff_in_days) {
        //남은시간 실시간으로 보여지는 부분
        day=diff_in_days;    //일단 남은 날짜와 시간을 받아온다음에 timer1을 호출한다
        hour=diff_in_hours;
        min=diff_in_mins;
        sec=diff_in_secs;
        Timer1();
      }
      function Timer1(){
        sec=sec-1;         //1초식 감소 하다가 -1이되면 1분을 뺀다은 초를 59초로 초기화
        if(sec == -1){
        sec = 59;
        min = min-1;
      }
      if(min == -1){    //1분씩 감소 하다가 -1이되면 1시간을 뺀다음 분을 59분으로 초기화
        min=59;
        hour = hour - 1;
      }
      if(hour == -1){    //1시간씩 감소 하다가 -1이되면 1일을 뺀다음 날짜 초기화
        hour = 23;
        day = day - 1;
      }
      if(sec == 0 && min == 0 && hour == 0 && day == 0){
        //일:0 시간:0 분:0 초:0 이라면 종료메세지 출력
        return;
      }
        document.timer.counter.value = day + 'Days ' + hour + 'Hours ' + min + 'Min ' + sec + 'Secs ';
        //1초당 한번씩 timer1()을 호출하여 실행
        window.setTimeout('Timer1()',1000);
      }
      function message_to_friends(){
        modal.style.display = "block";
      }

      $(document).ready(function() {
      $(".checkimg").click(function(event) {
        var n = $(".checkimg").index(this);
        var num_num = $(".hidden_num:eq("+n+")").val();
        var likes_img_value = $(".likes_img_value:eq("+n+")").val();
        console.log(n);
        console.log(num_num);
        console.log(likes_img_value);
         $.ajax({
           url: '../lib/like_dml.php?mode=go_like', // 데이터 보내서 작업되어질 url
           type: 'POST', // get 또는 post로 data를 보냄
           data: {num: num_num, liv : likes_img_value}
         })
         .done(function(result_ajax) {
           console.log("success");
           console.log(result_ajax);
           console.log($(".checkimg:eq("+n+")").attr("src"));
           if(result_ajax=='fail'){
             alert("로그인 후 이용하세요.");
           }else{
             if($(".checkimg:eq("+n+")").attr("src")!="../img/hover_like.png"){
               $(".checkimg:eq("+n+")").attr("src", "../img/hover_like.png");
             }else{
               $(".checkimg:eq("+n+")").attr("src", "../img/like.png");
              }
           }
            console.log($(".checkimg:eq("+n+")").attr("src"));
          if($(".likes_img_value:eq("+n+")").val()=='y'){
            $(".likes_img_value:eq("+n+")").val('n');
          }else{
            $(".likes_img_value:eq("+n+")").val('y');
          }
         })
         .fail(function() {
           console.log("error");
         })
         .always(function() {
           console.log("complete");
         });
      });
    });
  </script>
</head>

<?php echo '<body onload="Timer(\''.$diff_in_secs.'\',\''.$diff_in_mins.'\',\''.$diff_in_hours.'\',\''.$diff_in_days.'\')">'; ?>
    <?php include "../lib/header_in_folder.php"; ?>
    <section class="section_freegoods">
      <br><br><br>
      <h1>Free Goods of the Week</h1>
      <h2>Download these 6 free goods before it's too late!<form id="timer" name=timer><label id="counter_label">EXPIRATION</label><input id="counter" name=counter disabled></form></h2>
      <br><br>
      <div class="board_div">
      <?php
      for($i=0; $i<$total_record1; $i++){
        if($total_record1==0){
          break;
        }
        //하나 레코드 가져오기
        $row=mysqli_fetch_array($result);
        $no=$row["no"];
        $num=$row["num"];
        $username=$row["username"];
        $email=$row["email"];
        $subject=$row["subject"];
        $content=$row["content"];
        $regist_day=$row["regist_day"];
        $price=$row["price"];
        $big_data=$row["big_data"];
        $small_data=$row["small_data"];
        $img_file_copied1=$row["img_file_copied1"];
        $freegoods=$row["freegoods"];
        if($freegoods=='y'){
          $freegoods_img="../img/free_partner_logo.png";
        }else{
          $freegoods_img="../img/hover_logo.png";
        }
      echo '<div class="img_div">
          <figure class="snip1368">
            <a href="../shop/shop_view.php?num='.$num.'">
              <img id="main_img" src="../data/img/'.$img_file_copied1.'" alt="sample30" />
            </a>
            <div class="hover_img" id="hover_img_id">
              <img src="'.$freegoods_img.'" class="go_free_goods_img_class" name="go_free_goods_img"  style="width:25px; height:25px;"><!--가져다 댔을때-->
            </div>
            <div class="list_title_div">
              <div class="">
                <a href="#" class="">
                  <span class="list_title_div_span_bold">'.$subject.'</span>
                </a>
                <a href="#" class="list_title_div_a_float_right">
                  M&nbsp; '.$price.'
                </a>
              </div>
              <div class="">
                  by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email='.$email.'" class="">'.$email.'</a>
                  in&nbsp;<a href="../product_list/list.php?big_data='.$big_data.'" class="">'.$big_data.'</a>
              </div>
            </div>
          </figure>
          </div>
        ';
        if($i%3==2){
          echo '<br>';
        }
        if($i==5){
          break;
        }
      }
      ?>
      </div>
      <br><br>
    </section>
    <section class="tell_friends_section">
      <br>
      <span id="tell_friends_div">Don't forget to tell your friends&nbsp;&nbsp;</span><button type="" name="button" id="myBtn_1">MESSAGE</button></h1>
    </section>
    <section class="section_handpicked">
      <br>
      <h1>More top products from these great shops</h1>
      <br>
      <div class="board_handpicked_div">
      <?php
      if(isset($_SESSION['no'])){
        $sql3="select * from `products` where `handpicked`='y'";
        $result3 = mysqli_query($conn, $sql3);
        $total_record3 = mysqli_num_rows($result3);

        for($i=0; $i<$total_record3; $i++){
          if($total_record3==0){
            break;
          }
          //하나 레코드 가져오기
          $row3=mysqli_fetch_array($result3);
          $no3=$row3["no"];
          $num3=$row3["num"];
          $username3=$row3["username"];
          $email3=$row3["email"];
          $subject3=$row3["subject"];
          $content3=$row3["content"];
          $regist_day3=$row3["regist_day"];
          $price3=$row3["price"];
          $big_data3=$row3["big_data"];
          $small_data3=$row3["small_data"];
          $img_file_copied1_3=$row3["img_file_copied1"];
          $handpicked=$row3["handpicked"];
          if($handpicked=='y'){
            $handpicked_img="../img/free_partner_logo.png";
          }else{
            $handpicked_img="../img/hover_logo.png";
          }
          $sql_likes = "SELECT product_num from likes where no = '$member_no';";
          $result_likes = mysqli_query($conn, $sql_likes);
          $total_record_likes = mysqli_num_rows($result_likes);
          $likes_img = "../img/hover_like.png";
          $likes_img_value = "n";
          for($j=0;$j<$total_record_likes;$j++){
            mysqli_data_seek($result_likes, $j);
            $row_likes = mysqli_fetch_array($result_likes);
            $likes = $row_likes['product_num'];
            if($likes == $num3){
              $likes_img = "../img/like.png";
              $likes_img_value = "y";
              break;
            }
          }
        echo '<a href="../shop/shop_view.php?num='.$num3.'"><div class="img_div">
        <input type="hidden" class="hidden_num" value="'.$num3.'">
            <figure class="snip1368">
              <a href="../shop/shop_view.php?num='.$num3.'">
                <img id="main_img" src="../data/img/'.$img_file_copied1_3.'" alt="sample30" />
              </a>
              <div class="hover_img" id="hover_img_id">
                <img src="'.$handpicked_img.'" class="go_free_goods_img_class" name="go_free_goods_img"  style="width:25px; height:25px;"><!--가져다 댔을때-->
              </div>
              <div class="list_title_div">
                <div class="">
                  <a href="#" class="">
                    <span class="list_title_div_span_bold">'.$subject3.'</span>
                  </a>
                  <a href="#" class="list_title_div_a_float_right">
                    M&nbsp; '.$price3.'
                  </a>
                </div>
                <div class="">
                    by&nbsp;<a href="../member_profile/profile_view.php?mode=shop&email='.$email.'" class="">'.$email3.'</a>
                    in&nbsp;<a href="../product_list/list.php?big_data='.$big_data3.'" class="">'.$big_data3.'</a>
                </div>
              </div>
              <figcaption>
                <div class="icons">
                  <img src="'.$likes_img.'" alt="" style="width:20px; height:20px;" class="checkimg">
                  <input type="hidden" class="likes_img_value" value="'.$likes_img_value.'">
                </div>
              </figcaption>
            </figure>
            </div><a>
          ';
          if($i%4==3){
            echo '<br>';
          }
          if($i==$total_record3-1){
            break;
          }
        }
      }
      ?>

      </div>
      <br><br>
    </section>
    <section class="more_handpicked_section">
      <a href="../product_list/list.php?big_data=photos&mode=search&partner=n&handpicked=y&popular=n&search_text=">More Handpicked Photos</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../product_list/list.php?big_data=graphics&mode=search&partner=n&handpicked=n&popular=n&search_text=">More Handpicked Graphics</a>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="../product_list/list.php?big_data=fonts&mode=search&partner=n&handpicked=n&popular=n&search_text=">More Handpicked Fonts</a>
      <br><br>
    </section>
    <?php
      include "../lib/footer_in_folder.php";
      include "../message/send_message_modal_in_folder.php";
      include "../khy_modal/login_modal_in_folder.php";
      if(!isset($_SESSION['no'])) {
        ?>
        <script>
          auto_modal();
        </script>
        <?php
      }
    ?>
  </body>
</html>
