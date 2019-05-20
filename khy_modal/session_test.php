<?php
session_start();

var_export($_SESSION['no']); echo "<br>";
var_export($_SESSION['email']); echo "<br>";
var_export($_SESSION['username']); echo "<br>";
var_export($_SESSION['mon']); echo "<br>";

if(isset($_GET['mode'])&&$_GET['mode']=="unset"){
unset($_SESSION['no']);
unset($_SESSION['email']);
unset($_SESSION['username']);
unset($_SESSION['mon']);
var_export($_SESSION['no']); echo "<br>";
var_export($_SESSION['email']); echo "<br>";
var_export($_SESSION['username']); echo "<br>";
var_export($_SESSION['mon']); echo "<br>";
}

?>

<!DOCTYPE html>
<html lang="ko" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
    <script type="text/javascript">
    </script>
  </head>
  <body>
    <a href="session_test.php?mode=unset"> <button type="button" name="" >unset()</button></a>
  </body>
</html>
