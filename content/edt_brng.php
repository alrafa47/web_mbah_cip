<?php include 'assets/koneksi.php';
$id = $_GET['id'];
$query = $mysqli->query("select * from barang where idbarang = '$id'") or die(mysql_error());
while ($e = mysqli_fetch_assoc($query)) {
	?>
	<div class="col-md-10 panel panel-default">
		<div class="panel-heading" style="border: 0px; background-color: white">
			Edit Barang
		</div>
		<div class="panel-body">
			<form action="/mbhcip2/process/updt_barang.php" method="post" enctype="multipart/form-data">
				<div class="form-group">
					<label>ID Barang</label>
					<input class="form-control" type="text" name="id" value="<?php echo $e['idbarang']; ?>"  readonly>
				</div>
				<div class="form-group">
					<label>Nama Barang</label>
					<input class="form-control" type="text" name="nama" value="<?php echo $e['nama']; ?>">
				</div>
				<div class="form-group">
					<label>jenis Barang</label>
					<input class="form-control" type="text" name="jenis" value="<?php echo $e['jenis']; ?>">
				</div>
				<div class="form-group">
					<label>Harga Beli</label>
					<input class="form-control" type="text" name="hrgbeli" value="<?php echo $e['hrgbeli']; ?>">
				</div>
				<div class="form-group">
					<label>Harga Jual</label>
					<input class="form-control" type="text" name="hrgjual" value="<?php echo $e['hrgjual']; ?>">
				</div>
				<div class="form-group">
					<label>Stok</label>
					<input class="form-control" type="text" name="stok" value="<?php echo $e['stok']; ?>">
				</div>
				<div class="form-group">
					<label>Gambar</label>
					<input name="file" type="file" class="form-control" value="<?php echo $e['gambar']; ?>">
				</div>
				<?php
			}
			?>
			<input type="submit" name="submit" class="btn btn-default">
		</form>
	</div>
</div>
