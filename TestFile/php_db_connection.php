<?php
    $link = mysqli_connect("localhost", "root", "") or die("Error " . mysqli_error($link));
    mysqli_set_charset($link, "utf8");
    mysqli_select_db($link, "dulieu") or die("Error " . mysqli_error($link));
    $query = "SELECT * FROM table1";
    $result = mysqli_query($link, $query) or die("Error " . mysqli_error($link));
   
    echo "<table border='1'>
            <tr>
                <th>Ma so</th>
                <th>Ho ten</th>
                <th>Ngay sinh</th>
                <th>Nghe nghiep</th>
            </tr>";
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>
                <td>" . $row['maso'] . "</td>
                <td>" . $row['hoten'] . "</td>
                <td>" . $row['ngaysinh'] . "</td>
                <td>" . $row['nghenghiep'] . "</td>
              </tr>";
    }
    echo "</table>";
?>