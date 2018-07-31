<?php include 'assets/koneksi.php'; 
$id = $_GET['id'];
$query = mysql_query("select * from transaksi where idtransaksi='$id'")or die(mysql_error());
// $query = mysql_query("select transaksi.idtransaksi, barang.nama, barang.jenis, barang.hrgjual, transaksi.jumlah, transaksi.tgl_transaksi from barang join transaksi on barang.idbarang=transaksi.idbarang where transaksi.idtransaksi = '$id'") or die(mysql_error());
while ($e = mysql_fetch_assoc($query)) {
	?>
	<div class="col-md-10 panel panel-default">
		<div class="panel-heading" style="border: 0px; background-color: white">
			Edit Barang
		</div>
		<div class="panel-body">
			<form action="/mbhcip2/process/updt_trans.php" method="post" enctype="multipart/form-data">
				<input type="text" name="id" value="<?php echo $e['idtransaksi'] ?>" hidden>
				<div class="form-group">
					<label>Barang</label>
					<select name="barang" class="form-control">
						<option value="zero">pilih barang</option>
						<?php 
						$query1=mysql_query("select * from barang");
						while ($q= mysql_fetch_assoc($query1)) {
							?>
							<option value="<?php echo $q['idbarang']; ?>"><?php echo $q['nama']." Jenis :". $q['jenis']."(".$q['stok'].")"; ?></option>
							<?php
						}
						?>
					</select>
				</div>
				<div class="form-group">
					<label>Tanggal Transaksi</label>
					<input name="tgl_trans" type="date"  class="form-control" ">
					<!-- value="<?php echo $e['tgl_transaksi'] ?>" -->
				</div>
				<div class="form-group">
					<label>Jumlah</label>
					<input name="jml" type="number" min="1"  class="form-control">
					<!-- value="<?php echo $e['jumlah'] ?>" -->
				</div>	
				<?php
				$idbarang= $q['idbarang'];
				$jml = $q['jumlah'];
				$stk=mysql_query("select stok from barang where idbarang='$idbarang'");
				$row = mysql_fetch_assoc($stk);
				$stok= $row['stok'];
				$hasil = $stok+$jml;
				?>

				<input type="submit" name="submit" class="btn btn-default">
			</form>
			<?php
		}
		if (isset($_POST['submit'])) {
			mysql_query("update barang set stok='$hasil' where idbarang='$idbarang'");
		}
		?>
	</div>
</div>