<?php
	include '../assets/koneksi.php';
	$idbarang=$_POST['barang'];
	$tgl_trans=$_POST['tgl_trans'];
	$jml=$_POST['jml'];
	$stock=$mysqli->query("select stok from barang where idBarang='$idbarang'");
	$row=mysqli_fetch_assoc($stock);
	$stok= $row['stok'];
	if($stok>=$jml){
	$hasil = $stok-$jml;
	$mysqli->query("insert into transaksi values('', '$idbarang', '$tgl_trans', '$jml')") or die(mysqli_error());
	$mysqli->query("update barang set stok='$hasil' where idBarang='$idbarang'");
	?>

	<?php
	header("location:../Brng_keluar.php");
	}
	else{
?>
 <script>
 alert("idbarang : <?php echo $idbarang; ?> Jumlah Stok : <?php echo $stok; ?> yang tersedia kurang dari permintaan <?php echo $jml; ?>");
 history.go(-1);
 location.reload("true");
</script>
<?php
	}

?>
