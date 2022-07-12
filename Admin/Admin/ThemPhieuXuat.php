<?php require 'login_sec.php';
checkLogin();
?>

<?php
include"ThuVien.php";
include"connect.php";
$err = []; 
if(!isset($_POST['soLuong'])&&empty($err))unset($_SESSION['sanphamxuat']);
if(!isset($_SESSION['sanphamxuat'])) $_SESSION['sanphamxuat']=[];
if (isset($_POST['btnSubmit'])) // Kiểm tra nút có giá trị dữ liệu
{   
    $m = $_POST['maphieu'];
    $l = $_POST['loaiXuat'];
    $nv = $_POST['maNV'];
    $nn = $_POST['benNhan'];
    $dc = $_POST['diaChi'];
    $sdt = $_POST['sdt'];
    $mk= $_POST['maKho'];
  if($_POST['btnSubmit'] == 'Thêm sản phẩm') 
  {
    
        $maSP=$_POST['maSP'];
        $dg = $_POST['donGia'];
        $sl = $_POST['soLuong'];
        if(empty($dg)){
          $err['dg'] = 'Không được bỏ trống';
        }
        if(empty($sl)){
          $err['sl'] = 'Không được bỏ trống';
        }
    if(empty($err)){
    //Lay du lieu tu POST
    if($l=='Hàng Thường'){
        $t=0;
        $query= mysqli_query($conn,"select tenSanPham from sanpham where maSanPham=$maSP");
        $row = mysqli_fetch_assoc($query);
        $tenSP = $row['tenSanPham'];
        $sql3="select * from sanpham_kho where maKho = '$mk'and maSanPham='$maSP'";
        $query3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($query3);
        for($i=0;$i<sizeof($_SESSION['sanphamxuat']);$i++){
            if($_SESSION['sanphamxuat'][$i][0]==$maSP&&($_SESSION['sanphamxuat'][$i][3]+$sl)<=$row3['soLuongCon']){
                $_SESSION['sanphamxuat'][$i][3]+=$sl;
                $t=1;
                break;
            }
        }
        if($t==0&&($sl<=$row3['soLuongCon'])){
            $sp = [$maSP,$tenSP,$sl,$dg];
            $_SESSION['sanphamxuat'][]=$sp; 
            $t=1;   
        }
        if($t==0){$err['slkd'] = 'Số lượng không đủ';}
        $check=1;
    }else{
      $t=0;
        $query= mysqli_query($conn,"select tenSanPham from sanpham where maSanPham=$maSP");
        $row = mysqli_fetch_assoc($query);
        $tenSP = $row['tenSanPham'];
        $sql3="select * from sanpham_kho where maKho = '$mk'and maSanPham='$maSP'";
        $query3 = mysqli_query($conn,$sql3);
        $row3 = mysqli_fetch_assoc($query3);
        for($i=0;$i<sizeof($_SESSION['sanphamxuat']);$i++){
            if($_SESSION['sanphamxuat'][$i][0]==$maSP&&($_SESSION['sanphamxuat'][$i][3]+$sl)<=$row3['soLuongLoi']){
                $_SESSION['sanphamxuat'][$i][3]+=$sl;
                $t=1;
                break;
            }
        }
        if($t==0&&$sl<=$row3['soLuongLoi']){
            $sp = [$maSP,$tenSP,$sl,$dg];
            $_SESSION['sanphamxuat'][]=$sp; 
            $t=1;   
        }
        if($t==0){$err['slkd'] = 'Số lượng không đủ';}
        $check=1;
    }
    
  }
}
 if($_POST['btnSubmit'] == 'Tạo phiếu') 
  {   
    $sql1 = "select * from hoadonxuathang where maDonXuat = '$m'";
    $rs1 = mysqli_query($conn,$sql1);
    if(mysqli_num_rows($rs1)>0){
        $err['MPtontai'] = 'Mã phiếu xuất đã tồn tại';
    }
    if(empty($nn)){
        $err['kbt1'] = 'Không được bỏ trống';
    }
    if(empty($dc)){
      $err['kbt2'] = 'Không được bỏ trống';
    }
    if(empty($err)){
      $sql0 = "INSERT INTO `hoadonxuathang` (`maDonXuat`, `loaiXuat`, `maNhanVien`, `maKho`, `nguoiNhan`, `diaChiGui`, `sdtGui`) 
      VALUES ('$m',  '$l', '$nv', '$mk', '$nn', '$dc', '$sdt');";
      $query = mysqli_query($conn,$sql0);
      for($i=0; $i<sizeof($_SESSION['sanphamxuat']);$i++){
        $sp=$_SESSION['sanphamxuat'][$i][0];
        $sl=$_SESSION['sanphamxuat'][$i][2];
        $dg=$_SESSION['sanphamxuat'][$i][3];
        $sql5 = "INSERT INTO `sanphamxuat` (`maDonXuat`,`maSanPham`, `soLuongXuat`, `donGiaXuat`) 
        VALUES ($m, $sp, $sl, $dg);";
        $query1 = mysqli_query($conn,$sql5);
        $sql3 = "select * from sanpham_kho where maKho=$mk and maSanPham=$sp";
        $rs3 = mysqli_query($conn,$sql3);
        if($l=='Hàng Thường'){
            mysqli_query($conn,"update sanpham_kho
            set soLuongCon = soLuongCon - $sl
            where maKho=$mk and maSanPham=$sp");
        }
        else{
          mysqli_query($conn,"update sanpham_kho
          set soLuongLoi = soLuongLoi - $sl
          where maKho=$mk and maSanPham=$sp");
        }
      }
      unset($_SESSION['sanphamxuat']);
      
      header("Location: TraCuuPhieuXuat.php");
    }
        //Thực hiện đoạn mã tiếp theo
  }
}
?>

<!DOCTYPE html>
<!--
This is a starter template page. Use this page to start your new project from
scratch. This page POSTs rid of all links and provides the needed markup only.
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
</head>

<body class="hold-transition sidebar-mini">
  <div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand navbar-white navbar-light">
      <!-- Left navbar links -->
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" data-widPOST="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
      </ul>

      <!-- Right navbar links -->
      <ul class="navbar-nav ml-auto">
        <!-- Navbar Search -->
        <li class="nav-item">
          <a class="nav-link" data-widPOST="navbar-search" href="#" role="button">
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
                  <button class="btn btn-navbar" type="button" data-widPOST="navbar-search">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
            </form>
          </div>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-widPOST="fullscreen" href="#" role="button">
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
        <div class="input-group" data-widPOST="sidebar-search">
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
        <ul class="nav nav-pills nav-sidebar flex-column" data-widPOST="treeview" role="menu" data-accordion="false">
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
                <a href="./TraCuuPhieuXuat.php" class="nav-link active">
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
            <h1 class="m-0">Xin chào, Admin</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="./starter.php">Home</a></li>
             <li class="breadcrumb-item active"><a href="./TraCuuPhieuNhap.php">Quản lý phiếu xuất</a></li>
             <li class="breadcrumb-item active">Thêm Phiếu Xuất</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
        
        <form action="" method="POST" role="form">
        <div class="card card-default">
          <div class="card-header">
            <h1 class="card-title">Thêm Phiếu Xuất</h1>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widPOST="collapse">
                <i class="fas fa-minus"></i>
              </button>
              <button type="button" class="btn btn-tool" data-card-widPOST="remove">
                <i class="fas fa-times"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" data-select2-id="41">
                  <div class="form-group">
                    <label>Mã Phiếu Xuất</label>
                    <input name= "maphieu" type="text" class="form-control" placeholder="Mã phiếu xuất..." value="<?php if(!empty($m))echo $m ?>"/>
                    <div style="color:red;">
                      <span><?php echo (isset($err['MPtontai']))?$err['MPtontai']:'' ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Loại Xuất</label>
                    <?php 
                    if (empty($_SESSION['sanphamxuat'])){
                      echo '
                      <select name = "loaiXuat" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                        <option data-select2-id="42">Hàng Thường</option>
                        <option data-select2-id="43">Hàng Lỗi</option>
                      </select>';}
                    else {
                      echo'<input name="loaiXuat" readonly="readonly" class="form-control select2 select2-hidden-accessible" type="text" value="'.$l.'"/>';
                    }
                    ?>
                  </div>
                  
                  <div class="form-group">
                    <label>Tên người nhận</label>
                    <input name='benNhan' class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập tên..." value="<?php if(isset($m))echo $nn ?>">
                    <div style="color: red">
                      <span><?php echo (isset($err['kbt1']))?$err['kbt1']:'' ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Địa chỉ người nhận</label>
                    <input name='diaChi' class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập địa chỉ..." value="<?php if(isset($m))echo $dc ?>">
                    <div style="color: red">
                      <span><?php echo (isset($err['kbt2']))?$err['kbt2']:'' ?></span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>SĐT người nhận</label>
                    <input name="sdt" class="form-control select2 select2-hidden-accessible" type="text" placeholder="Nhập SĐT..." value="<?php if(isset($m)) echo $sdt ?>">
                  </div>
                  
                  <div class="form-group">
                    <label>Mã kho</label>
                    <?php 
                    if(empty($_SESSION['sanphamxuat'])){
                    echo '<select name="maKho" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">';
                    require_once 'connect.php';
                          // Câu truy vấn lấy tất cả sinh viên
                          $sql = "select * from khohang";
                  
                          // Thực hiện câu truy vấn
                          $query = mysqli_query($conn, $sql);
                  
                          // Lặp qua từng record và đưa vào biến kết quả
                          if ($query){
                              $dem = 1;
                              while ($row = mysqli_fetch_assoc($query)){
                                ?>
                                <option value="<?php echo $row['maKho'] ?>">MK<?php echo $row['maKho'] ?></option>
                                <?php
                              }
                          }
                    echo '</select>';
                    }else{
                      echo'<input name="maKho" readonly="readonly" class="form-control select2 select2-hidden-accessible" type="text" value="'.$mk.'"/>';
                    }?>
                  </div>
                  <div class="form-group">
                    <label>Nhân viên lập hoá đơn</label>
                    <select name="maNV" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                      <?php
                          require_once 'connect.php';
                          // Câu truy vấn lấy tất cả sinh viên
                          $sql = "select * from nhanvien";
                  
                          // Thực hiện câu truy vấn
                          $query = mysqli_query($conn, $sql);
                  
                          // Lặp qua từng record và đưa vào biến kết quả
                          if ($query){
                              $dem = 1;
                              while ($row = mysqli_fetch_assoc($query)){
                                ?>
                                <option value="<?php echo $row['maNhanVien'] ?>"><?php echo $row['tenNhanVien'] ?></option>
                                <?php
                              }
                          }
                  
                        ?>
                    </select>
                  </div>
                
                <!-- /.form-group -->
                <!-- /.form-group -->
              </div>
              <!-- /.col -->

            </div>
            <!-- /.row -->
          </div>
          
          <!-- /.card-body -->
          <div class="card-header">
            <h1 class="card-title">Thêm sản phẩm</h1>
          </div>
          <!-- /.card-header -->
          
          <div class="card-body">
            <div class="row">
              <div class="col-md-6" data-select2-id="41">
                  <div class="form-group">
                    <label>Mã Hàng</label>
                    <select name="maSP" class="form-control select2 select2-hidden-accessible" style="width: 100%;" data-select2-id="1" tabindex="-1" aria-hidden="true">
                    <?php
                          require_once 'connect.php';
                          // Câu truy vấn lấy tất cả sinh viên
                          $sql = "select * from sanpham";
                  
                          // Thực hiện câu truy vấn
                          $query = mysqli_query($conn, $sql);
                  
                          // Lặp qua từng record và đưa vào biến kết quả
                          if ($query){
                              $dem = 1;
                              while ($row = mysqli_fetch_assoc($query)){
                                ?>
                                <option value="<?php echo $row['maSanPham'] ?>"><?php echo $row['tenSanPham'] ?></option>
                                <?php
                              }
                          }
                  
                        ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Đơn giá</label>
                    <input name="donGia" class="form-control select2 select2-hidden-accessible" type="text" placeholder="Đơn giá...">
                    <div style="color: red;">
                      <span><?php echo (isset($err['dg']))?$err['dg']:''; ?>
                    </span>
                    </div>
                  </div>
                  <div class="form-group">
                    <label>Số lượng</label>
                    <input name="soLuong" class="form-control select2 select2-hidden-accessible" type="text" placeholder="Số lượng...">
                    <div style="color: red">
                      <span><?php echo (isset($err['sl']))?$err['sl']:'';
                      echo (isset($err['slkd']))?$err['slkd']:'' ?></span>
                    </div>
                  </div>
                  <div class="mb-2">
                    <input type="submit" name="btnSubmit" id="btnSubmit" class="mt-4 btn btn-primary" value="Thêm sản phẩm" />
                  </div>
                <!-- /.form-group -->
                <!-- /.form-group -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
            <table id="example2" class="table table-bordered table-hover dataTable dtr-inline"
                                      aria-describedby="example2_info">
                                  <thead>
                                    <tr>
                                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Rendering engine: activate to sort column ascending">STT</th>
                                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Browser: activate to sort column ascending">Mã hàng</th>
                                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">Tên hàng</th>
                                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">Đơn giá</th>
                                      <th class="sorting sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Platform(s): activate to sort column descending" aria-sort="ascending">Số lượng</th>
                                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
                                          aria-label="Browser: activate to sort column ascending"> Thành tiền</th>
                                    </tr>
                                  </thead>
                                  <tbody>
            <?php
             showsessionspx();
            ?>
            </tbody>
            <tfoot>
            </tfoot>
          </table>
          <input type="submit" name="btnSubmit" id="btnSubmit" class="mt-4 btn btn-primary" value="Tạo phiếu" />
          </div>
          
          <!-- /.card-body -->
        </div>
        </form>  
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
