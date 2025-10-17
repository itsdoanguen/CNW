<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';
    $nvResult = getNVInfo($link);
    
    $id_requested = $_GET['idpb'] ?? null;
    if ($id_requested) {
        $nvResult = getNVbyPBID($link, $id_requested);
    }

    echo "<h2 style='text-align: center;'>Thông tin nhân viên</h2>";

    if (isset($_GET['deleted']) && $_GET['deleted'] == '1') {
        echo "<p style='text-align:center; color:green;'>Xóa nhân viên thành công.</p>";
    } elseif (isset($_GET['error'])) {
        echo "<p style='text-align:center; color:red;'>Có lỗi xảy ra khi xóa nhân viên.</p>";
    }

    echo "<form action='xuli_xoatatca.php' method='post' onsubmit=\"return confirm('Bạn có chắc chắn muốn xóa các nhân viên đã chọn?');\">
          <table border='1' style='border-collapse: collapse; align: center; margin-left: auto; margin-right: auto;'>
            <tr>
                <th width='100'>Mã số</th>
                <th width='200'>Họ tên</th>
                <th width='100'>Phòng ban</th>
                <th width='200'>Địa chỉ</th>
                <th width='100'>Lựa chọn</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($nvResult)) {
        echo "<tr style='text-align: center;'>
                <td>" . $row['IDNV'] . "</td>
                <td>" . $row['Hoten'] . "</td>
                <td>" . $row['IDPB'] . "</td>
                <td>" . $row['Diachi'] . "</td>
                <td><input type='checkbox' name='" . $row['IDNV'] . "' value='" . $row['IDNV'] . "'></td>
              </tr>";
    }
    echo "</table>";
    echo "<div style='text-align:center; margin-top: 10px;'>
                <button type='submit' style='padding:8px 12px; background:#d9534f; color:#fff; border:none; border-radius:4px; cursor:pointer;'>Xóa nhân viên đã chọn</button>
          </div>
          </form>";
?>


<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        margin-top: 100px;
    }
</style>

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