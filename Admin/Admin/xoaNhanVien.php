<?php
require_once 'connect.php';
require_once 'login_sec.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
    $searchAnh = "SELECT * FROM NhanVien WHERE maNhanVien = " . $id;
    $query = mysqli_query($conn, $searchAnh);
    if (mysqli_num_rows($query) > 0) {
        $row = mysqli_fetch_assoc($query);
    }
    if ($id == 1 || $row['quyenHan'] != 'Nhân viên' || $_SESSION['user']['quyenHan'] != 'Admin' || !checkLoginHighAdmin()) {
        $_SESSION['thongBao'] = 'Bạn không đủ quyền hạn';
    } else {
        if (!$row['anhChanDung']) {
            unlink("ADataImage/nhanVien/" . $row['anhChanDung']);
            echo "Xoa anh thanh cong";
        };
        if ($conn->query("DELETE FROM NhanVien where maNhanVien = $id"))
            echo "xoa du lieu thanh cong";
    }
}
header("location: PhanQuyenSuDung.php");
