<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");
$data = sqlsrv_query($koneksi, "SELECT TOP 1 Nomor FROM p_notransaksi ORDER BY Nomor DESC;
");

while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
	echo date("dmY");
	echo "/", $result["Nomor"];
}
?>