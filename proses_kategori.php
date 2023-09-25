<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

// ambil inputan
$type = $_POST['type'];

$nama = $_POST['nama_kategori'];

// jadikan array
$dataInput = array(
	'nama_kategori'=>ucwords($nama)
	);

switch ($type) {
	case 'new':
		$pesan = $db->insert('kategori', $dataInput);

		if ($pesan) {
			// echo json_encode(array('pesan'=>"Tambah berhasil", 'type'=>'success'));
			echo "<script>alert('Tambah berhasil')</script>";
			echo "<script>window.location.href='kategori.php'</script>";
		} else {
			// echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
			echo "<script>alert('Tambah gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;

	case 'edit':
		$id = $_POST['id_kategori'];
		$db->where('id_kategori', $id);
		$pesan = $db->update('kategori', $dataInput);
		if ($pesan) {
			echo "<script>alert('Edit berhasil')</script>";
			echo "<script>window.location.href='kategori.php'</script>";
			// echo json_encode(array('pesan'=>"Edit berhasil", 'type'=>'success'));
		} else {
			echo "<script>alert('Edit gagal')</script>";
			echo "<script>history.back()</script>";
			// echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
		}
		break;
	
	default:
		echo json_encode('Gagal, error tidak diketahui ');
		break;
}
?>