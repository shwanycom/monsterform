<?php
session_start();

unset($_SESSION['no']);
unset($_SESSION['email']);
unset($_SESSION['username']);
unset($_SESSION['mon']);

Header("Location: ../index.php");
?>
