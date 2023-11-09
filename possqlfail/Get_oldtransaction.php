<?php
include "koneksi.php";
$noTransaksi = $_GET["noTransaksi"];

date_default_timezone_set("Asia/Bangkok");

$query = "SELECT No, nmBarang, jumlah, harga, total FROM t_kasir WHERE noTransaksi = ? ORDER BY No ASC";
$params = array(&$noTransaksi);

$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$stmt = sqlsrv_query($koneksi, $query, $params, $options);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
        echo $row["No"] . ".  ";
        echo substr($row["nmBarang"], 0, 24) . "<br>";
        echo "....";
        echo $row["jumlah"] . " X " . $row["harga"] . " = " . number_format($row["total"]) . "||";
    }

    sqlsrv_free_stmt($stmt);
}


?>