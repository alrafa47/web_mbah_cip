	<!-- panel content -->
	<div class="panel panel-default col-md-10" style="padding: 0px 30px;">
		<!-- panel heading -->
		<div class="panel-heading" style="background-color: white; border: 0px;">
			<div class="row">
			<form method="get" action="">

				<input type="text" name="term" id="cari" placeholder="Cari" class="form-control col-md-2" style="width: 260px">
				<a href="/mbhcip2/Brng_keluar.php" class="btn btn-default col-md-1" style="    margin-left: 5px;"><span class="glyphicon glyphicon-arrow-left"></span></a>
				<script type="text/javascript">
					$("#cari").autocomplete({
						source:"/mbhcip2/view/autocomplete_trans.php"
					});
				</script>
			</form>

			<!-- //////////////////-->
			<!-- button untuk modal -->
				<button class=" pull-right btn btn-default" data-target="#tambah" data-toggle="modal">Tambah Transaksi</button>
			<!-- //////////////////////// -->
			</div>
			<div class="row" style="margin-bottom: 0px;     margin-top: 5px;">

			<a href="laporan.php" class="btn btn-primary pull-right"><span class="glyphicon glyphicon-print"></span> Print</a>
			</div>
		</div>

		<!-- //////////////////////// -->

		<!-- content -->
		<div class="panel-body" style="padding: 15px 0px;">
			<table class="table table-bordered table-striped">
				<tr>
					<style type="text/css">
						th{
							text-align: center;
						}
					</style>
					<th style="width: 35px;">NO</th>
					<th>NAMA BARANG</th>
					<th style="width: 130px;">JENIS</th>
					<th style="width: 110px;">HARGA JUAL</th>
					<th style="width: 100px;">jml</th>
					<th style="width: 170px;">TANGGAL TRANSAKSI</th>
					<th style="width: 80px;">AKSI</th>
				</tr>
				<tr>
					<?php

				// paging
					$halaman = 10;
					$page = isset($_GET['halaman']) ? (int)$_GET['halaman']:1;
					$mulai = ($page>1)? ($page * $halaman) -$halaman :0;
					//////////////////////////////
					include 'assets/koneksi.php';
					if (isset($_GET['term'])) {
						$sugest = $_GET['term'];
						if ($sugest != null ) {
							$query = $mysqli->query("select transaksi.idtransaksi, barang.nama, barang.jenis, barang.hrgjl, transaksi.jml, transaksi.tgl_trans from barang join transaksi on barang.idBarang=transaksi.idBarang where barang.nama like '%$sugest' order by transaksi.idBarang asc limit $mulai, $halaman");
							$sql = $mysqli->query("select transaksi.idtransaksi, barang.nama, barang.jenis, barang.hrgjl, transaksi.jml, transaksi.tgl_trans from barang join transaksi on barang.idBarang=transaksi.idBarang where barang.nama like '%$sugest%'");
						}
					}
					else{
						$query = $mysqli->query("select transaksi.idtransaksi, barang.nama, barang.jenis, barang.hrgjl, transaksi.jml, transaksi.tgl_trans from barang join transaksi on barang.idBarang=transaksi.idBarang limit $mulai, $halaman");
						$sql= $mysqli->query("select transaksi.idtransaksi, barang.nama, barang.jenis, barang.hrgjl, transaksi.jml, transaksi.tgl_trans from barang join transaksi on barang.idBarang=transaksi.idBarang");
					}
					$total= mysqli_num_rows($sql);
					$pages = ceil($total/$halaman);

					if ($total == 0){
						echo '<td colspan="7" height="400px"><h1 style="text-align: center; padding-top: 150px" > TIDAK ADA DATA </h1></td>';
					}else{

						if (isset($_GET['halaman'])){
							$n = $_GET['halaman'];
							$no = 1*(($n-1)*10)+1;
						}else{
							$no=1;
						}


						while ($output = mysqli_fetch_assoc($query)) { ?>
						<td style="    width: 35px;"><?php echo $no++; ?></td>
						<td><?php echo $output['nama'] ?></td>
						<td><?php echo $output['jenis'] ?></td>
						<td>Rp.<?php echo number_format($output['hrgjl']) ?></td>
						<td><?php echo number_format($output['jml']) ?></td>
						<td><?php echo $output['tgl_trans'] ?></td>
						<td>
							<h4><a href="process/hps_trans.php?id=<?php echo $output['idtransaksi'];?>" class="glyphicon glyphicon-remove-sign"></a><a style="margin-left: 5px" href="edit_trans.php?id=<?php echo $output['idtransaksi'];?>" class="glyphicon glyphicon-pencil" ></a><a style="margin-left: 5px" href="info_trans.php?id=<?php echo $output['idtransaksi'];?>"><span class="glyphicon glyphicon-eye-open"></span></a></h4>
						</td>
					</tr>

					<?php

				}
			}
			?>
			<!-- paging number -->

		</table>
		<div style="text-align: center;">
			<?php

			for($i = 1; $i<=$pages; $i++){
				?>
				<a class="btn btn btn-default" href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a><?php
			}
			?>
		</div>
	</div>
</div>
<!-- //////////////////////// -->
<!-- modal fade -->
<div class="modal fade" id="tambah">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<h4>Tambah Data</h4>
			</div>
			<div class="modal-body">
				<form action="process/tmbh_trans.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Barang</label>
						<select name="barang" class="form-control">
							<?php
							$query1=$mysqli->query("select * from barang");
							while ($q= mysqli_fetch_assoc($query1)) {
								?>
								<option value="<?php echo $q['idBarang']; ?>"><?php echo $q['nama']." Jenis :". $q['jenis']."(".$q['stok'].")"; ?></option>
							<?php
							}
							?>
						</select>
					</div>
					<div class="form-group">
						<label>Tanggal Transaksi</label>
						<input name="tgl_trans" type="date" class="form-control" placeholder="Tanggal" required>
					</div>
					<div class="form-group">
						<label>jml</label>
						<input name="jml" type="number" class="form-control" placeholder="Modal per unit" min="1" required>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal" >Tutup</button>
					<input type="submit" value="Simpan" class="btn btn-info" name="submit">

				</div>
			</form>

		</div>
	</div>
</div>

<!-- ///////////////////////////// -->
