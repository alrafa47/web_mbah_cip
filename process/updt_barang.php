<?php 
include '../assets/koneksi.php';
$id = $_POST['id'];
$nama = $_POST['nama'];
$jenis = $_POST['jenis'];
$hrgbl = $_POST['hrgbeli'];
$hrgjl = $_POST['hrgjual'];
$stok = $_POST['stok'];


$name = $_FILES['file']['name'];
$x = explode('.', $name);
$ext = strtolower(end($x));
$temp = $_FILES['file']['tmp_name'];
$format = array('jpg', 'png');
$file = "../gambar/".$name;



if (in_array($ext, $format)== true) {
		if (is_uploaded_file($_FILES['file']['tmp_name'])) {
move_uploaded_file($temp, $file);
	mysql_query("update barang set idbarang='$id', nama='$nama', jenis='$jenis', hrgbeli='$hrgbl', hrgjual='$hrgjl', stok='$stok', gambar='$name' where idbarang ='$id'") or die(mysql_error());
	}
}
else{
	mysql_query("update barang set idbarang='$id', nama='$nama', jenis='$jenis', hrgbeli='$hrgbl', hrgjual='$hrgjl', stok='$stok',gambar='ekstensi tidak didukung' where idbarang ='$id'") or die(mysql_error());

}
header("location: /mbhcip2/index.php");

 ?>