<?php
include "koneksi.php";
$nmBarang = $_GET['NAMA'];

date_default_timezone_set("Asia/Bangkok");

if ($nmBarang=="") {
	$data = sqlsrv_query($koneksi,"SELECT * FROM t_barang order by ID asc");
}else{

	$data = sqlsrv_query($koneksi,"SELECT * FROM t_barang WHERE nmBarang LIKE '%$nmBarang%' order by ID asc");
}


while($result=sqlsrv_fetch_array($data)){
	echo $result["ID"];
	echo"*";
	echo $result["idBarang"];
	echo"*";
	echo $result["nmBarang"];
	echo"*";
	echo $result["hargaJual"];
	//echo"*";
	//echo $result["stok"];
	echo "||";
	// echo "<br>";
	
	//$tgl= date_create($result["tanggal"]);
	//echo date_format($tgl,"d-m-Y");
}

?>