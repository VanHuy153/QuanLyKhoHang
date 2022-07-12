<?php require 'login_sec.php';
checkLogin();
?>
<?php
require_once 'connect.php';
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
if ($id) {
  $query = mysqli_query($conn, "select * from `nhanvien` where maNhanVien = " . $id);
  $data = array();
  if (mysqli_num_rows($query) > 0) {
    $row = mysqli_fetch_assoc($query);
    $data = $row;
  }
} else $data = NULL;
?>
<?php
if (!checkLoginHighAdmin()) {
  if ($data['quyenHan'] != 'Nhân viên' || $_SESSION['user']['quyenHan'] != 'Admin') {
    if ($_SESSION['user']['maNhanVien'] != $data['maNhanVien']) {
      $_SESSION['thongBao'] = 'Bạn không đủ quyền hạn';
      header("location: phanQuyenSuDung.php");

    }
  }
}

?>
<?php
require_once 'connect.php';
$err = [];
//Lay du lieu tu POST
if (isset($_POST['submit'])) {
  $id = $_POST['maNhanVien'];
  $u = $_POST['username'];
  $t = $_POST['tenNV'];
  $dc = $_POST['diaChi'];
  $sdt = $_POST['soDT'];
  $cccd = $_POST['CCCD'];
  $anhchandung = $u . $_FILES['anhChanDung']['name'];
  $tempname = $_FILES["anhChanDung"]["tmp_name"];
  $folder = "ADataImage/nhanVien/" . $anhchandung;
  $e = $_POST['email'];
  $p = $_POST['password'];
  $quyenHan = $_POST['quyenHan'];
  $chucVu = $_POST['chucVu'];
  if (empty($id)) {
    $sql1 = "select * from nhanvien where taiKhoanNhanVien = '$u'";
    $rs1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($rs1) > 0) {
      $err['TKtontai'] = 'Tài khoản đã tồn tại';
    }
    $sql2 = "select * from nhanvien where email = '$e'";
    $rs2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($rs2) > 0) {
      $err['Etontai'] = 'Email đã được sử dụng';
    }
    if (empty($err)) {
      $pass = password_hash($p, PASSWORD_DEFAULT);
      $sql0 = "INSERT INTO nhanvien(tenNhanVien,taiKhoanNhanVien,matKhau,diaChi,soDienThoai,canCuoc,email, anhChanDung, quyenHan, chucVu) VALUES('$t','$u','$pass','$dc','$sdt','$cccd','$e', '$folder', '$quyenHan', '$chucVu')";
      $query = mysqli_query($conn, $sql0);
      if (move_uploaded_file($tempname, $folder)) {

        //echo "Image uploaded successfully '$tempname'";
      } else {

        //echo "Failed to upload image";
      }
      if ($query) {
        header("Location: phanQuyenSuDung.php");
      }
    }
  } else {
    $sql1 = "select * from nhanvien where taiKhoanNhanVien = '$u' and maNhanVien <> '$id'";
    $rs1 = mysqli_query($conn, $sql1);
    if (mysqli_num_rows($rs1) > 0) {
      $err['TKtontai'] = 'Tài khoản đã tồn tại';
    }
    $sql2 = "select * from nhanvien where email = '$e' and maNhanVien <> '$id'";
    $rs2 = mysqli_query($conn, $sql2);
    if (mysqli_num_rows($rs2) > 0) {
      $err['Etontai'] = 'Email đã được sử dụng';
    }
    if (!empty($err)) {
    } else {
      $sqlanh = "";
      if ($tempname) {
        $sqlanh = "anhChanDung = '$folder',";
        $searchAnh = "SELECT * FROM nhanvien WHERE maNhanVien = " . $id;
        $query = mysqli_query($conn, $searchAnh);
        $data = array();
        if (mysqli_num_rows($query) > 0) {
          $row = mysqli_fetch_assoc($query);
          $data = $row;
        }
        if (!$data['anhChanDung']) {
          unlink("ADataImage/nhanVien/" . $data['anhChanDung']);
          echo "Xoa anh thanh cong";
        };
        if (move_uploaded_file($tempname, $folder)) {

          echo "Image uploaded successfully";
        } else {

          echo "Failed to upload image";
        }
      };
      $sqlmk = "";
      if (!empty($p)) {
        $pass = password_hash($p, PASSWORD_DEFAULT);
        $sqlmk = "matKhau = '$pass',";
      }
      $sql0 = "UPDATE nhanvien SET tenNhanVien = '$t',
                        taiKhoanNhanVien = '$u',
                        diaChi = '$dc',
                        soDienThoai = '$sdt',
                        canCuoc = '$cccd',
                        email = '$e',
                        " . $sqlanh . $sqlmk . " 
                        quyenHan = '$quyenHan',
                        chucVu = '$chucVu'
                        WHERE maNhanVien = '$id'";
      $query = mysqli_query($conn, $sql0);
      if ($query) {
        header("Location: phanQuyenSuDung.php");
      }
    }
  }
}


