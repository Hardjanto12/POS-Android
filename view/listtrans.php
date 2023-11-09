<?php
include("koneksi.php");

$sql = "SELECT * FROM t_transaksi";
$query = sqlsrv_query($koneksi, $sql);

if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}

echo "<table border='1'>";
echo "<tr><th>NoTransaksi</th><th>Diskon</th><th>TotalBayar</th><th>Tunai</th><th>Debit</th><th>Emoney</th><th>Kembalian</th><th>ID_Kasir</th><th>TglTransaksi</th></tr>";

while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
    echo "<tr>";
    echo "<td>" . $row['noTransaksi'] . "</td>";
    echo "<td>" . $row['diskon'] . "</td>";
    echo "<td>" . $row['totalBayar'] . "</td>";
    echo "<td>" . $row['Tunai'] . "</td>";
    echo "<td>" . $row['Debit'] . "</td>";
    echo "<td>" . $row['Emoney'] . "</td>";
    echo "<td>" . $row['kembalian'] . "</td>";
    echo "<td>" . $row['ID_Kasir'] . "</td>";
    echo "<td>" . $row['tglTransaksi']->format('Y-m-d H:i:s') . "</td>";
    echo "</tr>";
}

echo "</table>";

sqlsrv_free_stmt($query);
sqlsrv_close($koneksi);
?>
