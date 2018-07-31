<?php 
include '../assets/koneksi.php';
	$id=$_GET['id'];
	$query= mysql_query("select * from transaksi join barang on transaksi.idbarang where transaksi.idtransaksi = '$id' ");
	$row= mysql_fetch_assoc($query);
	$idbarang  = $row['idbarang'];
	$stok = $row['stok'];
	$jml = $row['jumlah'];
	$hasil = $stok+$jml;
mysql_query("delete from transaksi where idtransaksi='$id'") or die(mysql_error());
mysql_query("update barang set stok='$hasil' where idbarang='$idbarang'");

header("location: ../Brng_keluar.php");
 ?>