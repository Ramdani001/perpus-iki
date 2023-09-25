<?php

$db_username     = 'root';
$db_password     = '';
$db_name         = 'perpus_barcode';
$db_host         = 'localhost';

// Create connection
$conn = new mysqli($db_host, $db_username, $db_password, $db_name);

$type = $_POST['type'];
$id_tamu = $_POST['id_tamu'];

// ============

$nama = $_POST['nama'];
$instansi = $_POST['instansi'];
$keperluan = $_POST['keperluan'];
$tgl_kedatangan = $_POST['tgl_kedatangan'];

if($type == 'new'){
    
    $query = "INSERT INTO tamu VALUES ('', '$nama', '$instansi', '$keperluan', '$tgl_kedatangan')";
    $insert = mysqli_query($conn, $query);

    if ($insert) {
        echo "<script>
                    alert('Data Tersimpan');
            </script>";
        header("location:daftar_tamu.php"); 
    } else {
        echo "<script>
                    alert('Data Tidak Tersimpan');
            </script>";
        header("location:daftar_tamu.php");
    }

}else if($type == 'edit'){
    
    $query = "UPDATE tamu SET nama='$nama', instansi='$instansi', keperluan='$keperluan', tgl_kedatangan='$tgl_kedatangan' WHERE id_tamu='$id_tamu'";
    $update = mysqli_query($conn, $query);

    if($update){
        echo "<scipt> alert('Data Berhasil Diubah'); </script>";
        header("location:daftar_tamu.php");
    }else{
        echo "<scipt> alert('Data Gagal Diubah'); </script>";
        header("location:daftar_tamu.php");
    }

}