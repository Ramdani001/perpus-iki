<?php 

include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id = $_POST['id'];
$type = $_POST['type'];

switch ($type) {
	case 'anggota':
		$db->where('id_anggota', $id);
		$del = $db->delete('anggota');
		if ($del) {
			echo json_encode('Berhasil hapus');
		} else {
			echo json_encode('Gagal hapus');
		}
		break;

	case 'buku':
		$db->where('id_buku', $id);
		$del = $db->delete('buku');
		if ($del) {
			echo json_encode('Berhasil hapus');
		} else {
			echo json_encode('Gagal hapus');
		}
		break;
	case 'akun':
		$db->where('id_admin', $id);
		$del = $db->delete('admin');
		if ($del) {
			echo json_encode('Berhasil hapus');
		} else {
			echo json_encode('Gagal hapus');
		}
		break;
	default:
		# code...
		break;
}

?>