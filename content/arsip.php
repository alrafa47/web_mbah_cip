<div class="col-md-10 panel panel-default">
	<div class="panel-heading">

	</div>
	<div class="panel-body">
		<form action="process"  method="post" >
			<div class="form-grup">
				<label>Pilih Bulan </label>
				<select name=tgl_trans class="form-control">
					<?php
					include 'assets/koneksi.php';
					$query = $mysqli->query("select tgl_trans from transaksi");
					while ($q=mysqli_fetch_assoc($query)) {?>
					<option value="<?php echo $q['tgl_transaksi'] ?>"> <?php echo $q['tgl_transaksi'] ?></option>
					<?php
					}
					 ?>
				</select>
			</div>
			<div class="form-grup">

			</div>
		</form>
	</div>
</div>
