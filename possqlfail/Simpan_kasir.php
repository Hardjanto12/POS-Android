<?php
include "koneksi.php";

date_default_timezone_set("Asia/Bangkok");
$data = sqlsrv_query($koneksi,"INSERT INTO t_kasir(No,noTransaksi,tanggal,idBarang,nmBarang,jumlah,harga,total,ID_Kasir) SELECT No,noTransaksi,tanggal,idBarang,nmBarang,jumlah,harga,total,ID_Kasir FROM t_tempkasir");

if ($data) {
	echo "Berhasil Simpan Data Kasir";
	sqlsrv_query($koneksi,"DELETE FROM t_tempkasir");
	sqlsrv_query($koneksi,"INSERT INTO `p_notransaksi` (`inv_date`) VALUES (curdate())");
}
else{
	echo "Gagal Simpan";
}

//while($result=mysqli_fetch_array($data)){

//}

?>