?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Didongthongminh - Nhân Viên</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widget="navbar-search" href="#" role="button">
            <i class="fas fa-search"></i>
          </a>
          <div class="navbar-search-block">
            <form class="form-inline">
              <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                  <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                  </button>
                  <button class="btn btn-navbar" type="button" data-widget="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widget="fullscreen" href="#" role="button">
            <i class="fas fa-expand-arrows-alt"></i>
          </a>
        </li>
      </ul>
    </nav>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <aside class="main-sidebar sidebar-dark-orange elevation-4">
      <!-- Brand Logo -->
      <a href="index3.html" class="brand-link">
        <img src="dist/img/Z.jpg" alt="Didongthongminh Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">Didongthongminh</span>
      </a>

      <!-- Sidebar -->
      <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
        <img src="<?php if(isset($_SESSION['user']['anhChanDung'])) echo $_SESSION['user']['anhChanDung']; else echo './dist/img/avatar.png'?>">
        </div>
        <div class="info">
             <a href="ThongTinNhanVien.php?id=<?php echo $_SESSION['user']['maNhanVien']?>"><?php echo $_SESSION['user']['tenNhanVien']?></a>
        </div>
      </div>
          <div class="user-panel d-flex" style="align-content: center">
              <a style="margin-left:75px;padding-bottom:20px;font-weight:bold" href="./DangXuat.php">Đăng Xuất</a>
           </div>

        <!-- SidebarSearch Form -->
        <div class="form-inline">
          <div class="input-group" data-widget="sidebar-search">
            <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
            <div class="input-group-append">
              <button class="btn btn-sidebar">
                <i class="fas fa-search fa-fw"></i>
              </button>
            </div>
          </div>
        </div>

        <!-- Sidebar Menu -->
        <nav class="mt-2">
          <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
           with font-awesome or any other icon font library -->
            <li class="nav-item menu-open">
              <a href="#" class="nav-link active">
                <i class="nav-icon fas fa-tachometer-alt"></i>
                <p>
                  Lựa chọn hành động
                  <i class="right fas fa-angle-left"></i>
                </p>
              </a>
              <ul class="nav nav-treeview">
                <li class="nav-item">
                  <a href="./QuanLySanPham.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quản lý sản phẩm</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./TraCuuPhieuNhap.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quản lý nhập</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./TraCuuPhieuXuat.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quản lý xuất</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./QuanLyTonKho.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quản lý kho</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./QuanLyDanhMuc.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Quản lý danh mục</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./ThongKeBaoCao.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Thống kê báo cáo</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./PhanQuyenSuDung.php" class="nav-link active">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Nhân Viên</p>
                  </a>
                </li>
                <li class="nav-item">
                  <a href="./BaoTriHeThong.php" class="nav-link">
                    <i class="far fa-circle nav-icon"></i>
                    <p>Bảo trì hệ thống</p>
                  </a>
                </li>
              </ul>
            </li>
          </ul>
        </nav>
        <!-- /.sidebar-menu -->
      </div>
      <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./starter.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="./phanQuyenSuDung.php">Quản Lý Nhân Viên</a></li>
                <li class="breadcrumb-item active">Thông tin Nhân Viên</li>
              </ol>
            </div>
          </div>
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Quản lý tài khoản nhân viên</h3>

              <!-- <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div> -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <form action="" method="POST" enctype="multipart/form-data">
                <div class="form-group text-center">
                  <H1 style="color: #ff6700;">Thiết lập tài khoản</H1>
                </div>
                <div class="mx-auto">
                  <img src="./dist/img/login-jpg-01.jpg" width="100%" alt="">
                </div>
                <div id="img-login">

                  <div class="row">
                    <div class="col-md-5">
                      <input type="hidden" class="form-control" name="maNhanVien" value="<?php if ($data) echo $data['maNhanVien'] ?>">

                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Tài khoản</h6>
                          </label>
                          <input type="text" class="form-control" name="username" id="username" required placeholder="Tài khoản" value="<?php if (isset($u)) {
                                                                                                                                          echo $u;
                                                                                                                                        } else {
                                                                                                                                          if ($data) echo $data['taiKhoanNhanVien'];
                                                                                                                                        } ?>">
                          <div class="has-error">
                            <span><?php echo (isset($err['TKtontai'])) ? $err['TKtontai'] : '' ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <label for="password" class="form-label">
                          <h6>Mật khẩu</h6>
                        </label>
                        <input type="password" class="form-control" name="password" id="password" placeholder="Mật khẩu">
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Email</h6>
                          </label>
                          <input type="text" class="form-control" name="email" id="email" required placeholder="Email" value="<?php if (isset($e)) echo $e;
                                                                                                                              else if ($data) echo $data['email']; ?>">
                          <div class="has-error">
                            <span><?php echo (isset($err['Etontai'])) ? $err['Etontai'] : '' ?></span>
                          </div>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Số điện thoại</h6>
                          </label>
                          <input type="text" class="form-control" name="soDT" id="soDT" required placeholder="Số điện thoại" value="<?php if (isset($sdt)) echo $sdt;
                                                                                                                                    else if ($data) echo $data['soDienThoai']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label class="form-lable">
                            <h6>Quyền cấp</h6>
                          </label>
                          <select name="quyenHan" class="form-control" <?php if ($_SESSION['user']['maNhanVien'] != '1' || $data['maNhanVien'] == '1') echo 'disabled' ?>>
                            <option>Admin</option>
                            <option <?php if ($data && $data['quyenHan'] == 'Nhân viên') echo 'selected' ?>>Nhân viên</option>
                          </select>
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Chức vụ</h6>
                          </label>
                          <input type="text" class="form-control" name="chucVu" id="chucVu" required placeholder="Chức vụ" value="<?php if (isset($sdt)) echo $sdt;
                                                                                                                                  else if ($data) echo $data['chucVu']; ?>">
                        </div>
                      </div>
                    </div>
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <div class="inner-addon left-addon" style="position: relative; height: 165px;">
                          <h6>Ảnh đại diện</h6>
                          <input type="file" onchange="readURL(this)" name="anhChanDung" id="tenNV" style="height: 140px; width: 100%; opacity: 0; z-index: 1; position: relative;">
                          <img id="anhDaiDien" src="<?php if ($data) echo $data['anhChanDung'];
                                                    else echo 'Sleepy Kokomi.png' ?>" alt="" style="position: absolute;height: 140px; left: 30%;transform: translate(-50%, 0); z-index: 0;">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Họ và tên</h6>
                          </label>
                          <input type="text" class="form-control" name="tenNV" id="tenNV" required placeholder="Họ tên" value="<?php if (isset($t)) echo $t;
                                                                                                                                else if ($data) echo $data['tenNhanVien']; ?>">
                        </div>
                      </div>
                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Địa chỉ</h6>
                          </label>
                          <input type="text" class="form-control" name="diaChi" id="diaChi" required placeholder="Địa chỉ" value="<?php if (isset($dc)) echo $dc;
                                                                                                                                  else if ($data) echo $data['diaChi']; ?>">
                        </div>
                      </div>

                      <div class="form-group">
                        <div class="inner-addon left-addon">
                          <label for="usename" class="form-label">
                            <h6>Căn cước công dân</h6>
                          </label>
                          <input type="text" class="form-control" name="CCCD" id="CCCD" required placeholder="Số căn cước công dân" value="<?php if (isset($cccd)) echo $cccd;
                                                                                                                                            else if ($data) echo $data['canCuoc']; ?>">
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="card-footer">
                  <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>

            <!-- /.form-group -->
            <!-- /.form-group -->

            <!-- /.col -->

            <!-- /.row -->

            <!-- /.card-body -->
          </div>
        </div><!-- /.container-fluid -->
      </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
      <!-- Control sidebar content goes here -->
      <div class="p-3">
        <h5>Title</h5>
        <p>Sidebar content</p>
      </div>
    </aside>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <footer class="main-footer">
      <strong>Didongthongminh <a href="https:/Didongthongminh.com"></a></strong>
    </footer>
  </div>
  <!-- ./wrapper -->

  <!-- REQUIRED SCRIPTS -->

  <!-- jQuery -->
  <script src="plugins/jquery/jquery.min.js"></script>
  <!-- Bootstrap 4 -->
  <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <script>
    function readURL(input) {
      if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function(e) {
          $('#anhDaiDien').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>
</body>

</html>
