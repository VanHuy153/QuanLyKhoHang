<?php 
    require_once 'connect.php';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if($id)
        if($conn -> query("DELETE FROM khohang where maKho = $id"))
            echo "them du lieu thanh cong";
    header("location: QuanLyTonKho.php");
?>
