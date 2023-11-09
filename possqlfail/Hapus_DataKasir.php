<?php
include "koneksi.php";

$ID = $_GET['ID'];

date_default_timezone_set("Asia/Bangkok");

$hapus=sqlsrv_query($koneksi,"DELETE FROM t_tempkasir WHERE No=$ID");
if($hapus){
	echo "Data Sudah Terhapus";
	sqlsrv_query($koneksi,"SET @num := 0");
	sqlsrv_query($koneksi,"UPDATE t_tempkasir SET No = @num := (@num+1)");
	sqlsrv_query($koneksi,"ALTER TABLE t_tempkasir AUTO_INCREMENT = 1");
}	
?>