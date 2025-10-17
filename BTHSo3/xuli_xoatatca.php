<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: xoatatca.php');
        exit();
    }

    $list_nv_to_delete = [];
    foreach ($_POST as $key => $value) {
        if ($key === $value && $key !== '') {
            $list_nv_to_delete[] = $value;
        }
    }

    if (empty($list_nv_to_delete)) {
        header('Location: xoatatca.php?error=1');
        exit();
    }
    $ids = array_map(function($id) use ($link) {
        return "'" . mysqli_real_escape_string($link, $id) . "'";
    }, $list_nv_to_delete);
    $ids_str = implode(',', $ids);
    
    $deleteQuery = "DELETE FROM nhanvien WHERE IDNV IN ($ids_str)";
    if (mysqli_query($link, $deleteQuery)) {
        $deleted_count = mysqli_affected_rows($link);
        mysqli_close($link);
        
        if ($deleted_count > 0) {
            header('Location: xoatatca.php?deleted=1');
        } else {
            header('Location: xoatatca.php?error=1');
        }
        exit();
    } else {
        mysqli_close($link);
        header('Location: xoatatca.php?error=0');
        exit();
    }
?>