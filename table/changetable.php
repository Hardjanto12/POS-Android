<?php
include 'koneksi.php';

// Query untuk menambahkan default value pada kolom 'tglTransaksi'
$query = "ALTER TABLE t_transaksi ADD CONSTRAINT DF_t_transaksi_tglTransaksi DEFAULT GETDATE() FOR tglTransaksi;";

// Menjalankan query
$result = sqlsrv_query($koneksi, $query);

// Memeriksa hasil query
if ($result === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    echo "Default value pada kolom 'tglTransaksi' berhasil ditambahkan.";
}

// Menutup koneksi
sqlsrv_close($koneksi);
?>