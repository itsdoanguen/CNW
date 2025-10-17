<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';
    $pbResult = getPBinfo($link);
    
    echo "<form action='xuli_capnhat.php' method='post'>";
    echo "<h2 style='text-align: center;'>Cập nhật thông tin phòng ban</h2>";
    if (isset($_GET['updated']) && $_GET['updated'] == '1') {
        echo "<p style='text-align:center; color:green;'>Cập nhật phòng ban thành công.</p>";
    } elseif (isset($_GET['error']) && $_GET['error'] == '1') {
        echo "<p style='text-align:center; color:red;'>Có lỗi xảy ra khi cập nhật phòng ban.</p>";
    }

    echo "<table border='1' style='border-collapse: collapse; align: center; margin-left: auto; margin-right: auto;'>
            <tr>
                <th width='300'>Mã phòng ban</th>
                <th width='200'>Tên phòng ban</th>
                <th width='300'>Mô tả</th>
                <th width='100'>Thao tác</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($pbResult)) {
        echo "<tr style='text-align: center;'>
                <td>" . htmlspecialchars($row['IDPB']) . "</td>
                <td>" . htmlspecialchars($row['Tenpb']) . "</td>
                <td>" . htmlspecialchars($row['Mota']) . "</td>
                <td>
                    <a href='form_capnhat.php?idpb=" . urlencode($row['IDPB']) . "' style='display:inline-block; padding:6px 12px; background:#f0ad4e; color:#fff; text-decoration:none; border-radius:4px;'>Sửa</a>
                </td>
              </tr>";
    }
    echo "</table>";
    echo "</form>";
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
