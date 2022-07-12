<?php
session_start();

function checkLogin()
{
}
function checkPermission()
{
    return strcasecmp($_SESSION['user']['quyenHan'], 'Admin') == 0;
}
function checkLoginAdmin()
{
    if (!checkPermission()) {
        $_SESSION['thongBao'] = 'Bạn không đủ quyền hạn';
        header("location: starter.php");
    }
}
function checkLoginHighAdmin()
{
    return strcasecmp($_SESSION['user']['maNhanVien'], '1') == 0;
}
if (!isset($_SESSION['user'])) {
    $_SESSION['thongBao'] = 'Bạn chưa đăng nhập';
    header("location: DangNhap.php");
}
require_once 'connect.php';
$query = mysqli_query($conn, "select * from `phieubaotri` ORDER BY maPhieuBaoTri DESC LIMIT 1");

if (mysqli_num_rows($query) > 0) {
    $duLieuBaoTri = array();
    $row = mysqli_fetch_assoc($query);
    $duLieuBaoTri = $row;
}
if (isset($duLieuBaoTri) && strcasecmp($duLieuBaoTri['moTa'], 'TIẾN HÀNH BẢO TRÌ') == 0 && !checkPermission()) {
    header("location: thongBaoBaoTri.php");
} 
//if(!checkPermission()) header("location: thongBaoBaoTri.php");
