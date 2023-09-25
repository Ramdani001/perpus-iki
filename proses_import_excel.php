<?php
// require 'vendor/autoload.php';
require_once __DIR__ . '/vendor/autoload.php';
use PhpOffice\PhpSpreadsheet\IOFactory;

$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'perpus_barcode'; 
$db_host 		= 'localhost';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
// Check connection

if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}
    $file_name = $_FILES['fileExcel']['name'];
    $file_data = $_FILES['fileExcel']['tmp_name'];

    $err = "";
    $ekstensi = "";
    $success = "";

    if(empty($file_name)){
        $err .= "<script> alert('Masukan File Yang Akan Di Import!!!!!') </script>";
    }else{
        $ekstensi = pathinfo($file_name)['extension'];
    }

    $ekstensi_allowed = array("xls", "xlsx");
    if(!in_array($ekstensi, $ekstensi_allowed)){
        $err .= "<script> alert('Silahkan Masukan Format File XLS atau XLSX. File Yang Anda Masukan ( $file_name ) Yang Memiliki Format ( $ekstensi ) ')</script>";
    }else{
        $fileEkstensi = explode('.', $file_name);
        $fileEkstensi = strtolower(end($fileEkstensi));
        
        $newFileName = date("Y.m.d") ."-" . date("h.i.sa"). "." .$fileEkstensi;

        $targetDirectory = "assets/FileExcel/".$newFileName;
        move_uploaded_file($file_data, $targetDirectory);

        $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReader($fileEkstensi);
        $spreadsheet = $reader->load($targetDirectory);
        $sheetData = $spreadsheet->getActiveSheet()->toArray();
    }
    var_dump($sheetData);
    die();
    

    // header("location:anggota.php");