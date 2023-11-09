<?php
include "koneksi.php";
$ID = $_GET['ID'];

$query = "SELECT * FROM p_userkasir WHERE namaKasir = ?";
$params = array($ID);
$data = sqlsrv_query($koneksi, $query, $params);

if ($data === false) {
	die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($data)) {
	while ($result = sqlsrv_fetch_array($data, SQLSRV_FETCH_ASSOC)) {
		echo trim($result["namaKasir"]);
		echo "|";
		echo trim($result["password"]);
		echo "|";
		echo trim($result["namaKasir"]);
	}
} else {
	echo "No rows found.";
}

?>