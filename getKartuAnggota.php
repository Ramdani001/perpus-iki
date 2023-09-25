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

			.namakartu {
				font-family: arial;
				font-size: 14px;
				text-align: center;
			}

			.namajl {
				font-size: 11px;
				text-align: center;
			}

			.namasd {
				font-size: 18px;
				text-align: center;
				font-weight: bold;
			}

			tr.border_bawah {

				border-bottom: solid 1px #000;
			}

			table {
				width: 500px;
				/*table-layout: fixed;*/
				border-collapse: collapse;
			}
		}

		/*untuk tampil sblm cetak klik*/
		.namakartu {
			font-family: arial;
			font-size: 14px;
			text-align: center;
		}

		.namajl {
			font-size: 11px;
			text-align: center;
		}

		.namasd {
			font-size: 18px;
			text-align: center;
			font-weight: bold;
		}

		tr.border_bawah {

			border-bottom: solid 1px #000;
		}

		table {
			margin-top: 10px;
			width: 500px;
			/*table-layout: fixed;*/
			border-collapse: collapse;

		}

		.batasCetak {
			width: 500px;
			border: 1px solid gray;

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
	$db->where('uid', $id);
	$ang = $db->getOne('anggota');
	?>
	<button class="cetak" id="cetak" onclick="cetak()">Cetak</button>
	<p></p>
	<div class="batasCetak">
		<table class="tab">
			<!-- header -->
			<tr>
				<td rowspan="4">
					<img src="assets/images/logoSMA.png" alt="" width="50" height="50" style="margin-left: 10px; margin-top: -30px; position: absolute;">
				</td>
			</tr>
			<tr>
				<td class="namakartu">KARTU PERPUSTAKAAN</td>
			</tr>
			<tr>
				<td class="namasd">SMA PASUNDAN 7 BANDUNG</td>
			</tr>
			<tr class="border_bawah">
				<td class="namajl">Jl. Kebo Jati No.31, Kb. Jeruk, Kec. Andir, Kota Bandung, Jawa Barat 40181</td>
			</tr>
		</table>
		<!-- isi -->
		<table class="tab" style="margin-left: 5px;">

			<tr>
				<td rowspan="9"><img src="assets/FtProfil/<?= $ang['gambar'] ?>" alt="" width="135" height="110"></td>
			</tr>

			<tr>
			<tr>
				<td>ID Anggota</td>
				<td>:</td>
				<td><?= $ang['uid'] ?></td>
			</tr>
			<tr>
				<td>Nama</td>
				<td>:</td>
				<td><?= $ang['nama'] ?></td>
			</tr>
			<tr>
				<td>Kelas</td>
				<td>:</td>
				<td><?= $ang['kelas'] ?></td>
			</tr>
			<tr>
				<td>Tempat, Tanggal Lahir</td>
				<td>:</td>
				<td><?= $ang['ttl'] ?></td>
			</tr>
			<tr>
				<td>No Telepon</td>
				<td>:</td>
				<td><?= $ang['no_telepon'] ?></td>
			</tr>
			<tr>
				<td>Masa berlaku</td>
				<td>:</td>
				<td><?= $ang['tgl_berakhir'] ?></td>
			</tr>
			<tr>
				<td>Gambar</td>
				<td>:</td>
				<td><?php //$barcode->getBarcode($ang['id_anggota'], $barcodepng::TYPE_CODE_128); 
					?>
					<img src="data:image/png;base64,<?= base64_encode($barcodepng->getBarcode($ang['uid'], $barcodepng::TYPE_CODE_128)) ?>" alt="">
				</td>
			</tr>
			</tr>
		</table>
	</div>
</body>
<script type="text/javascript">
	function cetak() {
		window.print();
	}
</script>

</html>