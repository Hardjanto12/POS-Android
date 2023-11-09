<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");
$data_harian = sqlsrv_query($koneksi, "SELECT SUM(total) AS total_harian FROM t_kasir WHERE CONVERT(DATE, tanggal) = CONVERT(DATE, GETDATE())");

while ($harian = sqlsrv_fetch_array($data_harian, SQLSRV_FETCH_ASSOC)) {
    echo number_format($harian["total_harian"]);
    echo "|";
}

$data_bulan = sqlsrv_query($koneksi, "SELECT SUM(total) AS total_bulan FROM t_kasir WHERE MONTH(tanggal) = MONTH(GETDATE())");

while ($bulan = sqlsrv_fetch_array($data_bulan, SQLSRV_FETCH_ASSOC)) {
    echo number_format($bulan["total_bulan"]);
    echo "|";
}

?>