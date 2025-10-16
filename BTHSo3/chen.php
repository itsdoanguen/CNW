<style>
    a.button { display:inline-block; padding:10px 16px; background:#0078d4; color:#fff; text-decoration:none; border-radius:4px; }
</style>

<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';
    $nvResult = getNVInfo($link);
    $pbResult = getPBinfo($link);

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
    echo "</table> </br>";

    if (isset($_GET['added']) && $_GET['added'] == '1') {
        echo "<p style='text-align:center; color:green;'>Thêm nhân viên thành công.</p>";
    } elseif (isset($_GET['error'])) {
        echo "<p style='text-align:center; color:red;'>Có lỗi xảy ra khi thêm nhân viên.</p>";
    }
    $selectHtml = "<select name='idpb' required>";
    if ($pbResult) {
        mysqli_data_seek($pbResult, 0);
        while ($prow = mysqli_fetch_assoc($pbResult)) {
            $id = htmlspecialchars($prow['IDPB']);
            $selectHtml .= "<option value='" . $id . "'>" . $id . "</option>";
        }
    }
    $selectHtml .= "</select>";

    echo "<div style='margin-top:8px ; text-align:center;'>
            <form action='xuli_chen.php' method='post' style='display:inline;'>
                <input type='text' name='idnv' placeholder='Mã số' required>
                <input type='text' name='hoten' placeholder='Họ tên' required>
                " . $selectHtml . "
                <input type='text' name='diachi' placeholder='Địa chỉ' required>
                <button class='button' type='submit'>Thêm nhân viên</button>
            </form>
          </div>";
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