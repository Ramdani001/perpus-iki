<?php 
include('system/php-mysqli/MysqliDb.php');
$db = new MysqliDb();

$id_tran = $_GET['id'];
$aksi = $_GET['aksi'];

//ambil nominal denda
$nominal = $db->getOne('denda');
$query = "SELECT id_transaksi, datediff(current_date(), tgl_kembali) as denda from transaksi where id_transaksi = '$id_tran'";
$cekdenda = $db->rawQuery($query);

switch ($aksi) {
	case 'denda':

		if ($cekdenda[0]['denda'] > 0) {
			$subtotal = $cekdenda[0]['denda'] * $nominal['nominal'];
			$total = array('jml_hari_telat'=>$cekdenda[0]['denda'], 'total_denda'=>$subtotal);
		} else {
			$total = array('jml_hari_telat'=> 0, 'total_denda'=>'Tidak ada denda');
		}
		echo json_encode($total);
		
		break;
	case 'kembalikan':		
		// list Order
		// udate stok buku
		$db->where('id_transaksi', $id_tran);
		$tran = $db->getOne('transaksi');

		$db->where('id_list', $tran['id_list']);
		$db->update('listorderbuku', array('status'=>'1'));

		// update status List Order Buku
		$db->where('id_buku', $tran['buku_id']);
		$db->update('buku', array('stok'=>$db->inc(1)));
		// update status_kembalikan
		// update telat_perhari
		$db->where('id_transaksi', $tran['id_transaksi']);
		$db->update('transaksi', array('status_kembali'=>'1', 'telat_per_hari'=>$cekdenda[0]['denda']));
		
		// insert ke tbl pendapatan
		if($cekdenda[0]['denda'] > 0){
			$total = $cekdenda[0]['denda'] * $nominal['nominal'];
			$db->insert('pendapatan', array('transaksi_id'=>$tran['id_transaksi'], 'total'=>$total));
		}
		
		echo json_encode(array('berhasil'=>'update_stok'));
		break;
	default:
		# code...
		break;
}
?>