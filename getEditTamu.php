<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_tamu = $_GET['id_tamu'];

$db->where('id_tamu', $id_tamu);
$id_tamu = $db->getOne('tamu');

if ($id_tamu) {
	echo json_encode($id_tamu);
} else {
	// echo $db->getLastError();
	echo json_encode('gagal '. $db->getLastError());
}

?>