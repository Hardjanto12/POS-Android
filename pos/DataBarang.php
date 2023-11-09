<?php
include "koneksi.php";
$nmBarang = $_GET['NAMA'];

date_default_timezone_set("Asia/Bangkok");


if ($nmBarang == "") {
	$data = sqlsrv_query($koneksi, "SELECT * FROM t_barang ORDER BY ID ASC");
} else {
	$data = sqlsrv_query($koneksi, "SELECT * FROM t_barang WHERE nmBarang LIKE '%$nmBarang%' ORDER BY ID ASC");
}

while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
	echo $result["ID"];
	echo "*";
	echo $result["idBarang"];
	echo "*";
	echo $result["nmBarang"];
	echo "*";
	echo $result["hargaJual"];
	//echo"*";
	//echo $result["stok"];
	echo "||";

	//$tgl= date_create($result["tanggal"]);
	//echo date_format($tgl,"d-m-Y");
}

?>