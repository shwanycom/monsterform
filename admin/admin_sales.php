<?php
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/session_call.php";
if(isset($_SESSION['username'])){
  if($_SESSION['username']!=='admin'){
    echo "<script> alert('no permission'); history.go(-1); </script>";
  }
}else if(!isset($_SESSION['username'])){
  echo "<script> alert('no permission'); history.go(-1); </script>";
}
include_once $_SERVER["DOCUMENT_ROOT"]."./monsterform/lib/db_connector.php";
?>
<?php
//--라인차트 쿼리문(sales)--
  $year_half=date("y");
  $year="20".$year_half;

  $sql_sales="SELECT sum(CASE WHEN `regist_day` like '$year-01%' then point_mon end) as sum_sales_mon1,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-02%' then point_mon end) as sum_sales_mon2,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-03%' then point_mon end) as sum_sales_mon3,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-04%' then point_mon end) as sum_sales_mon4,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-05%' then point_mon end) as sum_sales_mon5,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-06%' then point_mon end) as sum_sales_mon6,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-07%' then point_mon end) as sum_sales_mon7,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-08%' then point_mon end) as sum_sales_mon8,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-09%' then point_mon end) as sum_sales_mon9,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-10%' then point_mon end) as sum_sales_mon10,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-11%' then point_mon end) as sum_sales_mon11,";
  $sql_sales.=" sum(CASE WHEN `regist_day` like '$year-12%' then point_mon end) as sum_sales_mon12 from `sales`;";

  $result_sales = mysqli_query($conn, $sql_sales);
  $row_sales=mysqli_fetch_array($result_sales);

  $sum_sales_mon1 = $row_sales['sum_sales_mon1'];
  $sum_sales_mon2 = $row_sales['sum_sales_mon2'];
  $sum_sales_mon3 = $row_sales['sum_sales_mon3'];
  $sum_sales_mon4 = $row_sales['sum_sales_mon4'];
  $sum_sales_mon5 = $row_sales['sum_sales_mon5'];
  $sum_sales_mon6 = $row_sales['sum_sales_mon6'];
  $sum_sales_mon7 = $row_sales['sum_sales_mon7'];
  $sum_sales_mon8 = $row_sales['sum_sales_mon8'];
  $sum_sales_mon9 = $row_sales['sum_sales_mon9'];
  $sum_sales_mon10 = $row_sales['sum_sales_mon10'];
  $sum_sales_mon11 = $row_sales['sum_sales_mon11'];
  $sum_sales_mon12 = $row_sales['sum_sales_mon12'];

  //--라인차트 쿼리문(report_admin(partner=y))--
  $sql_report_admin_py="SELECT sum(CASE WHEN `report_regist_day` like '$year-01%' then point_mon end) as sum_report_admin_mon1_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-02%' then report_price end) as sum_report_admin_mon2_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-03%' then report_price end) as sum_report_admin_mon3_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-04%' then report_price end) as sum_report_admin_mon4_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-05%' then report_price end) as sum_report_admin_mon5_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-06%' then report_price end) as sum_report_admin_mon6_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-07%' then report_price end) as sum_report_admin_mon7_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-08%' then report_price end) as sum_report_admin_mon8_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-09%' then report_price end) as sum_report_admin_mon9_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-10%' then report_price end) as sum_report_admin_mon10_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-11%' then report_price end) as sum_report_admin_mon11_py,";
  $sql_report_admin_py.=" sum(CASE WHEN `report_regist_day` like '$year-12%' then report_price end) as sum_report_admin_mon12_py from `report` as r";
  $sql_report_admin_py.=" inner join `products` as p on p.num=r.product_num inner join member as m on m.no=p.no where m.partner='y';";

  $result_report_admin_py = mysqli_query($conn, $sql_report_admin_py);
  $row_report_admin_py=mysqli_fetch_array($result_report_admin_py);
  $sum_report_admin_mon1_py = $row_report_admin_py['sum_report_admin_mon1_py'];
  $sum_report_admin_mon2_py = $row_report_admin_py['sum_report_admin_mon2_py'];
  $sum_report_admin_mon3_py = $row_report_admin_py['sum_report_admin_mon3_py'];
  $sum_report_admin_mon4_py = $row_report_admin_py['sum_report_admin_mon4_py'];
  $sum_report_admin_mon5_py = $row_report_admin_py['sum_report_admin_mon5_py'];
  $sum_report_admin_mon6_py = $row_report_admin_py['sum_report_admin_mon6_py'];
  $sum_report_admin_mon7_py = $row_report_admin_py['sum_report_admin_mon7_py'];
  $sum_report_admin_mon8_py = $row_report_admin_py['sum_report_admin_mon8_py'];
  $sum_report_admin_mon9_py = $row_report_admin_py['sum_report_admin_mon9_py'];
  $sum_report_admin_mon10_py = $row_report_admin_py['sum_report_admin_mon10_py'];
  $sum_report_admin_mon11_py = $row_report_admin_py['sum_report_admin_mon11_py'];
  $sum_report_admin_mon12_py = $row_report_admin_py['sum_report_admin_mon12_py'];

  //--라인차트 쿼리문(report_admin(partner=n))--
  $sql_report_admin_pn="SELECT sum(CASE WHEN `report_regist_day` like '$year-01%' then point_mon end) as sum_report_admin_mon1_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-02%' then report_price end) as sum_report_admin_mon2_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-03%' then report_price end) as sum_report_admin_mon3_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-04%' then report_price end) as sum_report_admin_mon4_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-05%' then report_price end) as sum_report_admin_mon5_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-06%' then report_price end) as sum_report_admin_mon6_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-07%' then report_price end) as sum_report_admin_mon7_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-08%' then report_price end) as sum_report_admin_mon8_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-09%' then report_price end) as sum_report_admin_mon9_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-10%' then report_price end) as sum_report_admin_mon10_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-11%' then report_price end) as sum_report_admin_mon11_pn,";
  $sql_report_admin_pn.=" sum(CASE WHEN `report_regist_day` like '$year-12%' then report_price end) as sum_report_admin_mon12_pn from `report` as r";
  $sql_report_admin_pn.=" inner join `products` as p on p.num=r.product_num inner join member as m on m.no=p.no where m.partner='n';";

  $result_report_admin_pn = mysqli_query($conn, $sql_report_admin_pn);
  $row_report_admin_pn=mysqli_fetch_array($result_report_admin_pn);

  $sum_report_admin_mon1_pn = $row_report_admin_pn['sum_report_admin_mon1_pn'];
  $sum_report_admin_mon2_pn = $row_report_admin_pn['sum_report_admin_mon2_pn'];
  $sum_report_admin_mon3_pn = $row_report_admin_pn['sum_report_admin_mon3_pn'];
  $sum_report_admin_mon4_pn = $row_report_admin_pn['sum_report_admin_mon4_pn'];
  $sum_report_admin_mon5_pn = $row_report_admin_pn['sum_report_admin_mon5_pn'];
  $sum_report_admin_mon6_pn = $row_report_admin_pn['sum_report_admin_mon6_pn'];
  $sum_report_admin_mon7_pn = $row_report_admin_pn['sum_report_admin_mon7_pn'];
  $sum_report_admin_mon8_pn = $row_report_admin_pn['sum_report_admin_mon8_pn'];
  $sum_report_admin_mon9_pn = $row_report_admin_pn['sum_report_admin_mon9_pn'];
  $sum_report_admin_mon10_pn = $row_report_admin_pn['sum_report_admin_mon10_pn'];
  $sum_report_admin_mon11_pn = $row_report_admin_pn['sum_report_admin_mon11_pn'];
  $sum_report_admin_mon12_pn = $row_report_admin_pn['sum_report_admin_mon12_pn'];


  $sum_report_admin_mon1=$sum_report_admin_mon1_pn*0.4+$sum_report_admin_mon1_py*0.2;
  $sum_report_admin_mon2=$sum_report_admin_mon2_pn*0.4+$sum_report_admin_mon2_py*0.2;
  $sum_report_admin_mon3=$sum_report_admin_mon3_pn*0.4+$sum_report_admin_mon3_py*0.2;
  $sum_report_admin_mon4=$sum_report_admin_mon4_pn*0.4+$sum_report_admin_mon4_py*0.2;
  $sum_report_admin_mon5=$sum_report_admin_mon5_pn*0.4+$sum_report_admin_mon5_py*0.2;
  $sum_report_admin_mon6=$sum_report_admin_mon6_pn*0.4+$sum_report_admin_mon6_py*0.2;
  $sum_report_admin_mon7=$sum_report_admin_mon7_pn*0.4+$sum_report_admin_mon7_py*0.2;
  $sum_report_admin_mon8=$sum_report_admin_mon8_pn*0.4+$sum_report_admin_mon8_py*0.2;
  $sum_report_admin_mon9=$sum_report_admin_mon9_pn*0.4+$sum_report_admin_mon9_py*0.2;
  $sum_report_admin_mon10=$sum_report_admin_mon10_pn*0.4+$sum_report_admin_mon10_py*0.2;
  $sum_report_admin_mon11=$sum_report_admin_mon11_pn*0.4+$sum_report_admin_mon11_py*0.2;
  $sum_report_admin_mon12=$sum_report_admin_mon12_pn*0.4+$sum_report_admin_mon12_py*0.2;

  //--파이차트 쿼리문--
  if(!isset($_GET['mode'])){
    $sql_photos_total = "select sum(report_price) as sum_ph from, count(report_price) as count_ph from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='photos';";
    $sql_graphics_total = "select sum(report_price) as sum_gr from, count(report_price) as count_gr  `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='graphics';";
    $sql_fonts_total = "select sum(report_price) as sum_fo from, count(report_price) as count_fo  `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='fonts';";
    $result_photo = mysqli_query($conn, $sql_photos_total);
    $row_ph=mysqli_fetch_array($result_photo);
    $sum_ph = $row_ph['sum_ph'];

    $result_graphics = mysqli_query($conn, $sql_graphics_total);
    $row_gr=mysqli_fetch_array($result_graphics);
    $sum_gr=$row_gr['sum_gr'];

    $result_fonts = mysqli_query($conn, $sql_fonts_total);
    $row_fo=mysqli_fetch_array($result_fonts);
    $sum_fo=$row_fo['sum_fo'];
  }else{
    $month=$_POST['admin_submit_month'];
    $sql_photos_total = "select sum(report_price) as sum_ph from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='photos' and r.report_regist_day like '$year-$month%';";
    $sql_graphics_total = "select sum(report_price) as sum_gr from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='graphics' and r.report_regist_day like '$year-$month%';";
    $sql_fonts_total = "select sum(report_price) as sum_fo from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='fonts' and like r.report_regist_day '$year-$month%';;";
  }
  $result_photo = mysqli_query($conn, $sql_photos_total);
  $row_ph=mysqli_fetch_array($result_photo);
  $sum_ph = $row_ph['sum_ph'];

  $result_graphics = mysqli_query($conn, $sql_graphics_total);
  $row_gr=mysqli_fetch_array($result_graphics);
  $sum_gr=$row_gr['sum_gr'];

  $result_fonts = mysqli_query($conn, $sql_fonts_total);
  $row_fo=mysqli_fetch_array($result_fonts);
  $sum_fo=$row_fo['sum_fo'];
