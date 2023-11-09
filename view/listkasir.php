<?php
include("koneksi.php");

$sql = "SELECT ID, No, noTransaksi, tanggal, idBarang, nmBarang, jumlah, harga, total, ID_Kasir FROM t_kasir";
$query = sqlsrv_query($koneksi, $sql);

if ($query === false) {
    die(print_r(sqlsrv_errors(), true));
}

if (sqlsrv_has_rows($query)) {
    // Data exists, display the table
    echo "<table border='1'>";
    echo "<tr><th>ID</th><th>No</th><th>noTransaksi</th><th>tanggal</th><th>idBarang</th><th>nmBarang</th><th>jumlah</th><th>harga</th><th>total</th><th>ID_Kasir</th></tr>";

    while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td>" . $row['ID'] . "</td>";
        echo "<td>" . $row['No'] . "</td>";
        echo "<td>" . $row['noTransaksi'] . "</td>";
        echo "<td>" . $row['tanggal']->format('Y-m-d H:i:s') . "</td>";
        echo "<td>" . $row['idBarang'] . "</td>";
        echo "<td>" . $row['nmBarang'] . "</td>";
        echo "<td>" . $row['jumlah'] . "</td>";
        echo "<td>" . $row['harga'] . "</td>";
        echo "<td>" . $row['total'] . "</td>";
        echo "<td>" . $row['ID_Kasir'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    // No data in the database
    echo "No data in the database.";
}

sqlsrv_free_stmt($query);
// sqlsrv_close($koneksi);
?>