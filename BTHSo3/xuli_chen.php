<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';

    $newNVID = $_POST['idnv'] ?? '';
    $newName = $_POST['hoten'] ?? '';
    $newPBID = $_POST['idpb'] ?? '';
    $newAddress = $_POST['diachi'] ?? '';

    if (isIDNVexists($link, $newNVID)) {
        header('Location: chen.php?error=duplicate');
        exit();
    }

    $newNVID = mysqli_real_escape_string($link, $newNVID);
    $newName = mysqli_real_escape_string($link, $newName);
    $newPBID = mysqli_real_escape_string($link, $newPBID);
    $newAddress = mysqli_real_escape_string($link, $newAddress);

    $insertQuery = "INSERT INTO nhanvien (IDNV, Hoten, IDPB, Diachi) VALUES ('$newNVID', '$newName', '$newPBID', '$newAddress')";
    
    if (mysqli_query($link, $insertQuery)) {
        header('Location: chen.php?added=1');
        exit();
    } else {
        header('Location: chen.php?error=1');
        exit();
    }
?>