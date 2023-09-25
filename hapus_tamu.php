<?php 

include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id = $_POST['id'];
$type = $_POST['type'];

switch ($type) {
	case 'tamu':
		$db->where('id_tamu', $id);
		$del = $db->delete('tamu');
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
	default:
		# code...
		break;
}

?>