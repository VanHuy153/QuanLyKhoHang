<?php require 'login_sec.php';
checkLogin();
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">

<head>
 <?php
  require_once 'connect.php';
  $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
  if ($id) {
    $query = mysqli_query($conn, "select * from `sanpham` where maSanPham = " . $id);
    $data = array();
    if (mysqli_num_rows($query) > 0) {
      $row = mysqli_fetch_assoc($query);
      $data = $row;
    }
  } else $data = NULL;
  ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Didongthongminh - Thêm sản pham</title>

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
    <a class="brand-link">
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
                <a href="./QuanLySanPham.php" class="nav-link active">
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
                <a href="./PhanQuyenSuDung.php" class="nav-link">
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
            </div><!-- /.col -->
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="starter.php">Home</a></li>
                <li class="breadcrumb-item active"><a href="QuanLySanPham.php">Quản Lý Sản Phẩm</a></li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">Thêm sản phẩm</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                  <i class="fas fa-times"></i>
                </button>
              </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
              <div class="row">
                <div class="col-md-6" data-select2-id="41">
                  <form action="tuyChinhSanPham.php" method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                      <input hidden name="maSanPham" <?php if ($data) {
                                                        echo "value=\"" . $data['maSanPham'] . "\"";
                                                      } ?> class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập tên của sản phẩm...">
                    </div>
                    <div class="form-group">
                      <label>Chọn danh mục sản phẩm</label>
                      <select name="maDanhMuc" class=" form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <?php
                        $query = mysqli_query($conn, "select * from `danhmuc`");
                        while ($row = mysqli_fetch_array($query)) {
                        ?>
                          <option value="<?php echo $row['maDanhMuc']; ?>" <?php if ($data && $data['maDanhMuc'] == $row['maDanhMuc']) echo "selected" ?>><?php echo $row['tenDanhMuc']; ?></option>
                        <?php
                        }
                        ?>
                      </select>
                    </div>
                    <div class="form-group">
                      <label>Nhập tên sản phẩm</label>
                      <input name="tenSanPham" <?php if ($data) {
                                                  echo "value=\"" . $data['tenSanPham'] . "\"";
                                                } ?> class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập tên của sản phẩm...">
                    </div>
                    <div class="form-group">
                      <div class="form-group">
                        <label for="exampleInputFile">Tải lên ảnh sản phẩm</label>
                        <div class="input-group">
                          <div class="custom-file">
                            <input onchange="readURL(this)" name="anhMinhHoa" type="file" class="custom-file-input" id="exampleInputFile" <?php if ($data) {
                                                                                                                                            echo "value=\"" . $data['anhMinhHoa'] . "\"";
                                                                                                                                          } ?>>
                            <label id="tenAnh" class="custom-file-label" for="exampleInputFile"></label>
                          </div>
                          <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                          </div>
                        </div>
                      </div>
                    </div>
                    <!-- <div class="form-group">
                      <label>Chọn hãng sản phẩm</label>
                      <select name="maHangSX" class=" form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        
                      </select>
                    </div> -->
                    <div>
                      <label>Nhập dung lượng sản phẩm</label>
                      <input name="dungLuong" <?php if ($data) echo "value=\"" . $data['dungLuong'] . "\""; ?> class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập dung lượng của sản phẩm...">
                    </div>
                    <div class="form-group">
                      <label>Chọn màu sản phẩm</label>
                      <input name="mauSac" <?php if ($data) echo "value=\"" . $data['mauSac'] . "\""; ?> class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập dung lượng của sản phẩm...">
                    </div>
                    <div class="form-group">
                      <label>Mô tả sản phẩm</label>
                      <input name="moTa" <?php if ($data) echo "value=\"" . $data['moTa'] . "\""; ?> class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập dung lượng của sản phẩm...">
                    </div>
                    <div class="card-footer">
                      <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <img id="AnhMinhHoa" src="#" alt="anhMinhHoa" style=" position: relative; left: 50%;transform: translateX(-50%);" />
                  </div>
                </div>

                <!-- /.col -->
              </div>
              <!-- /.row -->
            </div>
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
          $('#AnhMinhHoa').attr('src', e.target.result).height(200);
        };
        reader.readAsDataURL(input.files[0]);
      }
    }
  </script>

</body>

</html>
