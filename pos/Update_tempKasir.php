<?php
include "koneksi.php";

$ID = $_GET['ID'];
$jumlah = $_GET['jumlah'];
$harga = $_GET['harga'];
$total = $jumlah * $harga;

$queryUpdate = "UPDATE t_tempkasir SET jumlah = ?, total = ? WHERE No = ?";
$paramsUpdate = array($jumlah, $total, $ID);
$dataUpdate = sqlsrv_query($koneksi, $queryUpdate, $paramsUpdate);

if ($dataUpdate) {
   echo "Berhasil Update Data Barang";
}
?>