<?php

/*
 * DataTables example server-side processing script.
 *
 * Please note that this script is intentionally extremely simply to show how
 * server-side processing can be implemented, and probably shouldn't be used as
 * the basis for a large complex system. It is suitable for simple use cases as
 * for learning.
 *
 * See http://datatables.net/usage/server-side for full details on the server-
 * side processing requirements of DataTables.
 *
 * @license MIT - http://datatables.net/license_mit
 */

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * Easy set variables
 */

// DB table to use
$table = 'transaksi';

// Table's primary key
$primaryKey = 'id_transaksi';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db' => '`a`.`nama`', 'dt' => 0, 'field' => 'nama'),
	array('db' => '`b`.`judul`', 'dt' => 1, 'field' => 'judul'),
	array('db' => '`t`.`tgl_pinjam`',  'dt' => 2, 'field' => 'tgl_pinjam'),
	array('db' => '`t`.`tgl_kembali`',   'dt' => 3, 'field' => 'tgl_kembali'),
	array('db' => 'status_kembali', 'dt' => 4, 'field' => 'status_kembali', 'formatter' => function ($d, $row) {
		return $a = ($d == '1') ? 'Kembali' : 'Belum Kembali';
	}),
	array('db' => 'id_transaksi', 'dt' => 5, 'formatter' => function ($d, $row) {
		// return "<a class='btn btn-xs btn-round btn-info' href=edit.php?id_kar=".$d.">Edit</a>";
		$a = "<button class='btn btn-xs btn-warning' type='button' onClick=aksiCekDenda(" . $d . ")>
			Cek Denda
		</button> ";
		$c = ($row[4] == "1") ? "<button class='btn btn-xs btn-success' type='button' disabled>
			Sudah DiKembalikan
		</button> " : "<button class='btn btn-xs btn-danger' type='button' onClick=aksiPengembalian(" . $d . ")>
            Kembalikan 
        </button> ";
		return $a . $c;
	}, 'field' => 'id_transaksi'),
);
// echo json_encode($columns);
// SQL server connection information
require('config.php');
$sql_details = array(
	'user' => $db_username,
	'pass' => $db_password,
	'db'   => $db_name,
	'host' => $db_host
);

/* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
 * If you just want to use the basic configuration for DataTables with PHP
 * server-side, there is no need to edit below this line.
 */

// require( 'ssp.class.php' );
require('ssp.customized.class.php');

$joinQuery = "FROM `transaksi` AS `t` JOIN `anggota` AS `a` ON (`t`.`anggota_id` = `a`.`id_anggota`) JOIN `buku` AS `b` ON (`t`.`buku_id` = `b`.`id_buku`)";
// $extraWhere = "`t`.`status_kembali` = '0'";
$extraWhere = "";

echo json_encode(
	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
