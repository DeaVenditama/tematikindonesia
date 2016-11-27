<?php 
header('Access-Control-Allow-Origin: *');
$server = "localhost"; 
$username = "root"; 
$password = "password"; 
$database = "tematikindonesia"; 

$con = @mysqli_connect($server, $username, $password,
 $database);

if (!$con) {
 trigger_error('Could not connect to MySQL: ' . mysqli_connect_error());
}

$records = array();
//subelect tabel
$sql = "SELECT ID, PROVINSI, JUMLAHPENDUDUK, JUMLAHPENDUDUK * 100 / (select sum(JUMLAHPENDUDUK) FROM jumlahpenduduk) AS 'PERSENTASE'
FROM jumlahpenduduk"; 
$result = mysqli_query($con, $sql);

while($obj = mysqli_fetch_object($result)) {
	$records[] = $obj;
}

mysqli_close($con); 
$data = '{"provinsi":'.json_encode($records).'}'; 
echo $data;
?>


