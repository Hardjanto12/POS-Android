<?php
include "koneksi.php";

$NoUrut = $_GET['NoUrut'];
$idBarang = $_GET['idBarang'];
$nmBarang = $_GET['nmBarang'];
$harga = $_GET['harga'];
$jumlah = $_GET['jumlah'];
$noTransaksi = $_GET['NoTransaksi'];
$userKasir = $_GET['userKasir'];


$tanggal = date("Y/m/d");
//$jumlah = 1;
$total = $jumlah * $harga;

$queryCheck = "SELECT * FROM t_tempkasir WHERE idBarang = ?";
$paramsCheck = array($idBarang);
$dataCheck = sqlsrv_query($koneksi, $queryCheck, $paramsCheck);

if (sqlsrv_num_rows($dataCheck) == 0) {
   echo 'INSERT';
   $queryInsert = "INSERT INTO t_tempkasir (No, noTransaksi, tanggal, idBarang, nmBarang, jumlah, harga, total, ID_Kasir) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
   $paramsInsert = array($NoUrut, $noTransaksi, $tanggal, $idBarang, $nmBarang, $jumlah, $harga, $total, $userKasir);
   $simpan = sqlsrv_query($koneksi, $queryInsert, $paramsInsert);

   if ($simpan) {
      echo "BERHASIL SIMPAN";
      // Menetapkan nomor urut dengan menggunakan ROW_NUMBER()
      $updateQuery = "
         WITH CTE AS (
            SELECT No, ROW_NUMBER() OVER (ORDER BY (SELECT NULL)) AS NewNo
            FROM t_tempkasir
         )
         UPDATE CTE SET No = NewNo;
      ";

      $updateResult = sqlsrv_query($koneksi, $updateQuery);

      // Reset nilai awal dari AUTO_INCREMENT pada kolom No
      $resetQuery = "DBCC CHECKIDENT('t_tempkasir', RESEED, 0);";
      $resetResult = sqlsrv_query($koneksi, $resetQuery);
   } else {
      echo "GAGAL SIMPAN";
   }
} else {
   echo 'UPDATE';
   while ($hasil = sqlsrv_fetch_array($dataCheck, SQLSRV_FETCH_ASSOC)) {
      $jumlah = $hasil["jumlah"] + 1;
      $total = $jumlah * $harga;
   }

   $queryUpdate = "UPDATE t_tempkasir SET jumlah = ?, total = ? WHERE idBarang = ?";
   $paramsUpdate = array($jumlah, $total, $idBarang);
   sqlsrv_query($koneksi, $queryUpdate, $paramsUpdate);
}


?>