<?php
    session_start();
    if (!isset($_SESSION['username'])) {
        header('Location: login.php');
        exit();
    }

    include 'db_connection.php';

    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        header('Location: capnhat.php');
        exit();
    }

    $idpb = $_POST['idpb'] ?? '';
    $tenpb = $_POST['tenpb'] ?? '';
    $mota = $_POST['mota'] ?? '';

    if (empty($idpb) || empty($tenpb)) {
        header('Location: capnhat.php?error=1');
        exit();
    }
    $idpb = mysqli_real_escape_string($link, $idpb);
    $tenpb = mysqli_real_escape_string($link, $tenpb);
    $mota = mysqli_real_escape_string($link, $mota);

    $updateQuery = "UPDATE phongban SET Tenpb = '$tenpb', Mota = '$mota' WHERE IDPB = '$idpb'";
    
    if (mysqli_query($link, $updateQuery)) {
        mysqli_close($link);
        header('Location: capnhat.php?updated=1');
        exit();
    } else {
        mysqli_close($link);
        header('Location: capnhat.php?error=1');
        exit();
    }
?>
