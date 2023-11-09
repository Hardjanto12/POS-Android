<?php
include "koneksi.php";
$ID = $_GET['ID'];

$query = "SELECT ID_Kasir, password, namaKasir FROM p_userkasir WHERE namaKasir = ?";

$params = array(&$ID);
$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$stmt = sqlsrv_query($koneksi, $query, $params, $options);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $namaKasir = trim($result["namaKasir"]);
    $password = trim($result["password"]);

    echo $namaKasir . "|";
    echo $password . "|";
    echo $namaKasir;
}

sqlsrv_free_stmt($stmt);


?>