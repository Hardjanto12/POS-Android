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

$sql = "INSERT INTO t_transaksi (tglTransaksi, noTransaksi, diskon, totalBayar, Tunai, Debit, Emoney, kembalian, ID_Kasir) VALUES (GETDATE(), ?, ?, ?, ?, ?, ?, ?, ?)";

$params = array($noTransaksi, $diskon, $totalBayar, $Tunai, $Debit, $Emoney, $kembalian, $userKasir);

$stmt = sqlsrv_query($koneksi, $sql, $params);

// $stmt = sqlsrv_query($koneksi, $query, $params);

if ($stmt) {
    echo "Succeed";
} else {
    echo "Gagal Simpan";
    die(print_r(sqlsrv_errors(), true)); // Display error information
}

sqlsrv_free_stmt($stmt);
?>
