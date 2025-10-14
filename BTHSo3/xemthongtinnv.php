<?php
    include 'db_connection.php';
    $nvResult = getNVInfo($link);
    
    $id_requested = $_GET['idpb'] ?? null;
    if ($id_requested) {
        $nvResult = getNVbyPBID($link, $id_requested);
    }

    echo "<h2 style='text-align: center;'>Thông tin nhân viên</h2>";
    echo "<table border='1' style='border-collapse: collapse; align: center; margin-left: auto; margin-right: auto;'>
            <tr>
                <th width='100'>Mã số</th>
                <th width='200'>Họ tên</th>
                <th width='100'>Phòng ban</th>
                <th width='200'>Địa chỉ</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($nvResult)) {
        echo "<tr style='text-align: center;'>
                <td>" . $row['IDNV'] . "</td>
                <td>" . $row['Hoten'] . "</td>
                <td>" . $row['IDPB'] . "</td>
                <td>" . $row['Diachi'] . "</td>
              </tr>";
    }
    echo "</table>";
?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        margin-top: 100px;
    }
</style>