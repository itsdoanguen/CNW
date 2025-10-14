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
?>