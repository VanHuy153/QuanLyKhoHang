<?php
require_once('connect.php');
unset($_SESSION['user']);
header('location: DangNhap.php');
?>