<?php

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


// ambil inputan
$type = $_POST['type'];
$idAdmin = $_POST['idAdmin'];
$nama = $_POST['nama'];
$username = $_POST['username'];
$status = $_POST['status'];

$pass = $_POST['password'];


// var_dump($password);
// die();

if ($type == 'new') {
    $password = password_hash("$pass", PASSWORD_DEFAULT);

	$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
	$namaGambar = $_FILES['fileGambar']['name'];
	$x = explode('.', $namaGambar);
	$ekstensi = strtolower(end($x));
	$ukuran = $_FILES['fileGambar']['size'];
	$file_tmp = $_FILES['fileGambar']['tmp_name'];
	$filterArray = in_array($ekstensi, $ekstensi_diperbolehkan);
	$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

	$getGam =  'Admin-' . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $ekstensi . '';


	if ($filterArray === true) {

		// $upload = move_uploaded_file($file_tmp, 'D:/Xampp/htdocs/revisi/perbar-master/assets/FtAdmin/' . $getGam);
		$upload = move_uploaded_file($file_tmp, 'C:/xampp/htdocs/Terbaru/revisi/perbar-master/assets/FtAdmin/' . $getGam);
		
		// var_dump($upload);
		// die();

		if ($upload) {
			$sql = "INSERT INTO admin VALUES ( '','$username', '$password', '$nama', '$status', '$getGam')";
			$insert = mysqli_query($conn, $sql);
		}
	}

	if ($insert === TRUE) {
		echo "<script>console.log('New record created successfully'); </script>";
		// echo "<script>alert('New record created successfully'); </script>";
		$conn->close();
		header("location:berandaAccount.php");
	} else {
		echo '<script>console.log("Error: "' . $sql . '"<br>"' . $conn->error;
		'"))';
		$conn->close();
		header("location:berandaAccount.php");
		// echo "<script>alert('New record created Error'); </script>";
	}

	// mengalihkan halaman kembali ke index.php
} else if ($type == 'edit') {
    if(empty($pass)){
        $password = $_POST['passwordLama'];
    }else{
        $password = password_hash("$pass", PASSWORD_DEFAULT);
    }
    // var_dump($password);
    // die();

	$gambarLama = $_POST['gambarLama'];

		$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
		$namaGambar = $_FILES['fileGambar']['name'];
		$x = explode('.', $namaGambar);
		$ekstensi = strtolower(end($x));
		$ukuran = $_FILES['fileGambar']['size'];
		$file_tmp = $_FILES['fileGambar']['tmp_name'];
		$filterArray = in_array($ekstensi, $ekstensi_diperbolehkan);
		$permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

		$getGam =  'Admin-' . substr(str_shuffle($permitted_chars), 0, 16) . '.' . $ekstensi . '';
        
        // var_dump($filterArray);

		if ($filterArray === true) {

			// update data ke database
			$upload = move_uploaded_file($file_tmp, 'D:/Xampp/htdocs/revisi/perbar-master/assets/FtAdmin' . $getGam);

			// $upload = move_uploaded_file($file_tmp, 'C:/xampp/htdocs/Terbaru/revisi/perbar-master/assets/FtAdmin/' . $getGam);
            
            // '$username', '$password', '$nama', '$status', '$getGam'
			if ($upload) { 
				// var_dump($upload);

                $update = mysqli_query($conn, "UPDATE admin SET username='$username' , password='$password', nama='$nama', status='$status', gambar='$getGam' where id_admin='$idAdmin'");
 
                echo "<script>console.log('New record created successfully'); </script>";
                
                header("location:berandaAccount.php");
			}
		} else {
			$update = mysqli_query($conn, "UPDATE admin set username='$username' , password='$password', nama='$nama', status='$status', gambar='$gambarLama' where id_admin='$idAdmin'");

            echo "<script>console.log('New record created Denied'); </script>";
            
            header("location:berandaAccount.php");
		}

}
