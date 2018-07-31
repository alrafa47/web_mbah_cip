<?php
include 'assets/koneksi.php';
require('assets/pdf/fpdf.php');

$pdf = new FPDF("L","cm","A4");

$pdf->SetMargins(2,1,1);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','B',14);
$pdf->Cell(25.5,0.7,"APP INVENTARIS CIPTO SERVICE",0,10,'C');
$pdf->SetX(1);
$pdf->MultiCell(19.5,0.5,'Telpon : XXXXXXXXXX',0,'L');    
$pdf->SetFont('Arial','B',10);
$pdf->SetX(1);
$pdf->MultiCell(19.5,0.5,'Alamat : Jl.------------------',0,'L');
$pdf->SetFont('Arial','B',10);
$pdf->SetX(4);
$pdf->Line(1,3.1,28.5,3.1);
$pdf->SetLineWidth(0.1);      
$pdf->Line(1,3.2,28.5,3.2);   
$pdf->SetLineWidth(0);
$pdf->ln(1);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(25.5,0.7,"Laporan Transaksi Barang",0,10,'C');
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->ln(1);
$pdf->SetFont('Arial','B',10);
$pdf->Cell(1, 0.8, 'NO', 1, 0, 'C');
$pdf->Cell(7, 0.8, 'Nama Barang', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Jenis', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Harga Jual', 1, 0, 'C');
$pdf->Cell(3.5, 0.8, 'Harga Beli', 1, 0, 'C');
$pdf->Cell(2, 0.8, 'Jumlah', 1, 0, 'C');
$pdf->Cell(4, 0.8, 'Tanggal Transaksi', 1, 1, 'C');
$pdf->SetFont('Arial','',10);
$no=1;
$query=mysql_query("select * from barang join transaksi on barang.idbarang=transaksi.idbarang");
while($lihat=mysql_fetch_array($query)){
	$pdf->Cell(1, 0.8, $no , 1, 0, 'C');
	$pdf->Cell(7, 0.8,  $lihat['nama'],1, 0, 'C');
	$pdf->Cell(3.5, 0.8, $lihat['jenis'], 1, 0,'C');
	$pdf->Cell(3.5, 0.8, 'Rp. '. $lihat['hrgjual'],1, 0, 'C');
	$pdf->Cell(3.5, 0.8,'Rp. '. $lihat['hrgbeli'], 1, 0,'C');
	$pdf->Cell(2, 0.8, $lihat['jumlah'],1, 0, 'C');
	$pdf->Cell(4, 0.8, $lihat['tgl_transaksi'], 1, 1,'C');

	$no++;
}

$pdf->Output("laporan_buku.pdf","I");

?>

