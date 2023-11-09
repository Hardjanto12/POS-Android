<?php
include "koneksi.php";
$tanggaldari  = $_GET['tanggaldari'];
$tanggalsampai= $_GET['tanggalsampai'];
$ID=$_GET['ID'];

//$tanggaldari  = substr($tanggaldari,6,4).substr($tanggaldari,2,3)."/".substr($tanggaldari,0,2);
//$tanggalsampai= substr($tanggalsampai,6,4).substr($tanggalsampai,2,3)."/".substr($tanggalsampai,0,2);

//echo "$tanggaldari","<br>";
//echo "$tanggalsampai";
date_default_timezone_set("Asia/Bangkok");

if ($ID=='D') {
	$data = sqlsrv_query($koneksi,"SELECT * FROM t_kasir WHERE tanggal between '$tanggaldari' and '$tanggalsampai' order by tanggal asc");

	$No=1;
	while($result=sqlsrv_fetch_array($data)){
		echo $No;
		echo ". ";
		//echo $result["tanggal"];
		//echo "-";
		echo $result["nmBarang"]; 
		//echo SUBSTR($result["nmBarang"],0,20); 
		echo "  ";
		echo $result["jumlah"];
	    echo " X ";
		echo $result["harga"];	
		echo " = ";	
		echo number_format($result["total"]);
		echo "||";
	    ++$No;
	}
}
if ($ID=='T') {
	$detail = sqlsrv_query($koneksi,"SELECT sum(total)total FROM t_kasir WHERE tanggal between '$tanggaldari' and '$tanggalsampai' ");

	while($harian=sqlsrv_fetch_array($detail)){
	echo  number_format($harian["total"]);
	}
}

if ($ID=='R') {
	$data = sqlsrv_query($koneksi,"SELECT noTransaksi,tanggal,sum(total)total FROM t_kasir WHERE tanggal between '$tanggaldari' and '$tanggalsampai' GROUP BY noTransaksi order by noTransaksi asc");

	$No=1;
	while($result=sqlsrv_fetch_array($data)){
		echo $No;
		echo ". ";
		echo $result["tanggal"];
		echo " * ";
		//echo SUBSTR($result["nmBarang"],0,20); 
		//echo "-";
		echo $result["noTransaksi"];
	    echo " * ";
		//echo $result["harga"];	
		//echo " = ";	
		echo number_format($result["total"]);
		echo "||";
	    ++$No;
	}
}

if ($ID=='H') {
	$data = sqlsrv_query($koneksi,"SELECT noTransaksi,tanggal,sum(total)total FROM t_kasir WHERE tanggal between '$tanggaldari' and '$tanggalsampai' GROUP BY tanggal order by tanggal asc");

	$No=1;
	while($result=sqlsrv_fetch_array($data)){
		echo $No;
		echo ". ";
		echo $result["tanggal"];
	    //echo " * ";
		//echo $result["noTransaksi"];
		echo " = ";
		echo number_format($result["total"]);
		echo "||";
	    ++$No;
	}
}
if ($ID=='MTD') {
	$data = sqlsrv_query($koneksi,"SELECT SUM(Tunai), SUM(Debit), SUM(Emoney) FROM t_transaksi WHERE tglTransaksi  BETWEEN '$tanggaldari' AND '$tanggalsampai'");

	$No=1;
	while($result=sqlsrv_fetch_array($data)){
		echo $No;
		echo ". ";
		echo "Tunai";
		echo " = ";
		echo $result["SUM(Tunai)"];
	    echo "||";
	    ++$No;
	    echo $No;
		echo ". ";
	    echo "Debit";
	    echo " = ";
	    echo $result["SUM(Debit)"];
	    echo "||";
	    ++$No;
	    echo $No;
		echo ". ";
	    echo "E-money";
	    echo " = ";
	    echo $result["SUM(Emoney)"];
		//echo " = ";
		//echo number_format($result["SUM(totalBayar)"]);
		echo "||";
	    ++$No;
	}
}

?>