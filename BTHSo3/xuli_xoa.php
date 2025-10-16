<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
    include 'db_connection.php';

    $idnv = $_GET['idnv'] ?? null;
    if ($idnv) {
        $deleteQuery = "DELETE FROM nhanvien WHERE IDNV = '$idnv'";
        if (mysqli_query($link, $deleteQuery)) {
            header('Location: xoa.php?deleted=1');
            exit();
        } else {
            header('Location: xoa.php?error=1');
            exit();
        }
    }
?>