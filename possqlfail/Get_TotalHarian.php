<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");

// Query for daily total
$queryHarian = "SELECT SUM(total) AS total_harian FROM t_kasir WHERE CONVERT(DATE, tanggal) = CONVERT(DATE, GETDATE())";

// Query for monthly total
$queryBulan = "SELECT SUM(total) AS total_bulan FROM t_kasir WHERE MONTH(tanggal) = MONTH(GETDATE())";

$stmtHarian = sqlsrv_query($koneksi, $queryHarian);
$stmtBulan = sqlsrv_query($koneksi, $queryBulan);

if ($stmtHarian === false || $stmtBulan === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($harian = sqlsrv_fetch_array($stmtHarian, SQLSRV_FETCH_ASSOC)) {
    echo number_format($harian["total_harian"]) . "|";
}

while ($bulan = sqlsrv_fetch_array($stmtBulan, SQLSRV_FETCH_ASSOC)) {
    echo number_format($bulan["total_bulan"]) . "|";
}

sqlsrv_free_stmt($stmtHarian);
sqlsrv_free_stmt($stmtBulan);

?>