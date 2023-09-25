<?php
include('system/php-mysqli/MysqliDb.php');

$db = new MysqliDb();

$type = $_GET['type'];
// echo json_encode($type);
switch ($type) {
	case 'anggota':
		$uid_ang = $_GET['uid_ang'];
		$db->where('uid', $uid_ang);
		$data = $db->getOne('anggota');
		if ($data) {
			echo json_encode($data);
		} else {
			echo json_encode(array('nama' => 'Data tidak valid'));
		}
		break;

	case 'buku':

		$uid_buku = $_GET['uid_buku'];
		$inptIdAnggota = $_GET['inptIdAnggota'];
		$idlist = $inptIdAnggota + 1;

		$db_username 	= 'root';
		$db_password 	= '';
		$db_name 		= 'perpus_barcode';
		$db_host 		= 'localhost';

		// Create connection
		$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
		// Check connection

		$state = mysqli_query($conn, "SELECT * FROM listorderbuku");
		$countState = mysqli_num_rows($state);

		if ($countState < 1) {

			$query = "INSERT INTO listorderbuku VALUES ('', '$idlist', '$inptIdAnggota', '$uid_buku', 'false')";
			$insert = mysqli_query($conn, $query);

			$db->where('uid_buku', $uid_buku);
			$data = $db->getOne('buku');

			if ($data) {
				echo json_encode($data);
			} else {
				echo json_encode(array('pesan' => 'Data tidak valid', 'stok' => ''));
			}
		} else {
			// echo json_encode("ISI");
			$listOrder = mysqli_query($conn, "SELECT * FROM listorderbuku WHERE id_buku='$uid_buku' AND id_anggota='$inptIdAnggota' AND status='1' ");
			if (mysqli_num_rows($listOrder) < 1) {
				$query = "INSERT INTO listorderbuku VALUES ('', '$idlist', '$inptIdAnggota', '$uid_buku', 'false')";
				$insert = mysqli_query($conn, $query);
				// echo json_encode($insert);

				$db->where('uid_buku', $uid_buku);
				$data = $db->getOne('buku');
				if ($data) {
					echo json_encode($data);
				} else {
					echo json_encode(array('nama' => 'Data tidak valid', 'stok' => ''));
				}
			} else {
				echo json_encode(array('pesan' => 'Buku Sudah Ditambahkan'));
			}
		}

		break;

	case 'detailListBuku':

		$db_username 	= 'root';
		$db_password 	= '';
		$db_name 		= 'perpus_barcode';
		$db_host 		= 'localhost';

		// Create connection
		$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

		$id_buku = $_GET['id_buku'];
		$idSendList = $_GET['idSendList'];

		// $isiCariBuku= [];
		// for($i=0; $i < strlen($id_buku); $i++){

			foreach ($id_buku as $id) {
				$queryGetBuku = "SELECT * FROM buku WHERE uid_buku='$id'";
				$cariBuku = mysqli_query($conn, $queryGetBuku);
		
				// Periksa apakah query dieksekusi dengan sukses
				if ($cariBuku) {
					$countBuku = mysqli_num_rows($cariBuku);
		
					if ($countBuku > 0) {
						// Ambil hasil query sebagai asosiatif array
						$isiCariBuku[] = mysqli_fetch_assoc($cariBuku);
		
						// Sekarang Anda memiliki data buku yang sesuai dengan $id
					} else {
						echo "Buku dengan ID $id tidak ditemukan.";
					}
				} else {
					echo "Error dalam menjalankan query: " . mysqli_error($conn);
				}
			}


		// }

		$sendData = [
			"countBuku" => $countBuku,
			"idSendList" => $idSendList,
			"isiCariBuku" => $isiCariBuku,
		];

		// echo json_encode($isiCariBuku);
		echo json_encode($sendData);

		break;
	case 'hapusListOrderBuku':

		$db_username 	= 'root';
		$db_password 	= '';
		$db_name 		= 'perpus_barcode';
		$db_host 		= 'localhost';

		// Create connection
		$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
		
		$id_list = $_GET['id_list'];

		$query = "DELETE FROM listorderbuku WHERE id='$id_list'";
		$exc = mysqli_query($conn, $query);

		if($exc){
			$pesan = "Data Berhasil Dihapus";
		}else{
			$pesan = "Data Berhasil Dihapus";
		}

		$dataSend = [
			"pesan" => $pesan,
			"id_list" => $id_list,
		];

		echo json_encode($dataSend);


	default:
		# code...
		break;
}
