<?php
include "koneksi.php";

$noTransaksi = $_GET['noTransaksi'];

date_default_timezone_set("Asia/Bangkok");
$data = sqlsrv_query($koneksi, "SELECT noTransaksi, totalBayar, kembalian, diskon FROM t_transaksi WHERE noTransaksi = '$noTransaksi'");

while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
	echo $result["noTransaksi"];
	echo "*";
	echo $result["totalBayar"];
	echo "*";
	echo $result["kembalian"];
	echo "*";
	echo $result["diskon"];
}

?>