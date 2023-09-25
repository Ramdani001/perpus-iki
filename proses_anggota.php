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

function formatTanggal($tanggal)
{
	$bulan = array(
		1 =>   'Januari',
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

	$pecahkan = explode('-', $tanggal);

	// variabel pecahkan 0 = tanggal
	// variabel pecahkan 1 = bulan
	// variabel pecahkan 2 = tahun

	return $pecahkan[2] . ' ' . $bulan[(int)$pecahkan[1]] . ' ' . $pecahkan[0];
}


// ambil inputan
$type = $_POST['type'];
$idAnggota = $_POST['idAnggota'];
$id_ang = $_POST['id_ang'];
$nama = $_POST['nama'];
$no_telepon = $_POST['no_telepon']; 
$kelas = $_POST['kelas'];
$tempat = $_POST['tempatLahir'];
$tanggal = $_POST['ttl'];
$tgl_daftar = $_POST['tgl_daftar'];
$tgl_berakhir = $_POST['tgl_berakhir'];
$status_aktif = $_POST['status_aktif'];

if ($type == 'new') {
	$ttl = $tempat . ', ' . formatTanggal($tanggal);

	$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
	$namaGambar = $_FILES['fileGambar']['name'];
	$x = explode('.', $namaGambar);
	$ekstensi = strtolower(end($x));
	$ukuran = $_FILES['fileGambar']['size'];
	$file_tmp = $_FILES['fileGambar']['tmp_name'];
	$filterArray = in_array($ekstensi, $ekstensi_diperbolehkan);
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$getGam =  'Anggota-' . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $ekstensi . '';


	if ($filterArray === true) {

		// $upload = move_uploaded_file($file_tmp, 'D:/Xampp/htdocs/revisi/perbar-master/assets/FtProfil/' . $getGam);
		$upload = move_uploaded_file($file_tmp, 'C:/xampp/htdocs/Terbaru/revisi/perbar-master/FtProfil' . $getGam);
		// var_dump($upload);
		// die();
		// var_dump($upload);
		// die();
		if ($upload) {
			$sql = "INSERT INTO anggota VALUES ( '', '$id_ang','$getGam', '$nama', '$no_telepon', '$kelas', '$ttl', '$tgl_daftar', '$tgl_berakhir', '$status_aktif')";
			$insert = mysqli_query($conn, $sql);
		}
	}

	// $sql = "INSERT INTO anggota VALUES ( '', '$id_ang','gambar.jpg', '$nama', '$ttl', '$tgl_daftar', '$tgl_berakhir', '$status_aktif')";

	// $insert = mysqli_query($conn, $sql);
	// var_dump($sql);
	// die();
	if ($insert === TRUE) {
		echo "<script>console.log('New record created successfully'); </script>";
		// echo "<script>alert('New record created successfully'); </script>";
		$conn->close();
		header("location:anggota.php");
	} else {
		echo '<script>console.log("Error: "' . $sql . '"<br>"' . $conn->error;
		'"))';
		$conn->close();
		header("location:anggota.php");
		// echo "<script>alert('New record created Error'); </script>";
	}

	// mengalihkan halaman kembali ke index.php
} else if ($type == 'edit') {
	$ttl = $tempat . ', ' . formatTanggal($tanggal);
	$gambarLama = $_POST['gambarLama'];
	if (!empty($gambarLama)) {
		$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
		$namaGambar = $_FILES['fileGambar']['name'];
		$x = explode('.', $namaGambar);
		$ekstensi = strtolower(end($x));
		$ukuran = $_FILES['fileGambar']['size'];
		$file_tmp = $_FILES['fileGambar']['tmp_name'];
		$filterArray = in_array($ekstensi, $ekstensi_diperbolehkan);
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$getGam =  'Anggota-' . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $ekstensi . '';

		if ($filterArray === true) {

			// update data ke database
			// $upload = move_uploaded_file($file_tmp, 'D:/Xampp/htdocs/revisi/perbar-master/assets/FtProfil/' . $getGam);
			$upload = move_uploaded_file($file_tmp, 'C:/xampp/htdocs/Terbaru/revisi/perbar-master/FtProfil' . $getGam);

			if ($upload) {
				$update = mysqli_query($conn, "UPDATE anggota set uid='$id_ang', gambar='$getGam' ,nama='$nama', no_telepon='$no_telepon', kelas='$kelas', ttl='$ttl', tgl_daftar='$tgl_daftar', tgl_berakhir='$tgl_berakhir', status_aktif='$status_aktif' where id_anggota='$idAnggota'");
			}
		} else {
			$update = mysqli_query($conn, "UPDATE anggota set uid='$id_ang', gambar='$gambarLama' ,nama='$nama', no_telepon='$no_telepon', kelas='$kelas', ttl='$ttl', tgl_daftar='$tgl_daftar', tgl_berakhir='$tgl_berakhir', status_aktif='$status_aktif' where id_anggota='$idAnggota'");
		}
	}



	if ($update) {
		echo json_encode(array('pesan' => "Edit berhasil", 'type' => 'success'));
		header("location:anggota.php");
	} else {
		echo json_encode(array('pesan' => 'Gagal ' . $db->getLastError(), 'type' => 'error'));
		header("location:anggota.php");
	}
	// mengalihkan halaman kembali ke index.php

}
