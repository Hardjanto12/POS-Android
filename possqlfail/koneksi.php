<?php 

$serverName = "202.78.202.232,1211"; 
$connectionInfo = array( "Database"=>"montana", "UID"=>"sa", "PWD"=>"P@ssw0rdgms");
$koneksi = sqlsrv_connect( $serverName, $connectionInfo);

//   $koneksi=mysqli_connect("localhost","id18315622_testing2","f&p[-=C@!Y9FdtFI","id18315622_test2");

  if (!$koneksi) {
    die("Koneksi gagal: " . sqlsrv_errors());
}
// Check connection
//if ($koneksi->connect_error) {
//  die("Connection failed: " . $koneksi->connect_error);
//}
//echo "Connected successfully";


// # Konek ke Web Server Lokal
// $serverName = "202.78.202.232,1211"; 
// $connectionInfo = array( "Database"=>"montana", "UID"=>"sa", "PWD"=>"P@ssw0rdgms");
// $koneksi = sqlsrv_connect( $serverName, $connectionInfo);

// if( $koneksi ) {
//     // echo "Connection established.<br />";
// }else{
//      echo "Connection could not be established.<br />";
//      die( print_r( sqlsrv_errors(), true));
// }	 

?>
