<?php
include "koneksi.php";

// $idBarang = $_GET['ID'];
// //$idBarang = $_GET['idBarang'];

// date_default_timezone_set("Asia/Bangkok");


//   $data = mysqli_query($koneksi,"SELECT * FROM t_barang WHERE idBarang=$idBarang");
//   if (mysqli_num_rows($data) > 0){
// 	while($result=mysqli_fetch_array($data)){
// 		echo $result["nmBarang"];
// 		echo"|";
// 		echo $result["hargaPokok"];
// 		echo"|";
// 		echo $result["hargaJual"];
// 		echo"|";
// 		echo $result["expDate"];
// 		//echo"|";
// 		//echo $result["stok"];

// 	}	//mysqli_query($koneksi,"UPDATE t_barang SET stok=stok-1 WHERE idBarang=$ID");
//   }else
//   {
//   	echo "Not Found";
//   }



  $idBarang = $_GET['ID'];

date_default_timezone_set("Asia/Bangkok");

$query = "SELECT nmBarang, hargaPokok, hargaJual, expDate FROM t_barang WHERE idBarang = ?";
$params = array(&$idBarang);

$options = array("Scrollable" => SQLSRV_CURSOR_KEYSET);

$stmt = sqlsrv_query($koneksi, $query, $params, $options);

if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
} else {
    if (sqlsrv_has_rows($stmt)) {
        while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
            echo $row["nmBarang"];
            echo "|";
            echo $row["hargaPokok"];
            echo "|";
            echo $row["hargaJual"];
            echo "|";
            echo $row["expDate"];
        }
    } else {
        echo "Not Found";
    }

    sqlsrv_free_stmt($stmt);
}


?>