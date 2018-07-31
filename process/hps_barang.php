<?php 
include '../assets/koneksi.php';
	$id=$_GET['id'];
mysql_query("delete from barang where idbarang='$id'") or die(mysql_error());
header("location: ../index.php");
 ?>