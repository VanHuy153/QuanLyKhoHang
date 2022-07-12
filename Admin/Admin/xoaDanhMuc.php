<?php 
    require_once 'connect.php';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if($id)
        if($conn -> query("DELETE FROM danhMuc where maDanhMuc = $id"))
            echo "xoa du lieu thanh cong";
    header("location: quanLyDanhMuc.php");
?>