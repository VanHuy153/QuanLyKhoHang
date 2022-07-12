<?php
require_once 'connect.php';
$err = [];
//Lay du lieu tu POST
if (isset($_POST['tenDanhMucThem'])) {
  $u = $_POST['tenDanhMucThem'];

  //kiem tra DL nhap

  $sql1 = "select * from danhmuc where tenDanhMuc = '$u'";
  $rs1 = mysqli_query($conn, $sql1);
  if (mysqli_num_rows($rs1) > 0) {
    $err['loi'] = 'Danh mục đã tồn tại';
  }
  if (empty($err)) {
    $sql0 = "INSERT INTO danhmuc(tenDanhMuc) VALUES('$u')";
    $query = mysqli_query($conn, $sql0);
    if ($query) {
      $err['thongBao'] = 'Thêm danh mục thành công';
    }
  }
  header("location: quanLyDanhMuc.php");
}
?>