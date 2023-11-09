<?php
include "koneksi.php";

$ID = $_GET['ID'];
$idBarang = $_GET['idBarang'];
$nmBarang = $_GET['nmBarang'];
$hargaPokok = $_GET['hargaPokok'];
$hargaJual = $_GET['hargaJual'];
$expDate = $_GET['expDate'];
$stok = $_GET['stok'];

date_default_timezone_set("Asia/Bangkok");

if ($ID == 'SAVE') {
    $query = "INSERT INTO t_BARANG (idBarang, nmBarang, hargaPokok, hargaJual, expDate, stok)
              VALUES (?, ?, ?, ?, ?, ?)";

    $params = array(&$idBarang, &$nmBarang, &$hargaPokok, &$hargaJual, &$expDate, &$stok);

    $stmt = sqlsrv_query($koneksi, $query, $params);

    if ($stmt) {
        echo "Successful";
    } else {
        echo "Unsuccessful";
    }
}

if ($ID == 'UPDATE_DATA') {
    $query = "UPDATE t_barang SET nmBarang = ?, hargaPokok = ?, hargaJual = ?, expDate = ?, stok = ? WHERE idBarang = ?";

    $params = array(&$nmBarang, &$hargaPokok, &$hargaJual, &$expDate, &$stok, &$idBarang);

    $stmt = sqlsrv_query($koneksi, $query, $params);

    if ($stmt) {
        echo "Successful";
    } else {
        echo "Unsuccessful";
    }
}

if ($ID == 'DELETE_DATA') {
    $query = "DELETE FROM t_barang WHERE idBarang = ?";

    $params = array(&$idBarang);

    $stmt = sqlsrv_query($koneksi, $query, $params);

    if ($stmt) {
        echo "Successful";
    } else {
        echo "Unsuccessful";
    }
}

?>