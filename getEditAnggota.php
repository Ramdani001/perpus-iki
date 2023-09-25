<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_ang = $_GET['id_ang'];

$db->where('id_anggota', $id_ang);
$data_ang = $db->getOne('anggota');

if ($data_ang) {
	echo json_encode($data_ang);
} else {
	// echo $db->getLastError();
	echo json_encode('gagal '. $db->getLastError());
}

?>