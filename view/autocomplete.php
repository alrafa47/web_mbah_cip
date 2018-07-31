<?php 
	mysql_connect('localhost', 'root', '');
	mysql_select_db('appgudang');
	
	$term = strtolower($_GET['term']);
	$query = mysql_query("select * from barang where nama like '%$term%' order by idbarang asc");

	while ($q = mysql_fetch_assoc($query)) {
		$data[]= $q['nama'];
	}
	echo json_encode($data);
 ?>