<?php 
	include '../assets/koneksi.php';
	$idbarang=$_POST['barang'];
	$tgl_trans=$_POST['tgl_trans'];
	$jml=$_POST['jml'];
	$stock=mysql_query("select stok from barang where idbarang='$idbarang'")or die(mysql_error());
	$row=mysql_fetch_assoc($stock);
	$stok= $row['stok'];
	if($stok>=$jml){
	$hasil = $stok-$jml;
	mysql_query("insert into transaksi values('', '$idbarang', '$tgl_trans', '$jml')") or die(mysql_error());
	mysql_query("update barang set stok='$hasil' where idbarang='$idbarang'");?>

	<?php
	header("location:../Brng_keluar.php");
	}
	else{
?>
 <script>
 alert("Jumlah Stok yang tersedia kurang");
 history.go(-1);
 location.reload("true");
</script>
<?php
	} 
		
?>
