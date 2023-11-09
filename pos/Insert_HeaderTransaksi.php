<?php
include "koneksi.php";
date_default_timezone_set("Asia/Bangkok");

$noTransaksi = $_GET['noTransaksi'];
$diskon = $_GET['diskon'];
$totalBayar = $_GET['totalBayar'];
$userKasir = $_GET['ID_Kasir'];
$Tunai = $_GET['Tunai'];
$Debit = $_GET['Debit'];
$Emoney = $_GET['Emoney'];
$kembalian = $_GET['kembalian'];

$tunai = $Tunai - $kembalian;



$query = "INSERT INTO t_transaksi (tglTransaksi, noTransaksi, diskon, totalBayar, Tunai, Debit, Emoney, kembalian, ID_Kasir) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
$params = array(date("Y-m-d H:i:s"), $noTransaksi, $diskon, $totalBayar, $tunai, $Debit, $Emoney, $kembalian, $userKasir);

$data = sqlsrv_query($koneksi, $query, $params);

if ($data) {
    echo "Succeed";
} else {
    echo "Gagal Simpan";
}

?>