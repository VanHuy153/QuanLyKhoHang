<?php
    require 'login_sec.php';
    if($_SESSION['user']){
        unset($_SESSION['user']);
        header("location: DangNhap.php");
    }
?>
