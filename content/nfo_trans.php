<div class="col-md-10 panel panel-default">
	<div class="panel-heading">
		<label>INFO TRANSAKSI BARANG</label>
	</div>
	<div class="panel-body">
		<?php

		$id=$_GET['id'];
		include 'assets/koneksi.php';
		$query = $mysqli->query("select * from barang join transaksi on barang.idbarang = transaksi.idbarang where transaksi.idtransaksi='$id'");
		while ($q=mysqli_fetch_assoc($query)) {?>
			<table class="table table-striped table-bordered">
				<tr>
					<th rowspan="6" width="260px">
						<img src="gambar/<?php echo $q['gambar'] ?>" height="200px" width="250px">
				</th>
			</tr>

			<tr>
				<th colspan="3">
					<label><h3> Nama Barang : <?php echo $q['nama'] ?></h3></label>

				</th>
			</tr>
			<tr>
				<td>Jenis Barang</td>
				<td>:</td>
				<td><?php echo $q['jenis'] ?></td>
			</tr>
			<tr>
				<td>Harga Beli Barang</td>
				<td>:</td>
				<td><?php echo $q['hrgbl'] ?></td>
			</tr>
			<tr>
				<td>Harga Jual Barang</td>
				<td>:</td>
				<td><?php echo $q['hrgjl'] ?></td>
			</tr>
			<tr>
				<td>Stok Barang</td>
				<td>:</td>
				<td><?php echo $q['stok'] ?></td>
			</tr>

		</table>
		<?php
$no=1;
		 ?>
		<label><H3>Daftar Transaksi Barang</H3></label>
	<table class="table table-bordered table-striped">
		<tr>
			<th>No</th>
			<th>Tanggal Transaksi</th>
			<th>Barang Keluar</th>
		</tr>
		<tr>
			<td><?php echo $no++  ?></td>
			<td><?php echo $q['tgl_transaksi'] ?></td>
			<td><?php echo $q['jumlah'] ?></td>

		</tr>
	</table>

	<?php
}
?>
</div>
</div>
