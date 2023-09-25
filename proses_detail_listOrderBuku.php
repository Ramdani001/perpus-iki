 <?php

    $db_username     = 'root';
    $db_password     = '';
    $db_name         = 'perpus_barcode';
    $db_host         = 'localhost';

    // Create connection
    $conn = new mysqli($db_host, $db_username, $db_password, $db_name);
    // Check connection

    $idAnggota = $_POST['idAnggota'];

    $query = "SELECT * FROM anggota WHERE id_anggota='$idAnggota'";
    $search = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($search);

    $idCari = $row['uid'] + 1;

    $queryList = "SELECT * FROM listOrderBuku WHERE  id_list='$idCari' AND status='0'";
    $listBuku = mysqli_query($conn, $queryList);

    // $rowList = mysqli_fetch_assoc($listBuku);

    $allList = [];
    // Mengambil semua data yang memiliki id_list sama
    while ($rowList = mysqli_fetch_assoc($listBuku)) {
        $allList[] = $rowList;
    }

    $dataToSend = [
        'allList' => $allList,
        'row' => $row
    ];

    echo json_encode($dataToSend);
    

    ?>