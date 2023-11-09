<?php
include "koneksi.php";
$idBarang = $_GET['ID'];
//$idBarang = $_GET['idBarang'];

date_default_timezone_set("Asia/Bangkok");


$data = sqlsrv_query($koneksi, "SELECT * FROM t_barang WHERE idBarang=$idBarang");

if (sqlsrv_num_rows($data) > 0) {
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo $result["nmBarang"];
		echo "|";
		echo $result["hargaPokok"];
		echo "|";
		echo $result["hargaJual"];
		echo "|";
		echo $result["expDate"];
		//echo "|";
		//echo $result["stok"];
	}
	//sqlsrv_query($koneksi, "UPDATE t_barang SET stok=stok-1 WHERE idBarang=$ID");
} else {
	echo "Not Found";
}

?>