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
$table = 'buku';

// Table's primary key
$primaryKey = 'id_buku';

// Array of database columns which should be read and sent back to DataTables.
// The `db` parameter represents the column name in the database, while the `dt`
// parameter represents the DataTables column identifier. In this case simple
// indexes
$columns = array(
	array('db' => '`b`.`uid_buku`', 'dt' => 0, 'field' => 'uid_buku'),
	array('db' => '`b`.`judul`', 'dt' => 1, 'field' => 'judul'),
	array('db' => '`b`.`pengarang`',  'dt' => 2, 'field' => 'pengarang'),
	array('db' => '`b`.`penerbit`',   'dt' => 3, 'field' => 'penerbit'),
	array('db' => '`b`.`isbn`',   'dt' => 4, 'field' => 'isbn'),
	array('db' => '`b`.`tahun`',   'dt' => 5, 'field' => 'tahun'),
	array('db' => '`b`.`stok`',   'dt' => 6, 'field' => 'stok'),
	array('db' => '`r`.`nama_rak`', 'dt' => 7, 'field' => 'nama_rak'),
	array('db' => '`k`.`nama_kategori`', 'dt' => 8, 'field' => 'nama_kategori'),
	array('db' => '`b`.`id_buku`', 'dt' => 9, 'formatter' => function ($d, $row) {
		// return "<a class='btn btn-xs btn-round btn-info' href=edit.php?id_kar=".$d.">Edit</a>";
		$a = "<button class='btn btn-xs btn-success' type='button' onClick=editModal(" . $d . ")>
		<i class='fa-solid fa-pen-to-square'></i>
		</button> ";
		$a .= "<button class='btn btn-xs btn-danger' type='button' onClick=deleteModal(" . $d . ")>
		<i class='fa-solid fa-trash'></i>
		</button> ";
		$a .= "<button class='btn btn-xs btn-primary' type='button' onClick=cetakBarcodeBuku(" . $row[0] . ")>
		<i class='fa-solid fa-print'></i>
		</button> ";
		return $a;
	}, 'field' => 'id_buku'),
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

$joinQuery = "FROM `buku` AS `b` JOIN `rak` AS `r` ON (`b`.`rak` = `r`.`id_rak`) JOIN `kategori` AS `k` ON (`b`.`kategori` = `k`.`id_kategori`)";
// $extraWhere = "`u`.`salary` >= 90000";
$extraWhere = "";

echo json_encode(
	SSP::simple($_GET, $sql_details, $table, $primaryKey, $columns, $joinQuery, $extraWhere)
);
