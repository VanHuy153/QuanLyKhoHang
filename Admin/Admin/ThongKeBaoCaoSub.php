<?php require 'login_sec.php';
checkLogin();
?>

<?php
include"ThuVien.php";
include"connect.php";
$id = isset($_GET['id']) ? (int)$_GET['id'] : '';
$err = []; 
if($id==1){
  if(isset($_POST['nam'])){
    $thang=$_POST['thang'];
    $nam=$_POST['nam'];
    if($thang==0){
      $err['thang'] = 'Bạn chưa chọn tháng';
    }
    if($nam==0){
      $err['nam'] = 'Bạn chưa chọn năm';
    }
  }
}else{
  if(isset($_POST['nam'])){
    $nam=$_POST['nam'];
    if($nam==0){
      $err['nam'] = 'Bạn chưa chọn năm';
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
  <title>Didongthongminh - StarterPage</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <style>
        table,th,td{
          text-align: center;
      }
  </style>
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
                  <a href="./ThongKeBaoCao.php" class="nav-link active">
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
                <li class="breadcrumb-item"><a href="./starter.php">Home</a></li>
                <li class="breadcrumb-item active">Thống kê báo cáo</li>
              </ol>
            </div><!-- /.col -->
          </div><!-- /.row -->
          <div class="card card-default">
            <div class="card-header">
              <h3 class="card-title">
                  <?php
                  if(isset($id)&&$id==1)
                      echo'Thống Kê Báo Cáo Theo Tháng';
                  else
                    echo'Thống Kê Báo Cáo Theo Năm';
                  ?>
              </h3>

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
                  <form action="" method="POST" role="form">
                    <?php
                    if(isset($id)&&$id==1){
                      ?>
                      <div class="form-group">
                      <label>Tháng:</label>
                      <select name="thang" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected hidden value="0">Choose here</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                        <option value="6">6</option>
                        <option value="7">7</option>
                        <option value="8">8</option>
                        <option value="9">9</option>
                        <option value="10">10</option>
                        <option value="11">11</option>
                        <option value="12">12</option>
                      </select>
                    <div style="color: red">
                      <span><?php echo (isset($err['thang']))?$err['thang']:'' ?></span>
                    </div>
                    </div>
                      <div class="form-group">
                      <label>Năm:</label>
                      <select name="nam" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected hidden value="0">Choose here</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                      <div style="color: red">
                      <span><?php echo (isset($err['nam']))?$err['nam']:'' ?></span>
                    </div>
                    </div><?php
                    }
                    else  if(isset($id)&&$id==2){?>
                      <div class="form-group">
                      <label>Năm:</label>
                      <select name="nam" class="form-control select2 select2-hidden-accessible" style="width: 100%;" tabindex="-1" aria-hidden="true">
                        <option selected hidden value="0">Choose here</option>
                        <option value="2019">2019</option>
                        <option value="2020">2020</option>
                        <option value="2021">2021</option>
                        <option value="2022">2022</option>
                      </select>
                      <div style="color: red">
                      <span><?php echo (isset($err['nam']))?$err['nam']:'' ?></span>
                    </div>
                    </div><?php
                    }
                    ?>
                    
                    
                    <div class="card-footer">
                      <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                  </form>

                  <!-- /.form-group -->
                  <!-- /.form-group -->
                </div>
                <!-- /.col -->
              </div>
              <!-- /.row -->
              <?php
                if($id==1&&isset($nam)&&empty($err)&&isset($thang)){
                    showBCTKTT($thang,$nam);
                }else if($id==2&&empty($err)&&isset($nam)){
                    showBCTKTN($nam);
                }
              ?>
              
            </div>
            <!-- /.card-body -->
          </div>
        </div><!-- /.container-fluid -->
      </div>
    </div>
    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark-orange">
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
</body>

</html>
