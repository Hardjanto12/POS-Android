<?php
include "koneksi.php";
$ID = $_GET['ID'];

date_default_timezone_set("Asia/Bangkok");

if (strlen($ID) >= 4) {
    $query = "SELECT nmBarang, hargaJual FROM t_barang WHERE idBarang = ?";
} else {
    $query = "SELECT nmBarang, jumlah, harga FROM t_tempkasir WHERE No = ?";
}

$params = array(&$ID);
$options =  array( "Scrollable" => SQLSRV_CURSOR_KEYSET );

$stmt = sqlsrv_query($koneksi, $query, $params, $options);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $row["nmBarang"];
        echo "|";
        if (isset($row["hargaJual"])) {
            echo $row["hargaJual"];
        } elseif (isset($row["jumlah"])) {
            echo $row["jumlah"];
            echo "|";
            echo $row["harga"];
        }
    }

    sqlsrv_free_stmt($stmt);
}


?>