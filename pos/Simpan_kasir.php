<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");
// Insert data into t_kasir
$queryInsert = "INSERT INTO t_kasir (No, noTransaksi, tanggal, idBarang, nmBarang, jumlah, harga, total, ID_Kasir) SELECT No, noTransaksi, tanggal, idBarang, nmBarang, jumlah, harga, total, ID_Kasir FROM t_tempkasir";
$dataInsert = sqlsrv_query($koneksi, $queryInsert);

if ($dataInsert) {
	echo "Berhasil Simpan Data Kasir";
	// Delete data from t_tempkasir
	sqlsrv_query($koneksi, "DELETE FROM t_tempkasir");

	// Insert data into p_notransaksi
	sqlsrv_query($koneksi, "INSERT INTO p_notransaksi (inv_date) VALUES (GETDATE())");
} else {
	echo "Gagal Simpan.";
}
?>