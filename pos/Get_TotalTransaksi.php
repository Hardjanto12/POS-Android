<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");
$data = sqlsrv_query($koneksi, "SELECT SUM(total) AS total, COUNT(*) AS item FROM t_tempkasir");

while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
	echo number_format($result["total"]);
	echo "|";
	echo $result["item"];
	echo "|";
}

?>