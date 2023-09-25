<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Cetak buku</title>
	<link rel="stylesheet" href="">
	<style>
		@media print {
			.cetak {
				display: none;
				height: 0;
			}
		}

		table {
			border-collapse: collapse;
			width: 100%;

		}
	</style>
</head>

<body>
	<BUTTON class="cetak" type="button" onclick="cetak();" id="cetak">Cetak</BUTTON>
	<CENTER>
		<h2>DAFTAR BUKU PERPUSTAKAAN SMA PASUNDAN 7 BANDUNG</h2>
	</CENTER>
	<?php
	include('system/php-mysqli/MysqliDb.php');
	$db = new MysqliDb();
	$kat = $_GET['kat'];
	?>
	<table border="1" cellpadding="4">
		<thead>
			<tr>
				<th>No</th>
				<th>Judul</th>
				<th>Pengarang</th>
				<th>Penerbit</th>
				<th>ISBN</th>
				<th>Tahun</th>
				<th>UID</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if ($kat == '*') {
				$pilih = $db->get('buku');
			} else {
				$db->where('kategori', $kat);

				$pilih = $db->get('buku');
			}

			foreach ($pilih as $key) { ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $key['judul'] ?></td>
					<td><?= $key['pengarang'] ?></td>
					<td><?= $key['penerbit'] ?></td>
					<td><?= $key['isbn'] ?></td>
					<td><?= $key['tahun'] ?></td>
					<td><?= $key['uid_buku'] ?></td>
				</tr>
			<?php $no++;
			}
			?>

		</tbody>
	</table>
	<script>
		function cetak() {
			// body...
			window.print();
		}
	</script>
</body>

</html>