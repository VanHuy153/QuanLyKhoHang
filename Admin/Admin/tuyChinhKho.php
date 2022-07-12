<?php
require_once 'connect.php';
if (isset($_POST['submit'])) {
    $maKho = $_POST['maKho'];
    $tenKho = $_POST['tenKho'];
    $diaChiKho = $_POST['diaChiKho'];
    $sdtKho = $_POST['sdtKho'];
    if (empty($maKho)){
        if ($conn->query("INSERT INTO khohang(maKho, tenKho, diaChiKho, sdtKho) 
                                VALUES (NULL,'$tenKho','$diaChiKho','$sdtKho')"))
            echo "them du lieu thanh cong";
    } else {
        $sql = "UPDATE khohang SET
        tenKho = '$tenKho',
        diaChiKho = '$diaChiKho',
        sdtKho = '$sdtKho'
        WHERE maKho = '$maKho'";
        if ($conn->query($sql))
            echo "sua du lieu thanh cong";
    }
    header("location: QuanLyTonKho.php");
}
