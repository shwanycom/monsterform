<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>
<?php
  function nulltozero($value){
    if($value==null){
      $value=0;
    }
    return $value;
  }
  $year_half=date("y");
  $year="20".$year_half;
  $sql_par="select `partner` from `member` where no='$member_no'";
  $result_par = mysqli_query($conn, $sql_par);
  $row_par=mysqli_fetch_array($result_par);
  $mem_part = $row_par['partner'];

  //--라인차트 쿼리문(report_admin(partner=y))--
  $sql_member_sales="select sum(case when `buy_regist_day` like '$year-01%' then `pro_price` end) as mem_sales1,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-02%' then `pro_price` end) as mem_sales2,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-03%' then `pro_price` end) as mem_sales3,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-04%' then `pro_price` end) as mem_sales4,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-05%' then `pro_price` end) as mem_sales5,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-06%' then `pro_price` end) as mem_sales6,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-07%' then `pro_price` end) as mem_sales7,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-08%' then `pro_price` end) as mem_sales8,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-09%' then `pro_price` end) as mem_sales9,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-10%' then `pro_price` end) as mem_sales10,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-11%' then `pro_price` end) as mem_sales11,";
  $sql_member_sales.=" sum(case when `buy_regist_day` like '$year-12%' then `pro_price` end) as mem_sales12";
  $sql_member_sales.=" from `collections` where `pro_no`=$member_no";

  $result_member_sales = mysqli_query($conn, $sql_member_sales);
  $row_member_sales=mysqli_fetch_array($result_member_sales);
  $mem_sales1 = nulltozero($row_member_sales['mem_sales1']);
  $mem_sales2 = nulltozero($row_member_sales['mem_sales2']);
  $mem_sales3 = nulltozero($row_member_sales['mem_sales3']);
  $mem_sales4 = nulltozero($row_member_sales['mem_sales4']);
  $mem_sales5 = nulltozero($row_member_sales['mem_sales5']);
  $mem_sales6 = nulltozero($row_member_sales['mem_sales6']);
  $mem_sales7 = nulltozero($row_member_sales['mem_sales7']);
  $mem_sales8 = nulltozero($row_member_sales['mem_sales8']);
  $mem_sales9 = nulltozero($row_member_sales['mem_sales9']);
  $mem_sales10 = nulltozero($row_member_sales['mem_sales10']);
  $mem_sales11 = nulltozero($row_member_sales['mem_sales11']);
  $mem_sales12 = nulltozero($row_member_sales['mem_sales12']);

  if($mem_part=='y'){
    $mem_sales1=$mem_sales1*0.8;
    $mem_sales2=$mem_sales2*0.8;
    $mem_sales3=$mem_sales3*0.8;
    $mem_sales4=$mem_sales4*0.8;
    $mem_sales5=$mem_sales5*0.8;
    $mem_sales6=$mem_sales6*0.8;
    $mem_sales7=$mem_sales7*0.8;
    $mem_sales8=$mem_sales8*0.8;
    $mem_sales9=$mem_sales9*0.8;
    $mem_sales10=$mem_sales10*0.8;
    $mem_sales11=$mem_sales11*0.8;
    $mem_sales12=$mem_sales12*0.8;
  }else{
    $mem_sales1=$mem_sales1*0.6;
    $mem_sales2=$mem_sales2*0.6;
    $mem_sales3=$mem_sales3*0.6;
    $mem_sales4=$mem_sales4*0.6;
    $mem_sales5=$mem_sales5*0.6;
    $mem_sales6=$mem_sales6*0.6;
    $mem_sales7=$mem_sales7*0.6;
    $mem_sales8=$mem_sales8*0.6;
    $mem_sales9=$mem_sales9*0.6;
    $mem_sales10=$mem_sales10*0.6;
    $mem_sales11=$mem_sales11*0.6;
    $mem_sales12=$mem_sales12*0.6;
  }


?>
<html>
  <head>
    <style media="screen">
      rect{
        fill:rgba(245,245,244,230);
      }
    </style>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages': ['linechart']}); /*LINE차트를 사용하기 위한 준비  */
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales'],
        <?php
        echo "['1',".$mem_sales1."],";
        echo "['2',".$mem_sales2."],";
        echo "['3',".$mem_sales3."],";
        echo "['4',".$mem_sales4."],";
        echo "['5',".$mem_sales5."],";
        echo "['6',".$mem_sales6."],";
        echo "['7',".$mem_sales7."],";
        echo "['8',".$mem_sales8."],";
        echo "['9',".$mem_sales9."],";
        echo "['10',".$mem_sales10."],";
        echo "['11',".$mem_sales11."],";
        echo "['12',".$mem_sales12."]";
        ?>
      ]);
      var options = {
        title: 'Purchase History',
        curveType: 'function',
        backgroundColor: "transparent",
      };
      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      chart.draw(data, {width: '100%', height:400});
    }
    </script>
  </head>
  <body>
    <div class="" style="text-align:center;">
      <h1><?=$member_email?> : Sales Data</h1>
    </div>
    <div id="curve_chart" align="center"></div>
  </body>
</html>
