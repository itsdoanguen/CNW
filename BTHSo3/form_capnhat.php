<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
    include 'db_connection.php';
    $idpb = $_GET['idpb'] ?? '';
    if (empty($idpb)) {
        header('Location: capnhat.php?error=1');
        exit();
    }
    $pbInfo = getPBbyID($link, $idpb);
    if (!$pbInfo) {
        header('Location: capnhat.php?error=1');
        exit();
    }
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa thông tin phòng ban</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 20px;
            margin-top: 100px;
        }
        .form-container {
            max-width: 500px;
            margin: 0 auto;
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 30px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            display: block;
            margin-bottom: 8px;
            color: #555;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        textarea:focus {
            outline: none;
            border-color: #0078d4;
            box-shadow: 0 0 0 3px rgba(0,120,212,0.1);
        }
        input[type="text"]:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
            font-family: Arial, sans-serif;
        }
        .button-group {
            display: flex;
            gap: 10px;
            justify-content: center;
            margin-top: 30px;
        }
        button, .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 14px;
            text-decoration: none;
            display: inline-block;
            font-weight: 600;
            transition: background-color 0.3s;
        }
        button[type="submit"] {
            background-color: #28a745;
            color: white;
        }
        button[type="submit"]:hover {
            background-color: #218838;
        }
        .btn-back {
            background-color: #6c757d;
            color: white;
        }
        .btn-back:hover {
            background-color: #5a6268;
        }
        .required {
            color: red;
        }
    </style>
    <script>
        function resetform() {
            document.getElementById('tenpb').value = "<?= $pbInfo['Tenpb'] ?>";
            document.getElementById('mota').value = "<?= $pbInfo['Mota'] ?>";
        }
    </script>
</head>
<body>
    <div class="form-container">
        <h2>Sửa thông tin phòng ban</h2>
        <form method="POST" action="xuli_capnhat.php">
            <div class="form-group">
                <label for="idpb">Mã phòng ban:</label>
                <input type="text" id="idpb_display" value="<?= $pbInfo['IDPB'] ?>" disabled>
                <input type="hidden" name="idpb" value="<?= $pbInfo['IDPB'] ?>">
            </div>

            <div class="form-group">
                <label for="tenpb">Tên phòng ban: <span class="required">*</span></label>
                <input type="text" id="tenpb" name="tenpb" value="<?= $pbInfo['Tenpb'] ?>" required>
            </div>

            <div class="form-group">
                <label for="mota">Mô tả:</label>
                <textarea id="mota" name="mota"><?= $pbInfo['Mota'] ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit">Lưu thay đổi</button>
                <button type="button" onclick="resetform()">Reset</button>
                <a href="capnhat.php" class="btn btn-back">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
