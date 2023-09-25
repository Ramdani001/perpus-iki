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

	
function formatBulan($bulan)
{
	$pilih = array(
		01 =>   'Januari',
		'Februari',
		'Maret',
		'April',
		'Mei',
		'Juni',
		'Juli',
		'Agustus',
		'September',
		'Oktober',
		'November',
		'Desember'
	);

	return $pilih[(int)$bulan];
}

	?>
	<CENTER>
		<h3>DAFTAR TAMU PERPUSTAKAAN <br> SMA PASUNDAN 7 BANDUNG <br> BULAN <?= formatBulan($tgl) ?></h3>
	</CENTER>
	<table border="1" cellpadding="4">
		<thead>
			<tr>
				<th>No</th>
				<th>Nama</th>
				<th>instansi</th>
				<th>keperluan</th>
				<th>Tanggal Kedatangan</th>
			</tr>
		</thead>
		<tbody>
			<?php

			
			$db_username 	= 'root';
			$db_password 	= '';
			$db_name 		= 'perpus_barcode';
			$db_host 		= 'localhost';

			// Create connection
			$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
			// Check connection

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$no = 1;
			$query = "SELECT * FROM tamu where month(tgl_kedatangan) = '$tgl'";
			// $ambil = mysqli_query($conn, $query);
			$hasil = $db->rawQuery($query);

			
			//  var_dump($hasil);
			//  die();
			foreach ($hasil as $key) { ?>
				<tr>
				<td><?= $no ?></td>
					<td><?= $key['nama'] ?></td>
					<td><?= $key['instansi'] ?></td>
					<td><?= $key['keperluan'] ?></td>
					<td style="text-align: center;"><?= $key['tgl_kedatangan'] ?></td>

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