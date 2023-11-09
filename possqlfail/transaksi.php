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
   $total = $jumlah * $harga;
   
   $queryCheck = "SELECT * FROM t_tempkasir WHERE idBarang = ?";
   $paramsCheck = array(&$idBarang);
   $optionsCheck = array("Scrollable" => SQLSRV_CURSOR_STATIC);
   
   $stmtCheck = sqlsrv_query($koneksi, $queryCheck, $paramsCheck, $optionsCheck);
   
   if ($stmtCheck === false) {
       die(print_r(sqlsrv_errors(), true));
   }
   
   if (sqlsrv_num_rows($stmtCheck) == 0) {
       $queryInsert = "INSERT INTO t_tempkasir (No, noTransaksi, tanggal, idBarang, nmBarang, jumlah, harga, total, ID_Kasir)
                      VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
   
       $paramsInsert = array(&$NoUrut, &$noTransaksi, &$tanggal, &$idBarang, &$nmBarang, &$jumlah, &$harga, &$total, &$userKasir);
   
       $stmtInsert = sqlsrv_query($koneksi, $queryInsert, $paramsInsert);
   
       if ($stmtInsert) {
           echo "BERHASIL SIMPAN";
           $querySetNum = "SET @num = 0";
           $queryUpdateNum = "UPDATE t_tempkasir SET No = @num := (@num + 1)";
           $queryResetAutoIncrement = "DBCC CHECKIDENT('t_tempkasir', RESEED, 0)";
   
           sqlsrv_query($koneksi, $querySetNum);
           sqlsrv_query($koneksi, $queryUpdateNum);
           sqlsrv_query($koneksi, $queryResetAutoIncrement);
       } else {
           echo "GAGAL SIMPAN";
       }
   } else {
       echo 'UPDATE';
       while ($hasil = sqlsrv_fetch_array($stmtCheck, SQLSRV_FETCH_ASSOC)) {
           $jumlah = $hasil["jumlah"] + 1;
           $total = $jumlah * $harga;
       }
   
       $queryUpdate = "UPDATE t_tempkasir SET jumlah = ?, total = ? WHERE idBarang = ?";
       $paramsUpdate = array(&$jumlah, &$total, &$idBarang);
   
       $stmtUpdate = sqlsrv_query($koneksi, $queryUpdate, $paramsUpdate);
   
       if ($stmtUpdate) {
           echo "Data Sudah Terupdate";
       } else {
           echo "GAGAL UPDATE";
       }
   }
   
   sqlsrv_free_stmt($stmtCheck);   

?>