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

  $sql_sales_1="select sum(point_mon) as sum_mon from sales where regist_day like '$year-01%'";
  $result_sql_sales_1 = mysqli_query($conn, $sql_sales_1);
  $row_result_sql_sales_1=mysqli_fetch_array($result_sql_sales_1);
  $sum_mon1 = $row_result_sql_sales_1['sum_mon'];

  $sql_sales_2="select sum(point_mon) as sum_mon from sales where regist_day like '$year-02%'";
  $result_sql_sales_2 = mysqli_query($conn, $sql_sales_2);
  $row_result_sql_sales_2=mysqli_fetch_array($result_sql_sales_2);
  $sum_mon2 = $row_result_sql_sales_2['sum_mon'];

  $sql_sales_3="select sum(point_mon) as sum_mon from sales where regist_day like '$year-03%'";
  $result_sql_sales_3 = mysqli_query($conn, $sql_sales_3);
  $row_result_sql_sales_3=mysqli_fetch_array($result_sql_sales_3);
  $sum_mon3 = $row_result_sql_sales_3['sum_mon'];

  $sql_sales_4="select sum(point_mon) as sum_mon from sales where regist_day like '$year-04%'";
  $result_sql_sales_4 = mysqli_query($conn, $sql_sales_4);
  $row_result_sql_sales_4=mysqli_fetch_array($result_sql_sales_4);
  $sum_mon4 = $row_result_sql_sales_4['sum_mon'];

  $sql_sales_5="select sum(point_mon) as sum_mon from sales where regist_day like '$year-05%'";
  $result_sql_sales_5 = mysqli_query($conn, $sql_sales_5);
  $row_result_sql_sales_5=mysqli_fetch_array($result_sql_sales_5);
  $sum_mon5 = $row_result_sql_sales_5['sum_mon'];

  $sql_sales_6="select sum(point_mon) as sum_mon from sales where regist_day like '$year-06%'";
  $result_sql_sales_6 = mysqli_query($conn, $sql_sales_6);
  $row_result_sql_sales_6=mysqli_fetch_array($result_sql_sales_6);
  $sum_mon6 = $row_result_sql_sales_6['sum_mon'];

  $sql_sales_7="select sum(point_mon) as sum_mon from sales where regist_day like '$year-07%'";
  $result_sql_sales_7 = mysqli_query($conn, $sql_sales_7);
  $row_result_sql_sales_7=mysqli_fetch_array($result_sql_sales_7);
  $sum_mon7 = $row_result_sql_sales_7['sum_mon'];

  $sql_sales_8="select sum(point_mon) as sum_mon from sales where regist_day like '$year-08%'";
  $result_sql_sales_8 = mysqli_query($conn, $sql_sales_8);
  $row_result_sql_sales_8=mysqli_fetch_array($result_sql_sales_8);
  $sum_mon8 = $row_result_sql_sales_8['sum_mon'];

  $sql_sales_9="select sum(point_mon) as sum_mon from sales where regist_day like '$year-09%'";
  $result_sql_sales_9 = mysqli_query($conn, $sql_sales_9);
  $row_result_sql_sales_9=mysqli_fetch_array($result_sql_sales_9);
  $sum_mon9 = $row_result_sql_sales_9['sum_mon'];

  $sql_sales_10="select sum(point_mon) as sum_mon from sales where regist_day like '$year-10%'";
  $result_sql_sales_10 = mysqli_query($conn, $sql_sales_10);
  $row_result_sql_sales_10=mysqli_fetch_array($result_sql_sales_10);
  $sum_mon10 = $row_result_sql_sales_10['sum_mon'];

  $sql_sales_11="select sum(point_mon) as sum_mon from sales where regist_day like '$year-11%'";
  $result_sql_sales_11 = mysqli_query($conn, $sql_sales_11);
  $row_result_sql_sales_11=mysqli_fetch_array($result_sql_sales_11);
  $sum_mon11 = $row_result_sql_sales_11['sum_mon'];

  $sql_sales_12="SELECT sum(point_mon) as sum_mon from sales where regist_day like '$year-12%'";
  $result_sql_sales_12 = mysqli_query($conn, $sql_sales_12);
  $row_result_sql_sales_12=mysqli_fetch_array($result_sql_sales_12);
  $sum_mon12 = $row_result_sql_sales_12['sum_mon'];

  var_dump($sum_mon12);
  //--라인차트 쿼리문(report)--


  //--파이차트 쿼리문--
  $sql_photos_total = "select sum(report_price) as sum_ph from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='photos';";
  $sql_graphics_total = "select sum(report_price) as sum_gr from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='graphics';";
  $sql_fonts_total = "select sum(report_price) as sum_fo from `report` as r  inner join `products` as p on p.num=r.product_num where p.big_data='fonts';";

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
          ['Month', 'Sales'],
          <?php
          echo "['1',".$sum_mon1."],";
          echo "['2',".$sum_mon2."],";
          echo "['3',".$sum_mon3."],";
          echo "['4',".$sum_mon4."],";
          echo "['5',".$sum_mon5."],";
          echo "['6',".$sum_mon6."],";
          echo "['7',".$sum_mon7."],";
          echo "['8',".$sum_mon8."],";
          echo "['9',".$sum_mon9."],";
          echo "['10',".$sum_mon10."],";
          echo "['11',".$sum_mon11."],";
          echo "['12',".$sum_mon12."]";
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
    <div id="piechart" style="width: 900px; height: 500px;"></div>
    <div id="curve_chart" style="width: 900px; height: 500px"></div>
  </body>
</html>
