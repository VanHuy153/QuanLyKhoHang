<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "quanlykhohang";

    $conn = mysqli_connect($servername, $username, $password, $database);
    if ($conn) {
        echo "";
    } else {
        echo "Kết nối không thành công";
    }
?>