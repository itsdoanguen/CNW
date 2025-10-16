<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $idpb = $_POST['idpb'] ?? '';
        $tenpb = $_POST['tenpb'] ?? '';
        $mota = $_POST['mota'] ?? '';

        if (!empty($idpb) && !empty($tenpb)) {
            $idpb = mysqli_real_escape_string($link, $idpb);
            $tenpb = mysqli_real_escape_string($link, $tenpb);
            $mota = mysqli_real_escape_string($link, $mota);

            $updateQuery = "UPDATE phongban SET Tenpb = '$tenpb', Mota = '$mota' WHERE IDPB = '$idpb'";
            
            if (mysqli_query($link, $updateQuery)) {
                header('Location: capnhat.php?updated=1');
                exit();
            } else {
                header('Location: capnhat.php?error=1');
                exit();
            }
        } else {
            header('Location: capnhat.php?error=1');
            exit();
        }
    }

    $idpb = $_GET['idpb'] ?? '';
    if (empty($idpb)) {
        header('Location: capnhat.php');
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
        }
        input[type="text"]:disabled {
            background-color: #e9ecef;
            cursor: not-allowed;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
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
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Sửa thông tin phòng ban</h2>
        <form method="POST" action="xuli_capnhat.php">
            <div class="form-group">
                <label for="idpb">Mã phòng ban:</label>
                <input type="text" id="idpb" name="idpb" value="<?php echo htmlspecialchars($pbInfo['IDPB']); ?>" disabled>
                <input type="hidden" name="idpb" value="<?php echo htmlspecialchars($pbInfo['IDPB']); ?>">
            </div>

            <div class="form-group">
                <label for="tenpb">Tên phòng ban: <span style="color:red;">*</span></label>
                <input type="text" id="tenpb" name="tenpb" value="<?php echo htmlspecialchars($pbInfo['Tenpb']); ?>" required>
            </div>

            <div class="form-group">
                <label for="mota">Mô tả:</label>
                <textarea id="mota" name="mota"><?php echo htmlspecialchars($pbInfo['Mota']); ?></textarea>
            </div>

            <div class="button-group">
                <button type="submit">Lưu thay đổi</button>
                <a href="capnhat.php" class="btn btn-back">Quay lại</a>
            </div>
        </form>
    </div>
</body>
</html>
