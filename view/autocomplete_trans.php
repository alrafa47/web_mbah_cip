<?php 
	mysql_connect('localhost', 'root', '');
	mysql_select_db('appgudang');
	
	$term = strtolower($_GET['term']);
	$query = mysql_query("select * from barang join transaksi on barang.idbarang= transaksi.idbarang where barang.nama like '%$term%' order by barang.idbarang asc");

	while ($q = mysql_fetch_assoc($query)) {
		$data[]= $q['nama'];
	}
	echo json_encode($data);
 ?>