<?php
    include 'db_connection.php';
    echo "<h2 style='text-align: center;'>Tìm kiếm nhân viên</h2>";
    echo "<form method='GET' action='timkiem.php' style='margin-bottom: 20px; border: 1px solid #ccc; padding: 10px; width: 300px; margin-left: auto; margin-right: auto;'>
            <input type='radio' name='criteria' value='IDNV' checked /> IDNV
            <input type='radio' name='criteria' value='Hoten' /> Họ tên
            <input type='radio' name='criteria' value='Diachi' /> Địa chỉ
            <br/>
            <input type='text' name='value' />
            <input type='button' value='Search' onclick='this.form.submit()'/>
          </form>";

    $criteria = $_GET['criteria'] ?? null;
    $value = $_GET['value'] ?? null;
    $nvResult = null;
    if ($criteria && $value){
        $nvResult = getNVbyCriteria($link, $criteria, $value);
    }
    if ($nvResult) {
        echo "<h2 style='text-align: center;'>Kết quả tìm kiếm</h2>";
        echo "<table border='1' style='border-collapse: collapse; align: center; margin-left: auto; margin-right: auto;'>
                <tr style='text-align: center;'>
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
    }
?>
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        margin-top: 100px;
    }
</style>

<div style="text-align:center; margin-top: 18px;">
    <a href="index.php" style="display:inline-block; padding:8px 12px; background:#0078d4; color:#fff; text-decoration:none; border-radius:4px;">Quay về trang chính</a>
</div>