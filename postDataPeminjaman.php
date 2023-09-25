<?php 

$db_username 	= 'root';
$db_password 	= '';
$db_name 		= 'perpus_barcode'; 
$db_host 		= 'localhost';

// Create connection
$conn = mysqli_connect($db_host, $db_username, $db_password, $db_name);
// Check connection

// var_dump($_POST);
// die();
$today = date("d/m/Y");
// ambil inputan
$buku_id = $_POST['uid_buku']; 
$anggota_id = $_POST['uid_ang']; 
$tgl_pinjam = $today; 
$tgl_7 = strtotime($tgl_pinjam);


// Membuat objek DateTime dari format yang ada
$tanggalObjek = DateTime::createFromFormat('d/m/Y', $tgl_pinjam);

if ($tanggalObjek) {
    // Mengubah format menjadi "dd-mm-yyyy"
    $tanggalHasil = $tanggalObjek->format('Y-m-d');
    
} else {
    echo "Format tanggal tidak valid.";
}


$tanggalAwal = $tgl_pinjam;

// Membuat objek DateTime dari format yang berbeda
$tanggalObjek = DateTime::createFromFormat('d/m/Y', $tanggalAwal);

if ($tanggalObjek) {
    // Jika objek DateTime berhasil dibuat, maka kita dapat melanjutkan
    $jumlahHari = 7; // Gantilah dengan jumlah hari yang Anda inginkan

    // Menambahkan jumlah hari ke tanggal awal
    $tanggalObjek->add(new DateInterval('P' . $jumlahHari . 'D'));

    // Mengambil tanggal hasil dalam format "YYYY-MM-DD"
    $tgl_kembali = $tanggalObjek->format('Y-m-d');

} else {
    echo "Format tanggal tidak valid.";
}

// cek stok buku

// $db->where('uid_buku', $buku_id);
// $databuku = $db->getOne('buku');

$query = "SELECT * FROM buku WHERE uid_buku='$buku_id'";
$filterBuku = mysqli_query($conn, $query);
$databuku = mysqli_num_rows($filterBuku);

$queryAnggota = "SELECT * FROM anggota WHERE uid='$anggota_id'";
$filterAnggota = mysqli_query($conn, $queryAnggota);
$dataAnggota = mysqli_num_rows($filterAnggota);

$row = mysqli_fetch_assoc($filterBuku);

$rowAnggota = mysqli_fetch_assoc($filterAnggota);

$idBuku = $row['id_buku'];
$filterIdAnggota = $rowAnggota['id_anggota'];



// while ($filterAnggota) {
    //     $filterAnggota = $rowAnggota['id_anggota'];
    // }
$filterUID = $rowAnggota['uid'];
$id_list_begin = $filterUID + 1;
// $carIAng =  filter_var($filterIdAnggota, FILTER_VALIDATE_INT);


// var_dump($id_list_begin);
// die();


if ($databuku < 1 ) {
	echo $root->json_response('Stok buku tidak mencukupi.', 'error', 422);
	exit();
}

$insertTrans = "INSERT INTO transaksi (id_transaksi, buku_id, anggota_id, id_list ,tgl_pinjam, tgl_kembali, status_kembali, telat_per_hari) VALUES('', '$idBuku', '$filterIdAnggota', '$id_list_begin' ,'$tanggalHasil', '$tgl_kembali', '0', '2000')";

$pesan = mysqli_query($conn, $insertTrans);


if ($pesan) {
// Misalkan Anda memiliki $idBuku dan $jumlahPengurangan yang berisi ID buku yang akan diperbarui dan jumlah yang akan dikurangkan dari stok.

// Pertama, ambil stok buku saat ini
$selectBuku = "SELECT stok FROM buku WHERE id_buku='$idBuku'";
$result = mysqli_query($conn, $selectBuku);

if ($result && mysqli_num_rows($result) > 0) { 
    $row = mysqli_fetch_assoc($result);
    $stokSaatIni = $row['stok'];

    // Hitung stok yang baru setelah pengurangan
    $stokBaru = $stokSaatIni - 1;
    
    
    // Perbarui stok buku dalam database
    $updateStok = "UPDATE buku SET stok='$stokBaru' WHERE id_buku='$idBuku'";
    $berhasilUpdate = mysqli_query($conn, $updateStok);
    

        if ($berhasilUpdate) {
            // Stok buku berhasil diperbarui
            echo "<script>console.log('New record created successfully'); </script>";
            header("location:peminjaman.php");
        } else {
            // Gagal memperbarui stok buku
            echo "<script>console.log('New record created Denied'); </script>";
            header("location:peminjaman.php");
        }
    } else {
        // Buku dengan ID yang diberikan tidak ditemukan
        echo "Buku tidak ditemukan.";
    }

} else {
	echo "<script>console.log('New record created Error'); </script>";
	header("location:peminjaman.php");
	// echo json_encode(array('pesan'=>'Gagal '. $db->getLastError(), 'type'=>'error'));
}

?>