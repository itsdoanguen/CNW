<?php
    include 'db_connection.php';
    session_start();
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'] ?? '';
        $password = $_POST['password'] ?? '';

        if (getUserAccount($link, $username, $password)) {
            $_SESSION['username'] = $username;
            header('Location: index.php');
            exit();
        } else {
            echo "<script>alert('Tên đăng nhập hoặc mật khẩu không đúng!'); window.location.href='login.php';</script>";
            exit();
        }
    } else {
        header('Location: login.php');
        exit();
    }
?>