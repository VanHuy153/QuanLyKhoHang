<?php
require_once 'connect.php';
$err = [];
//Lay du lieu tu POST
if (isset($_POST['maDanhMucSua'])) {
    $i = $_POST['maDanhMucSua'];
    $u = $_POST['tenDanhMucSua'];

  //kiem tra DL nhap
  $sql1 = "select * from danhmuc where maDanhMuc = '$i'";
  $rs1 = mysqli_query($conn, $sql1);
  if (mysqli_num_rows($rs1) < 0) {
    $err['loi'] = 'Danh mục không tồn tại';
  }
  if (empty($err)) {
    
    $sql = "UPDATE danhMuc SET
        tenDanhMuc = '$u'
        WHERE maDanhMuc = '$i'";
        if($conn -> query($sql))
        $err['thongBao'] = "sua du lieu thanh cong";
  }
  header("location: quanLyDanhMuc.php");
}
?>