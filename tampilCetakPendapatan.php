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

	<?php
	include('system/php-mysqli/MysqliDb.php');
	$db = new MysqliDb();
	$get_tgl = $_GET['tgl'];
	$tgl = date('m', strtotime($get_tgl));
	?>
	<CENTER>
		<h3>DAFTAR PENDAPATAN PERPUSTAKAAN SMA PASUNDAN 7 BANDUNG BULAN <?= $tgl ?></h3>
	</CENTER>
	<table border="1" cellpadding="4">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>Judul</th>
				<th>Waktu</th>
				<th>Telat</th>
				<th>Bayar</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			$query = "SELECT p.transaksi_id, p.created_at, p.total, a.nama, b.judul, t.telat_per_hari FROM pendapatan AS p JOIN transaksi AS t ON (p.transaksi_id = t.id_transaksi) JOIN buku AS b ON (t.buku_id = b.id_buku) JOIN anggota AS a ON (t.anggota_id = a.id_anggota) where month(p.created_at) = '$tgl'";
			$hasil = $db->rawQuery($query);

			// print_r($hasil);

			foreach ($hasil as $key) { ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $key['nama'] ?></td>
					<td><?= $key['judul'] ?></td>
					<td><?= $key['created_at'] ?></td>
					<td><?= $key['telat_per_hari'] ?> Hari</td>
					<td>Rp <?= $key['total'] ?></td>

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