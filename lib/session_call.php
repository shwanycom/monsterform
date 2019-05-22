<?php
session_start();
if(isset($_SESSION['no'])){
  $memeber_no = $_SESSION['no'];
  $member_email = $_SESSION['email'];
  $memeber_username = $_SESSION['username'];
  $member_mon = $_SESSION['mon'];
  $member_partner = $_SESSION['partner'];
}

?>
