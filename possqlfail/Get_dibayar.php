<?php
include "koneksi.php";

// $noTransaksi = $_GET['noTransaksi'];

// date_default_timezone_set("Asia/Bangkok");
// $data = sqlsrv_query($koneksi,"SELECT noTransaksi,( Tunai + Debit + Emoney) AS Pembayaran FROM t_transaksi WHERE `noTransaksi` = '$noTransaksi'");

// while($result=sqlsrv_fetch_array($data)){
// 	echo $result["noTransaksi"];
// 	echo "*";
// 	echo $result["Pembayaran"];
// }

$noTransaksi = $_GET['noTransaksi'];

date_default_timezone_set("Asia/Bangkok");

$query = "SELECT noTransaksi, (Tunai + Debit + Emoney) AS Pembayaran FROM t_transaksi WHERE noTransaksi = ?";
$params = array(&$noTransaksi);

$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$stmt = sqlsrv_query($koneksi, $query, $params, $options);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $row["noTransaksi"];
        echo "*";
        echo $row["Pembayaran"];
    }

    sqlsrv_free_stmt($stmt);
}

?>