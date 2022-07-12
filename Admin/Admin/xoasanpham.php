<?php 
    require_once 'connect.php';
    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
    if($id)
        if($conn -> query("DELETE FROM sanpham where maSanPham = $id"))
            echo "them du lieu thanh cong";
    header("location: quanLySanPham.php");
?>
