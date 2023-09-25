<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_admin = $_GET['id_admin'];

$db->where('id_admin', $id_admin);
$data_admin = $db->getOne('admin');

if ($data_admin) {
	echo json_encode($data_admin);
} else {
	// echo $db->getLastError();
	echo json_encode('gagal '. $db->getLastError());
}

?>