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

    mysqli_data_seek($nvResult, 0);
    $existingIDs = [];
    while ($row = mysqli_fetch_assoc($nvResult)) {
        $existingIDs[] = $row['IDNV'];
    }
    $existingIDsJson = json_encode($existingIDs);

    echo "<div style='margin-top:20px; text-align:center;'>
            <form action='xuli_chen.php' method='post' id='formChen' class='form-chen'>
                <div class='form-row'>
                    <input type='text' name='idnv' id='idnv' placeholder='Mã số' required class='input-field'>
                    <span id='idnv-error' class='error-message'>Mã số đã tồn tại!</span>
                </div>
                <div class='form-row'>
                    <input type='text' name='hoten' placeholder='Họ tên' required class='input-field'>
                </div>
                <div class='form-row'>
                    " . $selectHtml . "
                </div>
                <div class='form-row'>
                    <input type='text' name='diachi' placeholder='Địa chỉ' required class='input-field'>
                </div>
                <div class='form-row'>
                    <button class='button' type='submit' id='btnSubmit'>Thêm nhân viên</button>
                </div>
            </form>
          </div>";
?>

<script>
    const existingIDs = <?php echo $existingIDsJson; ?>;
    const idnvInput = document.getElementById('idnv');
    const errorSpan = document.getElementById('idnv-error');
    const btnSubmit = document.getElementById('btnSubmit');
    const form = document.getElementById('formChen');

    idnvInput.addEventListener('input', function() {
        const idnv = this.value.trim();
        
        if (existingIDs.includes(idnv)) {
            errorSpan.style.display = 'inline';
            btnSubmit.disabled = true;
        } else {
            errorSpan.style.display = 'none';
            btnSubmit.disabled = false;
        }
    });

    form.addEventListener('submit', function(e) {
        if (existingIDs.includes(idnvInput.value.trim())) {
            e.preventDefault();
            alert('Mã số đã tồn tại! Vui lòng nhập mã số khác.');
        }
    });
</script>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f4f4f4;
        margin: 20px;
        margin-top: 100px;
    }
    
    .form-chen {
        display: inline-block;
        background: #fff;
        padding: 25px 40px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .form-row {
        margin-bottom: 15px;
        text-align: left;
    }
    
    .input-field {
        width: 300px;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        transition: border-color 0.3s;
        box-sizing: border-box;
    }
    
    .input-field:focus {
        outline: none;
        border-color: #0078d4;
        box-shadow: 0 0 0 3px rgba(0,120,212,0.1);
    }
    
    .form-chen select {
        width: 300px;
        padding: 10px 12px;
        border: 1px solid #ddd;
        border-radius: 4px;
        font-size: 14px;
        background-color: white;
        cursor: pointer;
        transition: border-color 0.3s;
    }
    
    .form-chen select:focus {
        outline: none;
        border-color: #0078d4;
        box-shadow: 0 0 0 3px rgba(0,120,212,0.1);
    }
    
    .error-message {
        color: #d9534f;
        font-size: 12px;
        display: none;
        margin-left: 8px;
        font-weight: 500;
    }
    
    .form-chen .button {
        width: 300px;
        padding: 12px;
        font-size: 15px;
        font-weight: 600;
        transition: background-color 0.3s;
    }
    
    .form-chen .button:hover:not(:disabled) {
        background-color: #005a9e;
    }
    
    .form-chen .button:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    a.button { display:inline-block; padding:10px 16px; background:#0078d4; color:#fff; text-decoration:none; border-radius:4px; }
</style>

<div style="text-align:center; margin-top: 18px;">
    <a href="index.php" class="button">Quay về trang chính</a>
</div>
