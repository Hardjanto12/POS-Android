<?php
include "koneksi.php"; // Include your database connection


$sql = "SELECT * FROM p_notransaksi";
$query = sqlsrv_query($koneksi, $sql);

if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "<table border='1'>";
echo "<tr><th>Nomor</th><th>inv_date</th>";

while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['Nomor'] . "</td>";
    echo "<td>" . $row['inv_date'] . "</td>";
    echo "</tr>";
}

echo "</table>";

sqlsrv_free_stmt($query);
sqlsrv_close($koneksi);
?>