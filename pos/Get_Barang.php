<?php
include "koneksi.php";
$ID = $_GET['ID'];
//$idBarang = $_GET['idBarang'];

date_default_timezone_set("Asia/Bangkok");


if (strlen($ID) >= 4) {
	// $data = sqlsrv_query($koneksi, "SELECT * FROM t_barang WHERE idBarang=$ID");

	$query = "SELECT * FROM t_barang WHERE idBarang=?";
	$params = array($ID);

	$data = sqlsrv_query($koneksi, $query, $params);

	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo trim($result["nmBarang"]);
		echo "|";
		echo trim($result["hargaJual"]);
		//echo"|";
		//echo $result["stok"];

		//UPDATE Stok Barang
		//mysqli_query($koneksi,"UPDATE t_barang SET stok=stok-1 WHERE idBarang=$ID");
	}

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
	// $dataKasir = sqlsrv_query($koneksi, "SELECT * FROM t_tempkasir WHERE No=$ID");

	$queryKasir = "SELECT * FROM t_tempkasir WHERE No=?";
	$paramsKasir = array($ID);

	$dataKasir = sqlsrv_query($koneksi, $queryKasir, $paramsKasir);

	while ($hasil = sqlsrv_fetch_array($dataKasir, SQLSRV_FETCH_ASSOC)) {
		echo trim($hasil["nmBarang"]);
		echo "|";
		echo trim($hasil["jumlah"]);
		echo "|";
		echo trim($hasil["harga"]);
	}
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
}


?>