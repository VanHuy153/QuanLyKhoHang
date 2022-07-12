<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "quanlykhohang";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if ($conn) {
        echo "Kết nối thành công";
    } else {
        echo "Kết nối không thành công";
    }
?>