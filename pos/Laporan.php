<?php
include "koneksi.php";
$tanggaldari = $_GET['tanggaldari'];
$tanggalsampai = $_GET['tanggalsampai'];
$ID = $_GET['ID'];

//$tanggaldari  = substr($tanggaldari,6,4).substr($tanggaldari,2,3)."/".substr($tanggaldari,0,2);
//$tanggalsampai= substr($tanggalsampai,6,4).substr($tanggalsampai,2,3)."/".substr($tanggalsampai,0,2);

//echo "$tanggaldari","<br>";
//echo "$tanggalsampai";
date_default_timezone_set("Asia/Bangkok");

if ($ID == 'D') {

	$query = "";
	$params = array();

	if ($tanggaldari == $tanggalsampai) {
		// If start and end date are the same, query for that specific date
		$query = "SELECT * FROM t_kasir WHERE tanggal = ? ORDER BY tanggal ASC";
		$params = array($tanggaldari);
	} else {
		// If start and end date are different, query for date range
		$query = "SELECT * FROM t_kasir WHERE tanggal BETWEEN ? AND ? ORDER BY tanggal ASC";
		$params = array($tanggaldari, $tanggalsampai);
	}

	$data = sqlsrv_query($koneksi, $query, $params);

	$No = 1;
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo $No;
		echo ". ";
		//echo $result["tanggal"];
		//echo "-";
		echo $result["nmBarang"];
		//echo SUBSTR($result["nmBarang"],0,20); 
		echo "  ";
		echo $result["jumlah"];
		echo " X ";
		echo $result["harga"];
		echo " = ";
		echo number_format($result["total"]);
		echo "||";
		++$No;
	}
}
if ($ID == 'T') {

	$query = "";
	$params = array();

	if ($tanggaldari == $tanggalsampai) {
		// If start and end date are the same, query for that specific date
		$query = "SELECT SUM(total) AS total FROM t_kasir WHERE tanggal = ?";
		$params = array($tanggaldari);
	} else {
		// If start and end date are different, query for date range
		$query = "SELECT SUM(total) AS total FROM t_kasir WHERE tanggal BETWEEN ? AND ?";
		$params = array($tanggaldari, $tanggalsampai);
	}

	// $query = "SELECT SUM(total) AS total FROM t_kasir WHERE tanggal BETWEEN ? AND ?";
	// $params = array($tanggaldari, $tanggalsampai);

	$detail = sqlsrv_query($koneksi, $query, $params);

	while ($harian = sqlsrv_fetch_array($detail, SQLSRV_FETCH_ASSOC)) {
		echo number_format($harian["total"]);
	}
}

if ($ID == 'R') {
	$query = "";
	$params = array();

	if ($tanggaldari == $tanggalsampai) {
		// If start and end date are the same, query for that specific date
		$query = "SELECT noTransaksi, MIN(CONVERT(DATE, tanggal)) AS tanggal, SUM(total) AS total FROM t_kasir WHERE CONVERT(DATE, tanggal) = ? GROUP BY noTransaksi ORDER BY noTransaksi ASC";
		$params = array($tanggaldari);
	} else {
		// If start and end date are different, query for date range
		$query = "SELECT noTransaksi, MIN(CONVERT(DATE, tanggal)) AS tanggal, SUM(total) AS total FROM t_kasir WHERE CONVERT(DATE, tanggal) BETWEEN ? AND ? GROUP BY noTransaksi ORDER BY noTransaksi ASC";
		$params = array($tanggaldari, $tanggalsampai);
	}

	$data = sqlsrv_query($koneksi, $query, $params);

	$No = 1;
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo $No;
		echo ". ";
		echo $result["tanggal"]->format('Y-m-d');
		echo " * ";
		//echo SUBSTR($result["nmBarang"],0,20); 
		//echo "-";
		echo $result["noTransaksi"];
		echo " * ";
		//echo $result["harga"];	
		//echo " = ";	
		echo number_format($result["total"]);
		echo "||";
		++$No;
	}
}

if ($ID == 'H') {

	$query = "";
	$params = array();

	if ($tanggaldari == $tanggalsampai) {
		// Jika tanggal awal dan akhir sama, query hanya untuk tanggal tersebut
		$query = "SELECT tanggal, SUM(total) AS total FROM t_kasir WHERE tanggal = ? GROUP BY tanggal ORDER BY tanggal ASC";
		$params = array($tanggaldari);
	} else {
		// Jika tanggal awal dan akhir berbeda, query untuk rentang tanggal
		$query = "SELECT tanggal, SUM(total) AS total FROM t_kasir WHERE tanggal BETWEEN ? AND ? GROUP BY tanggal ORDER BY tanggal ASC";
		$params = array($tanggaldari, $tanggalsampai);
	}

	$data = sqlsrv_query($koneksi, $query, $params);

	$No = 1;
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo $No;
		echo ". ";
		echo $result["tanggal"]->format('Y-m-d');
		//echo " * ";
		//echo $result["noTransaksi"];
		echo " = ";
		echo number_format($result["total"]);
		echo "||";
		++$No;
	}
}
if ($ID == 'MTD') {

	$query = "";
	$params = array();

	if ($tanggaldari == $tanggalsampai) {
		// Jika tanggal awal dan akhir sama, query hanya untuk tanggal tersebut
		$query = "SELECT SUM(totalBayar) AS totalBayar, SUM(Debit) AS totalDebit, SUM(Emoney) AS totalEmoney FROM t_transaksi WHERE tglTransaksi = ?";
		$params = array($tanggaldari);
	} else {
		// Jika tanggal awal dan akhir berbeda, query untuk rentang tanggal
		$query = "SELECT SUM(totalBayar) AS totalBayar, SUM(Debit) AS totalDebit, SUM(Emoney) AS totalEmoney FROM t_transaksi WHERE tglTransaksi BETWEEN ? AND ?";
		$params = array($tanggaldari, $tanggalsampai);
	}

	// $query = "SELECT SUM(totalBayar) AS totalBayar, SUM(Debit) AS totalDebit, SUM(Emoney) AS totalEmoney FROM t_transaksi WHERE tglTransaksi BETWEEN ? AND ?";
	// $params = array($tanggaldari, $tanggalsampai);

	$data = sqlsrv_query($koneksi, $query, $params);

	$No = 1;
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo $No . ". Tunai = " . ($result["totalBayar"] != 0 ? number_format($result["totalBayar"], 2) : "0") . "||";
		++$No;
		echo $No . ". Debit = " . ($result["totalDebit"] != 0 ? number_format($result["totalDebit"], 2) : "0") . "||";
		++$No;
		echo $No . ". E-money = " . ($result["totalEmoney"] != 0 ? number_format($result["totalEmoney"], 2) : "0") . "||";
		++$No;
	}
}

?>