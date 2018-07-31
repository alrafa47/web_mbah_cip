<?php 
include 'assets/koneksi.php';
?>

<style type="text/css">
	#footer{
		text-align: center;
	}
	th{
		background-color: red;
	}
</style>
<div class="col-md-10 panel panel-info" style="padding: 0px;">
	


	<div class="panel-heading">
		<h3 class="box-title"><span class="glyphicon glyphicon-home"></span> Dashboard</h3>
	</div>
	<div class="panel-body">
		<table class="table table-bordered table-striped" >
			<tr>
				<th>
					Nama Barang 
				</th>
				<th>
					Jenis
				</th>
				<th>
					Stok
				</th>
				<th>
					aksi
				</th>
			</tr>
			<?php 

			$cari = mysql_query("select * from barang where stok <=1");
			$htng= mysql_num_rows($cari);
			if ($htng != 0) {
				while ($q= mysql_fetch_assoc($cari)) {?>
				<tr>
					<td>
						<?php echo $q['nama']; ?>
					</td>
					<td>
						<?php echo $q['jenis']; ?>
					</td>
					<td>
						<?php echo $q['stok'] ?>
					</td>
					<td>
						aksi
					</td>
				</tr>

				<?php
			}

			}
			else{
				echo "<tr> 
				<td colspan='4' style='text-align:center;' height='275px'>
				<div style='padding-top:95px'>
				<h3>Tidak ada data</h3> </div>
				</td>
				</tr>";
			}
			?>




		</table>
	</div>
	<footer>
		
	<div class="panel-footer">
		<div class="row">

			<div class="col-md-6" style="border-right: 1px gray solid">
				<div id="footer">
					<label>
						
						<?php 
						echo "jumlah barang"."</br>";
						$barang= mysql_query("select * from barang");
						$tampil=mysql_num_rows($barang);
						echo $tampil;
						?>
					</label>
				</div>
			</div>
			<div class="col-md-6">
				<div id="footer">
					<label>
						
						<?php 
						echo "jumlah transaksi"."</br>";
						$barang= mysql_query("select * from barang");
						$tampil3=mysql_num_rows($barang);
						echo $tampil3;
						?>
					</label>
				</div>
			</div>
		</div>
	</div>
	</footer>

</div>
