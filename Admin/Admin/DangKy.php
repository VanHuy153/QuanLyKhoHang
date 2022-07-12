<?php require 'login_sec.php';
checkLogin();
checkLoginAdmin();
?>
<?php
    $err = [];
    //Lay du lieu tu POST
    if(isset($_POST['username'])){
        $u = $_POST['username'];
        $t = $_POST['tenNV'];
        $dc = $_POST['diaChi'];
        $sdt = $_POST['soDT'];
        $cccd = $_POST['CCCD'];
        $e = $_POST['email'];
        $p = $_POST['password'];
        $rp = $_POST['rpassword'];
        //Ket Noi CSDL
        require_once("connect.php");
        //kiem tra DL nhap

        $sql1 = "select * from nhanvien where taiKhoanNhanVien = '$u'";
        $rs1 = mysqli_query($conn,$sql1);
        if(mysqli_num_rows($rs1)>0){
            $err['TKtontai'] = 'Tài khoản đã tồn tại';
        }
        $sql2 = "select * from nhanvien where email = '$e'";
        $rs2 = mysqli_query($conn,$sql2);
        if(mysqli_num_rows($rs2)>0){
            $err['Etontai'] = 'Email đã được sử dụng';
        }
        if($p != $rp){
            $err['rp'] = 'Mật khẩu nhập lại không đúng';
        }
        if(empty($err)){
            $pass = password_hash($p,PASSWORD_DEFAULT);
            $sql0 = "INSERT INTO nhanvien(tenNhanVien,taiKhoanNhanVien,matKhau,diaChi,soDienThoai,canCuoc,email, quyenHan) VALUES('$t','$u','$pass','$dc','$sdt','$cccd','$e', 'Nhân viên')";
            $query = mysqli_query($conn,$sql0);
            if($query){
                header("Location: PhanQuyenSuDung.php");
            }
        }
    }
?>


<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Di Động Thông | Đăng Ký</title>
    <link rel="shortcut icon" href="./dist/img/Z.jpg" />
    <link rel="icon" type="image/vnd.microsoft.icon" href="./dist/img/Z.jpg" />
    <!-- Tell the browser to be responsive to screen width -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
   
    <style>
        * {
            margin: 0;
            padding: 0;
        }
        body {
            background: url(./dist/img/background-03.jpg);
            background-size: cover;
        }
        .btnlogin{
            width: 100%;
            margin-top: 5px;
        }
        .form-group{
            padding: 5px 0px;
        }
        .card{
            border: 0px;
        }
        #img-login{
            margin-top: 50px;
        }
        .form-group h1{
            color: #ff6700;
        }
        .has-error{
            color:red;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="img-background">
                    <div id="img-login">
                        
                        <div class="row">
                            <div class="card p-4 mt-4 col-md-6 mx-auto">
                                <form action="" method="POST" role="form">
                                    <div class="mx-auto" >
                                        <img src="./dist/img/login-jpg-01.jpg" width="100%" alt="">
                                    </div>
                                    <div class="form-group text-center">
                                            <H1>Đăng Ký Tài Khoản</H1>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Tài khoản</h6></label>
                                            <input type="text" class="form-control" name="username" id="username" required placeholder="Tài khoản" value="<?php if(isset($u))echo $u ?>">
                                            <div class="has-error">
                                                <span><?php echo (isset($err['TKtontai']))?$err['TKtontai']:'' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Họ và tên</h6></label>
                                            <input type="text" class="form-control" name="tenNV" id="tenNV" required placeholder="Họ tên" value="<?php if(isset($t))echo $t ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Địa chỉ</h6></label>
                                            <input type="text" class="form-control" name="diaChi" id="diaChi" required placeholder="Địa chỉ" value="<?php if(isset($dc))echo $dc ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Số điện thoại</h6></label>
                                            <input type="text" class="form-control" name="soDT" id="soDT" required placeholder="Số điện thoại" value="<?php if(isset($sdt))echo $sdt ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Căn cước công dân</h6></label>
                                            <input type="text" class="form-control" name="CCCD" id="CCCD" required placeholder="Số căn cước công dân" value="<?php if(isset($cccd))echo $cccd ?>">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Email</h6></label>
                                            <input type="text" class="form-control" name="email" id="email" required placeholder="Email" value="<?php if(isset($e))echo $e ?>">
                                            <div class="has-error">
                                                <span><?php echo (isset($err['Etontai']))?$err['Etontai']:'' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label"><h6>Mật khẩu</h6></label>
                                        <input type="password" class="form-control" name="password" id="password" required placeholder="Mật khẩu">
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label"><h6>Nhập lại mật khẩu</h6></label>
                                        <input type="password" class="form-control" name="rpassword" id="rpassword" required placeholder="Nhập lại mật khẩu">
                                        <div class="has-error"><span><?php echo (isset($err['rp']))?$err['rp']:'' ?></span></div>
                                    </div>

                                <button type="submit" class="btn btn-flat btnlogin btn-primary btn-block">Đăng Ký</button>
                                <div class="form-group">
                                    <div class="text-center"><a href="DangNhap.php">Đăng nhập</a></div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
