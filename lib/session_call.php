<?php
session_start();
if(!isset($_SESSION['userid'])){
  echo "<script> alert('권한없음1'); history.go(-1); </script>";
  exit;
}
?>
