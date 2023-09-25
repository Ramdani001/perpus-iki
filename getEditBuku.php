<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_buku = $_GET['id_buku'];

$db->where('id_buku', $id_buku);
$data_ang = $db->getOne('buku');

if ($data_ang) {
	echo json_encode($data_ang);
} else {
	// echo $db->getLastError();
	echo json_encode('gagal '. $db->getLastError());
}

?>