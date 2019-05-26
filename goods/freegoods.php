<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
$sql="select * from `products` where `freegoods`='y'";
$result = mysqli_query($conn, $sql);
?>
<?php
if(isset($_GET['mode'])){
  var_dump($_GET['mode']);
  $date_pick=$_POST['pick_date'];
  var_dump($_POST['pick_date']);
}

date_default_timezone_set("Asia/Seoul");
    $date_string ="2019-06-01T18:00"; //end타임의 timestamp값(db입력값)
    $date1=strtotime($date_string);
    echo $date1."<br>";
    $date2=time();
    $total_secs=abs($date1 - $date2);
    $diff_in_days = floor($total_secs / 86400);
    $rest_hours = $total_secs % 86400;
    $diff_in_hours = floor($rest_hours / 3600);
    $rest_mins = $rest_hours % 3600;
    $diff_in_mins = floor($rest_mins / 60);
    $diff_in_secs = floor($rest_mins % 60);
    $time_diff = $diff_in_days ."일". $diff_in_hours ."시간".     $diff_in_mins ."분". $diff_in_secs ."초";
    echo $time_diff;
?>
<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <link rel="stylesheet" href="../css/freegoods.css">
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
    document.timer.counter.value = '경매가 종료되었습니다.';
    return;
  }
    document.timer.counter.value = day + 'Days ' + hour + 'Hours ' + min + 'Min ' + sec + 'Secs ';
    //1초당 한번씩 timer1()을 호출하여 실행
    window.setTimeout('Timer1()',1000);
  }
</script>
</head>
  <?php
  echo '<body onload="Timer(\''.$diff_in_secs.'\',\''.$diff_in_mins.'\',\''.$diff_in_hours.'\',\''.$diff_in_days.'\')">';
  ?>
    <section id="section_freegoods">

      <h1>Free Goods of the Week</h1>
      <h2>Download these 6 free goods before it's too late!<form name=timer><input name=counter></form></h2>
      <form class="" action="freegoods.php?mode=date" method="post">
        <input type="datetime-local" name="pick_date" value="">
        <input type="submit" name="" value="123">
      </form>

      <div style="position:absolute ; top:315px; left:248px;">
      <font style="font-size:25px;"><span id="countdown_ele"></span></font>
      </div>
      <div class="board_div">
      <?php
      for($i=0; $i<8; $i++){
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
          <input type="hidden" class="hidden_num" value="'.$num.'">
          <figure class="snip1368">
            <a href="#">
              <img id="main_img" src="../img/'.$img_file_copied1.'" alt="sample30" />
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
                  by&nbsp;<a href="#" class="">'.$email.'</a>
                  in&nbsp;<a href="#" class="">'.$big_data.'</a>
              </div>
            </div>
            <figcaption>
              <div class="icons">
                <a href="#">
                <img src="../img/hover_like.png" alt="" style="width:20px; height:20px;" class="checkimg">
                </a><span>&nbsp;&nbsp;Like</span><br>
                <a href="#"><img src="../img/hover_collection.png" alt="" style="width:20px; height:20px;" class="checkimg">
                </a><span>&nbsp;Save</span>
              </div>
            </figcaption>
          </figure>
          </div>
        ';
        if($i%3==2){
          echo '<br>';
        }
      }
      ?>
      </div>
    </section>

  </body>
</html>
