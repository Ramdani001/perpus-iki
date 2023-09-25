<?php
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

// ambil inputan
$type = $_POST['type'];
$id_buku = $_POST['id_buku'];
$kodeBuku = $_POST['kodeBuku'];
$judul = ucwords($_POST['judul']);
$pengarang = ucwords($_POST['pengarang']);
$penerbit = ucwords($_POST['penerbit']);
$isbn = $_POST['isbn'];
$tahun = $_POST['tahun'];
$stok = $_POST['stok'];
$rak = $_POST['rak'];
$kategori = $_POST['kategori'];

// jadikan array
$dataInput = array(
	'id_buku' => $id_buku,
	'uid_buku' => $kodeBuku,
	'judul' => $judul,
	'pengarang' => $pengarang,
	'penerbit' => $penerbit,
	'isbn' => $isbn,
	'tahun' => $tahun,
	'stok' => $stok,
	'rak' => $rak,
	'kategori' => $kategori
);

switch ($type) {
	case 'new':
		$pesan = $db->insert('buku', $dataInput);

		if ($pesan) {
			echo json_encode(array('pesan' => "Tambah berhasil", 'type' => 'success'));
		} else {
			echo json_encode(array('pesan' => 'Gagal ' . $db->getLastError(), 'type' => 'error'));
		}
		break;

	case 'edit':
		$db->where('id_buku', $id_buku);
		$pesan = $db->update('buku', $dataInput);
		if ($pesan) {
			echo json_encode(array('pesan' => "Edit berhasil", 'type' => 'success'));
		} else {
			echo json_encode(array('pesan' => 'Gagal ' . $db->getLastError(), 'type' => 'error'));
		}
		break;

	default:
		echo json_encode('Gagal, error tidak diketahui ');
		break;
}
