<?php
    session_start();
    $err = [];
    //Lay du lieu tu POST
    if(isset($_POST['username'])){
        $u = $_POST['username'];
        $p = $_POST['password'];
        //Ket Noi CSDL
        require_once("connect.php");
        // truy van Du lieu
        $sql = "select * from nhanvien where taiKhoanNhanVien = '$u'";
        //thuc thi
        $rs = mysqli_query($conn,$sql);
        $data = mysqli_fetch_assoc($rs);
        if(mysqli_num_rows($rs)>0){
            $checkPass = password_verify($p, $data['matKhau']);
            if($checkPass){
                $_SESSION['user'] = $data;
                unset($_SESSION['thongBao']);
                header("Location: starter.php");
            }
            else{
                $err['MKsai'] = 'Sai mật khẩu';
            }
        }else{
            $err['TKkott'] = 'Tài khoản không tồn tại';
        }
    } 
?>

<!DOCTYPE html>
<html>
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Di Động Thông Minhv | Đăng Nhập</title>
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
            background: url(./dist/img/bglogin.jpg);
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
                        <img src="./dist/img/login2.jpg" width="85%"  style="position:absolute;" class="hidden-xs hidden-sm" />
                        <div class="row">
                            <div class="col-md-6">
                                <div class="divlogo" style="text-align:center">
                            </div   >
                            <div class="card p-4 mt-4">
                                <form action="" method="POST" role="form">
                                    <img src="./dist/img/login1.jpg" width="100%" alt="">
                                    <div class="form-group">
                                            <H1>Đăng Nhập</H1>
                                    </div>
                                    <div class="form-group">
                                        <div class="inner-addon left-addon">
                                            <label for="usename" class="form-label"><h6>Username</h6></label>
                                            <input type="text" class="form-control" name="username" id="username" required placeholder="Username">
                                            <div class="has-error">
                                                <span><?php echo (isset($err['TKkott']))?$err['TKkott']:'' ?></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password" class="form-label"><h6>Password</h6></label>
                                        <input type="password" class="form-control" name="password" id="password" required placeholder="Password">
                                        <div class="has-error">
                                            <span><?php echo (isset($err['MKsai']))?$err['MKsai']:'' ?></span>
                                            <span><?php echo (isset($_SESSION['thongBao']))?$_SESSION['thongBao']:'' ?></span>
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-flat btnlogin btn-primary btn-block"> Đăng Nhập </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
