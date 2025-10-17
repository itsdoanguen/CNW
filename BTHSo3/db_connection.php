<?php
    $link = mysqli_connect("localhost", "root", "") or die("Error " . mysqli_error($link));
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "dulieu") or die("Error " . mysqli_error($link));

    
    function getNVInfo($link) {
        $query = "SELECT * FROM nhanvien";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return $result;
    }
    
    function getPBInfo($link) {
        $query = "SELECT * FROM phongban";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return $result;
    }

    function getNVbyPBID($link, $idpb) {
        $query = "SELECT * FROM nhanvien WHERE IDPB = '$idpb'";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return $result;
    }

    function getNVbyCriteria($link, $criteria, $value){
        $query = "SELECT * FROM nhanvien WHERE 1=1";
        if ($criteria != null && $value != null){
            $query .= " AND ($criteria = '$value')";
        }
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return $result;
    }

    function getUserAccount($link, $username, $password) {
        $query = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return mysqli_num_rows($result) > 0;
    }

    function getPBbyID($link, $idpb) {
        $idpb = mysqli_real_escape_string($link, $idpb);
        $query = "SELECT * FROM phongban WHERE IDPB = '$idpb'";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return mysqli_fetch_assoc($result);
    }

    function isIDNVexists($link, $idnv) {
        $idnv = mysqli_real_escape_string($link, $idnv);
        $query = "SELECT * FROM nhanvien WHERE IDNV = '$idnv'";
        $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
        return mysqli_num_rows($result) > 0;
    }
?>