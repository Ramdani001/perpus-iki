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
$table = 'pendapatan';

// Table's primary key
$primaryKey = 'id_pendapatan';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db' => '`a`.`nama`', 'dt' => 0, 'field' => 'nama'),
	array('db' => '`b`.`judul`', 'dt' => 1, 'field' => 'judul'),
	array('db' => '`p`.`created_at`',  'dt' => 2, 'field' => 'created_at'),
	array('db' => '`t`.`telat_per_hari`',   'dt' => 3, 'field' => 'telat_per_hari',  'formatter' => function ($d, $row) {
		$a = $d . ' Hari';
		return $a;
	}),
	array('db' => '`p`.`total`', 'dt' => 4, 'field' => 'total', 'formatter' => function ($d, $row) {
		$a = 'Rp ' . $d;
		return $a;
	}),
);

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

$joinQuery = "FROM `pendapatan` AS `p` JOIN `transaksi` AS `t` ON (`p`.`transaksi_id` = `t`.`id_transaksi`) JOIN `buku` AS `b` ON (`t`.`buku_id` = `b`.`id_buku`) 
	JOIN `anggota` AS `a` ON (`t`.`anggota_id` = `a`.`id_anggota`)";
// $extraWhere = "`t`.`status_kembali` = '0'";
$extraWhere = "";

echo json_encode(
	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