?>
<html>
  <head>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
    google.charts.load('current', {'packages': ['linechart']}); /*LINE차트를 사용하기 위한 준비  */
    google.charts.setOnLoadCallback(drawChart);
    function drawChart() {
      var data = google.visualization.arrayToDataTable([
        ['Month', 'Sales', 'report_admin'],
        <?php
        echo "['1',".$sum_sales_mon1.",".$sum_report_admin_mon1."],";
        echo "['2',".$sum_sales_mon2.",".$sum_report_admin_mon2."],";
        echo "['3',".$sum_sales_mon3.",".$sum_report_admin_mon3."],";
        echo "['4',".$sum_sales_mon4.",".$sum_report_admin_mon4."],";
        echo "['5',".$sum_sales_mon5.",".$sum_report_admin_mon5."],";
        echo "['6',".$sum_sales_mon6.",".$sum_report_admin_mon6."],";
        echo "['7',".$sum_sales_mon7.",".$sum_report_admin_mon7."],";
        echo "['8',".$sum_sales_mon8.",".$sum_report_admin_mon8."],";
        echo "['9',".$sum_sales_mon9.",".$sum_report_admin_mon9."],";
        echo "['10',".$sum_sales_mon10.",".$sum_report_admin_mon10."],";
        echo "['11',".$sum_sales_mon11.",".$sum_report_admin_mon11."],";
        echo "['12',".$sum_sales_mon12.",".$sum_report_admin_mon12."]";
        ?>
      ]);
      var options = {
        title: 'Company Performance',
        curveType: 'function',
        legend: { position: 'bottom' }
      };
      var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));
      chart.draw(data, options);
    }
    google.charts.load('current', {'packages':['corechart']});
    google.charts.setOnLoadCallback(drawChart1);
    function drawChart1() {
        var data = google.visualization.arrayToDataTable([
          ['Task', 'Hours per Day'],
          <?php
          echo "['Photos',".$sum_ph."],";
          echo "['Graphics',".$sum_gr."],";
          echo "['Fonts',".$sum_fo."]";
          ?>
        ]);
        var options = {
          chart:{
            title: 'sales'
          },
          width: 600,
          height: 400,
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
    }

    </script>
  </head>
  <body>
    <form class="" action="admin_sales.php?mode=piechart" method="post">
      <select class="" name="admin_submit_month">
        <option value=""><?=$year?></option>
        <option value="">01</option>
        <option value="">02</option>
        <option value="">03</option>
        <option value="">04</option>
        <option value="">05</option>
        <option value="">06</option>
        <option value="">07</option>
        <option value="">08</option>
        <option value="">09</option>
        <option value="">10</option>
        <option value="">11</option>
        <option value="">12</option>
      </select>
      <input type="submit" name="" value="">
    </form>
    <div class="">
      <span></span>
    </div>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
