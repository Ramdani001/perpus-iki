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
		<h2>DAFTAR ANGGOTA PERPUSTAKAAN SMA PASUNDAN 7 BANDUNG</h2>
	</CENTER>
	<?php
	include('system/php-mysqli/MysqliDb.php');
	$db = new MysqliDb();
	$status = $_GET['status'];
	?>
	<table border="1" cellpadding="4">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>TTL</th>
				<th>Tgl daftar</th>
				<th>Tgl berakhir</th>
				<th>UID</th>
				<th>Status</th>
			</tr>
		</thead>
		<tbody>
			<?php
			$no = 1;
			if ($status == '*') {
				$pilih = $db->get('anggota');
			} else {
				$db->where('status_aktif', $status);

				$pilih = $db->get('anggota');
			}

			foreach ($pilih as $key) { ?>
				<tr>
					<td><?= $no ?></td>
					<td><?= $key['nama'] ?></td>
					<td><?= $key['ttl'] ?></td>
					<td><?= $key['tgl_daftar'] ?></td>
					<td><?= $key['tgl_berakhir'] ?></td>
					<td><?= $key['uid'] ?></td>
					<td><?= $key['status_aktif'] == '1' ? 'Aktif' : 'Tdk Aktif' ?></td>
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