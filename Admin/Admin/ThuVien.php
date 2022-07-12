<?php
function showsessionspx(){
    if(isset($_SESSION['sanphamxuat'])&&is_array($_SESSION['sanphamxuat'])){
        for($i=0; $i<sizeof($_SESSION['sanphamxuat']);$i++){
            echo '
            <tr class="odd">
                <td class="dtr-control">'.($i+1).'</td>
                <td class="sorting_1">'.$_SESSION['sanphamxuat'][$i][0].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamxuat'][$i][1].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamxuat'][$i][2].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamxuat'][$i][3].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamxuat'][$i][2]*$_SESSION['sanphamxuat'][$i][3].'</td>
            </tr>';
        }
    }
}
function showsessionspn(){
    if(isset($_SESSION['sanphamnhap'])&&is_array($_SESSION['sanphamnhap'])){
        for($i=0; $i<sizeof($_SESSION['sanphamnhap']);$i++){
            echo '
            <tr class="odd">
                <td class="dtr-control">'.($i+1).'</td>
                <td class="sorting_1">'.$_SESSION['sanphamnhap'][$i][0].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamnhap'][$i][1].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamnhap'][$i][2].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamnhap'][$i][3].'</td>
                <td class="sorting_1">'.$_SESSION['sanphamnhap'][$i][2]*$_SESSION['sanphamnhap'][$i][3].'</td>
            </tr>';
        }
    }
}
function showBCTKTT($thang, $nam){
    include'connect.php';
    $sql = "select maSanPham, tenSanPham from sanpham";
    $query = mysqli_query($conn, $sql);
    ?>
    <H1 style="text-align: center;">BÁO CÁO NHẬP XUẤT TỒN Tháng <?php echo $thang ?> NĂM <?php echo $nam ?></H1>
    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
    <thead>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">STT</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tên hàng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tồn đầu kì</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
            aria-label="Rendering engine: activate to sort column ascending">Nhập</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
            aria-label="Rendering engine: activate to sort column ascending">Xuất</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tồn cuối kì</th>
      </tr>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Thành tiền</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Thành tiền</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $stt=1;
    $tongsldk=0;
    $tongsln=0;
    $tongttn=0;
    $tongslx=0;
    $tongttx=0;
    $tongslck=0;
    while ($row = mysqli_fetch_assoc($query)){
        $maSP=$row['maSanPham'];
        $sqlnhap="SELECT maSanPham,SUM(soLuongNhap) AS'sl',SUM(donGiaNhap*soLuongNhap) AS'tt' FROM `sanphamnhap` 
        JOIN `hoadonnhaphang` ON sanphamnhap.maHoaDonNhap=hoadonnhaphang.maHoaDonNhap WHERE maSanPham=$maSP 
        AND YEAR(ngayLapDonNhap)=$nam AND MONTH(ngayLapDonNhap)=$thang AND TrangThai='Đã nhập'";
        $querynhap=mysqli_query($conn,$sqlnhap);
        $rownhap = mysqli_fetch_assoc($querynhap);
        if(!empty($rownhap['sl'])){
            $sln=$rownhap['sl'];
            $ttn=$rownhap['tt'];
        }else{
            $sln=0;
            $ttn=0;
        }
        $sqlxuat="SELECT maSanPham,SUM(soLuongXuat) AS'sl',SUM(donGiaXuat*soLuongXuat) AS'tt' FROM `sanphamxuat` 
        JOIN `hoadonxuathang` ON sanphamxuat.maDonXuat=hoadonxuathang.maDonXuat WHERE maSanPham=$maSP 
        AND YEAR(ngayLapHoaDonXuat)=$nam AND MONTH(ngayLapHoaDonXuat)=$thang AND TrangThai='Đã xuất'";
        $queryxuat=mysqli_query($conn,$sqlxuat);
        $rowxuat = mysqli_fetch_assoc($queryxuat);
        if(!empty($rowxuat['sl'])){
            $slx=$rowxuat['sl'];
            $ttx=$rowxuat['tt'];
        }else{
            $slx=0;
            $ttx=0;
        }
        if($thang==12){
            $ngay=($nam+1).'-01-01';
        }else{
            $ngay=$nam.'-'.($thang+1).'-01';
        }
        
        $sqlnhap2="SELECT maSanPham,SUM(soLuongNhap) AS'sl' FROM `sanphamnhap` 
        JOIN `hoadonnhaphang` ON sanphamnhap.maHoaDonNhap=hoadonnhaphang.maHoaDonNhap WHERE maSanPham=$maSP 
        AND ngayLapDonNhap>='$ngay' AND TrangThai='Đã nhập'";
        $querynhap2=mysqli_query($conn,$sqlnhap2);
        $rownhap2 = mysqli_fetch_assoc($querynhap2);
        if(!empty($rownhap2['sl'])){
            $sln2=$rownhap2['sl'];
        }else{
            $sln2=0;
        }
        
        $sqlxuat2="SELECT maSanPham,SUM(soLuongXuat) AS'sl' FROM `sanphamxuat` 
        JOIN `hoadonxuathang` ON sanphamxuat.maDonXuat=hoadonxuathang.maDonXuat WHERE maSanPham=$maSP 
        AND ngayLapHoaDonXuat>='$ngay' AND TrangThai='Đã xuất'";
        $queryxuat2=mysqli_query($conn,$sqlxuat2);
        $rowxuat2 = mysqli_fetch_assoc($queryxuat2);
        if(!empty($rowxuat2['sl'])){
            $slx2=$rowxuat2['sl'];
            
        }else{
            $slx2=0;
        }
        $sqlton="SELECT maSanPham,SUM(soLuongCon+soLuongLoi)as'slt' FROM `sanpham_kho` WHERE maSanPham=$maSP";
        $queryton=mysqli_query($conn,$sqlton);
        $rowton = mysqli_fetch_assoc($queryton);
        if(!empty($rowton['slt'])){
            $slt=$rowton['slt'];
        }else{
            $slt=0;
        }
        $sltck=$slt+$slx2-$sln2;
        $sltdk=$sltck+$slx-$sln;
        ?>
            <tr>
              <td class="dtr-control"><?php echo $stt ?></td>
              <td class="sorting_1"><?php echo $row['tenSanPham'] ?></td>
              <td class="sorting_1"><?php echo $sltdk ?></td>
              <td class="sorting_1"><?php echo $sln ?></td>
              <td class="sorting_1"><?php echo $ttn ?></td>
              <td class="sorting_1"><?php echo $slx ?></td>
              <td class="sorting_1"><?php echo $ttx ?></td>
              <td class="sorting_1"><?php echo $sltck ?></td>
            </tr>
        <?php
        $tongsldk+=$sltdk;
        $tongsln+=$sln;
        $tongttn+=$ttn;
        $tongslx+=$slx;
        $tongttx+=$ttx;
        $tongslck+=$sltck;
        $stt++;
      }?>   
      <tr>
        <th colspan="2">Tổng</th>
        <td class="sorting_1"><?php echo $tongsldk ?></td>
        <td class="sorting_1"><?php echo $tongsln ?></td>
        <td class="sorting_1"><?php echo $tongttn ?></td>
        <td class="sorting_1"><?php echo $tongslx ?></td>
        <td class="sorting_1"><?php echo $tongttx ?></td>
        <td class="sorting_1"><?php echo $tongslck ?></td>
      </tr>
      <?php
    if(($tongttn-$tongttx)>0){
      echo'
        <tr>
            <th colspan="8">Lỗ: '.$tongttn-$tongttx.' VND</th>
        </tr>';
    }else{
        echo'
        <tr>
            <th colspan="8">Lãi: '.$tongttx-$tongttn.' VND</th>
        </tr>';
    }

    echo'
    </tbody>
    </table>';
}
function showBCTKTN($nam){
    include'connect.php';
    $sql = "select maSanPham, tenSanPham from sanpham";
    $query = mysqli_query($conn, $sql);
    ?>
    <H1 style="text-align: center;">BÁO CÁO NHẬP XUẤT TỒN NĂM <?php echo $nam ?></H1>
    <table id="example2" class="table table-bordered table-hover dataTable dtr-inline" aria-describedby="example2_info">
    <thead>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">STT</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="2" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tên hàng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tồn đầu kì</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
            aria-label="Rendering engine: activate to sort column ascending">Nhập</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="2"
            aria-label="Rendering engine: activate to sort column ascending">Xuất</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Tồn cuối kì</th>
      </tr>
      <tr>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Thành tiền</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Thành tiền</th>
        <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1"
            aria-label="Rendering engine: activate to sort column ascending">Số lượng</th>
      </tr>
    </thead>
    <tbody>
    <?php
    $stt=1;
    $tongsldk=0;
    $tongsln=0;
    $tongttn=0;
    $tongslx=0;
    $tongttx=0;
    $tongslck=0;
    while ($row = mysqli_fetch_assoc($query)){
        $maSP=$row['maSanPham'];
        $sqlnhap="SELECT maSanPham,SUM(soLuongNhap) AS'sl',SUM(donGiaNhap*soLuongNhap) AS'tt' FROM `sanphamnhap` 
        JOIN `hoadonnhaphang` ON sanphamnhap.maHoaDonNhap=hoadonnhaphang.maHoaDonNhap 
        WHERE maSanPham=$maSP AND YEAR(ngayLapDonNhap)=$nam AND TrangThai='Đã nhập'";
        $querynhap=mysqli_query($conn,$sqlnhap);
        $rownhap = mysqli_fetch_assoc($querynhap);
        if(!empty($rownhap['sl'])){
            $sln=$rownhap['sl'];
            $ttn=$rownhap['tt'];
        }else{
            $sln=0;
            $ttn=0;
        }
        $sqlxuat="SELECT maSanPham,SUM(soLuongXuat) AS'sl',SUM(donGiaXuat*soLuongXuat) AS'tt' FROM `sanphamxuat` 
        JOIN `hoadonxuathang` ON sanphamxuat.maDonXuat=hoadonxuathang.maDonXuat WHERE maSanPham=$maSP 
        AND YEAR(ngayLapHoaDonXuat)=$nam AND TrangThai='Đã xuất'";
        $queryxuat=mysqli_query($conn,$sqlxuat);
        $rowxuat = mysqli_fetch_assoc($queryxuat);
        if(!empty($rowxuat['sl'])){
            $slx=$rowxuat['sl'];
            $ttx=$rowxuat['tt'];
        }else{
            $slx=0;
            $ttx=0;
        }
        $ngay=($nam+1).'-01-01';
        $sqlnhap2="SELECT maSanPham,SUM(soLuongNhap) AS'sl' FROM `sanphamnhap` 
        JOIN `hoadonnhaphang` ON sanphamnhap.maHoaDonNhap=hoadonnhaphang.maHoaDonNhap WHERE maSanPham=$maSP 
        AND ngayLapDonNhap>='$ngay' AND TrangThai='Đã nhập'";
        $querynhap2=mysqli_query($conn,$sqlnhap2);
        $rownhap2 = mysqli_fetch_assoc($querynhap2);
        if(!empty($rownhap2['sl'])){
            $sln2=$rownhap2['sl'];
        }else{
            $sln2=0;
        }
        
        $sqlxuat2="SELECT maSanPham,SUM(soLuongXuat) AS'sl' FROM `sanphamxuat` 
        JOIN `hoadonxuathang` ON sanphamxuat.maDonXuat=hoadonxuathang.maDonXuat WHERE maSanPham=$maSP 
        AND ngayLapHoaDonXuat>='$ngay' AND TrangThai='Đã xuất'";
        $queryxuat2=mysqli_query($conn,$sqlxuat2);
        $rowxuat2 = mysqli_fetch_assoc($queryxuat2);
        if(!empty($rowxuat2['sl'])){
            $slx2=$rowxuat2['sl'];
        }else{
            $slx2=0;
        }
        $sqlton="SELECT maSanPham,SUM(soLuongCon+soLuongLoi)as'slt' FROM `sanpham_kho` WHERE maSanPham=$maSP";
        $queryton=mysqli_query($conn,$sqlton);
        $rowton = mysqli_fetch_assoc($queryton);
        if(!empty($rowton['slt'])){
            $slt=$rowton['slt'];
        }else{
            $slt=0;
        }
        $sltck=$slt+$slx2-$sln2;
        $sltdk=$sltck+$slx-$sln;
        ?>
            <tr>
              <td class="dtr-control"><?php echo $stt ?></td>
              <td class="sorting_1"><?php echo $row['tenSanPham'] ?></td>
              <td class="sorting_1"><?php echo $sltdk ?></td>
              <td class="sorting_1"><?php echo $sln ?></td>
              <td class="sorting_1"><?php echo $ttn ?></td>
              <td class="sorting_1"><?php echo $slx ?></td>
              <td class="sorting_1"><?php echo $ttx ?></td>
              <td class="sorting_1"><?php echo $sltck ?></td>
            </tr>
        <?php
        $tongsldk+=$sltdk;
        $tongsln+=$sln;
        $tongttn+=$ttn;
        $tongslx+=$slx;
        $tongttx+=$ttx;
        $tongslck+=$sltck;
        $stt++;
      }?>   
      <tr>
        <th colspan="2">Tổng</th>
        <td class="sorting_1"><?php echo $tongsldk ?></td>
        <td class="sorting_1"><?php echo $tongsln ?></td>
        <td class="sorting_1"><?php echo $tongttn ?></td>
        <td class="sorting_1"><?php echo $tongslx ?></td>
        <td class="sorting_1"><?php echo $tongttx ?></td>
        <td class="sorting_1"><?php echo $tongslck ?></td>
      </tr>
      <?php
    if(($tongttn-$tongttx)>0){
      echo'
        <tr>
            <th colspan="8">Lỗ: '.$tongttn-$tongttx.' VND</th>
        </tr>';
    }else{
        echo'
        <tr>
            <th colspan="8">Lãi: '.$tongttx-$tongttn.' VND</th>
        </tr>';
    }

    echo'
    </tbody>
    </table>';
}
?>