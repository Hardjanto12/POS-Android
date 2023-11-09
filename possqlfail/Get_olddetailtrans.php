<?php
include "koneksi.php";

$noTransaksi = $_GET['noTransaksi'];

date_default_timezone_set("Asia/Bangkok");

// $query = "SELECT noTransaksi,totalBayar,kembalian,diskon FROM t_transaksi WHERE `noTransaksi` = '$noTransaksi'";
$query = "SELECT noTransaksi, totalBayar, kembalian, diskon FROM t_transaksi WHERE noTransaksi = '$noTransaksi'";
$data = sqlsrv_query($koneksi,$query);
$result = sqlsrv_fetch_array($data);

while($result){
	echo $result["noTransaksi"];
	echo "*";
	echo $result["totalBayar"];
	echo "*";
	echo $result["kembalian"];
	echo "*";
	echo $result["diskon"];
}

?>