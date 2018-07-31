<?php 
$server = "localhost";
$pass = "";
$user = "root";
$db = "appgudang";
$mysqli = new mysqli($server, $user, $pass, $db);
if (mysqli_connect_errno()) {
	echo "error koneksi";
}
 ?>
