<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

// ambil inputan
$type = $_POST['type'];

$nama = $_POST['nominal'];

// jadikan array
$dataInput = array(
	'nominal'=>ucwords($nama)
	);

switch ($type) {
	case 'new':
		$db->get('denda');
		if ($db->count > 0) {
			echo "<script>alert('Nominal denda sudah ada!')</script>";
			echo "<script>window.location.href='denda.php'</script>";
			die();
		}

		$pesan = $db->insert('denda', $dataInput);

		if ($pesan) {
			// echo json_encode(array('pesan'=>"Tambah berhasil", 'type'=>'success'));
			echo "<script>alert('Tambah berhasil')</script>";
			echo "<script>window.location.href='denda.php'</script>";
		} else {
			// echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
			echo "<script>alert('Tambah gagal')</script>";
			echo "<script>history.back()</script>";
		}
		break;

	case 'edit':
		$id = $_POST['id_denda'];
		$db->where('id_denda', $id);
		$pesan = $db->update('denda', $dataInput);
		if ($pesan) {
			echo "<script>alert('Edit berhasil')</script>";
			echo "<script>window.location.href='denda.php'</script>";
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