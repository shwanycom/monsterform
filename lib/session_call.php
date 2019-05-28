<?php
session_start();
if(isset($_SESSION['no'])){
  $member_no = $_SESSION['no'];
  $member_email = $_SESSION['email'];
  $member_username = $_SESSION['username'];
  $member_mon = $_SESSION['mon'];
  $member_partner = $_SESSION['partner'];
}

?>
