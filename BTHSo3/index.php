<?php
    session_start();
    $loggedIn = isset($_SESSION['username']) && $_SESSION['username'] !== '';
?>
<!doctype html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: Arial, sans-serif; background:#f7f7f7; margin:40px; }
        .card { background: #fff; padding:20px; border-radius:6px; box-shadow: 0 2px 6px rgba(0,0,0,0.08); max-width:700px; margin:20px auto; }
        h1 { text-align:center; }
        .actions { display:flex; gap:12px; justify-content:center; margin-top:12px; }
        a.button { display:inline-block; padding:10px 16px; background:#0078d4; color:#fff; text-decoration:none; border-radius:4px; }
        a.secondary { background:#666; }
        .login { max-width:320px; margin:12px auto 0; padding:12px; border:1px solid #eee; border-radius:6px; background:#fafafa; }
        .login input[type="text"], .login input[type="password"] { width:100%; padding:8px; box-sizing:border-box; margin-bottom:8px; }
        .login input[type="submit"] { padding:8px 12px; background:#0078d4; color:#fff; border:none; border-radius:4px; cursor:pointer; }
        .welcome { text-align:center; margin-bottom:8px; }
    </style>
</head>
<body>
    <div class="card">
        <h1>Quản lý nhân viên & phòng ban</h1>

        <?php if ($loggedIn): ?>
            <div class="welcome">
                <strong>Xin chào, <?php echo htmlspecialchars($_SESSION['username']); ?></strong>

                <div class="actions" style="margin-top:18px;">
                    <a class="button" href="chen.php">Chèn</a>
                    <a class="button" href="capnhat.php">Cập nhật</a>
                    <a class="button" href="xoa.php">Xóa</a>
                    <a class="button" href="xoatatca.php">Xóa tất cả</a>
                </div>

                <div style="margin-top:8px;">
                    <a class="button" href="xuli_logout.php">Đăng xuất</a>
                </div>
            </div>
            </br></br></br>
        <?php else: ?>
            <div class="login">
                <form method="POST" action="xuli_login.php">
                    <label for="username">Tên đăng nhập</label>
                    <input type="text" id="username" name="username" required />
                    <label for="password">Mật khẩu</label>
                    <input type="password" id="password" name="password" required />
                    <div style="text-align:center; margin-top:6px;">
                        <input type="submit" value="Đăng nhập" />
                    </div>
                </form>
            </div>
        <?php endif; ?>

        <div class="actions" style="margin-top:18px;">
            <a class="button" href="xemthongtinnv.php">Xem thông tin nhân viên</a>
            <a class="button" href="xemthongtinpb.php">Xem thông tin phòng ban</a>
            <a class="button secondary" href="timkiem.php">Tìm kiếm nhân viên</a>
        </div>
    </div>
</body>
</html>
