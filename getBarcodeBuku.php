<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak kartu anggota</title>
	<link rel="stylesheet" href="">
	<style>
		@media print {
			.cetak {
				display: none;
				height: 0;
			}

		}

		#batasCetakBuku {
			padding: 10px;
			width: 450px;
			height: 100px;
			border: 1px solid gray;
			padding-bottom: 60px;
			border-collapse: collapse;
			display: inline-flex
		}

		#barcodeBuku {
			width: 300px;
			position: absolute;
			margin-top: 120px;
		}

		#barcodeBuku img {
			width: 350px;
			height: 30px;
		}
	</style>
</head>

<body>
	<?php
	include('system/php-mysqli/MysqliDb.php');
	include('system/php-barcode/src/BarcodeGenerator.php');
	include('system/php-barcode/src/BarcodeGeneratorPNG.php');
	include('system/php-barcode/src/BarcodeGeneratorHTML.php');

	$db = new MysqliDb();
	$barcode = new Picqer\Barcode\BarcodeGeneratorHTML();
	$barcodepng = new Picqer\Barcode\BarcodeGeneratorPNG();

	$id = $_GET['uid'];
	$db->where('uid_buku', $id);
	$ang = $db->getOne('buku');

	$db->where('id_kategori', $ang['kategori']);
	$kat = $db->getOne('kategori');

	$db->where('id_rak', $ang['rak']);
	$rak = $db->getOne('rak');
	?>
	<button class="cetak" id="cetak" onclick="cetak()">Cetak</button>
	<p></p>

	<div id="batasCetakBuku">
		<table>
			<tr rowspan="2">
			<tr>
				<td>Kode Buku &nbsp;</td>
				<td> : &nbsp;</td>
				<td>
					<?php echo $ang['uid_buku'] ?>
				</td>
			</tr>
			<tr>
				<td>Judul Buku</td>
				<td>:</td>
				<td>
					<?php echo $ang['judul'] ?>
				</td>
			</tr>
			<tr>
				<td>Pengarang</td>
				<td>:</td>
				<td>
					<?php echo $ang['pengarang'] ?>
				</td>
			</tr>
			<tr>
				<td>Penerbit</td>
				<td>:</td>
				<td>
					<?php echo $ang['penerbit'] ?>
				</td>
			</tr>
			<tr>
				<td>ISBN</td>
				<td>:</td>
				<td>
					<?php echo $ang['isbn'] ?>
				</td>
			</tr>
			</tr>
			<table class="" style="margin-left: 20px;">
				<tr>
					<td>Tahun &nbsp;</td>
					<td>: &nbsp;</td>
					<td>
						<?php echo $ang['tahun'] ?>
					</td>
				</tr>
				<tr>
					<td>Stok Buku</td>
					<td>:</td>
					<td>
						<?php echo $ang['stok'] ?>
					</td>
				</tr>
				<tr>
					<td>Rak</td>
					<td>:</td>
					<td>
						<?php echo $rak['nama_rak'] ?>
					</td>
				</tr>
				<tr>
					<td>Kategori Buku</td>
					<td>:</td>
					<td>
						<?php echo $kat['nama_kategori'] ?>
					</td>
				</tr>
			</table>

		</table>
		<div id="barcodeBuku">
			<img src="data:image/png;base64,<?= base64_encode($barcodepng->getBarcode($ang['uid_buku'], $barcodepng::TYPE_CODE_128)) ?>" alt="">
		</div>
	</div>

</body>
<script type="text/javascript">
	function cetak() {
		window.print();
	}
</script>

</html>