<?php
require_once 'connect.php';
if (isset($_POST['submit'])) {
    $maSanPham = $_POST['maSanPham'];
    $tenSanPham = $_POST['tenSanPham'];
    $dungLuong = $_POST['dungLuong'];
    $maDanhMuc = $_POST['maDanhMuc'];
    $mauSac = $_POST['mauSac'];
    $anhMinhHoa = $maSanPham . $_FILES['anhMinhHoa']['name'];
    $tempname = $_FILES["anhMinhHoa"]["tmp_name"];
    $folder = "ADataImage/sanPham/" . $anhMinhHoa;
    $moTa = $_POST['moTa'];
    if (empty($maSanPham)) {
        if ($conn->query("INSERT INTO sanPham(maSanPham, tenSanPham, dungLuong, maDanhMuc, mauSac, anhMinhHoa, moTa) 
                                VALUES (NULL,'$tenSanPham','$dungLuong','$maDanhMuc','$mauSac','$folder','$moTa')"))
            echo "them du lieu thanh cong";
        if (move_uploaded_file($tempname, $folder)) {

            $msg = "Image uploaded successfully";
        } else {

            $msg = "Failed to upload image";
        }
    } else {
        $sqlanh = "";
        if ($tempname) {
            $sqlanh = "anhMinhHoa = '$folder',";
            $searchAnh = "SELECT * FROM sanPham WHERE maSanPham = " . $maSanPham;
            $query = mysqli_query($conn, $searchAnh);
            $data = array();
            if (mysqli_num_rows($query) > 0) {
                $row = mysqli_fetch_assoc($query);
                $data = $row;
            }
            if (unlink("ADataImage/sanPham/" . $data['anhMinhHoa'])) {
                echo "Xoa anh thanh cong";
            };
        };
        $sql = "UPDATE sanpham SET
        tenSanPham = '$tenSanPham',
        dungLuong = '$dungLuong',
        maDanhMuc = '$maDanhMuc',
        mauSac = '$mauSac',
        " . $sqlanh . "
        moTa = '$moTa'
        WHERE maSanPham = '$maSanPham'";
        if ($conn->query($sql))
            echo "sua du lieu thanh cong";
    }
    header("location: themsanpham.php");
    if (move_uploaded_file($tempname, $folder)) {

        $msg = "Image uploaded successfully";
    } else {

        $msg = "Failed to upload image";
    }
    header("location: quanLySanPham.php");
}
