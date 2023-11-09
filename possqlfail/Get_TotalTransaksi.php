<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");

$query = "SELECT SUM(total) AS total, COUNT(*) AS item FROM t_tempkasir";

$stmt = sqlsrv_query($koneksi, $query);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}

while ($result = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    echo number_format($result["total"]) . "|";
    echo $result["item"] . "|";
}

sqlsrv_free_stmt($stmt);


?>