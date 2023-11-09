<?php
include "koneksi.php";

$ID = $_GET['ID'];

date_default_timezone_set("Asia/Bangkok");


$hapus = sqlsrv_query($koneksi, "DELETE FROM t_tempkasir WHERE No = ?", array($ID));

if ($hapus) {
	echo "Data Sudah Terhapus";

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
	echo "Gagal Menghapus Data";
}
?>