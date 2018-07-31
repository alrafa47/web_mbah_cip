<?php 
include '../assets/koneksi.php';

$barang= $_POST['barang'];
$tgl = $_POST['tgl_trans'];
$jml = $_POST['jml'];
$id = $_POST['id'];

$stock=mysql_query("select stok from barang where idbarang='$barang'")or die(mysql_error());
	$row=mysql_fetch_assoc($stock);
	$stok= $row['stok'];
	if($stok>=$jml){
	$hasil = $stok-$jml;
mysql_query("update barang set stok='$hasil' where idbarang='$barang'");
mysql_query("update transaksi set idbarang='$barang', tgl_transaksi, jumlah='$jml' where idtransaksi='$id'");

header("location: /mbhcip2/Brng_keluar.php");
}
else{
	header("location: /mbhcip2/edit_trans.php");

}