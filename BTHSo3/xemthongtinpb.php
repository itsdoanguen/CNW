<?php
    include 'db_connection.php';
    $pbResult = getPBinfo($link);
    echo "<h2 style='text-align: center;'>Thông tin phòng ban</h2>";
    echo "<table border='1' style='border-collapse: collapse; align: center; margin-left: auto; margin-right: auto;'>
            <tr>
                <th width='300'>Mã phòng ban</th>
                <th width='200'>Tên phòng ban</th>
                <th width='300'>Mô tả</th>
                <th width='100'>Nhân viên</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($pbResult)) {
        echo "<tr style='text-align: center;'>
                <td>" . $row['IDPB'] . "</td>
                <td>" . $row['Tenpb'] . "</td>
                <td>" . $row['Mota'] . "</td>
                <td>
                    <a href='xemthongtinnv.php?idpb=" . $row['IDPB'] . "'>XXX</a>
                </td>
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