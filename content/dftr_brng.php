	<!-- panel content -->
	<div class="panel panel-default col-md-10">
		<!-- panel heading -->
		<div class="panel-heading" style="background-color: white; border: 0px; margin-bottom: 20px"> 
			<form method="get" action="">
				
				<input type="text" name="term" id="cari" placeholder="Cari" class="form-control col-md-3" style="width: 260px">
				<a href="/mbhcip2" class="btn btn-default col-md-1" style="    margin-left: 5px;"><span class="glyphicon glyphicon-arrow-left"></span></a>
				<script type="text/javascript">
					$("#cari").autocomplete({
						source:"/mbhcip2/view/autocomplete.php"
					});
				</script>
			</form>

			<!-- //////////////////
				<!-- button untuk modal -->
				<button class=" pull-right btn btn-default" data-target="#tambah" data-toggle="modal">Tambah Barang</button>
				<!-- //////////////////////// -->
			</div>
			<!-- //////////////////////// -->
			
			<!-- content -->
			<div class="panel-body">
				<table class="table table-bordered table-striped">
					<tr>
						<style type="text/css">
						th{
							text-align: center;
						}
					</style>
					<th style="    width: 35px;">NO</th>
					<th style="    width: 165px;">GAMBAR</th>
					<th>NAMA BARANG</th>
					<th>JENIS</th>
					<th style="width: 110px;">HARGA BELI</th>
					<th style="width: 110px;">HARGA JUAL</th>
					<th style="width: 100px;">STOK</th>
					<th style="width: 60px;">AKSI</th>
				</tr>
				<tr>
					<?php 

				// paging
					$halaman = 10;
					$page = isset($_GET['halaman']) ? (int)$_GET['halaman']:1;
					$mulai = ($page>1)? ($page * $halaman) -$halaman :0;

					include 'assets/koneksi.php';
					if (isset($_GET['term'])) {
						$sugest = $_GET['term'];
						if ($sugest != null ) {
							$query = mysql_query("select * from barang where nama like '%$sugest' order by idbarang asc limit $mulai, $halaman");
							$sql = mysql_query("select * from barang where nama like '%$sugest%'");
						}
					}
					else{
						$query = $mysqli->query("select * from barang limit $mulai, $halaman");
						$sql= $mysqli->query("select * from barang");
					}
// ???????
					// $total= $mysqli->num_rows($sql);
					// $pages = ceil($total/$halaman);
///????????
$total = 0;
$pages = 0;
					if ($total == 0){
						echo '<td colspan="8" height="400px"><h1 style="text-align: center; padding-top: 150px" > TIDAK ADA DATA </h1></td>';
					}else{
						
						if (isset($_GET['halaman'])){
							$n = $_GET['halaman'];
							$no = 1*(($n-1)*10)+1;
						}else{
							$no=1;
						}


						while ($output = mysql_fetch_assoc($query)) { ?>
						<td style="    width: 35px;"><?php echo $no++; ?></td>
						<td>
							<?php
							$img=$output['gambar'];
							if (empty($img)) {
								?>
								Tidak ada gambar
								<?php
							}elseif ($img == 'ekstensi tidak didukung') {
								echo "ekstensi tidak didukung";
							} 
							else { 
								echo "<img src='/mbhcip2/gambar/$img' height='100px' width='150px'>";
							}
							?>
							
						</td>
						<td><?php echo $output['nama'] ?></td>
						<td><?php echo $output['jenis'] ?></td>
						<td>Rp.<?php echo number_format($output['hrgbeli']) ?></td>
						<td>Rp.<?php echo number_format($output['hrgjual']) ?></td>
						<td><?php echo number_format($output['stok']) ?></td>
						<td>
							<h4><a href="process/hps_barang.php?id=<?php echo $output['idbarang'];?>" class="glyphicon glyphicon-remove-sign"></a><a style="margin-left: 5px" href="edit_barang.php?id=<?php echo $output['idbarang'];?>" class="glyphicon glyphicon-pencil" ></a></h4>
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
				<form action="process/Tambah_barang.php" method="post" enctype="multipart/form-data">
					<div class="form-group">
						<label>Nama Barang</label>
						<input name="nama" type="text" class="form-control" placeholder="Nama Barang" required>
					</div>
					<div class="form-group">
						<label>Jenis</label>
						<input name="jenis" type="text" class="form-control" placeholder="Jenis Barang" required>
					</div>
					<div class="form-group">
						<label>Harga beli</label>
						<input name="hrgbl" type="number" min="1" class="form-control" placeholder="Harga Beli" required>
					</div>	
					<div class="form-group">
						<label>Harga Jual</label>
						<input name="hrgjl" type="number" min="1" class="form-control" placeholder="Harga Jual" required>
					</div>
					<div class="form-group">
						<label>Stok</label>
						<input name="stok" type="number" min="1" class="form-control" placeholder="Jumlah Stok" required >
					</div>
					<div class="form-group">
						<label>Gambar</label>
						<input name="file" type="file" class="form-control" required>
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

		<!-- //////////////////////////// -->