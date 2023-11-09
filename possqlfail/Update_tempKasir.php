<?php
   include "koneksi.php";  

   $ID    = $_GET['ID'];
   $jumlah= $_GET['jumlah'];
   $harga = $_GET['harga'];
   $total = $jumlah * $harga;

   $data=sqlsrv_query($koneksi, "UPDATE t_tempkasir SET jumlah=$jumlah,total=$total where No=$ID");
        
   if ($data) {
      echo "Berhasil Update Data Barang";
   }
?>