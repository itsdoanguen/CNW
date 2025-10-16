<?php
    <form name="loginForm" method="POST" action="xuli_login.php" style="max-width:300px; margin:100px auto; padding:20px; border:1px solid #ccc; border-radius:6px; background:#fff;">
        <h2 style="text-align:center;">Đăng nhập</h2>
        <div style="margin-bottom:12px;">
            <label for="username">Tên đăng nhập:</label><br/>
            <input type="text" id="username" name="username" required style="width:100%; padding:8px; box-sizing:border-box;"/>
        </div>
        <div style="margin-bottom:12px;">
            <label for="password">Mật khẩu:</label><br/>
            <input type="password" id="password" name="password" required style="width:100%; padding:8px; box-sizing:border-box;"/>
        </div>
        <div style="text-align:center;">
            <input type="submit" value="Đăng nhập" style="padding:10px 16px; background:#0078d4; color:#fff; border:none; border-radius:4px; cursor:pointer;"/>
        </div>
    </form>
?>