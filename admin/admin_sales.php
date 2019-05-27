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
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);
      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['Sales_sort_big_data', 'Sales'],
          ['Photos',     11],
          ['Graphics',      2],
          ['Fonts',  2],
        ]);
        var options = {
          title: 'My Daily Activities'
        };
        var chart = new google.visualization.PieChart(document.getElementById('piechart'));
        chart.draw(data, options);
      }
    </script>
  </head>
  <body>
    <div id="piechart" style="width: 900px; height: 500px;"></div>
  </body>
</html>
