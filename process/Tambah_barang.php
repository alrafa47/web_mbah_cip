<?php 
include '../assets/koneksi.php';
$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$hrgbl = $_POST['hrgbl'];
$hrgjl = $_POST['hrgjl'];
$stok = $_POST['stok'];

$name = $_FILES['file']['name'];
$x = explode('.', $name);
$ext = strtolower(end($x));
$temp = $_FILES['file']['tmp_name'];
$format = array('jpg', 'png');
$file = "../gambar/".$name;

if (in_array($ext, $format)== true) {
	move_uploaded_file($temp, $file);
	mysql_query("insert into barang values('', '$nama', '$jenis', '$hrgbl', '$hrgjl', '$name','$stok')") or die(mysql_error());

}
else{
	mysql_query("insert into barang values('', '$nama', '$jenis', '$hrgbl', '$hrgjl', 'ekstensi tidak didukung','$stok')") or die(mysql_error());

}
header("location: ../index.php");

 ?>