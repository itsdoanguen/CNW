<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }
    $list_nv_to_delete = $_POST['selected_nv'] ?? [];
    if (empty($list_nv_to_delete)) {
        header('Location: xoatatca.php?error=1');
        exit();
    } else {
        include 'db_connection.php';
        $ids = array_map(function($id) use ($link) {
            return "'" . mysqli_real_escape_string($link, $id) . "'";
        }, $list_nv_to_delete);
        $ids_str = implode(',', $ids);
        $deleteQuery = "DELETE FROM nhanvien WHERE IDNV IN ($ids_str)";
        if (mysqli_query($link, $deleteQuery)) {
            header('Location: xoatatca.php?deleted=1');
            exit();
        } else {
            header('Location: xoatatca.php?error=1');
            exit();
        }
    }
?>