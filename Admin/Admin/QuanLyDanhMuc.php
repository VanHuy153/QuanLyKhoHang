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

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Didongthongminh - Quản lý danh mục</title>
  <?php require_once 'connect.php' ?>
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
                <a href="./QuanLyTonKho.php" class="nav-link ">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Quản lý kho</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./QuanLyDanhMuc.php" class="nav-link active">
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
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý danh mục</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="./starter.php">Home</a></li>
                <li class="breadcrumb-item active">Quản lý danh mục</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <?php
                    $id = isset($_GET['id']) ? (int)$_GET['id'] : '';
                    if(!$id) echo '<form action="themDanhMuc.php" method="POST" role="form">';
                    else echo '<form action="suaDanhMuc.php" method="POST" role="form">';
                  ?>
                  
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                        <tr>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Rendering engine: activate to sort column ascending">STT</th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Ten danh mục</th>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">
                            Số sản phẩm
                          </th>
                          <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Browser: activate to sort column ascending">Sửa</th>
                          <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">
                            Xóa
                          </th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                        $sql = "select * from danhmuc";
                        $query = mysqli_query($conn, $sql);
                        $dem = 1;
                        if ($query) {
                          while ($row = mysqli_fetch_assoc($query)) {
                            if($id != $row['maDanhMuc']){
                        ?>
                            <tr>
                              <td><?php echo $dem++ ?></td>
                              <td><?php echo $row['tenDanhMuc'] ?></td>
                              <td>
                                <?php
                                $sql2 = "SELECT COUNT(maSanPham) AS SoLuongSP FROM sanpham where maDanhMuc = " . $row['maDanhMuc'];
                                $rs2 = mysqli_query($conn, $sql2);
                                $slsp = mysqli_fetch_assoc($rs2);
                                echo $slsp['SoLuongSP'];
                                ?>
                              </td>
                              <td><a href="QuanLyDanhMuc.php?id=<?php echo $row['maDanhMuc'] ?>">Sửa</a></td>
                              <td><a href="xoaDanhMuc.php?id=<?php echo $row['maDanhMuc'] ?>">Xóa</a></td>
                            </tr>
                        <?php
                            }
                            else{
                              ?> 
                                <td><?php echo $dem++ ?></td>
                                <td>
                                  <input type="hidden" value="<?php echo $id ?>" name="maDanhMucSua">
                                  <input type="text" name="tenDanhMucSua" value="<?php echo $row['tenDanhMuc'] ?>" class="form-control" id="exampleInputEmail1" placeholder="Iphone..."></td>
                                <td>
                                <button>Sửa</button>
                                </td>
                                <td></td>
                                <td></td>
                              <?php
                            }
                          }
                        }

                        ?>

                      </tbody>

                      <tfoot>
                        <?php
                          if(!$id){
                        ?>
                        <tr>
                          <th rowspan="1" colspan="1">Thêm danh mục</th>
                          <th rowspan="1" colspan="1">
                            <input type="text" name="tenDanhMucThem" class="form-control" id="exampleInputEmail1" placeholder="Iphone...">
                          </th>
                          <th rowspan="1" colspan="1"><button>Thêm</button></th>

                          <th></th>
                          <th></th>
                        </tr>
                        <?php
                          }
                          ?>
                      </tfoot>

                    </table>
                  </form>
                  <div class="has-error">
                    <span><?php echo (isset($err['loi'])) ? $err['loi'] : '' ?></span>
                  </div>
                  <div class="has-success" style="color: green;">
                    <span><?php echo (isset($err['thongBao'])) ? $err['thongBao'] : '' ?></span>
                  </div>

                </div>
                <!-- /.card-body -->
              </div>
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>

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
  <!-- DataTables  & Plugins -->
  <script src="plugins/datatables/jquery.dataTables.min.js"></script>
  <script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
  <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
  <script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
  <script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script src="plugins/jszip/jszip.min.js"></script>
  <script src="plugins/pdfmake/pdfmake.min.js"></script>
  <script src="plugins/pdfmake/vfs_fonts.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.html5.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
  <script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
  <!-- AdminLTE App -->
  <script src="dist/js/adminlte.min.js"></script>
  <!-- AdminLTE for demo purposes -->
  <script src="dist/js/demo.js"></script>
  <!-- Page specific script -->
  <script>
    $(function () {
      $("#example1").DataTable({
        "responsive": true, "lengthChange": false, "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
      $('#example2').DataTable({
        "paging": true,
        "lengthChange": false,
        "searching": false,
        "ordering": true,
        "info": true,
        "autoWidth": false,
        "responsive": true,
      });
    });
  </script>
</body>
</html>
