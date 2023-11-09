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
//	$tanggal= date("Y/m/d"); 

if ($ID == 'SAVE') {
   $query = "INSERT INTO t_BARANG (idBarang, nmBarang, hargaPokok, hargaJual, expDate, stok)
             VALUES (?, ?, ?, ?, ?, ?)";

   $params = array($idBarang, $nmBarang, $hargaPokok, $hargaJual, $expDate, $stok);

   $insert = sqlsrv_query($koneksi, $query, $params);

   if ($insert === false) {
      die(print_r(sqlsrv_errors(), true));
   }

   if ($insert) {
      echo "Successful";
   } else {
      echo "Unsuccessful";
   }
}

if ($ID == 'UPDATE_DATA') {
   $query = "UPDATE t_barang SET nmBarang=?, hargaPokok=?, hargaJual=?, expDate=?, stok=? WHERE idBarang=?";

   $params = array($nmBarang, $hargaPokok, $hargaJual, $expDate, $stok, $idBarang);

   $update = sqlsrv_query($koneksi, $query, $params);

   if ($update === false) {
      die(print_r(sqlsrv_errors(), true));
   }

   if ($update) {
      echo "Successful";
   } else {
      echo "Unsuccessful";
   }
}

if ($ID == 'DELETE_DATA') {
   $query = "DELETE FROM t_barang WHERE idBarang=?";

   $params = array($idBarang);

   $delete = sqlsrv_query($koneksi, $query, $params);

   if ($delete === false) {
      die(print_r(sqlsrv_errors(), true));
   }

   if ($delete) {
      echo "Successful";
   } else {
      echo "Unsuccessful";
   }
}

?>